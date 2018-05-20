<section class="container colar-rodape">
    <div class="row">
        <div class="col-sm-12">
            <h2>Transações</h2>
            <hr>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover ">
                    <thead class="font-bold">
                        <tr>
                            <th>Titulo</th>
                            <th>Data</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transacoes as $transacao): ?>
                        <tr>
                            <td class="clique"><a href="<?= base_url("transacao/visualizar/$transacao->id") ?>"><?= $transacao->anuncio->titulo?></a></td>
                            <td class="clique"><a href="<?= base_url("transacao/visualizar/$transacao->id") ?>"><?= formatar_datetime($transacao->data_hora)?></a></td>
                            <td class="clique"><a href="<?= base_url("transacao/visualizar/$transacao->id") ?>"><?= $transacao->aceita == 1 ? "Aceita" : "Aguardando aceitação do vendedor"?></a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>


