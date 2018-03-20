<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Exemplo_c extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('exemplo');
    }

    public function index() {
        $this->load->view("exemplo");
    }
    
    /*
        No padrão que a gente vai usar cada tabela tem um model individual
     * 
     * As consultas no banco devem ser feitas com os métodos definidos no model padrão que está na pasta Core/My_Model
     * Todos os models herdam dele e todos os controllers devem herdar de MY_Controller
     * As cláusulas e os parâmetros das consulas devem ser passados em um array
     * Assim: $this->exemplo->buscar(["clausula" => ["campo_do_banco" => "valor"]);
     * Se eu quisesse buscar na tabela exemplo a linha com id = 4 ficaria assim
     * $this->exemplo->buscar_row(["where" => ["id" => 4]]);
     * E o método retonaria um objeto do banco com todas as informações da linha. Cada coluna é um atributo do objeto.
     * 
     * Se eu quisesse buscar na tabela exemplo todas as linhas com nome = joao ficaria assim
     * $this->exemplo->buscar(["where" => ["nome" => "joao"]]);
     * E o método retonaria um array de objetos do banco com todoas as linhas correspondentes.
     * 
     * Vocês podem usar qualquer cláusula do sql ali no lugar do where seguindo o padrão do codeigniter
     * Ex: or_where, like, or_like, where_in ... etc;
     * Os demais métodos de My_model são de uso básico como inserir, remover e etc... vocês podem olhar lá que é facil
     * de entender.
     * 
     * Funções para consultas mais específicas com joins e etc... devem ser criadas nos models das tabelas
     * de acordo com a necessidade.
     * 
     * O resto vcs pegam com o tempo.
     * 
     *      */
}
