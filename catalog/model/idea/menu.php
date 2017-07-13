<?php
class ModelIdeaMenu extends Model {	 			//ham hien thi menu 2 lop	public function showMenu()
	{		$datamenus = array();
		$menus = $this->getMenus(0);	
		foreach ($menus as $menu) {
			if ($menu['top']) {
				$children_menu_data = array();			
				$children_menu = $this->model_idea_menu->getMenus($menu['menu_id']);
				foreach ($children_menu as $child_menu) {
					$data = array(
						'filter_menu_id'  => $child_menu['menu_id'],
						'filter_sub_menu' => true
					);
					$value_child = $this->url->link('common/home');
					if($child_menu['chossen_id'] == 1){
						$value_child = $this->url->link('information/information', 'information_id=' . $child_menu['category_id_chossen']); 
					}
					else if($child_menu['chossen_id'] == 2)					{
						$value_child = $this->url->link('product/category', 'path=' . $child_menu['category_id_chossen']);	
					}
					else if($child_menu['chossen_id'] == 3)					{
						$value_child = $child_menu['category_id_chossen']; 
					}
					else if($child_menu['chossen_id'] == 4)
					{
						$value_child = $this->url->link('information/contact');
					}
					else if($child_menu['chossen_id'] == 5)
					{
						$value_child = $this->url->link('information/information', 'information_id=4'); 
					}else if($child_menu['chossen_id'] == 6)
					{
						$value_child = $this->url->link('product/allproducts'); 
					}else if($child_menu['chossen_id'] == 7)
					{
						$value_child = $this->url->link('product/special'); 
					}
					$children_menu_data[] = array(
						'image'  => $child_menu['image'],
						'menu_id'  => $child_menu['menu_id'],
						'name'  => $child_menu['name'],
						'href'  => $value_child	
					);						
				}			
				$value = $this->url->link('common/home');				if($menu['chossen_id'] == 1){					$value = $this->url->link('information/information', 'information_id=' . $menu['category_id_chossen']); 				}
				else if($menu['chossen_id'] == 2)				{					$value = $this->url->link('product/category', 'path=' . $menu['category_id_chossen']);	
				}
				else if($menu['chossen_id'] == 3)
				{
					$value = $menu['category_id_chossen']; 
				}
				else if($menu['chossen_id'] == 4)
				{
					$value = $this->url->link('information/contact');
				}
				else if($menu['chossen_id'] == 5)
				{
					$value = $this->url->link('information/information', 'information_id=4'); 
				}else if($menu['chossen_id'] == 6)
				{
					$value = $this->url->link('product/allproducts'); 
				}else if($menu['chossen_id'] == 7)
				{
					$value = $this->url->link('product/special'); 
				}			 
				// Level 1				$datamenus[] = array(					'name'     => $menu['name'],					'image'     => $menu['image'],					'menu_id'  => $menu['menu_id'],					'children' => $children_menu_data,					'column'   => $menu['column'] ? $menu['column'] : 1,					'href'     => $value
				);
			}
		}
		return $datamenus;
	}


	public function getMenu($menu_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "menu c LEFT JOIN " . DB_PREFIX . "menu_description cd ON (c.menu_id = cd.menu_id) WHERE c.menu_id = '" . (int)$menu_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c.status = '1'");
		return $query->row;
	}
	
	public function getMenus($parent_id = 0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "menu c LEFT JOIN " . DB_PREFIX . "menu_description cd ON (c.menu_id = cd.menu_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c.status = '1' ORDER BY c.sort_order, LCASE(cd.name)");
		return $query->rows;
	}
		
	public function getMenusByParentId($menu_id,$count = 0) {
		$menu_data = array();		$menu_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "menu c LEFT JOIN " . DB_PREFIX . "menu_description cd ON (c.menu_id = cd.menu_id) WHERE c.parent_id = '" . (int)$menu_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c.status = '1' ORDER BY c.sort_order, LCASE(cd.name)");		foreach ($menu_query->rows as $menu) {			$menu_data[] = $menu['menu_id'];			//$menu_data[] = $menu['name'];
			$total = $this->getTotalMenusBymenuId($menu['menu_id']); 			if($total > 0)			{				if ($count == $total - 1)  				{ 					$count = 0;					 				}				else				{					$menu_data[] = $this->getMenusByParentId($menu['menu_id'], $count + 1);				}			}
		}
		return $menu_data;
	}
	public function getTotalMenusBymenuId($parent_id = 0) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "menu c WHERE c.parent_id = '" . (int)$parent_id . "'  AND c.status = '1'");		return $query->row['total'];
	}
}
?>