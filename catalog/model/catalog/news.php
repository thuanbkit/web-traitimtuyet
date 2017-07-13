<?php
class ModelCatalogNews extends Model {
	public function updateViewed($news_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "news SET viewed = (viewed + 1) WHERE news_id = '" . (int)$news_id . "'");
	}
	
	public function getNew($news_id) {
		if ($this->customer->isLogged()) {
			$customer_group_id = $this->customer->getCustomerGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}	
				
		$query = $this->db->query("SELECT DISTINCT *, nd.name AS name, n.image, (SELECT COUNT(*) AS total FROM " . DB_PREFIX . "news_comment c2 WHERE c2.news_id = n.news_id AND c2.status = '1' GROUP BY c2.news_id) AS total_comments FROM " . DB_PREFIX . "news n LEFT JOIN " . DB_PREFIX . "news_description nd ON (n.news_id = nd.news_id) LEFT JOIN " . DB_PREFIX . "news_to_store n2s ON (n.news_id = n2s.news_id) WHERE n.news_id = '" . (int)$news_id . "' AND nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND n.status = '1' AND n.date_available <= NOW() AND n2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");
		
		if ($query->num_rows) {
			return array(
				'news_id'       => $query->row['news_id'],
				'name'             => $query->row['name'],
				'short_description'      => $query->row['short_description'],
				'description'      => $query->row['description'],
				'meta_description' => $query->row['meta_description'],
				'meta_keyword'     => $query->row['meta_keyword'],				
				'image'            => $query->row['image'],				
				'date_available'   => $query->row['date_available'],				
				'sort_order'       => $query->row['sort_order'],
				'comment'           => $query->row['comment'],
				'approved'           => $query->row['approved'],
				'total_comments'     => $query->row['total_comments'],
				'status'           => $query->row['status'],
				'date_added'       => $query->row['date_added'],
				'date_modified'    => $query->row['date_modified'],
				'viewed'           => $query->row['viewed']
			);
		} else {
			return false;
		}
	}

	public function getNews($data = array()) {
		if ($this->customer->isLogged()) {
			$customer_group_id = $this->customer->getCustomerGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}	
				
		$sql = "SELECT n.news_id FROM " . DB_PREFIX . "news n LEFT JOIN " . DB_PREFIX . "news_description nd ON (n.news_id = nd.news_id) LEFT JOIN " . DB_PREFIX . "news_to_store n2s ON (n.news_id = n2s.news_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND n.status = '1' AND n.date_available <= NOW() AND n2s.store_id = '" . (int)$this->config->get('config_store_id') . "'"; 
		
		if (isset($data['filter_name_news']) && $data['filter_name_news']) {
			if (isset($data['filter_description']) && $data['filter_description']) {
				$sql .= " AND (nd.name LIKE '%" . $this->db->escape($data['filter_name_news']) . "%' OR n.news_id IN (SELECT nt.news_id FROM " . DB_PREFIX . "news_tag nt WHERE nt.language_id = '" . (int)$this->config->get('config_language_id') . "' AND nt.tag LIKE '%" . $this->db->escape($data['filter_name_news']) . "%') OR nd.short_description LIKE '%" . $this->db->escape($data['filter_name_news']) . "%' OR nd.description LIKE '%" . $this->db->escape($data['filter_name_news']) . "%')";
			} else {
				$sql .= " AND (nd.name LIKE '%" . $this->db->escape($data['filter_name_news']) . "%' OR n.news_id IN (SELECT nt.news_id FROM " . DB_PREFIX . "news_tag nt WHERE nt.language_id = '" . (int)$this->config->get('config_language_id') . "' AND nt.tag LIKE '%" . $this->db->escape($data['filter_name_news']) . "%'))";
			}
		}
		
		if (isset($data['filter_tag']) && $data['filter_tag']) {
			$sql .= " AND n.news_id IN (SELECT nt.news_id FROM " . DB_PREFIX . "news_tag nt WHERE nt.language_id = '" . (int)$this->config->get('config_language_id') . "' AND nt.tag LIKE '%" . $this->db->escape($data['filter_tag']) . "%')";
		}
									
		if (isset($data['filter_news_category_id']) && $data['filter_news_category_id']) {
			if (isset($data['filter_sub_news_category']) && $data['filter_sub_news_category']) {
				$implode_data = array();
				
				$this->load->model('catalog/news_category');
				
				$categories = $this->model_catalog_news_category->getCategoriesByParentId($data['filter_news_category_id']);
				
				foreach ($categories as $news_category_id) {
					$implode_data[] = "n2c.news_category_id = '" . (int)$news_category_id . "'";
				}
				
				$sql .= " AND n.news_id IN (SELECT n2c.news_id FROM " . DB_PREFIX . "news_to_category n2c WHERE " . implode(' OR ', $implode_data) . ")";			
			} else {
				$sql .= " AND n.news_id IN (SELECT n2c.news_id FROM " . DB_PREFIX . "news_to_category n2c WHERE n2c.news_category_id = '" . (int)$data['filter_news_category_id'] . "')";
			}
		}
		
		//$sql .= " ORDER BY n.sort_order ASC, n.date_added DESC";
		
		$sort_data = array(
			'nd.name',
			'n.viewed',
			'n.sort_order',
			'n.date_added'
		);	
		
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if ($data['sort'] == 'nd.name') {
				$sql .= " ORDER BY n.sort_order, LCASE(" . $data['sort'] . ")";
			} else {
				$sql .= " ORDER BY n.sort_order, " . $data['sort'];
			}
		} else {
			$sql .= " ORDER BY n.sort_order";	
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
		
		$news_data = array();
				
		$query = $this->db->query($sql);
	
		foreach ($query->rows as $result) {
			$news_data[$result['news_id']] = $this->getNew($result['news_id']);
		}
	
		return $news_data;
	}	
		
	public function getLatestNews($limit) {
		$news_data = $this->cache->get('news.latest.' . $this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $limit);

		if (!$news_data) { 
			$query = $this->db->query("SELECT n.news_id FROM " . DB_PREFIX . "news n LEFT JOIN " . DB_PREFIX . "news_to_store n2s ON (n.news_id = n2s.news_id) WHERE n.status = '1' AND n.date_available <= NOW() AND n2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY n.date_added DESC LIMIT " . (int)$limit);
		 	 
			foreach ($query->rows as $result) {
				$news_data[$result['news_id']] = $this->getNew($result['news_id']);
			}
			
			$this->cache->set('news.latest.' . $this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $limit, $news_data);
		}
		
		return $news_data;
	}
	
	public function getPopularNews($limit) {
		$news_data = array();
		
		$query = $this->db->query("SELECT n.news_id FROM " . DB_PREFIX . "news n LEFT JOIN " . DB_PREFIX . "news_to_store n2s ON (n.news_id = n2s.news_id) WHERE n.status = '1' AND n.date_available <= NOW() AND n2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY n.viewed DESC, n.date_added DESC LIMIT " . (int)$limit);
		
		foreach ($query->rows as $result) { 		
			$news_data[$result['news_id']] = $this->getNew($result['news_id']);
		}
					 	 		
		return $news_data;
	}
	
	public function getNewsRelated($news_id) {
		$news_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_related nr LEFT JOIN " . DB_PREFIX . "news n ON (nr.related_id = n.news_id) LEFT JOIN " . DB_PREFIX . "news_to_store n2s ON (n.news_id = n2s.news_id) WHERE nr.news_id = '" . (int)$news_id . "' AND n.status = '1' AND n.date_available <= NOW() AND n2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY n.sort_order ASC, n.date_added DESC");
		
		foreach ($query->rows as $result) { 
			$news_data[$result['related_id']] = $this->getNew($result['related_id']);
		}
		
		return $news_data;
	}
	
	public function getOtherNews($news_category_id, $news_id, $limit) {
		$news_data = array();
		if(empty($news_category_id)){
			$query = $this->db->query("SELECT n.news_id FROM " . DB_PREFIX . "news n LEFT JOIN " . DB_PREFIX . "news_to_store n2s ON (n.news_id = n2s.news_id) WHERE n.status = '1' AND n.date_available <= NOW() AND n2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND n.news_id != ".$news_id." AND n.news_id < ".$news_id." ORDER BY n.sort_order ASC, n.date_added DESC  LIMIT " . (int)$limit);
		}else{
			$query = $this->db->query("SELECT n.news_id FROM " . DB_PREFIX . "news n LEFT JOIN " . DB_PREFIX . "news_to_store n2s ON (n.news_id = n2s.news_id) LEFT JOIN " . DB_PREFIX . "news_to_category n2c ON (n.news_id = n2c.news_id) WHERE n.status = '1' AND n.date_available <= NOW() AND n2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND n2c.news_category_id = '" . (int)$news_category_id . "' AND n.news_id != ".$news_id." AND n.news_id < ".$news_id." ORDER BY n.sort_order ASC, n.date_added DESC  LIMIT " . (int)$limit);
		}
		
		foreach ($query->rows as $result) {
			$news_data[$result['news_id']] = $this->getNew($result['news_id']);
		}
					 	 		
		return $news_data;
	}
		
	public function getNewsTags($news_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_tag WHERE news_id = '" . (int)$news_id . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->rows;
	}
		
	public function getNewsCategories($news_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_to_category WHERE news_id = '" . (int)$news_id . "'");
		
		return $query->rows;
	}	
		
	public function getTotalNews($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "news n LEFT JOIN " . DB_PREFIX . "news_description nd ON (n.news_id = nd.news_id) LEFT JOIN " . DB_PREFIX . "news_to_store n2s ON (n.news_id = n2s.news_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND n.status = '1' AND n.date_available <= NOW() AND n2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";
		
		if (isset($data['filter_name_news'])) {
			if (isset($data['filter_description']) && $data['filter_description']) {
				$sql .= " AND (nd.name LIKE '%" . $this->db->escape($data['filter_name_news']) . "%' OR n.news_id IN (SELECT nt.news_id FROM " . DB_PREFIX . "news_tag nt WHERE nt.language_id = '" . (int)$this->config->get('config_language_id') . "' AND nt.tag LIKE '%" . $this->db->escape($data['filter_name_news']) . "%') OR nd.short_description LIKE '%" . $this->db->escape(strtolower($data['filter_name_news'])) . "%' OR nd.description LIKE '%" . $this->db->escape(strtolower($data['filter_name_news'])) . "%')";
			} else {
				$sql .= " AND (nd.name LIKE '%" . $this->db->escape($data['filter_name_news']) . "%' OR n.news_id IN (SELECT nt.news_id FROM " . DB_PREFIX . "news_tag nt WHERE nt.language_id = '" . (int)$this->config->get('config_language_id') . "' AND nt.tag LIKE '%" . $this->db->escape($data['filter_name_news']) . "%'))";
			}
		}
		
		if (isset($data['filter_tag']) && $data['filter_tag']) {
			$sql .= " AND n.news_id IN (SELECT nt.news_id FROM " . DB_PREFIX . "news_tag nt WHERE nt.language_id = '" . (int)$this->config->get('config_language_id') . "' AND nt.tag LIKE '%" . $this->db->escape($data['filter_tag']) . "%')";
		}
									
		if (isset($data['filter_news_category_id']) && $data['filter_news_category_id']) {
			if (isset($data['filter_sub_news_category']) && $data['filter_sub_news_category']) {
				$implode_data = array();
				
				$this->load->model('catalog/news_category');
				
				$categories = $this->model_catalog_news_category->getNewsCategoriesByParentId($data['filter_news_category_id']);
				
				foreach ($categories as $news_category_id) {
					$implode_data[] = "n2c.news_category_id = '" . (int)$news_category_id . "'";
				}
				
				$sql .= " AND n.news_id IN (SELECT n2c.news_id FROM " . DB_PREFIX . "news_to_category n2c WHERE " . implode(' OR ', $implode_data) . ")";			
			} else {
				$sql .= " AND n.news_id IN (SELECT n2c.news_id FROM " . DB_PREFIX . "news_to_category n2c WHERE n2c.news_category_id = '" . (int)$data['filter_news_category_id'] . "')";
			}
		}
				
		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}
	
	public function getTotalNewsByCategory($news_category_id) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "news n LEFT JOIN " . DB_PREFIX . "news_description nd ON (n.news_id = nd.news_id) LEFT JOIN " . DB_PREFIX . "news_to_store n2s ON (n.news_id = n2s.news_id)  LEFT JOIN " . DB_PREFIX . "news_to_category nc ON (n.news_id = nc.news_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND nc.news_category_id = '" . (int)$news_category_id . "' AND n.status = '1' AND n.date_available <= NOW() AND n2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";
			
		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}
	
}
?>