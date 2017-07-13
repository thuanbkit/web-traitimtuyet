<?php 
class ControllerCatalogCategory extends Controller { 
	private $error = array();

	public function index() {
		$this->language->load('catalog/category');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/category');

		$this->getList();
	}

	public function insert() {
		$this->language->load('catalog/category');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/category');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_category->addCategory($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

		if (isset($this->request->get['filter_sort'])) {
			$url .= '&filter_sort=' . $this->request->get['filter_sort'];
		}
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}                   
            

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('catalog/category', 'token=' . $this->session->data['token'] . $url, 'SSL')); 
		}

		$this->getForm();
	}

	public function update() {
		$this->language->load('catalog/category');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/category');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_category->editCategory($this->request->get['category_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('catalog/category', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->language->load('catalog/category');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/category');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $category_id) {
				$this->model_catalog_category->deleteCategory($category_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('catalog/category', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	public function repair() {
		$this->language->load('catalog/category');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/category');

		if ($this->validateRepair()) {
			$this->model_catalog_category->repairCategories();

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('catalog/category', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->getList();	
	}


			public function enable() {
				  $this->language->load('catalog/category');
				  
				  $this->document->setTitle($this->language->get('heading_title'));
				  
				  $this->load->model('catalog/category');
				  
				  if (!$this->user->hasPermission('modify', 'catalog/category')) {
					  $this->error['warning'] = $this->language->get('error_permission');
				  } elseif (isset($this->request->post['selected'])) {
					  $enabled_count = 0;
					  
					  foreach ($this->request->post['selected'] as $category_id) {
						  $category_info = $this->model_catalog_category->getCategory($category_id);
						  
						  if ($category_info && !$category_info['status']) {
							  $this->model_catalog_category->enableCategory($category_id);
							  
							  $enabled_count++;
						  }
					  } 
					  
					  $this->session->data['success'] = sprintf($this->language->get('text_category_enabled'), $enabled_count);
			
			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}	
					
					  $this->redirect($this->url->link('catalog/category', 'token=' . $this->session->data['token'] . $url, 'SSL'));			
				  }
				  
				  $this->getList();
			  }

			public function disable() {
				  $this->language->load('catalog/category');
				  
				  $this->document->setTitle($this->language->get('heading_title'));
				  
				  $this->load->model('catalog/category');
				  
				  if (!$this->user->hasPermission('modify', 'catalog/category')) {
					  $this->error['warning'] = $this->language->get('error_permission');
				  } elseif (isset($this->request->post['selected'])) {
					  $disabled_count = 0;
					  
					  foreach ($this->request->post['selected'] as $category_id) {
						  $category_info = $this->model_catalog_category->getCategory($category_id);
						  
						  if ($category_info && $category_info['status']) {
							  $this->model_catalog_category->disableCategory($category_id);
							  
							  $disabled_count++;
						  }
					  } 
					  
					  $this->session->data['success'] = sprintf($this->language->get('text_category_disabled'), $disabled_count);

			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}	
									
					  $this->redirect($this->url->link('catalog/category', 'token=' . $this->session->data['token'] . $url, 'SSL'));			
				  }
				  
				  $this->getList();
			  }
			
	protected function getList() {

    	$this->load->model('catalog/product');
		
		if (isset($this->request->get['filter_sort'])) {
			$filter_sort = $this->request->get['filter_sort'];
		} else {
			$filter_sort = null;
		}
		
		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'c.sort_order, LCASE(cd2.name)';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}                    
            
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/category', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);


			$this->data['enable'] = $this->url->link('catalog/category/enable', 'token=' . $this->session->data['token'] . $url, 'SSL');
			$this->data['disable'] = $this->url->link('catalog/category/disable', 'token=' . $this->session->data['token'] . $url, 'SSL');
			
		$this->data['insert'] = $this->url->link('catalog/category/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('catalog/category/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

    $this->data['csort'] = $this->url->link('catalog/category/sortable', 'token=' . $this->session->data['token'], 'SSL');
	
	$this->data['store'] = HTTP_CATALOG;
    $this->data['stores'] = array();

    $this->load->model('setting/store');

    $results = $this->model_setting_store->getStores();

      foreach ($results as $result) {
        $this->data['stores'][] = array(
        'name' => $result['name'],
        'id' => $result['store_id'],
        'href' => $result['url']);
      }
			
		$this->data['repair'] = $this->url->link('catalog/category/repair', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['categories'] = array();

		$data = array(

			'filter_sort'     => $filter_sort,
			'filter_status'   => $filter_status,
			'sort'  		  => $sort,
			'order'           => $order,                  
            
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);

		$category_total = $this->model_catalog_category->getTotalCategories();

		
		// Admin Enhanced
		$results = $this->model_catalog_category->getCategories($data);		
		// Admin Enhanced
			

		foreach ($results as $result) {
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_eedit'),
				'href' => $this->url->link('catalog/category/update', 'token=' . $this->session->data['token'] . '&category_id=' . $result['category_id'] . $url, 'SSL')
			);

			$this->data['categories'][] = array(

        'href'        => $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&filter_category_id=' . $result['category_id'] . $url, 'SSL'),
        'status'      => $result['status'],
        'total_products_1'   => $this->model_catalog_product->getTotalProducts( array('filter_category_id' => $result['category_id'], 'filter_status' => 1 ) ),             
        'total_products_all' => $this->model_catalog_product->getTotalProducts( array('filter_category_id' => $result['category_id'] ) ),
            
				'category_id' => $result['category_id'],
				'name'        => $result['name'],
				'status2'     => ($result['status'] ? $this->language->get('text_enabled2') : $this->language->get('text_disabled2')),
				'sort_order'  => $result['sort_order'],
				'selected'    => isset($this->request->post['selected']) && in_array($result['category_id'], $this->request->post['selected']),
				'action'      => $action
			);
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_sort_order'] = $this->language->get('column_sort_order');
		$this->data['column_action'] = $this->language->get('column_action');


			$this->data['button_enable'] = $this->language->get('button_enable');
			$this->data['button_disable'] = $this->language->get('button_disable');
			
		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');
		$this->data['button_repair'] = $this->language->get('button_repair');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}


		$url = '';

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		
		if (isset($this->request->get['filter_sort'])) {
			$url .= '&filter_sort=' . $this->request->get['filter_sort'];
		}
		
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$this->data['sort_name'] = $this->url->link('catalog/category', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$this->data['sort_order'] = $this->url->link('catalog/category', 'token=' . $this->session->data['token'] . '&sort=c.sort_order' . $url, 'SSL');
		$this->data['sort_status'] = $this->url->link('catalog/category', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');

		$url = '';
		
		if (isset($this->request->get['filter_sort'])) {
			$url .= '&filter_sort=' . $this->request->get['filter_sort'];
		}
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}                 
            
		$pagination = new Pagination();
		$pagination->total = $category_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('catalog/category', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();

		$this->data['filter_sort'] = $filter_sort;
		$this->data['filter_status'] = $filter_status;

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;
            


			// Admin Enhanced
			$this->data['ecats'] = $this->config->get('config_ecats');
			$this->data['ecats1'] = $this->config->get('config_ecats1');
			$this->data['ecats2'] = $this->config->get('config_ecats2');
			$this->data['ecats4'] = $this->config->get('config_ecats4');
			$this->data['emisc6'] = $this->config->get('config_emisc6');
			$this->data['column_status'] = $this->language->get('column_status');
			$this->data['text_cenabtot'] = $this->language->get('text_cenabtot');
			$this->data['text_cviewprods'] = $this->language->get('text_cviewprods');
			$this->data['text_enabled2'] = $this->language->get('text_enabled2');
			$this->data['text_disabled2'] = $this->language->get('text_disabled2');
			$this->data['text_eedit'] = $this->language->get('text_eedit');
			$this->data['text_eview'] = $this->language->get('text_eview');
			$this->data['text_ordsaved'] = $this->language->get('text_ordsaved');
			$this->data['token'] = $this->session->data['token'];
			// Admin Enhanced
			
		$this->template = 'catalog/category_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	protected function getForm() {
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');
		$this->data['text_browse'] = $this->language->get('text_browse');
		$this->data['text_clear'] = $this->language->get('text_clear');		
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_percent'] = $this->language->get('text_percent');
		$this->data['text_amount'] = $this->language->get('text_amount');

		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_parent'] = $this->language->get('entry_parent');
		$this->data['entry_filter'] = $this->language->get('entry_filter');
		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_keyword'] = $this->language->get('entry_keyword');
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_top'] = $this->language->get('entry_top');
		$this->data['entry_column'] = $this->language->get('entry_column');		
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_layout'] = $this->language->get('entry_layout');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		$this->data['tab_general'] = $this->language->get('tab_general');
		$this->data['tab_data'] = $this->language->get('tab_data');
		$this->data['tab_design'] = $this->language->get('tab_design');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
} 
				if (isset($this->session->data['success'])) {
					$this->data['success'] = $this->session->data['success'];
					unset($this->session->data['success']);
				} else {
					$this->data['success'] = '';
			
		}

		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = array();
		}

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/category', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		if (!isset($this->request->get['category_id'])) {
			$this->data['action'] = $this->url->link('catalog/category/insert', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$this->data['action'] = $this->url->link('catalog/category/update', 'token=' . $this->session->data['token'] . '&category_id=' . $this->request->get['category_id'], 'SSL');
		}

		$this->data['cancel'] = $this->url->link('catalog/category', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->get['category_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$category_info = $this->model_catalog_category->getCategory($this->request->get['category_id']);
		}

		$this->data['token'] = $this->session->data['token'];

		$this->load->model('localisation/language');

		$this->data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['category_description'])) {
			$this->data['category_description'] = $this->request->post['category_description'];
		} elseif (isset($this->request->get['category_id'])) {
			$this->data['category_description'] = $this->model_catalog_category->getCategoryDescriptions($this->request->get['category_id']);
		} else {
			$this->data['category_description'] = array();
		}

		if (isset($this->request->post['path'])) {
			$this->data['path'] = $this->request->post['path'];
		} elseif (!empty($category_info)) {
			$this->data['path'] = $category_info['path'];
		} else {
			$this->data['path'] = '';
		}


				$categories = $this->model_catalog_category->getCategories(0);					
				if (!empty($category_info)) {
					foreach ($categories as $key => $category) {
						if ($category['category_id'] == $category_info['category_id']) {
						unset($categories[$key]);
							}
						}
					}
					
				$this->data['categories'] = $categories;					
			
		if (isset($this->request->post['parent_id'])) {
			$this->data['parent_id'] = $this->request->post['parent_id'];
		} elseif (!empty($category_info)) {
			$this->data['parent_id'] = $category_info['parent_id'];
		} else {
			$this->data['parent_id'] = 0;
		}

		$this->load->model('catalog/filter');

		if (isset($this->request->post['category_filter'])) {
			$filters = $this->request->post['category_filter'];
		} elseif (isset($this->request->get['category_id'])) {		
			$filters = $this->model_catalog_category->getCategoryFilters($this->request->get['category_id']);
		} else {
			$filters = array();
		}

		$this->data['category_filters'] = array();

		foreach ($filters as $filter_id) {
			$filter_info = $this->model_catalog_filter->getFilter($filter_id);

			if ($filter_info) {
				$this->data['category_filters'][] = array(
					'filter_id' => $filter_info['filter_id'],
					'name'      => $filter_info['group'] . ' &gt; ' . $filter_info['name']
				);
			}
		}	

		$this->load->model('setting/store');

		$this->data['stores'] = $this->model_setting_store->getStores();

		if (isset($this->request->post['category_store'])) {
			$this->data['category_store'] = $this->request->post['category_store'];
		} elseif (isset($this->request->get['category_id'])) {
			$this->data['category_store'] = $this->model_catalog_category->getCategoryStores($this->request->get['category_id']);
		} else {
			$this->data['category_store'] = array(0);
		}			

		if (isset($this->request->post['keyword'])) {
			$this->data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($category_info)) {
			$this->data['keyword'] = $category_info['keyword'];
		} else {
			$this->data['keyword'] = '';
		}

		if (isset($this->request->post['image'])) {
			$this->data['image'] = $this->request->post['image'];
		} elseif (!empty($category_info)) {
			$this->data['image'] = $category_info['image'];
		} else {
			$this->data['image'] = '';
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && file_exists(DIR_IMAGE . $this->request->post['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($category_info) && $category_info['image'] && file_exists(DIR_IMAGE . $category_info['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($category_info['image'], 100, 100);
		} else {
			$this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}

		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);

		if (isset($this->request->post['top'])) {
			$this->data['top'] = $this->request->post['top'];
		} elseif (!empty($category_info)) {
			$this->data['top'] = $category_info['top'];
		} else {
			$this->data['top'] = 0;
		}

		if (isset($this->request->post['column'])) {
			$this->data['column'] = $this->request->post['column'];
		} elseif (!empty($category_info)) {
			$this->data['column'] = $category_info['column'];
		} else {
			$this->data['column'] = 1;
		}

		if (isset($this->request->post['sort_order'])) {
			$this->data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($category_info)) {
			$this->data['sort_order'] = $category_info['sort_order'];
		} else {
			$this->data['sort_order'] = 0;
		}

		if (isset($this->request->post['status'])) {
			$this->data['status'] = $this->request->post['status'];
		} elseif (!empty($category_info)) {
			$this->data['status'] = $category_info['status'];
		} else {
			$this->data['status'] = 1;
		}

		if (isset($this->request->post['category_layout'])) {
			$this->data['category_layout'] = $this->request->post['category_layout'];
		} elseif (isset($this->request->get['category_id'])) {
			$this->data['category_layout'] = $this->model_catalog_category->getCategoryLayouts($this->request->get['category_id']);
		} else {
			$this->data['category_layout'] = array();
		}


			// Admin Enhanced
			$this->data['tab_seo'] = $this->language->get('tab_seo');
			$this->data['entry_cparent'] = $this->language->get('entry_cparent');
			$this->data['ecats5'] = $this->config->get('config_ecats5');
			$this->data['ecats7'] = $this->config->get('config_ecats7');
			// Admin Enhanced
			
		$this->load->model('design/layout');

		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		
		// Admin Enhanced
		 if ($this->config->get('config_ecats7') == 1) {
		 $this->template = 'catalog/category_enhanced_form.tpl';
		 } else { 
		$this->template = 'catalog/category_form.tpl';		
		 }
		// Admin Enhanced
			
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/category')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['category_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 2) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/category')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true; 
		} else {
			return false;
		}
	}

	protected function validateRepair() {
		if (!$this->user->hasPermission('modify', 'catalog/category')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true; 
		} else {
			return false;
		}
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/category');

			$data = array(
				'filter_name' => $this->request->get['filter_name'],
				'start'       => 0,
				'limit'       => 20
			);

			$results = $this->model_catalog_category->getCategories($data);

			foreach ($results as $result) {
				$json[] = array(
					'category_id' => $result['category_id'], 
					'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);
			}		
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->setOutput(json_encode($json));
	}		
}
?>