<section class="container colar-rodape">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <?php $this->view("commons/alertas"); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-7">

                </div>
                <div class="col-sm-5">
                    <div id="descricao-anuncio">
                        <h3 class="font-bold"><?= $anuncio->titulo ?></h3>
                        <h1>R$ <?= $anuncio->preco ?></h1>
                        <h5><?= $this->lang->line("Quantidade_disponivel") ?>: <span class="font-bold"> <?= $anuncio->quantidade ?></span></h5>
                        <br>
                        <p class="text-justify" style=" word-wrap: break-word;"><?= $anuncio->descricao ?></p>
                        <form method="post" action="<?= base_url("carrinho_c/inserir/" . $anuncio->id) ?>">
                            <input type="number" name="quantidade" id="quantidade-compra" class="form-control" value="1">
                            <a class="btn btn-primary"  data-toggle="modal" data-target="#modal-confirmar"><?= $this->lang->line("Comprar_agora") ?></a>
                            <button type="submit" class="btn btn-info"><?= $this->lang->line("Adicionar_ao_carrinho") ?></button>
                        </form>
                        <hr>
                        <h3><?= $this->lang->line("Informacoes_do_vendedor") ?>:</h3>
                        <p class="text-justify"><span class="font-bold"><?= $this->lang->line("Nome") ?>:</span> <?= $anuncio->usuario->nome ?></p>
                        <p class="text-justify"><span class="font-bold"><?= $this->lang->line("Sobre") ?>:</span> <?= $anuncio->usuario->sobre ?></p>
                        <div class="clearfix">
                            <a class="pull-right btn btn-sm btn-warning" href="<?= base_url("perfil/" . $anuncio->usuario->id) ?>"><?= $this->lang->line("Ver_perfil") ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->view("transacao/modal_confirmacao"); ?>
