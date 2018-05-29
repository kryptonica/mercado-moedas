<?php

class Mensagem extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->tabela = 'mensagens';
        $this->ordenacao = [
            'data_hora' => 'asc',
        ];
    }
    
     public function buscar_com_relacoes($filtros = array()) {
        $this->get_filtros($filtros);
        $this->order_by();
        $result = $this->db->get($this->tabela)->result();

        $this->load->model('usuario');
        $mensagens = array();

        foreach ($result as $mensagem) {
            $mensagem->usuario = $this->usuario->buscar_row(['where' => ['id' => $mensagem->id_usuario]]);
            $mensagens[] = $mensagem;
        }

        return $mensagens;
    }
    
    public function atualizar_status_mensagens($transacao_id, $usuario_id){
        $this->db->where('id_usuario !=', $usuario_id);
        $this->db->where('id_transacao ', $transacao_id);
        return $this->db->update($this->tabela, ["visualizada" => 1]);
    }
    
}
