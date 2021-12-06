<?php
class ControllerExtensionModuleExportJson extends Controller
{
	private $error = array();

	public function index()
	{

		$json = file_get_contents($this->config->get('site_url') . '/categories.json');

		$json_data = json_decode($json, true);

		foreach ($json_data as $row) {
			if ($this->validate($row)) {
				$this->load->model('extension/module/export_json');
				$this->model_extension_module_export_json->addCategory($row);
			} else {
				echo json_encode(['message' => 'error', 'error_details' => 'Error is in: ' . $row['title']]);
			}
		}
		if(!$this->error){
			echo json_encode(['message' => 'success']);
		}
	}


	protected function validate($data)
	{
		if ((utf8_strlen(trim($data['title'])) < 1) || (utf8_strlen(trim($data['title']))) < 3 || (utf8_strlen(trim($data['title'])) > 12)) {
			$this->error['title'] = $this->language->get('error_title');
		}
		return !$this->error;
	}
}
