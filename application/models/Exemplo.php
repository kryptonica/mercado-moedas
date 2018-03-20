<?php

class Exemplo extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->tabela = 'exemplo';
        $this->ordenacao = [
            'id' => 'asc',
        ];
    }
    
}
