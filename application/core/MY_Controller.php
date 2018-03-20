<?php

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

//    public function carregar_pagina($pagina, $dados = array()) {
//        $data['conteudo'] = $this->load->view($pagina, $dados, true);
//        $this->load->view('comuns/topo', $dados);
//        $this->load->view('comuns/layout', $data);
//        $this->load->view('comuns/rodape');
//    }

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
