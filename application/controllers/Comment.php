<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	class Comment extends MY_Controller {
		protected $access = "Admin";
		// functions
		public function index() {
			$id_comment = $this->input->get("id_comment");
			$id_survey = $this->input->get("id_survey");
			$this->load->model ( "main_model" );
			$data ["survey_data"] = $this->main_model->fetch_single_data($id_survey);
			if ($id_comment != -1 and $id_comment !="") {
			$data ["comment_data"] = $this->main_model->fetch_single_comment($id_comment);
			}
			$data ["sentiments_data"] = $this->main_model->fetch_sentiments();
			$data ["languages_data"] = $this->main_model->fetch_languages();
			$this->load->view ( "comment", $data);
		}
	}