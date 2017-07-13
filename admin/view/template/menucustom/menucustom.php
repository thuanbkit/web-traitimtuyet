<?php
	class ModelIdeaMenucustom extends Model {
	
		public function createmenu() {
			
			$create_menu = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "menu` ( ";
			$create_menu .= "`menu_id` int(11) NOT NULL AUTO_INCREMENT, ";
			$create_menu .= "`image` varchar(255) COLLATE utf8_bin DEFAULT NULL, ";
			$create_menu .= "`parent_id` int(11) NOT NULL DEFAULT '0', ";
			$create_menu .= "`chossen_id` int(11) NOT NULL DEFAULT '0', ";
			$create_menu .= "`category_id_chossen` varchar(255) NOT NULL DEFAULT '0', ";
			$create_menu .= "`top` tinyint(1) NOT NULL, ";
			$create_menu .= "`column` int(3) NOT NULL, ";
			$create_menu .= "`sort_order` int(3) NOT NULL DEFAULT '0', ";
			$create_menu .= "`status` tinyint(1) NOT NULL, ";
			$create_menu .= "`date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00', ";
			$create_menu .= "`date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00', ";
			$create_menu .= "PRIMARY KEY (`menu_id`) ";
			$create_menu .= ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=59 ;";
			$this->db->query($create_menu);
			
			$create_menu_description = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "menu_description` ( ";
			$create_menu_description .= "`menu_id` int(11) NOT NULL, ";
			$create_menu_description .= "`language_id` int(11) NOT NULL, ";
			$create_menu_description .= "`name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '', ";
			$create_menu_description .= "`description` text COLLATE utf8_bin NOT NULL, ";
			$create_menu_description .= "PRIMARY KEY (`menu_id`,`language_id`), ";
			$create_menu_description .= "KEY `name` (`name`) ";
			$create_menu_description .= ") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin; ";
			$this->db->query($create_menu_description);
			
			/*$create_menu_to_layout = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "menu_to_layout` ( ";
			$create_menu_to_layout .= "`menu_id` int(11) NOT NULL,";
			$create_menu_to_layout .= "`store_id` int(11) NOT NULL,";
			$create_menu_to_layout .= "`layout_id` int(11) NOT NULL,";
			$create_menu_to_layout .= " PRIMARY KEY (`menu_id`,`store_id`)";
			$create_menu_to_layout .= ") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin; ";
			$this->db->query($create_menu_to_layout);*/
			
			/*$create_menu_to_store = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "menu_to_store` (";
			$create_menu_to_store .= " `menu_id` int(11) NOT NULL,";
			$create_menu_to_store .= " `store_id` int(11) NOT NULL,";
			$create_menu_to_store .= " PRIMARY KEY (`menu_id`,`store_id`) ";
			$create_menu_to_store .= ") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin; ";
			$this->db->query($create_menu_to_store);*/
			
		}
		//DROP TABLE `webcr_op_menu`, `webcr_op_menu_description`, `webcr_op_menu_to_layout`, `webcr_op_menu_to_store`;
		public function dropmenu() {
			$drop = "DROP TABLE `" . DB_PREFIX . "menu`, `" . DB_PREFIX . "menu_description`;";
			$this->db->query($drop);
		}
		
		//lay du lieu cho danh sach
		public function getMenus($parent_id = 0) {
			$menu_data = $this->cache->get('menu.' . (int)$this->config->get('config_language_id') . '.' . (int)$parent_id);
				
			if (!$menu_data) {
				$menu_data = array();
				//print_r($menu_data);
				
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "menu c LEFT JOIN " . DB_PREFIX . "menu_description cd ON (c.menu_id = cd.menu_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY c.sort_order, cd.name ASC");
				
				//print_r($query);
				
				foreach ($query->rows as $result) {
					$menu_data[] = array(
						'menu_id' => $result['menu_id'],
						'name'        => $this->getPath($result['menu_id'], $this->config->get('config_language_id')),
						'status'  	  => $result['status'],
						'sort_order'  => $result['sort_order']
					);
				
					$menu_data = array_merge($menu_data, $this->getMenus($result['menu_id']));
				}	
		
				$this->cache->set('menu.' . (int)$this->config->get('config_language_id') . '.' . (int)$parent_id, $menu_data);
			}
			
			//print_r($menu_data);
			return $menu_data;
	}
	
	public function deleteMenu($menu_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "menu WHERE menu_id = '" . (int)$menu_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "menu_description WHERE menu_id = '" . (int)$menu_id . "'");
		
		$query = $this->db->query("SELECT menu_id FROM " . DB_PREFIX . "menu WHERE parent_id = '" . (int)$menu_id . "'");

		foreach ($query->rows as $result) {
			$this->deleteMenu($result['menu_id']);
		}
		
		$this->cache->delete('menu');
	} 
	
	public function getPath($menu_id) {
		$query = $this->db->query("SELECT name, parent_id FROM " . DB_PREFIX . "menu c LEFT JOIN " . DB_PREFIX . "menu_description cd ON (c.menu_id = cd.menu_id) WHERE c.menu_id = '" . (int)$menu_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY c.sort_order, cd.name ASC");
		
		if ($query->row['parent_id']) {
			return $this->getPath($query->row['parent_id'], $this->config->get('config_language_id')) . $this->language->get('text_separator') . $query->row['name'];
		} else {
			return $query->row['name'];
		}
	}
		
	public function addMenu($data) {
		
		
		$value = "0";
		$chossen = 0;
		
		if((int)$data['chossen_id'] == 1)
		{
			if(	(int)$data['category_id_chossen_new'] )
			{
				$value= (int)$data['category_id_chossen_new'];
				$chossen = $data['chossen_id'];
			}
		}
		else if ((int)$data['chossen_id'] == 2)
		{
			if(	(int)$data['category_id_chossen_pro'] )
			{
				$value= (int)$data['category_id_chossen_pro'];
				$chossen = $data['chossen_id'];
			}
		}
		else if ((int)$data['chossen_id'] == 3)
		{
			
				$value= $data['value_chossen'];
				$chossen = $data['chossen_id'];
		//	print_r($value);
		}		
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "menu SET parent_id = '" . (int)$data['parent_id'] . "', chossen_id = '" . (int)$chossen . "', category_id_chossen = '" . $value . "', `top` = '" . (isset($data['top']) ? (int)$data['top'] : 0) . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");
	
		$menu_id = $this->db->getLastId();
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "menu SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE menu_id = '" . (int)$menu_id . "'");
		}
		
		foreach ($data['menu_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "menu_description SET menu_id = '" . (int)$menu_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "' , description = '" . $this->db->escape($value['description']) . "'");
		}
		
		$this->cache->delete('menu');
	}
	public function editMenu($menu_id, $data) {
	
		$value = "0";
		$chossen = 0; //day la home
		
		if((int)$data['chossen_id'] == 1) //day la infor
		{
			if(	(int)$data['category_id_chossen_info'] )
			{
				$value= (int)$data['category_id_chossen_info'];
				$chossen = $data['chossen_id'];
			}
		}
		else if ((int)$data['chossen_id'] == 2) //day la category
		{
			if(	(int)$data['category_id_chossen_pro'] )
			{
				$value= (int)$data['category_id_chossen_pro'];
				$chossen = $data['chossen_id'];
			}
		}
		else if ((int)$data['chossen_id'] == 3) //day la orther
		{
				$value= $data['value_chossen'];
				$chossen = $data['chossen_id'];
		}
		else if ((int)$data['chossen_id'] == 4)
		{
			$chossen = $data['chossen_id'];
			$value= 'contact';
		}
		else if ((int)$data['chossen_id'] == 5)
		{
			$chossen = $data['chossen_id'];
			$value= 'abouts';
		}else if ((int)$data['chossen_id'] == 6)
		{
			$chossen = $data['chossen_id'];
			$value= 'allproducts';
		}else if ((int)$data['chossen_id'] == 7)
		{
			$chossen = $data['chossen_id'];
			$value= 'special';
		}
	
	
		$this->db->query("UPDATE " . DB_PREFIX . "menu SET parent_id = '" . (int)$data['parent_id'] . "', `top` = '" . (isset($data['top']) ? (int)$data['top'] : 0) . "', chossen_id = '" . (int)$chossen . "', category_id_chossen = '" . $value . "',  sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE menu_id = '" . (int)$menu_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "menu SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE menu_id = '" . (int)$menu_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "menu_description WHERE menu_id = '" . (int)$menu_id . "'");

		foreach ($data['menu_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "menu_description SET menu_id = '" . (int)$menu_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}

		
		$this->cache->delete('menu');
	}
	public function getMenu($menu_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "menu WHERE menu_id = '" . (int)$menu_id . "'");
		
		return $query->row;
	} 
	
	
	///
	public function getMenuDescriptions($menu_id) {
		$menu_description_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "menu_description WHERE menu_id = '" . (int)$menu_id . "'");
		
		foreach ($query->rows as $result) {
			$menu_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'description'      => $result['description']
			);
		}
		
		return $menu_description_data;
	}	

		
	public function getTotalMenus() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "menu");
		
		return $query->row['total'];
	}	
		
	public function getTotalMenusByImageId($image_id) {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "menu WHERE image_id = '" . (int)$image_id . "'");
		
		return $query->row['total'];
	}
	
	public function getCategories($parent_id = 0) {
	
		$category_data = array();
		if (!$category_data) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY c.sort_order, cd.name ASC");
		
			foreach ($query->rows as $result) {
				$category_data[] = array(
					'category_id' => $result['category_id'],
					'name'        => $this->getPath_cat($result['category_id'])
				);
			
				$category_data = array_merge($category_data, $this->getCategories($result['category_id']));
			}	
		}
		return $category_data;
	}
		
	public function getPath_cat($category_id) {
		$query = $this->db->query("SELECT name, parent_id FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) WHERE c.category_id = '" . (int)$category_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY c.sort_order, cd.name ASC");
		
		if ($query->row['parent_id']) {
			return $this->getPath_cat($query->row['parent_id'], $this->config->get('config_language_id')) . $this->language->get('text_separator') . $query->row['name'];
		} else {
			return  $query->row['name'];
		}
	}
	
}
	
?>