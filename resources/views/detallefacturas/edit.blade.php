@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
			<!--BreadCrumb-->
			<ol class="breadcrumb">
			  <li><a href="/facturas">Factura</a></li>
			  <li class="active">Editar</li>
			</ol>
			<!--FIN BreadCrumb-->
			<!--Panel Formulario Editar Comuna-->
            <div class="panel panel-default">
                <div class="panel-heading">Editar Detalle Factura</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/detallefacturas/{{$detallefactura->id}}">
                        <input type="hidden" name="_method" value="PUT">
						{{ csrf_field() }}



                        <input id="idfactura" type="hidden"  name="idfactura" value="{{$detallefactura->id}}" >


                        <!--Campo descripcion-->
                        <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                            <label for="descripcion" class="col-md-4 control-label">Descripcion</label>

                            <div class="col-md-6">
                                <input id="descripcion" type="text" class="form-control" name="descripcion" value="{{$detallefactura->descripcion}}" required autofocus>

                                @if ($errors->has('descripcion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <!--Comuna-->  
                        <div class="form-group{{ $errors->has('comuna_id') ? ' has-error' : '' }}">
                          <label for="comuna_id" class="col-md-4 control-label">Comuna</label>

                            <div class="col-md-6">
                                  <select id="comuna_id" class="form-control" name="comuna_id" required>
                                    @foreach($comunas as $comuna)
                                        @if($comuna->id == $detallefactura->comuna_id)
                                            <option value="{{ $comuna->id }}" selected="">{{ $comuna->name }}</option>
                                        @else
                                            <option value="{{ $comuna->id }}">{{ $comuna->name }}</option>   
                                        @endif    
                                    @endforeach        
                                  </select> 
                            </div>
                        </div>

                        <!--Establecimiento-->  
                        <div class="form-group{{ $errors->has('establecimiento_id') ? ' has-error' : '' }}">
                          <label for="establecimiento_id" class="col-md-4 control-label">Establecimiento</label>

                            <div class="col-md-6">
                                  <select id="establecimiento_id" class="form-control" name="establecimiento_id" required>
                                    @foreach($establecimientos as $establecimiento)
                                        @if($establecimiento->id == $detallefactura->establecimiento_id)
                                            <option value="{{ $establecimiento->id }}" selected="">{{ $establecimiento->name }}</option>
                                        @else
                                            <option value="{{ $establecimiento->id }}">{{ $establecimiento->name }}</option>   
                                        @endif    
                                    @endforeach        
                                  </select> 
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('monto') ? ' has-error' : '' }}">
                            <label for="monto" class="col-md-4 control-label">Monto</label>

                            <div class="col-md-6">
                                <input id="monto" type="text" class="form-control" name="monto" value="{{$detallefactura->monto}}" required autofocus>

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

