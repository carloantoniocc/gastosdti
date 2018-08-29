@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<!--Mensajes de Guardado o Actualización de Comunas-->
	<?php $message=Session::get('message') ?>
	@if($message == 'store')
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			Factura Creada Exitosamente
		</div>
	@elseif($message == 'update')
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			Factura Modificada Exitosamente
		</div>
	@endif
	<!--FIN Mensajes de Guardado o Actualización de Comunas-->
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Listado de Facturas</div>
                <div class="panel-body">
                    {{ csrf_field() }} 
					<div class="row">
						<!-- Boton Crear Nueva Comuna -->
						<div class="col-md-12">
							<a class="btn  btn-primary" href="{{ URL::to('facturas/create') }}">Crear Factura</a>
						</div>

					</div>
					</br>
					<!-- Lista de Comunas -->		
					<div class="row">
						<div class="col-lg-12">
				        	@if ($facturas->isNotEmpty() ) 
								<table class="table table-striped">
									<thead>
									  <tr>
									  	<th>id</th>
									  	<th>Nro. Factura</th>
										<th>Proveedor / Categoria</th>
										<th>Fecha Recepcion</th>
										<th>Monto</th>
										<th>Nota de Credito</th>																		
										<th>Estado</th>
										<th>Editar</th>
										<th>Resumen</th>
									  </tr>
									</thead>
									<tbody>
									  @foreach($facturas as $factura)
									  <tr>
									  	<td>{{ $factura->id }}</td>
									  	<td align="left">{{ $factura->numero }}</td>
										<td>{{ $factura->provider->name }} - <i>{{ $factura->categorie->name }} </i> </td>
										<td>{{ $factura->fecha_recepcion }}</td>
										<td>{{ $factura->monto }}</td>
										<td>{{ $factura->notacredito }}</td>
										<td>
											@if( $factura->active == 1 )
												Activo
											@else
												Inactivo
											@endif
										</td>
	    								<td><a href="{{ URL::to('facturas/' . $factura->id . '/edit') }}" >editar</a></td>
										<td><a href="{{ URL::to('resumenfactura/' . $factura->id . '/cuadroresumen') }}" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-list" style="font-size: 13px"><span></a></td>											

									  </tr>
									  @endforeach
									</tbody>
								</table>

								<!--paginacion-->

								{{ $facturas->appends(request()->input())->links() }}
							@else
								<h2>No existen Facturas</h2>
				            @endif

						</div>
					</div>
					<!-- FIN Lista de Comunas -->			
                </div>
					<div class="panel-footer">Total de Registros : {{  $facturas->total() }}</div>

            </div>
        </div>
    </div>
</div>
@endsection


