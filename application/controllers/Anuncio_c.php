<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Anuncio_c extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('anuncio');
    }

    public function meus_anuncios() {
        $anuncios = $this->anuncio->listar_anuncios_pelo_usuario($this->session->usuario_id);
        $dados = array(
            'anuncios'=>$anuncios
        );
        $this->carregar_pagina("anuncio/meus_anuncios",$dados);
    }

    public function editar_anuncio() {
        
        $id = $this->input->get('id');
            $anuncio = $this->anuncio->listar_anuncio_pelo_id($id);
            $moedas = $this->anuncio->listar_moedas();
            $dados = array(
                'anuncio'=>$anuncio,
                'moedas'=>$moedas
            );
            $this->carregar_pagina("anuncio/editar_anuncio",$dados);
        
    }

    public function confirmar_atualizacao()
    {
        $id = $this->input->post('id');
        $titulo = $this->input->post('titulo');
        $descricao = $this->input->post('descricao');
        $preco = $this->input->post('preco');
        $quantidade = $this->input->post('quantidade');
        $tipo_moeda = $this->input->post('tipo_moeda');
        $dados = array(
            'titulo'=>$titulo,
            'descricao'=>$descricao,
            'preco'=>$preco,
            'quantidade'=>$quantidade,
            'id_moeda'=>$tipo_moeda,
        );
        var_dump($dados);
        var_dump($id);

        if ($this->form_validation->run() === TRUE) {

            $resultado = $this->anuncio->atualizar($id, $dados);

            if($resultado){
                
                adicionar_alerta("success", "Valores atualizados!");
                redirect("editaranuncio/?id=".$id);

            }else{
                adicionar_alerta("danger", "Alteração mal sucedida!");
                redirect("editaranuncio/?id=".$id);
            }
        }
    }

    public function cadastrar_anuncio()
    {
        $moedas = $this->anuncio->listar_moedas();
        $dados = array(
            'moedas'=>$moedas
        );

        $this->carregar_pagina("anuncio/cadastrar_anuncio", $dados);
    }

    public function confirmar_cadastro()
    {
        $id = $this->input->post('id');
        $titulo = $this->input->post('titulo');
        $descricao = $this->input->post('descricao');
        $preco = $this->input->post('preco');
        $quantidade = $this->input->post('quantidade');
        $tipo_moeda = $this->input->post('tipo_moeda');
        $dados = array(
            'titulo'=>$titulo,
            'descricao'=>$descricao,
            'preco'=>$preco,
            'quantidade'=>$quantidade,
            'id_moeda'=>$tipo_moeda,
            'id_usuario'=>$this->session->usuario_id,
            'data_inicio'=> date("Y-m-d")
        );

        if ($this->form_validation->run() === TRUE) {

            $resultado = $this->anuncio->inserir($dados);

            if($resultado){
                
                adicionar_alerta("success", "Anuncio Cadastrado");
                redirect("cadastraranuncio");

            }else{
                adicionar_alerta("danger", "Cadastro mal sucedido!");
                redirect("cadastraranuncio");
            }
        }
    }

    public function remover()
    {
        $id = $this->input->post('id');


        if ($this->form_validation->run() === TRUE) {

            $resultado = $this->anuncio->remover($id);

            if($resultado){
                
                adicionar_alerta("success", "Anuncio Removido");
                redirect("editaranuncio/?id=".$id);

            }else{
                adicionar_alerta("danger", "Remoção mal sucedida!");
                redirect("editaranuncio/?id=".$id);
            }
        }
    }


}
