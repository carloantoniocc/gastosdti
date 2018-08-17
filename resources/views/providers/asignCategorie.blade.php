@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
			<!--BreadCrumb-->
			<ol class="breadcrumb">
			  <li><a href="/providers">Proveedores</a></li>
			  <li class="active">Asignar Categorias</li>
			</ol>
			<!--FIN BreadCrumb-->
            <div class="panel panel-default">
				<div class="panel-heading">Asignar Categorias a Proveedor</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="/providers/asignCategorie">
						{{ csrf_field() }} 
						<!--Lista de Selección Multiple-->
						<div class="form-group">
                            <label for="categoriasProveedor" class="col-md-4 control-label">Categorias</label>

                            <div class="col-md-6">
								<select id="categoriasProveedor" name="categoriasProveedor[]" class="form-control" multiple size="10" required>
									@foreach($categories as $categorie)

										@if ( $provider->isCategorie($categorie->name) )
													<option value="{{ $categorie->id }}" selected>{{ $categorie->name }}</option>
										    @else	
													<option value="{{ $categorie->id }}" >{{ $categorie->name }}</option>
									    @endif
							
									@endforeach
								</select>    
                            </div>
                        </div>
						
						<input type="hidden" name="provider_id" id="provider_id" value="{{$provider->id}}">

						<!--Boton Submit-->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Asignar
                                </button>
                            </div>
                        </div>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection