<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
    
    public function index()
    {        
        $data = array(
            'title' => 'Página inicial',
            'menu' => $this->util->get_menu(),
        );
        
        $this->load->view('template/header', $data);
        $this->load->view('template/footer');
        $this->load->view('admin/index');
    }
    
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */