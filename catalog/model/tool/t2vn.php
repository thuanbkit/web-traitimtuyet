<?php 
class ModelToolT2vn extends Model {
	public function getValueByCurrenyID($currency_id) {
		$query = $this->db->query("SELECT value FROM " . DB_PREFIX . "currency WHERE currency_id = '" . $this->db->escape($currency_id) . "'");
	
		return $query->row['value'];
	} 
	
	function cut_string($str,$len) {
		if ($str=='' || $str==NULL) return $str;
		$str = preg_replace('/\n/','',strip_tags($str));
		if (is_array($str)) return $str;
		$str = trim($str);
		if (strlen($str) <= $len) return $str;
		$str = substr($str,0,$len);
		$str = explode(' ', $str);
		$final = '';
		for($i=0;$i<count($str)-1;$i++){
			$final .= $str[$i].' ';
		}
		$final = trim($final);
		$final .= '...';
		return $final;
	}
	public function createOrderId(){
		$order_id = '0';
		$pre_date = date("ymd");
		$rand = rand(101,999);
		$order_id = $this->config->get('config_language_id').$pre_date.$rand;
		return $order_id;
	}
	public function nganluong($product,$price,$order){
		
		$nganluong_url = 'https://www.nganluong.vn/checkout.php';
		$info = $this->config->get ( 'config_name' ) . " - Thanh toán cho sản phẩm   " . trim($product) . ". Số hóa đơn: " . $order;
		
		$arr_param = array(
			'merchant_site_code'=>	strval($this->config->get('nganluong_merchant_site_code')),
			'return_url'		=>	strtolower(urlencode(HTTPS_SERVER . 'index.php?route=checkout/success/nganluong')),
			'receiver'			=>	strval($this->config->get('nganluong_receiver')),
			'transaction_info'	=>	strval($info),
			'order_code'		=>	strval($info),					
			'price'				=>	strval((int)$price)
		);

		$secure_code ='';
		$secure_code = implode(' ', $arr_param) . ' ' . $this->config->get('nganluong_secure_pass');
		$arr_param['secure_code'] = md5($secure_code);

		$redirect_url = $nganluong_url;
		if (strpos($redirect_url, '?') === false)
		{
			$redirect_url .= '?';
		}
		else if (substr($redirect_url, strlen($redirect_url)-1, 1) != '?' && strpos($redirect_url, '&') === false)
		{
			$redirect_url .= '&';			
		}
				
		$url = '';
		foreach ($arr_param as $key=>$value)
		{
			if ($url == '')
				$url .= $key . '=' . $value;
			else
				$url .= '&' . $key . '=' . $value;
		}
		return $redirect_url.$url;		
	}
	
	public function baokim($product,$price,$order) {
		$baokim_url = 'https://www.baokim.vn/payment/customize_payment/order';
		$info = $this->get_ascii($this->config->get( 'config_name' ) . " - Thanh toán cho sản phẩm   " . trim($product) . ". Số hóa đơn: " . $order);
		
		
		$params = array(
			'merchant_id'		=>	strval($this->config->get('baokim_merchant_site_code')),
			'order_id'			=>	strval($order),
			'business'			=>	strval($this->config->get('baokim_receiver')),
			'total_amount'		=>	strval((int)$price),
			'shipping_fee'		=>  0,
			'tax_fee'			=>  0,
			'order_description'	=>	strval($info),
			'url_success'		=>	strtolower(HTTPS_SERVER . 'index.php?route=checkout/success/baokim'),
			'url_cancel'		=>	strtolower(HTTPS_SERVER . 'index.php'),
			'url_detail'		=>	strtolower(HTTPS_SERVER . 'index.php')
		);
		ksort($params);

		$str_combined = $this->config->get('baokim_secure_pass').implode('', $params);
		$params['checksum'] = strtoupper(md5($str_combined));
		
		$redirect_url = $baokim_url;
		if (strpos($redirect_url, '?') === false)
		{
			$redirect_url .= '?';
		}
		else if (substr($redirect_url, strlen($redirect_url)-1, 1) != '?' && strpos($redirect_url, '&') === false)
		{
			$redirect_url .= '&';			
		}
				
		$url_params = '';
		foreach ($params as $key=>$value)
		{
			if ($url_params == '')
				$url_params .= $key . '=' . urlencode($value);
			else
				$url_params .= '&' . $key . '=' . urlencode($value);
		}
	
		return $redirect_url.$url_params;
	}
	public function get_ascii($str) {
		$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);  
		$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);  
		$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);  
		$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);  
		$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);  
		$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);  
		$str = preg_replace("/(đ)/", 'd', $str);  
		$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);  
		$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);  
		$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);  
		$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);  
		$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);  
		$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);  
		$str = preg_replace("/(Đ)/", 'D', $str);  
		return $str;  
	}

}
?>