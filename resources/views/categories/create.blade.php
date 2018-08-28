@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!--BreadCrumb-->
			<ol class="breadcrumb">
			  <li><a href="/categories">Categorias</a></li>
			  <li class="active">Crear</li>
			</ol>
			<!--FIN BreadCrumb-->
			<!--Panel Formulario Crear Comuna-->
			<div class="panel panel-default">
                <div class="panel-heading">Crear Categoria</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/categories">
                        {{ csrf_field() }}
						<!--Campo Nombre-->
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--Lista de monedas-->
                        <div class="form-group{{ $errors->has('moneda_id') ? ' has-error' : '' }}">
                            <label for="moneda_id" class="col-md-4 control-label">Monedas</label>

                            <div class="col-md-6">
                                <select id="moneda_id" class="form-control" name="moneda_id" required>
                                  <option value="">Seleccione Moneda</option>
                                  @foreach($monedas as $moneda)
                                    <option value="{{ $moneda->id }}">{{ $moneda->name }}</option>
                                  @endforeach
                                </select>


                                @if ($errors->has('categorie_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('categorie_id') }}</strong>
                                    </span>
                                @endif 

                            </div>                                                           
                        </div>



                        <!--Campo titulo1-->
                        <div class="form-group{{ $errors->has('titulo1') ? ' has-error' : '' }}">
                            <label for="titulo1" class="col-md-4 control-label">Encabezado 1</label>

                            <div class="col-md-6">
                                <input id="titulo1" type="text" class="form-control" name="titulo1" value="{{ old('titulo1') }}" required autofocus>

                                @if ($errors->has('titulo1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('titulo1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <!--Campo titulo2-->
                        <div class="form-group{{ $errors->has('titulo2') ? ' has-error' : '' }}">
                            <label for="titulo2" class="col-md-4 control-label">Encabezado 2</label>

                            <div class="col-md-6">
                                <input id="titulo2" type="text" class="form-control" name="titulo2" value="{{ old('titulo2') }}"required autofocus>

                                @if ($errors->has('titulo2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('titulo2') }}</strong>
                                    </span>
                                @endif
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

