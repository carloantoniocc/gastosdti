@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!--BreadCrumb-->
			<ol class="breadcrumb">
			  <li><a href="/facturas">Listado de Facturas</a></li>
			  <li class="active">Crear</li>
			</ol>
			<!--FIN BreadCrumb-->
			<!--Panel Formulario Crear Comuna-->
			<div class="panel panel-default">
                <div class="panel-heading">Crear Factura</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/facturas">
                        {{ csrf_field() }}


                        <!--Lista providers-->
                        <div class="form-group{{ $errors->has('provider_id') ? ' has-error' : '' }}">
                            <label for="provider_id" class="col-md-4 control-label">Proveedor</label>

                            <div class="col-md-6">
                                <select id="jsonprovider_id" class="form-control" name="jsonprovider_id" required>
                                  <option value="">Seleccione Proveedor</option>
                                  @foreach($providers as $provider)
                                    <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>


                        <!--Lista Categorias-->
                        <div class="form-group{{ $errors->has('categorie') ? ' has-error' : '' }}">
                            <label for="categorie" class="col-md-4 control-label">Categoria</label>

                            <div class="col-md-6">
                                <select id="jsoncategorie_id" class="form-control" name="jsoncategorie_id" required>

                                </select>

                                @if ($errors->has('jsoncategorie_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jsoncategorie_id') }}</strong>
                                    </span>
                                @endif
                                
                            </div>
                        </div>

                        <!--Lista de Items-->
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Seleccione Items</label>

                            <div class="col-md-6">
                                <select id="items" name="items[]" class="form-control" multiple size="10" required>
                                    
                                </select>    
                            </div>
                        </div>


						<!--Campo numero-->
                        <div class="form-group{{ $errors->has('numero') ? ' has-error' : '' }}">
                            <label for="numero" class="col-md-4 control-label">Numero Factura</label>

                            <div class="col-md-6">
                                <input id="numero" type="text" class="form-control" name="numero" value="{{ old('numero') }}" required autofocus>

                                @if ($errors->has('numero'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('numero') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

						<!--campo fecha_recepcion-->
                        <div class="form-group{{ $errors->has('fecha_recepcion') ? ' has-error' : '' }}">
                            <label for="fecha_recepcion" class="col-md-4 control-label">Fecha Recepcion</label>

                            <div class="col-md-6">
                                <input id="fecha_recepcion" type="date" name="fecha_recepcion" value="{{ old('fecha_recepcion') }}" required autofocus>

                                @if ($errors->has('fecha_recepcion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fecha_recepcion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <!--Campo monto-->
                        <div class="form-group{{ $errors->has('monto') ? ' has-error' : '' }}">
                            <label for="monto" class="col-md-4 control-label">Monto </label>

                            <div class="col-md-6">
                                <input id="monto" type="text" class="form-control" name="monto" value="{{ old('monto') }}" required autofocus>

                                @if ($errors->has('monto'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('monto') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                        </div>

                        <!--Nota de Credito-->
                        <div class="form-group{{ $errors->has('notacredito') ? ' has-error' : '' }}">
                            <label for="notacredito" class="col-md-4 control-label">Nota de Credito</label>

                            <div class="col-md-6">
                                <input id="notacredito" type="text" class="form-control" name="notacredito" value="{{ old('notacredito') }}"  autofocus>

                                @if ($errors->has('notacredito'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('notacredito') }}</strong>
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

