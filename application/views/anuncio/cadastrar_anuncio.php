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
					<label for="titulo_anuncio" class="lb">Titulo:</label>
					<input type="text" class="form-control radius-input" name="titulo" id="titulo_anuncio" placeholder="Titulo" value="" required>
				</div>
				<div class="form-group">
					<label for="descricao_anuncio" class="lb">Descrição:</label>
					<textarea name="descricao" class="form-control radius-textarea" id="descricao_anuncio" rows="3" required></textarea>
				</div>
				<div class="form-group">
					<label for="preco_anuncio" class="lb">Preço:</label>
					<div class="input-group">
						<span class="input-group-addon">R$</span>
						<input type="number"  step="0.01" class="form-control radius-input" name="preco" id="preco_anuncio" placeholder="Preço" value=""
						required>
					</div>
				</div>

				<div class="form-group">
					<label for="quantidade_anuncio" class="lb">Quantidade:</label>
					<input type="number" step="0.00000001" min="0" class="form-control radius-input" name="quantidade" id="quantidade_anuncio" placeholder="Quantidade"
					value="" required>
				</div>

				<div class="form-group">
					<label for="select_anuncio" class="lb">Tipo de moeda:</label>
					<select class="custom-select" id="select_anuncio" name="tipo_moeda" required>
						<option value="" disabled selected>Tipo de Moeda</option>
						<?php
                    foreach ($moedas as $key => $moeda) {

                            echo '<option value="'.$moeda->moeda.'">'.$moeda->nome.'</option>';

                    }


                ?>
					</select>
				</div>
				<div class="form-group text-center">
					<button type="submit" class="btn btn-success">
						<span class="fa fa-check"></span> Cadastrar Anúncio </button>
				</div>
			</form>
		</div>
	</div>
</section>
