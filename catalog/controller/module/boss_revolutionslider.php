<?php
class ControllerModuleBossRevolutionSlider extends Controller {
	protected function index($setting) {
		if(!in_array($this->config->get('config_store_id'),$setting['store_id']))
			return;
		static $module = 0;
		$this->data['option'] = $setting['option'];
		$this->data['slides'] = $setting['slide'];
		
		// image		
		$this->load->model('tool/image');

		$this->data['images'] = array();

		if($setting['slide']){
			$this->data['slides'] = $setting['slide'];
			foreach ($this->data['slides'] as $slide_row=>$slide)
			{
				if($slide['type_background'] == 'image_bg')
				{
					$thumb = $this->model_tool_image->resize($slide['background'], $this->data['option']['thumbnailwidth'], $this->data['option']['thumbnailheight']);
					$background = $this->model_tool_image->resize($slide['background'],$setting['image_width'], $setting['image_height']);
					
					$this->data['slides'][$slide_row]['thumb'] = $thumb;
					$this->data['slides'][$slide_row]['background'] = $background;
				}
				if(isset($slide['caption']))
				{
					foreach($slide['caption'] as $caption_row=>$caption)
					{
						if($caption['type_caption'] == 'image_caption')
						{
							$image_caption = $this->config->get('config_ssl') . 'image/'.$caption['image_caption'];
							$this->data['slides'][$slide_row]['caption'][$caption_row]['image_caption'] = $image_caption;
						}
					}
				}
			}
		}
 
		$this->data['module'] = $module++;
				
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/boss_revolutionslider.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/boss_revolutionslider.tpl';
		} else {
			$this->template = 'default/template/module/boss_revolutionslider.tpl';
		}
		$this->render();
	}
}
?>