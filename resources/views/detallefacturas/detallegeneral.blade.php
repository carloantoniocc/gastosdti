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


			<ol class="breadcrumb">
			  <li><a href="/facturas">Lista de Facturas</a></li>
			  <li class="active">Resumen Factura</li>
			</ol>


            <div class="panel panel-default">
                <div class="panel-heading">Resumen Factura ( {{ $factura->numero }} )</div>
                <div class="panel-body">
                    {{ csrf_field() }} 

	
					<div class="row">
						<div class="col-md-12">
							<table class="table table-bordered">
								<thead >
								  <tr >
								  	<th class="info text-center">ACCIONES<br> </th>
								  	<th class="warning text-center">DETALLE DE FACTURA MENSUAL<br> </th>
									<th class="warning text-center">RESUMEN DE PUNTOS<br> </th>
									<th class="warning text-center">TARIFICACIÓN POR PUNTO <br>(Valores en UF$ IVA Incl.)</th>
									<th class="warning text-center">TOTAL <br>(Valores en UF$ IVA Incl.)</th>

								  </tr>
								</thead>
								<tbody>


									@foreach ($resumenfacturacion as $resumenfactura)
								    <tr>
								    	<td><a href="{{ URL::to('uploadsfactura/' . $resumenfactura->idresumen .'/upload') }}" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-import" ><span></a>
										<a href="{{ URL::to('detallefacturas/' . $resumenfactura->idresumen . '/detalleitem'  ) }}" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-search" ><span></a>

								    	</td>

								  		<td><a href="{{ URL::to('detallefacturas/' . $resumenfactura->idresumen . '/detalleitem'  ) }}">{{ $resumenfactura->item }}</a></td>
								  		<td class="text-right">{{ $resumenfactura->cantidad }}</td>
								  		<td class="text-right"></td>
								  		<td class="text-right">{{ $resumenfactura->total }}</td>
								    </tr>

									@endforeach


									<tr>
										<td class="info" colspan="4">TOTAL</td>
										<td class="info text-right">UF$ {{ $factura->monto }}</td>
									</tr>


								</tbody>
							</table>

						</div>
					</div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection