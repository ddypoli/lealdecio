<?php if( ! defined('BASEPATH')) exit('No direct scripts allowed');

class Cidade extends CI_Model {
    var $id;
    var $nome;
    var $estado_id;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_single($id)
    {
        if($id === '' or ( ! is_numeric($id)))
        {
            return NULL;
        }
        
        $query = $this->db->get('cidades', array('id' => $id));
        $cidade = $query->result_array();
        
        if(count($cidade) == 0)
        {
            return NULL;
        }
        
        return (object) current($cidade);
    }
    
    public function get_multiple($max = '')
    {
        if ($max === '' or  ( ! is_numeric($max)))
        {
            $query = $this->db->get('cidades');
        }
        else
        {
            $query = $this->db->get('cidades', $max);
        }
        
        $cidades = $query->result_array();
        
        foreach ($cidades as &$cidade)
        {
            settype($cidade, 'object');
        }
        
        return $cidades;
    }
    
}