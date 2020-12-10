<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cliente extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_cliente', 'modelCliente');
        $this->load->model('model_generica', 'generica');

        if ($this->session->userdata('user_data')['logado'] != 1) {
            redirect('/login', 'refresh');
        }
    }

    public function index()
    {
        $dados['cliente'] = $this->modelCliente->listar_clientes();
        $this->load->view('template/html-header');
        $this->load->view('template/menu');
        $this->load->view('cliente/read', $dados);
        $this->load->view('template/footer');
        $this->load->view('cliente/funcoes');
    }

    public function create()
    {
        $data = $this->input->post();
        if (empty($data)) {
            $dados['modelo_marca'] = $this->modelCliente->getModeloMarca();

            $this->load->view('template/html-header');
            $this->load->view('template/menu');
            $this->load->view('cliente/create', $dados);
            $this->load->view('template/footer');
            $this->load->view('cliente/funcoes');
        } else {
            $dados = array(
                'telefone'          => !empty($data['telefone'])        ? $data['telefone']     : null,
                'cep'               => !empty($data['cep'])             ? $data['cep']          : null,
                'rua'               => !empty($data['rua'])             ? $data['rua']          : null,
                'numero'            => !empty($data['numero'])          ? $data['numero']       : null,
                'bairro'            => !empty($data['bairro'])          ? $data['bairro']       : null,
                'cidade'            => !empty($data['cidade'])          ? $data['cidade']       : null,
                'complemento'       => !empty($data['complemento'])     ? $data['complemento']  : null,
                'tipo_cliente'      => !empty($data['cpf'])             ? '1'                   : 2
            );
            $cliente_id = $this->generica->insert_generico('cad_cliente', $dados);

            if (!empty($data['cpf'])) {
                $dados = array(
                    'cliente_id'    => $cliente_id,
                    'nome'          => !empty($data['nome'])    ? $data['nome']     : null,
                    'cpf'           => !empty($data['cpf'])     ? $data['cpf']      : null
                );
                $this->generica->insert_generico('cliente_fisica', $dados);
            } else {
                $dados = array(
                    'cliente_id'        => $cliente_id,
                    'nome_fantasia'     => !empty($data['nome_fantasia'])   ? $data['nome_fantasia']    : null,
                    'cnpj'              => !empty($data['cnpj'])            ? $data['cnpj']             : null,
                    'razao_social'      => !empty($data['razao_social'])    ? $data['razao_social']     : null
                );
                $this->generica->insert_generico('cliente_juridico', $dados);
            }

            foreach ($data['modelo_marca'] as $key => $value) {
                $dados = array(
                    'cliente_id'        => $cliente_id,
                    'modelo_id'         => !empty($data['modelo_marca'][$key])    ? $data['modelo_marca'][$key]     : null,
                    'ano'               => !empty($data['ano'][$key])             ? $data['ano'][$key]             : null,
                    'combustivel_id'    => !empty($data['combustivel'][$key])     ? $data['combustivel'][$key]     : null,
                    'placa'             => !empty($data['placa'][$key])           ? $data['placa'][$key]           : null
                );
                $this->generica->insert_generico('cliente_carro', $dados);
            }

            redirect('/cliente', 'refresh');
        }
    }

    public function edit($id)
    {
        $data = $this->input->post();
        if (empty($data)) {

            $dados['cliente']       = $this->modelCliente->listar_clientes($id);
            $dados['modelo_marca']  = $this->modelCliente->getModeloMarca();
            $dados['carros']        = $this->modelCliente->getCarros($id);

            // print_r($dados['carros']);
            // die();

            $this->load->view('template/html-header');
            $this->load->view('template/menu');
            $this->load->view('cliente/edit', $dados);
            $this->load->view('template/footer');
            $this->load->view('cliente/funcoes');
        } else {

            $cliente_id = $data['cliente_id'];
            if (!empty($data['cliente_fisico'])) {
                $dados = array(
                    'cliente_id'    => $cliente_id,
                    'nome'          => $data['nome'],
                    'cpf'           => $data['cpf'],
                    'rg'            => $data['rg']
                );
                $this->modelCliente->editClienteFisico($dados, $cliente_id);
            } else {
                $dados = array(
                    'cliente_id'        => $cliente_id,
                    'nome_fantasia'     => $data['nome_fantasia'],
                    'cnpj'              => $data['cnpj'],
                    'razao_social'      => $data['razao_social']
                );
                $this->modelCliente->editClienteJuridico($dados, $cliente_id);
            }

            $this->modelCliente->deleteDados($cliente_id);

            $dados = array(
                'cliente_id'        => $cliente_id,
                'cep'               => $data['cep'],
                'rua'               => $data['rua'],
                'numero'            => $data['numero'],
                'bairro'            => $data['bairro'],
                'cidade'            => $data['cidade'],
                'complemento'       => $data['complemento'],
            );
            $this->modelCliente->editClienteEndereco($dados, $cliente_id);

            foreach ($data['telefone'] as $key => $value) {
                $dados = array(
                    'cliente_id'    => $cliente_id,
                    'telefone'      => $value,
                    'nome_contato'  => $data['nome_telefone'][$key]
                );

                $this->modelCliente->addClienteTelefone($dados);
            }

            foreach ($data['email'] as $key => $value) {
                $dados = array(
                    'cliente_id'    => $cliente_id,
                    'email'         => $value,
                );
                $this->modelCliente->addClienteEmail($dados);
            }
            redirect('/cliente', 'refresh');
        }
    }
}
