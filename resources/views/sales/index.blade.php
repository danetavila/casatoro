@extends('layouts.app')
@section('content')
<?php
$position="";
?>
<div class="row">
     <h2>Histórico de Facturación</h2>
    <div class="col-md-12 table-responsive" >
		@if(session()->has('alert-success'))
			<div class="alert alert-success" role="alert">
				{{ session()->get('alert-success') }}
			</div>
		@endif
		<table class="table table-hover">
			<thead class="thead-light">
				<th># Factura</th>
				<th>Producto</th>
				<th>Cantidad</th>
				<th>Total Factura</th>
				<th>Posición y tiempo</th>
			</thead>
			<tbody>
				@foreach($data as $sale)
				<tr>
					<td>{{ $sale->id }}</td>
					<td>{{ $sale->product->name }}</td>
					<td>{{ $sale->qty }}</td>
					<td>{{ $sale->product->price * $sale->qty }}</td>						
					<td>
						@foreach($sale->inventories as $inventory)	
							<!--tiempo= {{$inventory->created_at->diffInHours($sale->created_at)}}-->
							<?php 
								$fecha1 = new DateTime($inventory->created_at);//fecha inicio inventario
								$fecha2 = new DateTime($sale->created_at);//fecha de venta									
								$intervalo = $fecha1->diff($fecha2);
								$años=$intervalo->format('%Y');
								$meses=$intervalo->format('%m');
								$dias=$intervalo->format('%d');
								$horas=$intervalo->format('%H');
								$minutos=$intervalo->format('%i');	
								$segundos=$intervalo->format('%s');		
								echo "<br>Posición=".$inventory->position.' Tiempo:';	
								if($años>0){
									echo" ".$intervalo->format('%Y años');//00 años 0 meses 0 días 08 horas 0 minutos 0 segundos
								}
								if($meses>0){
									echo" ".$intervalo->format('%m meses');//00 años 0 meses 0 días 08 horas 0 minutos 0 segundos
								}
								if($dias>0){
									echo" ".$intervalo->format('%d días');//00 años 0 meses 0 días 08 horas 0 minutos 0 segundos
								}
								if($horas>0){
									echo" ".$intervalo->format('%H horas');//00 años 0 meses 0 días 08 horas 0 minutos 0 segundos
								}
								if($minutos>0){
									echo" ".$intervalo->format('%i minutos');//00 años 0 meses 0 días 08 horas 0 minutos 0 segundos
								}	
								if($segundos>0){
									echo" ".$intervalo->format('%s segudos');//00 años 0 meses 0 días 08 horas 0 minutos 0 segundos
								}							
								$position .=','.$inventory->position; 																
							?>								
						@endforeach								
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
    </div>
</div>
@endsection