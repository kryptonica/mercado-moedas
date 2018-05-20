<?php

class Moeda extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->tabela = 'moeda';
        $this->ordenacao = [
            'id' => 'asc',
        ];
    }
    
}
