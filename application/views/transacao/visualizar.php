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
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            </div>
            <div class="panel-footer">
                <form id="enviar-mensagem" method="post" action="<?= base_url("transacao_c/adicionar_mensagem/" . $transacao->id); ?>">
                    <div class="form-group">
                        <textarea class="form-control" name="mensagem" id="mensagem"  required rows="5"></textarea>
                    </div>
                    <div class="text-center">
                        <button id="btn-enviar-mensagem" type="button" class="btn btn-primary"><span class="fa fa-send"></span> Enviar</button>
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

    function checarMsg() {
		$id = $(".header_transacao").attr('id_t');
		$.ajax({
			type: "post",
			url: '<?=base_url()?>index.php/Transacao_c/checar',
			data: {id_transacao : $id},
			dataType: "json",
			success: function (response) {
				console.log(response);
                mensagens = response.transacao.mensagens;
                mensagens_html = $('.panel_msg>.panel-body');

                if( mensagens_html.length != mensagens.length ){
                    mensagens_html.remove();
                    
                    
                    mensagens.forEach( (mensagem,index) => {
                        $msg = $('<div class="panel-body" msg="'+mensagem.id+'">');
                        if( mensagem.usuario.id == response.id_usuario ){
                            
                            $msg.html('<div class="col-sm-6 col-sm-offset-6"> <div class="panel panel-success"> <div class="panel-heading text-right"> <span class="raleway-bold">Você em '+mensagem.data_hora+'</span> </div> <div class="panel-body"> <p class="text-justify raleway-medium">'+mensagem.mensagem+'</p></div></div> </div>');
                            
                        }else{
                            
                            $msg.html('<div class="col-sm-6"><div class="panel panel-info"><div class="panel-heading"><span class="raleway-bold">'+ mensagem.usuario.nome+'  em '+mensagem.data_hora+'</span></div><div class="panel-body"> <p class="text-justify raleway-medium">'+mensagem.mensagem+'</p> </div> </div> </div>');
                            
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