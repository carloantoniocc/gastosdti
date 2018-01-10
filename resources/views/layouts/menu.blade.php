<div class="collapse navbar-collapse" id="app-navbar-collapse">		
	<!-- Left Side Of Navbar -->
	<ul class="nav navbar-nav">
		<!-- Authentication Links -->
		@if (!Auth::guest())

			@if( Auth::user()->isRole('Administrador') )
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						Administración <span class="caret"></span>
					</a>
					
					<ul class="dropdown-menu" role="menu">
						<li>
							<a href="/users"> Usuarios </a>
						</li>
						
						<li class="divider"></li>
						
						<li>
							<a href="/establecimientos"> Establecimientos </a>
						</li>
						
						<li>
							<a href="/tipoEstabs"> Tipo de Establecimiento </a>
						</li>
						
						<li class="divider"></li>
						
						<li>
							<a href="/comunas"> Comunas </a>
						</li>
						
						<li class="divider"></li>
					</ul>
				</li>		
			@endif
			
		@endif
	</ul>

	<!-- Right Side Of Navbar -->
	<ul class="nav navbar-nav navbar-right">
		<!-- Authentication Links -->
		@if (!Auth::guest())
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
					{{ Auth::user()->name }} <span class="caret"></span>
				</a>

				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="{{ route('logout') }}"
							onclick="event.preventDefault();
									 document.getElementById('logout-form').submit();">
							Salir
						</a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
					</li>
				</ul>
			</li>
		@endif
	</ul>
</div>