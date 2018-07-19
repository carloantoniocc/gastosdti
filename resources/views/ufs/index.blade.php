@extends('layouts.app')

@section('content')
	<div class="container-fluid">
		<!--Mensajes de Guardado o Actualización de Comunas-->
		<?php $message=Session::get('message') ?>
		@if($message == 'store')
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Valor de UF Creado Exitosamente
			</div>
		@elseif($message == 'update')
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Valor de UF Modificada Exitosamente
			</div>
		@elseif($message == 'success')
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Archivo importado Exitosamente
			</div>
		@elseif($message == 'failed')
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				 An error ocurred saving data into database
			</div>			
		@endif
	</div>

	
	<div class="panel panel-default container">
		<div class="panel-heading">Valor de UF</div>
		<div class="panel-body">
	        {{ csrf_field() }} 
					
			<div class="form-group  form-inline">
				<a class="btn  btn-primary" href="{{ URL::to('ufs/create') }}">Nuevo Valor</a>
				<a class="btn  btn-info" href="{{ URL::to('ufs/cmuf') }}">Carga Masiva</a>		
			</div>

			<table class="table table-striped table-hover">
				<thead>
				  <tr>
					<th>Fecha</th>
					<th>Valor</th>
					<th>Estado</th>
					<th>Responsable</th>
					<th>Editar</th>
				  </tr>
				</thead>
				<tbody>
				  @foreach($ufs as $uf)
				  <tr>
					<td>{{ $uf->fecha }}</td>
					<td>{{ $uf->valor }}</td>
					<td>
						@if( $uf->active == 1 )
							Activo
						@else
							Inactivo
						@endif
					</td>
					<td>
						<table>
							<tr>
								<th><p><span class="glyphicon glyphicon-user"><span> Administrador</p></th>
								<th><p></p></th>
							</tr>
						</table>
					</td>

					<td><a href="{{ URL::to('ufs/' . $uf->id . '/edit') }}">Editar</a></td>
				  </tr>
				  @endforeach
				</tbody>
	   		</table>
	   		{{ $ufs->links() }}
		</div>

		<div class="panel-footer">pie del panel</div>

	</div>



@endsection