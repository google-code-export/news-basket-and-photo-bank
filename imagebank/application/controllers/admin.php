<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Admin extends Controller {
 
    function Admin()
    {
        parent::Controller();
 
        
        $this->load->database();
        $this->load->helper('url'); 
        $this->load->library('grocery_CRUD');
 
    }
 
    public function index()
    {
        echo "<h1>Welcome to the world of Codeigniter</h1>";//Just an example to ensure that we get into the function
                die();
    }
  function _example_output($output = null)
 
    {
        $this->load->view('example.php',$output);    
    }
	
    public function manageUser()
    {
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
        $this->_example_output($output);        
    }
	
	public function manageCategory()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('category');
		$crud->display_as('short_desc','Short Description');
		$crud->display_as('long_desc','Long Description');
		$output =$crud->render();
		$this->_example_output($output);
	}
	
	public function manageGroup(){
		$crud= new grocery_CRUD();
		$crud->set_table('groups');
		$output =$crud->render();
		$this->_example_output($output);
	}
 
   
	
}
 
/* End of file main.php */
/* Location: ./application/controllers/main.php */