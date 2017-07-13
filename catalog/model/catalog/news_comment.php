<?php
class ModelCatalogNewsComment extends Model {		
	public function addComment($news_id, $data, $status = 0) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "news_comment SET author = '" . $this->db->escape($data['name']) . "', email = '" . $this->db->escape($data['email']) . "', customer_id = '" . (int)$this->customer->getId() . "', news_id = '" . (int)$news_id . "', text = '" . $this->db->escape(strip_tags($data['text'])) . "', status = '" . $status . "', date_added = NOW()");
	}
		
	public function getCommentsByNewsId($news_id, $start = 0, $limit = 20) {
		$query = $this->db->query("SELECT c.comment_id, c.author, c.text, n.news_id, nd.name, n.image, c.date_added FROM " . DB_PREFIX . "news_comment c LEFT JOIN " . DB_PREFIX . "news n ON (c.news_id = n.news_id) LEFT JOIN " . DB_PREFIX . "news_description nd ON (n.news_id = nd.news_id) WHERE n.news_id = '" . (int)$news_id . "' AND n.date_available <= NOW() AND n.status = '1' AND c.status = '1' AND nd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY c.date_added DESC LIMIT " . (int)$start . "," . (int)$limit);
		
		return $query->rows;
	}	
	
	public function getTotalComments() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "news_comment c LEFT JOIN " . DB_PREFIX . "news n ON (c.news_id = n.news_id) WHERE n.date_available <= NOW() AND n.status = '1' AND c.status = '1'");
		
		return $query->row['total'];
	}

	public function getTotalCommentsByNewsId($news_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "news_comment c LEFT JOIN " . DB_PREFIX . "news n ON (c.news_id = n.news_id) LEFT JOIN " . DB_PREFIX . "news_description nd ON (n.news_id = nd.news_id) WHERE n.news_id = '" . (int)$news_id . "' AND n.date_available <= NOW() AND n.status = '1' AND c.status = '1' AND nd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
		return $query->row['total'];
	}
}
?>