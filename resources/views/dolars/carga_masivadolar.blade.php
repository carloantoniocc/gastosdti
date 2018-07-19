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
		@endif
	</div>
	
		<div class="row">
			<div class="container" >
					<ol class="breadcrumb">
					  <li><a href="{{ URL::to('dolars') }}">Dolar</a></li>
					  <li>Carga Masiva</li>
					</ol>
			</div>
		</div>	

		<div class="row">
			<div class="container">
				<div class="col-md-8 ">
					<div class="panel panel-default">
						<div class="panel-heading"><h4>Importar Dolar desde Excel</h4></div>
						<div class="panel-body text-left">
								
								<div class="text-justify">
			                    	<p>Selecciona el archivo desde donde quieres importar. tambien puedes arrastrarlo y soltarlo en la zona delimitada.</p>	
								</div>


			                    <form class="form-inline" role="form" method="POST" action="importar" accept-charset="UTF-8" enctype="multipart/form-data">	
			 						{{ csrf_field() }}

			                        <div class="form-group {{ $errors->has('file') ? ' has-error' : '' }}">
			                                <input id="file" type="file" class="form-control" name="file" required autofocus>

			                                @if ($errors->has('file'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('file') }}</strong>
			                                    </span>
			                                @endif
									</div>
									<div class="form-group">
			                            <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-upload"></span> Importar
			                                
			                            </button>
			                        </div>    

			                    </form>			


						</div>

						<div class="panel-footer">pie del panel</div>

					</div>
				</div>
				    <div class="col-md-4">
				        <div class="panel panel-info">
				            <div class="panel-heading">
				                <h4 class="text-center">
				                   Descargar Plantilla</h4>
				            </div>
				            <div class="panel-body text-left">
				                <p>Para realizar la carga masiva de informacion debes descargar la plantilla con el formato necesario de carga</p>
				            </div>

				            <ul class="list-group list-group-flush text-center">
				                <li class="list-group-item"><i class="icon-ok text-danger"></i>Soporte mesa de ayuda</li>
				            </ul>
				            <div class="panel-footer">
				                <a class="btn btn-lg btn-block btn-info"><span class="glyphicon glyphicon-download"></span> Descargar</a>
				            </div>
				        </div>
				    </div>
			</div>
		</div>



@endsection