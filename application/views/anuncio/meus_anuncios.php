<section class="container" style="min-height:62.5%;">
	<div class="row">
		<div class="col-sm-11">
			<h2>Meus Anuncios</h2>
			<hr>
		</div>

	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="clearfix">
				<div class="col-xs-1 pull-right cadastrar_anuncio">
					<a href="<?= site_url('cadastraranuncio') ?>">
						<button class="btn btn-sm btn-success pull-right">
							<span class="fa fa-plus"></span> Cadastrar Anuncio</button>
					</a>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-12 ">

					<ul class="l
                    ist-group">
						<?php 
                    foreach ($anuncios as $key => $anuncio) {
                        
                        echo '<a href='. site_url("editaranuncio/?id=".$anuncio->id).' class="list-group-item list-group-item-action">'.$anuncio->titulo.' - Iniciado em '.$anuncio->data_inicio.'</a>';

                    }
                
                ?>
					</ul>
				</div>
			</div>
		</div>
	</div>

</section>
