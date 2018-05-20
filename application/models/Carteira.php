<?php

class Carteira extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->tabela = 'carteira';
        $this->ordenacao = [
            'id' => 'asc',
        ];
    }

    public function buscar_com_relacoes($filtros = array()) {
        $this->get_filtros($filtros);
        $this->order_by();
        $result = $this->db->get($this->tabela)->result();

        $this->load->model('tipo_moeda');
        $carteiras = array();

        foreach ($result as $carteira) {
            $carteira->moeda = $this->tipo_moeda->buscar_row(['where' => ['id' => $carteira->tipo_moeda]]);
            $carteiras[] = $carteira;
        }

        return $carteiras;
    }

}
