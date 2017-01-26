<div class="container main">
<?php
$com_arr = $comments_data->result ();
foreach ( $link_data->result () as $row ) {
	?> 		
	<div class="form-group">
		<label>Link</label> 
		<a href="<?php echo $row->link; ?> " target="_blank">
		<label class="form-control"><?php echo $row->link; ?></label>
		</a>
		<textarea name="comment" class="form-control" disabled><?php echo $row->comment; ?></textarea>

	</div>
	<!-- NAVIGATION TABS -->
	<ul class="nav nav-tabs">
		<li class="active"><a href="#link" data-toggle="tab"
			aria-expanded="false">Link</a></li>
		<li class=""><a href="#comments" data-toggle="tab"
			aria-expanded="true">Comments</a></li>
	</ul>
	<div id="myTabContent" class="tab-content">
		<div class="tab-pane fade in active well" id="link">
			<!-- link data area --------------------------------------------------------------------------------------->		
			<form method="post" class="form-horizontal"
				action="<?php echo base_url()?>index.php/Link_details/update_link">  

		
           <?php
											if ($this->uri->segment ( 2 ) == "updated") {
												echo '<p class="text-success">Data Updated</p>';
											}
											?>  									
<fieldset>
					<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="col-lg-2 control-label">Relevant</label>
									<div class="col-lg-4">
										<div class="radio">
											<label> <input type="radio" name="yn_relevant"
												id=rb_relevant_y value="Y" <?php echo ($row->yn_relevant=='Y')?'checked':'' ?>>Yes
											</label>
										</div>
										<div class="radio">
											<label> <input type="radio" name="yn_relevant"
												id="rb_relevant_n" value="N" <?php echo ($row->yn_relevant=='N')?'checked':'' ?>>No
											</label>
										</div>
									</div>
								</div>
								<hr></hr>
								<div class="form-group">
									<label class="col-lg-2 control-label">Sentiment</label>
									<div class="col-lg-4">
	<?php foreach ( $sentiments_data->result () as $snt_row ) { ?> 	
						    <div class="radio">
											<label> <input type="radio" name="id_sentiment"
												id=<?php echo 'rb_sent_'+$snt_row->id_sentiment;?>
												value="<?php echo $snt_row->id_sentiment;?>"
												<?php echo ($row->id_sentiment==$snt_row->id_sentiment)?'checked':'' ?>><?php echo $snt_row->description;?>
								</label>
										</div>
	<?php }	?>
						</div>
								</div>
								<hr></hr>
								<div class="form-group">
									<label class="col-lg-2 control-label">Published</label>
									<div class="col-lg-5">
									 <?php foreach ( $survey_data->result () as $srv_row ) { ?> 
										<input type="date" name="publish_date" class="form-control"
										value="<?php if($row->publish_date <> "0000-00-00") echo $row->publish_date; ?>"
										min="<?php echo$srv_row->start_date;?>"
										max="<?php echo$srv_row->end_date;?>"
											 /> <span class="text-danger"><?php echo form_error("publish_date"); ?></span>
									 <?php } ?> 		 
						</div>
								</div>
								<hr></hr>
								<div class="form-group">
									<label class="col-lg-2 control-label">Author</label>
									<div class="col-lg-5">
										<input type="text" name="author"
											value="<?php echo $row->author; ?>" class="form-control" /> <span
											class="text-danger"><?php echo form_error("author"); ?></span>
									</div>
								</div>
								<hr></hr>
								<div class="form-group">
									<label for="select" class="col-lg-2 control-label">Language</label>
									<div class="col-lg-5">
										<select class="form-control" id="select"  name="language">					
							<?php foreach ( $languages_data->result () as $lng_row ) { ?> 
										        <option id="<?php echo 'rb_sent_'+$lng_row->id_language;?>"
										        <?=$row->id_language == $lng_row->id_language ? ' selected="selected"' : '';?>><?php echo $lng_row->description;?></option>
							<?php }	?>
							</select>
									</div>
								</div>
							</div>				
							<div class="col-sm-6 row">
								<label>Content</label>
								<textarea rows="10" name="content" class="form-control"><?php echo $row->content; ?></textarea>
								<span class="text-danger"><?php echo form_error("content"); ?></span>
							</div>
							<div class="col-sm-6 row">
								<label>Translation</label>
								<textarea rows="10" name="content_translated" class="form-control"><?php echo $row->content_translated; ?></textarea>
								<span class="text-danger"><?php echo form_error("content_translated"); ?></span>
							</div>
						</div>
					
<hr></hr>
					<div class="form-group col-lg-6" align="right">
						<input type="hidden" name="id_link"
							value="<?php echo $row->id_link; ?>" /> 
						<input type="hidden" name="id_survey" 
							value="<?php echo $row->id_survey; ?>" />
						<input type="hidden" name="id_source" 
							value="<?php echo $row->id_source; ?>" /> 
						<input type="hidden" name="link" 
							value="<?php echo $row->link; ?>" /> 	 
						<input type="submit" name="update" value="Update" class="btn btn-info" />
					</div>
					<div class="form-group col-lg-6" align="right">
						<input type="submit" name="done" value="Done" class="btn btn-info" />
					</div>
				</fieldset>
								
	</form>
</div>
		<!-- link data area END --------------------------------------------------------------------------------------->
		<div class="tab-pane fade in" id="comments">
			<!-- comment data area --------------------------------------------------------------------------------------->


<!-- ---------------------------------------- -->
<form method="post" class="form-horizontal"
				action="<?php echo base_url()?>index.php/Link_details/form_validation">  

		
           <?php
											if ($this->uri->segment ( 2 ) == "updated") {
												echo '<p class="text-success">Data Updated</p>';
											}
											?>  										
<fieldset>
<div class="comm_detail">
</div>
						<input type="hidden" name="id_link"
							value="<?php echo $row->id_link; ?>" /> 
						<input type="hidden" name="id_survey" 
							value="<?php echo $row->id_survey; ?>" />
				</fieldset>
									
	</form>		
<?php $com_arr = $comments_data->result () ?>
	
 <table class="table table-bordered">  
 <tr align="center">                                 
 
<?php 
$com_rn=0;
foreach ($comments_data->result () as $com_row){ 
$com_rn++;
	?>	
     <th class="btn btn comBtn comBtn<?php echo $com_row->id_comment?>" onclick="updComment(<?php echo $com_row->id_comment?>, <?php echo $srv_row->id_survey;?>);"><?php echo $com_rn;?></th> 
<?php } ?>
<th class="btn btn-info" onclick="updComment(-1, <?php echo $srv_row->id_survey;?>);">new</th>	
  </tr>
 </table> 
 
</div>
                   


                    <script type="text/javascript">
                    function updComment(id_comment, id_survey) {
                    $('.comBtn').removeClass('btn-info');
                    $('.comBtn'+id_comment).toggleClass('btn-info');
                    //	$(".comBtn").setAttribute("class", "btn btn-info");   
					 $(".comm_detail").load("<?php echo base_url(); ?>index.php/comment?id_comment="+id_comment+"&id_survey="+id_survey);
                       return false;
                   } 
                    window.onload = function () { 
                    	<?php $id_comment = $this->uri->segment ( 5 ); 
                    	if ($id_comment==null) {$id_comment = -1;}
                    	?>
                        id_comment = <?php echo $id_comment;?>;
                    	$(".comm_detail").load("<?php echo base_url(); ?>index.php/comment?id_comment="+id_comment+"&id_survey="+<?php echo $row->id_survey; ?>);
                    	$('.comBtn').removeClass('btn-info');
                        $('.comBtn'+id_comment).addClass('btn-info');
                    	 }
                    </script>  
</div>
	<?php }?>	
</div>