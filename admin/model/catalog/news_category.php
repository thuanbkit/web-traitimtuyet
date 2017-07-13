<?php
class ModelCatalogNewsCategory extends Model {
	public function addNewsCategory($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "news_category SET parent_id = '" . (int)$data['parent_id'] . "', `top` = '" . (isset($data['top']) ? (int)$data['top'] : 0) . "', `column` = '" . (int)$data['column'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");
	
		$news_category_id = $this->db->getLastId();
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "news_category SET image = '" . $this->db->escape($data['image']) . "' WHERE news_category_id = '" . (int)$news_category_id . "'");
		}
		
		foreach ($data['news_category_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "news_category_description SET news_category_id = '" . (int)$news_category_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}
		
		if (isset($data['news_category_store'])) {
			foreach ($data['news_category_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_category_to_store SET news_category_id = '" . (int)$news_category_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
		
		if (isset($data['cat_layout'])) {
			foreach ($data['cat_layout'] as $store_id => $layout) {
				if ($layout['layout_id']) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "news_category_to_layout SET news_category_id = '" . (int)$news_category_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout['layout_id'] . "'");
				}
			}
		}
						
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'news_category_id=" . (int)$news_category_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
		
		$this->cache->delete('news_category');
	}
	
	public function editNewsCategory($news_category_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "news_category SET parent_id = '" . (int)$data['parent_id'] . "', `top` = '" . (isset($data['top']) ? (int)$data['top'] : 0) . "', `column` = '" . (int)$data['column'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE news_category_id = '" . (int)$news_category_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "news_category SET image = '" . $this->db->escape($data['image']) . "' WHERE news_category_id = '" . (int)$news_category_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "news_category_description WHERE news_category_id = '" . (int)$news_category_id . "'");

		foreach ($data['news_category_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "news_category_description SET news_category_id = '" . (int)$news_category_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_category_to_store WHERE news_category_id = '" . (int)$news_category_id . "'");
		
		if (isset($data['news_category_store'])) {		
			foreach ($data['news_category_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_category_to_store SET news_category_id = '" . (int)$news_category_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_category_to_layout WHERE news_category_id = '" . (int)$news_category_id . "'");

		if (isset($data['cat_layout'])) {
			foreach ($data['cat_layout'] as $store_id => $layout) {
				if ($layout['layout_id']) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "news_category_to_layout SET news_category_id = '" . (int)$news_category_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout['layout_id'] . "'");
				}
			}
		}
						
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'news_category_id=" . (int)$news_category_id. "'");
		
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'news_category_id=" . (int)$news_category_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
		
		$this->cache->delete('news_category');
	}
	
	public function deleteNewsCategory($news_category_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_category WHERE news_category_id = '" . (int)$news_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_category_description WHERE news_category_id = '" . (int)$news_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_category_to_store WHERE news_category_id = '" . (int)$news_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_category_to_layout WHERE news_category_id = '" . (int)$news_category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'news_category_id=" . (int)$news_category_id . "'");
		
		$query = $this->db->query("SELECT news_category_id FROM " . DB_PREFIX . "news_category WHERE parent_id = '" . (int)$news_category_id . "'");

		foreach ($query->rows as $result) {
			$this->deleteNewsCategory($result['news_category_id']);
		}
		
		$this->cache->delete('news_category');
	} 

	public function getNewsCategory($news_category_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'news_category_id=" . (int)$news_category_id . "') AS keyword FROM " . DB_PREFIX . "news_category WHERE news_category_id = '" . (int)$news_category_id . "'");
		
		return $query->row;
	} 
	
	public function getNewsCategories($parent_id) {
		$news_category_data = $this->cache->get('news_category.' . $this->config->get('config_language_id') . '.' . $parent_id);
	
		if (!$news_category_data) {
			$news_category_data = array();
		
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_category c LEFT JOIN " . DB_PREFIX . "news_category_description cd ON (c.news_category_id = cd.news_category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY c.sort_order, cd.name ASC");
		
			foreach ($query->rows as $result) {
				$news_category_data[] = array(
					'news_category_id' => $result['news_category_id'],
					'name'        => $this->getPath($result['news_category_id'], $this->config->get('config_language_id')),
					'status'  	  => $result['status'],
					'sort_order'  => $result['sort_order']
				);
			
				$news_category_data = array_merge($news_category_data, $this->getNewsCategories($result['news_category_id']));
			}	
	
			$this->cache->set('news_category.' . $this->config->get('config_language_id') . '.' . $parent_id, $news_category_data);
		}
		
		return $news_category_data;
	}
	
	public function getPath($news_category_id) {
		$query = $this->db->query("SELECT name, parent_id FROM " . DB_PREFIX . "news_category c LEFT JOIN " . DB_PREFIX . "news_category_description cd ON (c.news_category_id = cd.news_category_id) WHERE c.news_category_id = '" . (int)$news_category_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY c.sort_order, cd.name ASC");
		
		$news_category_info = $query->row;
		
		if ($news_category_info['parent_id']) {
			return $this->getPath($news_category_info['parent_id'], $this->config->get('config_language_id')) . $this->language->get('text_separator') . $news_category_info['name'];
		} else {
			return $news_category_info['name'];
		}
	}
	
	public function getNewsCategoryDescriptions($news_category_id) {
		$news_category_description_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_category_description WHERE news_category_id = '" . (int)$news_category_id . "'");
		
		foreach ($query->rows as $result) {
			$news_category_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'meta_keyword'     => $result['meta_keyword'],
				'meta_description' => $result['meta_description'],
				'description'      => $result['description']
			);
		}
		
		return $news_category_description_data;
	}	
	
	public function getNewsCategoryStores($news_category_id) {
		$news_category_store_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_category_to_store WHERE news_category_id = '" . (int)$news_category_id . "'");

		foreach ($query->rows as $result) {
			$news_category_store_data[] = $result['store_id'];
		}
		
		return $news_category_store_data;
	}
	
	public function getNewsCategoryLayouts($news_category_id) {
		$news_category_layout_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_category_to_layout WHERE news_category_id = '" . (int)$news_category_id . "'");
		
		foreach ($query->rows as $result) {
			$news_category_layout_data[$result['store_id']] = $result['layout_id'];
		}
		
		return $news_category_layout_data;
	}

	public function getTotalNewsCategories() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "news_category");
		
		return $query->row['total'];
	}	
		
	public function getTotalNewsCategoriesByImageId($image_id) {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "news_category WHERE image_id = '" . (int)$image_id . "'");
		
		return $query->row['total'];
	}
	
	public function getTotalNewsCategoriesByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "news_category_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}
	
}
?>