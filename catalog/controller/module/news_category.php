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

class ControllerModuleNewsCategory extends Controller {
	protected function index() {
		$this->language->load('module/news_category');
		
    	$this->data['heading_title'] = $this->language->get('heading_title');
		
		if (isset($this->request->get['cat_id'])) {
			$cat_id = explode('_', (string)$this->request->get['cat_id']);
		} else {
			$cat_id = array();
		}
		
		if (isset($cat_id[0])) {
			$this->data['news_category_id'] = $cat_id[0];
		} else {
			$this->data['news_category_id'] = 0;
		}
		
		if (isset($cat_id[1])) {
			$this->data['child_id'] = $cat_id[1];
		} else {
			$this->data['child_id'] = 0;
		}
							
		$this->load->model('catalog/news_category');
		$this->load->model('catalog/news');
		
		$this->data['categories'] = array();
					
		$categories = $this->model_catalog_news_category->getNewsCategories(0);
		
		foreach ($categories as $category) {
			$children_data = array();
			
			$children = $this->model_catalog_news_category->getNewsCategories($category['news_category_id']);
			
			foreach ($children as $child) {
				$data = array(
					'filter_news_category_id'  => $child['news_category_id'],
					'filter_sub_news_category' => true
				);		
					
				$news_total = $this->model_catalog_news->getTotalNews($data);
							
				$children_data[] = array(
					'news_category_id' => $child['news_category_id'],
					'name'        => $child['name'],
					'href'        => $this->url->link('news/news_category', 'cat_id=' . $category['news_category_id'] . '_' . $child['news_category_id'])	
				);					
			}
			
			$data = array(
				'filter_news_category_id'  => $category['news_category_id'],
				'filter_sub_news_category' => true	
			);		
				
			$news_total = $this->model_catalog_news->getTotalNews($data);
						
			$this->data['categories'][] = array(
				'news_category_id' => $category['news_category_id'],
				'name'        => $category['name'],
				'children'    => $children_data,
				'href'        => $this->url->link('news/news_category', 'cat_id=' . $category['news_category_id'])
			);
		}
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/news_category.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/news_category.tpl';
		} else {
			$this->template = 'default/template/module/news_category.tpl';
		}
		
		$this->render();
  	}
}
?>