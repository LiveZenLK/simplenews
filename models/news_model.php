<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends BF_Model {
	
	protected $table		= "news";
	protected $key			= "id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";
	protected $set_created	= true;
	protected $set_modified = true;
}
