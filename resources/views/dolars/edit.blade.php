@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
			<!--BreadCrumb-->
			<ol class="breadcrumb">
			  <li><a href="/dolars">Dolar</a></li>
			  <li class="active">Editar</li>
			</ol>
			<!--FIN BreadCrumb-->
			<!--Panel Formulario Editar dolar-->
            <div class="panel panel-default">
                <div class="panel-heading">Editar Dolar</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/dolars/{{$dolar->id}}">
                        <input type="hidden" name="_method" value="PUT">
						{{ csrf_field() }}


						<!--Campo fecha-->
                        <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
                            <label for="fecha" class="col-md-4 control-label">Fecha :</label>

                            <div class="col-md-6">
                                <input id="fecha" type="date"  name="fecha" value="{{$dolar->fecha}}" required autofocus>

                                @if ($errors->has('fecha'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fecha') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <!--Campo valor-->
                        <div class="form-group{{ $errors->has('valor') ? ' has-error' : '' }}">
                            <label for="valor" class="col-md-4 control-label">Valor :</label>

                            <div class="col-md-6">
                                <input id="valor" type="number" step="0.01" class="form-control" name="valor" value="{{$dolar->valor}}" required autofocus>

                                @if ($errors->has('valor'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('valor') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <!--Lista Activo-->
                        <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
                            <label for="active" class="col-md-4 control-label">Activo</label>

                            <div class="col-md-6">
                                <select id="active" class="form-control" name="active" required>
                                @if ($dolar->active == 1)
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
			<!--FIN Panel Formulario Editar dolar-->
        </div>
    </div>
</div>
@endsection

