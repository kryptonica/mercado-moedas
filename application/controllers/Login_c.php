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
        $this->carregar_pagina("login/login");
    }

    public function autenticar() {
        $email = $this->input->post('email');
        $senha = $this->input->post('senha');

        if ($this->form_validation->run() === TRUE) { //VALIDA FORMULÁRIO -> regras em config/form_validation.php
            if ($this->login->resolve_user_login($email, $senha)) {
                $usuario = $this->usuario->buscar_row(["where" => ["email" => $email]]); //Busca dados do usuario
                $this->session->set_userdata(['logado' => TRUE, "usuario_id" => $usuario->id, "nome" => $usuario->nome, "lang" => $usuario->linguagem]); //Seta dados na sessão
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
        $this->session->unset_userdata('logado');
        $this->session->unset_userdata('nome');
        $this->session->unset_userdata('usuario_id');
        redirect('/');
    }

}
