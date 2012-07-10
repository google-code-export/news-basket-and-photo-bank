<?php

class Categories extends  Controller{
	function  Categories(){
	parent::Controller();	
	session_start();
	}
	
	
	function Index(){
		$data['title'] = 'Manage Categories';
		$data['main'] ='admin_cat_home';
		$data['categories']= $this->MCats->getAllCategories();
		$this->load->vars($data);
		$this->load->view('admin_cat_home');
	}
}



?>