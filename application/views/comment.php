<?php
if (isset ( $comment_data )) {
	foreach ( $comment_data->result () as $com_row ) {
		?>
<div class="row">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="col-lg-2 control-label">Sentiment</label>
			<div class="col-lg-4">
	<?php foreach ( $sentiments_data->result () as $snt_row ) { ?> 	
						    <div class="radio">
					<label> <input type="radio" name="id_sentiment"
						id=<?php echo 'rb_sent_'+$snt_row->id_sentiment;?>
						value="<?php echo $snt_row->id_sentiment;?>"
						<?php echo ($com_row->id_sentiment==$snt_row->id_sentiment)?'checked':'' ?>><?php echo $snt_row->description;?>
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
					value="<?php if($com_row->publish_date <> "0000-00-00") echo $com_row->publish_date; ?>"
					min="<?php echo$srv_row->start_date;?>"
					max="<?php echo$srv_row->end_date;?>" /> <span class="text-danger"><?php echo form_error("publish_date"); ?></span>
					<?php } ?> 		 
					</div>
		</div>
		<hr></hr>
		<div class="form-group">
			<label class="col-lg-2 control-label">Author</label>
			<div class="col-lg-5">
				<input type="text" name="author"
					value="<?php echo $com_row->author; ?>" class="form-control" /> <span
					class="text-danger"><?php echo form_error("author"); ?></span>
			</div>
		</div>
		<hr></hr>
		<div class="form-group">
			<label for="select" class="col-lg-2 control-label">Language</label>
			<div class="col-lg-5">
				<select class="form-control" id="select" name="language">					
							<?php foreach ( $languages_data->result () as $lng_row ) { ?> 
										        <option
						id="<?php echo 'rb_sent_'+$lng_row->id_language;?>"
						<?=$com_row->id_language == $lng_row->id_language ? ' selected="selected"' : '';?>><?php echo $lng_row->description;?></option>
							<?php }	?>
							</select>
			</div>
		</div>
	</div>
	<div class="col-sm-6 row">
		<label>Content</label>
		<textarea rows="10" name="content" class="form-control"><?php echo $com_row->content; ?></textarea>
		<span class="text-danger"><?php echo form_error("content"); ?></span>
	</div>
	<div class="col-sm-6 row">
		<label>Translation</label>
		<textarea rows="10" name="content_translated" class="form-control"><?php echo $com_row->content_translated; ?></textarea>
		<span class="text-danger"><?php echo form_error("content_translated"); ?></span>
	</div>
</div>
<hr></hr>
						<input type="hidden" name="id_comment" 
							value="<?php echo $com_row->id_comment; ?>" /> 
						<div class="form-group" align="center">
						<input type="submit" name="update" value="Update" class="btn btn-info" />
						</div>
<?php } ?>	
	<?php

} else {
	?>

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
					max="<?php echo$srv_row->end_date;?>" /> <span class="text-danger"><?php echo form_error("publish_date"); ?></span>
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
				<select class="form-control" id="select" name="language">					
							<?php foreach ( $languages_data->result () as $lng_row ) { ?> 
										        <option
						id="<?php echo 'rb_sent_'+$lng_row->id_language;?>"><?php echo $lng_row->description;?></option>
							<?php }	?>
							</select>
			</div>
		</div>
	</div>
	<div class="col-sm-6 row">
		<label>Content</label>
		<textarea rows="10" name="content" class="form-control"></textarea>
		<span class="text-danger"><?php echo form_error("content"); ?></span>
	</div>
	<div class="col-sm-6 row">
		<label>Translation</label>
		<textarea rows="10" name="content_translated" class="form-control"></textarea>
		<span class="text-danger"><?php echo form_error("content_translated"); ?></span>
	</div>
</div>
<hr></hr>
					<div class="form-group" align="center">
						<input type="submit" name="insert" value="Insert" class="btn btn-info" />
					</div>

<?php }?>						