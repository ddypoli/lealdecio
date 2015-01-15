<?php if( ! defined('BASEPATH')) exit('No direct scripts allowed');

/**
 * Representa uma imagem em disco.
 * 
 * @author Rodrigo Oliveira <ps.rodrigo.oliveira@gmail.com>
 * @version 1.0
 */
class Imagem extends CI_Model {
    var $id;
    var $nome;
    var $terreno_id;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * 
     * @param int $id
     * @return 
     * @todo Verificar se id é numérico
     */
    public function get_single($id)
    {
        $query = $this->db->get_where('imagens', array('id' => $id));
        $imagem = current($query->result_array());
        
        return (object) $imagem;
    }


    /**
     * 
     * @param int $max
     * @return array Retorna um array com todas as imagens
     * @todo Verificar se terreno_id é numérico
     */
    public function get_multiple($terreno_id, $max = '')
    {
        if($max === '')
        {
            $query = $this->db->get_where('imagens', array('terreno_id' => $terreno_id));
        }
        else
        {
            $query = $this->db->get_where('imagens', array('terreno_id' => $terreno_id), $max);
        }
        
        return $query->result_array();
    }
    
    public function save()
    {
        $this->db->insert('imagens', $this);
    }
    
    public function edit($id = NULL)
    {
        if ( ! $id)
        {
            $id = $this->id;
        }
        
        $this->db->update('imagens', $this, array('id' => $id));
    }
    
    /**
     * Se não for especificado id, será utilizado o id do objeto atual.
     * 
     * @param type $id
     * 
     */
    public function remove($id = NULL)
    {
        if( ! $id)
        {
            $id = $this->id;
        }
        
        $this->db->delete('imagens', array('id' => $id));
    }
    
}