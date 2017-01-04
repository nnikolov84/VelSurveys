<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Comments extends MY_Controller {
	protected $access = "Admin";
	// functions
	public function index() {
		$this->load->view ( "header" );
		$link_id = $this->uri->segment ( 3 );
		$this->load->model ( "main_model" );
		$data ["link_data"] = $this->main_model->fetch_single_data ($link_id);
		$data ["fetch_comments"] = $this->main_model->fetch_links ($link_id);
		$this->load->view ( "comments", $data );
		$this->load->view ( "footer" );
	}	
	public function form_validation() {
		// echo 'OK';
		$this->load->library ( 'form_validation' );
		$this->form_validation->set_rules ( "publish_date", "Publish Date", 'required|date' );
		$this->form_validation->set_rules ( "author", "Author", 'required' );
		$this->form_validation->set_rules ( "content", "Content", 'required' );
		$this->form_validation->set_rules ( "id_language", "Language", 'required' );
		$this->form_validation->set_rules ( "yn_relevant", "Relevant", 'required' );
		$this->form_validation->set_rules ( "id_sentiment", "Sentiment", 'required' );
		if ($this->form_validation->run ()) {
			// true
			$this->load->model ( "main_model" );
			
			if ($this->input->post ( "update" )) {
				$data = array (
						"publish_date" => $this->input->post ( "publish_date" ),
						"author" => $this->input->post ( "author" ),
						"content" => $this->input->post ( "content" ),
						"id_language" => $this->input->post ( "id_language" ),
						"yn_relevant" => $this->input->post ( "yn_relevant" ),
						"id_sentiment" => $this->input->post ( "id_sentiment" ),
						"last_updated_by" => $this->session->userdata ( "username" ),
						"last_update_Date" => date ( 'Y-m-d H:i:s' ) 
				);
				
				$this->main_model->update_link ( $data, $this->input->post ( "id_link" ) );
				redirect ( base_url () . "index.php/links/updated/".$this->input->post ( "id_survey" ) );
			}
			if ($this->input->post ( "insert" )) {
				$data = array (
						"publish_date" => $this->input->post ( "publish_date" ),
						"author" => $this->input->post ( "author" ),
						"content" => $this->input->post ( "content" ),
						"id_language" => $this->input->post ( "id_language" ),
						"yn_relevant" => $this->input->post ( "yn_relevant" ),
						"id_sentiment" => $this->input->post ( "id_sentiment" ),
						"last_updated_by" => $this->session->userdata ( "username" ),
						"last_update_Date" => date ( 'Y-m-d H:i:s' ),
						"created_by" => $this->session->userdata ( "username" ) 
				);
				
				$this->main_model->insert_comment ( $data );
				redirect ( base_url () . "index.php/comments/inserted/".$this->input->post ( "id_link" ) );
			}
		} else {
			// false
			$this->index ();
		}
	}
	public function inserted() {
		$link_id = $this->uri->segment ( 3 );
		$this->load->model ( "main_model" );
		$data ["link_data"] = $this->main_model->fetch_single_data ($link_id);
		$data ["fetch_comments"] = $this->main_model->fetch_links ($link_id);
		$this->load->view ( "header" );
		$this->load->view ( "comments", $data );
		$this->load->view ( "footer" );
	}
	public function delete_data() {
		$id_link = $this->uri->segment ( 3 );
		$id_comment = $this->uri->segment ( 4 );
		$this->load->model ( "main_model" );
		$this->main_model->delete_comment( $id_comment );
		$data ["link_data"] = $this->main_model->fetch_single_link ($id_link);
		$data ["fetch_comments"] = $this->main_model->fetch_comments($id_link);
		$this->load->view ( "header" );
		$this->load->view ( "comments", $data );
		$this->load->view ( "footer" );
	}
	public function update_data() {
		$survey_id = $this->uri->segment ( 3 );
		$link_id = $this->uri->segment ( 4 );
		$this->load->model ( "main_model" );
		$data ["link_data"] = $this->main_model->fetch_single_link ($link_id);
		$data ["comment_data"] = $this->main_model->fetch_single_link ($comment_id);
		$data ["fetch_comments"] = $this->main_model->fetch_links ($link_id);
		$this->load->view ( "header" );
		$this->load->view ( "links", $data );
		$this->load->view ( "footer" );
	}
	public function updated() {
		$link_id = $this->uri->segment ( 3 );
		$this->load->model ( "main_model" );
		$data ["link_data"] = $this->main_model->fetch_single_data ($link_id);
		$data ["fetch_comments"] = $this->main_model->fetch_links ($link_id);
		$this->load->view ( "header" );
		$this->load->view ( "links", $data );
		$this->load->view ( "footer" );
	}
}