<?php

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library("auth"); //faz o controle de permissões -> classe na pasta libraries/auth.php
    }

    public function carregar_pagina($pagina, $dados = array()) {
        $this->load->view("commons/header", $dados);
        $this->load->view($pagina, $dados);
        $this->load->view("commons/footer");
    }

    protected function initPagination($url, $total) {
        $config = array(
            'total_rows' => $total,
            'base_url' => base_url($url),
        );
        $this->pagination->initialize($config);
    }

    protected function get_query_paginacao($page) {
        $this->config->load('pagination');
        $paginacao = array(
            'pagina' => $page ? $page : 0,
            'quantidade' => $this->config->item('per_page'),
        );
        return $paginacao;
    }

}
