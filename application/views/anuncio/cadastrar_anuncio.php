<section class="container" style="min-height:62.5%;">
    <div class="row">
        <div class="col-sm-12">
            <h2>Cadastrar Anuncio</h2>
            <hr>
        </div>
    </div>
    <div class="row">
    <?php $this->view('commons/alertas'); ?>
        <form method="post" action="<?= base_url("anuncio_c/confirmar_cadastro") ?>">
            <div class="form-group">
                <label for="titulo_anuncio">Titulo:</label>
                <input type="text" class="form-control" name="titulo" id="titulo_anuncio" placeholder="Titulo" value="" required>
            </div>
            <div class="form-group">
                <label for="descricao_anuncio">Descrição:</label>
                <textarea name="descricao" class="form-control" id="descricao_anuncio" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="preco_anuncio">Preço:</label>
                <div class="input-group">
                <span class="input-group-addon">R$</span>
                    <input type="number" step="0.1" class="form-control" name="preco" id="preco_anuncio" placeholder="Preço" value="" required>
                </div>
            </div>

            <div class="form-group">
                <label for="quantidade_anuncio">Quantidade:</label>
                <input type="number" step="0.1" min="0" class="form-control" name="quantidade" id="quantidade_anuncio" placeholder="Quantidade" value="" required>
            </div>

            <div class="form-group">
                <select class="custom-select select_anuncio" name="tipo_moeda" required>
                <option value="" disabled selected>Tipo de Moeda</option>
                <?php 
                    foreach ($moedas as $key => $moeda) {
                        
                            echo '<option value="'.$moeda->moeda.'">'.$moeda->nome.'</option>';

                    }
                
                
                ?>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Enviar</button><br>
        </form>
    </div>
</section>
