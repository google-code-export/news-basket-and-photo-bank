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
    	$data_article['page_title']		= 'Manage Users| Admin ';
    	$crud = new grocery_CRUD();
        $crud->set_table('users');
		$crud->set_theme('datatables');
		$crud->columns('username','email','tingkat','id_group');
		$crud->display_as('id_group','kelompok');
		$crud->display_as('tingkat','level');
		$crud->fields('username','password','email','tingkat','id_group');
		$crud->display_as('id_group','kelompok');
		$crud->change_field_type('password', 'password');
		//$crud->change_field_type('kelompok','enum');

		$crud->set_relation('id_group','groups','kelompok' );
        $output = $crud->render();
         
	   $this->load->view('template',$output);
	   
	  
	      
    }
	
	public function manageCategory()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('category');
		$crud->set_theme('datatables');
		$crud->display_as('short_desc','Short Description');
		$crud->display_as('long_desc','Long Description');
		$output =$crud->render();

		 $this->load->view('template.php',$output);
	   
	}
	
	public function manageGroup(){
		$crud= new grocery_CRUD();
		$crud->set_table('groups');
		$crud->set_theme('datatables');
		$output =$crud->render();
		 $this->load->view('template.php',$output);
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