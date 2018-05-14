<?php 
header('Cache-Control: no cache'); 

?>
<section class="container" style="min-height:62.5%;">
	<div class="row">
		<div class="col-sm-12">
			<h2>Busca</h2>
			<hr>
		</div>
	</div>

	<form class="form_busca" method="post" action="<?= base_url("buscaranuncio ") ?>">
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<input type="text" class="form-control search" name="texto_busca" placeholder="Busca" value=<?php echo $texto; ?>>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="form-group">
					<label for="select_anuncio" class="lb">Ordenação:</label>
					<select class="form-control" id="select_anuncio" name="ordenacao_busca">
						<option value="maior_data_inicio" <?php echo $ordenacao=="maior_data_inicio" ? "selected": ""; ?> >Data mais antiga</option>
						<option value="menor_data_inicio" <?php echo $ordenacao=="menor_data_inicio" ? "selected": ""; ?> >Data mais recente</option>
						<option value="maior_preco" <?php echo $ordenacao=="maior_preco" ? "selected": ""; ?> >Maior Preço</option>
						<option value="menor_preco" <?php echo $ordenacao=="menor_preco" ? "selected": ""; ?> >Menor Preço</option>
						<option value="maior_quantidade" <?php echo $ordenacao=="maior_quantidade" ? "selected": ""; ?> >Maior Quantidade</option>
						<option value="menor_quantidade" <?php echo $ordenacao=="menor_quantidade" ? "selected": ""; ?> >Menor Quantidade</option>
					</select>
				</div>
			</div>
			<div class="col-sm-12">
					<label for="tipo_moeda" class="lb">Tipo de moeda:</label>
				<div class="form-group">
					<?php 
						foreach ($moedas as $key => $moeda) {
							if($moedas_post != null)
								$checked = in_array($moeda->moeda,$moedas_post) ? "checked" : "";
							else
								$checked = '';
							echo '<label class="checkbox-inline"><input type="checkbox" name="tipo_moeda[]"  '.$checked.'  value="'.$moeda->moeda.'"> '.$moeda->nome.' </label>';
						}
					
					?>
				</div>
			</div>
			<div class="col-sm-1">
				<div class="form-group text-center">
					<button type="submit" class="btn btn-primary btn-md">
						<span class="fa fa-filter"></span> Filtrar </button>
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
					<div class="thumbnail">
						<img src="<?= base_url('assets/img/cripto_img.png'); ?>" alt="...">
						<div class="caption">
							<h3>
								<?php echo $anuncios[$i]->titulo ?>
								<span class="label label-warning">
									<?php echo $moeda_atual; ?> </span>
							</h3>
							<p class="anuncio_thumb_text descricao_thumb">
								<?php echo $anuncios[$i]->descricao ?>
							</p>
							<p>
								<?php echo 'Preço: R$'.$anuncios[$i]->preco ?>
							</p>
							<p>
								<?php echo 'Quantidade: '.$anuncios[$i]->quantidade ?>
							</p>
							<p>
								<a href="<?= base_url(" visualizaranuncio?id=". $anuncios[$i]->id) ?>" class="btn btn-primary" role="button">Mais Informações</a>
							</p>
						</div>
					</div>
				</div>

				<?php $i++; 
				?>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
