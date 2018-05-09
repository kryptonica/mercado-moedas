<section class="container colar-rodape">
    <div class="row">
        <div class="col-sm-12">
            <h2>Editar perfil</h2>
            <hr>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="clearfix">
                <button class="btn btn-sm btn-warning pull-right" data-toggle="modal" data-target="#modal-alterar-senha"><span class="fa fa-lock"></span> Alterar senha</button>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <?php $this->view("commons/alertas"); ?>
                </div>
            </div>
            <form id="form-editar" method="post" action="<?= base_url("usuario_c/atualizar"); ?>">
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="nome" class="lb">Nome: </label>
                        <input required type="text" class="form-control radius-input" name="nome" id="nome" value="<?= $usuario->nome ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="email" class="lb">E-mail: </label>
                        <input required type="email" class="form-control radius-input" name="email" id="email" value="<?= $usuario->email ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="nascimento" class="lb">Data de nascimento: </label>
                        <input required type="date" class="form-control radius-input" name="nascimento" id="nascimento" value="<?= $usuario->dataNascimento ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="sobre" class="lb">Sobre mim: </label>
                        <textarea class="form-control radius-textarea" name="sobre" id="sobre" rows="5"><?= $usuario->sobre ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <!--<button class="btn btn-warning pull-left"><span class="fa fa-arrow-left"></span> Cancelar</button>-->
                        <button type="submit" class="btn btn-success"><span class="fa fa-check"></span> Salvar alterações</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<?php $this->view("usuario/modal_alterar_senha"); ?>