<?php
class ControllerCatalogNews extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->load->language('catalog/news');
    	
		$this->document->setTitle($this->language->get('heading_title')); 
		
		$this->load->model('catalog/news');
		
		$this->getList();
  	}
  
  	public function insert() {
    	$this->load->language('catalog/news');

    	$this->document->setTitle($this->language->get('heading_title')); 
		
		$this->load->model('catalog/news');
		
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_news->addNews($this->request->post);
	  		
			$this->session->data['success'] = $this->language->get('text_success');
	  
			$url = '';
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . $this->request->get['filter_name'];
			}
			
			if (isset($this->request->get['filter_short_description'])) {
				$url .= '&filter_short_description=' . $this->request->get['filter_short_description'];
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
			
			$this->redirect($this->url->link('catalog/news', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}
	
    	$this->getForm();
  	}

  	public function update() {
    	$this->load->language('catalog/news');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/news');
	
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_news->editNews($this->request->get['news_id'], $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . $this->request->get['filter_name'];
			}
			
			if (isset($this->request->get['filter_short_description'])) {
				$url .= '&filter_short_description=' . $this->request->get['filter_short_description'];
			}		
		
			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . $this->request->get['filter_model'];
			}
			
			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}
			
			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
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
			
			$this->redirect($this->url->link('catalog/news', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getForm();
  	}

  	public function delete() {
    	$this->load->language('catalog/news');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/news');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $news_id) {
				$this->model_catalog_news->deleteNews($news_id);
	  		}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . $this->request->get['filter_name'];
			}
			
			if (isset($this->request->get['filter_short_description'])) {
				$url .= '&filter_short_description=' . $this->request->get['filter_short_description'];
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
			
			$this->redirect($this->url->link('catalog/news', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getList();
  	}

  	public function copy() {
    	$this->load->language('catalog/news');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/news');
		
		if (isset($this->request->post['selected']) && $this->validateCopy()) {
			foreach ($this->request->post['selected'] as $news_id) {
				$this->model_catalog_news->copyNews($news_id);
	  		}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . $this->request->get['filter_name'];
			}
			
			if (isset($this->request->get['filter_short_description'])) {
				$url .= '&filter_short_description=' . $this->request->get['filter_short_description'];
			}		
		
			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . $this->request->get['filter_model'];
			}
			
			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}
			
			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
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
			
			$this->redirect($this->url->link('catalog/news', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getList();
  	}
	
  	private function getList() {
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}
		
		if (isset($this->request->get['filter_short_description'])) {
			$filter_short_description = $this->request->get['filter_short_description'];
		} else {
			$filter_short_description = null;
		}
		
		if (isset($this->request->get['filter_comment'])) {
			$filter_comment = $this->request->get['filter_comment'];
		} else {
			$filter_comment = null;
		}
		
		if (isset($this->request->get['filter_approved'])) {
			$filter_approved = $this->request->get['filter_approved'];
		} else {
			$filter_approved = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'nd.date_added';
		}
		
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
						
		$url = '';
						
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}
		
		if (isset($this->request->get['filter_short_description'])) {
			$url .= '&filter_short_description=' . $this->request->get['filter_short_description'];
		}
		
		if (isset($this->request->get['filter_comment'])) {
			$url .= '&filter_comment=' . $this->request->get['filter_comment'];
		}
		
		if (isset($this->request->get['filter_approved'])) {
			$url .= '&filter_approved=' . $this->request->get['filter_approved'];
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

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/news', 'token=' . $this->session->data['token'] . $url, 'SSL'),       		
      		'separator' => ' :: '
   		);
		//$this->data['comment'] = $this->url->link('catalog/news/comment', 'token=' . $this->session->data['token'] . $url, 'SSL');
		//$this->data['approve'] = $this->url->link('catalog/news/approve', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['insert'] = $this->url->link('catalog/news/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['copy'] = $this->url->link('catalog/news/copy', 'token=' . $this->session->data['token'] . $url, 'SSL');	
		$this->data['delete'] = $this->url->link('catalog/news/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
    	
		$this->data['news'] = array();

		$data = array(
			'filter_name'	  => $filter_name, 			
			'filter_short_description'	  => $filter_short_description, 
			'filter_comment'   => $filter_comment, 
			'filter_approved'   => $filter_approved, 
			'filter_status'   => $filter_status,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'           => $this->config->get('config_admin_limit')
		);
		
		$this->load->model('tool/image');
		
		$news_total = $this->model_catalog_news->getTotalNews($data);
			
		$results = $this->model_catalog_news->getNews($data);
				    	
		foreach ($results as $result) {
			$action = array();
			$width = '';
			$height = '';
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/news/update', 'token=' . $this->session->data['token'] . '&news_id=' . $result['news_id'] . $url, 'SSL')
			);
			
			if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$firstImgNews = $this->catchFirstImage(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'));
				if($firstImgNews == 'no_image.jpg'){
					$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
				}else{
					$image = $firstImgNews; $width = 'width="40"'; $height = 'height="40"';
				}
				//$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
			
			if (empty($result['short_description'])) {
				$short_description = substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 500).' ...';
			}else{
				$short_description = $result['short_description'];
			}
	
      	$this->data['news'][] = array(
				'news_id' => $result['news_id'],
				'name'       => $result['name'], 
				'name_url'       => $this->url->link('catalog/news/update', 'token=' . $this->session->data['token'] . '&news_id=' . $result['news_id'] . $url, 'SSL'), 
				'short_description'       => $short_description,
				'viewed'       => $result['viewed'],
				'date_added'       => date('H:i:s - '.$this->language->get('date_format_short'), strtotime($result['date_added'])),
				'image'      => $image, 
				'width'      => $width, 
				'height'      => $height,
				'comment'     => ($result['comment'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'approved'     => ($result['approved'] ? $this->language->get('text_yes') : $this->language->get('text_no')),
				'status'     => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'selected'   => isset($this->request->post['selected']) && in_array($result['news_id'], $this->request->post['selected']),
				'action'     => $action
			);
    	}
		
		$this->data['heading_title'] = $this->language->get('heading_title');		
				
		$this->data['text_enabled'] = $this->language->get('text_enabled');		
		$this->data['text_disabled'] = $this->language->get('text_disabled');		
		$this->data['text_no_results'] = $this->language->get('text_no_results');		
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');		
			
		$this->data['column_name'] = $this->language->get('column_name');		
		$this->data['column_short_description'] = $this->language->get('column_short_description');		
		$this->data['column_date_added'] = $this->language->get('column_date_added');		
		$this->data['column_image'] = $this->language->get('column_image');		
		$this->data['column_viewed'] = $this->language->get('column_viewed');				
		$this->data['column_comment'] = $this->language->get('column_comment');		
		$this->data['column_approved'] = $this->language->get('column_approved');	
		$this->data['column_status'] = $this->language->get('column_status');		
		$this->data['column_action'] = $this->language->get('column_action');		
				
		$this->data['button_copy'] = $this->language->get('button_copy');		
		$this->data['button_insert'] = $this->language->get('button_insert');		
		$this->data['button_delete'] = $this->language->get('button_delete');		
		$this->data['button_filter'] = $this->language->get('button_filter');
		 
 		$this->data['token'] = $this->session->data['token'];
		
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

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}
		
		if (isset($this->request->get['filter_short_description'])) {
			$url .= '&filter_short_description=' . $this->request->get['filter_short_description'];
		}
		
		if (isset($this->request->get['filter_comment'])) {
			$url .= '&filter_comment=' . $this->request->get['filter_comment'];
		}
		
		if (isset($this->request->get['filter_approved'])) {
			$url .= '&filter_approved=' . $this->request->get['filter_approved'];
		}	
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
								
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
					
		$this->data['sort_name'] = $this->url->link('catalog/news', 'token=' . $this->session->data['token'] . '&sort=nd.name' . $url, 'SSL');		
		$this->data['sort_comment'] = $this->url->link('catalog/news', 'token=' . $this->session->data['token'] . '&sort=n.comment' . $url, 'SSL');
		$this->data['sort_approved'] = $this->url->link('catalog/news', 'token=' . $this->session->data['token'] . '&sort=n.approved' . $url, 'SSL');
		$this->data['sort_status'] = $this->url->link('catalog/news', 'token=' . $this->session->data['token'] . '&sort=n.status' . $url, 'SSL');
		$this->data['sort_order'] = $this->url->link('catalog/news', 'token=' . $this->session->data['token'] . '&sort=n.sort_order' . $url, 'SSL');
		
		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}		
		
		if (isset($this->request->get['filter_short_description'])) {
			$url .= '&filter_short_description=' . $this->request->get['filter_short_description'];
		}
		
		if (isset($this->request->get['filter_comment'])) {
			$url .= '&filter_comment=' . $this->request->get['filter_comment'];
		}
		
		if (isset($this->request->get['filter_approved'])) {
			$url .= '&filter_approved=' . $this->request->get['filter_approved'];
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
		$pagination->total = $news_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('catalog/news', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();
	
		$this->data['filter_name'] = $filter_name;		
		$this->data['filter_short_description'] = $filter_short_description;		
		$this->data['filter_comment'] = $filter_comment;
		$this->data['filter_approved'] = $filter_approved;
		$this->data['filter_status'] = $filter_status;
		
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;
		
		$this->template = 'catalog/news_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
				
		$this->response->setOutput($this->render());
  	}

  	private function getForm() {
    	$this->data['heading_title'] = $this->language->get('heading_title');
 
    	$this->data['text_enabled'] = $this->language->get('text_enabled');
    	$this->data['text_disabled'] = $this->language->get('text_disabled');
    	$this->data['text_none'] = $this->language->get('text_none');
    	$this->data['text_yes'] = $this->language->get('text_yes');
    	$this->data['text_no'] = $this->language->get('text_no');		
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');	
		$this->data['text_browse'] = $this->language->get('text_browse');
		$this->data['text_clear'] = $this->language->get('text_clear');
		$this->data['text_select'] = $this->language->get('text_select');
		$this->data['text_none'] = $this->language->get('text_none');	

		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$this->data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_keyword'] = $this->language->get('entry_keyword');    	
    	$this->data['entry_date_available'] = $this->language->get('entry_date_available');    	
    	$this->data['entry_image'] = $this->language->get('entry_image');    	
    	$this->data['entry_category'] = $this->language->get('entry_category');
		$this->data['entry_related'] = $this->language->get('entry_related');		
		$this->data['entry_text'] = $this->language->get('entry_text');		
		$this->data['entry_required'] = $this->language->get('entry_required');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_comment'] = $this->language->get('entry_comment');		
		$this->data['entry_approved'] = $this->language->get('entry_approved');		
		$this->data['entry_status'] = $this->language->get('entry_status');		
		$this->data['entry_tag'] = $this->language->get('entry_tag');
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		
		$this->data['entry_short_description'] = $this->language->get('entry_short_description');
				
    	$this->data['button_save'] = $this->language->get('button_save');
    	$this->data['button_cancel'] = $this->language->get('button_cancel');		
		
    	$this->data['tab_general'] = $this->language->get('tab_general');
    	$this->data['tab_data'] = $this->language->get('tab_data');		
		$this->data['tab_links'] = $this->language->get('tab_links');		
		$this->data['tab_design'] = $this->language->get('tab_design');
		 
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = array();
		}

 		if (isset($this->error['meta_description'])) {
			$this->data['error_meta_description'] = $this->error['meta_description'];
		} else {
			$this->data['error_meta_description'] = array();
		}	
			
		if (isset($this->error['short_description'])) {
			$this->data['error_short_description'] = $this->error['short_description'];
		} else {
			$this->data['error_short_description'] = array();
		}	
   
   		if (isset($this->error['description'])) {
			$this->data['error_description'] = $this->error['description'];
		} else {
			$this->data['error_description'] = array();
		}	
		
   		
		if (isset($this->error['date_available'])) {
			$this->data['error_date_available'] = $this->error['date_available'];
		} else {
			$this->data['error_date_available'] = '';
		}	

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}
		
		if (isset($this->request->get['filter_short_description'])) {
			$url .= '&filter_short_description=' . $this->request->get['filter_short_description'];
		}
		
		if (isset($this->request->get['filter_comment'])) {
			$url .= '&filter_comment=' . $this->request->get['filter_comment'];
		}
		
		if (isset($this->request->get['filter_approved'])) {
			$url .= '&filter_approved=' . $this->request->get['filter_approved'];
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

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/news', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
									
		if (!isset($this->request->get['news_id'])) {
			$this->data['action'] = $this->url->link('catalog/news/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('catalog/news/update', 'token=' . $this->session->data['token'] . '&news_id=' . $this->request->get['news_id'] . $url, 'SSL');
		}
		
		$this->data['cancel'] = $this->url->link('catalog/news', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['token'] = $this->session->data['token'];

		if (isset($this->request->get['news_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$news_info = $this->model_catalog_news->getNew($this->request->get['news_id']);
    	}

		$this->load->model('localisation/language');
		
		$this->data['languages'] = $this->model_localisation_language->getLanguages();
		
		if (isset($this->request->post['news_description'])) {
			$this->data['news_description'] = $this->request->post['news_description'];
		} elseif (isset($news_info)) {
			$this->data['news_description'] = $this->model_catalog_news->getNewsDescriptions($this->request->get['news_id']);
		} else {
			$this->data['news_description'] = array();
		}

		$this->load->model('setting/store');
		
		$this->data['stores'] = $this->model_setting_store->getStores();
		
		if (isset($this->request->post['news_store'])) {
			$this->data['news_store'] = $this->request->post['news_store'];
		} elseif (isset($news_info)) {
			$this->data['news_store'] = $this->model_catalog_news->getNewsStores($this->request->get['news_id']);
		} else {
			$this->data['news_store'] = array(0);
		}	
		
		if (isset($this->request->post['keyword'])) {
			$this->data['keyword'] = $this->request->post['keyword'];
		} elseif (isset($news_info)) {
			$this->data['keyword'] = $news_info['keyword'];
		} else {
			$this->data['keyword'] = '';
		}
		
		if (isset($this->request->post['news_tag'])) {
			$this->data['news_tag'] = $this->request->post['news_tag'];
		} elseif (isset($news_info)) {
			$this->data['news_tag'] = $this->model_catalog_news->getNewsTags($this->request->get['news_id']);
		} else {
			$this->data['news_tag'] = array();
		}
		
		if (isset($this->request->post['image'])) {
			$this->data['image'] = $this->request->post['image'];
		} elseif (isset($news_info)) {
			$this->data['image'] = $news_info['image'];
		} else {
			$this->data['image'] = '';
		}
		
		$this->load->model('tool/image');
		
		if (isset($news_info) && $news_info['image'] && file_exists(DIR_IMAGE . $news_info['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($news_info['image'], 100, 100);
		} else {
			$this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}
		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
      	
		if (isset($this->request->post['date_available'])) {
       		$this->data['date_available'] = $this->request->post['date_available'];
		} elseif (isset($news_info)) {
			$this->data['date_available'] = date('Y-m-d', strtotime($news_info['date_available']));
		} else {
			$this->data['date_available'] = date('Y-m-d', time() - 86400);
		}
											
    
		if (isset($this->request->post['sort_order'])) {
      		$this->data['sort_order'] = $this->request->post['sort_order'];
    	} elseif (isset($news_info)) {
      		$this->data['sort_order'] = $news_info['sort_order'];
    	} else {
			$this->data['sort_order'] = 1;
		}
		
		if (isset($this->request->post['comment'])) {
      		$this->data['comment'] = $this->request->post['comment'];
    	} else if (isset($news_info)) {
			$this->data['comment'] = $news_info['comment'];
		} else {
      		$this->data['comment'] = 1;
    	}
    	
    	if (isset($this->request->post['approved'])) {
      		$this->data['approved'] = $this->request->post['approved'];
    	} else if (isset($news_info)) {
			$this->data['approved'] = $news_info['approved'];
		} else {
      		$this->data['approved'] = 1;
    	}
		
    	if (isset($this->request->post['status'])) {
      		$this->data['status'] = $this->request->post['status'];
    	} else if (isset($news_info)) {
			$this->data['status'] = $news_info['status'];
		} else {
      		$this->data['status'] = 1;
    	}
		
		

		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		
		
		$this->load->model('catalog/news_category');
				
		$this->data['categories'] = $this->model_catalog_news_category->getNewsCategories(0);
		
		if (isset($this->request->post['news_category'])) {
			$this->data['news_category'] = $this->request->post['news_category'];
		} elseif (isset($news_info)) {
			$this->data['news_category'] = $this->model_catalog_news->getNewsCategories($this->request->get['news_id']);
		} else {
			$this->data['news_category'] = array();
		}		
		
		if (isset($this->request->post['news_related'])) {
			$news = $this->request->post['news_related'];
		} elseif (isset($news_info)) {		
			$news = $this->model_catalog_news->getNewsRelated($this->request->get['news_id']);
		} else {
			$news = array();
		}
	
		$this->data['news_related'] = array();
		
		foreach ($news as $news_id) {
			$related_info = $this->model_catalog_news->getNew($news_id);
			
			if ($related_info) {
				$this->data['news_related'][] = array(
					'news_id' => $related_info['news_id'],
					'name'       => $related_info['name']
				);
			}
		}
		
		if (isset($this->request->post['news_layout'])) {
			$this->data['news_layout'] = $this->request->post['news_layout'];
		} elseif (isset($this->request->get['news_id'])) {
			$this->data['news_layout'] = $this->model_catalog_news->getNewsLayouts($this->request->get['news_id']);
		} else {
			$this->data['news_layout'] = array();
		}

		$this->load->model('design/layout');		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();
										
		$this->template = 'catalog/news_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
				
		$this->response->setOutput($this->render());
  	} 
	
  	private function validateForm() { 
    	if (!$this->user->hasPermission('modify', 'catalog/news')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}

    	foreach ($this->request->post['news_description'] as $language_id => $value) {
      		if ((strlen(utf8_decode($value['name'])) < 1) || (strlen(utf8_decode($value['name'])) > 255)) {
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
	
  	private function validateDelete() {
    	if (!$this->user->hasPermission('modify', 'catalog/news')) {
      		$this->error['warning'] = $this->language->get('error_permission');  
    	}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}
  	
  	private function validateCopy() {
    	if (!$this->user->hasPermission('modify', 'catalog/news')) {
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
		
		if (isset($this->request->post['filter_name'])) {
	
			$this->load->model('catalog/news');
			
			$data = array(
				'filter_name' => $this->request->post['filter_name'],
				'start'       => 0,
				'limit'       => 20
			);
			
			$results = $this->model_catalog_news->getNews($data);
			
			foreach ($results as $result) {
				$json[] = array(
					'news_id' => $result['news_id'],
					'name'       => html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')				
				);	
			}
		}
		
		$this->response->setOutput(json_encode($json));	
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