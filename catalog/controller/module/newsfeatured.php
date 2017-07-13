<?php
class ControllerModulenewsfeatured extends Controller {
	protected function index($setting) {
		$this->language->load('module/newsfeatured'); 

      	$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['button_cart'] = $this->language->get('button_cart');
		
		$this->data['position'] = $setting['position'];
		
		$this->load->model('catalog/news'); 
		
		$this->load->model('tool/image');
		
		$this->load->model('tool/t2vn');

		$this->data['newss'] = array();

		$newss = explode(',', $this->config->get('newsfeatured_news'));		

		if (empty($setting['limit'])) {
			$setting['limit'] = 5;
		}
		
		$newss = array_slice($newss, 0, (int)$setting['limit']);
		
		foreach ($newss as $news_id) {
			$news_info = $this->model_catalog_news->getNew($news_id);
			
			if ($news_info) {			
				$width = ''; $height = '';			
				
				if ($news_info['image'] && $setting['imagestatus'] == 1) {
					$image = $this->model_tool_image->resize($news_info['image'], $setting['image_width'], $setting['image_height']);
				} elseif ($setting['imagestatus'] == 1) {
					$firstImgNews = $this->catchFirstImage(html_entity_decode($news_info['description'], ENT_QUOTES, 'UTF-8'));
					if($firstImgNews == 'no_image.jpg'){
						$image = $this->model_tool_image->resize('no_image.jpg', $setting['image_width'], $setting['image_height']);
					} else {
						$image = $firstImgNews; $width = 'width="'.$setting['image_width'].'"'; $height = 'height="'.$setting['image_height'].'"';
					}
				} else {
					$image = false;
				}
				
				if ($news_info['short_description'] && $setting['description'] == 1) {
					$short_description = $this->model_tool_t2vn->cut_string(html_entity_decode($news_info['short_description'], ENT_QUOTES, 'UTF-8'), $setting['limitdescription']);
				} else {
					$short_description = false;
				}	
				
				if ($this->config->get('config_comment_status')) {
					$rating = $news_info['rating'];
				} else {
					$rating = false;
				}
					
				$this->data['newss'][] = array(
					'news_id' => $news_info['news_id'],
					'thumb'   	 => $image,
					'name'    	 => $news_info['name'],
					'short_description'	=> $short_description,
					'rating'     => $rating,
					'image' 		=> HTTP_IMAGE . $news_info['image'],
					'width'       => $width,
					'height'       => $height,
					'comments'    => sprintf($this->language->get('text_comments'), (int)$news_info['comment']),
					'href'    	 => $this->url->link('news/news', 'news_id=' . $news_info['news_id']),
				);
			}
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/newsfeatured.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/newsfeatured.tpl';
		} else {
			$this->template = 'default/template/module/newsfeatured.tpl';
		}

		$this->render();
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