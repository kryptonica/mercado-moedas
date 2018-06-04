<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Carrinho_teste extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('anuncio');
        $this->load->model('transacao');
        $this->load->library('unit_test');
    }

    public function teste() {
        $transacao = array(
            "data_hora" => date("Y-m-d H:i:s"),
            "vendedor" => 1,
            "comprador" => 1,
            "carteira_destino" => 3,
            "id_item_comercializavel" => 8,
            "quantidade" => 10,
            "aceita" => 0,
        );

        $test = $this->transacao->inserir($transacao);
        $this->unit->run($test, 'is_numeric', 'Criar Transação');


        $resultado = $this->unit->report();


        $dados = array(
            'teste' => $resultado
        );

        $this->carregar_pagina("test/index", $dados);
    }



}
