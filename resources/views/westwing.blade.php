<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    </head>
    <body>
		@extends('layouts.app')

		@section('content')
        <div class="container">
			<div class="text-center" style="margin-top:100px;">
				<div class="row">
					<div class="text-center">
						<div class="col-md-12">
							<img src="westwing.png">
						</div>
						<div class="col-md-12" style="margin-top:25px;  color:##95a5a6;">
							<h2 style="font-family:Lato; font-weight:600;">Sistema de chamados</h>
						</div>
					</div>
					<div class="content">
						<div class="col-md-12" style="margin-top:25px;">
							<div class="btn-group btn-group-justified" role="group" aria-label="...">
							  <div class="btn-group" role="group">
								<a href="/relatorio/">
									<button type="button" class="btn btn-default">Relatório</button>
								</a>
							  </div>
							  
							  <div class="btn-group" role="group">
								<a href="/chamado/novo/simples">
									<button type="button" class="btn btn-default">Novo Chamado</button>
								</a> 
							  </div>
							  
							  <div class="btn-group" role="group">
								<a href="/chamado/novo/">
									<button type="button" class="btn btn-default">Novo Chamado <strong>Ajax</strong></button>
								</a>
							  </div>
							</div>
						</div>
					</div>
				</div>  
            </div>
        </div>
       @endsection
    </body>
</html>
