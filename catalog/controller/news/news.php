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

class ControllerNewsNews extends Controller {
	private $error = array(); 
	
	public function index() {
		$this->language->load('news/news');
	
		$this->data['breadcrumbs'] = array();

		/*$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),			
			'separator' => false
		);
		
		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_news'),
			'href'      => $this->url->link('news/all', ''),
			'separator' => $this->language->get('text_separator')
		);*/	
		
		$this->load->model('catalog/news_category');	
		
		if (isset($this->request->get['cat_id'])) {
			$cat_id = '';
				
			foreach (explode('_', $this->request->get['cat_id']) as $cat_id_item) {
				if (!$cat_id) {
					$cat_id = $cat_id_item;
				} else {
					$cat_id .= '_' . $cat_id_item;
				}
				
				$news_category_info = $this->model_catalog_news_category->getNewsCategory($cat_id_item);
				
				if ($news_category_info) {
					$this->data['breadcrumbs'][] = array(
						'text'      => $news_category_info['name'],
						'href'      => $this->url->link('news/news_category', 'cat_id=' . $cat_id),
						//'separator' => $this->language->get('text_separator')
						'separator' => false
					);
				}
			}
		}else{
			$news_category_info = 0;
		}
		//var_dump($news_category_info);
				
		if (isset($this->request->get['filter_name_news']) || isset($this->request->get['filter_tag'])) {
			$url = '';
			
			if (isset($this->request->get['filter_name_news'])) {
				$url .= '&filter_name_news=' . $this->request->get['filter_name_news'];
			}
						
			if (isset($this->request->get['filter_tag'])) {
				$url .= '&filter_tag=' . $this->request->get['filter_tag'];
			}
						
			if (isset($this->request->get['filter_description'])) {
				$url .= '&filter_description=' . $this->request->get['filter_description'];
			}
			
			if (isset($this->request->get['filter_news_category_id'])) {
				$url .= '&filter_news_category_id=' . $this->request->get['filter_news_category_id'];
			}	
						
			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_search'),
				'href'      => $this->url->link('news/search', $url),
				'separator' => $this->language->get('text_separator')
			);	
		}
		
		if (isset($this->request->get['news_id'])) {
			$news_id = $this->request->get['news_id'];
		} else {
			$news_id = 0;
		}
		
		$this->load->model('catalog/news');
		
		$news_info = $this->model_catalog_news->getNew($news_id);
		
		$this->data['news_info'] = $news_info;
		
