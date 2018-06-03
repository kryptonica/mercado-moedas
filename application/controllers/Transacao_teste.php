<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Transacao_teste extends MY_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->library('unit_test');
        $this->load->model('transacao');
    }

    public function teste() {

        $test = $this->transacao->buscar_etapa(28);
        $this->unit->run($test, 'is_array', 'Buscar etapa atual da transação');

        $test = $this->transacao->inserir_etapa(28);
        $this->unit->run($test, 'is_true', 'Inserir etapa da transação');
       
        $test = $this->transacao->atualizar_etapa(28, 2, 0);
        $this->unit->run($test, 'is_true', 'Atualizar etapa da transação');
        
        $test = $this->transacao->atualizar_confirmacao(28, "confirmar");
        $this->unit->run($test, 'is_true', 'Confirmar etapa');
        
        $test = $this->transacao->finalizar(28, 'boa', 8, 'comprador');
        $this->unit->run($test, 'is_true', 'Finalizar transação');


        $resultado = $this->unit->report();


        $dados = array(
            'teste' => $resultado
        );

        $this->carregar_pagina("test/index", $dados);
    }



}
