<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Examples extends Controller {

	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
		$this->load->database();
		$this->load->helper('url');
		/* ------------------ */		
		
		$this->load->add_package_path(APPPATH.'third_party/grocery_crud/');

		$this->output->set_template('custom_cms');		
		
		$this->load->library('grocery_CRUD');	
	}

	function index()
	{
		
	}
	
	function offices()
	{
		$this->grocery_crud->render();
	}
	
	function user_management()
	{
		$this->load->library('grocery_Exceptions');
		try{
			/* This is only for the autocompletion */
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('users');
			$crud->unset_columns('Password');
			$crud->set_subject('user');
			$crud->required_fields('name');
			
			//$crud->columns('name','username','email','status');
			
			$crud->render();
			
		}catch(Exception $e){
			$this->grocery_exceptions->show_error($e->getMessage(), $e->getTraceAsString());
		}
	}
	
	/*function employees_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('employees');
			$crud->set_relation('officeCode','offices','city');
			$crud->display_as('officeCode','Office City');
			$crud->set_subject('Employee');
			
			$crud->render();
	}
	
	function customers_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_table('customers');
			$crud->columns('customerName','contactLastName','phone','city','country','salesRepEmployeeNumber','creditLimit');
			$crud->display_as('salesRepEmployeeNumber','from Employeer')
				 ->display_as('customerName','Name')
				 ->display_as('contactLastName','Last Name');
			$crud->set_subject('Customer');
			$crud->set_relation('salesRepEmployeeNumber','employees','lastName');
			
			$crud->render();
	}	
	
	function orders_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_relation('customerNumber','customers','contactLastName');
			$crud->display_as('customerNumber','Customer');
			$crud->set_table('orders');
			$crud->set_subject('Order');
			$crud->unset_add();
			$crud->unset_delete();
			
			$crud->render();
	}
	
	function products_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_table('products');
			$crud->set_subject('Product');
			$crud->unset_columns('productDescription');
			$crud->callback_column('buyPrice',array($this,'valueToEuro'));
			
			$crud->render();
	}	
	
	function valueToEuro($value, $row)
	{
		return $value.' &euro;';
	}
	*/
}