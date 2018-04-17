<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Usuario_c extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuario');
    }

    public function index() {
        
    }

    public function criar() {
        $this->carregar_pagina('usuario/cadastro');
    }

    public function inserir() {
        if ($this->form_validation->run() === TRUE) { //Regras de validação estão em config/form_validation pq são muitas
            $dados = $this->input->post(['nome', 'email', 'senha']); //pega tudo de uma vez
            $dados["dataNascimento"] = $this->input->post('nascimento');
            if ($this->validar_data_nascimento($dados['dataNascimento'])) {
                $this->usuario->inserir_crypt_senha($dados);
                adicionar_alerta("success", "Cadastro concluído com sucesso!");
                redirect("login");
            } else {
                adicionar_alerta("danger", "O usuário deve ser maior de idade!");
                redirect("cadastro");
            }
        } else {
            adicionar_alerta('danger', validation_errors());
            redirect("cadastro");
        }
    }

    private function validar_data_nascimento($data) {//Os models só devem conter métodos que fazem acesso ao banco de dados
        $hoje = date("Y-m-d");
        $diff = date_diff(date_create($data), date_create($hoje));
        $idade = $diff->format('%y');

        if ($idade >= 18) {
            return true;
        }

        return false;
    }

}
