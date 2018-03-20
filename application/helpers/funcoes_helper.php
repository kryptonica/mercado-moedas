<?php

function formatar_data($date_time)
{
    return date("d/m/Y", strtotime($date_time));
}

function formatar_data_mysql($date_time)
{
    return $date_time != null ? date("Y-m-d", strtotime($date_time)) : null;
}

function formatar_datetime_mysql($date_time)
{
    return $date_time != null ? date("Y-m-d H:i:s", strtotime($date_time)) : null;
}

function formatar_datetime($date_time)
{
    return date("d/m/Y H:i:s", strtotime($date_time));
}

function formatar_hora($date_time)
{
    return $date_time != null ? date("H:i:s", strtotime($date_time)) : null;
}

function formatar_datetime_local($date_time)
{
    return date("Y-m-d\TH:i:s", strtotime($date_time));
}

function buscar_query_url()
{
    return http_build_query($_GET, '', "&");
}

function adicionar_alerta($tipo, $msg)
{
    $CI = &get_instance();
    $alertas = $CI->session->flashdata('alertas');
    $novo = array(
        'class' => "alert alert-$tipo",
        'mensagem' => "$msg"
    );
    
    if ($alertas != null) {
        array_push($alertas, $novo);
    } else {
        $alertas[] = $novo;
    }
    
    $CI->session->set_flashdata('alertas', $alertas);
}

function get_array_select($itens, $id = "id", $nome = "nome")
{
    $result = [];
    foreach ($itens as $item) {
        $result[$item->{$id}] = $item->{$nome};
    }
    return $result;
}

function get_selected_array($itens, $id = "id")
{
    $result = [];
    foreach ($itens as $item) {
        $result[] = $item->{$id};
    }
    return $result;
}

function get_ids($items)
{
    $result = [];
    foreach ($items as $item) {
        $result[] = $item->id;
    }
    return $result;
}
