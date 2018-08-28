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
                <div class="panel-heading">Editar Nro. Factura ( {{$factura->numero }} )</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/facturas/{{$factura->id}}">
                        <input type="hidden" name="_method" value="PUT">
						{{ csrf_field() }}



                        <!--Campo Proveedor-->
                        <div class="form-group{{ $errors->has('jsonprovider_id') ? ' has-error' : '' }}">
                          <label for="jsonprovider_id" class="col-md-4 control-label">Proveedor</label>

                            <div class="col-md-6">
                                  <select id="jsonprovider_id" class="form-control" name="jsonprovider_id" required>
                                    @foreach($providers as $provider)
                                        @if ($provider->id == $factura->provider_id)
                                            <option value="{{ $provider->id }}" selected="">{{ $provider->name }}</option>
                                        @else
                                            <option value="{{ $provider->id }}">{{ $provider->name }}</option>   
                                        @endif    
                                    @endforeach        
                                  </select> 
                            </div>
                        </div>  


                        <!--Campo Categoria-->
                        <div class="form-group{{ $errors->has('jsoncategorie_id') ? ' has-error' : '' }}">
                          <label for="json_categorie_id" class="col-md-4 control-label">Categoria</label>

                            <div class="col-md-6">
                                  <select id="jsoncategorie_id" class="form-control" name="jsoncategorie_id" required>
                                    @foreach ($factura->provider->categories as $categorie)
                                        @if ($categorie->id == $factura->categorie_id)
                                            <option value="{{ $categorie->id }}" selected="">{{ $categorie->name }}</option>
                                        @else
                                            <option value="{{ $categorie->id }}" >{{ $categorie->name }}</option>
                                        @endif    
                                    @endforeach
                                  </select> 
                            </div>
                        </div>  


                        <!--Campo Items-->
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Seleccione Items</label>

                            <div class="col-md-6">
                                <select id="items" name="items[]" class="form-control" multiple size="10" required>
                                    @foreach ($factura->categorie->items as $item)
                                        @if ($factura->IsItem($item->id))
                                            <option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
                                        @else
                                            <option value="{{ $item->id }}" >{{ $item->name }}</option>
                                        @endif
                                    @endforeach
                                </select>    
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
                <div class="panel-footer">Id Registro : {{  $factura->id }}</div>
            </div>
			<!--FIN Panel Formulario Editar Comuna-->
        </div>
    </div>
</div>
@endsection

