<nav class="navbar navbar-default navbar-static-top" style="background-color: transparent !important; border:none !important;">
	<div class="container">
		@if( Auth::guest() )
		<div class="navbar-header">
			<!-- Branding Image -->
			<a class="navbar-brand" href="{{ url('/') }}">
				<span>Westwing</span>
			</a>
		</div>
		@else
		<div class="navbar-brand">
			<span>
				<i class="glyphicon glyphicon-user"></i> {{ Auth::user()->name }}
			</span>
		</div>
		
		@endif
		<div class="collapse navbar-collapse" id="app-navbar-collapse">

			<!-- Right Side Of Navbar -->
			<ul class="nav navbar-nav navbar-right" style="font-size:16px !important;">
				<!-- Authentication Links -->
				@if (!Auth::guest())
					<li>
						<a href="{{ url('/logout') }}">
							<i class="glyphicon glyphicon-off"></i><span> Sair</span>
						</a>
					</li>
				@else
					<li>
						<a class="navbar-brand" href="{{ url('/') }}">
							<span> Voltar</span>
						</a>
					</li>
					<li>
						<a href="{{ url('/register') }}">
							<i class="glyphicon glyphicon-plus"></i> Cadastre-se!
						</a>
					</li>

				@endif
			</ul>
		</div>
	</div>
</nav>
@yield('content')
