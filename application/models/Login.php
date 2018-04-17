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
        return password_verify($senha, $hash->senha);
    }
    
}
