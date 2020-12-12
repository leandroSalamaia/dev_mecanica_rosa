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
        $this->db->insert('fin_fluxo', $dados);
        return $this->db->insert_id();
    }

    public function insertEntrada($dados)
    {
        return $this->db->insert('fin_fluxo_entrada', $dados);
    }

    public function insertSaida($dados)
    {
        return $this->db->insert('fin_fluxo_saida', $dados);
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

    public function getTipoPagamento($valor)
    {
        $this->db->where('fluxo_tipo_id', $valor);
        return $this->db->get('fin_fluxo_tipo_pagamento')->result_array();
    }

    public function ajaxGetChart($data)
    {
        $query = $this->db->query("
            SELECT 
                Day('" . $data . "') as data_entrada,
                coalesce(SUM(ffe.valor) , '0') as valor_entrada,
                coalesce(SUM(ffs.valor) , '0') as valor_saida
            from fin_fluxo
            LEFT JOIN fin_fluxo_entrada ffe ON fin_fluxo.fluxo_id = ffe.fluxo_id
            LEFT JOIN fin_fluxo_saida ffs ON fin_fluxo.fluxo_id = ffs.fluxo_id
            where ffe.data_vencimento = '" . $data . "' OR ffs.data_vencimento = '" . $data . "'
        ")->row_array();

        return $query;
    }

    public function getContasEntrada($valor, $filtro)
    {
        $this->db->select('
         ffe.*,
         coalesce(ccf.nome,ccj.nome_fantasia) as cliente
         ', FALSE);
        $this->db->join('cliente_fisica ccf', 'ccf.cliente_id = ffe.cliente_id', 'left');
        $this->db->join('cliente_juridico ccj', 'ccj.cliente_id = ffe.cliente_id', 'left');
        $this->db->where('ffe.status', $valor);
        if (!empty($filtro['data_de'])) {
            $this->db->where('ffe.data_vencimento >=', $filtro['data_de']);
        }
        if (!empty($filtro['data_ate'])) {
            $this->db->where('ffe.data_vencimento <=', $filtro['data_ate']);
        }
        return $this->db->get('fin_fluxo_entrada ffe')->result_array();
    }

    public function getContasSaida($valor, $filtro)
    {
        $this->db->where('status', $valor);
        if (!empty($filtro['data_de'])) {
            $this->db->where('data_vencimento >=', $filtro['data_de']);
        }
        if (!empty($filtro['data_ate'])) {
            $this->db->where('data_vencimento <=', $filtro['data_ate']);
        }
        return $this->db->get('fin_fluxo_saida')->result_array();
    }

    public function AlteraStatusEntrada($status, $id)
    {
        $this->db->where('fluxo_entrada_id', $id);
        return $this->db->update('fin_fluxo_entrada', array('status' => $status));
    }

    public function AlteraStatusSaida($status, $id)
    {
        $this->db->where('fluxo_saida_id', $id);
        return $this->db->update('fin_fluxo_saida', array('status' => $status));
    }
}
