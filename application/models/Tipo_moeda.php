<?php

class Tipo_moeda extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->tabela = 'tipo_moeda';
        $this->ordenacao = [
            'id' => 'asc',
        ];
    }
    
}
