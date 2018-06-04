$( function(){
	
    checar_etapa(1);
	function timeline_etapa(width_vl) {
        if(width_vl!=0){

            width_vl = width_vl + "%";
            
            $(".timeline-horizontal").animate({
                width: width_vl
            }, 1500);
            
        }
	}


	function ultima_msg() {
		var objDiv = $('.wrap_msg');
		var h = objDiv.get(0).scrollHeight;
		objDiv.animate({
			scrollTop: h
		});
	}

	ultima_msg();


	$("#btn-enviar-mensagem").click((event) => {
		event.preventDefault();

		var form_data = $('#enviar-mensagem').serialize(); //Encode form elements for submission

		$.ajax({
			url: $base_url+'index.php/Transacao_c/adicionar_mensagem/' + transacao_id,
			type: 'post',
			data: form_data,
			success: function (response) {
				$('#mensagem').val('');
				ultima_msg();
			},
			error: function (err1, err2, err3) {

				console.log(err1);
				console.log(err2);
				console.log(err3);

			}

		});
	});

	$("#btn-confirmar-etapa").click((event) => {
		event.preventDefault();

		var form_data = $('#enviar-mensagem').serialize(); //Encode form elements for submission

		$.ajax({
			url: $base_url+'index.php/Transacao_c/adicionar_mensagem/' +transacao_id,
			type: 'post',
			data: form_data + '&confirmacao=' + 1,
			success: function (response) {
				ultima_msg();
			},
			error: function (err1, err2, err3) {

				console.log(err1);
				console.log(err2);
				console.log(err3);

			}

		});
	});

	$(".btn_aceitar_dado").click((event) => {
		confirmar(event);
	});
	
	$(".btn_rejeitar_dado").click((event) => {
		
		rejeitar(event);
		
	});


	function confirmar(event) { 
		event.preventDefault();
		$msg = $(event.currentTarget).parent().parent().parent().parent().attr('msg');
		console.log($msg);
		
		$.ajax({
			url: $base_url+'index.php/Transacao_c/confirmar_mensagem/' +transacao_id,
			type: 'post',
			data: {
				tipo:"confirmar",
				status: status_atual,
				msg_id: $msg,
				etapa: etapa_atual
			},
			dataType: 'json',
			success: function (response) {
				//console.log("TEste:");
				//console.log(response);
				
				checarMsg(1);
				checar_etapa();
				ultima_msg();
			},
			error: function (err1, err2, err3) {

				console.log(err1);
				console.log(err2);
				console.log(err3);

			}

		});
	}


	function rejeitar(event) { 
		event.preventDefault();

		$msg = $(event.currentTarget).parent().parent().parent().parent().attr('msg');
		console.log('ID:'+$msg);
		$.ajax({
			url: $base_url+'index.php/Transacao_c/confirmar_mensagem/' + transacao_id,
			type: 'post',
			data: {
				tipo:"rejeitar",
				status: status_atual,
				msg_id: $msg,
				etapa: etapa_atual
			},
			dataType: 'json',
			success: function (response) {
				checarMsg(1);
				checar_etapa();
				ultima_msg();
			},
			error: function (err1, err2, err3) {

				console.log(err1);
				console.log(err2);
				console.log(err3);

			}

		});
	}

	function checar_etapa($forcado) {
		$.ajax({
			type: "post",
			url: $base_url+'index.php/Transacao_c/checar_etapa',
			data: {
				id_transacao: transacao_id
			},
			dataType: "json",
			success: function (response) {
                //console.log(response);
				
				$comprador_b = $comprador == $usuario_id;
				$vendedor_b = $vendedor == $usuario_id;

				etapa = response.transacao[0].etapa;
				etapa_atual = etapa;
				status = response.transacao[0].status;
				console.log("PQP");
				
				

				if(etapa == 3){
					$('#btn-confirmar-etapa').fadeOut();
					$('#btn-finalizar').fadeIn();
				}

				
				if(status != status_atual){
					console.log("Status Checar");
					checarMsg(1);
				}
                

				if(status != status_atual || $forcado){
					status_atual = status;
					
					width = 0;
					if (etapa > 1) {
						width = 28 * (etapa - 1);
					}
					
					timeline_etapa(width);
					
					for (let index = 1; index <= etapa; index++) {
						
							
							if (index == etapa)
							$(".etapa" + index).addClass('info');
							else {
								$(".etapa" + index).addClass('success');
								$(".etapa" + index).removeClass('info');
							}
						
					}
				
					
					$disabled = (etapa==1&&$vendedor_b)||(etapa==2&&$comprador_b)?true:false;
					console.log("Etapa: "+etapa+" id_user: "+$usuario_id+" vendedor: "+$vendedor+" comprador: "+$comprador+" vendedorb: "+$vendedor_b+" compradorb: "+$comprador_b+" disabled: "+$disabled);

					$('#btn-confirmar-etapa').attr('disabled', $disabled);

					
					
					
				}
			}
		});


	}


	function checarMsg($forcado) {
		$id = $(".header_transacao").attr('id_t');
		
		$.ajax({
			type: "post",
			url: $base_url+'index.php/Transacao_c/checar',
			data: {
				id_transacao: $id
			},
			dataType: "json",
			success: function (response) {

				mensagens = response.transacao.mensagens;
				mensagens_html = $('.panel_msg>.panel-body');
				badges = $('.panel_msg>.timeline-badge');

				if (mensagens_html.length != mensagens.length || $forcado) {
					mensagens_html.remove();
					badges.remove();


					mensagens.forEach((mensagem, index) => {
						$msg = $('<div class="panel-body" msg="' + mensagem.id + '">');
						$badge = $('<div class="timeline-badge">');
						if (mensagem.tipo == 0) {
							$badge.append($('<i class="fa fa-envelope">'));
							if (mensagem.usuario.id == response.id_usuario) {

								$msg.html(
									'<div class="col-sm-6 col-sm-offset-6"> <div class="panel panel-info"> <div class="panel-heading text-right"> <span class="raleway-bold">'+$lang.Voce_em+
									mensagem.data_hora + '</span> </div> <div class="panel-body"> <p class="text-justify raleway-medium">' +
									mensagem.mensagem + '</p></div></div> </div>');

							} else {

								$msg.html(
									'<div class="col-sm-6"><div class="panel panel-info"><div class="panel-heading"><span class="raleway-bold">' +
									mensagem.usuario.nome + $lang.em + mensagem.data_hora +
									'</span></div><div class="panel-body"> <p class="text-justify raleway-medium">' + mensagem.mensagem +
									'</p> </div> </div> </div>');

							}

						} else {
							panel = "";
                            disabled = "";
                            //console.log("tipo:"+mensagem.tipo);
                            
							if (mensagem.tipo == 2) {
								disabled = "disabled";
								panel = "success";
								$badge.addClass('badge-success');
								$badge.append($('<i class="fa fa-check-circle">'));
							} else if (mensagem.tipo == -1) {
								disabled = "disabled";
								panel = "danger";
								$badge.addClass('badge-danger');
								$badge.append($('<i class="fa fa-times-circle">'));
							} else {
								panel = "info";
								$badge.append($('<i class="fa fa-receipt">'));
							}

							if (mensagem.usuario.id == response.id_usuario) {
								$msg.html('<div class="col-sm-6 col-sm-offset-6"> <div class="panel panel-' + panel +
									'"> <div class="panel-heading text-right"> <span class="raleway-bold">'+$lang.Voce_em  + mensagem.data_hora +
									'</span> </div> <div class="panel-body"> <p class="text-justify raleway-medium">' + mensagem.mensagem +
									'</p></div> <div class="panel-footer"> <button disabled type="button" class="btn btn-danger"><span class="fa fa-times-circle"></span> '+$lang.Rejeitar+' </button> <button disabled type="button" class="btn btn-success"><span class="fa fa-check-circle"></span> '+$lang.Confirmar+' </button> </div> </div> </div>'
								);

							} else {

								$msg.html('<div class="col-sm-6"><div class="panel panel-' + panel +
									'"><div class="panel-heading"><span class="raleway-bold">' + mensagem.usuario.nome + $lang.em + mensagem.data_hora +
									'</span></div><div class="panel-body"> <p class="text-justify raleway-medium">' + mensagem.mensagem +
									'</p> </div>  <div class="panel-footer"> <button ' + disabled +
									' type="button" class="btn_rejeitar_dado btn btn-danger "><span class="fa fa-times-circle"></span> '+$lang.Rejeitar+' </button> <button ' +
									disabled +
									' type="button" class="btn_aceitar_dado btn btn-success"><span class="fa fa-check-circle"></span> '+$lang.Confirmar+' </button> </div>  </div> </div>'
								);

							}

						}
						$('.panel_msg').append($badge);
						$('.panel_msg').append($msg);
					});

					ultima_msg();
					$(".btn_aceitar_dado").click((event) => {
						confirmar(event);
					});
					
					$(".btn_rejeitar_dado").click((event) => {
						
						rejeitar(event);
						
					});


				}





			},
			error: function (err1, err2, err3) {
				console.log(err1);
				console.log(err2);
				console.log(err3);


			}
		});


	}

	setInterval(() => {
		checarMsg();
		checar_etapa();
	}, 500);


});