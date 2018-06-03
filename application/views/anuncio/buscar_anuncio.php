<?php
header('Cache-Control: no cache');

?>
<section class="container" style="min-height:62.5%;">
	<div class="row">
		<div class="col-sm-12">
			<h2>Busca por "<?php echo $texto; ?>"</h2>
			<hr>
		</div>
	</div>

	<form class="form_busca" method="post" action="<?= base_url("buscaranuncio") ?>">
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<input type="text" id="campo-anuncio" class="form-control search" name="texto_busca" placeholder="Palavras-chave" value="<?php echo $texto; ?>">
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label for="select_anuncio" class="lb">Classificar por:</label>
					<select class="form-control" id="select_anuncio" name="ordenacao_busca">
						<option value="maior_data_inicio" <?php echo $ordenacao=="maior_data_inicio" ? "selected": ""; ?> ><?= $this->lang->line("Data_mais_antiga") ?></option>
						<option value="menor_data_inicio" <?php echo $ordenacao=="menor_data_inicio" ? "selected": ""; ?> ><?= $this->lang->line("Data_mais_recente") ?></option>
						<option value="maior_preco" <?php echo $ordenacao=="maior_preco" ? "selected": ""; ?> ><?= $this->lang->line("Maior_preco") ?></option>
						<option value="menor_preco" <?php echo $ordenacao=="menor_preco" ? "selected": ""; ?> ><?= $this->lang->line("Menor_preco") ?></option>
						<option value="maior_quantidade" <?php echo $ordenacao=="maior_quantidade" ? "selected": ""; ?> ><?= $this->lang->line("Maior_quantidade") ?></option>
						<option value="menor_quantidade" <?php echo $ordenacao=="menor_quantidade" ? "selected": ""; ?> ><?= $this->lang->line("Menor_quantidade") ?></option>
					</select>
				</div>
			</div>
			<div class="col-sm-9">
					<label for="tipo_moeda" class="lb">Tipo de moeda:</label>
				<div class="form-group">
					<?php
						foreach ($moedas as $key => $moeda) {
							if($moedas_post != null)
								$checked = in_array($moeda->moeda,$moedas_post) ? "checked" : "";
							else
								$checked = '';
							echo '<label class="checkbox-inline"><input type="checkbox" class="checkbox-busca" name="tipo_moeda[]"  '.$checked.'  value="'.$moeda->moeda.'"> '.$moeda->nome.' </label>';
						}

					?>
				</div>
			</div>
		</div>
	</form>

	<div class="panel panel-default">
		<div class="panel-body">
			<?php
			$limite = sizeOf($anuncios); $i = 0;
			?>
			<div class="row">

				<?php while($i < $limite){

							$moeda_atual = null;



								foreach ($moedas as $key => $moeda) {
									if($moeda->moeda == $anuncios[$i]->id_moeda){
										$moeda_atual = $moeda->nome;
									}
								}


							?>
				<div class="col-sm-6 col-md-4">
					<a href="<?= base_url("visualizaranuncio?id=". $anuncios[$i]->id) ?>" class="anuncio" role="button">
						<div class="thumbnail">
							<img src="<?= base_url('assets/img/cripto_img.png'); ?>" alt="...">
							<div class="caption">
								<h3 >
									<div class="max-lines">
										<?php echo $anuncios[$i]->titulo ?>
									</div>
									<span class="label label-warning">
										<?php echo $moeda_atual; ?> </span>
								</h3>
								<!--p class="anuncio_thumb_text descricao_thumb">
									<?php echo $anuncios[$i]->descricao ?>
								</p-->
								<h2>
									<?php echo 'R$'.$anuncios[$i]->preco ?>
								</h2>
								<p>
									<?php echo 'Quantidade: '.$anuncios[$i]->quantidade ?>
								</p>
							</div>
						</div>
					</a>
				</div>

				<?php $i++;
				?>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
