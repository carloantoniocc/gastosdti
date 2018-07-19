@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<!--Mensajes de Guardado o Actualización de Comunas-->
	<?php $message=Session::get('message') ?>
	@if($message == 'store')
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			Valor de Dolar Creado Exitosamente
		</div>
	@elseif($message == 'update')
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			Valor de Dolar Modificada Exitosamente
		</div>
	@endif
	<!--FIN Mensajes de Guardado o Actualización de Comunas-->
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Valor del Dolar</div>
                <div class="panel-body">
                    {{ csrf_field() }} 
					<div class="row">
						<!-- Boton Crear Nueva Comuna -->

						<div class="form-group  form-inline">
							<a class="btn  btn-primary" href="{{ URL::to('dolars/create') }}">Nuevo Valor</a>
							<a class="btn  btn-info" href="{{ URL::to('dolars/cmdolar') }}">Carga Masiva</a>		
						</div>


					</div>
					</br>
					<!-- Lista de Comunas -->		
					<div class="row">
						<div class="col-md-12">
							<table class="table table-striped">
								<thead>
								  <tr>
									<th>Fecha</th>
									<th>Valor</th>
									<th>Estado</th>
									<th>Editar</th>
								  </tr>
								</thead>
								<tbody>
								  @foreach($dolars as $dolar)
								  <tr>
									<td>{{ $dolar->fecha }}</td>
									<td>{{ $dolar->valor }}</td>
									<td>
										@if( $dolar->active == 1 )
											Activo
										@else
											Inactivo
										@endif
									</td>

									<td><a href="{{ URL::to('dolars/' . $dolar->id . '/edit') }}">Editar</a></td>
								  </tr>
								  @endforeach
								</tbody>
							</table>
							<!--paginacion-->
							{{ $dolars->links() }}
						</div>
					</div>
					<!-- FIN Lista de dolares -->			
                </div>
            </div>
        </div>
    </div>
</div>
@endsection