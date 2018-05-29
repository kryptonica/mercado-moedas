<?php

class Notificacao_c extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('notificacao');
    }

    public function get_notificacoes() {
        $mensagens = $this->notificacao->notificacao_mensagem();
        $notificacoes ["total"] = count($mensagens);
        foreach ($mensagens as $msg) {
            $notificacao = new stdClass();
            $notificacao->link = base_url("transacao/visualizar/$msg->id_transacao");
            $notificacao->data = formatar_data($msg->data_hora);
            $notificacao->hora = formatar_hora($msg->data_hora);
            $notificacao->msg = substr($msg->mensagem, 0, 50) . "...";
            $notificacao->usuario = $msg->nome_usuario;
            $notificacoes["conteudo"][] = $notificacao;
        }
//        print_r($mensagens);
//        return;
        echo json_encode($notificacoes);
    }

}
