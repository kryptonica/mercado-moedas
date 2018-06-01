<?php

class Notificacao_c extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('notificacao');
    }

    public function get_notificacoes() {
        $mensagens = $this->notificacao->notificacao_mensagem();
        $transacoes_recebidas = $this->notificacao->notificacao_transacao_recebida();
        $transacoes_aceitas = $this->notificacao->notificacao_transacao_aceita();
        
        $notificacoes ["total"] = count($mensagens) + count($transacoes_recebidas) + count($transacoes_aceitas);
        
        foreach ($mensagens as $msg) {
            $notificacao = new stdClass();
            $notificacao->link = base_url("transacao/visualizar/$msg->id_transacao");
            $notificacao->data = formatar_data($msg->data_hora);
            $notificacao->hora = formatar_hora($msg->data_hora);
            $notificacao->msg = substr($msg->mensagem, 0, 50) . "...";
            $notificacao->usuario = $msg->nome_usuario;
            $notificacao->tipo = "msg";
            $notificacoes["conteudo"][] = $notificacao;
        }
        
        foreach ($transacoes_recebidas as $transacao) {
            $notificacao = new stdClass();
            $notificacao->link = base_url("transacao/visualizar/$transacao->id");
            $notificacao->data = formatar_data($transacao->data_hora);
            $notificacao->hora = formatar_hora($transacao->data_hora);
            $notificacao->anuncio = substr($transacao->titulo_anuncio, 0, 50) . "...";
            $notificacao->tipo = "transacao_recebida";
            $notificacoes["conteudo"][] = $notificacao;
        }
        
        foreach ($transacoes_aceitas as $transacao) {
            $notificacao = new stdClass();
            $notificacao->link = base_url("transacao/visualizar/$transacao->id");
            $notificacao->data = formatar_data($transacao->data_hora);
            $notificacao->hora = formatar_hora($transacao->data_hora);
            $notificacao->anuncio = substr($transacao->titulo_anuncio, 0, 50) . "...";
            $notificacao->tipo = "transacao_aceita";
            $notificacoes["conteudo"][] = $notificacao;
        }
//        print_r($notificacoes);
//        return;
        echo json_encode($notificacoes);
    }

}
