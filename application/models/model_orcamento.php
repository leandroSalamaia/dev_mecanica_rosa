<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_orcamento extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getOrcamentos()
    {
        $this->db->select("
            orcamento_id,
            coalesce(ccf.nome ,ccj.nome_fantasia) cliente,
            cm.nome as carro,
            FORMAT(go.valor_total,2,'de_DE') as total,
            data_criacao,
            go.status_execucao
        ", FALSE);
        $this->db->join('cliente_carro cc', 'cc.cliente_carro_id = go.cliente_carro_id', 'left');
        $this->db->join('cliente_fisica ccf', 'ccf.cliente_id = cc.cliente_id', 'left');
        $this->db->join('cliente_juridico ccj', 'ccj.cliente_id = cc.cliente_id', 'left');
        $this->db->join('carro_modelo cm', 'cm.modelo_id = cc.modelo_id', 'left');
        $this->db->order_by('orcamento_id', 'desc');
        return $this->db->get('ger_orcamento go')->result_array();
    }

    public function getOrcamentoById($id)
    {
        $this->db->select("
            orcamento_id,
            coalesce(ccf.nome ,ccj.nome_fantasia) cliente,
            cm.nome as carro,
            FORMAT(go.valor_total,2,'de_DE') as total,
            data_criacao
        ", FALSE);
        $this->db->join('cliente_carro cc', 'cc.cliente_carro_id = go.cliente_carro_id', 'left');
        $this->db->join('cliente_fisica ccf', 'ccf.cliente_id = cc.cliente_id', 'left');
        $this->db->join('cliente_juridico ccj', 'ccj.cliente_id = cc.cliente_id', 'left');
        $this->db->join('carro_modelo cm', 'cm.modelo_id = cc.modelo_id', 'left');
        $this->db->where('orcamento_id', $id);
        return $this->db->get('ger_orcamento go')->row_array();
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

    public function adicionarOrcamento($dados)
    {
        $this->db->insert('ger_orcamento', $dados);
        return $this->db->insert_id();
    }

    public function alterarOrcamento($dados)
    {
        $this->db->where('orcamento_id', $dados['orcamento_id']);
        return $this->db->update('ger_orcamento', $dados);
    }

    public function adicionarComponente($dados)
    {
        return $this->db->insert('ger_orcamento_componentes', $dados);
    }

    public function adicionarServico($dados)
    {
        return $this->db->insert('ger_orcamento_servico', $dados);
    }

    public function deleteComponente($id)
    {
        $this->db->where('orcamento_id', $id);
        return $this->db->delete('ger_orcamento_componentes');
    }

    public function deleteServico($id)
    {
        $this->db->where('orcamento_id', $id);
        return $this->db->delete('ger_orcamento_servico');
    }

    public function alterarStatusOrcamento($id, $status)
    {
        $this->db->where('orcamento_id', $id);
        return $this->db->update('ger_orcamento', array('status_execucao' => $status));
    }

    public function ajaxGetProdutos($dados)
    {
        $this->db->select("
            cc.nome,
            FORMAT(cc.valor,2,'de_DE') as valor,
            cc.componentes_id
        ", FALSE);
        $this->db->like('cc.nome', $dados);
        return $this->db->get('cad_componentes cc')->result_array();
    }

    public function ajaxGetServicos($dados)
    {
        $this->db->select("
        cs.nome,
        FORMAT(cs.valor,2,'de_DE') as valor,
        cs.servico_id
        ", FALSE);
        $this->db->like('cs.nome', $dados);
        return $this->db->get('cad_servico cs')->result_array();
    }

    public function ajaxGetClientes($dados)
    {
        $this->db->select('
            DISTINCT
            cc.cliente_id,
            cc.telefone,
            cc.rua,
            cc.bairro,
            coalesce(cf.nome,cj.nome_fantasia) as nome,
            coalesce(cf.cpf,cj.cnpj) as cpf_cnpj
        ', FALSE);
        $this->db->like('cf.nome', $dados);
        $this->db->or_like('cj.nome_fantasia', $dados);
        $this->db->join('cliente_fisica cf', 'cf.cliente_id = cc.cliente_id', 'left');
        $this->db->join('cliente_juridico cj', 'cj.cliente_id = cc.cliente_id', 'left');
        return $this->db->get('cad_cliente cc')->result_array();
    }

    public function ajaxGetCarrosCliente($id)
    {
        $this->db->select('
            cc.cliente_carro_id,
            cc.placa,
            cm.nome as modelo,
            cmm.nome as marca
        ', FALSE);

        $this->db->where('cliente_id', $id);
        $this->db->join('carro_modelo cm', 'cm.modelo_id = cc.modelo_id', 'left');
        $this->db->join('carro_marca cmm', 'cmm.marca_id = cm.marca_id', 'left');
        return $this->db->get('cliente_carro cc')->result_array();
    }
}
