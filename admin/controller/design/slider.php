<?php 
class ControllerDesignSlider extends Controller {
	private $error = array();
 
	public function index() {
		$this->load->language('design/slider');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('design/slider');
		
		$this->getList();
	}

	public function insert() {
		$this->load->language('design/slider');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('design/slider');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_design_slider->addslider($this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->redirect($this->url->link('design/slider', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function update() {
		$this->load->language('design/slider');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('design/slider');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_design_slider->editslider($this->request->get['slider_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
					
			$this->redirect($this->url->link('design/slider', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}
 
	public function delete() {
		$this->load->language('design/slider');
 
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('design/slider');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $slider_id) {
				$this->model_design_slider->deleteslider($slider_id);
			}
			
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('design/slider', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	private function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
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
			'href'      => $this->url->link('design/slider', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['insert'] = $this->url->link('design/slider/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('design/slider/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		 
		$this->data['sliders'] = array();

		$data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);
		
		$slider_total = $this->model_design_slider->getTotalsliders();
		
		$results = $this->model_design_slider->getsliders($data);
		
		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('design/slider/update', 'token=' . $this->session->data['token'] . '&slider_id=' . $result['slider_id'] . $url, 'SSL')
			);

			$this->data['sliders'][] = array(
				'slider_id' => $result['slider_id'],
				'name'      => $result['name'],	
				'status'    => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'caption'   => ($result['caption'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'selected'  => isset($this->request->post['selected']) && in_array($result['slider_id'], $this->request->post['selected']),				
				'action'    => $action
			);
		}

		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_no_results'] = $this->language->get('text_no_results');
		
		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_status'] = $this->language->get('column_status');
		$this->data['column_caption'] = $this->language->get('column_caption');
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

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$this->data['sort_name'] = $this->url->link('design/slider', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$this->data['sort_status'] = $this->url->link('design/slider', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
		
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $slider_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('design/slider', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();
		
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'design/slider_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	private function getForm() {
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');
 		$this->data['text_browse'] = $this->language->get('text_browse');
		$this->data['text_clear'] = $this->language->get('text_clear');			
		$this->data['text_link_help'] = $this->language->get('text_link_help');		
		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_sorting'] = $this->language->get('entry_sorting');
		$this->data['entry_title'] = $this->language->get('entry_title');
		$this->data['entry_subtitle'] = $this->language->get('entry_subtitle');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_extra'] = $this->language->get('entry_extra');
		$this->data['entry_link'] = $this->language->get('entry_link');
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_thumbnail'] = $this->language->get('entry_thumbnail');		
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_caption'] = $this->language->get('entry_caption');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_slider'] = $this->language->get('button_add_slider');
		$this->data['button_remove'] = $this->language->get('button_remove');

		$this->data['token'] = $this->session->data['token'];

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = '';
		}

 		if (isset($this->error['slider_image'])) {
			$this->data['error_slider_image'] = $this->error['slider_image'];
		} else {
			$this->data['error_slider_image'] = array();
		}	
						
		$url = '';

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
			'href'      => $this->url->link('design/slider', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
							
		if (!isset($this->request->get['slider_id'])) { 
			$this->data['action'] = $this->url->link('design/slider/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('design/slider/update', 'token=' . $this->session->data['token'] . '&slider_id=' . $this->request->get['slider_id'] . $url, 'SSL');
		}
		
		$this->data['cancel'] = $this->url->link('design/slider', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		if (isset($this->request->get['slider_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$slider_info = $this->model_design_slider->getslider($this->request->get['slider_id']);
		}

		if (isset($this->request->post['name'])) {
			$this->data['name'] = $this->request->post['name'];
		} elseif (!empty($slider_info)) {
			$this->data['name'] = $slider_info['name'];
		} else {
			$this->data['name'] = '';
		}
		
		if (isset($this->request->post['status'])) {
			$this->data['status'] = $this->request->post['status'];
		} elseif (!empty($slider_info)) {
			$this->data['status'] = $slider_info['status'];
		} else {
			$this->data['status'] = true;
		}
		if (isset($this->request->post['caption'])) {
			$this->data['caption'] = $this->request->post['caption'];
		} elseif (!empty($slider_info)) {
			$this->data['caption'] = $slider_info['caption'];
		} else {
			$this->data['caption'] = true;
		}

		$this->load->model('localisation/language');
		
		$this->data['languages'] = $this->model_localisation_language->getLanguages();
		
		$this->load->model('tool/image');
	
		if (isset($this->request->post['slider_image'])) {
			$slider_images = $this->request->post['slider_image'];
		} elseif (isset($this->request->get['slider_id'])) {
			$slider_images = $this->model_design_slider->getsliderImages($this->request->get['slider_id']);	
		} else {
			$slider_images = array();
		}
		
		$this->data['slider_images'] = array();
		
		foreach ($slider_images as $slider_image) {
			if ($slider_image['image'] && file_exists(DIR_IMAGE . $slider_image['image'])) {
				$image = $slider_image['image'];
			} else {
				$image = 'no_image.jpg';
			}
			if ($slider_image['thumbnail'] && file_exists(DIR_IMAGE . $slider_image['thumbnail'])) {
				$thumbnail = $slider_image['thumbnail'];
			} else {
				$thumbnail = '';
			}				
			
			$this->data['slider_images'][] = array(
				'slider_image_description' => $slider_image['slider_image_description'],
				'link'                     => $slider_image['link'],
				'image'                    => $image,
				'thumbnail'                => $thumbnail,
				'sorting'				   => $slider_image['sorting'],
				'thumb'                    => $this->model_tool_image->resize($image, 100, 100),
				'thumbnailt'			   => $this->model_tool_image->resize($thumbnail, 80, 80)
			);	
		} 
	
		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);		

		$this->template = 'design/slider_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	private function validateForm() {
		if (!$this->user->hasPermission('modify', 'design/slider')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}
		
		if (isset($this->request->post['slider_image'])) {
			foreach ($this->request->post['slider_image'] as $slider_image_id => $slider_image) {
				foreach ($slider_image['slider_image_description'] as $language_id => $slider_image_description) {
					if ((utf8_strlen($slider_image_description['title']) < 2) || (utf8_strlen($slider_image_description['title']) > 64)) {
						$this->error['slider_image'][$slider_image_id][$language_id] = $this->language->get('error_title'); 
					}					
				}
			}	
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	private function validateDelete() {
		if (!$this->user->hasPermission('modify', 'design/slider')) {
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
