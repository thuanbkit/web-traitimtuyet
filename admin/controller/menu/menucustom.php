<?php 
class ControllerMenuMenucustom extends Controller { 
	private $error = array();
 
	public function index() {
		$this->load->language('module/menucustom');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('idea/menucustom');
		 
		$this->getList();
	}

	public function insert() {
		$this->load->language('module/menucustom');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('idea/menucustom');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_idea_menucustom->addMenu($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->redirect($this->url->link('menu/menucustom', 'token=' . $this->session->data['token'], 'SSL')); 
		}

		$this->getForm();
	}

	public function update() {
		$this->load->language('module/menucustom');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('idea/menucustom');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_idea_menucustom->editmenu($this->request->get['menu_id'], $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->redirect($this->url->link('menu/menucustom', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('module/menucustom');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('idea/menucustom');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $menu_id) {
				$this->model_idea_menucustom->deletemenu($menu_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('menu/menucustom', 'token=' . $this->session->data['token'], 'SSL'));
		}
		$this->getList();
	}
	
	private function getList() {
   		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('menu/menucustom', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
									
		$this->data['insert'] = $this->url->link('menu/menucustom/insert', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['delete'] = $this->url->link('menu/menucustom/delete', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['menus'] = array();
		
		$results = $this->model_idea_menucustom->getMenus(0);

		//print_r($results); //fix
		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('menu/menucustom/update', 'token=' . $this->session->data['token'] . '&menu_id=' . $result['menu_id'], 'SSL')
			);
					
			$this->data['menus'][] = array(
				'menu_id' => $result['menu_id'],
				'name'        => $result['name'],
				'sort_order'  => $result['sort_order'],
				'selected'    => isset($this->request->post['selected']) && in_array($result['menu_id'], $this->request->post['selected']),
				'action'      => $action
			);
		}
		
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_sort_order'] = $this->language->get('column_sort_order');
		$this->data['column_action'] = $this->language->get('column_action');

		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');
 
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
		
		$this->template = 'menucustom/menu_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	private function getForm() {
	
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
		
		$this->data['text_category']  	= $this->language->get('text_category');
		$this->data['text_allproduct']  	= $this->language->get('text_allproduct');
		$this->data['text_allinformation']  	= $this->language->get('text_allinformation');
		$this->data['text_allnews']  	= $this->language->get('text_allnews');
		$this->data['text_special']  	= $this->language->get('text_special');
		$this->data['text_other']  		= $this->language->get('text_other');
		$this->data['text_information']  = $this->language->get('text_information');
		$this->data['text_home']  = $this->language->get('text_home');
		$this->data['text_contact']  = $this->language->get('text_contact');
		$this->data['text_abouts']  = $this->language->get('text_abouts');
		$this->data['text_news']  = $this->language->get('text_news');
				
		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_keyword'] = $this->language->get('entry_keyword');
		$this->data['entry_parent'] = $this->language->get('entry_parent');
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

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('menu/menucustom', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		if (!isset($this->request->get['menu_id'])) {
			$this->data['action'] = $this->url->link('menu/menucustom/insert', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$this->data['action'] = $this->url->link('menu/menucustom/update', 'token=' . $this->session->data['token'] . '&menu_id=' . $this->request->get['menu_id'], 'SSL');
		}
		
		$this->data['cancel'] = $this->url->link('menu/menucustom', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->get['menu_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$menu_info = $this->model_idea_menucustom->getMenu($this->request->get['menu_id']);
			//print_r($menu_info);
    	}
		
		$this->data['token'] = $this->session->data['token'];
		
		$this->load->model('localisation/language');
		
		$this->data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['menu_description'])) {
			$this->data['menu_description'] = $this->request->post['menu_description'];
		} elseif (isset($this->request->get['menu_id'])) {
			$this->data['menu_description'] = $this->model_idea_menucustom->getMenuDescriptions($this->request->get['menu_id']);
		} else {
			$this->data['menu_description'] = array();
		}

		$menus = $this->model_idea_menucustom->getMenus(0);

		// Remove own id from list
		if (!empty($menu_info)) {
			foreach ($menus as $key => $menu) {
				if ($menu['menu_id'] == $menu_info['menu_id']) {
					unset($menus[$key]);
				}
			}
		}

		$this->data['menus'] = $menus;
		

		
		if (isset($this->request->post['chossen_id'])) {
			$this->data['chossen_id'] = $this->request->post['chossen_id'];
		} elseif (!empty($menu_info)) {
			$this->data['chossen_id'] = $menu_info['chossen_id'];
		} else {
			$this->data['chossen_id'] = 0;
		}
		
		if (isset($this->request->post['parent_id'])) {
			$this->data['parent_id'] = $this->request->post['parent_id'];
		} elseif (!empty($menu_info)) {
			$this->data['parent_id'] = $menu_info['parent_id'];
		} else {
			$this->data['parent_id'] = 0;
		}

		if (isset($this->request->post['image'])) {
			$this->data['image'] = $this->request->post['image'];
		} elseif (!empty($menu_info)) {
			$this->data['image'] = $menu_info['image'];
		} else {
			$this->data['image'] = '';
		}
		
		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && file_exists(DIR_IMAGE . $this->request->post['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($menu_info) && $menu_info['image'] && file_exists(DIR_IMAGE . $menu_info['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($menu_info['image'], 100, 100);
		} else {
			$this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}
		
		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		
		if (isset($this->request->post['top'])) {
			$this->data['top'] = $this->request->post['top'];
		} elseif (!empty($menu_info)) {
			$this->data['top'] = $menu_info['top'];
		} else {
			$this->data['top'] = 0;
		}
		
		if (isset($this->request->post['column'])) {
			$this->data['column'] = $this->request->post['column'];
		} elseif (!empty($menu_info)) {
			$this->data['column'] = $menu_info['column'];
		} else {
			$this->data['column'] = 1;
		}
				
		if (isset($this->request->post['sort_order'])) {
			$this->data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($menu_info)) {
			$this->data['sort_order'] = $menu_info['sort_order'];
		} else {
			$this->data['sort_order'] = 0;
		}
		
		if (isset($this->request->post['status'])) {
			$this->data['status'] = $this->request->post['status'];
		} elseif (!empty($menu_info)) {
			$this->data['status'] = $menu_info['status'];
		} else {
			$this->data['status'] = 1;
		}
				
		
		// lay du lieu
		$this->load->model('catalog/category');		
		$categories_pro= $this->model_catalog_category->getCategories('');
		$this->data['categories_pro']= $categories_pro;

		$this->load->model('catalog/news_category');
		$categories_new= $this->model_catalog_news_category->getNewsCategories('');
		$this->data['categories_new']= $categories_new;
		
		
		$this->load->model('catalog/information');		
		$list_informations =  $this->model_catalog_information->getInformations();
		$this->data['list_informations']=  $list_informations;
		
 
		$value = "";
		$id_value = "";
		
		if (!empty($menu_info)) {
 
			if($menu_info['chossen_id'] == 1){
				foreach ($categories_new as $category_new) {
					if($category_new['news_category_id'] == $menu_info['category_id_chossen'])
					{
						$value = $category_new['name']; 
						$id_value  = $category_new['news_category_id'];
					}
				}
			}
			if($menu_info['chossen_id'] == 2)
			{
				foreach ($categories_pro as $category_pro) {
					if($category_pro['category_id'] == $menu_info['category_id_chossen'])
					{
						$value = $category_pro['name']; 
						$id_value  = $category_pro['category_id'];
					}
				}
			}
			if($menu_info['chossen_id'] == 8)
			{
				foreach ($list_informations as $info) {
					if($info['information_id'] == $menu_info['category_id_chossen'])
					{
						$value = $info['title']; 
						$id_value  = $info['information_id'];
					}
				}
			}
			if($menu_info['chossen_id'] == 3)
			{
				
				$value = $menu_info['category_id_chossen'];
				
			}
			
		}
		$this->data['category_id_chossen'] = $value;
		$this->data['category_category_id'] = $id_value;
		
		//

		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();
						
		$this->template = 'menucustom/menu_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	private function validateForm() {
		if (!$this->user->hasPermission('modify', 'menu/menucustom')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['menu_description'] as $language_id => $value) {
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

	private function validateDelete() {
		if (!$this->user->hasPermission('modify', 'menu/menucustom')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
 
		if (!$this->error) {
			return true; 
		} else {
			return false;
		}
	}
}
?>