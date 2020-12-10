<?php
defined('BASEPATH') or exit('No direct script access allowed');

class produto extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_produto', 'modelproduto');

        if ($this->session->userdata('user_data')['logado'] != 1) {
            redirect('/login', 'refresh');
        }
    }

    public function index()
    {
        $dados['componente'] = $this->modelproduto->listarComponentes();
        $this->load->view('template/html-header');
        $this->load->view('template/menu');
        $this->load->view('produto/read', $dados);
        $this->load->view('template/footer');
        $this->load->view('produto/funcoes');
    }

    public function create()
    {
        $data = $this->input->post();
        if (empty($data)) {
            $this->load->view('template/html-header');
            $this->load->view('template/menu');
            $this->load->view('produto/create');
            $this->load->view('template/footer');
            $this->load->view('produto/funcoes');
        } else {
            $data['valor'] = str_replace(',', '.', str_replace('.', '', $data['valor']));
            $this->modelproduto->adicionarProduto($data);
            redirect('/produto', 'refresh');
        }
    }

    public function edit($id = null)
    {
        $data = $this->input->post();
        if (empty($data)) {
            $dados['componentes'] = $this->modelproduto->SelectComponentes($id);
            $this->load->view('template/html-header');
            $this->load->view('template/menu');
            $this->load->view('produto/edit', $dados);
            $this->load->view('template/footer');
            $this->load->view('produto/funcoes');
        } else {
            $data['valor'] = str_replace(',', '.', str_replace('.', '', $data['valor']));
            $this->modelproduto->editProduto($data);
            redirect('/produto', 'refresh');
        }
    }
}
