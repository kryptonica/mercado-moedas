<?php

class Usuario extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->tabela = 'usuario';
        $this->ordenacao = [
            'id' => 'asc',
        ];
    }

    public function inserir_crypt_senha($dados) {
        $this->load->model('login');
        $dados['senha'] = $this->login->hash_password($dados['senha']);
        $this->db->insert($this->tabela, $dados);
        $id = $this->db->insert_id();
        return $id;
    }

}
