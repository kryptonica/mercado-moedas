<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Home_c extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->carregar_pagina("home");
    }

}
