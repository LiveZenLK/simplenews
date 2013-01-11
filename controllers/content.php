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
		
		
		// BOF - Load dataTables Jquery plugin		
		Assets::add_js(Template::theme_url('js/bootstrap.js'));
		Assets::add_js($this->load->view('reports/activities_js', null, true), 'inline');

		Assets::add_js( array ( Template::theme_url('js/jquery.dataTables.min.js')));
		Assets::add_js( array ( Template::theme_url('js/bootstrap-dataTables.js')));
		Assets::add_css( array ( Template::theme_url('css/datatable.css')));
		Assets::add_css( array ( Template::theme_url('css/bootstrap-dataTables.css'))) ;
		// EOF - Load dataTables Jquery plugin

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
		
		// BOF - Pagination		
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
		
		// get the activities
		/*
		$this->db->join('users', 'activities.user_id = users.id', 'left');
		$this->db->order_by('activity_id','desc'); // most recent stuff on top
		$this->db->select('activity, module, activities.created_on AS created, username');
		Template::set('activity_content', $this->activity_model->limit($limit, $offset)->find_all());
		 */		
		//Template::set('select_options', $options);
		//EOF - Pagination
		Template::set('toolbar_title', 'Manage Simplenews');
		Template::render();
	}
	//--------------------------------------------------------------------
	/*  Method: create()
		Creates a simplenews object.
	*/
	public function create()
	{
		$this->auth->restrict('Simplenews.Content.Create');
		//Assets::add_module_js('simplenews', 'simplenews.js');
		
		if ($this->input->post('submit')) {
			if ($this->save_news('insert')) {
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('simplenews_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'simplenews');
				Template::set_message(lang('simplenews_edit_success'), 'success');
				//Template::redirect(SITE_AREA .'/content/simplenews');
			} else {
				Template::set_message(lang('simplenews_edit_failure') . $this->fields_model->error, 'error');
			}
		}
		/*
		if ($this->input->post('submit')) {
			if ($this->save_news()) {
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('simplenews_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'simplenews');
				Template::set_message(lang('simplenews_edit_success'), 'success');
				//Template::redirect(SITE_AREA .'/content/simplenews');
			} else {
				Template::set_message(lang('simplenews_edit_failure') . $this->fields_model->error, 'error');
			}
		}
		*/
				
		$category = $this->category_model->find_all();
		Template::set('categories', $category);
		
		$checkboxes = $this->news_default_checkboxes_model->find(1);		
		Template::set('defaultcheckbox', $checkboxes);		

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
		
		$editnewsdata = $this->news_model->find($id);
		Template::set('news', $editnewsdata);
		
		$category = $this->category_model->find_all();
		Template::set('categories', $category);
		
		$checkboxes = $this->news_default_checkboxes_model->find(1);		
		Template::set('defaultcheckbox', $checkboxes);
				
				
	
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
		$this->form_validation->set_rules('checkbox', 'checkbox', 				'required|xss_clean');
		//$this->form_validation->set_rules('foto', 'foto', 				'required|trim|max_length[255]|strip_tags|xss_clean');
		
		if ($this->form_validation->run() === FALSE) {return FALSE;}
				
		// make sure we only pass in the fields we want
		$data = array();
				
		//$data['id']     			= $this->input->post('id');
		//$data['modified_on']     	= $this->input->post('modified_on');
		//$data['created_on']     	= $this->input->post('created_on');
								
		$data['title']       		= $this->input->post('title');
		$data['category_id'] 	    = $this->input->post('category_id');
		$data['status']      		= $this->input->post('status');
		$data['textarea']     		= $this->input->post('textarea');
				
		$checkedboxes1 = $this->input->post('checkbox');
		$checkedboxes = implode("||",$checkedboxes1);
		$data['checkbox']       	= $checkedboxes;		 
		
		//$data['checkbox']       	= implode("||",$this->input->post('checkbox'));
			

		// Image Upload		 
		// $data['foto']       		= $this->input->post('foto');
		/*
		$this->load->library('upload', $config);						
		$config['upload_path'] = realpath( FCPATH.'assets/images/');
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '0';
		$config['max_width'] = '0';
		$config['max_height'] = '0';
		
		if ( ! $this->upload->do_upload('foto')) {
			$this->error = $this->upload->display_errors();
			return FALSE;
		} else {
         $img_data = $this->upload->data();
         $data['foto'] = $img_data['foto']; 
		}
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