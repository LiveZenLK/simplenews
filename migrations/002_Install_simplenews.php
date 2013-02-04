<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_simplenews extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;
				
		// BOF item_db  
		//$this->dbforge->add_field('`id` serial NOT NULL');
		$this->dbforge->add_field('`id` INT(10) NOT NULL AUTO_INCREMENT');		
		$this->dbforge->add_field('`created_on` DATETIME NOT NULL');
		$this->dbforge->add_field('`modified_on` DATETIME NOT NULL');
		$this->dbforge->add_field('`title` TEXT NOT NULL');
		$this->dbforge->add_field('`category_id` int(4) NOT NULL');
		$this->dbforge->add_field('`status` int(4) NOT NULL');
		$this->dbforge->add_field('`textarea` TEXT NOT NULL');
		$this->dbforge->add_field('`checkbox` varchar(225) NOT NULL');
		
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('news');
		
		$this->db->query("INSERT INTO {$prefix}news VALUES(1, '2012-08-24 02:51:16','2012-11-22 17:56:16', 'The 1 title ever',1,1, 
		'The 1 text area', 'options 1||options 2') ");
		$this->db->query("INSERT INTO {$prefix}news VALUES(2, '2012-09-24 03:51:16','2012-11-22 17:56:16', 'The 2 title ever',2,0, 
		'The 2 text area', 'options 2||options 3') ");		
		$this->db->query("INSERT INTO {$prefix}news VALUES(3, '2012-10-24 04:51:16','2012-11-22 17:56:16', 'The 3 title ever',3,1, 
		'The 3 text area', 'options 4||options 5') ");
		$this->db->query("INSERT INTO {$prefix}news VALUES(4, '2012-11-01 05:51:16','2012-11-22 17:56:16', 'The 4 title ever',4,0, 
		'The 4 text area', 'options 1||options 3') ");
		$this->db->query("INSERT INTO {$prefix}news VALUES(5, '2012-11-01 06:51:16','2012-11-22 17:56:16', 'The 5 title ever',5,1, 
		'The 5 text area', 'options 2||options 4') ");
		// EOF item_db
				
		// BOF item_category 
		//$this->dbforge->add_field('`id` serial NOT NULL');
		$this->dbforge->add_field('`id` INT(10) NOT NULL AUTO_INCREMENT');
		$this->dbforge->add_field('`category_order` TEXT NOT NULL');
		$this->dbforge->add_field('`category_name` TEXT NOT NULL');
		$this->dbforge->add_field('`category_image` varchar(45) NOT NULL');
						
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('newscategory');
		
		$this->db->query("INSERT INTO {$prefix}newscategory VALUES(1, 1, 'Category one', 'image1.gif')");
		$this->db->query("INSERT INTO {$prefix}newscategory VALUES(2, 2, 'Category two', 'image2.gif' )");
		$this->db->query("INSERT INTO {$prefix}newscategory VALUES(3, 3, 'Category tree', 'image3.gif')");
		$this->db->query("INSERT INTO {$prefix}newscategory VALUES(4, 4, 'Category four', 'image4.gif')");
		$this->db->query("INSERT INTO {$prefix}newscategory VALUES(5, 5, 'Category five', 'image5.gif')");
		// EOF item_category
		
		// BOF Default Checkboxes
		//$this->dbforge->add_field('`id` serial NOT NULL');
		$this->dbforge->add_field('`id` INT(10) NOT NULL AUTO_INCREMENT');
		$this->dbforge->add_field('`checkboxes` varchar(225) NOT NULL');
				
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('news_default_checkboxes');

		$this->db->query("INSERT INTO {$prefix}news_default_checkboxes VALUES(1, 'options 1||options 2||options 3||options 4||options 5||options 6||options 7')");
		// EOF Default Checkboxes		
		
		// BOF Default Images
		$this->dbforge->add_field('`id` INT(10) NOT NULL AUTO_INCREMENT');
		$this->dbforge->add_field('`image_newsid` int(4) NOT NULL');
		$this->dbforge->add_field('`image_order` int(4) NOT NULL');
		$this->dbforge->add_field('`image_title` TEXT NOT NULL');
		$this->dbforge->add_field('`image_description` TEXT NOT NULL');
		$this->dbforge->add_field('`image_file` varchar(45) NOT NULL');
				
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('news_images');

		$this->db->query("INSERT INTO {$prefix}news_images VALUES(1, 1, 1, 'Image Title 1', 'Image Description 1', 'image1.gif' )");
		$this->db->query("INSERT INTO {$prefix}news_images VALUES(2, 1, 2, 'Image Title 1', 'Image Description 1', 'image2.gif' )");
				
		$this->db->query("INSERT INTO {$prefix}news_images VALUES(3, 2, 1 , 'Image Title 2', 'Image Description 2', 'image3.gif' )");
		$this->db->query("INSERT INTO {$prefix}news_images VALUES(4, 2, 2 , 'Image Title 2', 'Image Description 2', 'image4.gif' )");
		
		$this->db->query("INSERT INTO {$prefix}news_images VALUES(5, 3, 1 , 'Image Title 3', 'Image Description 3', 'image5.gif' )");
		$this->db->query("INSERT INTO {$prefix}news_images VALUES(6, 3, 2 , 'Image Title 3', 'Image Description 3', 'image6.gif' )");
		
		$this->db->query("INSERT INTO {$prefix}news_images VALUES(7, 4, 1 , 'Image Title 4', 'Image Description 4', 'image7.gif' )");
		$this->db->query("INSERT INTO {$prefix}news_images VALUES(8, 4, 2 , 'Image Title 4', 'Image Description 5', 'image8.gif' )");
		// EOF Default Images
							
	
	//--------------------------------------------------------------------
	}
	
	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('simplenews');

	}

	//--------------------------------------------------------------------

}