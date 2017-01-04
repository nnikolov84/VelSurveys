<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Surveys extends MY_Controller {
	protected $access = "Admin";
	// functions
	public function index() {
		$this->load->view ( "header" );
		$this->load->view ( "navbar" );
		$this->load->model ( "main_model" );
		$data ["fetch_data"] = $this->main_model->fetch_data ();
		$this->load->view ( "surveys", $data );
		$this->load->view ( "footer" );
	}
	public function form_validation() {
		// echo 'OK';
		$this->load->library ( 'form_validation' );
		$this->form_validation->set_rules ( "name", "Name", 'required' );
		$this->form_validation->set_rules ( "description", "Description", 'required' );
		$this->form_validation->set_rules ( "start_date", "Start Date", 'required|date' );
		if ($this->form_validation->run ()) {
			// true
			$this->load->model ( "main_model" );
			
			if ($this->input->post ( "update" )) {
				$data = array (
						"name" => $this->input->post ( "name" ),
						"description" => $this->input->post ( "description" ),
						"start_date" => $this->input->post ( "start_date" ),
						"end_date" => $this->input->post ( "end_date" ),
						"last_updated_by" => $this->session->userdata("username") ,
						"last_update_Date" => date ( 'Y-m-d H:i:s' ) 
				);
				
				$this->main_model->update_data ( $data, $this->input->post ( "id_survey" ) );
				redirect ( base_url () . "index.php/surveys/updated" );
			}
			if ($this->input->post ( "insert" )) {
				$data = array (
						"name" => $this->input->post ( "name" ),
						"description" => $this->input->post ( "description" ),
						"start_date" => $this->input->post ( "start_date" ),
						"end_date" => $this->input->post ( "end_date" ),
						"last_updated_by" => $this->session->userdata("username") ,
						"last_update_Date" => date ( 'Y-m-d H:i:s' ),
						"created_by" => $this->session->userdata("username") 
				);
				
				$this->main_model->insert_data ( $data );
				redirect ( base_url () . "index.php/surveys/inserted" );
			}
		} else {
			// false
			$this->index ();
		}
	}
	public function inserted() {
		$this->index ();
	}
	public function delete_data() {
		$id_survey = $this->uri->segment ( 3 );
		$this->load->model ( "main_model" );
		$this->main_model->delete_data ( $id_survey );
		redirect ( base_url () . "index.php/surveys/deleted" );
	}
	public function deleted() {
		$this->index ();
	}
	public function update_data() {
		$survey_id = $this->uri->segment ( 3 );
		$this->load->model ( "main_model" );
		$data ["user_data"] = $this->main_model->fetch_single_data ( $survey_id );
		$data ["fetch_data"] = $this->main_model->fetch_data ();
		$this->load->view ( "header" );
		$this->load->view ( "navbar" );
		$this->load->view ( "surveys", $data );
		$this->load->view ( "footer" );
	}
	public function updated() {
		$this->index ();
	}
	public function open_links() {
		$survey_id = $this->uri->segment ( 3 );
		$this->load->model ( "main_model" );
		$link_data ["survey_data"] = $this->main_model->fetch_single_data ( $survey_id );
		$link_data ["fetch_links"] = $this->main_model->fetch_links ($survey_id);
		$link_data ["languages_data"] = $this->main_model->fetch_languages();
		$this->load->view ( "header" );
		$this->load->view ( "links", $link_data );
		$this->load->view ( "footer" );
	}
}