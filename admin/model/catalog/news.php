<?php
class ModelCatalogNews extends Model {
	public function addNews($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "news SET date_available = '" . $this->db->escape($data['date_available']) . "', comment = '" . (int)$data['comment'] . "', approved = '" . (int)$data['approved'] . "', status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['sort_order'] . "', date_added = NOW()");
		
		$news_id = $this->db->getLastId();
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "news SET image = '" . $this->db->escape($data['image']) . "' WHERE news_id = '" . (int)$news_id . "'");
		}
		
		foreach ($data['news_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "news_description SET news_id = '" . (int)$news_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', short_description = '" . $this->db->escape($value['short_description']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}
		
		if (isset($data['news_store'])) {
			foreach ($data['news_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_to_store SET news_id = '" . (int)$news_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
		
		if (isset($data['news_category'])) {
			foreach ($data['news_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_to_category SET news_id = '" . (int)$news_id . "', news_category_id = '" . (int)$category_id . "'");
			}
		}
		
		if (isset($data['news_related'])) {
			foreach ($data['news_related'] as $related_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "news_related WHERE news_id = '" . (int)$news_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_related SET news_id = '" . (int)$news_id . "', related_id = '" . (int)$related_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "news_related WHERE news_id = '" . (int)$related_id . "' AND related_id = '" . (int)$news_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_related SET news_id = '" . (int)$related_id . "', related_id = '" . (int)$news_id . "'");
			}
		}
	
		foreach ($data['news_tag'] as $language_id => $value) {
			if ($value) {
				$tags = explode(',', $value);
				
				foreach ($tags as $tag) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "news_tag SET news_id = '" . (int)$news_id . "', language_id = '" . (int)$language_id . "', tag = '" . $this->db->escape(trim($tag)) . "'");
				}
			}
		}
		
		if (isset($data['news_layout'])) {
			foreach ($data['news_layout'] as $store_id => $layout) {
				if ($layout['layout_id']) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "news_to_layout SET news_id = '" . (int)$news_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout['layout_id'] . "'");
				}
			}
		}
						
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'news_id=" . (int)$news_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
						
		$this->cache->delete('news');
	}
	
	public function editNews($news_id, $data) {

		$this->db->query("UPDATE " . DB_PREFIX . "news SET date_available = '" . $this->db->escape($data['date_available']) . "', comment = '" . (int)$data['comment'] . "', approved = '" . (int)$data['approved'] . "', status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['sort_order'] . "', date_modified = NOW() WHERE news_id = '" . (int)$news_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "news SET image = '" . $this->db->escape($data['image']) . "' WHERE news_id = '" . (int)$news_id . "'");
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_description WHERE news_id = '" . (int)$news_id . "'");
		
		foreach ($data['news_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "news_description SET news_id = '" . (int)$news_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', short_description = '" . $this->db->escape($value['short_description']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "news_to_store WHERE news_id = '" . (int)$news_id . "'");

		if (isset($data['news_store'])) {
			foreach ($data['news_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_to_store SET news_id = '" . (int)$news_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_to_category WHERE news_id = '" . (int)$news_id . "'");
		
		if (isset($data['news_category'])) {
			foreach ($data['news_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_to_category SET news_id = '" . (int)$news_id . "', news_category_id = '" . (int)$category_id . "'");
			}		
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "news_related WHERE news_id = '" . (int)$news_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_related WHERE related_id = '" . (int)$news_id . "'");

		if (isset($data['news_related'])) {
			foreach ($data['news_related'] as $related_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "news_related WHERE news_id = '" . (int)$news_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_related SET news_id = '" . (int)$news_id . "', related_id = '" . (int)$related_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "news_related WHERE news_id = '" . (int)$related_id . "' AND related_id = '" . (int)$news_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_related SET news_id = '" . (int)$related_id . "', related_id = '" . (int)$news_id . "'");
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_tag WHERE news_id = '" . (int)$news_id. "'");
		
		foreach ($data['news_tag'] as $language_id => $value) {
			if ($value) {
				$tags = explode(',', $value);
			
				foreach ($tags as $tag) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "news_tag SET news_id = '" . (int)$news_id . "', language_id = '" . (int)$language_id . "', tag = '" . $this->db->escape(trim($tag)) . "'");
				}
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_to_layout WHERE news_id = '" . (int)$news_id . "'");

		if (isset($data['news_layout'])) {
			foreach ($data['news_layout'] as $store_id => $layout) {
				if ($layout['layout_id']) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "news_to_layout SET news_id = '" . (int)$news_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout['layout_id'] . "'");
				}
			}
		}
						
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'news_id=" . (int)$news_id. "'");
		
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'news_id=" . (int)$news_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
						
		$this->cache->delete('news');
	}
	
	public function copyNews($news_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "news n LEFT JOIN " . DB_PREFIX . "news_description nd ON (n.news_id = nd.news_id) WHERE n.news_id = '" . (int)$news_id . "' AND nd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
		if ($query->num_rows) {
			$data = array();
			
			$data = $query->row;
			
			$data['keyword'] = '';

			$data['status'] = '0';
			
			$data = array_merge($data, array('news_description' => $this->getNewsDescriptions($news_id)));
			$data = array_merge($data, array('news_related' => $this->getNewsRelated($news_id)));
			$data = array_merge($data, array('news_tag' => $this->getNewsTags($news_id)));
			$data = array_merge($data, array('news_category' => $this->getNewsCategories($news_id)));
			$data = array_merge($data, array('news_layout' => $this->getNewsLayouts($news_id)));
			$data = array_merge($data, array('news_store' => $this->getNewsStores($news_id)));
			
			$this->addNews($data);
		}
	}
	
	public function deleteNews($news_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "news WHERE news_id = '" . (int)$news_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_description WHERE news_id = '" . (int)$news_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_related WHERE news_id = '" . (int)$news_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_related WHERE related_id = '" . (int)$news_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_tag WHERE news_id='" . (int)$news_id. "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_to_category WHERE news_id = '" . (int)$news_id . "'");	
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_to_layout WHERE news_id = '" . (int)$news_id . "'");	
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_to_store WHERE news_id = '" . (int)$news_id . "'");		
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_comment WHERE news_id = '" . (int)$news_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'news_id=" . (int)$news_id. "'");
		
		$this->cache->delete('news');
	}
	
	public function getNew($news_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'news_id=" . (int)$news_id . "') AS keyword FROM " . DB_PREFIX . "news n LEFT JOIN " . DB_PREFIX . "news_description nd ON (n.news_id = nd.news_id) WHERE n.news_id = '" . (int)$news_id . "' AND nd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
				
		return $query->row;
	}
	
	public function getNews($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "news n LEFT JOIN " . DB_PREFIX . "news_description nd ON (n.news_id = nd.news_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "'"; 
		
			if (isset($data['filter_name']) && !is_null($data['filter_name'])) {
				$sql .= " AND LCASE(nd.name) LIKE '" . $this->db->escape($data['filter_name']) . "%'";
			}
			
			if (isset($data['filter_short_description']) && !is_null($data['filter_short_description'])) {
				$sql .= " AND nd.short_description LIKE '%" . $this->db->escape($data['filter_short_description']) . "%'";
			}
			
			if (isset($data['filter_comment']) && !is_null($data['filter_comment'])) {
				$sql .= " AND n.comment = '" . (int)$data['filter_comment'] . "'";
			}
			
			if (isset($data['filter_approved']) && !is_null($data['filter_approved'])) {
				$sql .= " AND n.approved = '" . (int)$data['filter_approved'] . "'";
			}
			
			if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
				$sql .= " AND n.status = '" . (int)$data['filter_status'] . "'";
			}

			$sort_data = array(
				'n.date_added', 
				'nd.name',	
				'n.comment',
				'n.approved',			
				'n.status',
				'n.sort_order'
			);	
			
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];	
			} else {
				$sql .= " ORDER BY n.date_added";	
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
		} else {
			$news_data = $this->cache->get('news.' . $this->config->get('config_language_id'));
		
			if (!$news_data) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news n LEFT JOIN " . DB_PREFIX . "news_description nd ON (n.news_id = nd.news_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY nd.name ASC");
	
				$news_data = $query->rows;
			
				$this->cache->set('news.' . $this->config->get('config_language_id'), $news_data);
			}	
	
			return $news_data;
		}
	}
	
	public function getNewsByCategoryId($category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news n LEFT JOIN " . DB_PREFIX . "news_description nd ON (n.news_id = nd.news_id) LEFT JOIN " . DB_PREFIX . "news_to_category n2c ON (n.news_id = n2c.news_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND n2c.category_id = '" . (int)$category_id . "' ORDER BY nd.name ASC");
								  
		return $query->rows;
	} 
	
	public function getNewsDescriptions($news_id) {
		$news_description_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_description WHERE news_id = '" . (int)$news_id . "'");
		
		foreach ($query->rows as $result) {
			$news_description_data[$result['language_id']] = array(
				'name'             				=> $result['name'],
				'short_description'      	=> $result['short_description'],
				'description'      				=> $result['description'],
				'meta_keyword'     				=> $result['meta_keyword'],
				'meta_description' 				=> $result['meta_description']
			);
		}
		
		return $news_description_data;
	}
	
	public function getNewsStores($news_id) {
		$news_store_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_to_store WHERE news_id = '" . (int)$news_id . "'");

		foreach ($query->rows as $result) {
			$news_store_data[] = $result['store_id'];
		}
		
		return $news_store_data;
	}
	
	public function getNewsLayouts($news_id) {
		$news_layout_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_to_layout WHERE news_id = '" . (int)$news_id . "'");
		
		foreach ($query->rows as $result) {
			$news_layout_data[$result['store_id']] = $result['layout_id'];
		}
		
		return $news_layout_data;
	}

	public function getNewsCategories($news_id) {
		$news_category_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_to_category WHERE news_id = '" . (int)$news_id . "'");
		
		foreach ($query->rows as $result) {
			$news_category_data[] = $result['news_category_id'];
		}

		return $news_category_data;
	}

	public function getNewsRelated($news_id) {
		$news_related_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_related WHERE news_id = '" . (int)$news_id . "'");
		
		foreach ($query->rows as $result) {
			$news_related_data[] = $result['related_id'];
		}
		
		return $news_related_data;
	}
	
	public function getNewsTags($news_id) {
		$news_tag_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_tag WHERE news_id = '" . (int)$news_id . "'");
		
		$tag_data = array();
		
		foreach ($query->rows as $result) {
			$tag_data[$result['language_id']][] = $result['tag'];
		}
		
		foreach ($tag_data as $language => $tags) {
			$news_tag_data[$language] = implode(',', $tags);
		}
		
		return $news_tag_data;
	}
		
	public function getTotalNews($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "news n LEFT JOIN " . DB_PREFIX . "news_description nd ON (n.news_id = nd.news_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		
		if (isset($data['filter_name']) && !is_null($data['filter_name'])) {
			$sql .= " AND nd.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (isset($data['filter_short_description']) && !is_null($data['filter_short_description'])) {
				$sql .= " AND nd.short_description LIKE '%" . $this->db->escape($data['filter_short_description']) . "%'";
			}
		
		if (isset($data['filter_comment']) && !is_null($data['filter_comment'])) {
			$sql .= " AND n.comment = '" . (int)$data['filter_comment'] . "'";
		}
		
		if (isset($data['filter_approved']) && !is_null($data['filter_approved'])) {
			$sql .= " AND n.approved = '" . (int)$data['filter_approved'] . "'";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND n.status = '" . (int)$data['filter_status'] . "'";
		}

		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}

	public function getTotalnewssByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "news_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}
	
}
?>