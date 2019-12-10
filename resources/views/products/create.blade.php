@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <h2>Agregar Producto</h2>
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" value="{{ old('name') }}" id="name" name="name" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price">Precio</label>
                            <input type="text" value="{{ old('price') }}" id="price" name="price" class="form-control @error('price') is-invalid @enderror">
                            @error('price')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="qty">Cantidad</label>
                            <input type="number" value="{{ old('qty') }}" value="0" min="0" id="qty" name="qty" class="form-control @error('qty') is-invalid @enderror">
                            @error('qty')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Agregar</button>
                <a class="btn btn-secondary" href="{{ url('/') }}">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
