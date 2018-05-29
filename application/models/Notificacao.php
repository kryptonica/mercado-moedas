<?php

class Notificacao extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->tabela = 'mensagens';
        $this->ordenacao = [
            'id' => 'asc',
        ];
    }

    public function notificacao_mensagem() {
        $this->db->select("mensagens.*,usuario.nome as nome_usuario");
        $this->db->from("transacao");
        $this->db->join("mensagens","mensagens.id_transacao = transacao.id");
        $this->db->join("usuario","mensagens.id_usuario = usuario.id");
        $this->db->group_start();
        $this->db->or_where("transacao.comprador", $this->session->usuario_id);
        $this->db->or_where("transacao.vendedor", $this->session->usuario_id);
        $this->db->group_end();
        $this->db->where("mensagens.id_usuario !=", $this->session->usuario_id);
        $this->db->where("mensagens.visualizada", 0);
        return $this->db->get()->result();
    }

}
