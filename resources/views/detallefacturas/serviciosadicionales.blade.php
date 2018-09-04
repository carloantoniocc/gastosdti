@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<!--Mensajes de Guardado o Actualización de Comunas-->
	<?php $message=Session::get('message') ?>
	@if($message == 'store')
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			Comuna Creada Exitosamente
		</div>
	@elseif($message == 'update')
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			Comuna Modificada Exitosamente
		</div>
	@endif
	<!--FIN Mensajes de Guardado o Actualización de Comunas-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Listado</div>
                <div class="panel-body">
                    {{ csrf_field() }} 
					</br>
					<!-- Lista de Comunas -->		
					<div class="row">
						<div class="col-md-12">
							<table class="table table-striped">
								<thead>
								  <tr>
									<th>Establecimiento</th>
									<th>Servicio</th>
									<th>Pago Por Única Vez</th>
									<th>Renta Mensual</th>
									<th>Plazo</th>
									<th>Inicio del Cobro</th>
									<th>Cuota</th>
									<th>Estado</th>
									<th>Editar</th>
								  </tr>
								</thead>
								<tbody>
								  @foreach($detallefacturas as $detallefactura)
								  <tr>
									<td>{{ $detallefactura->establecimiento->name }}</td>
									<td>{{ $detallefactura->servicio }}</td>
									<td>{{ $detallefactura->pagounico }}</td>
									<td>{{ $detallefactura->rentamensual }}</td>
									<td>{{ $detallefactura->plazo }}</td>
									<td>{{ $detallefactura->iniciocobro }}</td>
									<td>{{ $detallefactura->cuota }}</td>

									<td>
										@if( $detalle->active == 1 )
											Activo
										@else
											Inactivo
										@endif
									</td>
									<td><a href="{{ URL::to('') }}" >editar</a></td>
								  </tr>
								  @endforeach
								</tbody>
							</table>
							<!--paginacion-->
						</div>
					</div>
					<!-- FIN Lista de Comunas -->			
                </div>
            </div>
        </div>
    </div>
</div>
@endsection