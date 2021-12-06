<?php
class ModelExtensionModuleExportJson extends Model
{
	public function addCategory($data)
	{
		$this->db->query("INSERT INTO " . DB_PREFIX . "category SET parent_id = '0', `top` = '0', `column` = '0', sort_order = '0', status = '1', date_modified = NOW(), date_added = NOW()");
		$category_id = $this->db->getLastId();
		$language_id = (int)$this->config->get('config_language_id');
		$this->db->query("INSERT INTO " . DB_PREFIX . "category_description SET category_id = '" . (int)$category_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($data['title']) . "', description = '-', meta_title = '" . $this->db->escape($data['title']) . "', meta_description = '', meta_keyword = ''");
		//return $category_id;
	}
}
