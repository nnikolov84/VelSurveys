<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Link_details extends MY_Controller {
	protected $access = "Admin";
	// functions
	public function index() {
		$this->load->view ( "header" );
//		$this->load->view ("navbar");
		$survey_id = $this->uri->segment ( 3 );
		$link_id = $this->uri->segment ( 4 );
		$this->load->model ( "main_model" );
		$data ["survey_data"] = $this->main_model->fetch_single_data ($survey_id);
		$data ["link_data"] = $this->main_model->fetch_single_link ($link_id);
		$data ["comments_data"] = $this->main_model->fetch_comments ($link_id);
		$data ["sentiments_data"] = $this->main_model->fetch_sentiments();
		$data ["languages_data"] = $this->main_model->fetch_languages();
		$this->load->view ( "link_details", $data);
		$this->load->view ( "footer" );
	}	
	public function update_link() {
			$this->load->model ( "main_model" );
				$data = array (
						"id_survey" => $this->input->post ( "id_survey" ),
						"id_language" => $this->main_model->fetch_language_id($this->input->post ( "language" ))->row()->id_language,
						"id_source" =>  $this->input->post ( "id_source" ),
						"id_sentiment" =>  $this->input->post ( "id_sentiment" ),
						"yn_relevant" =>  $this->input->post ( "yn_relevant" ),
						"content" => $this->input->post ( "content" ),
						"content_translated" => $this->input->post ( "content_translated" ),
						"link" => $this->input->post ( "link" ),
						"comment" => $this->input->post ( "comment" ),
						"author" => $this->input->post ( "author" ),
						"publish_date" => $this->input->post ( "publish_date" ),
						"last_updated_by" => $this->session->userdata ( "username" ),
						"last_update_Date" => date ( 'Y-m-d H:i:s' )
				);
	
				$this->main_model->update_link ( $data, $this->input->post ( "id_link" ) );
				if ($this->input->post ( "update" )) {
				redirect ( base_url () . "index.php/link_details/index/".$this->input->post ( "id_survey" )."/".$this->input->post ( "id_link" ) );
				} else {
				redirect ( base_url () . "index.php/links/index/".$this->input->post ( "id_survey" ));
				}
			}
			
// form validatiob
			public function form_validation() {
				// echo 'OK';
				$this->load->library ( 'form_validation' );
				$this->form_validation->set_rules ( "content", "Content");
				if ($this->form_validation->run ()) {
					// true
					$this->load->model ( "main_model" );
					
					if ($this->input->post ( "update" )) {
						$data = array (
								"id_link" =>  $this->input->post ( "id_link" ),
								"id_language" => $this->main_model->fetch_language_id($this->input->post ( "language" ))->row()->id_language,
								"id_sentiment" =>  $this->input->post ( "id_sentiment" ),
								"yn_relevant" =>  $this->input->post ( "yn_relevant" ),
								"content" => $this->input->post ( "content" ),
								"content_translated" => $this->input->post ( "content_translated" ),
								"author" => $this->input->post ( "author" ),
								"publish_date" => $this->input->post ( "publish_date" ),
								"last_updated_by" => $this->session->userdata ( "username" ),
								"last_update_Date" => date ( 'Y-m-d H:i:s' )
						);
			
						$this->main_model->update_comment ( $data, $this->input->post ( "id_comment" ) );
						redirect ( base_url () . "index.php/link_details/index/".$this->input->post ( "id_survey" )."/".$this->input->post ( "id_link" )."/".$this->input->post ( "id_comment" ) );
						}
					if ($this->input->post ( "insert" )) {
						$data = array (
								"id_link" =>  $this->input->post ( "id_link" ),
								"id_language" => $this->main_model->fetch_language_id($this->input->post ( "language" ))->row()->id_language,
								"id_sentiment" =>  $this->input->post ( "id_sentiment" ),
								"yn_relevant" =>  $this->input->post ( "yn_relevant" ),
								"content" => $this->input->post ( "content" ),
								"content_translated" => $this->input->post ( "content_translated" ),
								"author" => $this->input->post ( "author" ),
								"publish_date" => $this->input->post ( "publish_date" ),
								"last_updated_by" => $this->session->userdata ( "username" ),
								"last_update_Date" => date ( 'Y-m-d H:i:s' ),
								"created_by" => $this->session->userdata ( "username" ),
								"creation_Date" => date ( 'Y-m-d H:i:s' )
						);
			
						$this->main_model->insert_comment ( $data );
						redirect ( base_url () . "index.php/link_details/index/".$this->input->post ( "id_survey" )."/".$this->input->post ( "id_link" ) );
						}
				} else {
					// false
					$this->index ();
				}
			}
				
	
	
}