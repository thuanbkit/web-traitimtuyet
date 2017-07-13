<?php

class ControllerModuleVisitorCounter extends Controller {
	
	private $error = array(); 
	
	public function install() {
		$this->load->model('module/visitor_counter');
		$this->model_module_visitor_counter->createVisitorTable();
	}
	
	public function index() {   
		
        $this->load->language('module/visitor_counter');

        $this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('visitor_counter', $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$text_strings = array(
				'heading_title',
				'text_enabled',
				'text_disabled',
				'text_content_top',
				'text_content_bottom',
				'text_column_left',
				'text_column_right',
				'text_left',
				'text_right',
				'text_module',
				'text_success',
				'text_total_visitors',
				'text_total_hits',
				'entry_limit',
				'entry_image',
				'entry_count_type',
				'entry_layout',
				'entry_position',
				'entry_status',
				'entry_sort_order',
				'button_save',
				'button_cancel',
				'button_add_module',
				'button_remove',
				'error_permission',
		);
		
		foreach ($text_strings as $text) {
			$this->data[$text] = $this->language->get($text);
		}
		
		$config_data = array(
			'visitor_counter_main_counter',
		);
		
		foreach ($config_data as $conf) {
			if (isset($this->request->post[$conf])) {
				$this->data[$conf] = $this->request->post[$conf];
			} else {
				$this->data[$conf] = $this->config->get($conf);
			}
		}
	
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/visitor_counter', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/visitor_counter', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

	
		$this->data['modules'] = array();
		
		if (isset($this->request->post['visitor_counter_module'])) {
			$this->data['modules'] = $this->request->post['visitor_counter_module'];
		} elseif ($this->config->get('visitor_counter_module')) { 
			$this->data['modules'] = $this->config->get('visitor_counter_module');
		}		

		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->template = 'module/visitor_counter.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);

		$this->response->setOutput($this->render());
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/visitor_counter')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}


}
?>
