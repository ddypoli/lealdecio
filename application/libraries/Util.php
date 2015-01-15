<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Util {
    
    public function get_menu()
    {
        $CI =& get_instance();
        $CI->load->helper('url');
        
        return array(
            anchor('/', 'Visitar site'),
            anchor('admin/terreno', 'Terrenos'),
        );
    }
    
}

/* End of file Util.php */
/* Location: ./application/libraries/Util.php */