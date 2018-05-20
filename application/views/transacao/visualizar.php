<section class="container colar-rodape">
    <div class="row">
        <div class="col-sm-12">
            <h2>Compra nº <?= $transacao->id ?> - <?= formatar_datetime($transacao->data_hora) ?></h2>
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
            <?php foreach ($transacao->mensagens as $mensagem): ?>
                <div class="panel-body">
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
            <div class="panel-footer">
                <form id="enviar-mensagem" method="post" action="<?= base_url("transacao_c/adicionar_mensagem/" . $transacao->id); ?>">
                    <div class="form-group">
                        <textarea class="form-control" name="mensagem" id="mensagem"  required rows="5"></textarea>
                    </div>
                    <div class="text-center">
                        <button id="btn-enviar-mensagem" type="submit" class="btn btn-primary"><span class="fa fa-send"></span> Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>
</section>