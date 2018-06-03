<div class="modal fade" id="modal-remover-anuncio"  tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="POST" action="<?= base_url('anuncio_c/remover_anuncio') ?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><?= $this->lang->line("MSG_Remover_anuncio") ?></h4>
                </div>
                <div class="modal-body">
                <input type="hidden" class="form-control" name="id" id="id_anuncio" value="<?php echo $anuncio->id ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><span class="fa fa-times"></span> <?= $this->lang->line("Cancelar") ?></button>
                    <button type="submit" name="confirm-delete" class="btn btn-danger"><span class="fa fa-check"></span> <?= $this->lang->line("Confirmar") ?></button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>