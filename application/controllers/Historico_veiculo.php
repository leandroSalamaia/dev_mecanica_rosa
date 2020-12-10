<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Historico_veiculo extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_historico', 'historico');

        if ($this->session->userdata('user_data')['logado'] != 1) {
            redirect('/login', 'refresh');
        }
    }

    public function index()
    {
        $this->load->view('template/html-header');
        $this->load->view('template/menu');
        $this->load->view('historico_veiculo/read');
        $this->load->view('template/footer');
        $this->load->view('historico_veiculo/funcoes');
    }

    public function ajaxGetHistorico()
    {
        $dados['orcamentos_validos'] = $this->historico->ajaxGetHistorico($this->input->post('id'));
        foreach ($dados['orcamentos_validos'] as $key => $value) {
            $dados['componentes'][$value['orcamento_id']] = $this->historico->getOrcamentoProdutosById($value['orcamento_id']);
        }
        foreach ($dados['orcamentos_validos'] as $key => $value) {
            $dados['servicos'][$value['orcamento_id']] = $this->historico->getOrcamentoServicoById($value['orcamento_id']);
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($dados));
    }
}
