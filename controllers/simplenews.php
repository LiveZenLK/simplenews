<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class simplenews extends Front_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->lang->load('simplenews');
		
	}

	//--------------------------------------------------------------------



	/*
		Method: index()

		Displays a list of form data.
	*/
	public function index()
	{

		Template::render();
	}

	//--------------------------------------------------------------------




}