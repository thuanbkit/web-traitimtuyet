<?php  
class ControllerModuleadvancedslider extends Controller {
	protected function index($setting) {
		static $module = 0;
		
		$this->load->model('design/slider');
		$this->load->model('tool/image');
		$type=$setting['type'];	
		$this->data['width'] = $setting['width'];
		$this->data['height'] = $setting['height'];
		$this->data['velocity']=$setting['velocity'];
		$this->data['duration']=$setting['duration'];
		
		$this->data['sliders'] = array();
		
		$results = $this->model_design_slider->getslider($setting['slider_id']);
		$caption = $this->model_design_slider->checkCaption($setting['slider_id']);
		$this->data['caption']=$caption['caption'];
		foreach ($results as $result) {
			if (file_exists(DIR_IMAGE . $result['image'])) {
				if(!empty($result['thumbnail'])) {
					$thumb=$this->model_design_slider->make_image_url($result['thumbnail']);
					$thumb2=$this->model_design_slider->make_image_url($result['thumbnail']); 
				}
				else { 
					$thumb= $this->model_tool_image->resize($result['image'], 85, 45);
					$thumb2= $this->model_tool_image->resize($result['image'], 45, 45);
				}
				$this->data['sliders'][] = array(
				'image_id'		=> $result['slider_image_id'],
				'title'			=> $result['title'],
				'subtitle'		=> $result['subtitle'],
				'description' 	=> $result['description'],
				'extra' 		=> $result['extra'],
				'link'  		=> $result['link'],
				'image' 		=> $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height']),
				'thumb' 		=> $thumb,
				'thumb2' 		=> $thumb2
				);
			}
		}
		
		$this->data['module'] = $module++;
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/advancedslider/'.$type.'.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/advancedslider/'.$type.'.tpl';
		} else {
			$this->template = 'default/template/module/advancedslider/'.$type.'.tpl';
		}
		
		$this->render();
	}
}
?>