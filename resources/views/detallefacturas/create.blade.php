@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!--BreadCrumb-->
			<ol class="breadcrumb">
			  <li><a href="{{ URL::to('detallefacturas/'  . '/detalle') }}">Detalle Factura</a></li>

			  <li class="active">Crear</li>
			</ol>
			<!--FIN BreadCrumb-->
			<!--Panel Formulario Crear Comuna-->
			<div class="panel panel-default">
                <div class="panel-heading">Crear Detalle</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/detallefacturas" accept-charset="UTF-8" enctype="multipart/form-data">
                        {{ csrf_field() }}


                        <div class="form-group">
                          <label class="col-md-4 control-label">Nuevo Archivo</label>
                          <div class="col-md-6">
                            <input type="file" class="form-control" name="file" >
                          </div>
                        </div>


                        <!--Campo Nombre-->
                        <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                            <label for="descripcion" class="col-md-4 control-label">Descripcion </label>

                            <div class="col-md-6">
                                <input id="descripcion" type="text" class="form-control" name="descripcion" required autofocus>

                                @if ($errors->has('descripcion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <!--Campo Establecimiento-->
                        <div class="form-group{{ $errors->has('establecimiento_id') ? ' has-error' : '' }}">
                          <label for="establecimiento_id" class="col-md-4 control-label"><ELEMENT>Establecimiento</ELEMENT></label>

                            <div class="col-md-6">
                                  <select id="establecimiento_id" class="form-control" name="establecimiento_id" required>
                                    @foreach($establecimientos as $establecimiento)
                                        <option value="{{ $establecimiento->id }}">{{ $establecimiento->name }}</option>
                                    @endforeach        
                                  </select> 
                            </div>
                        </div>



                        <!--Campo Monto-->
                        <div class="form-group{{ $errors->has('monto') ? ' has-error' : '' }}">
                            <label for="monto" class="col-md-4 control-label">Monto </label>

                            <div class="col-md-6">
                                <input id="monto" type="text" class="form-control" name="monto" required autofocus>

                                @if ($errors->has('monto'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('monto') }}</strong>
                                    </span>
                                @endif
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

