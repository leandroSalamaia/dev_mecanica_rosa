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
        $data = $this->input->post();
        $filtro = '';
        if (!empty($data)) {

            $filtro = array(
                'data_de'   => !empty($data['data_de']) ? $data['data_de'] : null,
                'data_ate'   => !empty($data['data_ate']) ? $data['data_ate'] : null
            );
        }
        $dados['formas_pagamento'] = $this->financeiro->getFormasPagamento();
        $dados['entrada'] = $this->financeiro->getTipoPagamento(1);
        $dados['saida'] = $this->financeiro->getTipoPagamento(2);

        $dados['entradas_pendentes'] = $this->financeiro->getContasEntrada(0, $filtro);
        $dados['saidas_pendentes'] = $this->financeiro->getContasSaida(0, $filtro);
        $dados['entradas_pagas'] = $this->financeiro->getContasEntrada(1, $filtro);
        $dados['saida_pagas'] = $this->financeiro->getContasSaida(1, $filtro);

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

        $fluxo = array(
            'tipo'                  => 1,
            'fluxo_tipo_pagamento'  => $data['tipo_pagamento']
        );

        $fluxo_id = $this->financeiro->insertFluxo($fluxo);

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

    public function ajaxSetSaida()
    {
        $data = $this->input->post();

        $fluxo = array(
            'tipo'                  => 2,
            'fluxo_tipo_pagamento'  => $data['tipo_pagamento']
        );

        $fluxo_id = $this->financeiro->insertFluxo($fluxo);

        $dados = array(
            'fluxo_id'              => $fluxo_id,
            'data_vencimento'       => $data['data_vencimento'],
            'status'                => $data['status_pagamento'],
            'data_pagamento'        => !empty($data['data_pagamento']) ? $data['data_pagamento'] : null,
            'valor'                 => str_replace(',', '.', str_replace('.', '', $data['valor'])),
            'forma_pagamento_id'    => $data['forma_pagamento']
        );

        $this->financeiro->insertSaida($dados);

        $this->output->set_content_type('application/json')->set_output(json_encode($fluxo_id));
    }

    public function ajaxGetChart()
    {
        $data_incio = mktime(0, 0, 0, date('m'), 1, date('Y'));
        $data_fim = mktime(23, 59, 59, date('m'), date("t"), date('Y'));

        $inicio = new DateTime(date('Y-m-d', $data_incio));
        $fim = new DateTime(date('Y-m-d', $data_fim));
        $fim = $fim->modify('+1 day');

        $periodo = new DatePeriod($inicio, new DateInterval('P1D'), $fim);

        $validos = [];
        foreach ($periodo as $item) {

            $validos[] = $this->financeiro->ajaxGetChart($item->format('Y-m-d'));
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($validos));
    }

    public function AlteraStatusEntrada($status, $id)
    {
        $this->financeiro->AlteraStatusEntrada($status, $id);
        redirect('/financeiro', 'refresh');
    }

    public function AlteraStatusSaida($status, $id)
    {
        $this->financeiro->AlteraStatusSaida($status, $id);
        redirect('/financeiro', 'refresh');
    }
}
