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
        <div class="col-md-8 col-md-offset-2">

			<!--BreadCrumb-->
			<ol class="breadcrumb">
			  <li><a href="/categories">Categorias</a></li>
			  <li class="active">Items {{ $categorie->name }}</li>
			</ol>
			<!--FIN BreadCrumb-->

            
            <div class="panel panel-default">
                <div class="panel-heading">Crear Item</div>
                <div class="panel-body">
                     
					<form class="form-horizontal" role="form" method="GET" action="/categories/{{ $categorie->id }}/crearitem">
						{{ csrf_field() }}
	                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	                        <label for="name" class="col-md-4 control-label">Nombre</label>

	                        <div class="col-md-6">
	                            <input id="name" type="text" class="form-control" name="name" required autofocus>

	                            @if ($errors->has('name'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('name') }}</strong>
	                                </span>
	                            @endif
	                        </div>
	                    </div>				



						<div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
	                        <label for="active" class="col-md-4 control-label">Activo</label>

	                        <div class="col-md-6">
								<select id="active" class="form-control" name="active" required>
								  <option value="1">Si</option>
								  <option value="0">No</option>
								</select>
	                        </div>
	                    </div>

						<!--Boton Submit-->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4 text-right">
                                <button id="item" type="submit" class="btn btn-primary">
                                    Crear Item
                                </button>
                            </div>
                        </div>
                    </form>


				</div>	
			</div>

            <div class="panel panel-default">
                </br>
                <div class="container"><p>Items <strong> {{ $categorie->name }}</strong></p></div>
                <div class="panel-body">
                    {{ csrf_field() }} 


					</br>
					<!-- Lista de Comunas -->		
					<div class="row">
						<div class="col-md-12">
							<table class="table table-striped">
								<thead>
								  <tr>
									<th>Nombre</th>
									<th>Estado</th>
									<th>Editar</th>
								  </tr>
								</thead>
								<tbody>
								  @foreach($items as $item)
								  <tr>
									<td>{{ $item->name }}</td>
									<td>
										@if( $item->active == 1 )
											Activo
										@else
											Inactivo
										@endif
									</td>
									<td><a href="{{ URL::to('categories/edit/item/'. $item->id) }}">Editar</a></td>
								  </tr>
								  @endforeach
								</tbody>
							</table>
							<!--paginacion-->
							{{ $items->links() }}
						</div>
					</div>
					<!-- FIN Lista de Comunas -->			
                </div>
            </div>

        </div>
    </div>
</div>
@endsection