<?php

class Anuncio extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->tabela = 'item_comercializavel';
        $this->ordenacao = [
            'id' => 'asc',
        ];
    }

    public function listar_anuncios($ordenacao,$texto,$moedas){
        $ord_col = "data_inicio";
        $ord_sentido = "desc";
        switch ($ordenacao) {
            case 'maior_data':
                $ord_col = "data_inicio";
                $ord_sentido = "asc";
                break;
            case 'maior_data':
                $ord_col = "data_inicio";
                $ord_sentido = "desc";
                break;
            case 'maior_preco':
                $ord_col = "preco";
                $ord_sentido = "desc";
                break;
            case 'menor_preco':
                $ord_col = "preco";
                $ord_sentido = "asc";
                break;
            case 'maior_quantidade':
                $ord_col = "quantidade";
                $ord_sentido = "desc";
                break;
            case 'menor_quantidade':
                $ord_col = "quantidade";
                $ord_sentido = "asc";
                break;
            default:
                # code...
                break;
        }

        $this->ordenacao = [
            $ord_col => $ord_sentido,
        ];

        $moedas_sql = array();

        if($moedas != null){
            foreach ($moedas as $key => $moeda) {
                $str_key = "id_moeda";
                for ($i=0; $i < $key; $i++) { 
                    $str_key.=" ";
                }
                $moedas_sql[$str_key] = $moeda;
            }
        }else{
            $moedas_sql = array('1'=>1);
        }

        if ($texto == '') {
            return $this->buscar(["or_where" => $moedas_sql]);
        }else{
            return $this->buscar(["like" => ["titulo" => $texto],"or_where" => $moedas_sql]);
        }

        
    }

    public function listar_anuncios_pelo_usuario($id) {
        return $this->buscar(["where" => ["id_usuario" => $id]]);
    }

    public function listar_anuncio_pelo_id($id_usuario, $id) {
        return $this->buscar_row(["where" => ["id_usuario" => $id_usuario, "id" => $id]]);
    }

    public function listar_moedas() {
        $this->db->select('moeda.id as moeda, tipo_moeda.id as tipo, tipo_moeda.nome');
        $this->db->from('moeda');
        $this->db->join('tipo_moeda', 'moeda.tipo_moeda = tipo_moeda.id');
        $query = $this->db->get()->result();
        return $query;
    }

    public function buscar_com_relacoes($filtros = array()) {
        $this->get_filtros($filtros);
        $this->order_by();
        $result = $this->db->get($this->tabela)->result();

        $this->load->model('usuario');
        $anuncios = array();

        foreach ($result as $anuncio) {
            $anuncio->usuario = $this->usuario->buscar_row(['where' => ['id' => $anuncio->id_usuario]]);
            $anuncios[] = $anuncio;
        }

        return $anuncios;
    }

}
