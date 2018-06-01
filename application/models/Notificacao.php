<?php

class Notificacao extends MY_Model {

    public function __construct() {
        parent::__construct();
//        $this->tabela = 'mensagens';
        $this->ordenacao = [
            'id' => 'asc',
        ];
    }

    public function notificacao_mensagem() {
        $this->db->select("mensagens.*,usuario.nome as nome_usuario");
        $this->db->from("transacao");
        $this->db->join("mensagens", "mensagens.id_transacao = transacao.id");
        $this->db->join("usuario", "mensagens.id_usuario = usuario.id");
        $this->db->group_start();
        $this->db->or_where("transacao.comprador", $this->session->usuario_id);
        $this->db->or_where("transacao.vendedor", $this->session->usuario_id);
        $this->db->group_end();
        $this->db->where("mensagens.id_usuario !=", $this->session->usuario_id);
        $this->db->where("mensagens.visualizada", 0);
        return $this->db->get()->result();
    }

    public function notificacao_transacao_recebida() {
        $this->db->select("transacao.*, item_comercializavel.titulo as titulo_anuncio");
        $this->db->from("transacao");
        $this->db->join("item_comercializavel", "transacao.id_item_comercializavel = item_comercializavel.id");
        $this->db->where("transacao.vendedor", $this->session->usuario_id);
        $this->db->where("transacao.aceita", 0);
        $this->db->where($this->query_nao_visualizadas($this->session->usuario_id), '', FALSE);
        return $this->db->get()->result();
    }

    public function notificacao_transacao_aceita() {
        $this->db->select("transacao.*, item_comercializavel.titulo as titulo_anuncio");
        $this->db->from("transacao");
        $this->db->join("item_comercializavel", "transacao.id_item_comercializavel = item_comercializavel.id");
        $this->db->where("transacao.comprador", $this->session->usuario_id);
        $this->db->where("transacao.aceita", 1);
        $this->db->where($this->query_nao_visualizadas($this->session->usuario_id), '', FALSE);
        return $this->db->get()->result();
    }

    private function query_nao_visualizadas($id_usuario) {
        $query = "transacao.id NOT IN (select id_transacao from transacoes_visualizadas"
                . " where transacoes_visualizadas.id_usuario = $id_usuario)";
        return $query;
    }

}
