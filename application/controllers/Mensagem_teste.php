<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Mensagem_teste extends MY_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->library('unit_test');
        $this->load->model('mensagem');
    }

    public function teste() {

        $test = $this->mensagem->atualizar_status_mensagens(28, 1);
        $this->unit->run($test, 'is_true', 'Alterar Status da mensagem');


        $resultado = $this->unit->report();


        $dados = array(
            'teste' => $resultado
        );

        $this->carregar_pagina("test/index", $dados);
    }



}