		if ($news_info) {
			$url = '';
			
			if (isset($this->request->get['cat_id'])) {
				$url .= '&cat_id=' . $this->request->get['cat_id'];
			}
			
			if (isset($this->request->get['filter_name_news'])) {
				$url .= '&filter_name_news=' . $this->request->get['filter_name_news'];
			}
						
			if (isset($this->request->get['filter_tag'])) {
				$url .= '&filter_tag=' . $this->request->get['filter_tag'];
			}
			
			if (isset($this->request->get['filter_description'])) {
				$url .= '&filter_description=' . $this->request->get['filter_description'];
			}	
						
			if (isset($this->request->get['filter_news_category_id'])) {
				$url .= '&filter_news_category_id=' . $this->request->get['filter_news_category_id'];
			}
		/*										
			$this->data['breadcrumbs'][] = array(
				'text'      => $news_info['name'],
				'href'      => $this->url->link('news/news', $url . '&news_id=' . $this->request->get['news_id']),
				'separator' => $this->language->get('text_separator')
			);	*/		
			
			$this->document->setTitle($news_info['name']);
			$this->document->setDescription($news_info['meta_description']);
			$this->document->setKeywords($news_info['meta_keyword']);
			$this->document->addLink($this->url->link('news/news', 'news_id=' . $this->request->get['news_id']), 'canonical');
			
			$this->data['heading_title'] = $news_info['name'];
			
			$this->data['text_select'] = $this->language->get('text_select');			
			$this->data['text_share'] = $this->language->get('text_share');
			$this->data['text_wait'] = $this->language->get('text_wait');
			$this->data['text_tags'] = $this->language->get('text_tags');
			$this->data['text_write'] = $this->language->get('text_write');
			$this->data['text_post_on'] = $this->language->get('text_post_on');
			$this->data['text_viewed'] = $this->language->get('text_viewed');
			
			$this->data['entry_name'] = $this->language->get('entry_name');
			$this->data['entry_email'] = $this->language->get('entry_email');
			$this->data['entry_comment'] = $this->language->get('entry_comment');
			$this->data['entry_rating'] = $this->language->get('entry_rating');
			$this->data['entry_good'] = $this->language->get('entry_good');
			$this->data['entry_bad'] = $this->language->get('entry_bad');
			$this->data['entry_captcha'] = $this->language->get('entry_captcha');
			
			$this->data['button_send'] = $this->language->get('button_send');
			$this->data['button_continue'] = $this->language->get('button_continue');
			$this->data['continue'] = $this->url->link('news/all');
			
			$this->load->model('catalog/news_comment');
			
			$this->data['tab_description'] = $this->language->get('tab_description');
			$this->data['tab_related'] = $this->language->get('tab_related');
			$this->data['tab_others'] = $this->language->get('tab_others');
			$this->data['tab_comment'] = sprintf($this->language->get('tab_comment'), $this->model_catalog_news_comment->getTotalCommentsByNewsId($this->request->get['news_id']));
			
			$this->data['news_id'] = $this->request->get['news_id'];			
			
			$this->load->model('tool/image');

			if ($news_info['image']) {
				$this->data['popup'] = $this->model_tool_image->resize($news_info['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height'));
			} else {
				$this->data['popup'] = '';
			}
			
			if ($news_info['image']) {
				$this->data['thumb'] = $this->model_tool_image->resize($news_info['image'], $this->config->get('config_image_thumb_width'), $this->config->get('config_image_thumb_height'));
			} else {
				$this->data['thumb'] = '';
			}			
			$this->data['date_added'] = date('H:i:s - '.$this->language->get('date_format_short'), strtotime($news_info['date_added']));			
			$this->data['short_description'] = html_entity_decode($news_info['short_description'], ENT_QUOTES, 'UTF-8');
			$this->data['description'] = html_entity_decode($news_info['description'], ENT_QUOTES, 'UTF-8');			
			$this->data['viewed'] = $news_info['viewed'];
			
			$this->data['allow_comment'] = $news_info['comment'];
			$this->data['approved'] = $news_info['approved'];
			$this->data['total_comments'] = sprintf($this->language->get('text_comment'), (int)$news_info['total_comments']);
			$this->data['current_url'] = $this->url->link('news/news', $url . '&news_id=' . $this->request->get['news_id']);
			
			if($this->customer->isLogged()){
				$this->data['customer_name'] = $this->customer->getFirstName().' '.$this->customer->getLastName();
				$this->data['customer_email'] = $this->customer->getEmail();
			}else{
				$this->data['customer_name'] = '';
				$this->data['customer_email'] = '';
			}			
			
			$this->data['news'] = array();
			
			$results = $this->model_catalog_news->getNewsRelated($this->request->get['news_id']);
			
			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_related_width'), $this->config->get('config_image_related_height'));
				} else {
					$image = false;
				}				
							
