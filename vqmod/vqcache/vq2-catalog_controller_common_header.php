<?php   
class ControllerCommonHeader extends Controller {
	protected function index() {
		$this->data['title'] = $this->document->getTitle();

		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		if (isset($this->session->data['error']) && !empty($this->session->data['error'])) {
			$this->data['error'] = $this->session->data['error'];

			unset($this->session->data['error']);
		} else {
			$this->data['error'] = '';
		}

		$this->data['base'] = $server;
		$this->data['description'] = $this->document->getDescription();
		$this->data['keywords'] = $this->document->getKeywords();
		$this->data['links'] = $this->document->getLinks();	 
		$this->data['styles'] = $this->document->getStyles();
		$this->data['scripts'] = $this->document->getScripts();
		$this->data['lang'] = $this->language->get('code');
		$this->data['direction'] = $this->language->get('direction');
		$this->data['google_analytics'] = html_entity_decode($this->config->get('config_google_analytics'), ENT_QUOTES, 'UTF-8');
		$this->data['name'] = $this->config->get('config_name');

		if ($this->config->get('config_icon') && file_exists(DIR_IMAGE . $this->config->get('config_icon'))) {
			$this->data['icon'] = $server . 'image/' . $this->config->get('config_icon');
		} else {
			$this->data['icon'] = '';
		}

		if ($this->config->get('config_logo') && file_exists(DIR_IMAGE . $this->config->get('config_logo'))) {
			$this->data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$this->data['logo'] = '';
		}		

		$this->language->load('common/header');

		$this->data['text_home'] = $this->language->get('text_home');
		$this->data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		$this->data['text_shopping_cart'] = $this->language->get('text_shopping_cart');
		$this->data['text_search'] = $this->language->get('text_search');
		$this->data['text_welcome'] = sprintf($this->language->get('text_welcome'), $this->url->link('account/login', '', 'SSL'), $this->url->link('account/register', '', 'SSL'));
		$this->data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', 'SSL'), $this->customer->getFirstName(), $this->url->link('account/logout', '', 'SSL'));
		$this->data['text_account'] = $this->language->get('text_account');
		$this->data['text_checkout'] = $this->language->get('text_checkout');
		$this->data['text_name_store'] = $this->language->get('text_name_store');
		$this->data['text_name_sologan'] = $this->language->get('text_name_sologan');
		$this->data['text_information'] = $this->language->get('text_information');
		$this->data['text_about'] = $this->language->get('text_about');
		$this->data['text_service'] = $this->language->get('text_service');
		$this->data['text_lab'] = $this->language->get('text_lab');
		$this->data['text_contact'] = $this->language->get('text_contact');
		$this->data['text_product'] = $this->language->get('text_product');
		
 
		$this->data['text_sunday'] = $this->language->get('text_sunday');
		$this->data['text_monday'] = $this->language->get('text_monday');
		$this->data['text_tuesday'] = $this->language->get('text_tuesday');
		$this->data['text_wednesday'] = $this->language->get('text_wednesday');
		$this->data['text_thursday'] = $this->language->get('text_thursday');
		$this->data['text_friday'] = $this->language->get('text_friday');
		$this->data['text_saturday'] = $this->language->get('text_saturday');
		
		$this->data['text_january'] = $this->language->get('text_january');
		$this->data['text_february'] = $this->language->get('text_february');
		$this->data['text_march'] = $this->language->get('text_march');
		$this->data['text_april'] = $this->language->get('text_april');
		$this->data['text_may'] = $this->language->get('text_may');
		$this->data['text_june'] = $this->language->get('text_june');
		$this->data['text_july'] = $this->language->get('text_july');
		$this->data['text_august'] = $this->language->get('text_august');
		$this->data['text_september'] = $this->language->get('text_september');
		$this->data['text_october'] = $this->language->get('text_october');
		$this->data['text_november'] = $this->language->get('text_november');
		$this->data['text_december'] = $this->language->get('text_december');
		$this->data['text_year'] = $this->language->get('text_year');
		
		$this->data['home'] = $this->url->link('common/home');
		$this->data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');
		$this->data['logged'] = $this->customer->isLogged();
		$this->data['account'] = $this->url->link('account/account', '', 'SSL');
		$this->data['shopping_cart'] = $this->url->link('checkout/cart');
		$this->data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');

		// Daniel's robot detector
		$status = true;

		if (isset($this->request->server['HTTP_USER_AGENT'])) {
			$robots = explode("\n", trim($this->config->get('config_robots')));

			foreach ($robots as $robot) {
				if ($robot && strpos($this->request->server['HTTP_USER_AGENT'], trim($robot)) !== false) {
					$status = false;

					break;
				}
			}
		}

		// A dirty hack to try to set a cookie for the multi-store feature
		$this->load->model('setting/store');

		$this->data['stores'] = array();

		if ($this->config->get('config_shared') && $status) {
			$this->data['stores'][] = $server . 'catalog/view/javascript/crossdomain.php?session_id=' . $this->session->getId();

			$stores = $this->model_setting_store->getStores();

			foreach ($stores as $store) {
				$this->data['stores'][] = $store['url'] . 'catalog/view/javascript/crossdomain.php?session_id=' . $this->session->getId();
			}
		}

		// Search		
		if (isset($this->request->get['search'])) {
			$this->data['search'] = $this->request->get['search'];
		} else {
			$this->data['search'] = '';
		}
		
		//Custom Menu

		$this->load->model('idea/menu');
		$this->data['menus'] = $this->model_idea_menu->showMenu();
		
		$this->data['Multichidmenu'] = $this->MultiChlidMenu($this->model_idea_menu->getMenusByParentId(0)) ;
		


		// Menu
		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$this->data['categories'] = array();

		$categories = $this->model_catalog_category->getCategories(0);

		foreach ($categories as $category) {
			if ($category['top']) {
				// Level 2
				$children_data = array();

				$children = $this->model_catalog_category->getCategories($category['category_id']);

				foreach ($children as $child) {
					$data = array(
						'filter_category_id'  => $child['category_id'],
						'filter_sub_category' => true
					);

					$product_total = $this->model_catalog_product->getTotalProducts($data);

					$children_data[] = array(
						'name'  => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $product_total . ')' : ''),
						'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])
					);						
				}

				// Level 1
				$this->data['categories'][] = array(
					'name'     => $category['name'],
					'children' => $children_data,
					'column'   => $category['column'] ? $category['column'] : 1,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
			}
		}

if (isset($this->request->get['catid'])) {
			$partnews = explode('_', (string)$this->request->get['catid']);
		} else {
			$partnews = array();
		}
		
		if (isset($partnews[0])) {
			$this->data['cat_id'] = $partnews[0];
		} else {
			$this->data['cat_id'] = 0;
		}

		$this->load->model('catalog/news_category');
		$this->load->model('catalog/news');
		
		$this->data['categoriesnews'] = array();
					
		$categoriesnews = $this->model_catalog_news_category->getNewsCategories(0);
		
		foreach ($categoriesnews as $cat) {
			if ($cat['top']) {
				$childrennews_data = array();
				
				$childrennews = $this->model_catalog_news_category->getNewsCategories($cat['news_category_id']);
				$news_totals = $this->model_catalog_news->getTotalNewsByCategory($cat['news_category_id']);
				foreach ($childrennews as $childnews) {	
					$news_total = $this->model_catalog_news->getTotalNewsByCategory($childnews['news_category_id']);
					if($childnews['image']!='') {
						$image = $childnews['image'];			
					}else{
						$image = $cat['image'];			
					}
					
					$childrennews_data[] = array(
						'name'  => $childnews['name'] . ($this->config->get('config_product_count') ? ' (' . $news_total . ')' : ''),
						'image'    	=> $image,
						'href'  	=> $this->url->link('news/news_category', 'cat_id=' . $cat['news_category_id'] . '_' . $childnews['news_category_id'])	
					);					
				}
				
				// Level 1
				$this->data['categoriesnews'][] = array(
					'name'     => $cat['name'],
					'cat_id'   => $cat['news_category_id'],
					'children' => $childrennews_data,
					'column'   => $cat['column'] ? $cat['column'] : 1,
					'href'     => $this->url->link('news/news_category', 'cat_id=' . $cat['news_category_id'])
				);
			}
		}
		$this->children = array(
			'module/language',
			'module/currency',
			'module/cart'
		);

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/header.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/header.tpl';
		} else {
			$this->template = 'default/template/common/header.tpl';
		}

