<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductSold; 
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request){ 
        $products = Product::orderBy('sold', 'ASC'); 
        if($request->sort == 'asc'){ 
            $products =  $products->orderBy('name', 'ASC')->get(); 
        }else if($request->sort == 'desc'){ 
            $products =  $products->orderBy('name', 'DESC')->get(); 
        }else{
            $products =  $products->orderBy('created_at', 'DESC')->orderBy('updated_at', 'DESC')->get(); 
        }

        return view('pages.products', compact('products'));
    }

    public function create(){
        return view('pages.create');
    }

    public function store(Request $request){
        if($request->price < 1){
            return back()->with('error', 'Precio Minimo S/. 1');
        }

        $file = $request->file('image');
        $fileName = 'product_' . time() . '.' . $file->extension();
        $file->move(public_path('assets/img'), $fileName);

        Product::create([
            'name' => $request->name,
            'image' => $fileName,
            'description' => $request->description,
            'price' => $request->price,
            'sold' => "0",
            'user_id' => Auth::user()->id,
        ]);


        return back()->with('success', 'Su producto ha sido creado exitosamente. Espere hasta que se venda su producto.');
    }

    public function buy($id){
        $product = Product::findOrFail($id);
 
        if($product->user_id == Auth::user()->id){
            return back()->with('error', "Compra fallida, no puedes comprar tu propio producto  ");
        }

        ProductSold::create([
            'product_id' => $product->id,
            'buyer_id' => Auth::user()->id,
        ]);
        
        $product->update([
            'sold' => true,
        ]);

        return back()->with('success', 'producto ha sido comprado exitosamente');
    }

    public function my(){
        $products = Product::where('user_id', Auth::user()->id)->orderBy('sold', 'asc')->get();
        return view('pages.my', compact('products'));
    }
}
