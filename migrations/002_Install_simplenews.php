<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_simplenews extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;
		
		// BOF item_db  
		$this->dbforge->add_field('`id` serial NOT NULL');				
		$this->dbforge->add_field('`created_on` DATETIME NOT NULL');
		$this->dbforge->add_field('`modified_on` DATETIME NOT NULL');
		$this->dbforge->add_field('`title` TEXT NOT NULL');
		$this->dbforge->add_field('`category_id` int(4) NOT NULL');
		$this->dbforge->add_field('`status` int(4) NOT NULL');
		$this->dbforge->add_field('`textarea` TEXT NOT NULL');
		$this->dbforge->add_field('`selectmultiple` varchar(225) NOT NULL');
		$this->dbforge->add_field('`checkbox` varchar(225) NOT NULL');		
		$this->dbforge->add_field('`foto` varchar(45) NOT NULL');
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('news');
		
		$this->db->query("INSERT INTO {$prefix}news VALUES(1, '2012-08-24 02:51:16','2012-11-22 17:56:16', 'The 1 title ever',1,1, 
		'The 1 text area','selectmultiple 1, selectmultiple 2, selectmultiple 3', 'newscheckboxes 1, newscheckboxes 2, newscheckboxes 3', 'produto1.jpg') ");
		$this->db->query("INSERT INTO {$prefix}news VALUES(2, '2012-09-24 03:51:16','2012-11-22 17:56:16', 'The 2 title ever',2,0, 
		'The 2 text area', 'selectmultiple 1, selectmultiple 2, selectmultiple 3' , 'newscheckboxes 1, newscheckboxes 2, newscheckboxes 3', 'produto2.jpg') ");		
		$this->db->query("INSERT INTO {$prefix}news VALUES(3, '2012-10-24 04:51:16','2012-11-22 17:56:16', 'The 3 title ever',3,1, 
		'The 3 text area', 'selectmultiple 1, selectmultiple 2, selectmultiple 3' , 'newscheckboxes 1, newscheckboxes 2, newscheckboxes 3', 'produto3.jpg') ");
		$this->db->query("INSERT INTO {$prefix}news VALUES(4, '2012-11-01 05:51:16','2012-11-22 17:56:16', 'The 4 title ever',4,0, 
		'The 4 text area', 'selectmultiple 1, selectmultiple 2, selectmultiple 3' , 'newscheckboxes 1, newscheckboxes 2, newscheckboxes 3', 'produto4.jpg') ");
		$this->db->query("INSERT INTO {$prefix}news VALUES(5, '2012-11-01 06:51:16','2012-11-22 17:56:16', 'The 5 title ever',5,1, 
		'The 5 text area', 'selectmultiple 1, selectmultiple 2, selectmultiple 3' , 'newscheckboxes 1, newscheckboxes 2, newscheckboxes 3', 'produto5.jpg') ");
		// EOF item_db
				
		// BOF item_category 
		$this->dbforge->add_field('`id` serial NOT NULL');
		$this->dbforge->add_field('`category_name` TEXT NOT NULL');
		
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('newscategory');
		
		$this->db->query("INSERT INTO {$prefix}newscategory VALUES(1,'Category one')");
		$this->db->query("INSERT INTO {$prefix}newscategory VALUES(2,'Category two')");
		$this->db->query("INSERT INTO {$prefix}newscategory VALUES(3,'Category tree')");
		$this->db->query("INSERT INTO {$prefix}newscategory VALUES(4,'Category four')");
		$this->db->query("INSERT INTO {$prefix}newscategory VALUES(5,'Category five')");
		// EOF item_category
		
		// BOF Default Checkboxes
		$this->dbforge->add_field('`id` serial NOT NULL');
		$this->dbforge->add_field('`checkboxes` varchar(225) NOT NULL');
				
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('news_default_checkboxes');

		$this->db->query("INSERT INTO {$prefix}news_default_checkboxes VALUES(1, 'newscheckboxes 1, newscheckboxes 2, newscheckboxes 3')");
		// EOF Default Checkboxes
		
		// BOF Default Checkboxes (Two)
		$this->dbforge->add_field('`id` serial NOT NULL');
		$this->dbforge->add_field('`checkboxes` varchar(225) NOT NULL');
				
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('news_default_checkboxes_two');

		$this->db->query("INSERT INTO {$prefix}news_default_checkboxes_two VALUES(1, 'newscheckboxes 1, newscheckboxes 2')");
		// EOF Default Checkboxes (Two)
	
	//--------------------------------------------------------------------
	}
	
	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('simplenews');

	}

	//--------------------------------------------------------------------

}