<section class="container colar-rodape">
    <div class="row">
        <div class="col-sm-12">
            <h2>Meus Anúncios</h2>
            <hr>
        </div>

    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="clearfix">
                <a href="<?= site_url('cadastraranuncio') ?>">
                    <button class="btn btn-sm btn-success pull-right"><span class="fa fa-plus"></span> Cadastrar Anúncio</button>
                </a>
            </div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="font-bold">
                        <tr>
                            <th>Titulo</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Iniciado em</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($anuncios as $key => $anuncio): ?>
                            <tr>
                                <td class="clique"><a href="<?=base_url("editaranuncio/?id=" . $anuncio->id) ?>"><?= $anuncio->titulo ?></a></td>
                                <td class="clique"><a href="<?=base_url("editaranuncio/?id=" . $anuncio->id) ?>">R$ <?= $anuncio->preco ?></a></td>
                                <td class="clique"><a href="<?=base_url("editaranuncio/?id=" . $anuncio->id) ?>"><?= $anuncio->quantidade ?></a></td>
                                <td class="clique"><a href="<?=base_url("editaranuncio/?id=" . $anuncio->id) ?>"><?= formatar_data($anuncio->data_inicio)?></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>
