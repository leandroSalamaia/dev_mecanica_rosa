<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_historico extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function ajaxGetHistorico($id)
    {
        $this->db->where('status_execucao', '1');
        $this->db->where('cliente_carro_id', $id);
        return $this->db->get('ger_orcamento')->result_array();
    }

    public function getOrcamentoProdutosById($id)
    {
        $this->db->select("
            gom.*,
            FORMAT(gom.valor,2,'de_DE') as valor,
            cc.nome
        ", FALSE);
        $this->db->join('cad_componentes cc', 'cc.componentes_id = gom.componentes_id', 'left');
        $this->db->where('orcamento_id', $id);
        return $this->db->get('ger_orcamento_componentes gom')->result_array();
    }

    public function getOrcamentoServicoById($id)
    {
        $this->db->select("
            gos.*,
            FORMAT(gos.valor,2,'de_DE') as valor,
            cs.nome
        ", FALSE);
        $this->db->join('cad_servico cs', 'cs.servico_id = gos.servico_id', 'left');
        $this->db->where('orcamento_id', $id);
        return $this->db->get('ger_orcamento_servico gos')->result_array();
    }
}
