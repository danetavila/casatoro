@extends('layouts.app')
@section('content')
<?php
$hoy=date("Y-m-d H:i:s");
//dd($data);
?>
<div class="row">
     <h2>Reporte de Inventario</h2>
    <div class="col-md-12 table-responsive" >
		<table class="table table-hover">
			<thead class="thead-light">
				<th>Producto</th>
				<th>Precio</th>
				<th>Ubicación</th>
				<th>Tiempo</th>
			</thead>
			<tbody>
				@foreach($data as $product)
				<tr>
					<td>{{ $product->product->name }}</td>
					<td>{{ $product->product->price }}</td>
					<td>{{ $product->position }}</td>				
					<td>
                        <?php                        
                            $fecha1 = new DateTime($product->created_at);//fecha inicio inventario
                            $fecha2 = new DateTime($hoy);//fecha de venta									
                            $intervalo = $fecha1->diff($fecha2);
                            $años=$intervalo->format('%Y');
                            $meses=$intervalo->format('%m');
                            $dias=$intervalo->format('%d');
                            $horas=$intervalo->format('%H');
                            $minutos=$intervalo->format('%i');	
                            $segundos=$intervalo->format('%s');		
                        
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
                        ?>										
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
    </div>
</div>
@endsection