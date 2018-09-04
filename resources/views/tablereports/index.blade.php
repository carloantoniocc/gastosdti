@extends('layouts.app')

@section('content')



@if (isset($datos))
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['fecha', 'monto'],

            @foreach($datos as $dato)
                [' {{ $dato->fecha }} ', {{ $dato->monto }} ],
            @endforeach

        ]);

        var options = {
          title: 'Total facturado', 'width':900, 'height':500
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>
@endif


	<div class="container">
		<div class="row">
				<div class="panel panel-default">
					<div class="panel-heading">Tabla Resumen</div>
					<div class="panel-body">


						<form class="form-horizontal" role="form" method="POST" action="/tablereports/consulta">
                         {{ csrf_field() }}


                            <!--Lista Categoria-->
                            <div class="form-group{{ $errors->has('categorie') ? ' has-error' : '' }}">
                                <label for="categorie" class="col-md-4 control-label">Categoria</label>

                                <div class="col-md-6">
                                    <select id="categorie" class="form-control" name="categorie" required>
                                      <option value="">Seleccione Categoria</option>
                                      @foreach($categories as $categorie)
                                        <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>      

    						<!--Lista Comunas-->
    						<div class="form-group{{ $errors->has('comuna') ? ' has-error' : '' }}">
    	                        <label for="comuna" class="col-md-4 control-label">Comuna</label>

    	                        <div class="col-md-6">
    								<select id="comuna" class="form-control" name="comuna" >
    								  <option value="">Seleccione Comuna</option>
    								  @foreach($comunas as $comuna)
    									<option value="{{ $comuna->id }}">{{ $comuna->name }}</option>
    								  @endforeach
    								</select>
    	                        </div>
    	                    </div>						
    						

    						<!--Lista Establecimientos-->
    						<div class="form-group{{ $errors->has('establecimiento') ? ' has-error' : '' }}">
    	                        <label for="establecimiento" class="col-md-4 control-label">Establecimiento</label>

    	                        <div class="col-md-6">
    								<select id="establecimiento" class="form-control" name="establecimiento" >
    								  <option value="">Seleccione Establecimiento</option>

    								</select>
    	                        </div>
    	                    </div>

                            <!--Fecha inicio-->
                            <div class="form-group{{ $errors->has('fecha_inicio') ? ' has-error' : '' }}">
                                <label for="fecha_inicio" class="col-md-4 control-label">Fecha inicio</label>

                                <div class="col-md-6">
                                    <input id="fecha_inicio" type="date" name="fecha_inicio" value="{{ old('fecha_inicio') }}" autofocus>

                                    @if ($errors->has('fecha_inicio'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fecha_inicio') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <!--Fecha Termino-->
                            <div class="form-group{{ $errors->has('fecha_termino') ? ' has-error' : '' }}">
                                <label for="fecha_termino" class="col-md-4 control-label">Fecha termino</label>

                                <div class="col-md-6">
                                    <input id="fecha_termino" type="date" name="fecha_termino" value="{{ old('fecha_termino') }}"  autofocus>

                                    @if ($errors->has('fecha_termino'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fecha_termino') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>



                            <!--Boton Submit-->
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4 text-right">
                                    <button type="submit" class="btn btn-primary btn-right">
                                        Consultar
                                    </button>
                                </div>
                            </div>

						</form>	
				

					</div>
					
				</div>
		</div>


@if (isset($datos))
        <div class="row">
            <div>
                <table class="table table-striped">
                    <th class="col-lg-3"><p></p></th>
                    <th class="col-lg-7"><div class="" id="piechart"></div></th>
                    <th class="col-lg-2 text-center"><a href="javascript:imprSelec('piechart')">Imprimir</a></th>
                </table>
            </div>
            
        </div>
@endif        
    </div>
    


@endsection