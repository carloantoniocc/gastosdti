@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<!--Mensajes de Guardado o Actualización de Comunas-->
	<?php $message=Session::get('message') ?>
	@if($message == 'store')
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			Categoria Creada Exitosamente
		</div>
	@elseif($message == 'update')
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			Categoria Modificada Exitosamente
		</div>
	@endif
	<!--FIN Mensajes de Guardado o Actualización de Comunas-->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Lista de Categorias</div>
                <div class="panel-body">
                    {{ csrf_field() }} 
					<div class="row">
						<!-- Boton Crear Nueva Comuna -->
						<div class="col-md-6">
							<a class="btn btn-sm btn-primary" href="{{ URL::to('categories/create') }}">Crear Categoria</a>
						</div>
						
					</div>
					</br>
					<!-- Lista de Comunas -->		
					<div class="row">
						<div class="col-md-12">
							<table class="table table-striped">
								<thead>
								  <tr>
								  	<th>Id</th>
									<th>Nombre</th>
									<th>Tipo de Moneda</th>
									<th>Encabezado 1</th>
									<th>Encabezado 2</th>
									<th>Estado</th>
									<th>Editar</th>
									<th>Items Asociados</th>
								  </tr>
								</thead>
								<tbody>
								  @foreach($categories as $categorie)
								  <tr>
								  	<td>{{ $categorie->id }}</td>
									<td>{{ $categorie->name }}</td>
									<td class = "text-left">{{ $categorie->moneda->name }}</td>
									<td>{{ $categorie->titulo1 }}</td>
									<td>{{ $categorie->titulo2 }}</td>
									<td>
										@if( $categorie->active == 1 )
											Activo
										@else
											Inactivo
										@endif
									</td>
									<td><a href="{{ URL::to('categories/' . $categorie->id . '/edit') }}">Editar</a></td>
									<td><a href="{{ URL::to('categories/showcategorie/' . $categorie->id) }}">Ver Items</a></td>
								  </tr>
								  @endforeach
								</tbody>
							</table>
							<!--paginacion-->
							{{ $categories->links() }}
						</div>
					</div>
					<div class="panel-footer">Total de Registros : {{  $categories->total() }}</div>	
                </div>
            </div>
        </div>
    </div>
</div>
@endsection