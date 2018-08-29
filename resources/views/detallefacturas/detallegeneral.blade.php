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
	@elseif($message == 'delete')
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			Detalle de factura eliminado Exitosamente
		</div>		
	@endif
	<!--FIN Mensajes de Guardado o Actualización de detalles-->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
			<ol class="breadcrumb">
			  <li><a href="/facturas">Lista de Facturas</a></li>
			  <li class="active">Resumen Factura</li>
			</ol>

            <div class="panel panel-default">
                <div class="panel-heading"><h4><strong> {{ $factura->provider->name }} </strong></h4>

					<a href="{{ URL::to('uploadsfactura/' . $factura->id .'/uploadfactura') }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Importar Datos"><span class="glyphicon glyphicon-import" ><span></a> 

                </div>
                <div class="panel-body">
                    {{ csrf_field() }} 

					<div class="col-md-12 row container">
							<h4> {{ $factura->categorie->name }}</h4>
					</div>
					
					<div class="col-md-4 row container">
						<div class="table-responsive">
								<table class="table table-striped table-sm">
									<thead>
										<tr></tr>
									</thead>
									<tbody>
										<tr>
											<td>Rut proveedor</td>
											<td>{{ $factura->provider->rut }}</td>
										</tr>
										<tr>
											<td>Nro. Factura   </td>
											<td>{{ $factura->numero }} </td>
										</tr>
										<tr>
											<td>Tipo de Moneda </td>
											<td>{{ $factura->categorie->moneda->name }}</td>
										</tr>	
									</tbody>
								</table>
						</div>
					</div>	

                    <div class="col-md-12 row container">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
								  <tr>
								  	<th class="warning text-center ">Items de Factura </th>
									<th class="warning text-center ">{{ $factura->categorie->titulo1 }}</th>
									<th class="warning text-center ">{{ $factura->categorie->titulo2 }}</th>
									<th class="warning text-center">Total </th>
									<th class="warning text-center" >Acciones </th>

								  </tr>
                                </thead>
                                <tbody>

									@foreach ($factura->resumenfacturas as $resumenfactura)
									    <tr>
									  		<td><a href="{{ URL::to('detallefacturas/' . $resumenfactura->id . '/detalleitem'  ) }}">{{ $resumenfactura->item->name }}</a></td>
									  		<td class="text-right">{{ $resumenfactura->resumen }}</td>
									  		<td class="text-right">{{ $resumenfactura->resumen2 }}</td>
									  		<td class="text-right">{{ $resumenfactura->monto }}</td>
											<td class="text-center">
												<a href="{{ URL::to('uploadsfactura/' . $resumenfactura->id .'/upload') }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Importar Datos"><span class="glyphicon glyphicon-import" ><span></a> 

												<a href="{{ URL::to('resumenfactura/' . $resumenfactura->id . '/borrar'  ) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Borrar Contenido de Item" onclick="return confirm('Seguro que desea eliminar? esta accion eliminara la carga realizada.')" ><span class="glyphicon glyphicon-trash" ><span></a>

									    	</td>

									    </tr>

									@endforeach

										<tr>
											<td class="info" >TOTAL</td>
											<td class="info " ></td>
											<td class="info " ></td>
											
											<td class="info text-right">{{ $factura->categorie->moneda->name }} {{ $factura->monto }}</td>
										</tr>
                                </tbody>

                            </table>
                        </div>
                    </div>

				</div>
				<div class="panel-footer">Id Registro : {{  $factura->id }}</div>
            </div>
        </div>
    </div>
</div>

@endsection