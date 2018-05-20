<?php

class Transacao_c extends MY_Controller {
    public function __construct() {
        parent::__construct();
//        $this->load->model('anuncio');
    }
    
    public function index(){
        $this->carregar_pagina("transacao/index");
    }
    
    public function visualizar(){
        $this->carregar_pagina("transacao/visualizar");
    }
}
