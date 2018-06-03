<div class="modal fade" id="modal-confirmar"  tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form  role="form" method="POST" action="<?= base_url("carrinho_c/finalizar_compra") ?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><?= $this->lang->line("Confirmar_compra") ?></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label><?= $this->lang->line("Selecione_carteira") ?>: </label>
                            <select name="carteira_destino" id="carteira_destino" class="form-control">
                                <?php foreach ($carteiras as $carteira): ?>
                                    <option value="<?= $carteira->id ?>"><?= $this->lang->line("Carteira_de") ?> <?= $carteira->moeda->nome?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?= $this->lang->line("Cancelar") ?></button>
                    <button type="submit" class="btn btn-primary"><?= $this->lang->line("Comprar") ?></button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>