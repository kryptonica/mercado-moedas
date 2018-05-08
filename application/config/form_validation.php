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
            'rules' => 'required',
        ),
        array(
            'field' => 'confirmar-senha',
            'label' => 'Confirmar Senha',
            'rules' => 'required|matches[senha]',
        ),
    ),
);
