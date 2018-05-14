<?php

class Carrinho_c extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('anuncio');
    }

    public function index() {
        $total = null;
        if (!empty($this->session->carrinho)) {
            foreach ($this->session->carrinho as $item) {
                $total += $item->valor;
            }
        }
        $dados ["total"] = $total;
        $this->carregar_pagina("carrinho/index", $dados);
    }

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
        foreach ($carrinho as  $item) {
            if ($item->id == $anuncio_id) {
                $item->quantidade = $quantidade;
                $item->valor = $anuncio->preco * $quantidade;
                break;
            }
        }
        $this->session->carrinho = $carrinho;
        echo http_response_code(200);
    }

}
