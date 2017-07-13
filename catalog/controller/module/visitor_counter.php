<?php

class ControllerModuleVisitorCounter extends Controller {
	protected function index() {
		
        $this->language->load('module/visitor_counter');

		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['t_today_visitors'] = $this->language->get('t_today_visitors');
		$this->data['t_total_visitors'] = $this->language->get('t_total_visitors');
		
		$this->data['t_today_hits'] = $this->language->get('t_today_hits');
		$this->data['t_total_hits'] = $this->language->get('t_total_hits');
		
		$this->data['t_online_visitors'] = $this->language->get('t_online_visitors');

		$this->load->model('module/visitor_counter');

		$results = $this->model_module_visitor_counter->addVisitor();
		foreach ($results as $key => $value) {
			$this->data[$key] = $results[$key];
		}

		$num_visitors = $results["total_visitor"];
		$num_visits = $results["total_hits"];

		$filler_text = "00000000";
		if (strlen("$num_visitors") < 8) {
			$num_visitors = substr($filler_text, 0, (8-strlen("$num_visitors"))) . "$num_visitors";
		}
		if (strlen("$num_visits") < 8) {
			$num_visits = substr($filler_text, 0, (8-strlen("$num_visits"))) . "$num_visits";
		}

		if ($this->config->get('visitor_counter_main_counter') == 1) {
			$this->data['visitor_counter_num'] = "$num_visitors";
		}
		else {
			$this->data['visitor_counter_num'] = "$num_visits";
		}
 
        $path = HTTP_SERVER . "/image/counter/";
        $ext = ".png";
        $str = $this->data['visitor_counter_num'];
        for ( $i = 0; $i <= 9; $i++ ){
	       $str = str_replace($i, "<img src='$path$i$ext' alt='$i'>", $str);
        }
		$this->data['visitor_counter_num'] = $str;


		$this->id = 'visitor_counter';


		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/visitor_counter.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/visitor_counter.tpl';
		} else {
			$this->template = 'default/template/module/visitor_counter.tpl';
		}

		$this->render();
	}
}
?>
