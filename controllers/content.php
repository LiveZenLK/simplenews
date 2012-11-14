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
			if ($this->save_item('update', $id)) {
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('simplenews_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'simplenews');
				Template::set_message(lang('simplenews_edit_success'), 'success');
			} else {
				Template::set_message(lang('simplenews_edit_failure') . $this->fields_model->error, 'error');
			}
		}
		
		$category = $this->category_model->find_all();	
//		$this->news_model->where('category_id',$id);
		
		Template::set('categories', $category);		
		
		$editnewsdata = $this->news_model->find($id);
		Template::set('news', $editnewsdata);
		
		Template::set('toolbar_title', lang('simplenews_edit') . ' Itens');
		Template::render();	
				
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