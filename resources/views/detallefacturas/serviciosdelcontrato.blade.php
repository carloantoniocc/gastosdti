@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<!--Mensajes de Guardado o Actualización de Comunas-->
	<?php $message=Session::get('message') ?>
	@if($message == 'store')
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			Comuna Creada Exitosamente
		</div>
	@elseif($message == 'update')
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			Comuna Modificada Exitosamente
		</div>
	@endif
	<!--FIN Mensajes de Guardado o Actualización de Comunas-->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Listado</div>
                <div class="panel-body">
                    {{ csrf_field() }} 
					</br>
					<!-- Lista de Comunas -->		
					<div class="row">
						<div class="col-md-12">
							<table class="table table-striped">
								<thead>
								  <tr>
									<th>Establecimientos</th>
									<th>Cantidad</th>
									<th>Total</th>
								  </tr>
								</thead>
								<tbody>
								  @foreach($detalles as $detalle)
								  <tr>
									<td>{{ $detalle->establecimiento }}</td>
									<td>{{ $detalle->cantidad }}</td>
									<td>{{ $detalle->total }}</td>
								  </tr>
								  @endforeach
								</tbody>
							</table>
							<!--paginacion-->
							{{ $detalles->links() }}
						</div>
					</div>
					<!-- FIN Lista de Comunas -->			
                </div>
            </div>
        </div>
    </div>
</div>
@endsection