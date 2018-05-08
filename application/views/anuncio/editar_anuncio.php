<section class="container" style="min-height:62.5%;">
    <div class="row">
        <div class="col-sm-12">
            <h2>Editar Anuncio</h2>
            <hr>
        </div>
    </div>
    <script>
        
        <?php echo "\$id = ".$anuncio->id ?>

        

    </script>
    <div class="row">
    <?php $this->view('commons/alertas'); ?>
        <form method="post" action="<?= base_url("anuncio_c/confirmar_atualizacao") ?>">
        <input type="hidden" class="form-control" name="id" id="id_anuncio"  value="<?php echo $anuncio->id ?>">
            <div class="form-group">
                <label for="titulo_anuncio">Titulo:</label>
                <input type="text" class="form-control" name="titulo" id="titulo_anuncio" placeholder="Titulo" value="<?php echo $anuncio->titulo ?>" required>
            </div>
            <div class="form-group">
                <label for="descricao_anuncio">Descrição:</label>
                <textarea name="descricao" class="form-control" id="descricao_anuncio" rows="3" required><?php echo $anuncio->descricao ?></textarea>
            </div>
            <div class="form-group">
                <label for="preco_anuncio">Preço:</label>
                <div class="input-group">
                <span class="input-group-addon">R$</span>
                    <input type="number" step="0.1" class="form-control" name="preco" id="preco_anuncio" placeholder="Preço" value="<?php echo $anuncio->preco ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="quantidade_anuncio">Quantidade:</label>
                <input type="number" step="0.1" min="0" class="form-control" name="quantidade" id="quantidade_anuncio" placeholder="Quantidade" value="<?php echo $anuncio->quantidade ?>" required>
            </div>

            <div class="form-group">
                <select class="custom-select select_anuncio" name="tipo_moeda" required>
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
            
            <button type="submit" name="alterar" class="btn-altera btn btn-primary">Alterar</button>
            <br>
        </form>
    </div>
</section>