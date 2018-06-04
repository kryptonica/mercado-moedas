<section class="container colar-rodape">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="header_transacao" id_t=<?= $transacao->id ?> ><?= $this->lang->line("Compra") ?> nº
                <?= $transacao->id ?> -
                <?= formatar_datetime($transacao->data_hora) ?>
            </h2>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php $this->view("commons/alertas"); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="raleway-bold"><?= $this->lang->line("Resumo_da_compra") ?></h4>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><?= $this->lang->line("Quantidade") ?>: </td>
                                <td><?= $transacao->quantidade ?></td>
                            </tr>
                            <tr>
                                <td><?= $this->lang->line("Valor_total") ?>: </td>
                                <td>R$
                                    <?= $transacao->anuncio->preco * $transacao->quantidade ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?= $this->lang->line("Forma_de_pagamento") ?>:</td>
                                <td>Boleto bancário</td>
                            </tr>
                            <tr>
                                <td>Status:</td>
                                <td>
                                    <?= $transacao->aceita == 1 ? $this->lang->line("Aceita") : $this->lang->line("Aguardando_aceitacao") ?>
                                </td>
                            </tr>
                        <tbody>
                    </table>
                </div>
            </div>

		</div>
		<div class="col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="raleway-bold"><?= $this->lang->line("Produto") ?></h4>
				</div>
				<div class="panel-body">
					<div class="col-sm-3">
						<img id="img-detalhe-compra" class="img-responsive" src="<?= base_url("assets/img/cripto_img.png "); ?>">
					</div>
					<div class="col-sm-9">
						<a href="<?= base_url("visualizaranuncio?id=" . $transacao->anuncio->id); ?>" class="raleway-bold">
							<?= $transacao->anuncio->titulo ?>
						</a>
						<p class="text-justify">
							<?= $transacao->anuncio->descricao ?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php if ($transacao->aceita == 0 && $this->session->usuario_id == $transacao->vendedor): ?>
	<div class="row">
		<div class="col-sm-12 text-center">
			<a class="btn btn-warning" href="<?= base_url("transacao_c/aceitar/" . $transacao->id); ?>">
				<span class="fa fa-check"></span> <?= $this->lang->line("Aceitar_transacao") ?></a>
		</div>
	</div>
	<?php endif; ?>
	<?php if ($transacao->aceita != 0 && ( ($etapa[0]->status < 2 && $this->session->usuario_id == $transacao->comprador) || ($etapa[0]->status < 3 && $this->session->usuario_id == $transacao->vendedor) ) ): ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="raleway-bold"><?= $this->lang->line("Mensagens") ?></h4>
		</div>

            <div class="wrap_msg">
                <div class="panel_msg">
                    <?php
                    foreach ($transacao->mensagens as $indice => $mensagem):
                        $tipo_panel = $mensagem->tipo == -1 ? "danger" : "info";
                        $tipo_panel = $mensagem->tipo == 2 ? "success" : $tipo_panel;
                        $classe_ultimo = ($indice + 1) == sizeof($transacao->mensagens) ? "ultimo" : "";
                        ?>
        <?php if ($mensagem->tipo == 1) { ?>
                            <div class="timeline-badge">
                                <i class="fa fa-receipt"></i>
                            </div>
        <?php } else if ($mensagem->tipo == -1) { ?>
                            <div class="timeline-badge badge-danger">
                                <i class="fa fa-times-circle"></i>
                            </div>
        <?php } else if ($mensagem->tipo == 2) { ?>
                            <div class="timeline-badge badge-success">
                                <i class="fa fa-check-circle"></i>
                            </div>
        <?php } else { ?>
                            <div class="timeline-badge">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <?php } ?>
                        <div class="<?php echo 'panel-body panel-content-msg ' . $classe_ultimo ?>" msg=<?= $mensagem->id ?> >
        <?php if ($mensagem->usuario->id == $this->session->usuario_id): ?>

                                <div class="col-sm-6 col-sm-offset-6 <?php echo " panel-etapa- " . $etapa[0]->etapa ?>">
                                    <div class="panel panel-<?php echo $tipo_panel; ?>">
                                        <div class="panel-heading text-right">
                                            <span class="raleway-bold"><?= $this->lang->line("Voce_em") ?>
            <?= formatar_datetime($mensagem->data_hora) ?>
                                            </span>
                                        </div>
                                        <div class="panel-body">
                                            <p class="text-justify raleway-medium">
            <?= $mensagem->mensagem ?>
                                            </p>
                                        </div>
            <?php if ($mensagem->tipo != 0) { ?>

                                            <div class="panel-footer">
                                                <button disabled type="button" class="btn_rejeitar_dado btn btn-danger ">
                                                    <span class="fa fa-times-circle"></span> <?= $this->lang->line("Rejeitar") ?> </button>
                                                <button disabled type="button" class="btn btn-success btn_aceitar_dado">
                                                    <span class="fa fa-check-circle"></span> <?= $this->lang->line("Confirmar") ?> </button>
                                            </div>

            <?php } ?>

                                    </div>
                                </div>
        <?php else: ?>
                                <div class="col-sm-6 <?php echo " panel-etapa- " . $etapa[0]->etapa ?>">
                                    <div class="panel panel-<?php echo $tipo_panel; ?>">
                                        <div class="panel-heading">
                                            <span class="raleway-bold">
                                                <?= $mensagem->usuario->nome ?> <?= $this->lang->line("em") ?>
            <?= formatar_datetime($mensagem->data_hora) ?>
                                            </span>
                                        </div>
                                        <div class="panel-body">
                                            <p class="text-justify raleway-medium">
            <?= $mensagem->mensagem ?>
                                            </p>
                                        </div>
            <?php if ($mensagem->tipo == 1) { ?>

                                            <div class="panel-footer">
                                                <button type="button" class="btn_rejeitar_dado btn btn-danger">
                                                    <span class="fa fa-times-circle"></span> <?= $this->lang->line("Rejeitar") ?> </button>
                                                <button type="button" class="btn_aceitar_dado btn btn-success <?php echo " aceitar-
								" . $etapa[0]->etapa ?>">
                                                    <span class="fa fa-check-circle"></span> <?= $this->lang->line("Confirmar") ?> </button>
                                            </div>

            <?php } else if ($mensagem->tipo != 0 && $mensagem->tipo != 1) { ?>

                                            <div class="panel-footer">
                                                <button disabled type="button" class="btn btn-danger ">
                                                    <span class="fa fa-times-circle"></span> <?= $this->lang->line("Rejeitar") ?> </button>
                                                <button disabled type="button" class="btn btn-success">
                                                    <span class="fa fa-check-circle"></span> <?= $this->lang->line("Confirmar") ?> </button>
                                            </div>

							<?php }	 ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
				<?php endforeach; 
                $array_etapas = array("Confirmar Pagamento", "Confirmar envio","Enviar dados para confirmação de pagamento","Enviar dados para confirmação de envio" );
               # var_dump($etapa);
                if($transacao->comprador ==  $this->session->usuario_id && $etapa[0]->etapa == 1)
                    $etapa_atual = $array_etapas[ $etapa[0]->etapa-1 ];
                else if($transacao->vendedor ==  $this->session->usuario_id && $etapa[0]->etapa == 2)
                    $etapa_atual = $array_etapas[ $etapa[0]->etapa-1 ];
                else if($transacao->vendedor ==  $this->session->usuario_id && $etapa[0]->etapa == 1)
                    $etapa_atual = $array_etapas[ $etapa[0]->etapa-1 ];
                else if($transacao->comprador ==  $this->session->usuario_id && $etapa[0]->etapa == 2)
                    $etapa_atual = $array_etapas[ $etapa[0]->etapa-1 ];
                
                ?>
			</div>
		</div>
		<div class="panel-footer">
			<!-- <div class="alert alert-info" role="alert">Etapa Atual: <span class="vl_etapa" etapa="<?php echo $etapa[0]->etapa; ?>"  > <?php echo $etapa_atual ?> </span> </div> -->

		<div class="timeline-horizontal-container">						
			<ul class="timeline timeline-horizontal">
				<li class="timeline-item">
					<div class="timeline-badge2 info etapa1">
						<i class=" ">1</i>
					</div>
					<div class="timeline-panel">
						<div class="timeline-heading">
							<h4 class="timeline-title"><?= $this->lang->line("Etapa1_titulo") ?></h4>
						</div>
						<div class="timeline-body">
							<p><?= $this->lang->line("Etapa1_descricao") ?>.</p>
						</div>
					</div>
				</li>
				<li class="timeline-item">
					<div class="timeline-badge2 etapa2">
						<i class=" ">2</i>
					</div>
					<div class="timeline-panel">
						<div class="timeline-heading">
							<h4 class="timeline-title"><?= $this->lang->line("Etapa2_titulo") ?></h4>
						</div>
						<div class="timeline-body">
							<p><?= $this->lang->line("Etapa2_descricao") ?>.</p>
						</div>
					</div>
				</li>
				<li class="timeline-item">
					<div class="timeline-badge2 etapa3">
						<i class=" ">3</i>
					</div>
					<div class="timeline-panel">
						<div class="timeline-heading">
							<h4 class="timeline-title"><?= $this->lang->line("Etapa3_titulo") ?></h4>
						</div>
						<div class="timeline-body">
							<p><?= $this->lang->line("Etapa3_descricao") ?> </p>
						</div>
					</div>
				</li>
			</ul>
		</div>	



			<form id="enviar-mensagem" method="post" action="<?= base_url("transacao_c/adicionar_mensagem/ " . $transacao->id); ?>">
				<div class="form-group">
					<textarea class="form-control" name="mensagem" id="mensagem" required rows="5"></textarea>
				</div>
				<?php 
                        $comprador = $transacao->comprador == $this->session->usuario_id;
                        $vendedor = $transacao->vendedor == $this->session->usuario_id;
                        $impar = $etapa[0]->etapa%2;
                        $disabled = ($impar&&!$comprador)||(!$impar&&!$vendedor)?"disabled":"";

                    ?>
				<div class="text-center">
					<button id="btn-enviar-mensagem" type="button" class="btn btn-primary">
						<span class="fa fa-send"></span> <?= $this->lang->line("Enviar") ?></button>
					<?php if($etapa[0]->etapa!=3){ ?>
					<button id="btn-confirmar-etapa" <?php echo $disabled; ?> type="button" class="btn btn-success">
						<span class="fa fa-check-circle"></span> <?= $this->lang->line("Confirmar_etapa") ?></button>
							<?php }?>
					<button id="btn-finalizar" type="button" data-toggle="modal" data-target="#modal-avaliacao" class="btn btn-success">
						<span class="fa fa-check-circle"></span> <?= $this->lang->line("Finalizar_transacao") ?></button>
					</div>
			</form>
		</div>
	</div>
	</div>

	<?php elseif( $transacao->aceita != 0  ): ?>

		<div class="alert alert-warning center">
			<strong><?= $this->lang->line("Transacao_finalizada") ?>!</strong> 
		</div>

    <?php endif; 
    
    $js_lang = json_encode($this->lang->language);
    ?>
</section>
<?php $this->view("transacao/modal_avaliacao"); ?>
<script	src="<?= base_url('assets/js/transacao.js') ?>"></script>

<script> 
	
	transacao_id = "<?= $transacao->id ?>";
	etapa_atual = <?php echo $etapa[0]->etapa; ?>;
	status_atual = <?php echo $etapa[0]->status; ?>;
	$comprador = <?php echo $transacao->comprador; ?>;
	$vendedor = <?php echo $transacao->vendedor; ?>;
    $usuario_id = <?php echo $this->session->usuario_id; ?>;
    
	$lang = <?php echo $js_lang; ?>;

	

</script>
