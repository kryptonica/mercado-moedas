<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Aplicação destinada ao comércio peer-to-peer de criptomoedas">
	<meta name="author" content="Matheus Coqueiro Andrade, João Vitor Ferraz, Wali Queiroz Santos, Rodrigo Silva Lima, Carlos Hatus Damasceno, Leandro Araújo e Pedro Maioli">
	<title>Mercado de Moedas</title>
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
	<!-- <link rel="stylesheet" type="text/css" href="//cloud.typography.com/746852/739588/css/fonts.css" /> -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
	crossorigin="anonymous">
	<link rel="stylesheet" href="<?= base_url('assets/css/timeline.css') ?>">


	<script src="<?= base_url('assets/js/jquery-3.2.1.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/lang.js') ?>"></script>
</head>

<body>
	<script>
		$base_url = <?php echo "'".base_url()."'"; ?>;
	</script>
	<header>
		<nav class="navbar navbar-default">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<a class="navbar-brand" href="<?= base_url("/"); ?>">Kriptonica</a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <div class="dropdown dropdown_lang">
						<button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
                            <?php 
                                if($this->session->lang == 0){
                                    echo "PT-BR";
                                }else{
                                    echo "EN";
                                }
                            ?>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li class="opcao_lang" value="1" >
								<a href="#">English</a>
							</li>
							<li class="opcao_lang" value="0" >
								<a href="#">Português</a>
							</li>
						</ul>
					</div>
					<?php if ($this->session->logado): ?>
					<form class="navbar-form navbar-left form_busca" method="post" action="<?= base_url("buscaranuncio") ?>">
						<div class="form-group">
							<input type="text" class="form-control search" name="texto_busca" placeholder="<?php echo $this->lang->line('Busca'); ?>"
							required>
							<button type="submit" class="btn btn-primary btn_header" style="display:none;">
								<span class="fa fa-filter"></span> Filtrar </button>
						</div>
					</form>
					
					<div class="navbar-right">
						<!--<span class="fa fa-user-circle" style="font-size: 30px;    padding:  10px;"></span>-->
						<ul class="nav navbar-nav">
							<li>
								<a href="<?= base_url("buscaranuncio?tudo=true"); ?>">
									<span class="fab fa-bitcoin"></span>
									<?php echo $this->lang->line('Ultimos_anuncios'); ?>
								</a>
							</li>
							<li>
								<a href="<?= base_url("carrinho"); ?>">
									<span class="fa fa-shopping-cart"></span>
									<?php echo $this->lang->line('Carrinho'); ?> (
									<?= quantidade_carrinho() ?>) </a>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<span class="fa fa-user-circle"></span>
									<?= $this->session->nome ?>
										<span class="fa fa-chevron-down"></span>
								</a>
								<ul class="dropdown-menu">
									<li>
										<a href="<?= base_url("perfil/" . $this->session->usuario_id); ?>">
											<span class="fa fa-user-circle"></span>
											<?php echo $this->lang->line('Perfil'); ?>
										</a>
									</li>
									<li>
										<a href="<?= base_url("meusanuncios"); ?>">
											<span class="fa fa-bullhorn"></span>
											<?php echo $this->lang->line('Meus_anuncios'); ?>
										</a>
									</li>
									<li>
										<a href="<?= base_url("minhas-compras"); ?>">
											<span class="fa fa-shopping-bag"></span>
											<?php echo $this->lang->line('Minhas_compras'); ?>
										</a>
									</li>
									<li>
										<a href="<?= base_url("minhas-vendas"); ?>">
											<span class="fa fa-tag"></span>
											<?php echo $this->lang->line('Minhas_vendas'); ?>
										</a>
									</li>
									<li>
										<a href="<?= base_url("editar"); ?>">
											<span class="fa fa-cog"></span>
											<?php echo $this->lang->line('Editar_perfil'); ?>
										</a>
									</li>
									<li>
										<a href="<?= base_url("login_c/logout"); ?>">
											<span class="fa fa-sign-out-alt"></span>
											<?php echo $this->lang->line('Sair'); ?>
										</a>
									</li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<span class="fa fa-bell"></span> (
									<b class="total_notificacoes">0</b>)</a>
								<ul class="dropdown-menu notify-drop">
									<div class="notify-drop-title">
										<div class="row">
											<div class="col-md-6 col-sm-6 col-xs-6">
												<?php echo $this->lang->line('Voce_tem_('); ?>
												<b class="total_notificacoes">0</b>
												<?php echo $this->lang->line(')_nao_lidas'); ?>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6 text-right">
												<a href="" class="rIcon allRead" data-tooltip="tooltip" data-placement="bottom" title="tümü okundu.">
													<i class="fa fa-dot-circle-o"></i>
												</a>
											</div>
										</div>
									</div>
									<div class="drop-content">
										<!--<Notificações aparecerão aqui>-->
									</div>
									<!--                                            <div class="notify-drop-footer text-center">
                                                                                            <a href=""><i class="fa fa-eye"></i> Tümünü Göster</a>
                                                                                        </div>-->
								</ul>
							</li>
						</ul>
					</div>
					<?php else: ?>
					<div class="navbar-right">
						<ul class="nav navbar-nav">
							<li class="<?= ocultar(["usuario_c"]) ?>">
								<a href="<?= base_url("cadastro"); ?>">
									<span class="fa fa-user-plus"></span>
									<?php echo $this->lang->line('Cadastre-se'); ?>
								</a>
							</li>
							<li class="<?= ocultar(["login_c"]) ?>">
								<a href="<?= base_url("login"); ?>">
									<span class="fa fa-sign-in-alt"></span>
									<?php echo $this->lang->line('Entre'); ?>
								</a>
							</li>
						</ul>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<!-- /.container-->
		</nav>
	</header>
