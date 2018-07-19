@extends('layouts.app')

@section('content')





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

	<div class="container">
		<div class="row">
				<div class="panel panel-default">
					<div class="panel-heading">Tabla Resumen</div>
					<div class="panel-body">


						<form class="form-horizontal" role="form" method="POST" action="/tablereports">
                         {{ csrf_field() }}
    						<!--Lista Comunas-->
    						<div class="form-group{{ $errors->has('comuna') ? ' has-error' : '' }}">
    	                        <label for="comuna" class="col-md-4 control-label">Comuna</label>

    	                        <div class="col-md-6">
    								<select id="comuna" class="form-control" name="comuna" required>
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



        <div class="row">
            <div>
                <table class="table table-striped">
                    <th class="col-lg-3"><p></p></th>
                    <th class="col-lg-7"><div class="" id="piechart"></div></th>
                    <th class="col-lg-2 text-center"><a href="javascript:imprSelec('piechart')">Imprimir</a></th>
                </table>
            </div>
            
        </div>
    </div>
    


@endsection