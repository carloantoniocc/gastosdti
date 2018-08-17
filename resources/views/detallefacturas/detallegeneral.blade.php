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
        <div class="col-md-8 col-md-offset-2">


			<ol class="breadcrumb">
			  <li><a href="/facturas">Lista de Facturas</a></li>
			  <li class="active">Resumen Factura</li>
			</ol>


            <div class="panel panel-default">
                <div class="panel-heading"><h4><strong> {{ $factura->provider->name }}</strong></h4></div>
                <div class="panel-body">
                    {{ csrf_field() }} 

					<div class="row container">


						<div class="col-md-12">
							
							<h4> {{ $factura->categorie->name }}</h4>
							

						</div>	

						<div class="col-md-4 table-responsive">
						

								<table class="table  table-striped table-sm">
									<thead>
										<tr>
											
											
										</tr>
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
											<td></td>


										</tr>	


									</tbody>
								</table>
						</div>
					</div>				
	


					<div class="row container">
						<div class="col-md-12" >
							
								<table class="table table-bordered border-collapse">
									<thead >
									  <tr>
									  	<th colspan="2" class="warning text-center">Acciones </th>
									  	<th class="warning text-center ">Detalle de factura mensual </th>
										<th class="warning text-center ">Resumen de puntos </th>
										<th class="warning text-center ">Tarificacion por punto </th>
										<th class="warning text-center">Total </th>

									  </tr>
									</thead>
									<tbody>


										@foreach ($resumenfacturacion as $resumenfactura)
									    <tr>
									    	<td><a href="{{ URL::to('uploadsfactura/' . $resumenfactura->idresumen .'/upload') }}" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-import" ><span></a>
									    	</td>
											
											<td class="text-left "><a href="{{ URL::to('detallefacturas/' . $resumenfactura->idresumen . '/detalleitem'  ) }}" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-search" ><span></a>
											</td>


									  		<td><a href="{{ URL::to('detallefacturas/' . $resumenfactura->idresumen . '/detalleitem'  ) }}">{{ $resumenfactura->item }}</a></td>
									  		<td class="text-right ">{{ $resumenfactura->cantidad }}</td>
									  		<td class="text-right "></td>
									  		<td class="text-right">{{ $resumenfactura->total }}</td>
									    </tr>

										@endforeach


										<tr>
											<td class="info" colspan="2">TOTAL</td>
											<td class="info " ></td>
											<td class="info " ></td>
											<td class="info " ></td>
											<td class="info text-right">UF$ {{ $factura->monto }}</td>
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