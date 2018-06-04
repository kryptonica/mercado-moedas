<section class="container colar-rodape">
	<div class="row">
		<div class="col-sm-12">
			<h2>Cadastrar Anúncio</h2>
			<hr>
		</div>
	</div>
	<div class="panel panel-default">

		<div class="panel-body">
			<?php $this->view('commons/alertas'); ?>
			<form method="post" action="<?= base_url("anuncio_c/confirmar_cadastro ") ?>">
				<div class="form-group">
					<label for="titulo_anuncio" class="lb"><?= $this->lang->line("Titulo_tabela") ?>:</label>
					<input type="text" class="form-control radius-input" name="titulo" id="titulo_anuncio" placeholder="Titulo" value="" required>
				</div>
				<div class="row">
					<div class="form-group col-sm-4">
						<label for="preco_anuncio" class="lb"><?= $this->lang->line("Preco") ?>:</label>
						<div class="input-group">
							<span class="input-group-addon">R$</span>
							<input type="number"  step="0.01" class="form-control radius-input" name="preco" id="preco_anuncio" placeholder="Preço" value=""
							required>
						</div>
					</div>

					<div class="form-group col-sm-4">
						<label for="quantidade_anuncio" class="lb"><?= $this->lang->line("Quantidade") ?>:</label>
						<input type="number" step="0.00000001" min="0" class="form-control radius-input" name="quantidade" id="quantidade_anuncio" placeholder="Quantidade"
						value="" required>
					</div>

					<div class="form-group col-sm-4">
						<label for="select_anuncio" class="lb"><?= $this->lang->line("Tipo_de_moeda") ?>:</label>
						<select class="custom-select form-control" id="select_anuncio" name="tipo_moeda" required>
							<option value="" disabled selected><?= $this->lang->line("Tipo_de_moeda") ?></option>
							<?php
						foreach ($moedas as $key => $moeda) {

								echo '<option value="'.$moeda->moeda.'">'.$moeda->nome.'</option>';

						}


					?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="descricao_anuncio" class="lb"><?= $this->lang->line("Descricao") ?>:</label>
					<textarea name="descricao" class="form-control radius-textarea" id="descricao_anuncio" rows="10" required></textarea>
				</div>
				<div class="form-group text-center">
					<button type="submit" class="btn btn-success">
						<span class="fa fa-check"></span> <?= $this->lang->line("Cadastrar_anuncio") ?> </button>
				</div>
			</form>
		</div>
	</div>
</section>
