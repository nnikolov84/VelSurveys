<?php  
 class Main_model extends CI_Model  
 {  
      function test_main()  
      {  
           echo "This is model function";  
      }  
      function insert_data($data)  
      {  
           $this->db->insert("tbl_surveys", $data);  
      }  
      function fetch_data()  
      {  
           //$query = $this->db->get("tbl_surveys");  
           //select * from tbl_surveys  
           //$query = $this->db->query("SELECT * FROM tbl_surveys ORDER BY id_survey DESC");  
           $this->db->select("*");  
           $this->db->from("tbl_surveys");
           $this->db->order_by("id_survey DESC");
           $query = $this->db->get();  
           return $query;  
      }  
      function delete_data($id_survey){  
           $this->db->where("id_survey", $id_survey);  
           $this->db->delete("tbl_surveys");  
           //DELETE FROM tbl_surveys WHERE id_survey = $id_survey  
      }  
      function fetch_single_data($id_survey)  
      {  
           $this->db->where("id_survey", $id_survey);  
           $query = $this->db->get("tbl_surveys");  
           return $query;  
           //Select * FROM tbl_surveys where id_survey = '$id_survey'  
      }  
      function update_data($data, $id_survey)  
      {  
           $this->db->where("id_survey", $id_survey);  
           $this->db->update("tbl_surveys", $data);  
           //UPDATE tbl_surveys SET first_name = '$first_name', last_name = '$last_name' WHERE id_survey = '$id_survey'  
      }  
///////////// LINKS  ///////////////////
      function fetch_links($id_survey)
      {
      	$this->db->select("A.*, B.description as cource_desc, IFNULL(C.comments_count,'0') as comments_count");
      	$this->db->from("tbl_links as A");
		$this->db->join("tbl_dim_sources as B", "B.id_source = A.id_source", "LEFT");
		$this->db->join("(select count(*) as comments_count, id_link from tbl_comments
							group by id_link) as C","C.id_link = A.id_link", "LEFT");
      	$this->db->where("A.id_survey", $id_survey);
      	$this->db->order_by("A.id_link DESC");
      	$query = $this->db->get();
      	return $query;
      }  
      function fetch_single_link($id_link)
      {
      	$this->db->select("*");
      	$this->db->from("tbl_links");
      	$this->db->where("id_link", $id_link);
      	$query = $this->db->get();
      	return $query;
      }
      function update_link($data, $id_link)  
      {  
           $this->db->where("id_link", $id_link);  
           $this->db->update("tbl_links", $data);  
           //UPDATE tbl_surveys SET first_name = '$first_name', last_name = '$last_name' WHERE id_survey = '$id_survey'  
      }  
      function insert_link($data)  
      {  
           $this->db->insert("tbl_links", $data);  
      }  
      function delete_link($id_link){  
           $this->db->where("id_link", $id_link);  
           $this->db->delete("tbl_links");  
           //DELETE FROM tbl_surveys WHERE id_survey = $id_survey  
      } 
///////////// COMMENTS  ///////////////////
      function fetch_comments($id_link)
      {
      	$this->db->select("*");
      	$this->db->from("tbl_comments");
      	$this->db->where("id_link", $id_link);
      	$this->db->order_by("id_comment DESC");
      	$query = $this->db->get();
      	return $query;
      }
      function fetch_single_comment($id_comment)
      {
      	$this->db->select("*");
      	$this->db->from("tbl_comments");
      	$this->db->where("id_comment", $id_comment);
      	$query = $this->db->get();
      	return $query;
      }
      function fetch_comments_count($id_link)
      {
      	$this->db->select("count(1) as comments_count");
      	$this->db->from("tbl_comments");
      	$this->db->where("id_link", $id_link);
      	$query = $this->db->get();
      	return $query;
      }
      function update_comment($data, $id_comment)
      {
      	$this->db->where("id_comment", $id_comment);
      	$this->db->update("tbl_comments", $data);
      	//UPDATE tbl_surveys SET first_name = '$first_name', last_name = '$last_name' WHERE id_survey = '$id_survey'
      }
      function insert_comment($data)
      {
      	$this->db->insert("tbl_comments", $data);
      }
      function delete_comment($id_comment){
      	$this->db->where("id_comment", $id_comment);
      	$this->db->delete("tbl_comments");
      	//DELETE FROM tbl_surveys WHERE id_survey = $id_survey
      }
      ///////////// DIMENSIONS  ///////////////////
      function fetch_sentiments()
      {
      	$this->db->select("*");
      	$this->db->from("tbl_dim_sentiments");
      	$this->db->order_by("order_by");
      	$query = $this->db->get();
      	return $query;
      }
      function fetch_sentiment_id($sentiment)
      {
      	$this->db->select("id_sentiment");
      	$this->db->from("tbl_dim_sentiments");
      	$this->db->where("description", $sentiment);
      	$query = $this->db->get();
      	return $query;
      }
      function fetch_languages()
      {
      	$this->db->select("*");
      	$this->db->from("tbl_dim_languages");
      	$this->db->order_by("order_by");
      	$query = $this->db->get();
      	return $query;
      }
      function fetch_language_id($language)
      {
      	$this->db->select("id_language");
      	$this->db->from("tbl_dim_languages");
      	$this->db->where("description", $language);
      	$query = $this->db->get();
      	return $query;
      }
      function fetch_source_id_from_link($link)
      {
      	$this->db->select("id_source");
      	$this->db->from("tbl_dim_sources");
      	$this->db->where("'$link' LIKE CONCAT('%',string,'%')");
      	$query = $this->db->get();
      	return $query;
      }
      function fetch_source_id($source)
      {
      	$this->db->select("id_source");
      	$this->db->from("tbl_dim_sources");
      	$this->db->where("description", $source);
      	$query = $this->db->get();
      	return $query;
      }
 } 