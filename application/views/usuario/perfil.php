<section class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2>Perfil  <?= $usuario->nome; ?></h2>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6" id="dados-perfil">
            <div class="col-sm-4 text-center">
                <img class="img-thumbnail" alt="Foto do perfil" src="<?= base_url("assets/img/perfil-default.png") ?>"/>
                <p class="label label-success">Email verificado</p>
            </div>
            <div class="col-sm-8 text-center">
                <p id="contador-reputacao">(<span class="text-success">+132</span>; <span class="text-danger">-9</span>)</p>
            </div>
            <div class="col-sm-12">
                <ul>
                    <li><span class="fa fa-map-marker"></span> Salvador, Bahia, Brasil</li>
                    <li><span class="fa fa-clock-o"></span> Tempo médio de transação crypto: Xh:Ymin</li>
                    <li><span class="fa fa-clock-o"></span> Tempo médio de transação bancária: Xh:Ymin</li>
                    <li><span class="fa fa-calendar-o"></span> Última transação há X dias, Y horas, Z minutos</li>
                    <li><span class="fa fa-calendar-check-o"></span> X transações realizadas com sucesso.</li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <h4 class="raleway-bold">Sobre mim</h4>
                <div class="panel-body">
                    <div id="sobre-mim" class="text-justify">
                        Mussum Ipsum, cacilds vidis litro abertis. Posuere libero varius.
                        Nullam a nisl ut ante blandit hendrerit. Aenean sit amet nisi.
                        Viva Forevis aptent taciti sociosqu ad litora torquent. 
                        A ordem dos tratores não altera o pão duris. Interagi no mé,
                        cursus quis, vehicula ac nisi. Manduma pindureta quium dia nois
                        paga. Cevadis im ampola pa arma uma pindureta. In elementis mé 
                        quem é amistosis quis leo. Leite de capivaris, leite de mula manquis
                        sem cabeça. Suco de cevadiss deixa as pessoas mais interessantis. 
                        Sapien in monti palavris qui num significa nadis i pareci latim. Mé faiz
                        elementum girarzis, nisi eros vermeio. Não sou faixa preta cumpadi,
                        sou preto inteiris, inteiris.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <h4>Anúncios de venda de <?= $usuario->nome; ?></h4>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Moeda</td>
                                    <td>Range</td>
                                    <td>Valor</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>BTC</td>
                                    <td>R$50,00 - R$2.000,00</td>
                                    <td>R$35.000,00</td>
                                </tr>
                                <tr>
                                    <td>ETH</td>
                                    <td>R$10,00 - R$5.200,00</td>
                                    <td>R$10.000,00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <h4>Anúncios de compra de <?= $usuario->nome; ?></h4>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Moeda</td>
                                    <td>Range</td>
                                    <td>Valor</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>BTC</td>
                                    <td>R$50,00 - R$2.000,00</td>
                                    <td>R$32.000,00</td>
                                </tr>
                                <tr>
                                    <td>ETH</td>
                                    <td>R$10,00 - R$5.200,00</td>
                                    <td>R$8.500,00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
