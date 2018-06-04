<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Anuncio_teste extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('anuncio');
        $this->load->library('unit_test');
    }

    public function teste() {
        $test = $this->anuncio->listar_anuncios_pelo_usuario(1);
        $this->unit->run($test, 'is_array', 'Listar Anuncio pelo ID do usuário');

        $test = $this->anuncio->listar_anuncio_pelo_id(1, 1);
        $this->unit->run($test, 'is_object', 'Teste - Listar anuncio pelo ID');

        $test = $this->anuncio->listar_moedas();
        $this->unit->run($test, 'is_array', 'Listar tipos de moeda');

        $test = $this->anuncio->listar_anuncios('maior_data_inicio', 'teste', null);
        $this->unit->run($test, 'is_array', 'Listar Anuncios - Filtro');

        $test = $this->anuncio->listar_anuncios('maior_data_inicio', 'teste', [3]);
        $this->unit->run($test, 'is_array', 'Listar Anuncios - Filtro - Com Tipo Moeda');

        $dados = array(
            'titulo' => 'Teste Unidade',
            'descricao' => 'Teste Unidade',
            'preco' => 1,
            'quantidade' => 1,
            'id_moeda' => 3,
            'id_usuario' => 1,
            'data_inicio' => date("Y-m-d")
        );

        $test = $this->anuncio->inserir($dados);
        $this->unit->run($test, 'is_numeric', 'Criar Anuncio');

        $test = $resultado = $this->anuncio->remover(9);
        $this->unit->run($test, 'is_true', 'Remover');
    
        $test = $this->anuncio->buscar_com_relacoes(["where" => ["id" => 1]])[0];
        $this->unit->run($test, 'is_object', 'Buscar Anuncios');

        $this->load->model("carteira");
        $test = $this->carteira->buscar_com_relacoes(["where" => ["id_usuario" => 1]]);
        $this->unit->run($test, 'is_array', 'Buscar Carterias');

        $resultado = $this->unit->report();


        $dados = array(
            'teste' => $resultado
        );

        $this->carregar_pagina("test/index", $dados);
    }



}
