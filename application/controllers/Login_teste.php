<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Login_teste extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('login');
        $this->load->model('anuncio');
        $this->load->library('unit_test');
    }

    public function teste() {

        $test = $this->login->resolve_user_login("teste@admin.com", "admin");
        $this->unit->run($test, 'is_true', 'Autenticação');


        $resultado = $this->unit->report();


        $dados = array(
            'teste' => $resultado
        );

        $this->carregar_pagina("test/index", $dados);
    }



}
