<!DOCTYPE html>
<html>
    <head>
        <title>Novo Chamado</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="/css/sweetalert.css">
    </head>
    <body>
        <div class="container-fluid">
            <div class="content" style="margin-top:10px;">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Westwing</h3>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<ol class="breadcrumb">
								  <li><a href="/">Home</a></li>
								  <li><span>Novo Chamado</span></li>
								  	@if( $data['ajax'] )
									  <strong>Ajax</strong>
									@endif
								</ol>
							</div>
						</div>
						@if( $data['ajax'] )
							<form name="chamado" id="chamado" >
						@else
							<form name="chamado" id="chamado" method="get" action="/cadastro/save/">
						@endif
						<form name="chamado" id="chamado" >
							<input type="hidden" name="_token" value="{{ Session::token() }}">

							<div class="form-group">
								<label for="nome">Nome do cliente:</label>
								<input type="text" id="nome" name="nome" class="form-control observed" placeholder="Nome">
							</div>

							<div class="form-group">
								<label for="email">E-Mail:</label>
								<input type="text" id="email" name="email" class="form-control observed" placeholder="E-Mail">
							</div>
							<div id="info-np"></div>
							<div class="form-group">
								<label for="numero_pedido">Número do pedido:</label>
								<input type="text" id="numero_pedido" name="numero_pedido" class="form-control" placeholder="Pedido Nº">
							</div>

							<div class="form-group">
								<label for="titulo">Título:</label>
								<input type="text" id="titulo" name="titulo" class="form-control observer-submit" placeholder="Título do pedido">
							</div>

							<div class="form-group">
								<label for="observacao">Observação:</label>
								<textarea id="observacao" name="observacao" class="form-control observer-submit" placeholder="Breve resumo do chamado."></textarea>
							</div>
							
							<!-- hidden palace -->
							
							<input type="hidden" name="cliente_id" id="cliente_id">
							
							<input type="hidden" name="pedido_id" id="pedido_id">
							
							<!-- The end of hidden things -->

							<button type="submit" id="sendData" class="btn btn-primary">Enviar</button>			
						</form>
					</div>
				</div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="/js/sweetalert.min.js"></script>
		<!-- separei o meu javascript nesse arquivo -->
		@if( $data['ajax'] )
			<script src="/js/cadastro.js"></script>
		@else
			<script>
				$( document ).ready( function(){
					@if (count($errors) > 0)
						var html = '<ul style="list-style-type:none; margin:0; padding:0;">';
						
						@foreach ($errors->all() as $error)
							{!! 'html += "<li>' . $error . '</li>";' !!}
						@endforeach
					
						html += '</ul>';
						
						swal({
							title: "Os seguintes erros foram encontrados",
							text: html,
							type: "error",
							html:true,
						})
						
					@elseif ( $data['erro'] )
						swal({
							title: "Erro ao inserir chamado.",
							text: "O número de pedido já pertence à outro usuário.",
							type: "error",
							html:true,
						})
					
					
					@elseif ( $data['success'] )
						swal({
							title: "Parabéns!",
							text: "Chamado registrado com sucesso!",
							type: "success",
							html:true,
						})
					
					@endif
				});
			</script>
		@endif
    </body>
</html>
