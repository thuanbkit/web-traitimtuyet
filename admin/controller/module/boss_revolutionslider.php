<?php
class ControllerModuleBossRevolutionSlider extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->language->load('module/boss_revolutionslider');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
	
		$this->document->addScript('view/javascript/bossthemes/boss_revolutionslider/jquery.accordion.js');
		$this->document->addScript('view/javascript/bossthemes/boss_revolutionslider/colorpicker.js');
		$this->document->addScript('view/javascript/bossthemes/boss_revolutionslider/eye.js');
		$this->document->addScript('view/javascript/bossthemes/boss_revolutionslider/layout.js');
		$this->document->addStyle('view/stylesheet/bossthemes/boss_revolutionslider/accordion.css');
		$this->document->addStyle('view/stylesheet/bossthemes/boss_revolutionslider/colorpicker.css');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('boss_revolutionslider', $this->request->post);		
			$this->cache->delete('boss_revolutionslider');		
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
		//load data
		
		
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
			'href'      => $this->url->link('module/boss_revolutionslider', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/boss_revolutionslider', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['token'] = $this->session->data['token'];
		
		
		//button
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_remove'] = $this->language->get('button_remove');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_add_slider'] = $this->language->get('button_add_slider');
		$this->data['button_add_caption'] = $this->language->get('button_add_caption');
		
		//module 
		$this->data['text_module'] = $this->language->get('text_module');
		$this->data['module_stt'] = $this->language->get('module_stt');
		$this->data['module_config_info'] = $this->language->get('module_config_info');
		$this->data['module_slider_list'] = $this->language->get('module_slider_list');
		$this->data['module_config_option'] = $this->language->get('module_config_option');
		
		//entry   
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['text_new_slide'] = $this->language->get('text_new_slide');
		$this->data['text_general'] = $this->language->get('text_general');
		$this->data['text_animation'] = $this->language->get('text_animation');
		$this->data['text_caption'] = $this->language->get('text_caption');
		$this->data['text_slide'] = $this->language->get('text_slide');
		
        //load animation slide text
		$this->data['text_transition'] = $this->language->get('text_transition');
		$this->data['text_transition_des'] = $this->language->get('text_transition_des');
		$this->data['text_slot_amount'] = $this->language->get('text_slot_amount');
		$this->data['text_slot_amount_des'] = $this->language->get('text_slot_amount_des');
		$this->data['text_master_speed'] = $this->language->get('text_master_speed');
		$this->data['text_master_speed_des'] = $this->language->get('text_master_speed_des');
		$this->data['text_target'] = $this->language->get('text_target');
		$this->data['text_target_des'] = $this->language->get('text_target_des');
		$this->data['text_delay'] = $this->language->get('text_delay');
		$this->data['text_delay_des'] = $this->language->get('text_delay_des');
		$this->data['text_enable_link'] = $this->language->get('text_enable_link');
		$this->data['text_full_video'] = $this->language->get('text_full_video');
		$this->data['text_background'] = $this->language->get('text_background');
		$this->data['text_color'] = $this->language->get('text_color');
		$this->data['text_transparent'] = $this->language->get('text_transparent'); 		
		$this->data['text_url'] = $this->language->get('text_url');
		$this->data['text_image_manager'] = $this->language->get('text_image_manager'); 
		
		//config option
		$this->data['text_delay_option_des'] = $this->language->get('text_delay_option_des');
		$this->data['text_startheight_option'] = $this->language->get('text_startheight_option');
		$this->data['text_startheight_option_des'] = $this->language->get('text_startheight_option_des');
		$this->data['text_startwidth_option'] = $this->language->get('text_startwidth_option');
		$this->data['text_startwidth_option_des'] = $this->language->get('text_startwidth_option_des');
		$this->data['text_touchenabled'] = $this->language->get('text_touchenabled');
		$this->data['text_touchenabled_des'] = $this->language->get('text_touchenabled_des');
		$this->data['text_onhoverstop'] = $this->language->get('text_onhoverstop'); 		
		$this->data['text_onhoverstop_des'] = $this->language->get('text_onhoverstop_des');
		$this->data['text_fullwidth'] = $this->language->get('text_fullwidth');
		$this->data['text_fullwidth_des'] = $this->language->get('text_fullwidth_des');
		$this->data['text_timeline'] = $this->language->get('text_timeline');
		$this->data['text_timeline_des'] = $this->language->get('text_timeline_des');
		$this->data['text_timerlineposition'] = $this->language->get('text_timerlineposition');
		$this->data['text_timerlineposition_des'] = $this->language->get('text_timerlineposition_des');
		$this->data['text_shadow'] = $this->language->get('text_shadow');
		$this->data['text_shadow_des'] = $this->language->get('text_shadow_des');
		$this->data['text_onhoverstop_des'] = $this->language->get('text_onhoverstop_des');
		$this->data['text_navigation'] = $this->language->get('text_navigation');
		$this->data['text_navigation_type'] = $this->language->get('text_navigation_type');
		$this->data['text_navigation_type_des'] = $this->language->get('text_navigation_type_des');
		$this->data['text_navigation_arrow'] = $this->language->get('text_navigation_arrow');
		$this->data['text_navigation_arrow_des'] = $this->language->get('text_navigation_arrow_des');
		$this->data['text_navigation_style'] = $this->language->get('text_navigation_style');
		$this->data['text_navigation_style_des'] = $this->language->get('text_navigation_style_des');
		$this->data['text_navigationhalign'] = $this->language->get('text_navigationhalign');
		$this->data['text_navigationhalign_des'] = $this->language->get('text_navigationhalign_des');
		$this->data['text_navigationvalign'] = $this->language->get('text_navigationvalign');
		$this->data['text_navigationvalign_des'] = $this->language->get('text_navigationvalign_des');
		$this->data['text_navigationhoffset'] = $this->language->get('text_navigationhoffset'); 		
		$this->data['text_navigationhoffset_des'] = $this->language->get('text_navigationhoffset_des');
		$this->data['text_navigationvoffset'] = $this->language->get('text_navigationvoffset');
		$this->data['text_navigationvoffset_des'] = $this->language->get('text_navigationvoffset_des');
		$this->data['text_soloarrowlefthalign'] = $this->language->get('text_soloarrowlefthalign');
		$this->data['text_soloarrowlefthalign_des'] = $this->language->get('text_soloarrowlefthalign_des');
		$this->data['text_soloarrowleftvalign'] = $this->language->get('text_soloarrowleftvalign');
		$this->data['text_soloarrowleftvalign_des'] = $this->language->get('text_soloarrowleftvalign_des');
		$this->data['text_soloarrowlefthoffset'] = $this->language->get('text_soloarrowlefthoffset');
		$this->data['text_soloarrowlefthoffset_des'] = $this->language->get('text_soloarrowlefthoffset_des');
		$this->data['text_soloarrowleftvoffset'] = $this->language->get('text_soloarrowleftvoffset');
		$this->data['text_soloarrowleftvoffset_des'] = $this->language->get('text_soloarrowleftvoffset_des');
		$this->data['text_soloarrowrighthalign'] = $this->language->get('text_soloarrowrighthalign');
		$this->data['text_soloarrowrighthalign_des'] = $this->language->get('text_soloarrowrighthalign_des'); 		
		$this->data['text_soloarrowrightvalign'] = $this->language->get('text_soloarrowrightvalign');
		$this->data['text_soloarrowrightvalign_des'] = $this->language->get('text_soloarrowrightvalign_des');
		$this->data['text_soloarrowrighthoffset'] = $this->language->get('text_soloarrowrighthoffset');
		$this->data['text_soloarrowrighthoffset_des'] = $this->language->get('text_soloarrowrighthoffset_des');
		$this->data['text_soloarrowrightvoffset'] = $this->language->get('text_soloarrowleftvoffset');
		$this->data['text_soloarrowrightvoffset_des'] = $this->language->get('text_soloarrowleftvoffset_des');
		$this->data['text_thumbnails'] = $this->language->get('text_thumbnails');
		$this->data['text_timehidethumbnail'] = $this->language->get('text_timehidethumbnail');
		$this->data['text_timehidethumbnail_des'] = $this->language->get('text_timehidethumbnail_des');
		$this->data['text_thumbnailwidth'] = $this->language->get('text_thumbnailwidth');
		$this->data['text_thumbnailwidth_des'] = $this->language->get('text_thumbnailwidth_des');
		$this->data['text_thumbnailheight'] = $this->language->get('text_thumbnailheight');
		$this->data['text_thumbnailheight_des'] = $this->language->get('text_thumbnailheight_des'); 		
		$this->data['text_thumbamount'] = $this->language->get('text_thumbamount');
		$this->data['text_thumbamount_des'] = $this->language->get('text_thumbamount_des');
		$this->data['text_visibility'] = $this->language->get('text_visibility');
		$this->data['text_hidecapptionatlimit'] = $this->language->get('text_hidecapptionatlimit');
		$this->data['text_hidecapptionatlimit_des'] = $this->language->get('text_hidecapptionatlimit_des');
		//
		$this->data['text_hideallcapptionatlimit'] = $this->language->get('text_hideallcapptionatlimit');
		$this->data['text_hideallcapptionatlimit_des'] = $this->language->get('text_hideallcapptionatlimit_des');
		$this->data['text_hideslideratlimit'] = $this->language->get('text_hideslideratlimit');
		$this->data['text_hideslideratlimit_des'] = $this->language->get('text_hideslideratlimit_des');
		
		
		//add caption 
		$this->data['text_new_caption'] = $this->language->get('text_new_caption');
		$this->data['text_remove_caption'] = $this->language->get('text_remove_caption');
		$this->data['text_type_caption'] = $this->language->get('text_type_caption');
		$this->data['text_text_caption'] = $this->language->get('text_text_caption');
		$this->data['text_image_caption'] = $this->language->get('text_image_caption');
		$this->data['text_video_caption'] = $this->language->get('text_video_caption'); 	
		$this->data['text_text'] = $this->language->get('text_text');
		$this->data['text_image'] = $this->language->get('text_image');
		$this->data['text_video'] = $this->language->get('text_video');
		$this->data['text_video_type'] = $this->language->get('text_video_type');
		$this->data['text_video_id'] = $this->language->get('text_video_id');
		$this->data['text_browse'] = $this->language->get('text_browse');
		$this->data['text_clear'] = $this->language->get('text_clear');
		$this->data['text_datax'] = $this->language->get('text_datax');
		$this->data['text_datax_des'] = $this->language->get('text_datax_des');
		$this->data['text_datay'] = $this->language->get('text_datay');
		$this->data['text_datay_des'] = $this->language->get('text_datay_des'); 	
		$this->data['text_class_css'] = $this->language->get('text_class_css'); 
		$this->data['text_class_css_des'] = $this->language->get('text_class_css_des'); 
		$this->data['text_data_speed'] = $this->language->get('text_data_speed');
		$this->data['text_data_speed_des'] = $this->language->get('text_data_speed_des');
		$this->data['text_data_start'] = $this->language->get('text_data_start');
		$this->data['text_data_start_des'] = $this->language->get('text_data_start_des');
		$this->data['text_data_end'] = $this->language->get('text_data_end');
		$this->data['text_data_end_des'] = $this->language->get('text_data_end_des');
		$this->data['text_data_after_speed'] = $this->language->get('text_data_after_speed');
		$this->data['text_data_after_speed_des'] = $this->language->get('text_data_after_speed_des');
		$this->data['text_incom_animation'] = $this->language->get('text_incom_animation'); 	
		$this->data['text_incom_animation_des'] = $this->language->get('text_incom_animation_des'); 
		$this->data['text_outgo_animation'] = $this->language->get('text_outgo_animation'); //
		$this->data['text_outgo_animation_des'] = $this->language->get('text_outgo_animation_des');
		$this->data['text_easing'] = $this->language->get('text_easing');
		$this->data['text_easing_des'] = $this->language->get('text_easing_des');
		$this->data['text_endeasing'] = $this->language->get('text_endeasing');
		$this->data['text_endeasing_des'] = $this->language->get('text_endeasing_des'); 	
		$this->data['text_under_width'] = $this->language->get('text_under_width'); 
		$this->data['text_under_width_des'] = $this->language->get('text_under_width_des'); 
		
		//tab  
		$this->data['tab_stt'] = $this->language->get('tab_stt');
		$this->data['tab_title'] = $this->language->get('tab_title');
		$this->data['tab_get_product'] = $this->language->get('tab_get_product');
		
		//load text position
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');
		$this->data['text_slideshow'] = $this->language->get('text_slideshow');
		$this->data['text_default'] = $this->language->get('text_default');
		
		//image
		$this->load->model('tool/image');
		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		//load modules
		$this->data['modules'] = array();
		if (isset($this->request->post['boss_revolutionslider_module'])) {
			$this->data['modules'] = $this->request->post['boss_revolutionslider_module'];
		} elseif ($this->config->get('boss_revolutionslider_module')) { 
			$this->data['modules'] = $this->config->get('boss_revolutionslider_module');
		}
		
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		//load languages
		$this->load->model('localisation/language');
		$this->data['languages'] = $this->model_localisation_language->getLanguages();
		
		//load layout
		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		//load store
		$this->load->model('setting/store');
		
		$this->data['stores'] = $this->model_setting_store->getStores();
		
		//load categories
		$this->load->model('catalog/category');
		$this->data['categories'] = $this->model_catalog_category->getCategories(0);
		//load confif for slide
		$this->data['transitions']= array("boxslide","boxfade","slotzoom-horizontal","slotslide-horizontal","slotfade-horizontal","slotzoom-vertical","slotslide-vertical","slotfade-vertical","curtain-1","curtain-2","curtain-3","slideleft","slideright","slideup","slidedown","fade","random","slidehorizontal","slidevertical","papercut","flyin","turnoff","cube","3dcurtain-vertical","3dcurtain-horizontal");
		
		$this->data['class_css']= array("big_white","big_orange","big_black","medium_grey","small_text","medium_text","large_text","large_black_text","very_large_text","very_large_black_text","bold_red_text","bold_brown_text","bold_green_text","very_big_white","very_big_black","randomrotate","custum_big_text","custum_small_text","custum_button");
		
		$this->data['incom_animation']= array("sft"=>"Short from Top","sfb"=>"Short from Bottom","sfr"=>"Short from Right","sfl"=>"Short from Left","lft"=>"Long from Top","lfb"=>"Long from Bottom","lfr"=>"Long from Right","lfl"=>"Long from Left","fade"=>"fading","randomrotate"=>"randomrotate");
		
		$this->data['outgo_animation']= array("stt"=>"Short to Top","stb"=>"Short to Bottom","str"=>"Short to Right","stl"=>"Short to Left","ltt"=>"Long to Top","ltb"=>"Long to Bottom","ltr"=>"Long to Right","ltl"=>"Long to Left","fadeout"=>"fading","randomrotateout"=>"Fade in");
		
		$this->data['easing']= array("easeOutBack","easeInQuad","easeOutQuad","easeInOutQuad","easeInCubic","easeOutCubic","easeInOutCubic","easeInQuart","easeOutQuart","easeInOutQuart","easeInQuint","easeOutQuint","easeInOutQuint","easeInSine","easeOutSine","easeInOutSine","easeInExpo","easeOutExpo","easeInOutExpo","easeInCirc","easeOutCirc","easeInOutCirc","easeInElastic","easeOutElastic","easeInOutElastic","easeInBack","easeOutBack","easeInOutBack","easeInBounce","easeOutBounce","easeInOutBounce");
		
		$this->data['modules'] = array();
		
		if (isset($this->request->post['boss_revolutionslider_module'])) {
			$this->data['modules'] = $this->request->post['boss_revolutionslider_module'];
		} elseif ($this->config->get('boss_revolutionslider_module')) { 
			$this->data['modules'] = $this->config->get('boss_revolutionslider_module');
		}

		foreach($this->data['modules'] as $module_row=>$module)
		{
			if(isset($module['slide']))
			{
				foreach($module['slide'] as $slide_row=>$slide)
				{
					if($slide['type_background'] == 'image_bg')
					{
						$thumb = $this->model_tool_image->resize($slide['background'], 100, 100);
						$this->data['modules'][$module_row]['slide'][$slide_row]['thumb'] = $thumb;
					}
					if(isset($slide['caption']))
					{
						foreach($slide['caption'] as $caption_row=>$caption)
						{
							if($caption['type_caption'] == 'image_caption')
							{
								$thumb = $this->model_tool_image->resize($caption['image_caption'], 100, 100);
								$this->data['modules'][$module_row]['slide'][$slide_row]['caption'][$caption_row]['thumb'] = $thumb;
							}
						}
					}
				}
			}
		}
		$this->template = 'module/boss_revolutionslider.tpl';
		$this->children = array(
            'common/header',
			'common/footer'
		);
		$this->response->setOutput($this->render());
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/boss_revolutionslider')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
				
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
  
	private function getIdLayout($layout_name) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "layout WHERE LOWER(name) = LOWER('".$layout_name."')");
		return (int)$query->row['layout_id'];
	}
	

	public function install() 
	{
        $this->load->model('setting/setting');
		
		$this->load->model('localisation/language');
			
		$languages = $this->model_localisation_language->getLanguages();
		
		$array_description0 = array();
		$array_description1 = array();
		$array_description2 = array();
		$array_description3 = array();
		$array_description4 = array();
						
		foreach($languages as $language){
			$array_description0{$language['language_id']} = 'conseq magna';
			$array_description1{$language['language_id']} = 'Conseq magna eget ante hendrerit sed &lt;br/&gt; sollicitudin velit ullamcorper. Aenean enim &lt;br/&gt; sapie nulla vehicula tellus id libero dignissim';
			$array_description2{$language['language_id']} = '&lt;a href=&quot;#&quot;&gt;shop now&lt;/a&gt;';
		}
		
		$boss_revolutionslider = array('boss_revolutionslider_module' => array ( 0 => array( 
			'image_width' => 904, 
			'image_height' => 396,
			'layout_id' => $this->getIdLayout('home'),
			'position' => 'slideshow',
			'status' => 1,
			'sort_order' => 1,
			'store_id' => array( 0 => 0),
			'slide' => array ( 
				0 => array(
					'type_background' => 'image_bg',
					'background' => 'data/bt_electronues/slideshow01_03.jpg',
					'url' => 'index.php?route=product/category&amp;path=33',
					'status' => 1,
					'transitions' => 'fade',
					'slotamount' => 4,
					'masterspeed' => 300,
					'target' => '_self',
					'delay' => '5000',
					'enablelink' => 1,
					'enablefullvideo' => 1,
					'caption' => array(
						0 => array(
							'type_caption' => 'text_caption',
							'text_caption' => $array_description0,
							'datax' => 114,
							'datay' => 104,
							'class_css' => 'custum_big_text',
							'dataspeed' => 900,
							'datastart' => 100,
							'dataend' => 4500,
							'dataafterspeed' => 900,
							'incom_animation' => 'randomrotate',
							'outgo_animation' => 'ltl',
							'easing' => 'easeOutExpo',
							'endeasing' => 'easeOutBack'
						),
						1 => array(
							'type_caption' => 'text_caption',
							'text_caption' => $array_description1,
							'datax' => 114,
							'datay' => 153,
							'class_css' => 'custum_small_text',
							'dataspeed' => 900,
							'datastart' => 500,
							'dataend' => 4500,
							'dataafterspeed' => 900,
							'incom_animation' => 'lft',
							'outgo_animation' => 'stb',
							'easing' => 'easeInCirc',
							'endeasing' => 'easeOutCubic'
						),
						2 => array(
							'type_caption' => 'text_caption',
							'text_caption' => $array_description2,
							'datax' => 114,
							'datay' => 238,
							'class_css' => 'custum_button',
							'dataspeed' => 900,
							'datastart' => 1000,
							'dataend' => 4500,
							'dataafterspeed' => 900,
							'incom_animation' => 'sfl',
							'outgo_animation' => 'stb',
							'easing' => 'endeasing',
							'endeasing' => 'easeOutBack',
							'hideunderwidth' => 'on'
						)
					)
				),
				1 => array(
					'type_background' => 'image_bg',
					'background' => 'data/bt_electronues/slideshow02_03.jpg',
					'url' => 'index.php?route=product/category&amp;path=33',
					'status' => 1,
					'transitions' => 'fade',
					'slotamount' => 4,
					'masterspeed' => 300,
					'target' => '_blank',
					'delay' => '5000',
					'enablelink' => 1,
					'enablefullvideo' => 1,
					'caption' => array(
						0 => array(
							'type_caption' => 'text_caption',
							'text_caption' => $array_description0,
							'datax' => 114,
							'datay' => 104,
							'class_css' => 'custum_big_text',
							'dataspeed' => 900,
							'datastart' => 100,
							'dataend' => 4500,
							'dataafterspeed' => 900,
							'incom_animation' => 'randomrotate',
							'outgo_animation' => 'fadeout',
							'easing' => 'easeInOutBack',
							'endeasing' => 'easeOutCubic'
						),
						1 => array(
							'type_caption' => 'text_caption',
							'text_caption' => $array_description1,
							'datax' => 114,
							'datay' => 153,
							'class_css' => 'custum_small_text',
							'dataspeed' => 900,
							'datastart' => 500,
							'dataend' => 4500,
							'dataafterspeed' => 900,
							'incom_animation' => 'randomrotate',
							'outgo_animation' => 'stt',
							'easing' => 'easeOutBounce',
							'endeasing' => 'easeInOutBounce'
						),
						2 => array(
							'type_caption' => 'text_caption',
							'text_caption' => $array_description2,
							'datax' => 114,
							'datay' => 238,
							'class_css' => 'custum_button',
							'dataspeed' => 900,
							'datastart' => 1000,
							'dataend' => 4500,
							'dataafterspeed' => 900,
							'incom_animation' => 'sfl',
							'outgo_animation' => 'stl',
							'easing' => 'easeInQuint',
							'endeasing' => 'easeOutBack',
							'hideunderwidth' => 'on'
						)
					)
				),
				2 => array(
					'type_background' => 'image_bg',
					'background' => 'data/bt_electronues/slideshow03_03.jpg',
					'url' => 'index.php?route=product/category&amp;path=33',
					'status' => 1,
					'transitions' => 'fade',
					'slotamount' => 4,
					'masterspeed' => 300,
					'target' => '_blank',
					'delay' => '5000',
					'enablelink' => 1,
					'enablefullvideo' => 1,
					'caption' => array(
						0 => array(
							'type_caption' => 'text_caption',
							'text_caption' => $array_description0,
							'datax' => 114,
							'datay' => 104,
							'class_css' => 'custum_big_text',
							'dataspeed' => 900,
							'datastart' => 100,
							'dataend' => 4500,
							'dataafterspeed' => 900,
							'incom_animation' => 'randomrotate',
							'outgo_animation' => 'randomrotateout',
							'easing' => 'randomrotateout',
							'endeasing' => 'easeInElastic'
						),
						1 => array(
							'type_caption' => 'text_caption',
							'text_caption' => $array_description1,
							'datax' => 114,
							'datay' => 153,
							'class_css' => 'custum_small_text',
							'dataspeed' => 900,
							'datastart' => 500,
							'dataend' => 4500,
							'dataafterspeed' => 900,
							'incom_animation' => 'randomrotate',
							'outgo_animation' => 'ltl',
							'easing' => 'easeOutQuint',
							'endeasing' => 'easeInOutElastic'
						),
						2 => array(
							'type_caption' => 'text_caption',
							'text_caption' => $array_description2,
							'datax' => 114,
							'datay' => 238,
							'class_css' => 'custum_button',
							'dataspeed' => 900,
							'datastart' => 1000,
							'dataend' => 4500,
							'dataafterspeed' => 900,
							'incom_animation' => 'lfb',
							'outgo_animation' => 'stl',
							'easing' => 'easeInQuad',
							'endeasing' => 'easeInBounce',
							'hideunderwidth' => 'on'
						)
					)
				)
			),
			'option' => array(
				'delay'=> 5000,
				'startheight' => 399,
				'startwidth' => 910,
				'touchenabled' => 'on',
				'onhoverstop' =>  'on',
				'fullwidth' => 'off',
				'timeline' => 1,
				'timerlineposition' => 'top',
				'shadow' => 3,
				'navigationtype' =>  'none',
				'navigationarrow' => 'nexttobullets',
				'navigationstyle' => 'round',
				'navigationhalign' => 'center',
				'navigationvalign' => 'bottom',
				'navigationhoffset' => 0,
				'navigationvoffset' => 0,
				'soloarrowlefthalign' => 'left',
				'soloarrowleftvalign' => 'center',
				'soloarrowlefthoffset' => 0,
				'soloarrowleftvoffset' => 0,
				'soloarrowrighthalign' => 'right',
				'soloarrowrightvalign' => 'center',
				'soloarrowrighthoffset' => 10,
				'soloarrowrightvoffset' => 50,
				'timehidethumbnail' => 10,
				'thumbnailwidth' => 50,
				'thumbnailheight' => 50,
				'thumbamount' =>4 ,
				'hidecapptionatlimit' => 480,
				'hideallcapptionatlimit' => 250,
				'hideslideratlimit' => 200,
			)
		)));
		
		$this->model_setting_setting->editSetting('boss_revolutionslider', $boss_revolutionslider);		
	}

	
}
?>