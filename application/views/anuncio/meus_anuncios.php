<section class="container" style="min-height:62.5%;">
    <div class="row">
        <div class="col-sm-11">
            <h2>Meus Anuncios</h2>
            <hr>
        </div>
        <div class="col-xs-1 pull-right cadastrar_anuncio"> <a href="<?= site_url('cadastraranuncio') ?>"><button type="submit" class="btn btn-primary"> <span class="fa fa-plus" style="font-size: 20px; padding: 5px;"> </span> </button></a>   </div>
    </div>
    <div class="row">
        <div class="col-xs-12 ">
        
            <ul class="list-group">
                <?php 
                    foreach ($anuncios as $key => $anuncio) {
                        
                        echo '<a href='. site_url("editaranuncio/?id=".$anuncio->id).' class="list-group-item list-group-item-action">'.$anuncio->titulo.' - Iniciado em '.$anuncio->data_inicio.'</a>';

                    }
                
                ?>
            </ul>
        </div>
    </div>
</section>
