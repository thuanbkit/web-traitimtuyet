<?php

class ControllerModuleyahoo extends Controller {

    protected function index() {
        $this->language->load('module/yahoo');
        $this->data['heading_title'] = $this->language->get('heading_title');
        $this->data['label_mobile'] = $this->language->get('label_mobile');
        $this->data['label_email'] = $this->language->get('label_email');
        $support = nl2br($this->config->get('yahoo_messenger_code'));
        $support = explode("<br />", $support);
        $code = '';
        foreach ($support as $a) {
            $str = array_map('trim', explode(',', $a));
            $status = 'http://opi.yahoo.com/online?u=' . $str[1] . '&t=2';
            $code .= '<div class="supportmes clearfix">';
            $code .= '<div class="support title"><strong>'. $str[0] .'</strong></div>';
            $code .= '<div class="online">';
            $code .= '<div class="support clearfix"><a href="ymsgr:sendim?' . $str[1] . '">' . '<img src="' . $status . '" title="' . $str[1] . '"/>' . '</a></div>';
            $code .= '<div class="support skype"><a href="skype:'. $str[2] .'?chat"><img src="catalog/view/theme/default/image/skype.png"/></a></div>';
            $code .= '</div>';
            $code .= '<div class="support">'. $str[3] .'</div>';
            $code .= '<div class="support"> Tel: '. $str[4] .'</div>';
            $code .= '<div class="support">'. $str[5] .'</div>';
            $code .= '</div>';
        }
        $this->data['$support'] = $code;
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/yahoo.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/module/yahoo.tpl';
        } else {
            $this->template = 'default/template/module/yahoochat.tpl';
        }
        $this->render();
    }

}

?>