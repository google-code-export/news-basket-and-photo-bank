<?php
class Home extends  Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		if($this->auth->is_logged_in() == false)
		{
			$this->login();
		}else{
			$this->template->set('title','Welcome user! | MyWebApplication.com');
			// tampilkan halaman dashboard dengan data menu 
			$this->load->view('home_admin');
			}
	}
	function manajemen_user()
{
   // mencegah user yang belum login untuk mengakses halaman ini
   $this->auth->restrict();
   // mencegah user mengakses menu yang tidak boleh ia buka (manejemen user menu_id = 2)
   $this->auth->cek_menu(2);
 
   // get data dari usermodel
   $data['all_user'] = $this->usermodel->get_all_user();
   $this->template->set('title','Manajemen User | MyWebApplication.com');
   // load view tabel_user.php di folder application/views/admin/
   $this->template->load('template','admin/tabel_user',$data);
}
}
?>