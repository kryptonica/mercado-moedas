<?php

class Transacao_c extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('anuncio');
        $this->load->model('transacao');
    }

    public function index() {
        $this->carregar_pagina("transacao/index");
    }

    public function minhas_compras() {
        $dados["transacoes"] = $this->transacao->buscar_com_relacoes(["where" => ["comprador" => $this->session->usuario_id]]);
        $this->carregar_pagina("transacao/index", $dados);
    }

    public function minhas_vendas() {
        $dados["transacoes"] = $this->transacao->buscar_com_relacoes(["where" => ["vendedor" => $this->session->usuario_id]]);
        $this->carregar_pagina("transacao/index", $dados);
    }

    public function visualizar($transacao_id) {
        $dados["transacao"] = $this->transacao->buscar_com_relacoes(["where" => ["id" => $transacao_id]])[0];
        $this->carregar_pagina("transacao/visualizar", $dados);
    }

    public function criar() {
        $dados = $this->input->post();
        $anuncio = $this->anuncio->buscar_row(["where" => ["id" => $dados["anuncio_id"]]]);
//        $vendedor = $this->usuario->buscar_com_relacoes(["where" => ["id" => $anuncio->usuario_id]])[0];
//        print_r($dados);
//        return;
        $transacao = array(
            "data_hora" => date("Y-m-d H:i:s"),
            "vendedor" => $anuncio->id_usuario,
            "comprador" => $this->session->usuario_id,
            "carteira_destino" => $dados["carteira_destino"],
//            "carteira_fonte" => $vendedor,
            "id_item_comercializavel" => $anuncio->id,
            "quantidade" => $dados["quantidade"],
            "aceita" => 0,
        );
//        print_r($transacao);
//        return;
        $this->transacao->inserir($transacao);
        adicionar_alerta("success", "Uma solicitação foi enviada para o anunciante. Você pode acompanhar o andamento no menu \"Minhas Compras\"");
        redirect("visualizaranuncio?id=$anuncio->id");
    }

    public function adicionar_mensagem($transacao_id) {
        $this->load->model("mensagem");
        $mensagem = $this->input->post("mensagem");
        $this->mensagem->inserir(["id_usuario" => $this->session->usuario_id, "mensagem" => $mensagem, "id_transacao" => $transacao_id, "data_hora" => date("Y-m-d H:i:s")]);
        redirect("transacao/visualizar/$transacao_id#enviar-mensagem");
    }

    public function aceitar($transacao_id) {
        $this->transacao->atualizar($transacao_id, ["aceita" => 1]);
        adicionar_alerta("success", "Transação aceita! Envie uma mensagem para o comprador.");
        redirect("transacao/visualizar/$transacao_id");
    }

}
