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
			  <li class="active">Items</li>
			</ol>
			<!--FIN BreadCrumb-->

 		

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
								  </tr>
								</thead>
								<tbody>
								  @foreach($categorie->items as $key => $item)
								  <tr>
									<td>{{ $item->name }}</td>
									<td>
										@if( $item->active == 1 )
											Activo
										@else
											Inactivo
										@endif
									</td>

								  </tr>
								  @endforeach
								</tbody>
							</table>

						</div>
					</div>
					<!-- FIN Lista de Comunas -->			
                </div>
            </div>

        </div>
    </div>
</div>
@endsection