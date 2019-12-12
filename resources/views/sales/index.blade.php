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
            	</thead>
            	<tbody>
    				@foreach($data['sales'] as $sale)
            		<tr>
            			<td><a href="#">{{ $sale->id }}</a></td>
            			<td>{{ $sale->qty }}</td>
            			<td>{{ $sale->qty }}</td>
            		</tr>
            		@endforeach
            	</tbody>
            </table>

    </div>
</div>
@endsection