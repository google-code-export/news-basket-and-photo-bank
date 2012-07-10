<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Main extends Controller {
 
    function __construct()
    {
        parent::__construct();
 
        /* Standard Libraries of codeigniter are required */
        $this->load->database();
        $this->load->helper('url');
        /* ------------------ */ 
 
        $this->load->library('grocery_CRUD');
 
    }
 
    public function index()
    {
        echo "<h1>Welcome to the world of Codeigniter</h1>";//Just an example to ensure that we get into the function
                die();
    }
 
    public function user()
    {
    	$crud = new grocery_CRUD();
        $crud->set_table('users');
		$crud->columns('username','email','status');
	
        $output = $crud->render();
        $this->_example_output($output);        
    }
	
	public function category()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('category');
		$crud->display_as('short_desc','Short Description');
		$crud->display_as('long_desc','Long Description');
		$output =$crud->render();
		$this->_example_output($output);
	}
	
	public function group(){
		$crud= new grocery_CRUD();
		$crud->set_table('groups');
		$output =$crud->render();
		$this->_example_output($output);
	}
 
    function _example_output($output = null)
 
    {
        $this->load->view('example',$output);    
    }
}
 
/* End of file main.php */
/* Location: ./application/controllers/main.php */