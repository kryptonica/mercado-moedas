<div class="modal fade" id="modal-avaliacao"  tabindex="-1">
    <?php 
    
        
	$tipo_transacao = "";
	if($transacao->comprador == $this->session->usuario_id){
		$tipo_transacao = "comprador";
	}else if($transacao->vendedor == $this->session->usuario_id){
		$tipo_transacao = "vendedor";
	}
    
    ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <form  role="form" method="POST" action="<?= base_url("transacao_c/avaliar/". $transacao->id) ?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><?= $this->lang->line("Confirmar_compra") ?></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="tipo" id="tipo" value="<?php echo $tipo_transacao; ?>">
                        <div class="col-sm-12 form-group">
                            <label>Descrição</label>
                            <textarea required name="descricao_avaliacao" id="descricao_avaliacao" class="form-control" value="1"></textarea>
                        </div>
                        <div class="col-sm-12 form-group">
                            <label><?= $this->lang->line("De_nota") ?></label>
                            <select required name="nota_avaliacao" id="nota_avaliacao" class="form-control">
                                    <option selected disabled value="">Nota</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Avaliar</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>