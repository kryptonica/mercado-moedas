<section class="container" style="min-height:62.5%;">
	<div class="row">
		<div class="col-sm-12">
			<h2>Busca</h2>
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<form class="form_busca" method="post" action="<?= base_url("anuncio_c/buscar_anuncio") ?>" >
				<div class="form-group">
					<input type="text" class="form-control search" name="texto_busca" placeholder="Busca">
				</div>
			</form>



		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
			<?php $limite = sizeOf($anuncios); $i = 0; 
			function tratar_string($string){
				$string = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
				$string = strtolower($string);
				return $string;
			}
				
							
			if($texto != null){
				$texto = tratar_string($texto);
			}
			
			

			?>

			<?php while($i < $limite){ ?>
				<div class="row">
				<?php for($j=$i; $j<$i+4;$j++ ) {?> 

							<?php 
							
							$moeda_atual = null;
							$texto_test = $texto;
							if(empty($anuncios[$j]) || ($texto!=null && strlen(trim($texto_test) == 0) && strpos( tratar_string($anuncios[$j]->titulo), $texto) === false)  ){
								continue;
							}



								foreach ($moedas as $key => $moeda) {
									if($moeda->moeda == $anuncios[$j]->id_moeda){
										$moeda_atual = $moeda->nome;
									}
								}
							
							
							?>
							<div class="col-sm-6 col-md-4">
								<div class="thumbnail">
									<img src="<?= base_url('assets/img/cripto_img.png'); ?>" alt="...">
									<div class="caption">
										<h3><?php echo $anuncios[$j]->titulo ?>   <span class="label label-warning"> <?php echo $moeda_atual; ?> </span></h3>
										<p class="anuncio_thumb_text descricao_thumb"><?php echo $anuncios[$j]->descricao ?></p>
										<p><?php echo 'Preço: R$'.$anuncios[$j]->preco ?></p>
										<p><?php echo 'Quantidade: '.$anuncios[$j]->quantidade ?></p>
										<p>
											<a href="<?= base_url("anuncio_c/visualizar_anuncio?id=". $anuncios[$j]->id) ?>" class="btn btn-primary" role="button">Mais Informações</a>
										</p>
									</div>
								</div>
							</div>

				<?php } 
					$i+=4;
				?> 
				</div>
			<?php } ?>
		</div>
	</div>
</section>
