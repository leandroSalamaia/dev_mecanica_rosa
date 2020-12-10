<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Financeiro extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_financeiro', 'financeiro');
        $this->load->model('model_generica', 'generica');

        if ($this->session->userdata('user_data')['logado'] != 1) {
            redirect('/login', 'refresh');
        }
    }

    public function index()
    {
        $dados['formas_pagamento'] = $this->financeiro->getFormasPagamento();
        $this->load->view('template/html-header');
        $this->load->view('template/menu');
        $this->load->view('financeiro/read', $dados);
        $this->load->view('financeiro/modal');
        $this->load->view('template/footer');
        $this->load->view('financeiro/funcoes');
    }

    public function ajaxGetClientes()
    {
        $response = $this->financeiro->ajaxGetClientes($this->input->post('term'));
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function ajaxSeteEntrada()
    {
        $data = $this->input->post();

        $fluxo_id = $this->financeiro->insertFluxo(1);

        if ($data['marcar_todos_pagos'] == "true") {
            for ($i = 0; $i < $data['multiplicador']; $i++) {
                $data_vencimento = date('Y-m-d', strtotime('+' . $i . ' month', strtotime($data['data_vencimento'])));
                $data_pagamento = date('Y-m-d', strtotime('+' . $i . ' month', strtotime($data['data_pagamento'])));

                $dados = array(
                    'fluxo_id'              => $fluxo_id,
                    'data_vencimento'       => $data_vencimento,
                    'status'                => $data['status_pagamento'],
                    'data_pagamento'        => $data_pagamento,
                    'valor'                 => str_replace(',', '.', str_replace('.', '', $data['valor'])),
                    'cliente_id'            => !empty($data['cliente']) ? $data['cliente'] : null,
                    'forma_pagamento_id'    => $data['forma_pagamento']
                );

                $this->financeiro->insertEntrada($dados);
            }
        } else {
            for ($i = 0; $i < $data['multiplicador']; $i++) {
                $data_vencimento = date('Y-m-d', strtotime('+' . $i . ' month', strtotime($data['data_vencimento'])));

                if ($i == 0) {
                    $dados = array(
                        'fluxo_id'              => $fluxo_id,
                        'data_vencimento'       => $data_vencimento,
                        'status'                => $data['status_pagamento'],
                        'data_pagamento'        => $data['data_pagamento'],
                        'valor'                 => str_replace(',', '.', str_replace('.', '', $data['valor'])),
                        'cliente_id'            => !empty($data['cliente']) ? $data['cliente'] : null,
                        'forma_pagamento_id'    => $data['forma_pagamento']
                    );

                    $this->financeiro->insertEntrada($dados);
                } else {
                    $dados = array(
                        'fluxo_id'          => $fluxo_id,
                        'data_vencimento'   => $data_vencimento,
                        'status'            => 0,
                        'valor'             => str_replace(',', '.', str_replace('.', '', $data['valor'])),
                        'cliente_id'        => !empty($data['cliente']) ? $data['cliente'] : null,
                    );

                    $this->financeiro->insertEntrada($dados);
                }
            }
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($fluxo_id));
    }
}
