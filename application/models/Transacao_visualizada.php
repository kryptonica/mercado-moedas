<?php

class Transacao_visualizada extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->tabela = 'transacoes_visualizadas';
        $this->ordenacao = [
            'id' => 'asc',
        ];
    }
}
