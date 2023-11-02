@extends('layouts.app')
 
@section('content')
    
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Mi Producto</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Mi Productos</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
  <div class="container-fluid">
    <div class="row">
    <section class="content">
  <div class="container-fluid">
    <div class="row">
      @if($products->count() > 0)
        @foreach($products as $product)
          <div class="col-xl-3 col-sm-6 mb-4">
            <div class="card">
              <div class="card-header text-center">
                <img src="{{ asset('assets/img') }}/{{ $product->image }}" style="height: 150px; width: 100%; object-fit: contain;">
              </div>
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-capitalize font-weight-bold">{{ $product->name }}</p>
                      <h5 class="font-weight-bolder mb-0">
                        ${{ number_format($product->price, 0, '.', '.') }}
                      </h5>
                      <small>{{ $product->description }}</small>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    @if($product->sold)
                      <span class="btn bg-gradient-danger">Sold</span>
                    @else
                      <span class="btn bg-gradient-success">Active</span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      @else
      <div class="col-12">
          <div class="card">
            <div class="card-body text-center p-3">
              <h4>Aún no tienes un producto</h4>
              <a href="{{ route('product.create') }}" class="btn bg-gradient-primary">Agregar producto</a>
            </div>
          </div>
        </div>
      @endif
    </div>
  </div>
    </section>
@endsection