<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Links extends MY_Controller {
	protected $access = "Admin";
	// functions
	public function index() {
		$this->load->view ( "header" );
		$survey_id = $this->uri->segment ( 3 );
		$this->load->model ( "main_model" );
		$data ["survey_data"] = $this->main_model->fetch_single_data ($survey_id);
		$data ["fetch_links"] = $this->main_model->fetch_links ($survey_id);
		$data ["languages_data"] = $this->main_model->fetch_languages();
		$this->load->view ( "links", $data );
		$this->load->view ( "footer" );
	}	
	public function form_validation() {
		// echo 'OK';
		$this->load->library ( 'form_validation' );
		$this->form_validation->set_rules ( "content", "Content", 'required' );
		$this->form_validation->set_rules ( "link", "Link", 'required' );
		$this->form_validation->set_rules ( "language", "Language", 'required' );
		$this->form_validation->set_rules ( "publish_date", "Publish Date", 'required|date' );
		if ($this->form_validation->run ()) {
			// true
			$this->load->model ( "main_model" );
			$id_source_res = $this->main_model->fetch_source_id_from_link($this->input->post ( "link" ));
			if(isset($id_source_res)) {
				$id_source =$id_source_res->row()->id_source;
			} else
			{
				$id_source = $this->main_model->fetch_source_id('Unknown')->row()->id_source;
			};
			if ($this->input->post ( "update" )) {
				$data = array (
						"id_survey" => $this->input->post ( "id_survey" ),
						"id_language" => $this->main_model->fetch_language_id($this->input->post ( "language" ))->row()->id_language,
						"id_source" =>  $id_source,
						"id_sentiment" => 15,
						"link" => $this->input->post ( "link" ),
						"content" => $this->input->post ( "content" ),
						"publish_date" => $this->input->post ( "publish_date" ),
						"author" => $this->input->post ( "author" ),
						"last_updated_by" => $this->session->userdata ( "username" ),
						"last_update_Date" => date ( 'Y-m-d H:i:s' )
				);
				
				$this->main_model->update_link ( $data, $this->input->post ( "id_link" ) );
				redirect ( base_url () . "index.php/links/updated/".$this->input->post ( "id_survey" ) );
			}
			if ($this->input->post ( "insert" )) {
				$data = array (
						"id_survey" => $this->input->post ( "id_survey" ),
						"id_language" => $this->main_model->fetch_language_id($this->input->post ( "language" ))->row()->id_language,
						"id_source" =>  $id_source,
						"id_sentiment" => 15,
						"link" => $this->input->post ( "link" ),
						"content" => $this->input->post ( "content" ),
						"publish_date" => $this->input->post ( "publish_date" ),
						"author" => $this->input->post ( "author" ),
						"last_updated_by" => $this->session->userdata ( "username" ),
						"last_update_Date" => date ( 'Y-m-d H:i:s' ),
						"created_by" => $this->session->userdata ( "username" ) 
				);
				
				$this->main_model->insert_link ( $data );
				redirect ( base_url () . "index.php/links/inserted/".$this->input->post ( "id_survey" ) );
			}
		} else {
			// false
			$this->index ();
		}
	}
	public function inserted() {
		$survey_id = $this->uri->segment ( 3 );
		$this->load->model ( "main_model" );
		$data ["survey_data"] = $this->main_model->fetch_single_data ($survey_id);
		$data ["fetch_links"] = $this->main_model->fetch_links ($survey_id);
		$data ["languages_data"] = $this->main_model->fetch_languages();
		$this->load->view ( "header" );
		$this->load->view ( "links", $data );
		$this->load->view ( "footer" );
	}
	public function delete_data() {
		$id_survey = $this->uri->segment ( 3 );
		$id_link = $this->uri->segment ( 4 );
		$this->load->model ( "main_model" );
		$this->main_model->delete_link( $id_link );
		$data ["survey_data"] = $this->main_model->fetch_single_data ($id_survey);
		$data ["fetch_links"] = $this->main_model->fetch_links ($id_survey);
		$data ["languages_data"] = $this->main_model->fetch_languages();
		$this->load->view ( "header" );
		$this->load->view ( "links", $data );
		$this->load->view ( "footer" );
	}
	public function update_data() {
		$survey_id = $this->uri->segment ( 3 );
		$link_id = $this->uri->segment ( 4 );
		$this->load->model ( "main_model" );
		$data ["survey_data"] = $this->main_model->fetch_single_data ($survey_id);
		$data ["link_data"] = $this->main_model->fetch_single_link ($link_id);
		$data ["fetch_links"] = $this->main_model->fetch_links ($survey_id);
		$data ["languages_data"] = $this->main_model->fetch_languages();
		$this->load->view ( "header" );
		$this->load->view ( "links", $data );
		$this->load->view ( "footer" );
	}
	public function updated() {
		$id_survey = $this->uri->segment ( 3 );
		$this->load->model ( "main_model" );
		$data ["survey_data"] = $this->main_model->fetch_single_data ($id_survey);
		$data ["fetch_links"] = $this->main_model->fetch_links ($id_survey);
		$data ["languages_data"] = $this->main_model->fetch_languages();
		$this->load->view ( "header" );
		$this->load->view ( "links", $data );
		$this->load->view ( "footer" );
	}
}