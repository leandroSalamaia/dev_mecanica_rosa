<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_login', 'login');
    }

    public function index()
    {
        $this->load->view('template/login');
    }

    function login_validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run()) {
            $dados = array(
                'username'  => $this->input->post('username'),
                'password'  => sha1($this->input->post('password')),
            );
            $return = $this->login->login_validation($dados);

            if ($return) {
                $session_data = array(
                    'username'  => $dados['username'],
                    'logado'    => true
                );
                $this->session->set_userdata('user_data', $session_data);
                redirect(base_url() . 'orcamento');
            }
        } else {
            $this->session->set_flashdata('error', 'E-mail ou Senha Inválidos!');
            redirect(base_url() . 'login');
        }
    }

    public function Logount()
    {
        $this->session->unset_userdata('user_data');
        redirect(base_url() . 'login');
    }
}
