<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Notificacao_teste extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('notificacao');
        $this->load->library('unit_test');
    }

    public function teste() {

        
        $test = $this->notificacao->notificacao_mensagem();
        $this->unit->run($test, 'is_array', 'Buscar mensagens não lidas');

        $test = $this->notificacao->notificacao_transacao_recebida();
        $this->unit->run($test, 'is_array', 'Buscar solicitações de transação');

        $test = $this->notificacao->notificacao_transacao_aceita();
        $this->unit->run($test, 'is_array', 'Buscar transações aceitas');

        $resultado = $this->unit->report();


        $dados = array(
            'teste' => $resultado
        );

        $this->carregar_pagina("test/index", $dados);
    }



}
