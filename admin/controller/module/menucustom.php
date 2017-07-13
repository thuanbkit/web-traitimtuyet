<?php
class ControllerModuleMenucustom extends Controller {
	
	public function install() {
		
		$this->load->model('idea/menucustom');
		
		/*$this->model_module_menucustom->createmenu();*/
		$this->model_idea_menucustom->createmenu();
		
	}
	public function uninstall() {
		$this->load->model('idea/menucustom');
		$this->model_idea_menucustom->dropmenu();
	}
	public function index() {
	
		//LOAD LANGUAGE
		$this->load->language('module/menucustom');
		
		//tieu de
		$this->document->setTitle($this->language->get('heading_title'));
		
		// canh bao
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		//tieu de
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_menu'] = $this->language->get('button_menu');
		
		$this->data['link_menu'] = $this->url->link('menu/menucustom', 'token=' . $this->session->data['token'], 'SSL');
		
		//
		
		//
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
			'href'      => $this->url->link('module/menucustom', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		
		$this->template = 'module/menucustom.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);

		$this->response->setOutput($this->render());
	}
	
	
		

}
?>
