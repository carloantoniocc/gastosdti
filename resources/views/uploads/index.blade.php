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
				error importacion
			</div>			
		@endif
	</div>
	
		<div class="row">
			<div class="container" >
					<ol class="breadcrumb">
					  <li><a href="{{ URL::to('facturas') }}">Facturas</a></li>
					  <li>Carga Masiva - Factura ({{ $factura->numero }})</li>
					</ol>
			</div>
		</div>	

		<div class="row">
			<div class="container">
				<div class="col-md-8 ">
					<div class="panel panel-default">
						<div class="panel-heading"><h4>Importar Item : <strong>{{ strtolower($item->name) }} </strong> desde Excel</h4></div>
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
			                            <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-upload"></span> Importar
			                                
			                            </button>
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
				                                    	<span class="help-block">
				                                        	<li>	<strong>{{ $error }}</strong> </li>
				                                    	</span>
													@endforeach

												</td>
											</tr>	
										</table>
									</div>
								@endif

								</br>	




						</div>

						<div class="panel-footer">Importar <strong>({{ ucwords($storage->name) }}) </strong></div>

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
				                <a class="btn btn-lg btn-block btn-info" href="{{ URL::to('uploadsfactura/storage/' . $storage->id . '/downloadfile' ) }}"><span class="glyphicon glyphicon-download"></span> Descargar</a>
				            </div>
				        </div>


	<div>
		<div class="side-menu">
	        <nav class="navbar navbar-default" role="navigation">
	        <div class="side-menu-container">
	        	<ul class="nav">
				
	            	<li class="panel panel-default" id="dropdown"><a data-toggle="collapse" href="#about"><span class="glyphicon glyphicon-play" ></span> Historico de Cargas </a>
	                	<div id="about" class="panel-collapse collapse">
	                    	<div class="panel-body" style="height: 200px ;overflow: auto">
	                        	<ul class="nav">

									
								@if (is_null($uploads))

			  						@foreach($uploads as $upload)

                            		<li class="nav-item">


                        				<div>
                        					<table class="table table-borderless table-condensed table-hover"  >
                        						<tr>
                        							<td colspan="2"><p style="font-size: 17px"><strong> {{ $upload->filename }}	</strong></p></td>
                        							<td></td>                        							
                        							<td class="text-right"><a  href="{{ URL::to('ufs/downloadfilenamestorage', ['$file' => $upload->filenamestorage] ) }}"><span class="glyphicon glyphicon-download-alt" style="font-size: 15px"></span> </a></td>


                        						</tr>

                        						<tr>
                        							<td rowspan="2"><span class="glyphicon glyphicon-user" style="font-size: 38px"></span> </td>
                        							<td colspan="2">
                        								<table>
                        									<tr>
                        										<td colspan="2"><p class="text-primary">{{ $upload->usuario }} </p></td>
                        									</tr> 
															
                        									<tr>
                        										<td colspan="2">{{ $upload->created_at }} </td>
                        									</tr> 

                        									<tr>
                        										<td colspan="2"><p class="text-secondary">(Sin Comentarios) </p></td>
                        										<td></td>
                        									</tr> 

                        								</table>	  
                        							</td>
                        							<td></td>

                        						</tr>
												<tr>
													<td></td>
													<td></td>
													<td></td>

												</tr>

                        					</table>
                        				</div>
	

                            		</li>				  						
									@endforeach	
								@endif	

	                        	</ul>
	                    	</div>
	                	</div>
	            	</li>
	            
	            </ul>
	        </div>
	        </nav>
	    </div>
	</div>




				    </div>
			</div>
		</div>




@endsection

@section('scripts')

<script>
$(document).ready(function () {
	$('.btn-info').click(function () {

	});
})

</script>

@endsection