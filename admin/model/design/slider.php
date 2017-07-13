<?php
class ModelDesignslider extends Model {
	public function addslider($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "slider SET name = '" . $this->db->escape($data['name']) . "', status = '" . (int)$data['status'] . "', caption = '" . (int)$data['caption'] . "'");
	
		$slider_id = $this->db->getLastId();
	
		if (isset($data['slider_image'])) {
			foreach ($data['slider_image'] as $slider_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "slider_image SET slider_id = '" . (int)$slider_id . "', link = '" .  $this->db->escape($slider_image['link']) . "', image = '" .  $this->db->escape($slider_image['image']) . "', thumbnail = '" .  $this->db->escape($slider_image['thumbnail']) . "', sorting='" . (int)$slider_image['sorting'] . "'");
				
				$slider_image_id = $this->db->getLastId();
				
				foreach ($slider_image['slider_image_description'] as $language_id => $slider_image_description) {				
					$this->db->query("INSERT INTO " . DB_PREFIX . "slider_image_description SET slider_image_id = '" . (int)$slider_image_id . "', language_id = '" . (int)$language_id . "', slider_id = '" . (int)$slider_id . "', title = '" .  $this->db->escape($slider_image_description['title']) . "', description = '" .  $this->db->escape($slider_image_description['description']) . "', subtitle = '" .  $this->db->escape($slider_image_description['subtitle']) . "', extra = '" .  $this->db->escape($slider_image_description['extra']) . "'");
				}
			}
		}		
	}
	
	public function editslider($slider_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "slider SET name = '" . $this->db->escape($data['name']) . "', status = '" . (int)$data['status'] . "', caption='" . (int)$data['caption'] . "' WHERE slider_id = '" . (int)$slider_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "slider_image WHERE slider_id = '" . (int)$slider_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "slider_image_description WHERE slider_id = '" . (int)$slider_id . "'");
			
		if (isset($data['slider_image'])) {
			foreach ($data['slider_image'] as $slider_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "slider_image SET slider_id = '" . (int)$slider_id . "', link = '" .  $this->db->escape($slider_image['link']) . "', image = '" .  $this->db->escape($slider_image['image']) . "', thumbnail = '" .  $this->db->escape($slider_image['thumbnail']) . "', sorting='" . (int)$slider_image['sorting'] . "'");
				
				$slider_image_id = $this->db->getLastId();
				
				foreach ($slider_image['slider_image_description'] as $language_id => $slider_image_description) {				
					$this->db->query("INSERT INTO " . DB_PREFIX . "slider_image_description SET slider_image_id = '" . (int)$slider_image_id . "', language_id = '" . (int)$language_id . "', slider_id = '" . (int)$slider_id . "', title = '" .  $this->db->escape($slider_image_description['title']) . "', description = '" .  $this->db->escape($slider_image_description['description']) . "', subtitle = '" .  $this->db->escape($slider_image_description['subtitle']) . "', extra = '" .  $this->db->escape($slider_image_description['extra']) . "'");
				}
			}
		}			
	}
	
	public function deleteslider($slider_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "slider WHERE slider_id = '" . (int)$slider_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "slider_image WHERE slider_id = '" . (int)$slider_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "slider_image_description WHERE slider_id = '" . (int)$slider_id . "'");
	}
	
	public function getslider($slider_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "slider WHERE slider_id = '" . (int)$slider_id . "'");
		
		return $query->row;
	}
		
	public function getsliders($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "slider";
		
		$sort_data = array(
			'name',
			'status'
		);	
		
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY name";	
		}
		
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
		
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}					

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
		
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}		
		
		$query = $this->db->query($sql);

		return $query->rows;
	}
		
	public function getsliderImages($slider_id) {
		$slider_image_data = array();
		
		$slider_image_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "slider_image WHERE slider_id = '" . (int)$slider_id . "' ORDER BY sorting ASC");
		
		foreach ($slider_image_query->rows as $slider_image) {
			$slider_image_description_data = array();
			 
			$slider_image_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "slider_image_description WHERE slider_image_id = '" . (int)$slider_image['slider_image_id'] . "' AND slider_id = '" . (int)$slider_id . "'");
			
			foreach ($slider_image_description_query->rows as $slider_image_description) {			
				$slider_image_description_data[$slider_image_description['language_id']] = array('title' => $slider_image_description['title'],
																								'description'=>$slider_image_description['description'],
																								'subtitle'=>$slider_image_description['subtitle'],
																								'extra'=>$slider_image_description['extra']
																								);
			}
		
			$slider_image_data[] = array(
				'slider_image_description' => $slider_image_description_data,
				'link'                     => $slider_image['link'],
				'image'                    => $slider_image['image'],
				'thumbnail'                => $slider_image['thumbnail'],
				'sorting'                  => $slider_image['sorting']	
			);
		}
		
		return $slider_image_data;
	}
		
	public function getTotalsliders() {

		$query=$this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "slider (`slider_id` int(11) NOT NULL AUTO_INCREMENT, `name` varchar(64) COLLATE utf8_general_ci NOT NULL, `status` tinyint(1) NOT NULL,`caption` tinyint(1) NOT NULL, PRIMARY KEY (`slider_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;");

		$query=$this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "slider_image (`slider_image_id` int(11) NOT NULL AUTO_INCREMENT, `slider_id` int(11) NOT NULL, `link` varchar(255) COLLATE utf8_general_ci NOT NULL, `image` varchar(255) COLLATE utf8_general_ci NOT NULL,`thumbnail` varchar(255) COLLATE utf8_general_ci NOT NULL, `sorting` int(10) NOT NULL, PRIMARY KEY (`slider_image_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;");
		$query=$this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "slider_image_description (`slider_image_id` int(11) NOT NULL, `language_id` int(11) NOT NULL, `slider_id` int(11) NOT NULL, `title` varchar(64) COLLATE utf8_general_ci NOT NULL, `subtitle` varchar(64) COLLATE utf8_general_ci NOT NULL, `description` varchar(256) COLLATE utf8_general_ci NOT NULL, `extra` varchar(256) COLLATE utf8_general_ci NOT NULL, PRIMARY KEY (`slider_image_id`,`language_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;");
		

      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "slider;");
		if ($query->row['total']==0) {
$this->db->query("INSERT INTO " . DB_PREFIX . "slider VALUES(1, 'Deneme Afişi', 1, 1);");
$this->db->query("INSERT INTO " . DB_PREFIX . "slider_image VALUES(64, 1, 'index.php?route=product/product&amp;product_id=4', 'data/nemo.jpg', '', 4);");
$this->db->query("INSERT INTO " . DB_PREFIX . "slider_image VALUES(63, 1, 'index.php?route=product/product&amp;product_id=3', 'data/up.jpg', '', 3);");
$this->db->query("INSERT INTO " . DB_PREFIX . "slider_image VALUES(61, 1, 'index.php?route=product/product&amp;product_id=1', 'data/toystory.jpg', '', 1);");
$this->db->query("INSERT INTO " . DB_PREFIX . "slider_image VALUES(62, 1, 'index.php?route=product/product&amp;product_id=2', 'data/walle.jpg', '', 2);");
$this->db->query("INSERT INTO " . DB_PREFIX . "slider_image_description VALUES(64, 1, 1, 'resim4', 'alt başlık 4', 'açıklama 4', 'ek açıklama 4');");
$this->db->query("INSERT INTO " . DB_PREFIX . "slider_image_description VALUES(63, 1, 1, 'resim 3', 'alt başlık 3', 'açıklama 3', 'ek açıklama 3');");
$this->db->query("INSERT INTO " . DB_PREFIX . "slider_image_description VALUES(62, 1, 1, 'resim 2', 'alt başlık 2', 'açıklama 2', 'ek açıklama 2');");
$this->db->query("INSERT INTO " . DB_PREFIX . "slider_image_description VALUES(61, 1, 1, 'resim 1', 'alt başlık 1', 'açıklama 1', 'ek açıklama 1');");
$this->db->query("INSERT INTO " . DB_PREFIX . "setting VALUES('', 0, 'advancedslider', 'advancedslider_module', 'a:1:{i:0;a:10:{s:9:\"slider_id\";s:1:\"1\";s:5:\"width\";s:3:\"618\";s:6:\"height\";s:3:\"246\";s:8:\"velocity\";s:4:\"1500\";s:8:\"duration\";s:4:\"4000\";s:4:\"type\";s:1:\"2\";s:9:\"layout_id\";s:1:\"1\";s:8:\"position\";s:11:\"content_top\";s:6:\"status\";s:1:\"1\";s:10:\"sort_order\";s:0:\"\";}}', 1);");				
		}
		
		return $query->row['total'];
	}

}
?>