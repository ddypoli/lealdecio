<?php if( ! defined('BASEPATH')) exit('No direct script allowed');

class Terreno_controller extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('terreno');
        $this->load->model('imagem');
        $this->load->model('cidade');
    }

    public function index()
    {        
        $data = array(
            'title' => 'Terrenos',
            'menu' => $this->util->get_menu(),
            'terrenos' => $this->terreno->get_multiple(),
        );
        
        $this->load->view('template/header', $data);
        $this->load->view('admin/terreno/index');
        $this->load->view('template/footer');
    }
    
    public function view($id)
    {     
        $data = array(
            'title' => 'Visualizar terreno',
            'menu' => $this->util->get_menu(),
            'terreno' => $this->terreno->get_single($id),
        );
        
        if( ! $data['terreno'])
        {
            redirect('/admin/terreno');
        }
        
        $this->load->view('template/header', $data);
        $this->load->view('admin/terreno/view');
        $this->load->view('template/footer');
    }
    
    /**
     * @todo Fazer o elemento cidades do array data buscar no banco de dados
     */
    public function create()
    {
        $data = array(
            'title' => 'Adicionar terreno',
            'menu' => $this->util->get_menu(),
            'error' => '',
            'cidades' => $this->cidade->get_multiple(),
        );
        
        $config = array(
            'upload_path' => './uploads/',
            'allowed_types' => 'gif|png|jpg',
            'encrypt_name' => 'TRUE',
        );
        
        $this->load->library('form_validation');
        $this->load->library('upload', $config);
        
        $this->form_validation->set_rules('titulo', 'Título', 'required');
        $this->form_validation->set_rules('descricao', 'Descrição', 'required');
        
        if($this->form_validation->run())
        {
            if( ! $this->upload->do_multi_upload('imagens'))
            {
                $data['error'] = $this->upload->display_errors();
                GOTO view;
            }
            else
            {
                $uploaded_data = $this->upload->get_multi_upload_data();
                
                foreach ($uploaded_data as $img)
                {
                    $imagem = new Imagem();
                    $imagem->nome = $img['file_name'];
                    
                    $this->terreno->add_imagem($imagem);
                }
                
                $this->terreno->save('post');
                
                redirect('/admin/terreno');
            }
            
        }
        else
        {
            view:
            $this->load->view('template/header', $data);
            $this->load->view('admin/terreno/create');
            $this->load->view('template/footer');
        }
    }
    
    public function edit($id)
    {
        $data = array(
            'title' => 'Editar terreno',
            'menu' => $this->util->get_menu(),
            'terreno' => $this->terreno->get_single($id),
            'cidades' => $this->cidade->get_multiple(),
        );
        
        if( ! $data['terreno'])
        {
            redirect('/admin/terreno');
        }
        
        $config = array(
            'upload_path' => './uploads/',
            'allowed_types' => 'gif|png|jpg',
            'encrypt_name' => 'TRUE',
        );
        
        $this->load->library('upload', $config);
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('titulo', 'Título', 'required');
        $this->form_validation->set_rules('descricao', 'Descrição', 'required');
        
        if($this->form_validation->run())
        {            
            if($_FILES['imagens']['name'][0] != NULL)
            {
                if($this->upload->do_multi_upload('imagens'))
                {
                    $uploaded = $this->upload->get_multi_upload_data();
                    
                    foreach ($uploaded as $img)
                    {
                        $imagem = new Imagem();
                        $imagem->nome = $img['file_name'];

                        $this->terreno->add_imagem($imagem);
                    }
                    
                    $this->terreno->edit($id);
                    redirect('/admin/terreno');
                }
                else
                {
                    $data['error'] = $this->upload->display_errors();
                    
                    $this->load->view('template/header', $data);
                    $this->load->view('admin/terreno/edit');
                    $this->load->view('template/footer');
                }
            }
            else
            {
                $this->terreno->edit($id, 'post');
                redirect('/admin/terreno');
            }
        }
        else
        {
            $this->load->view('template/header', $data);
            $this->load->view('admin/terreno/edit');
            $this->load->view('template/footer');
        }
        
    }
    
    /**
     * 
     * @todo Fazer imagem auto se eliminar
     * @param type $id
     * @param type $confirmacao
     */
    public function remove($id, $confirmacao = FALSE){
        $data = array(
            'title' => 'Remover terreno',
            'menu' => $this->util->get_menu(),
        );
        
        $resultado = $this->terreno->get_single($id);
        
        if( ! $resultado)
        {
            redirect('/admin/terreno');
        }
        
        if($confirmacao)
        {
            $this->load->helper('url');
            
            foreach ($resultado->imagens as $imagem)
            {
                $this->db->delete('imagens', array('id' => $imagem['id']));
            }
            
            $this->terreno->remove($id);
            redirect('/admin/terreno');
        }
        else
        {
            $data = array(
                'title' => 'Remover terreno',
                'menu' => $this->util->get_menu(),
                'terreno' => $resultado,
            );
            
            $this->load->view('template/header', $data);
            $this->load->view('admin/terreno/remove');
            $this->load->view('template/footer');
        }
        
    }
    
    public function delete_image(){
        $id = $this->input->post('id');
        $this->imagem->remove($id);
    }
    
}

/* End of file: terreno_controller.php */
/* Location: ./application/controllers/terreno_controller.php */