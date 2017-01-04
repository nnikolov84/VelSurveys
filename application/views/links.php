<div class="container main">
	<div class="page-header">
		<h1>Links</h1>
	</div>
<?php
foreach ( $survey_data->result () as $row ) {
	?>
	<div class="well">
		<div class="form-group">
			<!--div class="lead">Project</div-->
			<div class="row">
				<div class="col-sm-8">
					<h3><?php echo $row->name; ?></h3>
				</div>
				<div class="col-sm-2">
					<h3><?php echo date('d.m.Y', strtotime($row->start_date)); ?></h3>
				</div>
				<div class="col-sm-2">
					<h3><?php if($row->end_date <> "0000-00-00") { echo date('d.m.Y', strtotime($row->end_date)); } ?></h3>
				</div>
			</div>
		</div>
	</div>
<?php
}
?>
           
	<div class="well">
		<form method="post"
			action="<?php echo base_url()?>index.php/Links/form_validation">  
           <?php
											if ($this->uri->segment ( 2 ) == "inserted") {
												echo '<p class="text-success">Data Inserted</p>';
											}
											if ($this->uri->segment ( 2 ) == "updated") {
												echo '<p class="text-success">Data Updated</p>';
											}
											?>  
           <?php
if (isset ( $link_data )) {
foreach ( $link_data->result () as $row ) {
	?>  
           <div class="form-group">
				<label>Link</label> <input type="url" name="link"
					value="<?php echo $row->link; ?>" class="form-control" required />
				<span class="text-danger"><?php echo form_error("link"); ?></span>
			</div>
			<div class="form-group">
				<label>Content</label>
				<textarea name="content" class="form-control" required><?php echo $row->content; ?></textarea>
				<span class="text-danger"><?php echo form_error("content"); ?></span>
			</div>
			<div class="row">

				<div class="col-sm-4 form-group">
					<label>Language</label> <select class="form-control" name="language" required>			
			 	<?php
						if (isset ( $languages_data )) {
						 foreach ( $languages_data->result () as $lng_row ) 
						 {
						?> 
				        <option id="<?php echo 'rb_sent_'+$lng_row->id_language;?>"
							<?php echo set_select('add_fields_type','text', ( !empty($row->id_language) && $row->id_language == $lng_row->id_language ? TRUE : FALSE ))?>>
							<?php echo $lng_row->description;?></option>
				<?php
					}
					}
					?>			
					</select>
				</div>

				<div class="col-sm-4 form-group">
					<label>Publish date</label> 
                <?php
													foreach ( $survey_data->result () as $srv_row ) {
														?> 
                <input type="date" name="publish_date"
						class="form-control" value="<?php echo $row->publish_date;?>"
						min="<?php echo$srv_row->start_date;?>"
						max="<?php echo$srv_row->end_date;?>" required /> <span
						class="text-danger"><?php echo form_error("publish_date"); ?></span> 
                <?php
													}
													?>    
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
           <?php
		}
		} else {
		?>  
           <input type="hidden" name="id_survey"
				value="<?php echo $this->uri->segment (3);?>" />
			<div class="form-group">
				<label>Link</label> <input type="url" name="link"
					class="form-control" required /> <span class="text-danger"><?php echo form_error("link"); ?></span>
			</div>
			<div class="form-group">
				<label>Content</label>
				<textarea name="content" class="form-control" required></textarea>
				<span class="text-danger"><?php echo form_error("content"); ?></span>
			</div>
			<div class="row">

				<div class="col-sm-4 form-group">
					<label>Language</label> <select class="form-control" name="language" required>
					<option></option>								
			 	<?php
					foreach ( $languages_data->result () as $lng_row ) {
					?> 
				        <option id="<?php echo 'rb_sent_'+$lng_row->id_language;?>"><?php echo $lng_row->description;?></option>
				<?php
				}
				?>			
					</select> <span class="text-danger"><?php echo form_error("language"); ?></span>
					<script type="text/javascript">
				$("#language").change(function() {
  				var product_code = $("#language").val();
 				 </script>

				</div>

				<div class="col-sm-4 form-group">
					<label>Publish date</label> 
                <?php
	foreach ( $survey_data->result () as $srv_row ) {
	?> 
                <input type="date" name="publish_date"
						class="form-control" value="<?php echo$srv_row->start_date;?>"
						min="<?php echo$srv_row->start_date;?>"
						max="<?php echo$srv_row->end_date;?>" required /> <span
						class="text-danger"><?php echo form_error("publish_date"); ?></span> 
                <?php
												}
												?>    
           </div>
				<div class="col-sm-4 form-group">
					<label>Author</label> <input type="text" name="author"
						class="form-control" /> <span class="text-danger"><?php echo form_error("author"); ?></span>
				</div>
			</div>
			<div class="form-group" align="right">
				<input type="submit" name="insert" value="Insert"
					class="btn btn-info" />
			</div> 
                 
           <?php
											}
											?>  
      </form>
		<br />
		<br />
		<div class="table-responsive">
			<table class="table table-bordered">
				<tr>
					<th>ID</th>
					<th>Source</th>
					<th>Link</th>
					<th>Comments</th>
					<th>Publish date</th>
					<th>Author</th>
					<th>Delete</th>
					<th>Update</th>
				</tr>  
           <?php
											if ($fetch_links->num_rows () > 0) {
												foreach ( $fetch_links->result () as $row ) {
													?>  
                <tr>
					<td><?php echo $row->id_link; ?></td>
					<td><?php echo $row->cource_desc; ?></td>
					<td><a href="<?php echo $row->link; ?>" target="_blank">Link</a></td>
					<td>
					<a href="<?php echo base_url(); ?>index.php/link_details/index/<?php echo $row->id_survey; ?>/<?php echo $row->id_link; ?>"><?php echo $row->comments_count; ?></a></td>
					<td><?php echo date('d.m.Y', strtotime($row->publish_date)); ?></td>
					<td><?php echo $row->author; ?></td>
					<td><a href="#" class="delete_data"
						id="<?php echo $row->id_link; ?>"
						id_survey="<?php echo $row->id_survey; ?>">Delete</a></td>
					<td><a
						href="<?php echo base_url(); ?>index.php/links/update_data/<?php echo $row->id_survey; ?>/<?php echo $row->id_link; ?>">Edit</a></td>
				</tr>  
           <?php
												}
											} else {
												?>  
                <tr>
					<td colspan="5">No Data Found</td>
				</tr>  
           <?php
											}
											?>  
           </table>
		</div>

		<div class="form-group" align="right">
			<button class="btn btn-info"
				onclick="location.href='<?php echo site_url("surveys") ?>'">Close</button>
		</div>

		<script>  
      $(document).ready(function(){  
           $('.delete_data').click(function(){  
                var id_link = $(this).attr("id");  
                var id_survey = $(this).attr("id_survey"); 
                if(confirm("Are you sure you want to delete link "+id_link+"?"))  
                {
                	if(confirm("Чакай, чакай! \n Сигурни ли сте, че искате да изтриете този линк, заедно с всички данни за него? ID: " +id_link))  
                    {  
                		 window.location="<?php echo base_url(); ?>index.php/links/delete_data/"+id_survey+"/"+id_link;  
                    }  
                    else  
                    {  
                        return false; 
               		}      
                }  
                else  
                {  
                     return false;  
                }  
           });
             
      });  
      </script>

	</div>
</div>
