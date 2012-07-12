<?php
class User extends Controller {
	
	//num of record per page
	private $limit = 10;
	
	function user(){
		parent:: Controller();
		
		//load library
		$this->load->library(array('table','validation'));
	
		//load  helper
		$this->load->helper('url');
		
		//load Model 
		$this->load->Model('userModel','',TRUE);
			
	}
	
	function index($offset=0){
		//offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		//load data
		$users = $this->userModel->get_paged_list($this->limit, $offset)->result();
		
		//generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('user/index/');
		$config['total_rows']= $this->userModel->count_all();
		$config['per_page']= $this->limit;
		$config['uri_segment']= $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		//generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp");
		$this->table->set_heading('No','Username','email','status','Action');
		$i = 1 + $offset;
		foreach ($users as $users) {
			$this->table->add_row($i++, $users->username,$users->email,$users->status,
			anchor('user/view/'. $users->id_user,'view',array('class' =>'view')).''.
			anchor('user/update/'.$users->id_user,'update',array('class'=>'update')).''.
			anchor('user/delete/'. $users->id_user,'delete',array('class'=>'delete','onclick'=>"return confirm(Are You Sure want to delete this user?')"))
			);
			
			
		}
		$data['table'] = $this->table->generate();
		
		//load view
		$this->load->view('userList',$data);
	}
		function add(){
			//set validation properties
			$this->_set_fields();
			
			//set common properties
			$data['title'] = "add new user";
			$data['message'] = '';
			$data['action'] = site_url('user/addUser');
			$data['link_back']= anchor('user/index/','back to list of user',array('class=>back'));
			
			//load view
			$this->load->view('userEdit', $data);
			
		}
		
		function addUser(){
			
			//set commmon properties
			$data['title'] = "add new user";
			$data['action'] = site_url('user/addUser');
			$data['linkback'] = anchor('user/index/', 'back to list of users',array('class=>back'));
			//set validation properties
			$this->_set_fields();
			$this->_set_rules();
			
			//run validation
			if($this->validation->run()== FALSE){
				$data['message']='';
			}else {
				//save data
				$users = array('username'=>$this->input->post('username'),
				'status' =>$this->input->post('status'),
				'email' =>$this->input->post('email')
				);
				$id = $this->userModel->save($users);
				
				
				//set form input name "id"
				$this->validation->id_user = $id;
				
				//set user message
				$data['message'] = '<div class ="succes">add new user succes</div>';
				
			}
			//load view
			$this->load->view('userEdit', $data);
		}
		
		function view($id){
			//set common properties
			$data['title']= 'user details';
			$data['link_back']= anchor('user/index/','Back to list of Users',array('class=>back'));
		
		//get person details
		$data['users'] = $this->userModel->get_by_id($id)->row();
		
		//load view
		$this->load->view('userView', $data);
		
		}
		function update($id){
			//set validation properties
			$this->_set_fields();
			
			//prefill form values
			$users=$this->userModel->get_by_id($id)->row();
			$this->validation->id_users= $id;
			$this->validation->username = $users->username;
			$this->validation->status = $users->status;
			$this->validation->email = $users->email;		
		
		//set commmon properties
			$data['title'] = "update user";
			$data['message'] = "update user";
			$data['action'] = site_url('user/updateUser');
			$data['linkback'] = anchor('user/index/', 'back to list of users',array('class=>back'));
		
		//load view
		$this->load->view('userEdit', $data);
		
		}
	function updateUser(){
		//set common properties
		$data['title'] = "update user";
			$data['action'] = site_url('user/updateUser');
			$data['linkback'] = anchor('user/index/', 'back to list of users',array('class=>back'));
		
		//set validation properties
		$this->_set_fields();
		$this->_set_rules();
		
		//run validation
		if($this->validation->run()==FALSE){
			$data['message']='';
		}else{
			
			//save data
			$id = $this->input->post('id_user');
			$users = array('username' =>$this->input->post('username'),
							'status' =>$this->input->post('status'),
							'email' =>$this->input->post('email'),			
			);
			$this->userModel->update($id,$users);
	//set user message
		$data['message']= '<div class ="succes">update users succes</div>';	
		redirect('userList');
		}
	//load view
	$this->load->view('userEdit',$data);
	
	}
		
		function delete($id){
			//delete users
			$this->userModel->delete($id);
			
			//redirect to user list page
			redirect('user/index/','refresh');
			
		}	
			//validation fields
			function _set_fields(){
				
				$fields['id']='id';
				$fields['username']= 'username';
				$fields['status'] = 'status';
				$fields{'email'}= 'email';
				
				$this->validation->set_fields($fields);
				
			}
			//validation rules
			function _set_rules(){
				
				$rules['username'] ='trim|required';
				$rules['status'] = 'trim}required';
				$rules['email'] = 'trim|required';
				
				$this->validation->set_rules($rules);
				
				$this->validation->set_message('required', '* required');
       			$this->validation->set_message('isset', '* required');
	   		    $this->validation->set_error_delimiters('<p class="error">', '</p>');
				
			}
}




?>
