@extends('layouts.app')
@section('content')

<div class="row">
     <h2>Top 5 Productos más Vendidos</h2>
    <div class="col-md-12 table-responsive" >
    <table class="table table-hover">
			<thead class="thead-light">
				<th>Producto</th>
				<th>Precio</th>
				<th>Cantidades Vendida</th>
			</thead>
			<tbody>
				@foreach($data as $product)
				<tr>
					<td>{{ $product->name }}</td>
					<td>{{ $product->price }}</td>		
					<td>{{ $product->cant }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
    </div>
</div>
@endsection