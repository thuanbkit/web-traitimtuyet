<?php
/*------------------------------------------------------------------------
# Advanced News Extension - Module for OpenCart 1.5.1.x
# ------------------------------------------------------------------------
# Copyright (C) 2011 OpenCartSoft.com. All Rights Reserved.
# @license - Copyrighted Commercial Software
# Author: www.OpenCartSoft.com
# Websites:  http://www.opencartsoft.com -  Email: admin@opencartsoft.com
# This file may not be redistributed in whole or significant part.
-------------------------------------------------------------------------*/

class ControllerNewsSearch extends Controller {
	public function index() { 
    	$this->language->load('news/search');
		
		$this->load->model('catalog/news_category');
		
		$this->load->model('catalog/news');
		
		$this->load->model('tool/image'); 
		
		if (isset($this->request->get['filter_name_news'])) {
			$filter_name_news = $this->request->get['filter_name_news'];
		} else {
			$filter_name_news = '';
		} 
		
		if (isset($this->request->get['filter_tag'])) {
			$filter_tag = $this->request->get['filter_tag'];
		} else {
			$filter_tag = '';
		} 
				
		if (isset($this->request->get['filter_description'])) {
			$filter_description = $this->request->get['filter_description'];
		} else {
			$filter_description = '';
		} 
				
		if (isset($this->request->get['filter_news_category_id'])) {
			$filter_news_category_id = $this->request->get['filter_news_category_id'];
		} else {
			$filter_news_category_id = 0;
		} 
		
		if (isset($this->request->get['filter_sub_news_category'])) {
			$filter_sub_news_category = $this->request->get['filter_sub_news_category'];
		} else {
			$filter_sub_news_category = '';
		} 
  		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
				
		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = $this->config->get('config_catalog_limit');
		}
		
