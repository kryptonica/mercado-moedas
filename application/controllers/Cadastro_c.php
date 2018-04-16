<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Cadastro_c extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('cadastro');
        $this->load->model('usuario');
    }

    public function index() {
        $this->carregar_pagina('cadastro');
    }

    public function cadastrar() {
        $dados['nome'] = $this->input->post('nome');
        $dados['email'] = $this->input->post('email');
        $dados['dataNascimento'] = formatar_data_mysql( $this->input->post('nascimento') );
        $dados['senha'] = $this->input->post('senha');
        
        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
        $this->form_validation->set_rules('nascimento', 'Data de Nascimento', 'required');
        $this->form_validation->set_rules('senha', 'Senha', 'required|min_length[8]|max_length[12]');

        if ($this->form_validation->run() === TRUE) { //VALIDA FORMULÁRIO
            if ($this->cadastro->validar_email($dados['email'])) {
                if ($this->cadastro->validar_data_nascimento($dados['dataNascimento'])) {
                    $usuario = $this->usuario->inserir_crypt_senha($dados);
                    adicionar_alerta("success", "Cadastro concluído com sucesso!");
                    redirect("cadastro");
                }else{
                    adicionar_alerta("danger", "O usuário deve ser maior de idade!");
                    redirect("cadastro");
                }
            } else {
                adicionar_alerta("danger", "Email inválido ou já cadastrado!");
                redirect("cadastro");
            }
        } else {
            adicionar_alerta('danger', validation_errors());
            redirect("cadastro");
        }
    }

}
