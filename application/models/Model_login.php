<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_login extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function login_validation($dados)
    {
        $this->db->where('senha', $dados['password']);
        $this->db->where('email', $dados['username']);

        if ($this->db->get('use_usuario')->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
