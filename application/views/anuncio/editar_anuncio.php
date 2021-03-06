<section class="container colar-rodape">
	<div class="row">
		<div class="col-sm-12">
			<h2><?= $this->lang->line("Editar_anuncio") ?></h2>
			<hr>
		</div>
	</div>
	<script>
		<?php echo "\$id = ".$anuncio->id ?>

	</script>
	<div class="panel panel-default">

		<div class="panel-heading">
			<div class="clearfix">
				<button class="btn btn-sm btn-danger pull-right" data-toggle="modal" data-target="#modal-remover-anuncio">
					<span class="fa fa-trash"></span> <?= $this->lang->line("Remover_anuncio") ?> </button>
			</div>
		</div>

		<div class="panel-body">
			<?php $this->view('commons/alertas'); ?>
			<form method="post" action="<?= base_url("anuncio_c/confirmar_atualizacao ") ?>">
				<input type="hidden" class="form-control" name="id" id="id_anuncio" value="<?php echo $anuncio->id ?>">
				<div class="form-group">
					<label for="titulo_anuncio" class="lb"><?= $this->lang->line("Titulo_tabela") ?>:</label>
					<input type="text" class="form-control radius-input" name="titulo" id="titulo_anuncio" placeholder="Titulo" value="<?php echo $anuncio->titulo ?>"
					required>
				</div>
				
				<div class="row">
					<div class="form-group col-sm-4">
						<label for="preco_anuncio" class="lb"><?= $this->lang->line("Preco") ?>:</label>
						<div class="input-group">
							<span class="input-group-addon">R$</span>
							<input type="number" step="0.01" class="form-control radius-input" min="0" name="preco" id="preco_anuncio" placeholder="Preço" value="<?php echo $anuncio->preco ?>"
							required>
						</div>
					</div>

					<div class="form-group col-sm-4">
						<label for="quantidade_anuncio" class="lb"><?= $this->lang->line("Quantidade") ?>:</label>
						<input type="number" step="0.01" min="0" class="form-control radius-input" name="quantidade" id="quantidade_anuncio" placeholder="Quantidade"
						value="<?php echo $anuncio->quantidade ?>" required>
					</div>

					<div class="form-group col-sm-4">
						<label for="select_anuncio" class="lb"><?= $this->lang->line("Tipo_de_moeda") ?>:</label>
						<select class="custom-select form-control" id="select_anuncio" name="tipo_moeda" required>
							<option value="" disabled>Tipo de Moeda</option>
							<?php 
						foreach ($moedas as $key => $moeda) {
							
							if( $anuncio->id_moeda == $moeda->moeda )
								echo '<option value="'.$moeda->moeda.'" selected>'.$moeda->nome.'</option>';
							else
								echo '<option value="'.$moeda->moeda.'">'.$moeda->nome.'</option>';

						}
					
					
					?>
						</select>
				</div>
				</div>
				<div class="form-group">
					<label for="descricao_anuncio" class="lb"><?= $this->lang->line("Descricao") ?>:</label>
					<textarea name="descricao" class="form-control radius-textarea" id="descricao_anuncio" rows="3" required><?php echo $anuncio->descricao ?></textarea>
				</div>

				<div class="form-group text-center">
					<button type="submit" class="btn btn-success">
						<span class="fa fa-check"></span> <?= $this->lang->line("Salvar_alteracoes") ?></button>
				</div>
			</form>
		</div>
	</div>
</section>
<?php $this->view("anuncio/modal_remover_anuncio"); ?>
