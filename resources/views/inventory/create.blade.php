@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <h2>Ingresar Inventario</h2>
            <form action="{{ route('inventory.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="Product">Producto</label>
                    <select  id="product_id" name="product_id" class="form-control @error('product_id') is-invalid @enderror" >
                        <option value="" >Seleccione</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{$product->name.' - Price: '. $product->price}}</option>
                        @endforeach
                    </select>
                    @error('product_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="qty">Cantidad</label>
                            <input type="number" value="{{ old('qty') }}" value="1" min="1" id="qty" name="qty" class="form-control @error('qty') is-invalid @enderror" >
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