		$this->render();
	}
		//ham hien thi menu da lop
	
	

	public function MultiChlidMenu($array)
    {
         
		$buf = '';
		foreach($array as $key => $value)
		{	
			
			//print_r($data_menu);
			//de quy neu la array
			
			if(is_array($value))
			{	
				$buf .= '<ul>' .  $this->MultiChlidMenu($value).'</ul>';
			}
			else
			{
				
					$data_menu = $this->model_idea_menu->getMenu($value);
					$value_child = $this->url->link('common/home');
					
					switch($data_menu['chossen_id']) {
						default :
							$value_child = HTTP_SERVER; 
							
							break;
						case 1:
							$value_child = $this->url->link('news/news_category', 'cat_id=' . $data_menu['category_id_chossen']); 
							break;
						case 2:
							$value_child = $this->url->link('product/category', 'path=' . $data_menu['category_id_chossen']);	 
							break;
						case 3:
							$value_child = $data_menu['category_id_chossen']; 
							break;
						case  4:
							$value_child = $this->url->link('information/contact');
							break;
						case 5:
							$value_child = $this->url->link('information/information', 'information_id=4');
							break;
						case 6:
							$value_child = $this->url->link('product/allproducts'); 
							break;
						case 7:
							$value_child = $this->url->link('product/special');
							break;
						case  8:
							$value_child = $this->url->link('information/information', 'information_id=' . $data_menu['category_id_chossen']); 
							break;
						case  9:
							$value_child = $this->url->link('news/all', '');
							break;
						case 10:
							$value_child = $this->url->link('information/all');
							break;
					}
					  
					
					$buf .= "<li><a href= '" . $value_child ."' title= '".$data_menu['name']."'>".$data_menu['name']."</a>";
				 
				 
			}
			
			if(isset($array[$key + 1])){
				if(is_array($array[$key + 1])){
					$buf .= "";
				}
 
			}
				else
			{
				$buf .= "</li>";
			}
				
				
		}

		return $buf;
    }
	
	
}
?>
