<?php

class Anuncio extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->tabela = 'item_comercializavel';
        $this->ordenacao = [
            'id' => 'asc',
        ];
    }

    public function listar_anuncios_pelo_usuario($id)
    {
        return $this->buscar(["where" => ["id_usuario" => $id]]);
    }

    public function listar_anuncio_pelo_id($id_usuario, $id)
    {
        return $this->buscar_row(["where" => ["id_usuario" => $id_usuario,"id" => $id]]);
    }

    public function listar_moedas()
    {
        $this->db->select('moeda.id as moeda, tipo_moeda.id as tipo, tipo_moeda.nome');
        $this->db->from('moeda');
        $this->db->join('tipo_moeda', 'moeda.tipo_moeda = tipo_moeda.id');
        $query = $this->db->get()->result();
        return $query;
    }


}