				$this->data['news'][] = array(
					'news_id' => $result['news_id'],
					'thumb'   	 => $image,
					'name'    	 => $result['name'],
					'date_added'       => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
					'href'    	 => $this->url->link('news/news', $url . '&news_id=' . $result['news_id']),
				);
			}
			
			// other news
			$this->data['other_news'] = array();
			
			$results = $this->model_catalog_news->getOtherNews($news_category_info['news_category_id'], $this->request->get['news_id'], 20);
			
			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_related_width'), $this->config->get('config_image_related_height'));
				} else {
					$image = false;
				}				
							
				$this->data['other_news'][] = array(
					'news_id' => $result['news_id'],
					'thumb'   	 => $image,
					'name'    	 => $result['name'],
					'date_added'       => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
					'href'    	 => $this->url->link('news/news', $url . '&news_id=' . $result['news_id']),
				);
			}	
			
			$this->data['tags'] = array();
					
			$results = $this->model_catalog_news->getNewsTags($this->request->get['news_id']);
			
			foreach ($results as $result) {
				$this->data['tags'][] = array(
					'tag'  => $result['tag'],
					'href' => $this->url->link('news/search', 'filter_tag=' . $result['tag'])
				);
			}
			
			$this->model_catalog_news->updateViewed($this->request->get['news_id']);
			
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/news/news.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/news/news.tpl';
			} else {
				$this->template = 'default/template/news/news.tpl';
			}
			
			$this->children = array(
				'common/column_left',
				'common/column_right',
				'common/content_top',
				'common/content_bottom',
				'common/footer',
				'common/header'
			);
						
			$this->response->setOutput($this->render());
		} else {
			$url = '';
			
			if (isset($this->request->get['cat_id'])) {
				$url .= '&cat_id=' . $this->request->get['cat_id'];
			}
			
			if (isset($this->request->get['manufacturer_id'])) {
				$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
			}			

			if (isset($this->request->get['filter_name_news'])) {
				$url .= '&filter_name_news=' . $this->request->get['filter_name_news'];
			}	
					
			if (isset($this->request->get['filter_tag'])) {
				$url .= '&filter_tag=' . $this->request->get['filter_tag'];
			}
							
			if (isset($this->request->get['filter_description'])) {
				$url .= '&filter_description=' . $this->request->get['filter_description'];
			}
					
			if (isset($this->request->get['filter_news_category_id'])) {
				$url .= '&filter_news_category_id=' . $this->request->get['filter_news_category_id'];
			}
								
      		$this->data['breadcrumbs'][] = array(
        		'text'      => $this->language->get('text_error'),
				'href'      => $this->url->link('news/news', $url . '&news_id=' . $news_id),
        		'separator' => $this->language->get('text_separator')
      		);			
		
      		$this->document->setTitle($this->language->get('text_error'));

      		$this->data['heading_title'] = $this->language->get('text_error');

      		$this->data['text_error'] = $this->language->get('text_error');

      		$this->data['button_continue'] = $this->language->get('button_continue');

      		$this->data['continue'] = $this->url->link('common/home');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/error/not_found.tpl';
			} else {
				$this->template = 'default/template/error/not_found.tpl';
			}
			
			$this->children = array(
				'common/column_left',
				'common/column_right',
				'common/content_top',
				'common/content_bottom',
				'common/footer',
				'common/header'
			);
						
			$this->response->setOutput($this->render());
    	}
  }
  
  public function comment() {
    	$this->language->load('news/news');
		
		$this->load->model('catalog/news_comment');

		$this->data['text_no_comment'] = $this->language->get('text_no_comment');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}  
		
		$this->data['comments'] = array();
		
		$comment_total = $this->model_catalog_news_comment->getTotalCommentsByNewsId($this->request->get['news_id']);
			
		$results = $this->model_catalog_news_comment->getCommentsByNewsId($this->request->get['news_id'], ($page - 1) * 5, 5);
      		
		foreach ($results as $result) {
        	$this->data['comments'][] = array(
        		'author'     => $result['author'],
				'text'       => strip_tags($result['text']),
        		'comments'    => sprintf($this->language->get('text_comment'), (int)$comment_total),
        		'date_added' => date('H:i:s - ' . $this->language->get('date_format_short'), strtotime($result['date_added']))
        	);
      	}			
			
		$pagination = new Pagination();
		$pagination->total = $comment_total;
		$pagination->page = $page;
		$pagination->limit = 5; 
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('news/news/comment', 'news_id=' . $this->request->get['news_id'] . '&page={page}');
			
		$this->data['pagination'] = $pagination->render();
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/news/comment.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/news/comment.tpl';
		} else {
			$this->template = 'default/template/news/comment.tpl';
		}
		
		$this->response->setOutput($this->render());
	}
	
	public function write() {
		$this->language->load('news/news');
		
		$this->load->model('catalog/news_comment');
		
		$json = array();
		$text_success = $this->language->get('text_success');
		
		if ((strlen(utf8_decode($this->request->post['name'])) < 3) || (strlen(utf8_decode($this->request->post['name'])) > 25)) {
			$json['error'] = $this->language->get('error_name');
		}
		
		if ((strlen(utf8_decode($this->request->post['text'])) < 25) || (strlen(utf8_decode($this->request->post['text'])) > 1000)) {
			$json['error'] = $this->language->get('error_text');
		}

		if ((strlen(utf8_decode($this->request->post['email'])) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
      $json['error'] = $this->language->get('error_email');
    }

		if (!isset($this->session->data['captcha']) || ($this->session->data['captcha'] != $this->request->post['captcha'])) {
			$json['error'] = $this->language->get('error_captcha');
		}
		
		if ($this->request->get['approved'] == 1) {
			$status = 0;
			$text_success .= ' '.$this->language->get('text_approved');
		} else {
			$status = 1;
		}
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && !isset($json['error'])) {
			$this->model_catalog_news_comment->addComment($this->request->get['news_id'], $this->request->post, $status);
			
			$json['success'] = $text_success;
		}
		
		$this->load->library('json');
		
		$this->response->setOutput(Json::encode($json));
	}
	
	public function captcha() {
		$this->load->library('captcha');
		
		$captcha = new Captcha();
		
		$this->session->data['captcha'] = $captcha->getCode();
		
		$captcha->showImage();
	}
}
?>