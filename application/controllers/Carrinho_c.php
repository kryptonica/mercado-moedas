<?php

class Carrinho_c extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('anuncio');
    }

    public function index() {
        $this->load->model('carteira');
        $total = null;
        if (!empty($this->session->carrinho)) {
            foreach ($this->session->carrinho as $item) {
                $total += $item->valor;
            }
        }
        $dados ["total"] = $total;
        $dados["carteiras"] = $this->carteira->buscar_com_relacoes(["where" => ["id_usuario" => $this->session->usuario_id]]);
        $this->carregar_pagina("carrinho/index", $dados);
    }

//    public function verificar_insercao($anuncio_id) {
//        $anuncio = $this->anuncio->buscar_row(["where" => ["id" => $anuncio_id]]);
//        $carrinho = $this->session->carrinho;
//        if (empty($carrinho)) {
//            $this->inserir($anuncio_id);
//        } else {
//            if(){
//                
//            }
//        }
//    }
//    
//    public function confirmar_insercao(){
//        
//    }

    public function inserir($anuncio_id) {
        $carrinho = $this->session->carrinho;
        $quantidade = $this->input->post("quantidade");
        $anuncio = $this->anuncio->buscar_row(["where" => ["id" => $anuncio_id]]);
        foreach ($carrinho as $item) {
            if ($item->id == $anuncio_id) {
                adicionar_alerta("danger", "Item já adicionado. Vá para o carrinho para alterar a quantidade.");
                redirect("visualizaranuncio?id=$anuncio_id");
                break;
            }
        }
        $item = new stdClass();
        $item->id = $anuncio->id;
        $item->titulo = $anuncio->titulo;
        $item->vendedor = $anuncio->id_usuario;
        $item->quantidade = $quantidade;
        $item->valor = $anuncio->preco * $quantidade;

        $carrinho[] = $item;
        $this->session->carrinho = $carrinho;
        adicionar_alerta("success", "Adicionado ao carrinho.");
        redirect("visualizaranuncio?id=$anuncio_id");
    }

    public function remover($anuncio_id) {
        $carrinho = $this->session->carrinho;
        foreach ($carrinho as $key => $item) {
            if ($item->id == $anuncio_id) {
                unset($carrinho[$key]);
                adicionar_alerta("success", "Item (ns) removido (s)!");
                break;
            }
        }
        $this->session->carrinho = $carrinho;
        redirect("carrinho");
    }

    public function alterar_quantidade() {
        $quantidade = $this->input->post("quantidade");
        $anuncio_id = $this->input->post("id");
        $anuncio = $this->anuncio->buscar_row(["where" => ["id" => $anuncio_id]]);
        $carrinho = $this->session->carrinho;
        foreach ($carrinho as $item) {
            if ($item->id == $anuncio_id) {
                $item->quantidade = $quantidade;
                $item->valor = $anuncio->preco * $quantidade;
                break;
            }
        }
        $this->session->carrinho = $carrinho;
        echo http_response_code(200);
    }

    public function finalizar_compra() {
        $this->load->model("transacao");
        $carteira_destino = $this->input->post("carteira_destino");
        $carrinho = $this->session->carrinho;
        foreach ($carrinho as $item) {
            $transacao = array(
                "data_hora" => date("Y-m-d H:i:s"),
                "vendedor" => $item->vendedor,
                "comprador" => $this->session->usuario_id,
                "carteira_destino" => $carteira_destino,
                "id_item_comercializavel" => $item->id,
                "quantidade" => $item->quantidade,
                "aceita" => 0,
            );

            $this->transacao->inserir($transacao);
        }
        $this->session->carrinho = array();

        adicionar_alerta("success", "Uma solicitação foi enviada para o (s) anunciante (s). Você pode acompanhar o andamento no menu \"Minhas Compras\"");
        redirect("carrinho");
    }

}
