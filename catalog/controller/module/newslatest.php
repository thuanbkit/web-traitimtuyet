<?php
class ControllerModulenewslatest extends Controller {
	protected function index($setting) {
		$this->language->load('module/newslatest');
		
      	$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['button_cart'] = $this->language->get('button_cart');
		
		$this->data['position'] = $setting['position'];
				
		$this->load->model('catalog/news');
		
		$this->load->model('tool/image');

		$this->load->model('tool/t2vn');
		
		$this->data['newss'] = array();
		
		$data = array(
			'sort'  => 'p.date_added',
			'order' => 'DESC',
			'start' => 0,
			'limit' => $setting['limit']
		);

		$results = $this->model_catalog_news->getNews($data);
		
		foreach ($results as $result) {
			$width = ''; $height = '';
			if ($result['image'] && $setting['imagestatus'] == 1) {
				$image = $this->model_tool_image->resize($result['image'], $setting['image_width'], $setting['image_height']);
			} elseif ($setting['imagestatus'] == 1) {
					$firstImgNews = $this->catchFirstImage(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'));
					if($firstImgNews == 'no_image.jpg'){
						$image = $this->model_tool_image->resize('no_image.jpg', $setting['image_width'], $setting['image_height']);
					} else {
						$image = $firstImgNews; $width = 'width="'.$setting['image_width'].'"'; $height = 'height="'.$setting['image_height'].'"';
					}
				} else {
					$image = false;
			}
			
			if ($result['short_description'] && $setting['description'] == 1) {
				$short_description = $this->model_tool_t2vn->cut_string(html_entity_decode($result['short_description'], ENT_QUOTES, 'UTF-8'), $setting['limitdescription']);
			} else {
				$short_description = false;
			}
			
			if ($this->config->get('config_comment_status')) {
				$rating = $result['rating'];
			} else {
				$rating = false;
			}
			
			$this->data['newss'][] = array(
				'news_id' 		=> $result['news_id'],
				'thumb'   	 	=> $image,
				'width'       => $width,
				'height'       => $height,
				'short_description'	=> $short_description,
				'image' 		=> HTTP_IMAGE . $result['image'],
				'name'    	 	=> $result['name'],
				'rating'     	=> $rating,
				'comments'    	=> sprintf($this->language->get('text_comments'), (int)$result['comment']),
				'href'    	 	=> $this->url->link('news/news', 'news_id=' . $result['news_id']),
			);
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/newslatest.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/newslatest.tpl';
		} else {
			$this->template = 'default/template/module/newslatest.tpl';
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