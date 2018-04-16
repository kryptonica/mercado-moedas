<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Mercado_c extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuario');
    }

    public function index() {
        $this->load->view("commons/header");
        $this->load->view("home");
        $this->load->view("commons/footer");
    }

}
