@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
			<!--BreadCrumb-->
			<ol class="breadcrumb">
			  <li><a href="/items">Item</a></li>
			  <li class="active">Editar</li>
			</ol>
			<!--FIN BreadCrumb-->
			<!--Panel Formulario Editar Comuna-->
            <div class="panel panel-default">
                <div class="panel-heading">Editar Item</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/items/{{$item->id}}">
                        <input type="hidden" name="_method" value="PUT">
						{{ csrf_field() }}
						<!--Campo Nombre-->
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{$item->name}}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--Proveedor-->  
                        <div class="form-group{{ $errors->has('categorie_id') ? ' has-error' : '' }}">
                          <label for="categorie_id" class="col-md-4 control-label">Categoria</label>

                            <div class="col-md-6">
                                  <select id="categorie_id" class="form-control" name="categorie_id" required>
                                    @foreach($categories as $categorie)
                                        @if($categorie->id == $item->categorie_id)
                                            <option value="{{ $categorie->id }}" selected="">{{ $categorie->name }}</option>
                                        @else
                                            <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>   
                                        @endif    
                                    @endforeach        
                                  </select> 
                            </div>
                        </div>

                        <!--Proveedor-->  
                        <div class="form-group{{ $errors->has('storage_id') ? ' has-error' : '' }}">
                          <label for="storage_id" class="col-md-4 control-label">Tipo de Carga</label>

                            <div class="col-md-6">
                                  <select id="storage_id" class="form-control" name="storage_id" required>
                                    @foreach($storages as $storage)
                                        @if($storage->id == $item->storage_id)
                                            <option value="{{ $storage->id }}" selected="">{{ $storage->name }}</option>
                                        @else
                                            <option value="{{ $storage->id }}">{{ $storage->name }}</option>   
                                        @endif    
                                    @endforeach        
                                  </select> 
                            </div>
                        </div>


						<!--Lista Activo-->
						<div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
                            <label for="active" class="col-md-4 control-label">Activo</label>

                            <div class="col-md-6">
								<select id="active" class="form-control" name="active" required>
								@if ($item->active == 1)
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

