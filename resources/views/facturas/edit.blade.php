@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
			<!--BreadCrumb-->
			<ol class="breadcrumb">
			  <li><a href="/facturas">Listado de Facturas</a></li>
			  <li class="active">Editar</li>
			</ol>
			<!--FIN BreadCrumb-->
			<!--Panel Formulario Editar Comuna-->
            <div class="panel panel-default">
                <div class="panel-heading">Editar Factura ( {{$factura->numero }} )</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/facturas/{{$factura->id}}">
                        <input type="hidden" name="_method" value="PUT">
						{{ csrf_field() }}

                        <!--Campo Proveedor-->
                        <div class="form-group{{ $errors->has('proveedor') ? ' has-error' : '' }}">
                            <label for="proveedor" class="col-md-4 control-label">Proveedor</label>

                            <div class="col-md-6">
                                <input id="numero" type="text" class="form-control" disabled name="numero" value="{{$provider->name}}" required autofocus>
                                

                                @if ($errors->has('proveedor'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('proveedor') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--Campo Categoria -->
                        <div class="form-group{{ $errors->has('categoria') ? ' has-error' : '' }}">
                            <label for="categoria" class="col-md-4 control-label">Categoria</label>


                            <div class="col-md-6">
                                <input id="numero" type="text" class="form-control" disabled name="numero" value="{{$categorie->name}}" required autofocus>

                                @if ($errors->has('categoria'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('categoria') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

						<!--Numero de Factura-->
                        <div class="form-group{{ $errors->has('numero') ? ' has-error' : '' }}">
                            <label for="numero" class="col-md-4 control-label">Numero Factura</label>

                            <div class="col-md-6">
                                <input id="numero" type="text" class="form-control" name="numero" value="{{$factura->numero}}" required autofocus>

                                @if ($errors->has('numero'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('numero') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <!--Campo fecha_recepcion-->
                        <div class="form-group{{ $errors->has('fecha_recepcion') ? ' has-error' : '' }}">
                            <label for="fecha_recepcion" class="col-md-4 control-label">Fecha Recepcion</label>

                            <div class="col-md-6">
                                <input id="fecha_recepcion" type="date" name="fecha_recepcion" value="{{$factura->fecha_recepcion}}" required autofocus>

                                @if ($errors->has('fecha_recepcion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fecha_recepcion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <!--Campo monto-->
                        <div class="form-group{{ $errors->has('monto') ? ' has-error' : '' }}">
                            <label for="monto" class="col-md-4 control-label">Monto</label>

                            <div class="col-md-6">
                                <input id="monto" type="text" class="form-control" name="monto" value="{{$factura->monto}}" required autofocus>

                                @if ($errors->has('monto'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('monto') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--Nota de credito-->
                        <div class="form-group{{ $errors->has('notacredito') ? ' has-error' : '' }}">
                            <label for="numero" class="col-md-4 control-label">Nota de credito</label>

                            <div class="col-md-6">
                                <input id="notacredito" type="text" class="form-control" name="notacredito" value="{{$factura->notacredito}}" autofocus>

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
                                @if ($factura->active == 1)
                                    <option value="1" selected>Si</option>
                                    <option value="0">No</option>
                                @else
                                    <option value="1">Si</option>
                                    <option value="0" selected>No</option>      
                                @endif
                                </select>
                            </div>
                        </div>



						<!--Boton Submit-->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Editar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
			<!--FIN Panel Formulario Editar Comuna-->
        </div>
    </div>
</div>
@endsection

