<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function resolve_user_login($email, $senha) {
        $this->db->select('senha');
        $this->db->from('usuario');
        $this->db->where('email', $email);
        $hash = $this->db->get()->row();
        if (!$hash) {
            return false;
        }
        return $this->verificar_password_hash($senha, $hash->senha);
    }

    private function verificar_password_hash($password, $hash) {
        return password_verify($password, $hash);
    }

    public function hash_password($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

}
