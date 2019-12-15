@extends('layouts.app')
@section('content')
<div class="row">
     <h2>Histórico de Facturación</h2>
    <div class="col-md-12" >
            <table class="table table-hover">
            	<thead class="thead-light">
            		<th># Factura</th>
            		<th>Cantidad</th>
					<th>Total Factura</th>
					<th>Tiempo</th>
            	</thead>
            	<tbody>
    				@foreach($data as $sale)
            		<tr>
            			<td><a href="#">{{ $sale->id }}</a></td>
            			<td>{{ $sale->qty }}</td>
						<td>{{ $sale->product->price * $sale->qty }}</td>
						<th>{{ $sale->product->created_at->diffInHours($sale->created_at) }}</th>
            		</tr>
            		@endforeach
            	</tbody>
            </table>

    </div>
</div>
@endsection