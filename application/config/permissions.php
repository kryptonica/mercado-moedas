<?php

$config['permission'] = array(//tudo que o usuario não pode acessar quando estiver logado
    'usuario_c' => array(
        'criar',
        'inserir',
    ),
    'login_c' => array(
        'index',
        'autenticar',
    ),
);

$config['exceptions'] = array(//tudo que um usuario pode acessar quando não estiver logado
    'login_c' => array(
        'index',
        'autenticar',
    ),
    'usuario_c' => array(
        'criar',
        'inserir',
    ),
    'home_c' => array(
        'index',
    ),
);