		if (isset($this->request->get['keyword'])) {
			$this->document->setTitle($this->language->get('heading_title') .  ' - ' . $this->request->get['keyword']);
		} else {
			$this->document->setTitle($this->language->get('heading_title'));
		}

		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array( 
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
      		'separator' => false
   		);
		
		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_news'),
			'href'      => $this->url->link('news/all'),
			'separator' => $this->language->get('text_separator')
		);	
		
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
		
		if (isset($this->request->get['filter_sub_news_category'])) {
			$url .= '&filter_sub_news_category=' . $this->request->get['filter_sub_news_category'];
		}
				
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}	
		
		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}
						
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('news/search', $url),
      		'separator' => $this->language->get('text_separator')
   		);
		
    	$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_empty'] = $this->language->get('text_empty');
    $this->data['text_critea'] = $this->language->get('text_critea');
    $this->data['text_search'] = $this->language->get('text_search');
		$this->data['text_keyword'] = $this->language->get('text_keyword');
		$this->data['text_news_category'] = $this->language->get('text_news_category');
		$this->data['text_sub_news_category'] = $this->language->get('text_sub_news_category');		
		$this->data['text_limit'] = $this->language->get('text_limit');
		$this->data['text_post_on'] = $this->language->get('text_post_on');
			$this->data['text_viewed'] = $this->language->get('text_viewed');
		
		$this->data['entry_search'] = $this->language->get('entry_search');
    $this->data['entry_description'] = $this->language->get('entry_description');
		  
    $this->data['button_search'] = $this->language->get('button_search');	
		
		$this->load->model('catalog/news_category');
		
		// 3 Level Category Search
		$this->data['categories'] = array();
					
		$categories_1 = $this->model_catalog_news_category->getNewsCategories(0);
		
		foreach ($categories_1 as $category_1) {
			$level_2_data = array();
			
			$categories_2 = $this->model_catalog_news_category->getNewsCategories($category_1['news_category_id']);
			
			foreach ($categories_2 as $category_2) {
				$level_3_data = array();
				
				$categories_3 = $this->model_catalog_news_category->getNewsCategories($category_2['news_category_id']);
				
				foreach ($categories_3 as $category_3) {
					$level_3_data[] = array(
						'news_category_id' => $category_3['news_category_id'],
						'name'        => $category_3['name'],
					);
				}
				
				$level_2_data[] = array(
					'news_category_id' => $category_2['news_category_id'],	
					'name'        => $category_2['name'],
					'children'    => $level_3_data
				);					
			}
			
			$this->data['categories'][] = array(
				'news_category_id' => $category_1['news_category_id'],
				'name'        => $category_1['name'],
				'children'    => $level_2_data
			);
		}
		
		$this->data['news'] = array();
		
		if (isset($this->request->get['filter_name_news']) || isset($this->request->get['filter_tag'])) {
			$data = array(
				'filter_name_news'         => $filter_name_news, 
				'filter_tag'          => $filter_tag, 
				'filter_description'  => $filter_description,
				'filter_news_category_id'  => $filter_news_category_id, 
				'filter_sub_news_category' => $filter_sub_news_category, 				
				'start'               => ($page - 1) * $limit,
				'limit'               => $limit
			);
					
			$news_total = $this->model_catalog_news->getTotalNews($data);
								
			$results = $this->model_catalog_news->getNews($data);
					
			foreach ($results as $result) {				
				$width = ''; $height = '';
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				} else {
					$firstImgNews = $this->catchFirstImage(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'));
					if($firstImgNews == 'no_image.jpg'){
						$image = $this->model_tool_image->resize('no_image.jpg', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
					}else{
						$image = $firstImgNews; $width = 'width="'.$this->config->get('config_image_product_width').'"'; $height = 'height="'.$this->config->get('config_image_product_height').'"';
					}					
				}
				
				if (empty($result['short_description'])) {
					$short_description = substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 500).' ...';
				}else{
					$short_description = $result['short_description'];
				}
			
				$this->data['news'][] = array(
					'news_id'  => $result['news_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'short_description'       => $short_description,
					'date_added'       => date('H:i:s - '.$this->language->get('date_format_short'), strtotime($result['date_added'])),					
					'width'      => $width, 
					'height'      => $height, 					
					'viewed'      => $result['viewed'], 
					'href'        => $this->url->link('news/news', $url . '&news_id=' . $result['news_id'])
				);
			}
					
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
			
			if (isset($this->request->get['filter_sub_news_category'])) {
				$url .= '&filter_sub_news_category=' . $this->request->get['filter_sub_news_category'];
			}
					
			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}			
	
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
			
			if (isset($this->request->get['filter_sub_news_category'])) {
				$url .= '&filter_sub_news_category=' . $this->request->get['filter_sub_news_category'];
			}			
			
			$this->data['limits'] = array();
			
			$this->data['limits'][] = array(
				'text'  => $this->config->get('config_catalog_limit'),
				'value' => $this->config->get('config_catalog_limit'),
				'href'  => $this->url->link('news/search', $url . '&limit=' . $this->config->get('config_catalog_limit'))
			);
						
			$this->data['limits'][] = array(
				'text'  => 25,
				'value' => 25,
				'href'  => $this->url->link('news/search', $url . '&limit=25')
			);
			
			$this->data['limits'][] = array(
				'text'  => 50,
				'value' => 50,
				'href'  => $this->url->link('news/search', $url . '&limit=50')
			);
	
			$this->data['limits'][] = array(
				'text'  => 75,
				'value' => 75,
				'href'  => $this->url->link('news/search', $url . '&limit=75')
			);
			
			$this->data['limits'][] = array(
				'text'  => 100,
				'value' => 100,
				'href'  => $this->url->link('news/search', $url . '&limit=100')
			);
					
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
			
			if (isset($this->request->get['filter_sub_news_category'])) {
				$url .= '&filter_sub_news_category=' . $this->request->get['filter_sub_news_category'];
			}
			
			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
					
			$pagination = new Pagination();
			$pagination->total = $news_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->text = $this->language->get('text_pagination');
			$pagination->url = $this->url->link('news/search', $url . '&page={page}');
			
			$this->data['pagination'] = $pagination->render();
		}	
		
		$this->data['filter_name_news'] = $filter_name_news;
		$this->data['filter_description'] = $filter_description;
		$this->data['filter_news_category_id'] = $filter_news_category_id;
		$this->data['filter_sub_news_category'] = $filter_sub_news_category;
				
		$this->data['limit'] = $limit;
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/news/search.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/news/search.tpl';
		} else {
			$this->template = 'default/template/news/search.tpl';
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
  
  function catchFirstImage($content) {
	  $first_img = ''; 
	  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
	  if(isset($matches[1][0])){
	  	$first_img = $matches[1][0];
		}
	  if(empty($first_img)){ //Defines a default image
	    $first_img = "no_image.jpg";
	  }
	  return $first_img;
	} //end function
}
?>