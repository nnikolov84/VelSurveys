<div class="container main">
	<div class="well">
<?php 
foreach ( $link_data->result () as $row ) {
	?>  	
 <div class="form-group">
				<label>Link</label> <label class="form-control"><?php echo $row->link; ?></label>
			</div>
			<div class="form-group">
				<label>Content</label>
				<textarea name="content" class="form-control" disabled><?php echo $row->content; ?></textarea>
				<span class="text-danger"><?php echo form_error("content"); ?></span>
			</div>
			<div class="row">

				<div class="col-sm-4 form-group">
					<label>Language</label> <label class="form-control"><?php echo $row->id_language; ?></label>
				</div>

				<div class="col-sm-4 form-group">
					<label>Publish date</label> <label class="form-control"><?php echo $row->publish_date; ?></label>  
           </div>
				<div class="col-sm-4 form-group">
					<label>Author</label> <input type="text" name="author"
						value="<?php echo $row->author; ?>" class="form-control" /> <span
						class="text-danger"><?php echo form_error("author"); ?></span>
				</div>
			</div>
			<div class="form-group" align="right">
				<input type="hidden" name="id_link" value="<?php echo $row->id_link; ?>" /> 
				<input type="hidden" name="id_survey" value="<?php echo $row->id_survey; ?>" /> <input
					type="submit" name="update" value="Update" class="btn btn-info" />
			</div>
	</div>
<?php }?>
<!-- NAVIGATION TABS -->
	<ul class="nav nav-tabs">
		<li class="active"><a href="#link" data-toggle="tab"
			aria-expanded="false">Link</a></li>
		<li class=""><a href="#comments" data-toggle="tab"
			aria-expanded="true">Comments</a></li>
	</ul>
	<div id="myTabContent" class="tab-content">
		<div class="tab-pane fade active in" id="link">
			<!-- comment data area --------------------------------------------------------------------------------------->
			<form method="post" class="form-horizontal"
				action="<?php echo base_url()?>index.php/Links/form_validation">  

		
           <?php
											if ($this->uri->segment ( 2 ) == "inserted") {
												echo '<p class="text-success">Data Inserted</p>';
											}
											if ($this->uri->segment ( 2 ) == "updated") {
												echo '<p class="text-success">Data Updated</p>';
											}
											?>  
  		<fieldset>
					<legend> </legend>
					<input type="hidden" name="id_survey"
						value="<?php echo $this->uri->segment (3);?>" />

					<div class="form-group">
						<label class="col-lg-1 control-label">Relevant</label>
						<div class="col-lg-2">
							<div class="radio">
								<label> <input type="radio" name="optionsRadios"
									id=rb_relevant_y value="Y">Yes
								</label>
							</div>
							<div class="radio">
								<label> <input type="radio" name="optionsRadios"
									id="rb_relevant_n" value="N">No
								</label>
							</div>
						</div>
					</div>
					<hr></hr>
					<div class="form-group">
						<label class="col-lg-1 control-label">Sentiment</label>
						<div class="col-lg-2">
			 <?php
				foreach ( $sentiments_data->result () as $snt_row ) {
					?> 	
						    <div class="radio">
								<label> <input type="radio" name="optionsRadios1"
									id=<?php echo 'rb_sent_'+$snt_row->id_sentiment;?>
									value="<?php echo $snt_row->id_sentiment;?>"><?php echo $snt_row->description;?>
								</label>
							</div>
				<?php
				}
				?>
						</div>
					</div>
					<hr></hr>
					<div class="form-group">
						<label class="col-lg-1 control-label">Published</label>
						<div class="col-lg-2">
							<input type="date" name="publish_date" class="form-control"
								required /> <span class="text-danger"><?php echo form_error("publish_date"); ?></span>
						</div>
					</div>
					<hr></hr>
					<div class="form-group">
						<label for="select" class="col-lg-1 control-label">Language</label>
						<div class="col-lg-2">
							<select class="form-control" id="select">					
			 	<?php
				foreach ( $languages_data->result () as $lng_row ) {
					?> 
				        <option id="<?php echo 'rb_sent_'+$lng_row->id_language;?>"><?php echo $lng_row->description;?></option>
				<?php
				}
				?>
							</select>
						</div>
					</div>
				</fieldset>
			</form>
<!-- comment data area END --------------------------------------------------------------------------------------->
		</div>
		<div class="tab-pane fade" id="comments">
			<form class="form-horizontal">
				<fieldset>
					<legend>Legend</legend>
					<div class="form-group">
						<label for="inputEmail" class="col-lg-2 control-label">Email</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" id="inputEmail"
								placeholder="Email">
						</div>
					</div>
					<div class="form-group">
						<label for="inputPassword" class="col-lg-2 control-label">Password</label>
						<div class="col-lg-10">
							<input type="password" class="form-control" id="inputPassword"
								placeholder="Password">
							<div class="checkbox">
								<label> <input type="checkbox"> Checkbox
								</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="textArea" class="col-lg-2 control-label">Textarea</label>
						<div class="col-lg-10">
							<textarea class="form-control" rows="3" id="textArea"></textarea>
							<span class="help-block">A longer block of help text that breaks
								onto a new line and may extend beyond one line.</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Radios</label>
						<div class="col-lg-10">
							<div class="radio">
								<label> <input type="radio" name="optionsRadios"
									id="optionsRadios1" value="option1" checked=""> Option one is
									this
								</label>
							</div>
							<div class="radio">
								<label> <input type="radio" name="optionsRadios"
									id="optionsRadios2" value="option2"> Option two can be
									something else
								</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="select" class="col-lg-2 control-label">Selects</label>
						<div class="col-lg-10">
							<select class="form-control" id="select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
							</select> <br> <select multiple="" class="form-control">
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-10 col-lg-offset-2">
							<button type="reset" class="btn btn-default">Cancel</button>
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>