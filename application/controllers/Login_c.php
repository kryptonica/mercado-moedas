<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Login_c extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('login');
        $this->load->model('usuario');
    }

    public function index() {
        if ($this->session->logado) {
            redirect("/");
        } else {
            $this->carregar_pagina("login/login");
        }
    }

    public function autenticar() {
        $email = $this->input->post('email');
        $senha = $this->input->post('senha');
        $this->form_validation->set_rules('email', 'E-mail', 'required');
        $this->form_validation->set_rules('senha', 'Senha', 'required');

        if ($this->form_validation->run() === TRUE) { //VALIDA FORMULÁRIO
            if ($this->login->resolve_user_login($email, $senha)) {
                $usuario = $this->usuario->buscar_row(["where" => ["email" => $email]]); //Busca dados do usuario
                $this->session->set_userdata(['logado' => TRUE, "usuario_id" => $usuario->id, "nome" => $usuario->nome]); //Seta dados na sessão
                redirect("/");
            } else {
                adicionar_alerta("danger", "Credenciais inválidas!");
                redirect("login");
            }
        } else {
            adicionar_alerta('danger', validation_errors());
            redirect("login");
        }
    }


    public function logout() {
        $this->session->sess_destroy();
        redirect('/');
    }

}
