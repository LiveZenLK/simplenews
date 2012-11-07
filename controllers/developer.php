<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class developer extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Simplenews.Developer.View');
		$this->lang->load('simplenews');
		
		Template::set_block('sub_nav', 'developer/_sub_nav');
	}

	//--------------------------------------------------------------------



	/*
		Method: index()

		Displays a list of form data.
	*/
	public function index()
	{

		Template::set('toolbar_title', 'Manage simplenews');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: create()

		Creates a simplenews object.
	*/
	public function create()
	{
		$this->auth->restrict('Simplenews.Developer.Create');

		Assets::add_module_js('simplenews', 'simplenews.js');

		Template::set('toolbar_title', lang('simplenews_create') . ' simplenews');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

		Allows editing of simplenews data.
	*/
	public function edit()
	{
		$this->auth->restrict('Simplenews.Developer.Edit');

		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('simplenews_invalid_id'), 'error');
			redirect(SITE_AREA .'/developer/simplenews');
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
		$this->auth->restrict('Simplenews.Developer.Delete');

		$id = $this->uri->segment(5);

		if (!empty($id))
		{

		}

		redirect(SITE_AREA .'/developer/simplenews');
	}

	//--------------------------------------------------------------------




}