@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!--BreadCrumb-->
			<ol class="breadcrumb">
			  <li><a href="/items">Items</a></li>
			  <li class="active">Crear</li>
			</ol>
			<!--FIN BreadCrumb-->
			<!--Panel Formulario Crear Comuna-->
			<div class="panel panel-default">
                <div class="panel-heading">Crear Item</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/items">
                        {{ csrf_field() }}
						<!--Campo c-->
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
                        
                        <!-- codigo de categoria -->
                        <div class="form-group{{ $errors->has('categorie_id') ? ' has-error' : '' }}">
                            <label for="categorie_id" class="col-md-4 control-label">Categoria</label>

                            <div class="col-md-6">
                                <select id="categorie_id" class="form-control" name="categorie_id" required>
                                  <option value="">Seleccione Categoria</option>
                                  @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- codigo de categoria -->
                        <div class="form-group{{ $errors->has('storage_id') ? ' has-error' : '' }}">
                            <label for="storage_id" class="col-md-4 control-label">Tipo de Carga</label>

                            <div class="col-md-6">
                                <select id="storage_id" class="form-control" name="storage_id" required>
                                  <option value="">Seleccione Tipo de Carga</option>
                                  @foreach($storages as $storage)
                                    <option value="{{ $storage->id }}">{{ $storage->name }}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>

						<!--Lista Activo-->
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
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
			<!--FIN Panel Formulario Crear Comunas-->
        </div>
    </div>
</div>
@endsection

