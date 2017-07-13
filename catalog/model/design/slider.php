<?php
class ModelDesignSlider extends Model {	
	public function getSlider($slider_id) {
		/*$query = $this->db->query("SELECT si.*,sid.* FROM " . DB_PREFIX . "slider_image AS si LEFT JOIN " . DB_PREFIX . "slider_image_description AS sid ON (si.slider_image_id  = sid.slider_image_id) WHERE si.slider_id = '" . (int)$slider_id . "' AND sid.language_id = '" . (int)$this->config->get('config_language_id') . "'");*/
		$query = $this->db->query("SELECT si.*,sid.* FROM " . DB_PREFIX . "slider_image AS si," . DB_PREFIX . "slider_image_description AS sid WHERE si.slider_image_id  = sid.slider_image_id AND si.slider_id = '" . (int)$slider_id . "' AND sid.language_id = '" . (int)$this->config->get('config_language_id') ."' ORDER BY si.sorting ASC" );
		
		return $query->rows;
	}
	public function checkCaption($slider_id) {
		$query = $this->db->query("SELECT caption FROM " . DB_PREFIX . "slider WHERE slider_id = '" . (int)$slider_id . "'");
		return $query->row;
		}
	public function make_image_url($filename) {
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			return HTTPS_IMAGE . $filename;
		} else {
			return HTTP_IMAGE . $filename;
		}
	}	
}
?>