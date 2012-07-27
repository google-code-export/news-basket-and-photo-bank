<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Admin extends Controller {
 
    function Admin()
    {
        parent::Controller();
 
        
        $this->load->database();
        $this->load->helper('url'); 
        $this->load->library('grocery_CRUD');
 
    }
 
    
    
        function index() {
		if ($this->session->userdata('login') == TRUE && $this->session->userdata('user_level') == 'administrator') {
			$this->loadArticle();
		}
		else {
			redirect('login');
        }
	}
    

	
	
    public function manageUser()
    {
    	
		
		$username = $this->session->userdata('username');		
    	$crud = new grocery_CRUD();
        $crud->set_table('users');
		//$crud->where('id_user',$username);
		$crud->set_theme('flexigrid');
		$crud->columns('id_user','name','email','id_source','user_level','phone');
		$crud->display_as('id_source','source name');
		$crud->required_fields('id_user','name','email');
		$crud->fields('id_user','password','name','email','user_level','phone','id_source');
		$crud->display_as('id_group');
		$crud->change_field_type('password', 'password');
		$crud->set_relation('id_source','source','source_name' );
		

        $output = $crud->render();
		$output = (array)$output;
		 $output['page_title']		= 'Manage Users| Administrator Image Bank ';
		$output['username']  = $username;
	   $this->load->view('admin/template_admin',$output);
	   
	  
	      
    }
	
	public function manageCategory()
	{
		$username = $this->session->userdata('username');
		$crud = new grocery_CRUD();
		$crud->set_table('category');
		$crud->set_theme('flexigrid');
		$crud->display_as('short_desc','Short Description');
		$crud->display_as('long_desc','Long Description');
		$output =$crud->render();
		$output = (array)$output;
		 $output['page_title']		= 'Manage Category| Administrator Image Bank ';
		$output['username']  = $username;
		 $this->load->view('admin/template_admin.php',$output);
	   
	}
	
	public function manageSource(){
		$username = $this->session->userdata('username');
		$crud= new grocery_CRUD();
		$crud->set_table('source');
		$crud->set_theme('flexigrid');
		$crud->fields('source_name','source_type');
		$output =$crud->render();
		$output = (array)$output;
		 $output['page_title']		= 'Manage Source| Administrator Image Bank ';
		$output['username']  = $username;
		 $this->load->view('admin/template_admin.php',$output);
		 }
 
   protected function get_layout()
{
  $js_files = $this->get_js_files();
  $css_files =  $this->get_css_files();
  $tvs = $this->get_tvs();

  if($this->unset_jquery)
   unset($js_files['763b4d272e158bdb8ed5a12a1824c94f494954bd']);

  if($this->echo_and_die === false)
  {
   return (object)array('output' => $this->views_as_string, 'js_files' => $js_files, 'css_files' => $css_files, 'tv' => $tvs);
  }
  elseif($this->echo_and_die === true)
  {
   echo $this->views_as_string;
   die();
  }
}
	
}
 
/* End of file main.php */
/* Location: ./application/controllers/main.php */