<div class="container-fluid fill">
    <div class='row'>

            <div id="secao-verde" class="col-xs-12">
            </div>
            <div id="secao-cinza"  class="col-xs-12"></div>
            <div id="container-form-cadastro"  class="col-xs-12">
                <div class="row">
                    <div class="msg-login col-md-6 col-md-offset-3 col-xs-12">
                        <h2>Cadastro</h2>
                    </div>
                    <div class="col-md-4 col-md-offset-4 col-xs-12 form-cadastro">
                    <?php $this->view('commons/alertas'); ?>
                        <form method="post" action="<?= base_url("cadastro_c/cadastrar"); ?>">
                            <div class="form-group">
                                <input type="text" class="form-control" name="nome" id="nome_cadastro" placeholder="Nome">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="email_cadastro" placeholder="E-mail">
                            </div>
                            <div class="form-group">
                                <input type="date" class="form-control" name="nascimento" id="nascimento_cadastro" placeholder="">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="senha" id="senha_cadastro" placeholder="Senha">
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" name="confirmar-senha" id="confirmar_senha" placeholder="Confirmar Senha">
                            </div>

                            <button type="submit" class="btn btn-primary">Enviar</button><br>
                        </form>
                    <div>
                </div>
            </div>
    </div>
        
    </div><!-- BUG -->