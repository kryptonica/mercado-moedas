<?php

class Transacao extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->tabela = 'transacao';
        $this->ordenacao = [
            'data_hora' => 'desc',
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
        $query = $this->db->insert('etapa_transacao',$dado);
        return $query;
    }

    public function atualizar_etapa($id, $etapa, $status)
    {
        if ($etapa > 4) {
            $status = 2;
        }else{
            $status = 1-$status;
        }
        $dado = array(
            'etapa' => $etapa,
            'status' => $status
        ); 
        $this->db->where('id_transacao', $id);
        $query =  $this->db->update('etapa_transacao',$dado);
        return $query;
    }
    
    public function resetar_status_etapa($id)
    {
        $dado = array(
            'status' => 0
        ); 
        $this->db->where('id_transacao', $id);
        $query =  $this->db->update('etapa_transacao',$dado);
        return $query;
    }

    public function atualizar_confirmacao($id, $tipo)
    {
        if($tipo=="confirmar"){
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
    
    public function finalizar($transacao, $descricao, $nota, $tipo)
    {
        if($tipo == "comprador"){

            $query = $this->atualizar($transacao, array(  "descricao_vendedor" => $descricao, "nota_vendedor" => $nota  ));
            $dado = array(
                'status' => 2
            ); 
            $this->db->where('id_transacao', $transacao);
            $query = $this->db->update('etapa_transacao',$dado);
        }
        else if($tipo == "vendedor"){
            
            $query = $this->atualizar($transacao, array(  "descricao_comprador" => $descricao, "nota_comprador" => $nota  ));
            $dado = array(
                'status' => 3
            ); 
            $this->db->where('id_transacao', $transacao);
            $this->db->update('etapa_transacao',$dado);
            
        }
        return $query;
    }

}
