<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_cliente extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function listar_clientes($id_cliente = null)
    {
        $this->db->select('
         cc.cliente_id as id,
         cc.*,
         ccf.*,
         ccj.*,
         coalesce(ccf.nome,ccj.nome_fantasia) as nome,
         coalesce(ccf.cpf,ccj.cnpj) as cpf_cnpj
         ', FALSE);
        $this->db->join('cliente_fisica ccf', 'ccf.cliente_id = cc.cliente_id', 'left');
        $this->db->join('cliente_juridico ccj', 'ccj.cliente_id = cc.cliente_id', 'left');
        if (!empty($id_cliente)) {
            $this->db->where('cc.cliente_id', $id_cliente);
            return $this->db->get('cad_cliente cc')->row_array();
        } else {
            $this->db->order_by('cc.cliente_id', 'desc');
            return $this->db->get('cad_cliente cc')->result_array();
        }
    }

    public function getCarros($id_cliente)
    {
        $this->db->select('
         ccc.*
         ', FALSE);
        $this->db->where('ccc.cliente_id', $id_cliente);
        return $this->db->get('cliente_carro ccc')->result_array();
    }



    ///////////////////////////
    /////////
    /////////----> INICIO DO CREATE
    /////////
    //////////////////////////

    public function addCliente($dados)
    {
        $this->db->insert('cliente', $dados);
        $id_cliente = $this->db->insert_id();
        return $id_cliente;
    }

    public function addClienteFisico($data)
    {
        return $this->db->insert('cliente_fisica', $data);
    }

    public function addClienteJuridico($data)
    {
        return $this->db->insert('cliente_juridico', $data);
    }

    public function addClienteCarro($data)
    {
        return $this->db->insert('cliente_carro', $data);
    }

    public function addClienteTelefone($data)
    {
        return $this->db->insert('cad_cliente_telefone', $data);
    }

    ///////////////////////////
    /////////
    /////////----> FIM DO CREATE
    /////////
    ///////////////////////////////////////////////////////////


    //////////////////////////////////////////////////////////
    /////////
    /////////----> INICIO DO EDIT
    /////////
    //////////////////////////

    public function editClienteFisico($data, $id_cliente)
    {
        $this->db->where('cliente_id', $id_cliente);
        return $this->db->update('cad_cliente_fisica', $data);
    }

    public function editClienteJuridico($data, $id_cliente)
    {
        $this->db->where('cliente_id', $id_cliente);
        return $this->db->update('cad_cliente_juridico', $data);
    }

    public function editClienteEndereco($data, $id_cliente)
    {
        $this->db->where('cliente_id', $id_cliente);
        return $this->db->update('cad_cliente_endereco', $data);
    }

    public function deleteDados($id_cliente)
    {
        $this->db->where('cliente_id', $id_cliente);
        $this->db->delete('cad_cliente_telefone');

        $this->db->where('cliente_id', $id_cliente);
        $this->db->delete('cad_cliente_email');
    }

    //////////////////////////////////////////////////////////
    /////////
    /////////----> GET
    /////////
    //////////////////////////

    public function getModeloMarca()
    {
        $this->db->select("
            cmm.modelo_id,
            CONCAT(cmm.nome , ' / ' , cm.nome) marca_modelo  
        ", FALSE);
        $this->db->join('carro_marca cm', 'cm.marca_id = cmm.marca_id');
        return $this->db->get('carro_modelo cmm')->result_array();
    }
}
