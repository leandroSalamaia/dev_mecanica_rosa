<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orcamento extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_orcamento', 'orcamento');

        if ($this->session->userdata('user_data')['logado'] != 1) {
            redirect('/login', 'refresh');
        }
    }

    public function index()
    {
        $dados['orcamento'] = $this->orcamento->getOrcamentos();
        $this->load->view('template/html-header');
        $this->load->view('template/menu');
        $this->load->view('orcamento/read', $dados);
        $this->load->view('template/footer');
        $this->load->view('orcamento/funcoes');
    }

    public function create()
    {
        $data = $this->input->post();
        if (empty($data)) {
            $this->load->view('template/html-header');
            $this->load->view('template/menu');
            $this->load->view('orcamento/create');
            $this->load->view('template/footer');
            $this->load->view('orcamento/funcoes');
        } else {
            $dados = array(
                'cliente_carro_id'  => $data['carro'],
                'valor_total'       => str_replace(',', '.', str_replace('.', '', $data['valor_total']))
            );
            $orcamento_id = $this->orcamento->adicionarOrcamento($dados);

            if (!empty($data['codigo_produto'])) {
                foreach ($data['codigo_produto'] as $key => $value) {
                    $produto = array(
                        'orcamento_id'          => $orcamento_id,
                        'componentes_id'        => $value,
                        'valor'                 => str_replace(',', '.', str_replace('.', '', $data['valor_produto'][$key]))
                    );
                    $this->orcamento->adicionarComponente($produto);
                }
            }

            if (!empty($data['codigo_servico'])) {
                foreach ($data['codigo_servico'] as $key => $value) {
                    $servico = array(
                        'orcamento_id'      => $orcamento_id,
                        'servico_id'        => $value,
                        'valor'             => str_replace(',', '.', str_replace('.', '', $data['valor_servico'][$key]))
                    );
                    $this->orcamento->adicionarServico($servico);
                }
            }

            redirect('/produto', 'refresh');
        }
    }

    public function edit($id)
    {
        $data = $this->input->post();
        if (empty($data)) {
            $data['orcamento']  = $this->orcamento->getOrcamentoById($id);
            $data['produtos']   = $this->orcamento->getOrcamentoProdutosById($id);
            $data['servicos']   = $this->orcamento->getOrcamentoServicoById($id);

            $this->load->view('template/html-header');
            $this->load->view('template/menu');
            $this->load->view('orcamento/edit', $data);
            $this->load->view('template/footer');
            $this->load->view('orcamento/funcoes');
        } else {
            $dados = array(
                'orcamento_id'      => $data['orcamento_id'],
                'valor_total'       => str_replace(',', '.', str_replace('.', '', $data['valor_total']))
            );
            $this->orcamento->alterarOrcamento($dados);

            $this->orcamento->deleteComponente($data['orcamento_id']);
            $this->orcamento->deleteServico($data['orcamento_id']);

            if (!empty($data['codigo_produto'])) {
                foreach ($data['codigo_produto'] as $key => $value) {
                    $produto = array(
                        'orcamento_id'          => $data['orcamento_id'],
                        'componentes_id'        => $value,
                        'valor'                 => str_replace(',', '.', str_replace('.', '', $data['valor_produto'][$key]))
                    );
                    $this->orcamento->adicionarComponente($produto);
                }
            }

            if (!empty($data['codigo_servico'])) {
                foreach ($data['codigo_servico'] as $key => $value) {
                    $servico = array(
                        'orcamento_id'      => $data['orcamento_id'],
                        'servico_id'        => $value,
                        'valor'             => str_replace(',', '.', str_replace('.', '', $data['valor_servico'][$key]))
                    );
                    $this->orcamento->adicionarServico($servico);
                }
            }

            redirect('/orcamento', 'refresh');
        }
    }

    public function ajaxGetClientes()
    {
        $response = $this->orcamento->ajaxGetClientes($this->input->post('term'));
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function ajaxGetCarrosCliente()
    {
        $response = $this->orcamento->ajaxGetCarrosCliente($this->input->post('id'));
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function ajaxGetProdutos()
    {
        $response = $this->orcamento->ajaxGetProdutos($this->input->post('term'));
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function ajaxGetServicos()
    {
        $response = $this->orcamento->ajaxGetServicos($this->input->post('term'));
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function imprimirOrcamento($id)
    {
        $this->load->library('mpdf');
        $data['orcamento']  = $this->orcamento->getOrcamentoById($id);
        $data['produtos']   = $this->orcamento->getOrcamentoProdutosById($id);
        $data['servicos']   = $this->orcamento->getOrcamentoServicoById($id);

        $html = $this->load->view('orcamento/layout_orcamento_pdf', $data, true);

        $this->mpdf->method->WriteHTML($html);

        $this->mpdf->method->Output();
    }

    public function alterarStatusOrcamento($id, $status)
    {
        $this->orcamento->alterarStatusOrcamento($id, $status);
        redirect('/orcamento', 'refresh');
    }
}
