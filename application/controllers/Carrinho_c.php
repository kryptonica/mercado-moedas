<?php

class Carrinho_c extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('exemplo');
    }

    public function index() {
        $this->carregar_pagina("carrinho/index");
    }
    
}
