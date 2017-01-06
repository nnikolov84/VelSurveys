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
		<li class=""><a href="#link" data-toggle="tab"
			aria-expanded="false">Link</a></li>
		<li class="active"><a href="#comments" data-toggle="tab"
			aria-expanded="true">Comments</a></li>
		<li class=""><a href="#test" data-toggle="tab"
			aria-expanded="true">Test</a></li>
	</ul>
	<div id="myTabContent" class="tab-content">
		<div class="tab-pane fade in well" id="link">
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
		<div class="tab-pane fade active in" id="comments">
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
					<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="col-lg-2 control-label">Sentiment</label>
									<div class="col-lg-4">
	<?php foreach ( $sentiments_data->result () as $snt_row ) { ?> 	
						    <div class="radio">
											<label> <input type="radio" name="id_sentiment"
												id=<?php echo 'rb_sent_'+$snt_row->id_sentiment;?>
												value="<?php echo $snt_row->id_sentiment;?>"><?php echo $snt_row->description;?>
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
										<input type="text" name="author" class="form-control" /> <span
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
										        ><?php echo $lng_row->description;?></option>
							<?php }	?>
							</select>
									</div>
								</div>
							</div>				
							<div class="col-sm-6 row">
								<label>Content</label>
								<textarea rows="10" name="content" class="form-control content_txt"></textarea>
								<span class="text-danger"><?php echo form_error("content"); ?></span>
							</div>
							<div class="col-sm-6 row">
								<label>Translation</label>
								<textarea rows="10" name="content_translated" class="form-control"></textarea>
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
						<input type="submit" name="insert" value="Insert" class="btn btn-info" />
					</div>
				</fieldset>
									
	</form>		
	
	
	 <div class="bs-docs-example">
           <p class="pgn pgn_bottom"></p>
     </div>
</div>
                   


                    <script type="text/javascript">
				$('.pgn_bottom').bootpag({
                            total: <?php echo count($comments_data->result ())?>,
                            page: 1,
                            maxVisible: 5,
                            leaps: true,
                            firstLastUse: true,
                            first: '<span aria-hidden="true">&larr;</span>',
                            last: '<span aria-hidden="true">&rarr;</span>',
                            wrapClass: 'pagination',
                            activeClass: 'active',
                            disabledClass: 'disabled',
                            nextClass: 'next',
                            prevClass: 'prev',
                            lastClass: 'last',
                            firstClass: 'first'
                        }).on("page", function(event, num){
                       //     $(".content4").load("<?php echo base_url(); ?>assets/html/comment.php?ID="+num);
                            $(".content_txt").text("test"<?php echo test?>);
                            }).find('.pagination');

                        
                    </script>  

<div class="tab-pane fade  in" id="test">	

 <table class="table table-bordered">  
 <tr align="center">                                  
<?php foreach ($comments_data->result () as $com_row) { ?>	
     <th class="btn btn" onclick="updComment(<?php echo $com_row->id_comment;?>);"><?php echo $com_row->id_comment;?></th> 
<?php } ?>
<th class="btn btn-info">*</th>	
  </tr>
 </table>               
                    <h2 id="example-full">Full example</h2>
                    <div class="bs-docs-example">
                        <p class="demo demo4_top"></p>
                        <p class="well demo content4">
                            Dynamic content here.
                        </p>
                        <p class="demo demo4_bottom"></p>
                    </div>


                    <script type="text/javascript">
                    function updComment(id_comment) {
                    	 $(".content4").load("<?php echo base_url(); ?>index.php/editor?ID="+id_comment);
                        return false;
                    }


                    
				$('.demo4_top,.demo4_bottom').bootpag({
                            total: 50,
                            page: 1,
                            maxVisible: 5,
                            leaps: true,
                            firstLastUse: true,
                            first: '<span aria-hidden="true">&larr;</span>',
                            last: '<span aria-hidden="true">&rarr;</span>',
                            wrapClass: 'pagination',
                            activeClass: 'active',
                            disabledClass: 'disabled',
                            nextClass: 'next',
                            prevClass: 'prev',
                            lastClass: 'last',
                            firstClass: 'first'
                        }).on("page", function(event, num){
                       //     $(".content4").load("<?php echo base_url(); ?>assets/html/comment.php?ID="+num);
                            $(".content4").load("<?php echo base_url(); ?>index.php/editor?ID="+num);
                            }).find('.pagination');

                        
                    </script>                  
                         
</div>
</div>
	<?php }?>	
</div>