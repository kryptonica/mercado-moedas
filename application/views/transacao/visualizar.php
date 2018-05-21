<section class="container colar-rodape">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="header_transacao" id_t=<?= $transacao->id ?> >Compra nº <?= $transacao->id ?> - <?= formatar_datetime($transacao->data_hora) ?></h2>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php $this->view("commons/alertas"); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="raleway-bold">Resumo da compra</h4>    
                </div>
                <div class="panel-body table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Valor total: </td>
                                <td>R$<?= $transacao->anuncio->preco * $transacao->quantidade ?></td>
                            </tr>
                            <tr>
                                <td>Forma de pagamento:</td>
                                <td>Boleto bancário</td>
                            </tr>
                            <tr>
                                <td>Status:</td>
                                <td><?= $transacao->aceita == 1 ? "Aceita" : "Aguardando aceitação do vendedor" ?></td>
                            </tr>
                        <tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="raleway-bold">Produto</h4>  
                </div>
                <div class="panel-body">
                    <div class="col-sm-3">
                        <img id="img-detalhe-compra" class="img-responsive" src="<?= base_url("assets/img/cripto_img.png"); ?>">
                    </div>
                    <div class="col-sm-9">
                        <a href="<?= base_url("visualizaranuncio?id=" . $transacao->anuncio->id); ?>" class="raleway-bold"><?= $transacao->anuncio->titulo ?></a>
                        <p class="text-justify"> 
                            <?= $transacao->anuncio->descricao ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if ($transacao->aceita == 0 && $this->session->usuario_id == $transacao->vendedor): ?>
        <div class="row">
            <div class="col-sm-12 text-center">
                <a class="btn btn-warning" href="<?= base_url("transacao_c/aceitar/" . $transacao->id); ?>"><span class="fa fa-check"></span> Aceitar transação</a>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($transacao->aceita != 0): ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="raleway-bold">Mensagens</h4>  
            </div>
            <div class="panel_msg">
            <?php foreach ($transacao->mensagens as $indice => $mensagem):
                
                $classe_ultimo = ($indice+1)==sizeof($transacao->mensagens)?"ultimo":"";
                ?>
                <div class="<?php echo 'panel-body '.$classe_ultimo ?>" msg=<?= $mensagem->id ?>   >
                    <?php if ($mensagem->usuario->id == $this->session->usuario_id): ?>
                        <div class="col-sm-6 col-sm-offset-6">
                            <div class="panel panel-success">
                                <div class="panel-heading text-right">
                                    <span class="raleway-bold">Você em <?= formatar_datetime($mensagem->data_hora) ?></span>
                                </div>
                                <div class="panel-body">
                                    <p class="text-justify raleway-medium">
                                        <?= $mensagem->mensagem ?>
                                    </p>
                                </div>
                                <?php if($mensagem->tipo == 1){ ?>

                                    <div class="panel-footer"> <button disabled type="button" class="btn btn-danger "><span class="fa fa-times-circle"></span> Rejeitar </button> <button disabled type="button" class="btn btn-success"><span class="fa fa-check-circle"></span> Confirmar </button> </div>

                                <?php } ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="col-sm-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <span class="raleway-bold"><?= $mensagem->usuario->nome ?> em <?= formatar_datetime($mensagem->data_hora) ?></span>
                                </div>
                                <div class="panel-body">
                                    <p class="text-justify raleway-medium">
                                        <?= $mensagem->mensagem ?>
                                    </p>
                                </div>
                                <?php if($mensagem->tipo == 1) {?>

                                    <div class="panel-footer"> <button  type="button" class="btn_rejeitar_dado btn btn-danger <?php echo "rejeitar-".$etapa[0]->etapa ?>"><span class="fa fa-times-circle"></span> Rejeitar </button> <button  type="button" class="btn_aceitar_dado btn btn-success <?php echo "aceitar-".$etapa[0]->etapa ?>"><span class="fa fa-check-circle"></span> Confirmar </button> </div>

                                <?php } ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; 
                $array_etapas = array("Confirmar Pagamento", "Confirmar envio","Enviar dados para confirmação de pagamento","Enviar dados para confirmação de envio" );
                if($transacao->comprador ==  $this->session->usuario_id && $etapa[0]->etapa == 1)
                    $etapa_atual = $array_etapas[ $etapa[0]->etapa+1 ];
                else if($transacao->vendedor ==  $this->session->usuario_id && $etapa[0]->etapa == 2)
                    $etapa_atual = $array_etapas[ $etapa[0]->etapa-1 ];
                else if($transacao->vendedor ==  $this->session->usuario_id && $etapa[0]->etapa == 1)
                    $etapa_atual = $array_etapas[ $etapa[0]->etapa-1 ];
                else if($transacao->comprador ==  $this->session->usuario_id && $etapa[0]->etapa == 2)
                    $etapa_atual = $array_etapas[ $etapa[0]->etapa-1 ];
            
            ?>
            </div>
            <div class="panel-footer">
                <div class="alert alert-info" role="alert">Etapa Atual: <span class="vl_etapa" etapa="<?php echo $etapa[0]->etapa; ?>"  > <?php echo $etapa_atual ?> </span> </div>
                <form id="enviar-mensagem" method="post" action="<?= base_url("transacao_c/adicionar_mensagem/" . $transacao->id); ?>">
                    <div class="form-group">
                        <textarea class="form-control" name="mensagem" id="mensagem"  required rows="5"></textarea>
                    </div>
                    <div class="text-center">
                        <button id="btn-enviar-mensagem" type="button" class="btn btn-primary"><span class="fa fa-send"></span> Enviar</button>
                        <button id="btn-confirmar-etapa" type="button" class="btn btn-success"><span class="fa fa-check-circle"></span> Confirmar Etapa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>
