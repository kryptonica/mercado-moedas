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
        if ($this->form_validation->run() === TRUE) { //Regras de validação estão em config/form_validation
            $dados = $this->input->post(['nome', 'email', 'senha']);
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

    public function visualizar_perfil($usuario_id) {
        $dados["usuario"] = $this->usuario->buscar_row(["where" => ["id" => $usuario_id]]);
        $this->carregar_pagina("usuario/perfil", $dados); //dentro da view, cada posição do array $dados pode ser tratada como uma variável individual
    }

    public function editar() {
        $dados["usuario"] = $this->usuario->buscar_row(["where" => ["id" => $this->session->usuario_id]]);
        $this->carregar_pagina("usuario/editar", $dados);
    }

    public function atualizar() {
        $dados = $this->input->post(['nome', 'email', 'sobre']);
        $dados["dataNascimento"] = $this->input->post('nascimento');
        $usuario_logado = $this->usuario->buscar_row(["where" => ["id" => $this->session->usuario_id]]);
        $this->form_validation_atualizar($dados, $usuario_logado);
        if ($this->form_validation->run() === TRUE) { //Regras de validação estão em config/form_validation
            if ($this->validar_data_nascimento($dados['dataNascimento'])) {
                $this->usuario->atualizar($this->session->usuario_id, $dados);
                adicionar_alerta("success", "Dados atualizados com sucesso!");
                redirect("editar");
            } else {
                adicionar_alerta("danger", "O usuário deve ser maior de idade!");
                redirect("editar");
            }
        } else {
            adicionar_alerta('danger', validation_errors());
            redirect("editar");
        }
    }

    private function form_validation_atualizar($dados, $usuario_logado) {
        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('nascimento', 'Data de Nascimento', 'required');

        if ($dados['email'] == $usuario_logado->email) {
            $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
        } else {
            $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|is_unique[usuario.email]');
        }
    }

    public function alterar_senha() {
        $this->load->model('login');
        $dados = $this->input->post();
        $usuario = $this->usuario->buscar_row(["where" => ["id" => $this->session->usuario_id]]);
        if ($this->form_validation->run() === TRUE) {
            if ($this->login->resolve_user_login($usuario->email, $dados['senha_atual'])) {
                $dados_usuario['senha'] = password_hash($dados['nova_senha'], PASSWORD_BCRYPT);
                if ($this->usuario->atualizar($this->session->usuario_id, $dados_usuario)) {
                    adicionar_alerta('success', 'Senha alterada com sucesso.');
                    redirect('editar');
                }
            } else {
                adicionar_alerta('danger', 'Senha atual incorreta');
                redirect('editar');
            }
        } else {
            adicionar_alerta('danger', validation_errors());
            redirect('editar');
        }
    }

    public function mudar_lingua()
    {
        $lang = $this->input->post('lang');
        $response["lang"] = $lang;
        $this->session->set_userdata( array("lang"=>$lang) );
        echo json_encode($response);
    }

}
