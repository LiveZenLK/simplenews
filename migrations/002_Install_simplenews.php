<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_simplenews extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;
		
		// BOF item_db - Cria banco de dados das listagens
		$this->dbforge->add_field('`id` serial NOT NULL');
		$this->dbforge->add_field('`title` TEXT NOT NULL');
		$this->dbforge->add_field('`category_id` int(4) NOT NULL');						
		$this->dbforge->add_field('`status` int(4) NOT NULL');
				
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('news');

        $this->db->query("INSERT INTO {$prefix}news VALUES(1,'The first title ever',1,0)");
		$this->db->query("INSERT INTO {$prefix}news VALUES(2,'The second title ever',2,0)");
				
		// BOF item_category - Cria categoria para as listagens
		$this->dbforge->add_field('`id` serial NOT NULL');
		$this->dbforge->add_field('`category_name` TEXT NOT NULL');

		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('newscategory');
		
		$this->db->query("INSERT INTO {$prefix}newscategory VALUES(1,'Category one')");
		$this->db->query("INSERT INTO {$prefix}newscategory VALUES(2,'Category two')");
		
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('simplenews');

	}

	//--------------------------------------------------------------------

}