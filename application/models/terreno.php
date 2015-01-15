<?php if( ! defined('BASEPATH')) exit('No direct scripts allowed');

class Terreno extends CI_Model {
    var $id;
    var $titulo;
    var $descricao;
    var $endereco;
    var $bairro;
    var $cidade_id;
    var $comprimento;
    var $largura;
    var $imagens = array();
    var $imagens_deletadas = array();
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('imagem');
    }

    public function carregar_form_get(){
        $this->titulo = $this->input->get('titulo');
        $this->descricao = $this->input->get('descricao');
        $this->endereco = $this->input->get('endereco');
        $this->bairro = $this->input->get('bairro');
        $this->cidade_id = $this->input->get('cidade');
        $this->comprimento = $this->input->get('comprimento');
        $this->largura = $this->input->get('largura');
    }
    
    public function carregar_form_post(){
        $this->titulo = $this->input->post('titulo');
        $this->descricao = $this->input->post('descricao');
        $this->endereco = $this->input->post('endereco');
        $this->bairro = $this->input->post('bairro');
        $this->cidade_id = $this->input->post('cidade');
        $this->comprimento = $this->input->post('comprimento');
        $this->largura = $this->input->post('largura');
    }
    
    /**
     * Retorna o resultado de uma busca por id
     * 
     * @param int $id
     * @return Terreno Retorna o objeto que corresponde ao id passado por parâmetro
     * ou NULL se a busca não encontrar nenhum resultado.
     */
    public function get_single($id)
    {
        if($id === '' or ( ! is_numeric($id)))
        {
            return NULL;
        }
        
        $query = $this->db->get_where('terrenos', 'id = ' . $id);
        
        $resultado = $query->result_array();
        
        if(count($resultado) == 0)
        {
            return NULL;
        }
        
        $terreno = current($resultado);
        
        settype($terreno, 'object');
        
        $terreno->imagens = $this->imagem->get_multiple($terreno->id);
        
        return $terreno;
    }
    
    /**
     * Retorna um array de terrenos.
     * 
     * @param int $max Quantidade máxima de terrenos a ser retornado.
     * @return array Retorna todos os registros do banco se não for passado nenhum parâmetro
     * ou a quantidade de registros passado por parâmetro.
     */
    public function get_multiple($max = '')
    {
        if ($max === '' or  ( ! is_numeric($max)))
        {
            $query = $this->db->get('terrenos');
        }
        else
        {
            $query = $this->db->get('terrenos', $max);
        }
        
        $terrenos = $query->result_array();
        
        foreach ($terrenos as &$terreno)
        {
            settype($terreno, 'object');
            $terreno->imagens = $this->imagem->get_multiple($terreno->id);
        }
        
        return $terrenos;
    }
    
    public function add_imagem($imagem)
    {
        $this->imagens[] = $imagem;
    }
    
    public function remove_imagem($imagem)
    {
        echo "Imagens atuais: <br />";
        var_dump($this->imagens);
        echo "<br />";
        
        foreach ($this->imagens as $img)
        {
            if($img->id == $imagem->id){
                $this->imagens_deletadas[] = $img;
                unset($img);
            }
        }
        
        echo "Imagens restantes: <br />";
        var_dump($this->imagens);
        echo "<br />";
        
        echo "Imagens deletadas: <br />";
        var_dump($this->imagens_deletadas);
        echo "<br />";
    }

    public function save($method = 'default')
    {
        switch (strtolower($method))
        {
            case 'get':
                $this->carregar_form_get();
                break;
            case 'post':
                $this->carregar_form_post();
                break;
        }
        
        $result = $this->db->insert('terrenos', $this);
        
        if($this->id == NULL)
        {
            $this->id = mysql_insert_id($this->db->conn_id);
        }
        
        foreach ($this->imagens as $img)
        {
            $img->terreno_id = $this->id;
            $img->save();
        }
        
        return $result;
    }
    
    public function edit($id)
    {
        $this->carregar_form_post();
        $this->id = $id;
        
        foreach ($this->imagens as $upd)
        {
            $upd->terreno_id = $id;
            
            if ($this->get_single($upd->id) == NULL)
            {
                $upd->save();
            }
            else
            {
                $upd->update();
            }
        }
        
        $query = $this->db->update('terrenos', $this, array('id' => $id));
        
        return $query;
    }
    
    /**
     * Remove todas as imagens relacionadas ao terreno e depois remove o terreno.
     * 
     * @author Rodrigo Oliveira <ps.rodrigo.oliveira@gmail.com>
     * @version 1.0
     * @param int $id ID do terreno
     * @return object
     */
    public function remove($id = '')
    {
        if ($id == '')
        {
            $id = $this->id;
        }
        
        foreach ($this->imagem->get_multiple($id) as $img)
        {
            $img->remove();
        }
        
        return $this->db->delete('terrenos', array('id' => $id));
    }
    
}