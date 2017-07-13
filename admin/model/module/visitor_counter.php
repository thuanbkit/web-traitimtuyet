<?php

class ModelModuleVisitorCounter extends Model {
	
	public function createVisitorTable() 
	{
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "visitor_counter (`ip` varchar(20) NOT NULL default '', `dt` date NOT NULL, `hits` int(10) NOT NULL default '1', `online` varchar(255) NOT NULL, PRIMARY KEY (ip, dt))");
	}

}
?>