</section>


<script>
    function ultima_msg() {
        var objDiv = $('.panel_msg');
        var h = objDiv.get(0).scrollHeight;
        objDiv.animate({scrollTop: h});
    }

    ultima_msg();


    $("#btn-enviar-mensagem").click((event)=>{
        event.preventDefault();

        var form_data = $('#enviar-mensagem').serialize(); //Encode form elements for submission

        $.ajax({
        url : '<?=base_url()?>index.php/Transacao_c/adicionar_mensagem/'+<?= $transacao->id ?>,
        type: 'post',
        data : form_data,
        success: function(response) {
            $('#mensagem').val('');
            ultima_msg();
        },
        error: function (err1,err2,err3) { 
            
            console.log(err1);
            console.log(err2);
            console.log(err3);
            
        }

        });
    });
    
    $("#btn-confirmar-etapa").click((event)=>{
        event.preventDefault();

        var form_data = $('#enviar-mensagem').serialize(); //Encode form elements for submission

        $.ajax({
        url : '<?=base_url()?>index.php/Transacao_c/adicionar_mensagem/'+<?= $transacao->id ?>,
        type: 'post',
        data : form_data+ '&confirmacao=' + 1,
        success: function(response) {
            $('#mensagem').val('');
            ultima_msg();
        },
        error: function (err1,err2,err3) { 
            
            console.log(err1);
            console.log(err2);
            console.log(err3);
            
        }

        });
    });

    function checarMsg() {
		$id = $(".header_transacao").attr('id_t');
		$.ajax({
			type: "post",
			url: '<?=base_url()?>index.php/Transacao_c/checar',
			data: {id_transacao : $id},
			dataType: "json",
			success: function (response) {

                mensagens = response.transacao.mensagens;
                mensagens_html = $('.panel_msg>.panel-body');

                if( mensagens_html.length != mensagens.length ){
                    mensagens_html.remove();
                    
                    
                    mensagens.forEach( (mensagem,index) => {
                        $msg = $('<div class="panel-body" msg="'+mensagem.id+'">');
                        console.log(mensagem);
                        
                        if(mensagem.tipo == 0){

                            if( mensagem.usuario.id == response.id_usuario ){
                                
                                $msg.html('<div class="col-sm-6 col-sm-offset-6"> <div class="panel panel-success"> <div class="panel-heading text-right"> <span class="raleway-bold">Você em '+mensagem.data_hora+'</span> </div> <div class="panel-body"> <p class="text-justify raleway-medium">'+mensagem.mensagem+'</p></div></div> </div>');
                                
                            }else{
                                
                                $msg.html('<div class="col-sm-6"><div class="panel panel-info"><div class="panel-heading"><span class="raleway-bold">'+ mensagem.usuario.nome+'  em '+mensagem.data_hora+'</span></div><div class="panel-body"> <p class="text-justify raleway-medium">'+mensagem.mensagem+'</p> </div> </div> </div>');
                                
                            }
                            
                        }else{

                            if( mensagem.usuario.id == response.id_usuario ){
                                $msg.html('<div class="col-sm-6 col-sm-offset-6"> <div class="panel panel-success"> <div class="panel-heading text-right"> <span class="raleway-bold">Você em '+mensagem.data_hora+'</span> </div> <div class="panel-body"> <p class="text-justify raleway-medium">'+mensagem.mensagem+'</p></div> <div class="panel-footer"> <button disabled type="button" class="btn btn-danger"><span class="fa fa-times-circle"></span> Rejeitar </button> <button disabled type="button" class="btn btn-success"><span class="fa fa-check-circle"></span> Confirmar </button> </div> </div> </div>');
                                
                            }else{
                                
                                $msg.html('<div class="col-sm-6"><div class="panel panel-info"><div class="panel-heading"><span class="raleway-bold">'+ mensagem.usuario.nome+'  em '+mensagem.data_hora+'</span></div><div class="panel-body"> <p class="text-justify raleway-medium">'+mensagem.mensagem+'</p> </div>  <div class="panel-footer"> <button type="button" class="btn_rejeitar_dado btn btn-danger "><span class="fa fa-times-circle"></span> Rejeitar </button> <button type="button" class="btn_aceitar_dado btn btn-success"><span class="fa fa-check-circle"></span> Confirmar </button> </div>  </div> </div>');
                                
                            }

                        }

                        $('.panel_msg').append($msg);
                    });
                    
                    ultima_msg();
                    

                }
                
                



            },
            error: function (err1,err2,err3) { 
                console.log(err1);
                console.log(err2);
                console.log(err3);
                

             }
        });
        

	}
	
	setInterval(() => {
        checarMsg();
	}, 100);


</script>