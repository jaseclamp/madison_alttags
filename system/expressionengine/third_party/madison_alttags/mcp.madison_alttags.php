<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


 
class Madison_alttags_mcp {
	
	public $return_data;
	public $return_array = array();
	
	private $_base_url;
	private $_data = array();
	private $_module = 'madison_alttags';
	
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->EE =& get_instance();
		
		$this->_base_url = BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=madison_alttags';
		
		$this->EE->cp->set_right_nav(array(
			'module_home'	=> $this->_cp_url()
		));

		$this->EE->view->cp_page_title = "Update image alt tags";
	}
	
	


	public function index()
	{
		
		$this->EE->load->library('table');
		
		$this->_data['action_url'] = $this->_form_url('save_alttags');
		
		$this->_data['images'] = $this->get_alttags();
		return $this->EE->load->view('index', $this->_data, TRUE);
		
	}
	
	public function save_alttags()
	{	
	
		$alt = $_POST['value'];
		$key = $_POST['id'];
		$filename = $_POST['image'];
		
		if($alt=='') continue; //bypass empties. 
		if(!is_numeric($key)) continue; //only want file ids. skips "submit" for example.
		
		$this->EE->db->update('files', array('description' => $alt), 'file_id = ' . $key);	
		
		//if assets, also update 'desc' so those can be used.
		//$this->EE->db->select('file_name');
		//$filename = $this->EE->db->get_where('files', 'file_id = ' . $key )->result_array();
		//$filename = $filename[0]['file_name']; 
		$this->EE->db->update('assets_files', array('desc' => $alt), 'file_name = "' . $filename .'"');	
			
		die($key);

		// Redirect back to Detour Pro landing page
		//$this->EE->functions->redirect($this->_base_url);
	}

	function strposa($haystack, $needle, $offset=0) {
		if(!is_array($needle)) $needle = array($needle);
		foreach($needle as $query) {
			if(strpos($haystack, $query, $offset) !== false) return true; // stop on first true result
		}
		return false;
	}
	
	private function get_alttags($id='')
	{
		$this->EE->load->model('file_upload_preferences_model');
		//be able to convert {filedir_x} to an actual file path
		foreach( $this->EE->file_upload_preferences_model->get_file_upload_preferences() as $key => $loc)
		{
			$filelocs[$loc['id']] = $loc['url']; 
		}
			
		$this->EE->db->select('*');
		$current_alttags = $this->EE->db->get_where('files')->result_array();
		
		foreach($current_alttags as $value)
		{
			extract($value);
			
			if(!$this->strposa(strtolower($file_name),array('jpg','jpeg','gif','png'))) continue; //skip non images if found.
			
			$this->return_array[] = array(
				'src' => $filelocs[$upload_location_id].$title, 
				'alt' => $description,
				'id' => $file_id,
				'name' => $file_name
			);
		}		
		
		
		return $this->return_array;
	}
	
	//! Linking Methods 
	
	private function _cp_url ($method = 'index', $variables = array()) {
		$url = BASE . AMP . 'C=addons_modules' . AMP . 'M=show_module_cp' . AMP . 'module=' . $this->_module . AMP . 'method=' . $method;
		
		foreach ($variables as $variable => $value) {
			$url .= AMP . $variable . '=' . $value;
		}
		
		return $url;
	}
	
	private function _form_url ($method = 'index', $variables = array()) {
		$url = 'C=addons_modules' . AMP . 'M=show_module_cp' . AMP . 'module=' . $this->_module . AMP . 'method=' . $method;
		
		foreach ($variables as $variable => $value) {
			$url .= AMP . $variable . '=' . $value;
		}
		
		return $url;
	}
	
	

	
}
