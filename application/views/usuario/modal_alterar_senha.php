<div class="modal fade" id="modal-alterar-senha"  tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="POST" action="<?= base_url('usuario_c/alterar_senha') ?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Alterar senha</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class=" form-group col-sm-12">
                            <label for="senha_atual">Senha atual: </label>
                            <input type="password" name="senha_atual" id="senha_atual" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class=" form-group col-sm-12">
                            <label for="nova_senha">Nova senha: </label>
                            <input type="password" name="nova_senha" id="nova_senha" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class=" form-group col-sm-12">
                            <label for="confirm_nova_senha">Confirmação da nova senha: </label>
                            <input type="password" name="confirm_nova_senha" id="confirm_nova_senha" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><span class="fa fa-times"></span> Cancelar</button>
                    <button type="submit" class="btn btn-success"><span class="fa fa-check"></span> Confirmar</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>