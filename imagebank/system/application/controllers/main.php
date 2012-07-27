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
		$crud->
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
	
	protected function upload_file($state_info)
{
  if(isset($state_info->field_name) && isset($this->upload_fields[$state_info->field_name]))
  {
   $upload_info = $this->upload_fields[$state_info->field_name];
  
                        // Set useful variables
   $upload_path = $this->upload_fields[$state_info->field_name]->upload_path . '/';
   $file_type = $this->upload_fields[$state_info->field_name]->file_type;
   $thumbnail = $this->upload_fields[$state_info->field_name]->thumbnail;
   $upload_file = explode('.', $state_info->file_name);
   $upload_file_ext = end($upload_file);
   $upload_file_name = substr($state_info->file_name, 0, ((strlen($upload_file_ext)+1)*-1));
   $upload_file_name_orig = $upload_file_name;
  
  
   if($file_type != NULL)
   {
        $file_type_array = explode('|',$file_type);
        if(!in_array($upload_file_ext,$file_type_array))
        {
         //return FALSE;
        }
   }
   // Create upload path folder if it doesn't already exist
   if (!is_dir($upload_path)) {
        mkdir($upload_path);
   }
   $i = 1;
   while(file_exists($upload_path . $upload_file_name . '.' . $upload_file_ext)){
        // Our file exists. Rename.
        $upload_file_name = $upload_file_name_orig . '_' . $i;
        $state_info->file_name = $upload_file_name . '.' . $upload_file_ext;
        $i++;
   }
   $input = fopen("php://input", "r");
                 $temp = tmpfile();
                 $realSize = stream_copy_to_stream($input, $temp);
                 fclose($input);
                
                 $target = fopen("{$upload_info->upload_path}/{$state_info->file_name}", "w");
                 fseek($temp, 0, SEEK_SET);
                 stream_copy_to_stream($temp, $target);
                 fclose($target);
                
                        if($thumbnail != NULL)
   {
        // Create Thumbnail folder if it doesn't already exist
        if (!is_dir($upload_path . "Thumbnail")) {
         mkdir($upload_path . "Thumbnail");
        }
        // File Uploaded
        $thumbnail_array = explode('|',$thumbnail);
        $config = array (
        'source_image'  => $upload_path . $state_info->file_name,
        'new_image'   => $upload_path . "Thumbnail/" . $state_info->file_name,
        'maintain_ration' => FALSE,
        'width' => $thumbnail_array[0],
        'height'   => $thumbnail_array[1]
        );
        // Generate the Thumbnail If Is Image
        $ci = &get_instance();
        $ci->load->library('image_lib', $config);
        if ( ! $ci->image_lib->resize())
        {
         //return FALSE;
        }
   }
                 return (object)array('file_name' => $state_info->file_name);
  }
  else
  {
   //return false;
  }
}
protected function delete_file($state_info)
{
  if(isset($state_info->field_name) && isset($this->upload_fields[$state_info->field_name]))
  {
   $upload_info = $this->upload_fields[$state_info->field_name];
  
   if(file_exists("{$upload_info->upload_path}/{$state_info->file_name}"))
   {
        if( unlink("{$upload_info->upload_path}/{$state_info->file_name}") )
        {
         $this->basic_model->db_file_delete($state_info->field_name, $state_info->file_name);
         if(file_exists("{$upload_info->upload_path}/Thumbnail/{$state_info->file_name}"))
         {
          unlink("{$upload_info->upload_path}/Thumbnail/{$state_info->file_name}");
         }
         return true;
        }
        else
        {
         return false;
        }
   }
   else
   {
        $this->basic_model->db_file_delete($state_info->field_name, $state_info->file_name);
        return true;
   }
  }
  else
  {
   return false;
  }
}
public function set_field_upload($field_name, $upload_path , $file_type = NULL , $thumbnail = NULL)
{
$upload_path = substr($upload_path,-1,1) == '/' ? substr($upload_path,0,-1) : $upload_path;
$this->upload_fields[$field_name] = (object)array( 'field_name' => $field_name , 'upload_path' => $upload_path , 'file_type' => $file_type , 'thumbnail' => $thumbnail);
}

function image()
{
try{
$crud = new grocery_CRUD();
$crud->set_table('images');

//$crud->set_field_upload('Fild Name','Path Of Upload' [, 'File Type Validate , 'Thumbnail Width|Thumbnail Height']);

// Upload Without Validate And Thumbnail
$crud->set_field_upload('image');

// Upload With Validate And Thumbnail
$crud->set_field_upload('picture','images/gallery' , 'jpg|jpeg|gif|png' , '25|25');
$output = $crud->render();
$this->_example_output($output);
}catch(Exception $e){
show_error($e->getMessage().' --- '.$e->getTraceAsString());
}
}
}
 
/* End of file main.php */
/* Location: ./application/controllers/main.php */