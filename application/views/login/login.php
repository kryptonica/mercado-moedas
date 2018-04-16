<div class="container-fluid fill">

    <div class='row'>
        <div id="secao-verde" class="col-xs-12">
        </div>
        <div id="secao-cinza"  class="col-xs-12"></div>
        <div id="container-form-login"  class="col-xs-12">
            <div class="row">
                <div class="msg-login col-md-6 col-md-offset-3 col-xs-12">
                    <span class="fa fa-user-circle" style="font-size: 60px;    padding:  10px;"></span>
                    <p>Olá! Para continuar, informe seus dados:</p>
                </div>
                <div class="col-md-4 col-md-offset-4 col-xs-12 form-login">
                    <?php $this->view('commons/alertas'); ?>
                    <form method="post" action="<?= base_url("login_c/autenticar"); ?>">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-mail">
                        </div>
                        <div class="form-group">
                            <input type="password" name="senha" class="form-control" id="exampleInputPassword1" placeholder="Senha">
                        </div>
                        <button type="submit" class="btn btn-primary">Entrar</button><br>
                        <a href="<?= base_url("cadastro"); ?>">Criar minha conta</a>
                    </form>
                    <div>
                    </div>
                </div>
            </div>

        </div><!-- BUG -->