@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<!--Mensajes de Guardado o Actualización de Comunas-->
	<?php $message=Session::get('message') ?>
	@if($message == 'store')
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			Item Creado Exitosamente
		</div>
	@elseif($message == 'update')
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			Item Modificado Exitosamente
		</div>
	@endif
	<!--FIN Mensajes de Guardado o Actualización de Comunas-->
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Tipos de Cargas</div>
                <div class="panel-body">
                    {{ csrf_field() }} 
					<div class="row">
						<!-- Boton Crear Items -->
						<div class="col-md-6">
							<a class="btn btn-sm btn-primary" href="{{ URL::to('storages/create') }}">Crear Carga</a>
						</div>

					</div>
					</br>
					<!-- Lista de Comunas -->		
					<div class="row">
						<div class="col-md-12">
							<table class="table table-striped">
								<thead>
								  <tr>
									<th>Nombre</th>
									<th>Codigo de Carga</th>
									<th>Estado</th>
									<th>Editar</th>
								  </tr>
								</thead>
								<tbody>
								  @foreach($storages as $storage)
								  <tr>
									<td>{{ $storage->name }}</td>
									<td>{{ $storage->codigo }}</td>
									<td>
										@if( $storage->active == 1 )
											Activo
										@else
											Inactivo
										@endif
									</td>

									<td><a href="{{ URL::to('storages/' . $storage->id . '/edit') }}">Editar</a></td>
								  </tr>
								  @endforeach
								</tbody>
							</table>

						</div>
					</div>
					<!-- FIN Lista de moneda -->			
                </div>
            </div>
        </div>
    </div>
</div>
@endsection