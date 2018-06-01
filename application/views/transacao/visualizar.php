<section class="container colar-rodape">
	<div class="row">
		<div class="col-sm-12">
			<h2 class="header_transacao" id_t=<?= $transacao->id ?> >Compra nº
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
					<h4 class="raleway-bold">Resumo da compra</h4>
				</div>
				<div class="panel-body table-responsive">
					<table class="table">
						<tbody>
							<tr>
								<td>Valor total: </td>
								<td>R$
									<?= $transacao->anuncio->preco * $transacao->quantidade ?>
								</td>
							</tr>
							<tr>
								<td>Forma de pagamento:</td>
								<td>Boleto bancário</td>
							</tr>
							<tr>
								<td>Status:</td>
								<td>
									<?= $transacao->aceita == 1 ? "Aceita" : "Aguardando aceitação do vendedor" ?>
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
					<h4 class="raleway-bold">Produto</h4>
				</div>
				<div class="panel-body">
					<div class="col-sm-3">
						<img id="img-detalhe-compra" class="img-responsive" src="<?= base_url(" assets/img/cripto_img.png "); ?>">
					</div>
					<div class="col-sm-9">
						<a href="<?= base_url(" visualizaranuncio?id=" . $transacao->anuncio->id); ?>" class="raleway-bold">
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
				<span class="fa fa-check"></span> Aceitar transação</a>
		</div>
	</div>
	<?php endif; ?>

	<?php if ($transacao->aceita != 0): ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="raleway-bold">Mensagens</h4>
		</div>

		<div class="wrap_msg">
			<div class="panel_msg">
				<?php foreach ($transacao->mensagens as $indice => $mensagem):
                 $tipo_panel =  $mensagem->tipo==-1?"danger":"info";
                 $tipo_panel =  $mensagem->tipo==2?"success":$tipo_panel;
                $classe_ultimo = ($indice+1)==sizeof($transacao->mensagens)?"ultimo":"";
                ?>
				<?php if($mensagem->tipo == 1){ ?>
				<div class="timeline-badge">
					<i class="fa fa-receipt"></i>
				</div>
				<?php }else if($mensagem->tipo == -1){ ?>
				<div class="timeline-badge badge-danger">
					<i class="fa fa-times-circle"></i>
				</div>
				<?php }else if($mensagem->tipo == 2){ ?>
				<div class="timeline-badge badge-success">
					<i class="fa fa-check-circle"></i>
				</div>
				<?php }else{ ?>
				<div class="timeline-badge">
					<i class="fa fa-envelope"></i>
				</div>
				<?php } ?>
				<div class="<?php echo 'panel-body panel-content-msg '.$classe_ultimo ?>" msg=<?= $mensagem->id ?> >
					<?php if ($mensagem->usuario->id == $this->session->usuario_id): ?>

					<div class="col-sm-6 col-sm-offset-6 <?php echo " panel-etapa- ".$etapa[0]->etapa ?>">
						<div class="panel panel-<?php echo $tipo_panel; ?>">
							<div class="panel-heading text-right">
								<span class="raleway-bold">Você em
									<?= formatar_datetime($mensagem->data_hora) ?>
								</span>
							</div>
							<div class="panel-body">
								<p class="text-justify raleway-medium">
									<?= $mensagem->mensagem ?>
								</p>
							</div>
							<?php if($mensagem->tipo != 0){ ?>

							<div class="panel-footer">
								<button disabled type="button" class="btn_rejeitar_dado btn btn-danger ">
									<span class="fa fa-times-circle"></span> Rejeitar </button>
								<button disabled type="button" class="btn btn-success btn_aceitar_dado">
									<span class="fa fa-check-circle"></span> Confirmar </button>
							</div>

							<?php } ?>

						</div>
					</div>
					<?php else: ?>
					<div class="col-sm-6 <?php echo " panel-etapa- ".$etapa[0]->etapa ?>">
						<div class="panel panel-<?php echo $tipo_panel; ?>">
							<div class="panel-heading">
								<span class="raleway-bold">
									<?= $mensagem->usuario->nome ?> em
										<?= formatar_datetime($mensagem->data_hora) ?>
								</span>
							</div>
							<div class="panel-body">
								<p class="text-justify raleway-medium">
									<?= $mensagem->mensagem ?>
								</p>
							</div>
							<?php if($mensagem->tipo == 1) {?>

							<div class="panel-footer">
								<button type="button" class="btn_rejeitar_dado btn btn-danger">
									<span class="fa fa-times-circle"></span> Rejeitar </button>
								<button type="button" class="btn_aceitar_dado btn btn-success <?php echo " aceitar-
								".$etapa[0]->etapa ?>">
									<span class="fa fa-check-circle"></span> Confirmar </button>
							</div>

							<?php }  else if($mensagem->tipo != 0 && $mensagem->tipo != 1){ ?>

							<div class="panel-footer">
								<button disabled type="button" class="btn btn-danger ">
									<span class="fa fa-times-circle"></span> Rejeitar </button>
								<button disabled type="button" class="btn btn-success">
									<span class="fa fa-check-circle"></span> Confirmar </button>
							</div>

							<?php }	 ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
				<?php endforeach; 
                $array_etapas = array("Confirmar Pagamento", "Confirmar envio","Enviar dados para confirmação de pagamento","Enviar dados para confirmação de envio" );
                #var_dump($etapa);
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


			<ul class="timeline timeline-horizontal">
				<li class="timeline-item">
					<div class="timeline-badge2 info etapa1">
						<i class="fa ">1</i>
					</div>
					<div class="timeline-panel">
						<div class="timeline-heading">
							<h4 class="timeline-title">Confirmar Pagamento</h4>
						</div>
						<div class="timeline-body">
							<p>Nessa etapa o vendedor deve aceitar/rejeitar a solicitação de confirmação de pagamento do cliente.</p>
						</div>
					</div>
				</li>
				<li class="timeline-item">
					<div class="timeline-badge2 etapa2">
						<i class="fa ">2</i>
					</div>
					<div class="timeline-panel">
						<div class="timeline-heading">
							<h4 class="timeline-title">Confirmar transferencia de pedido</h4>
						</div>
						<div class="timeline-body">
							<p>Nessa etapa o cliente deve aceitar/rejeitar a solicitação de confirmação de transferência do vendedor.</p>
						</div>
					</div>
				</li>
				<li class="timeline-item">
					<div class="timeline-badge2 etapa3">
						<i class="fa ">3</i>
					</div>
					<div class="timeline-panel">
						<div class="timeline-heading">
							<h4 class="timeline-title">Processo de compra finalizado</h4>
						</div>
						<div class="timeline-body">
							<p>Cliente finaliza compra.</p>
						</div>
					</div>
				</li>
				<li class="timeline-item">
					<div class="timeline-badge2 etapa4">
						<i class="fa ">4</i>
					</div>
					<div class="timeline-panel">
						<div class="timeline-heading">
							<h4 class="timeline-title">Processo de venda finalizado</h4>
						</div>
						<div class="timeline-body">
							<p>Vendedor Finaliza a compra.</p>
						</div>
					</div>
				</li>
			</ul>




			<form id="enviar-mensagem" method="post" action="<?= base_url(" transacao_c/adicionar_mensagem/ " . $transacao->id); ?>">
				<div class="form-group">
					<textarea class="form-control" name="mensagem" id="mensagem" required rows="5"></textarea>
				</div>
				<?php 
                        $impar = $etapa[0]->etapa%2;
                        $comprador = $transacao->comprador == $this->session->usuario_id;
                        $vendedor = $transacao->vendedor == $this->session->usuario_id;
                        var_dump($etapa);            
                        $disabled = ($impar&&!$comprador)||(!$impar&&!$vendedor)?"disabled":"";

                    ?>
				<div class="text-center">
					<button id="btn-enviar-mensagem" type="button" class="btn btn-primary">
						<span class="fa fa-send"></span> Enviar</button>
					<button id="btn-confirmar-etapa" <?php echo $disabled; ?> type="button" class="btn btn-success">
						<span class="fa fa-check-circle"></span> Confirmar Etapa</button>
				</div>
			</form>
		</div>
	</div>
	</div>
	<?php endif; ?>
</section>
<script	src="<?= base_url('assets/js/transacao.js') ?>"></script>

<script> 
	

</script>
