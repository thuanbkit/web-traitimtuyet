<?php
/*------------------------------------------------------------------------
# Advanced News System for OpenCart 1.5.x
# ------------------------------------------------------------------------
# Copyright (C) 2011 OpenCartSoft.com. All Rights Reserved.
# @license - Copyrighted Commercial Software
# Author: www.OpenCartSoft.com
# Websites:  http://www.opencartsoft.com -  Email: admin@opencartsoft.com
# This file may not be redistributed in whole or significant part.
-------------------------------------------------------------------------*/

class ModelCatalogNewsComment extends Model {
	public function addComment($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "news_comment SET author = '" . $this->db->escape($data['author']) . "', email = '" . $this->db->escape($data['email']) . "', news_id = '" . $this->db->escape($data['news_id']) . "', text = '" . $this->db->escape(strip_tags($data['text'])) . "', status = '" . (int)$data['status'] . "', date_added = NOW()");
	}
	
	public function editComment($comment_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "news_comment SET author = '" . $this->db->escape($data['author']) . "', email = '" . $this->db->escape($data['email']) . "', news_id = '" . $this->db->escape($data['news_id']) . "', text = '" . $this->db->escape(strip_tags($data['text'])) . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE comment_id = '" . (int)$comment_id . "'");
	}
	
	public function deleteComment($comment_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_comment WHERE comment_id = '" . (int)$comment_id . "'");
	}
	
	public function getComment($comment_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT nd.name FROM " . DB_PREFIX . "news_description nd WHERE nd.news_id = c.news_id AND nd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS news FROM " . DB_PREFIX . "news_comment c WHERE c.comment_id = '" . (int)$comment_id . "'");
		
		return $query->row;
	}

	public function getComments($data = array()) {
		$sql = "SELECT c.comment_id, nd.name, c.author, c.email, c.status, c.date_added FROM " . DB_PREFIX . "news_comment c LEFT JOIN " . DB_PREFIX . "news_description nd ON (c.news_id = nd.news_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "'";																																					  
		
		$sort_data = array(
			'nd.name',
			'c.author',
			'c.email',
			'c.status',
			'c.date_added'
		);	
			
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY c.date_added";	
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
	
	public function getTotalComments() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "news_comment");
		
		return $query->row['total'];
	}
	
	public function getTotalCommentsAwaitingApproval() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "news_comment WHERE status = '0'");
		
		return $query->row['total'];
	}	
}
?>