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

    public function inserir() {//Para fins de teste
        $dados = array(
            "nome" => "Administrador",
            "email" => "teste@admin.com",
            "dataNascimento" => "2000-12-02",
            "login" => "admin",
            "senha" => "admin",
        );
        $this->usuario->inserir_crypt_senha($dados);
        echo "foi";
    }

}
