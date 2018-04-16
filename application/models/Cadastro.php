<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function validar_email($email)
    {
        $this->db->select('senha');
        $this->db->from('usuario');
        $this->db->where('email', $email);
        $check_email = $this->db->get()->row();

        if($check_email != null){
            return false;
        }
        
        return true;
    }

    public function validar_data_nascimento($data)
    {
        $hoje = date("Y-m-d");
        $diff = date_diff(date_create($data), date_create($hoje));
        $idade = $diff->format('%y');

        if ($idade >= 18) {
            return true;
        }

        return false;
    }

}