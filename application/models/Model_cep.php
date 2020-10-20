<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_cep extends CI_Model {

    public function cadastrar_cep($dados)
    {
        
        $this->db->insert('cep', $dados);
        
        return $this->db->insert_id();
        
    }

    public function listar_cep_cadastrados()
    {
        
        return $this->db->select('*')
            ->from("cep")
            ->get()
            ->result();
        

    }

}

?>