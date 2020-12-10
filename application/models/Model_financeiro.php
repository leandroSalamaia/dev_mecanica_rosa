<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_financeiro extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function insertFluxo($dados)
    {
        $this->db->insert('fin_fluxo', array('tipo' => $dados));
        return $this->db->insert_id();
    }

    public function insertEntrada($dados)
    {
        return $this->db->insert('fin_fluxo_entrada', $dados);
    }

    public function ajaxGetClientes($dados)
    {
        $this->db->select('
            DISTINCT
            cc.cliente_id,
            coalesce(cf.nome,cj.nome_fantasia) as nome
        ', FALSE);
        $this->db->like('cf.nome', $dados);
        $this->db->or_like('cj.nome_fantasia', $dados);
        $this->db->join('cliente_fisica cf', 'cf.cliente_id = cc.cliente_id', 'left');
        $this->db->join('cliente_juridico cj', 'cj.cliente_id = cc.cliente_id', 'left');
        return $this->db->get('cad_cliente cc')->result_array();
    }

    public function getFormasPagamento()
    {
        return $this->db->get('fin_fluxo_forma_pagamento')->result_array();
    }
}
