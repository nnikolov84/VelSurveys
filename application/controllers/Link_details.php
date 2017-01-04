<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Link_details extends MY_Controller {
	protected $access = "Admin";
	// functions
	public function index() {
		$this->load->view ( "header" );
		$this->load->view ("navbar");
		$survey_id = $this->uri->segment ( 3 );
		$link_id = $this->uri->segment ( 4 );
		$this->load->model ( "main_model" );
		$data ["survey_data"] = $this->main_model->fetch_single_data ($survey_id);
		$data ["link_data"] = $this->main_model->fetch_single_link ($link_id);
		$data ["sentiments_data"] = $this->main_model->fetch_sentiments();
		$data ["languages_data"] = $this->main_model->fetch_languages();
		$this->load->view ( "link_details", $data);
		$this->load->view ( "footer" );
	}	
	
}