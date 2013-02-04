<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class content extends Admin_Controller {
	//--------------------------------------------------------------------
	public function __construct()
	{
		parent::__construct();
		$this->auth->restrict('Simplenews.Content.View');
		
		$this->lang->load('simplenews');				
		$this->load->helper('form');
		$this->load->helper('date');
		
		$this->load->model('news_model', null, true);
		$this->load->model('category_model', null, true);
		$this->load->model('news_default_checkboxes_model', null, true);
		$this->load->model('news_images_model', null, true);
		
		// BO - Load dataTables Jquery plugin
		Assets::add_js(Template::theme_url('js/bootstrap.js'));
		Assets::add_js($this->load->view('reports/activities_js', null, true), 'inline');

		Assets::add_js( array ( Template::theme_url('js/jquery.dataTables.min.js')));
		Assets::add_js( array ( Template::theme_url('js/bootstrap-dataTables.js')));
		Assets::add_css( array ( Template::theme_url('css/datatable.css')));
		Assets::add_css( array ( Template::theme_url('css/bootstrap-dataTables.css'))) ;
		// EO - Load dataTables Jquery plugin

		Template::set_block('sub_nav', 'content/_sub_nav');
	}
	//--------------------------------------------------------------------
	/*	Method: index()
		Displays a list of form data.
	*/
	public function index()
	{
		$editnewsdata = $this->news_model->find_all();
		Template::set('news', $editnewsdata);		
		
		// BO - Pagination		
		$this->load->library('pagination');
		$offset = $this->input->get('per_page');
		$total =  $this->news_model->count_all();				
		
		//$total =  2;
		//$total = $this->news_model->count_by($where, $find_value);
		//$limit = $this->settings_lib->item('site.list_limit');
				
		$limit = 2;
		$this->pager['base_url'] 			= current_url() .'?';
		$this->pager['total_rows'] 			= $total;
		$this->pager['per_page'] 			= $limit;
		$this->pager['page_query_string']	= true;
		$this->pagination->initialize($this->pager);
		
		//get the activities
		/*
		$this->db->join('users', 'activities.user_id = users.id', 'left');
		$this->db->order_by('activity_id','desc'); // most recent stuff on top
		$this->db->select('activity, module, activities.created_on AS created, username');
		Template::set('activity_content', $this->activity_model->limit($limit, $offset)->find_all());
		 */		
		//Template::set('select_options', $options);
		//EO - Pagination
		Template::set('toolbar_title', 'Manage Simplenews');
		Template::render();
	}
	//--------------------------------------------------------------------
	/*  Method: create()
		Creates a simplenews object.
	*/
	public function create()
	{
	//$this->auth->restrict('Simplenews.Content.Create');
	//Assets::add_module_js('simplenews', 'simplenews.js');			
	$this->load->helper('date');

		if ($this->input->post('submit'))
		{
			if ($insert_id = $this->save_news())
			{
				// Log the activity
				//$this->activity_model->log_activity($this->current_user->id, lang('catalogsys_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'simplenews');
				Template::set_message(lang('simplenews_act_create_record'), 'success');				
				$id = $this->db->insert_id();
				Template::redirect(SITE_AREA .'/content/simplenews/editnews/'.$id);
			}
			else
			{
				//Template::set_message(lang('simplenews_edit_failure') . $this->simplenews_model->error, 'error');
				Template::set_message(lang('simplenews_edit_failure'), 'error');
			}
		}
		
		$category = $this->category_model->find_all();
		Template::set('categories', $category);
		$checkboxes = $this->news_default_checkboxes_model->find(1);
		Template::set('defaultcheckbox', $checkboxes);
		Template::set('toolbar_title', lang('simplenews_create') . ' simplenews');
		Template::render();
	}
	//--------------------------------------------------------------------
	
	// saving news
	private function save_news($type='insert', $id=0) {
		
		if ($type == 'update') {$_POST['id'] = $id; }
				
		$this->form_validation->set_rules('title', 'title', 					'required|trim|max_length[255]|strip_tags|xss_clean');
		$this->form_validation->set_rules('category_id', 'category_id', 		'numeric|xss_clean');
		$this->form_validation->set_rules('status', 'status', 					'numeric|xss_clean');
		$this->form_validation->set_rules('textarea', 'textarea', 				'required|trim|max_length[255]|strip_tags|xss_clean');		
		$this->form_validation->set_rules('checkbox', 'checkbox', 				'required|xss_clean');
				
		if ($this->form_validation->run() === FALSE) {return FALSE;}
				
		// make sure we only pass in the fields we want
		$data = array();
		
		$data['modified_on']     	= $this->input->post('modified_on');
		//$data['created_on']     	= $this->input->post('created_on');
								
		$data['title']       		= $this->input->post('title');
		$data['category_id'] 	    = $this->input->post('category_id');
		$data['status']      		= $this->input->post('status');
		$data['textarea']     		= $this->input->post('textarea');
				
		$checkedboxes1 = $this->input->post('checkbox');
		$checkedboxes = implode("||",$checkedboxes1);
		$data['checkbox']       	= $checkedboxes;
		
		if ($type == 'insert')
		{
			$id = $this->news_model->insert($data);
			if (is_numeric($id))
			{
				$return = $id;
			} else
			{
				$return = FALSE;
			}
		}
		else if ($type == 'update')
		{
			$return = $this->news_model->update($id, $data);
		}
		return $return;
	}
	
	public function editnews() {
				
//		$this->auth->restrict('simplenews.Content.Edit');		
		$id = $this->uri->segment(5);
		if (empty($id)){
			Template::set_message(lang('simplenews_invalid_id'), 'error');
			redirect(SITE_AREA .'/content/simplenews/');
		}
		if ($this->input->post('submit')) {
			if ($this->save_news('update', $id)) {
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('simplenews_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'simplenews');
				Template::set_message(lang('simplenews_edit_success'), 'success');
			} else {
				Template::set_message(lang('simplenews_edit_failure'), 'error');
			}
		}
		
		$editnewsdata = $this->news_model->find($id);
		Template::set('news', $editnewsdata);
		
		$category = $this->category_model->find_all();
		Template::set('categories', $category);
		
		$checkboxes = $this->news_default_checkboxes_model->find(1);
		Template::set('defaultcheckbox', $checkboxes);
		
		$newsimages = $this->news_images_model->where('image_newsid', $id)->find_all();		
		Template::set('images', $newsimages);		
	
		Template::set('toolbar_title', lang('simplenews_edit') . ' Itens');
		Template::render();
	}
//
public function newsimages()
	{
	//$this->auth->restrict('Simplenews.Content.Create');
	//Assets::add_module_js('simplenews', 'simplenews.js');
	$id = $this->uri->segment(5);
		if (empty($id)){
			Template::set_message(lang('simplenews_invalid_id'), 'error');
			redirect(SITE_AREA .'/content/simplenews/');
		}
		if ($this->input->post('submit'))
		{
			if ($insert_id = $this->save_images())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('catalogsys_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'simplenews');

				Template::set_message(lang('simplenews_act_create_record'), 'success');				
				Template::redirect(SITE_AREA .'/content/simplenews/newsimages/'.$id);
			}
			else
			{
				//Template::set_message(lang('simplenews_edit_failure') . $this->simplenews_model->error, 'error');
				Template::set_message(lang('simplenews_edit_failure'), 'error');
			}
		}		
		
		$newsimages = $this->news_images_model->where('image_newsid', $id)->find_all();		
		Template::set('images', $newsimages);			
			
		Template::set('toolbar_title', lang('simplenews_create') . ' simplenews');
		Template::render();
	}
	// EO Upload images

	// BO save images
	private function save_images($type='insert', $id=0) { 
    // Form validation for the product image isn't really necessary, but we're just going to say that it's required.          
    //$this->form_validation->set_rules('image_file','Product Image','required');
 
    //if ($this->form_validation->run() === FALSE) { return FALSE; } 
    // make sure we only pass in the fields we want
 
    $data = array();
    //$data['id']        			= $this->input->post('id');
	$data['image_newsid']       = $this->input->post('image_newsid');
	$data['image_order']        = $this->input->post('image_order');
	$data['image_title']        = $this->input->post('image_title');
	$data['image_description']  = $this->input->post('image_description');
	$data['image_file']			= $this->input->post('image_file');
 
    if ($type == 'insert') {
	// To get our file data, we're calling $this->savenew(); which handles the actual upload.
	// Para obter os dados dos nossos arquivos, vamos chamar $ this-> savenew (); que lida com o upload real.
	
    $fdata = $this->uploadimages();
	// We're only really storing the name of the file in the db, so we can point at the right file in our view.
	// Estamos realmente só armazenar o nome do arquivo no db, para que possamos apontar para o arquivo certo em nossa view.
        if($fdata['upload_data'] != NULL) {
            $data['image_file'] = $fdata['upload_data']['image_file'];
        } else {
            $data['image_file'] = 'none';
        }		
        
        $id = $this->news_images_model->insert($data);
				
        if (is_numeric($id)) {
            $return = $id;
        } else {
			$return = FALSE;
        }
    }
    else if ($type == 'update')
    {
        if($this->input->post('image_file')) {
            $fdata = $this->uploadimages();
            $data['image_file'] = $fdata['upload_data']['image_file'];
        } else {
            $data['image_file'] = $this->input->post('current_image_file');
        }
        $return = $this->news_image_model->update($id, $data);
    }
 
    return $return;
}
// EO save images

	// save images
	function uploadimages() {		
		
		//$config['upload_path'] = './uploads/';
		$config['upload_path'] = realpath(FCPATH.'assets/images/');
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']    = '1000';
		$config['max_width']  = '2024';
		$config['max_height']  = '2168';
		$config['remove_spaces'] = TRUE; //Remove spaces from the file name
		
		// You can give video formats if you want to upload any video file.
		$this->load->library('upload', $config);
        if (!$this->upload->do_upload('image_file')) {
        	$data['error'] = array('error' => $this->upload->display_errors());
            log_message('error',$data['error']);
		}
		else {
			$data = array('upload_data' => $this->upload->data());
		}
            return $data;        
		
	}
		
	

	public function delete()
	{
		$this->auth->restrict('Simplenews.Content.Delete');

		$id = $this->uri->segment(5);

		if (!empty($id))
		{

		}

		redirect(SITE_AREA .'/content/simplenews');
	}
	
	public function createcategory()
	{
		//$this->auth->restrict('Simplenews.Content.Create');
		//Assets::add_module_js('simplenews', 'simplenews.js');
		if ($this->input->post('submit')) {
			if ($this->save_category('insert')) {
				Template::set_message(lang('simplenews_edit_success'), 'success');	
				
				$id = $this->db->insert_id();																					
				Template::redirect(SITE_AREA .'/content/simplenews/createcategory/'.$id);
				
			} else {
				Template::set_message(lang('simplenews_edit_failure'), 'error');
			}
		}
		$category = $this->category_model->find_all();
		Template::set('categories', $category);
		$checkboxes = $this->news_default_checkboxes_model->find(1);
		Template::set('defaultcheckbox', $checkboxes);
		Template::set('toolbar_title', lang('simplenews_create') . ' simplenews');
		Template::render();
	}
	//--------------------------------------------------------------------
	// saving news
	private function save_category($type='insert', $id=0) {
		
		if ($type == 'update') {$_POST['id'] = $id; }
				
		$this->form_validation->set_rules('category_order', 'category_order', 	'numeric|xss_clean');
		$this->form_validation->set_rules('category_name', 'category_name', 	'required|trim|max_length[255]|strip_tags|xss_clean');
		$this->form_validation->set_rules('category_image', 'category_image', 	'trim|max_length[255]|strip_tags|xss_clean');
		
		if ($this->form_validation->run() === FALSE) {return FALSE;}
				
		// make sure we only pass in the fields we want
		$data = array();		
		$data['category_order']     = $this->input->post('category_order');
		$data['category_name']     	= $this->input->post('category_name');
		$data['category_image']     = $this->input->post('category_image');								 
				
		if ($type == 'insert')
		{
			$id = $this->category_model->insert($data);
			if (is_numeric($id))
			{
				$return = $id;
			} else
			{
				$return = FALSE;
			}
		}
		else if ($type == 'update')
		{
			$return = $this->news_model->update($id, $data);
		}
		return $return;
	}	
	//--------------------------------------------------------------------

}