<?php

class Transacao extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->tabela = 'transacao';
        $this->ordenacao = [
            'id' => 'asc',
        ];
    }
    
    public function buscar_com_relacoes($filtros = array()) {
        $this->get_filtros($filtros);
        $this->order_by();
        $result = $this->db->get($this->tabela)->result();

        $this->load->model('anuncio');
        $this->load->model('usuario');
        $this->load->model('mensagem');
        $transacoes = array();

        foreach ($result as $transacao) {
            $transacao->anuncio = $this->anuncio->buscar_com_relacoes(['where' => ['id' => $transacao->id_item_comercializavel]])[0];
            $transacao->mensagens = $this->mensagem->buscar_com_relacoes(['where' => ['id_transacao' => $transacao->id]]);
            $transacoes[] = $transacao;
        }

        return $transacoes;
    }

    public function buscar_etapa($id)
    {
        $this->db->select('*');
        $this->db->from('etapa_transacao');
        $this->db->where('id_transacao', $id);
        $query = $this->db->get()->result();
        return $query;
    }

    public function inserir_etapa($id)
    {
        $dado = array(
            'id_transacao' => $id,
            'datahora' => date("Y-m-d H:i:s"),
            'etapa' => 1,
            'status' => 0
        ); 
        $this->db->insert('etapa_transacao',$dado);
    }

    public function atualizar_etapa($id, $etapa)
    {
        if($etapa == -1){
            $status = $etapa;
        }else if ($etapa > 4) {
            $status = 1;
        }else{
            $status = 0;
        }
        $dado = array(
            'etapa' => $etapa,
            'status' => $status
        ); 
        $this->db->where('id_transacao', $id);
        $query =  $this->db->update('etapa_transacao',$dado);
        return $query;
    }
    
    public function atualizar_confirmacao($id, $status)
    {
        $tipo = 0;
        if($status==1){
            $tipo = 2;
        }else{
            $tipo = -1;
        }
        $dado = array(
            'tipo' => $tipo
        ); 
        $this->db->where('id', $id);
        $query = $this->db->update('mensagens',$dado);
        return $query;
    }
    
}
