<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_produto extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function listarComponentes()
    {
        $this->db->order_by('componentes_id', 'desc');
        return $this->db->get('cad_componentes')->result();
    }

    public function adicionarProduto($data)
    {
        $this->db->insert('cad_componentes', $data);
    }

    public function editProduto($data)
    {
        $this->db->where('componentes_id', $data['componentes_id']);
        $this->db->update('cad_componentes', $data);
    }

    public function SelectComponentes($data)
    {
        $this->db->where('componentes_id', $data);
        return $this->db->get('cad_componentes')->row_array();
    }
}
