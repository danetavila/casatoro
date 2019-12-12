@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-6">
            @if(session()->has('alert-success'))
                <div class="alert alert-success" role="alert">
                  {{ session()->get('alert-success') }}
                </div>
             @endif
            <h2>Facturar</h2>
            <form action="{{ route('sales.store') }}" method="POST">
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
        <div class="col-md-6">
            <div class="col-md-8 offset-md-2">
                <div class="invoice">
                    <div class="orden text-center">
                        <div id="number">Factura #</div>
                        <div class="text-center">Productos</div>
                        <div>
                            <table id="products" class="table table-striped" >
                                <thead>
                                    <tr>
                                        <td>Nombre</td>
                                        <td>Cantidad</td>
                                        <td>Precio</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Motor</td>
                                        <td>3</td>
                                        <td>500</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-right">Total $1500</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="formaspago" class="col-md-12">
                            <table id="tableformas" class="table text-right" >
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div id="cambio" class="col-md-12">
                            <table id="tablecambio" class="table text-right" >
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-12">
                            <button type="button" id="generar" class="btn btn-success text-center">Generar</button>
                        </div>
                    </div>
                </div>
           </div>
        </div>
        </div>
    </div>
@endsection
