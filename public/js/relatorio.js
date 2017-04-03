/*
 * 	JAVASCRIPT PARA RELATORIO
 *	CONTRATE O RAFAEL! :)
 * */
 
$( function(){
	
	$(".fim").prop("disabled", true);
	
	$(".btn-detail").on('click', function(){
		
		var id = $(this).attr('id');
		
		$("#"+id).prop("disabled", true);
		
		$.getJSON({
			url: "/relatorio/detalhe/",
			
			data: { id },
			
			
			complete: function( jqXHR, textStatus ){
				 $("#"+id).prop("disabled", false);
			},
			
			success: function( data ){
				$("#cliente").html( data.nome );
				$("#email").html( data.email );
				$("#data").html( data.created_at );
				$("#pedido").html( data.numero_pedido );
				$("#titulo").html( data.titulo );
				$("#observacao").html( data.observacao );
				
				$(".fim").attr("id", data.id );
				$(".fim").prop("disabled", false);
			}
		});
	});
	
	

	//SWEET ALERT WARNING
	
	$('.fim').on('click', function(){
		
		var id = $(".fim").attr('id');
		
		swal({
				title: "Atenção",
				text: "O chamado não poderá ser recuperado.",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor:"#DD6B55",
				confirmButtonText:"Sim, deletar.",
				cancelButtonText:"Cancelar",
				closeOnConfirm: false,
				closeOnCancel:false,
				showLoaderOnConfirm: true,
			},
			function( isConfirm ){
				if( isConfirm ){
					swal({ 
						title: "Processando",
						text: "Por favor, aguarde...",
						type: "info" ,
						closeOnConfirm: false,
					},
					$.getJSON({
						url: "/relatorio/chamado/deletar/",
						
						data: { id },
						
						error: function( jqXHR, textStatus ){
							 swal({
								title: "Erro ao deletar chamado",
								text: "Por favor, tente novamente mais tarde.",
								type: "error",
							 });
						},
						
						success: function( data ){
							$("#frame_"+id).remove();
							
							$("#cliente").html( "" );
							$("#email").html( "" );
							$("#data").html( "" );
							$("#pedido").html( "" );
							$("#titulo").html( "" );
							$("#observacao").html( "" );
							
							$(".fim").attr("id", "" );
							$(".fim").prop("disabled", true);
							
							 swal({
								title: "Sucesso",
								text: "O chamado foi apagado!.",
								type: "success",
							 });
						}
					}));
				}
				else{
					swal( {
						title: "Cancelado.",
						text: "O chamado não foi apagado.",
						type: "error",
					});
				}
		});
		
	});
	
});
