<?php   
class ControllerCommonHome extends Controller {   
	public function index() {
		$this->language->load('common/home');

		$this->document->setTitle($this->language->get('heading_title'));

        
		// Admin Enhanced
		$this->language->load('common/eadmin_shortcuts');
		$url = '';
		$this->data['text_eadmin_products'] = $this->language->get('text_eadmin_products');
		$this->data['eadmin_products'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['text_eadmin_categories'] = $this->language->get('text_eadmin_categories');
		$this->data['eadmin_categories'] = $this->url->link('catalog/category', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['text_eadmin_manufacturer'] = $this->language->get('text_eadmin_manufacturer');
		$this->data['eadmin_manufacturer'] = $this->url->link('catalog/manufacturer', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['text_eadmin_information'] = $this->language->get('text_eadmin_information');
		$this->data['eadmin_information'] = $this->url->link('catalog/information', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['text_eadmin_mail'] = $this->language->get('text_eadmin_mail');
		$this->data['eadmin_mail'] = $this->url->link('sale/contact', 'token=' . $this->session->data['token'] . $url, 'SSL');		
		$this->data['text_eadmin_orders'] = $this->language->get('text_eadmin_orders');
		$this->data['eadmin_orders'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['text_eadmin_returns'] = $this->language->get('text_eadmin_returns');
		$this->data['eadmin_returns'] = $this->url->link('sale/return', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['text_eadmin_customers'] = $this->language->get('text_eadmin_customers');
		$this->data['eadmin_customers'] = $this->url->link('sale/customer', 'token=' . $this->session->data['token'] . $url, 'SSL');		
		$this->data['text_eadmin_purchased'] = $this->language->get('text_eadmin_purchased');
		$this->data['eadmin_purchased'] = $this->url->link('report/product_purchased', 'token=' . $this->session->data['token'] . $url, 'SSL');
		// Admin Enhanced
		
      	

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_overview'] = $this->language->get('text_overview');
		$this->data['text_statistics'] = $this->language->get('text_statistics');
		$this->data['text_latest_10_orders'] = $this->language->get('text_latest_10_orders');
		$this->data['text_total_sale'] = $this->language->get('text_total_sale');
		$this->data['text_total_sale_year'] = $this->language->get('text_total_sale_year');
		$this->data['text_total_order'] = $this->language->get('text_total_order');
		$this->data['text_total_customer'] = $this->language->get('text_total_customer');
		$this->data['text_total_customer_approval'] = $this->language->get('text_total_customer_approval');
		$this->data['text_total_review_approval'] = $this->language->get('text_total_review_approval');
		$this->data['text_total_affiliate'] = $this->language->get('text_total_affiliate');
		$this->data['text_total_affiliate_approval'] = $this->language->get('text_total_affiliate_approval');
		$this->data['text_day'] = $this->language->get('text_day');
		$this->data['text_week'] = $this->language->get('text_week');
		$this->data['text_month'] = $this->language->get('text_month');
		$this->data['text_year'] = $this->language->get('text_year');
		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_order'] = $this->language->get('column_order');
		$this->data['column_customer'] = $this->language->get('column_customer');
		$this->data['column_status'] = $this->language->get('column_status');
		$this->data['column_date_added'] = $this->language->get('column_date_added');
		$this->data['column_total'] = $this->language->get('column_total');
		$this->data['column_firstname'] = $this->language->get('column_firstname');
		$this->data['column_lastname'] = $this->language->get('column_lastname');
		$this->data['column_action'] = $this->language->get('column_action');

        // Admin Enhanced
		$this->data['text_latest'] = $this->language->get('text_latest');
        $this->data['tab_order'] = $this->language->get('tab_order');
        $this->data['tab_customer'] = $this->language->get('tab_customer');
        $this->data['tab_review'] = $this->language->get('tab_review');
        $this->data['tab_return'] = $this->language->get('tab_return');
		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_email'] = $this->language->get('column_email');
		$this->data['column_customer_group'] = $this->language->get('column_customer_group');
		$this->data['column_product'] = $this->language->get('column_product');
		$this->data['column_author'] = $this->language->get('column_author');
		$this->data['column_rating'] = $this->language->get('column_rating');
		$this->data['column_return_id'] = $this->language->get('column_return_id');
		$this->data['column_order_id'] = $this->language->get('column_order_id');
		$this->data['column_customer'] = $this->language->get('column_customer');
		$this->data['column_product'] = $this->language->get('column_product');
		$this->data['column_model'] = $this->language->get('column_model');
		// Admin Enhanced
      

		$this->data['entry_range'] = $this->language->get('entry_range');

		// Check install directory exists
		if (is_dir(dirname(DIR_APPLICATION) . '/install')) {
			$this->data['error_install'] = $this->language->get('error_install');
		} else {
			$this->data['error_install'] = '';
		}

		// Check image directory is writable
		$file = DIR_IMAGE . 'test';

		$handle = fopen($file, 'a+'); 

		fwrite($handle, '');

		fclose($handle); 		

		if (!file_exists($file)) {
			$this->data['error_image'] = sprintf($this->language->get('error_image'), DIR_IMAGE);
		} else {
			$this->data['error_image'] = '';

			unlink($file);
		}

		// Check image cache directory is writable
		$file = DIR_IMAGE . 'cache/test';

		$handle = fopen($file, 'a+'); 

		fwrite($handle, '');

		fclose($handle); 		

		if (!file_exists($file)) {
			$this->data['error_image_cache'] = sprintf($this->language->get('error_image_cache'), DIR_IMAGE . 'cache/');
		} else {
			$this->data['error_image_cache'] = '';

			unlink($file);
		}

		// Check cache directory is writable
		$file = DIR_CACHE . 'test';

		$handle = fopen($file, 'a+'); 

		fwrite($handle, '');

		fclose($handle); 		

		if (!file_exists($file)) {
			$this->data['error_cache'] = sprintf($this->language->get('error_image_cache'), DIR_CACHE);
		} else {
			$this->data['error_cache'] = '';

			unlink($file);
		}

		// Check download directory is writable
		$file = DIR_DOWNLOAD . 'test';

		$handle = fopen($file, 'a+'); 

		fwrite($handle, '');

		fclose($handle); 		

		if (!file_exists($file)) {
			$this->data['error_download'] = sprintf($this->language->get('error_download'), DIR_DOWNLOAD);
		} else {
			$this->data['error_download'] = '';

			unlink($file);
		}

		// Check logs directory is writable
		$file = DIR_LOGS . 'test';

		$handle = fopen($file, 'a+'); 

		fwrite($handle, '');

		fclose($handle); 		

		if (!file_exists($file)) {
			$this->data['error_logs'] = sprintf($this->language->get('error_logs'), DIR_LOGS);
		} else {
			$this->data['error_logs'] = '';

			unlink($file);
		}

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['token'] = $this->session->data['token'];

		$this->load->model('sale/order');

		$this->data['total_sale'] = $this->currency->format($this->model_sale_order->getTotalSales(), $this->config->get('config_currency'));
		$this->data['total_sale_year'] = $this->currency->format($this->model_sale_order->getTotalSalesByYear(date('Y')), $this->config->get('config_currency'));
		$this->data['total_order'] = $this->model_sale_order->getTotalOrders();

		$this->load->model('sale/customer');

		$this->data['total_customer'] = $this->model_sale_customer->getTotalCustomers();
		$this->data['total_customer_approval'] = $this->model_sale_customer->getTotalCustomersAwaitingApproval();

		$this->load->model('catalog/review');

		$this->data['total_review'] = $this->model_catalog_review->getTotalReviews();
		$this->data['total_review_approval'] = $this->model_catalog_review->getTotalReviewsAwaitingApproval();

		$this->load->model('sale/affiliate');

		$this->data['total_affiliate'] = $this->model_sale_affiliate->getTotalAffiliates();
		$this->data['total_affiliate_approval'] = $this->model_sale_affiliate->getTotalAffiliatesAwaitingApproval();

		$this->data['orders'] = array(); 

		$data = array(
			'sort'  => 'o.date_added',
			'order' => 'DESC',
			'start' => 0,
			'limit' => 10
		);

		$results = $this->model_sale_order->getOrders($data);

		foreach ($results as $result) {
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_view'),
				'href' => $this->url->link('sale/order/info', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'], 'SSL')
			);

			$this->data['orders'][] = array(
				'order_id'   => $result['order_id'],
				'customer'   => $result['customer'],
				'status'     => $result['status'],
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'total'      => $this->currency->format($result['total'], $result['currency_code'], $result['currency_value']),
				'action'     => $action
			);
		}


		// Admin Enhanced
		$this->data['customers'] = array(); 
		
		$data = array(
			'sort'  => 'c.date_added',
			'order' => 'DESC',
			'start' => 0,
			'limit' => 10
		);

		$customer_results = $this->model_sale_customer->getCustomers($data);
 
    	foreach ($customer_results as $customer_result) {
			$action = array();
		
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('sale/customer/update', 'token=' . $this->session->data['token'] . '&customer_id=' . $customer_result['customer_id'] . $url, 'SSL')
			);
			
			$this->data['customers'][] = array(
				'customer_id'    => $customer_result['customer_id'],
				'name'           => $customer_result['name'],
				'email'          => $customer_result['email'],
				'customer_group' => $customer_result['customer_group'],
				'status'         => ($customer_result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'approved'       => ($customer_result['approved'] ? $this->language->get('text_yes') : $this->language->get('text_no')),
				'ip'             => $customer_result['ip'],
				'date_added'     => date($this->language->get('date_format_short'), strtotime($customer_result['date_added'])),
				'selected'       => isset($this->request->post['selected']) && in_array($customer_result['customer_id'], $this->request->post['selected']),
				'action'         => $action
			);
		}	

		$this->data['reviews'] = array(); 
		
		$data = array(
			'sort'  => 'r.date_added',
			'order' => 'DESC',
			'start' => 0,
			'limit' => 10
		);

		$review_results = $this->model_catalog_review->getReviews($data);
 
    	foreach ($review_results as $review_result) {
			$action = array();
						
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/review/update', 'token=' . $this->session->data['token'] . '&review_id=' . $review_result['review_id'] . $url, 'SSL')
			);
						
			$this->data['reviews'][] = array(
				'review_id'  => $review_result['review_id'],
				'name'       => $review_result['name'],
				'author'     => $review_result['author'],
				'rating'     => $review_result['rating'],
				'status'     => ($review_result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'date_added' => date($this->language->get('date_format_short'), strtotime($review_result['date_added'])),
				'selected'   => isset($this->request->post['selected']) && in_array($review_result['review_id'], $this->request->post['selected']),
				'action'     => $action
			);
		}	
        
        $this->load->model('sale/return');
        
		$this->data['returns'] = array(); 
		
		$data = array(
			'sort'  => 'r.date_added',
			'order' => 'DESC',
			'start' => 0,
			'limit' => 10
		);

		$return_results = $this->model_sale_return->getReturns($data);
 
    	foreach ($return_results as $return_result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_view'),
				'href' => $this->url->link('sale/return/info', 'token=' . $this->session->data['token'] . '&return_id=' . $return_result['return_id'] . $url, 'SSL')
			);
					
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('sale/return/update', 'token=' . $this->session->data['token'] . '&return_id=' . $return_result['return_id'] . $url, 'SSL')
			);
						
			$this->data['returns'][] = array(
				'return_id'     => $return_result['return_id'],
				'order_id'      => $return_result['order_id'],
				'customer'      => $return_result['customer'],
				'product'       => $return_result['product'],
				'model'         => $return_result['model'],
				'status'        => $return_result['status'],
				'date_added'    => date($this->language->get('date_format_short'), strtotime($return_result['date_added'])),	
				'date_modified' => date($this->language->get('date_format_short'), strtotime($return_result['date_modified'])),				
				'selected'      => isset($this->request->post['selected']) && in_array($return_result['return_id'], $this->request->post['selected']),
				'action'        => $action
			);
		}
		// Admin Enhanced	
     
		if ($this->config->get('config_currency_auto')) {
			$this->load->model('localisation/currency');

			$this->model_localisation_currency->updateCurrencies();
		}


		// Admin Enhanced
		$this->data['eqick'] = $this->config->get('config_eqick');
		$this->data['estat'] = $this->config->get('config_estat');
		$this->data['egana'] = $this->config->get('config_egana');
		$this->data['etabs'] = $this->config->get('config_etabs');
		$this->data['config_eapi_key']    = $this->config->get('config_eapi_key');
		$this->data['config_eprofile_id'] = $this->config->get('config_eprofile_id');
		$this->data['text_ga_summary']   = $this->language->get('text_ga_summary');
		$this->data['text_ga_visits']    = $this->language->get('text_ga_visits');
		$this->data['text_ga_visitors']  = $this->language->get('text_ga_visitors');
		$this->data['text_ga_pageviews'] = $this->language->get('text_ga_pageviews');
		// Admin Enhanced
            
		$this->template = 'common/home.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	public function chart() {
		$this->language->load('common/home');

		$data = array();

		$data['order'] = array();
		$data['customer'] = array();
		$data['xaxis'] = array();

		$data['order']['label'] = $this->language->get('text_order');
		$data['customer']['label'] = $this->language->get('text_customer');

		if (isset($this->request->get['range'])) {
			$range = $this->request->get['range'];
		} else {
			$range = 'month';
		}

		switch ($range) {
			case 'day':
				for ($i = 0; $i < 24; $i++) {
					$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "order` WHERE order_status_id > '" . (int)$this->config->get('config_complete_status_id') . "' AND (DATE(date_added) = DATE(NOW()) AND HOUR(date_added) = '" . (int)$i . "') GROUP BY HOUR(date_added) ORDER BY date_added ASC");

					if ($query->num_rows) {
						$data['order']['data'][]  = array($i, (int)$query->row['total']);
					} else {
						$data['order']['data'][]  = array($i, 0);
					}

					$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE DATE(date_added) = DATE(NOW()) AND HOUR(date_added) = '" . (int)$i . "' GROUP BY HOUR(date_added) ORDER BY date_added ASC");

					if ($query->num_rows) {
						$data['customer']['data'][] = array($i, (int)$query->row['total']);
					} else {
						$data['customer']['data'][] = array($i, 0);
					}

					$data['xaxis'][] = array($i, date('H', mktime($i, 0, 0, date('n'), date('j'), date('Y'))));
				}					
				break;
			case 'week':
				$date_start = strtotime('-' . date('w') . ' days'); 

				for ($i = 0; $i < 7; $i++) {
					$date = date('Y-m-d', $date_start + ($i * 86400));

					$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "order` WHERE order_status_id > '" . (int)$this->config->get('config_complete_status_id') . "' AND DATE(date_added) = '" . $this->db->escape($date) . "' GROUP BY DATE(date_added)");

					if ($query->num_rows) {
						$data['order']['data'][] = array($i, (int)$query->row['total']);
					} else {
						$data['order']['data'][] = array($i, 0);
					}

					$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "customer` WHERE DATE(date_added) = '" . $this->db->escape($date) . "' GROUP BY DATE(date_added)");

					if ($query->num_rows) {
						$data['customer']['data'][] = array($i, (int)$query->row['total']);
					} else {
						$data['customer']['data'][] = array($i, 0);
					}

					$data['xaxis'][] = array($i, date('D', strtotime($date)));
				}

				break;
			default:
			case 'month':
				for ($i = 1; $i <= date('t'); $i++) {
					$date = date('Y') . '-' . date('m') . '-' . $i;

					$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "order` WHERE order_status_id > '" . (int)$this->config->get('config_complete_status_id') . "' AND (DATE(date_added) = '" . $this->db->escape($date) . "') GROUP BY DAY(date_added)");

					if ($query->num_rows) {
						$data['order']['data'][] = array($i, (int)$query->row['total']);
					} else {
						$data['order']['data'][] = array($i, 0);
					}	

					$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE DATE(date_added) = '" . $this->db->escape($date) . "' GROUP BY DAY(date_added)");

					if ($query->num_rows) {
						$data['customer']['data'][] = array($i, (int)$query->row['total']);
					} else {
						$data['customer']['data'][] = array($i, 0);
					}	

					$data['xaxis'][] = array($i, date('j', strtotime($date)));
				}
				break;
			case 'year':
				for ($i = 1; $i <= 12; $i++) {
					$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "order` WHERE order_status_id > '" . (int)$this->config->get('config_complete_status_id') . "' AND YEAR(date_added) = '" . date('Y') . "' AND MONTH(date_added) = '" . $i . "' GROUP BY MONTH(date_added)");

					if ($query->num_rows) {
						$data['order']['data'][] = array($i, (int)$query->row['total']);
					} else {
						$data['order']['data'][] = array($i, 0);
					}

					$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE YEAR(date_added) = '" . date('Y') . "' AND MONTH(date_added) = '" . $i . "' GROUP BY MONTH(date_added)");

					if ($query->num_rows) { 
						$data['customer']['data'][] = array($i, (int)$query->row['total']);
					} else {
						$data['customer']['data'][] = array($i, 0);
					}

					$data['xaxis'][] = array($i, date('M', mktime(0, 0, 0, $i, 1, date('Y'))));
				}			
				break;	
		} 

