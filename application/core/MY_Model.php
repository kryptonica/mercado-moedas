<?php

class MY_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    protected $tabela;

    public function inserir($dados) {
        $this->db->insert($this->tabela, $dados);
        $id = $this->db->insert_id();
        return $id;
    }

    /**
     * Atualiza um registro no banco
     * 
     * @param int $id
     * @param array $dados
     */
    public function atualizar($id, $dados) {
        $this->db->where('id', $id);
        return ($this->db->update($this->tabela, $dados));
    }

    public function remover($id) {
        $this->db->where('id', $id);
        return ($this->db->delete($this->tabela));
    }

    /**
     * Realiza uma busca dinamica de acordo com cláusulas (where, or_where...) e parametros (id, nome...) recebidos
     * E de acordo com a paginação (pagina e quantidade por página)
     * 
     * @param array $filters (clausulas e parametros)
     * @param array $paginacao (pagina e quantidade por página)
     * @return array
     */
    public function buscar($filters = array(), $paginacao = array(), $ordenacao = array()) {//retorna um array de objetos
        if (!empty($filters)) {
            $this->get_filtros($filters);
        }
        if (!empty($paginacao)) {
            $this->get_pagincacao($paginacao);
        }
        $this->order_by($ordenacao);
        return $this->db->get($this->tabela)->result();
    }

    public function buscar_row($filters = array(), $paginacao = array()) {//retorna um objeto único
        if (!empty($filters)) {
            $this->get_filtros($filters);
        }
        if (!empty($paginacao)) {
            $this->get_pagincacao($paginacao);
        }
        return $this->db->get($this->tabela)->row();
    }

    /**
     * Retorna um array associativo no formato 'id' => 'nome'
     * 
     * @param array $filters
     * @return array
     */
    public function buscar_array($filters = array()) {//ideal para selects
        $itens = $this->buscar($filters);
        $dados = ['' => '-- Selecione --'];
        foreach ($itens as $item) {
            $dados[$item->id] = $item->nome;
        }
        return $dados;
    }

    public function total($filters = array()) {
        $this->get_filtros($filters);
        return $this->db->count_all_results($this->tabela);
    }

    /**
     * Inclui filtros na consulta
     * 
     * @param array $filters
     */
    protected function get_filtros($filters) {
        foreach ($filters as $clause => $parametros) {
            $this->db->group_start();
            foreach ($parametros as $key => $value) {
                $this->db->{$clause}($key, $value);
            }
            $this->db->group_end();
        }
    }

    /**
     * Inclui filtro referente à paginação
     * 
     * @param array $paginacao
     */
    protected function get_pagincacao($paginacao) {
        if (!empty($paginacao)) {
            $pagina = $paginacao['pagina'] - 1;
            $pagina = ($pagina < 0) ? 0 : $pagina;
            $inicio = $pagina * $paginacao['quantidade'];

            $this->db->limit($paginacao['quantidade'], $inicio);
        }
    }

    protected function order_by($ordenacao = array()) {
        if (!empty($ordenacao)) {
            $order = $ordenacao;
        } else {
            $order = $this->ordenacao;
        }

        foreach ($order as $campo => $ordem) {
            $this->db->order_by($campo, $ordem);
        }
    }

}
