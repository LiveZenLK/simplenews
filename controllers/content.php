<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class content extends Admin_Controller {
	//--------------------------------------------------------------------
	public function __construct()
	{
		parent::__construct();
		$this->auth->restrict('Simplenews.Content.View');
		$this->lang->load('simplenews');				
		$this->load->helper('form');
		$this->load->model('news_model', null, true);
		$this->load->model('category_model', null, true);
		$this->load->model('news_default_checkboxes_model', null, true);
		$this->load->model('news_default_checkboxes_two_model', null, true);
		Template::set_block('sub_nav', 'content/_sub_nav');
	}
	//--------------------------------------------------------------------
	/*	Method: index()
		Displays a list of form data.
	*/
	public function index()
	{
		Template::set('toolbar_title', 'Manage simplenews');
		Template::render();
	}
	//--------------------------------------------------------------------
	/*  Method: create()
		Creates a simplenews object.
	*/
	public function create()
	{
		$this->auth->restrict('Simplenews.Content.Create');

		Assets::add_module_js('simplenews', 'simplenews.js');

		Template::set('toolbar_title', lang('simplenews_create') . ' simplenews');
		Template::render();
	}
	//--------------------------------------------------------------------
	
	
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
				Template::set_message(lang('simplenews_edit_failure') . $this->fields_model->error, 'error');
			}
		}
		
		$checkboxes = $this->news_default_checkboxes_model->find_all();		
		Template::set('defaultcheckbox', $checkboxes);
				
		$checkboxestwo = $this->news_default_checkboxes_two_model->find_all();
		Template::set('defaultcheckboxtwo', $checkboxestwo);
		
		$category = $this->category_model->find_all();		
		Template::set('categories', $category);
		
		$editnewsdata = $this->news_model->find($id);
		Template::set('news', $editnewsdata);		
	
		Template::set('toolbar_title', lang('simplenews_edit') . ' Itens');
		Template::render();
	}
	// saving news
	private function save_news($type='insert', $id=0) {
		
		if ($type == 'update') {$_POST['id'] = $id; }		
		$this->form_validation->set_rules('title', 'title', 					'required|trim|max_length[255]|strip_tags|xss_clean');
		$this->form_validation->set_rules('category_id', 'category_id', 		'numeric|xss_clean');
		$this->form_validation->set_rules('status', 'status', 					'numeric|xss_clean');
		$this->form_validation->set_rules('textarea', 'textarea', 				'required|trim|max_length[255]|strip_tags|xss_clean');
		$this->form_validation->set_rules('selectmultiple', 'selectmultiple', 	'required|trim|max_length[255]|strip_tags|xss_clean');
		$this->form_validation->set_rules('checkbox', 'checkbox', 				'required|trim|max_length[255]|strip_tags|xss_clean');
		
		if ($this->form_validation->run() === FALSE) {
			return FALSE;
		}
				
		// make sure we only pass in the fields we want
		$data = array();
		$data['title']       		= $this->input->post('title');
		$data['category_id'] 	    = $this->input->post('category_id');
		$data['status']      		= $this->input->post('status');
		$data['textarea']     		= $this->input->post('textarea');
		$data['selectmultiple']     = $this->input->post('selectmultiple');
		$data['checkbox']       	= $this->input->post('checkbox');
		/*
		if ( ! $this->upload->do_upload('foto')) {
			$this->error = $this->upload->display_errors();
			return FALSE;
		} else {
         $img_data = $this->upload->data();
         $data['foto'] = $img_data['foto']; 
		}
		$config['upload_path'] = realpath( FCPATH.'assets/images/');
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '0';
		$config['max_width'] = '0';
		$config['max_height'] = '0';
		$this->load->library('upload', $config);
		*/
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
	/*
		Method: edit()
		Allows editing of simplenews data.
	*/
	public function edit()
	{
		$this->auth->restrict('Simplenews.Content.Edit');

		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('simplenews_invalid_id'), 'error');
			redirect(SITE_AREA .'/content/simplenews');
		}

		Assets::add_module_js('simplenews', 'simplenews.js');

		Template::set('toolbar_title', lang('simplenews_edit') . ' simplenews');
		Template::render();
	}	
	//--------------------------------------------------------------------
	
	


	/*
		Method: delete()

		Allows deleting of simplenews data.
	*/
	public function delete()
	{
		$this->auth->restrict('Simplenews.Content.Delete');

		$id = $this->uri->segment(5);

		if (!empty($id))
		{

		}

		redirect(SITE_AREA .'/content/simplenews');
	}

	//--------------------------------------------------------------------




}