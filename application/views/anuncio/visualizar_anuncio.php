<section class="container colar-rodape">
    <div class="panel panel-default">
        <div class="row">
            <div class="col-sm-7">

            </div>
            <div class="col-sm-5">
                <div id="descricao-anuncio">
                    <h3 class="font-bold"><?= $anuncio->titulo ?></h3>
                    <h1>R$ <?= $anuncio->preco ?></h1>
                    <h5>Quantidade disponível: <span class="font-bold"> <?= $anuncio->quantidade ?></span></h5>
                    <br>
                    <p class="text-justify"><?= $anuncio->descricao ?></p>
                    <a class="btn btn-primary">Comprar agora</a>
                    <hr>
                    <h3>Informações do vendedor:</h3>
                    <p class="text-justify"><span class="font-bold">Nome:</span> <?= $anuncio->usuario->nome ?></p>
                    <p class="text-justify"><span class="font-bold">Sobre:</span> <?= $anuncio->usuario->sobre ?></p>
                    <div class="clearfix">
                        <a class="pull-right btn btn-sm btn-info" href="<?= base_url("perfil/" . $anuncio->usuario->id) ?>">Ver perfil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
