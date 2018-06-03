<section class="container colar-rodape">
    <div class="row">
        <div class="col-sm-12">
            <h2>Carrinho</h2>
            <hr>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <?php $this->view("commons/alertas"); ?>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-carrinho">
                    <tbody>
                        <?php if (empty($this->session->carrinho)): ?>
                            <tr>
                                <td class="text-center">(<?= $this->lang->line("vazio") ?>)</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($this->session->carrinho as $item): ?>
                                <tr id="<?= $item->id ?>">
                                    <td class="raleway-bold td-nome-anuncio"><a class="link-anuncio" href="<?= base_url("visualizaranuncio?id=$item->id"); ?>"><?= $item->titulo ?></a></td>
                                    <td ><input class="pull-right form-control quantidade-produto" type="number" value="<?= $item->quantidade ?>"></td>
                                    <td class="td-preco">R$<?= $item->valor ?></td>
                                    <td><a title="Remover do carrinho" href="<?= base_url("carrinho_c/remover/" . $item->id); ?>" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php if (isset($total)): ?>
                <div class="row">
                    <div class="col-sm-12 text-right">
                        <p id="total" class="td-preco"><span class="raleway-bold"><?= $this->lang->line("total") ?>: </span><span id="valor-total"> R$<?= $total ?></span></p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="panel-footer">
            <div class="clearfix">
                <?php if (!empty($this->session->carrinho)): ?>
                    <button data-toggle="modal" data-target="#modal-confirmar" class="btn btn-sm btn-primary pull-right"><span class="fa fa-check"></span> <?= $this->lang->line("Comprar_tudo") ?></button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<script src="<?= base_url("assets/js/carrinho.js") ?>"></script>
<?php $this->view("carrinho/modal_confirmacao");?>