		$this->response->setOutput(json_encode($data));
	}

	public function login() {
		$route = '';

		if (isset($this->request->get['route'])) {
			$part = explode('/', $this->request->get['route']);

			if (isset($part[0])) {
				$route .= $part[0];
			}

			if (isset($part[1])) {
				$route .= '/' . $part[1];
			}
		}

		$ignore = array(
			'common/login',
			'common/forgotten',
			'common/reset'
		);	

		if (!$this->user->isLogged() && !in_array($route, $ignore)) {
			return $this->forward('common/login');
		}

		if (isset($this->request->get['route'])) {
			$ignore = array(
				'common/login',
				'common/logout',
				'common/forgotten',
				'common/reset',
				'error/not_found',
				'error/permission'
			);

			$config_ignore = array();

			if ($this->config->get('config_token_ignore')) {
				$config_ignore = unserialize($this->config->get('config_token_ignore'));
			}

			$ignore = array_merge($ignore, $config_ignore);

			if (!in_array($route, $ignore) && (!isset($this->request->get['token']) || !isset($this->session->data['token']) || ($this->request->get['token'] != $this->session->data['token']))) {
				return $this->forward('common/login');
			}
		} else {
			if (!isset($this->request->get['token']) || !isset($this->session->data['token']) || ($this->request->get['token'] != $this->session->data['token'])) {
				return $this->forward('common/login');
			}
		}
	}

	public function permission() {
		if (isset($this->request->get['route'])) {
			$route = '';

			$part = explode('/', $this->request->get['route']);

			if (isset($part[0])) {
				$route .= $part[0];
			}

			if (isset($part[1])) {
				$route .= '/' . $part[1];
			}

			$ignore = array(
				'common/home',
				'common/login',
				'common/logout',
				'common/forgotten',
				'common/reset',
				'error/not_found',
				'error/permission'		
			);			

			if (!in_array($route, $ignore) && !$this->user->hasPermission('access', $route)) {
				return $this->forward('error/permission');
			}
		}
	}	
}
?>