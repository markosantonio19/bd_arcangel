@extends('layouts.app')
 
@section('content')
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12 col-lg-6">
        <div class="card">
          <div class="card-body p-3">
            <h5>Agregar productos</h5> 
            <hr>
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="name" class="form-control-label">Nombre</label>
                <input type="text" name="name" class="form-control" id="name" required>
              </div>
              <div class="form-group">
                <label for="image" class="form-control-label">Imagen</label>
                <input type="file" name="image" class="form-control form-control-file" id="image" accept=".jpg, .png, .svg .jfif" required>
              </div>
              <div class="form-group">
                <label for="description" class="form-control-label">Descripcion</label>
                <textarea rows="6" name="description" class="form-control" id="description" required></textarea>
              </div>
              <div class="form-group">
                <label for="price" class="form-control-label">Precio</label>
                <input type="number" name="price" class="form-control" id="price" required>
                <small> Mínimo S/. 1</small>
              </div>
              <div class="form-group">
                <button class="btn btn-primary">Agregar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection