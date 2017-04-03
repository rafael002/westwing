/*
 * 	JAVASCRIPT PARA CADASTRO AJAX
 *	CONTRATE O RAFAEL! :)
 * */

$( function(){
	$("#numero_pedido").prop("disabled", true );
	$("#titulo").prop("disabled", true );
	$("#observacao").prop("disabled", true );
	$("#sendData").prop("disabled", true );

	//carreagamento dos dados verificando se e-mail esta cadastrado
	$("#email").blur(  function(){
		
		var email = $(this).val();
		
		if( email != "" ){
			
			$(this).prop("disabled", true );
		
			$("#cliente_id").val("");
			
			$.getJSON({
				
				url: "/cadastro/confirma/email/",
				
				data: { email },
				
				error: function( jqXHR, textStatus, errorThrown ){
					$("#info-cl").html('<div class="alert alert-danger">Erro: Erro ao obter dados do servidor. Por favor, tente novamente mais tarde.</div>');
				},
				
				complete: function( jqXHR, textStatus ){
					$("#email").prop("disabled", false );
				},
				
				success: function( data ){
					
					if( data.nome == null ){
						$("#nome").prop("disabled", false );
						$("#info-cl").html('<div class="alert alert-info">Este endereço de e-mail não está em uso. Cadastraremos um novo usuário.</div>');
					}
					else{
						$("#info-cl").html('<div class="alert alert-success">Este e-mail já está em uso. Aproveitaremos os dados armazenados.</div>');
						$("#nome").val( data.nome );
						$("#cliente_id").val( data.id );
						$("#nome").prop("disabled", true );
						$("#numero_pedido").prop("disabled", false);
					}
				},
			});
		}
		else{
			$("#info-cl").html("");
		}
	});
	
	//liberacao do campo numero pedido
	
	$(".observed").blur(function(){
		
		$("#numero_pedido").val("");
		
		$("#info-np").html("");
		
		if(( $("#nome").val() != "" ) && ( $("#email").val() != "")){	
			$("#numero_pedido").prop("disabled", false );
		}
		else{
			$("#numero_pedido").prop("disabled", true );
		}
	});
	
	//carregamento dados e validacao campo do numero do pedido
	$("#numero_pedido").blur( function(){
		
		var pedido = $(this).val();
		
		var cliente_id = $("#cliente_id").val();
		
		if( pedido != "" ){
			
			$(this).prop("disabled", true);
			
			$.getJSON({
				
				url: "/cadastro/confirma/pedido/", 
				
				data:{ pedido },
				
				error: function( jqXHR, textStatus, errorThrown ){
					$("#info-np").html('<div class="alert alert-danger">Erro: Erro ao obter dados do servidor. Por favor, tente novamente mais tarde.</div>');
				},
				
				complete: function( jqXHR, textStatus ){
					$("#numero_pedido").prop("disabled", false);
				},
				
				success: function( data ){
					
					if( data.id == null){
						$("#info-np").html('<div class="alert alert-success">Número de pedido disponivel.</div>');
						$("#titulo").prop("disabled", false )
						$("#observacao").prop("disabled", false );
					}
					else{
						if( data.cliente_id == cliente_id ){
							$("#info-np").html('<div class="alert alert-info">Aproveitando o pedido aberto deste usuário.</div>');
							$("#pedido_id").val(data.id);
							$("#titulo").prop("disabled", false );
							$("#observacao").prop("disabled", false );
						}
						else{
							$("#info-np").html('<div class="alert alert-danger">Erro: Este número de pedido já foi atribuido à outro usuário.</div>');
							$("#titulo").prop("disabled", true );
							$("#observacao").prop("disabled", true );
						}
					}
				},
			});
		}
		else{	
			$("#titulo").prop("disabled", true );
			$("#observacao").prop("disabled", true );
			$("#sendData").prop("disabled", true);
			$("#titulo").val("");
			$("#observacao").val("");
		}
		
	});
	//libera submit
	
	$(".observer-submit").blur(function(){
		
		if(( $("#titulo").val() != "" ) && ( $("#observacao").val() != "")){	
			$("#sendData").prop("disabled", false );
		}
		else{
			$("#sendData").prop("disabled", true );
		}
	});
	//validação final e envio para controller no laravel
	
		$("#sendData").click(function(e){
			
		e.preventDefault();
		
		$("#sendData").prop("disabled", true);
		$("#nome").prop("disabled", false);
			
			$.getJSON({
				url: "/cadastro/save/",
				
				data: $("#chamado").serialize(),
				
				complete: function ( jqXHR, textStatus ){
					$("#sendData").prop("disabled", false);
					$("#info-np").html("");
					$("#nome").val('');
					$("#email").val('');
					$("#numero_pedido").val('');
					$("#titulo").val('');
					$("#observacao").val('');
					$("#cliente_id").val('');
					$("#pedido_id").val('');
					$("#numero_pedido").prop("disabled", true );
					$("#titulo").prop("disabled", true );
					$("#observacao").prop("disabled", true );
					$("#sendData").prop("disabled", true );
				},
				
				error: function ( jqXHR, textStatus, errorThrown ){
					
					if( jqXHR.status === 422 ){
						var errors = jqXHR.responseJSON;
						var html = '<ul style="list-style-type:none; margin:0; padding:0;">';
						
						$("#info-cl").html('');
						$.each( errors, function( key, value ){
							html += '<li>' + value[0] + '</li>'; 
						});
						html += '</ul>';
						
						swal({
							title: "Os seguintes erros foram encontrados",
							text: html,
							type: "error",
							html:true,
						
						});
					}
				},
				
				success: function( response ){
					swal({
							title:"Parabéns",
							text: "O seu chamado foi registrado.",
							type: "success"
					});
				}
			});
		});
	
	});
