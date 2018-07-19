@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<!--Mensajes de Guardado o Actualización -->
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
	<!--FIN Mensajes de Guardado o Actualización -->

    <div class="row">
        <div class="col-md-8 col-md-offset-2">


			<!--BreadCrumb-->
			<ol class="breadcrumb">
			  <li><a href="/facturas">Facturas</a></li>
			  <li class="active">Cargar Items</li>
			</ol>
			<!--FIN BreadCrumb-->


            <div class="panel panel-default">
                <div class="panel-heading">Carga de Items a factura</div>
                <div class="panel-body">
                    {{ csrf_field() }} 

					<!-- Lista de Items -->		
					<div class="row">
						<div class="col-md-12">
							<table class="table table-striped">
								<thead>
								  <tr>
									<th>Nombre</th>
									<th>Carga de datos</th>
								  </tr>
								</thead>
								<tbody>
								  @foreach($items as $item)
								  <tr>
									<td><a href="{{ URL::to('') }}">{{ $item->name }}</a></td>
									<td><a href="{{ URL::to('') }}">Importar</a></td>
								  </tr>
								  @endforeach
								</tbody>
							</table>

						</div>
					</div>
					<!-- FIN Lista de Items -->			
                </div>
            </div>
        </div>
    </div>


</div>
@endsection