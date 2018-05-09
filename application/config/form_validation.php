<?php

$config = array(
    'login_c/autenticar' => array(
        array(
            'field' => 'senha',
            'label' => 'Senha',
            'rules' => 'required',
        ),
        array(
            'field' => 'email',
            'label' => 'E-mail',
            'rules' => 'required|valid_email',
        ),
    ),
    'usuario_c/inserir' => array(
        array(
            'field' => 'nome',
            'label' => 'Nome',
            'rules' => 'required',
        ),
        array(
            'field' => 'email',
            'label' => 'E-mail',
            'rules' => 'required|valid_email|is_unique[usuario.email]',
        ),
        array(
            'field' => 'nascimento',
            'label' => 'Data de Nascimento',
            'rules' => 'required',
        ),
        array(
            'field' => 'senha',
            'label' => 'Senha',
            'rules' => 'required|min_length[8]',
        ),
        array(
            'field' => 'confirmar-senha',
            'label' => 'Confirmar Senha',
            'rules' => 'required|matches[senha]',
        ),
    ),
    'anuncio_c/confirmar_atualizacao' => array(
        array(
            'field' => 'titulo',
            'label' => 'Nome',
            'rules' => 'required',
        ),
        array(
            'field' => 'descricao',
            'label' => 'Descrição',
            'rules' => 'required',
        ),
        array(
            'field' => 'preco',
            'label' => 'Preço',
            'rules' => 'required',
        ),
        array(
            'field' => 'quantidade',
            'label' => 'Quantidade',
            'rules' => 'required',
        ),
        array(
            'field' => 'tipo_moeda',
            'label' => 'Tipo de moeda',
            'rules' => 'required',
        ),
    ),
    'anuncio_c/confirmar_cadastro' => array(
        array(
            'field' => 'titulo',
            'label' => 'Nome',
            'rules' => 'required',
        ),
        array(
            'field' => 'descricao',
            'label' => 'Descrição',
            'rules' => 'required',
        ),
        array(
            'field' => 'preco',
            'label' => 'Preço',
            'rules' => 'required',
        ),
        array(
            'field' => 'quantidade',
            'label' => 'Quantidade',
            'rules' => 'required',
        ),
        array(
            'field' => 'tipo_moeda',
            'label' => 'Tipo de moeda',
            'rules' => 'required',
        ),
    ),
    'usuario_c/alterar_senha' => array(
        array(
            'field' => 'senha_atual',
            'label' => 'Senha Atual',
            'rules' => 'required',
        ),
        array(
            'field' => 'nova_senha',
            'label' => 'Nova Senha',
            'rules' => 'required|min_length[8]',
        ),
        array(
            'field' => 'confirm_nova_senha',
            'label' => 'Confirmação da nova senha',
            'rules' => 'required|matches[nova_senha]',
        ),
    ),
    'anuncio_c/remover_anuncio' => array(
        array(
            'field' => 'id',
            'label' => 'Id',
            'rules' => 'required',
        ),
    ),
);
