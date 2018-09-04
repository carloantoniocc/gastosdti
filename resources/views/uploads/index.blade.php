@extends('layouts.app')

@section('content')

<div class="row">
	<div class="container">

		<div class="row">
			<div class="container" >
				<ol class="breadcrumb">
	                <li><a href="{{ URL::to('resumenfactura/' . $resumenfactura->factura->id . '/cuadroresumen') }}">Factura {{ $resumenfactura->factura->numero }} </a></li>
				    <li>Carga Masiva </li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="container col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading"><h4>Importar Factura  </h4></div>
					<div class="panel-body text-left">
				        {{ csrf_field() }} 
							
						<div class=" text-justify">
		                	<p>1- Presiona el boton "Seleccionar archivo" para seleccionar la ruta donde se encuentra el archivo, tambien puedes arrastrarlo y soltarlo en la zona delimitada.</p>	
						</div>

						<div class=" text-justify">
		                	<p>2- Presiona el boton "Importar" para cargar el archivo y procesar la información.</p>	
						</div>

						</br>          

		                <form class="form-inline" role="form" method="POST" action="/uploadsfactura/{{ $resumenfactura->id }}/importar" accept-charset="UTF-8" enctype="multipart/form-data">	
								{{ csrf_field() }}

		                    <div class="form-group {{ $errors->has('file') ? ' has-error' : '' }}">
		                            <input id="file" type="file" class="form-control" name="file" required autofocus>
							</div>

							<div class="form-group">
		                        <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-upload"></span> Importar</button>
		                    </div>    
		                </form>			
						</br>	
							@if ($errors->any())								
								<div>
									<table class="table  table-borderless table-condensed table-hover">
										<tr>
											<th>
												<p class="text-info">Por favor corrige los siguientes errores:</p>
											</th>
										</tr>
										<tr>
											<td>
												@foreach ($errors->all() as $error)
			                                    <span class="help-block"><li><strong>{{ $error }}</strong> </li></span>
												@endforeach
											</td>
										</tr>	
									</table>
								</div>
							@endif
							</br>	
					</div>
				<div class="panel-footer">Nro registro :  {{ $resumenfactura->factura->id }} </div>
			</div>
		</div>

		
		    <div class="col-md-4">
		        <div class="panel panel-info">
		            <div class="panel-heading">
		                <h4 class="text-center">
		                   Descargar Plantilla</h4>
		            </div>
		            <div class="panel-body text-left ">
		                <p>Para realizar la carga masiva de informacion debes descargar la plantilla con el formato necesario de carga</p>

		            </div>

		            <ul class="list-group list-group-flush text-center">
		                <li class="list-group-item"><i class="icon-ok text-danger"></i>Consultar catalogo para el llenado del archivo <a href="{{ URL::to('ufs/downloadfile', ['$file' => 'CatalogoUF.docx'] ) }}">Ver Catalogo</a></li>
		            </ul>


		            <ul class="list-group list-group-flush text-center">
		                <li class="list-group-item"><i class="icon-ok text-danger"></i>Soporte mesa de ayuda</li>
		            </ul>

		            <div class="panel-footer">
		                <a class="btn btn-lg btn-block btn-info" ><span class="glyphicon glyphicon-download"></span> Descargar</a>
		            </div>
		        </div>
		    </div>

	</div>
</div>

@endsection

