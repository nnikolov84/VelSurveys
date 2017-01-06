<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This controller can be accessed 
 * for Editor group only
 */
class Editor extends MY_Controller {

	protected $access = array("Admin", "Editor");

	public function index()
	{
		$data ["id"] = $this->input->get("ID");
		$this->load->view("editor", $data);
	}
}