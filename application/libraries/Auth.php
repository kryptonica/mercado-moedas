<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth {

    private $CI;
    private $permissions;
    private $exceptions;

    public function __construct() {
        $this->CI = &get_instance();
        $this->CI->config->load('permissions');//arquivo na pasta config/permissions.php
        $this->permissions = $this->CI->config->item('permission');
        $this->exceptions = $this->CI->config->item('exceptions');
        if ($this->CI->session->logado) {
            if ($this->check_permissions($this->CI->router->class, $this->CI->router->method)) {//se o user estiver logado, verifica se o que ele ta tentando acessar está na 'lista negra', se sim, ele é redirecionado pra pagina inicial senão, não faz nada
                redirect('/');
            }
        } else {
            if (!$this->check_exceptions($this->CI->router->class, $this->CI->router->method)) {//se o usuário não estiver logado, verifica se ele tem permissão pra acessar a pagina, se sim, não faz nada, senão ele é redirecionado para a pag de login
                redirect('login');
            }
        }
    }



    function check_exceptions($classe, $metodo) {
        $classe = strtolower($classe);
        $metodo = strtolower($metodo);
        if (isset($this->exceptions[$classe])) {
            if (in_array($metodo, $this->exceptions[$classe])) {
                return true;
            }
        }
        return false;
    }
    
    function check_permissions($classe, $metodo) {
        $classe = strtolower($classe);
        $metodo = strtolower($metodo);
        if (isset($this->permissions[$classe])) {
            if (in_array($metodo, $this->permissions[$classe])) {
                return true;
            }
        }
        return false;
    }

}
