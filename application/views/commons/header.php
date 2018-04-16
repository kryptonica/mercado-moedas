<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Aplicação destinada ao comércio peer-to-peer de criptomoedas">
        <meta name="author" content="Matheus Coqueiro Andrade">
        <title>Mercado de Moedas</title>
        <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
        <link rel="stylesheet" type="text/css" href="//cloud.typography.com/746852/739588/css/fonts.css" />
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>

        <header>
            <nav class="navbar navbar-default">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">Kriptonica</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                        <form class="navbar-form navbar-left">
                            <div class="form-group">
                                <input type="text" class="form-control search" placeholder="Search">
                            </div>
                        </form>
                        <?php if ($this->session->logado): ?>
                            <div class="navbar-right">
                                <span class="fa fa-user-circle" style="font-size: 30px;    padding:  10px;"></span>
                                <ul class="nav navbar-nav">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $this->session->nome ?><span class="fa fa-chevron-down"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?= base_url("login_c/logout");?>"><span class="fa fa-sign-out-alt"></span>Sair</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </header>