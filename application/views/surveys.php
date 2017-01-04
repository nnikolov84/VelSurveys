
	<div class="container main">  
 		<div class="page-header">
    		<h1>Surveys</h1>
    	</div>  
	 <div class="well">  
      <form method="post" action="<?php echo base_url()?>index.php/Surveys/form_validation">  
           <?php  
           if($this->uri->segment(2) == "inserted")  
           {  
           //base url - http://localhost/tutorial/codeigniter  
           //redirect url - http://localhost/tutorial/codeigniter/main/inserted  
                //main - segment(1)  
                //inserted - segment(2)  
                echo '<p class="text-success">Data Inserted</p>';  
           }  
           if($this->uri->segment(2) == "updated")  
           {  
                echo '<p class="text-success">Data Updated</p>';  
           }  
           ?>  
           <?php  
           if(isset($user_data))  
           {  
                foreach($user_data->result() as $row)  
                {  
           ?>  
           <div class="form-group">  
                <label>Short name</label>  
                <input type="text" name="name" value="<?php echo $row->name; ?>" class="form-control"   required/>
                <span class="text-danger"><?php echo form_error("name"); ?></span>  
           </div>  
           <div class="form-group">  
                <label>Description</label>
                <textarea name="description" rows="5" class="form-control" required> <?php echo $row->description; ?></textarea> 
                <span class="text-danger"><?php echo form_error("description"); ?></span>  
           </div> 
           <div class="row">
           <div class="col-sm-6">
           <div class="form-group">  
                <label>Start date</label>  
                <input type="date" name="start_date" value="<?php echo $row->start_date; ?>" class="form-control"   required/>  
                <span class="text-danger"><?php echo form_error("start_date"); ?></span>  
           </div> 
           </div>
           <div class="col-sm-6">
           <div class="form-group">  
                <label>End date</label>  
                <input type="date" name="end_date" value="<?php echo $row->end_date; ?>" class="form-control"   required/>  
                <span class="text-danger"><?php echo form_error("end_date"); ?></span>  
           </div> 
           </div> 	
           </div>    	   
           <div class="form-group" align="right">  
                <input type="hidden" name="id_survey" value="<?php echo $row->id_survey; ?>" />  
                <input type="submit" name="update" value="Update" class="btn btn-info" />  
           </div>
              
           <?php       
                }  
           }  
           else  
           {  
           ?>  
           <div class="form-group">  
                <label>Short name</label>  
                <input type="text" name="name" class="form-control"  required/>  
                <span class="text-danger"><?php echo form_error("name"); ?></span>  
           </div>  
           <div class="form-group">  
                <label>Description</label>  
                <textarea name="description" class="form-control" required></textarea> 
                <span class="text-danger"><?php echo form_error("description"); ?></span> 
           </div>  
           <div class="row">
           <div class="col-sm-6">
           <div class="form-group">  
                <label>Start date</label>  
                <input type="date" name="start_date" value="<?php echo date('Y-m-d');?>" class="form-control"  required/>  
                <span class="text-danger"><?php echo form_error("start_date"); ?></span>  
           </div>  
           </div> 
           <div class="col-sm-6">
           <div class="form-group">  
                <label>End date</label>  
                <input type="date" name="end_date" class="form-control"   required/>  
                <span class="text-danger"><?php echo form_error("end_date"); ?></span>  
           </div>  		
           </div> 
           </div>    
           <div class="form-group"align="right">  
                <input type="submit" name="insert" value="Insert" class="btn btn-info" />  
           </div>       
           <?php  
           }  
           ?>  
      </form>  
      <br /><br /> 
      <div class="table-responsive">  
           <table class="table table-bordered">  
                <tr>  
                     <th>ID</th>  
                     <th>Name</th>  
                     <th>Description</th>
                     <th>Start date</th> 
                     <th>End date</th> 					 
                     <th>Delete</th>  
                     <th>Update</th>  
                </tr>  
           <?php  
           if($fetch_data->num_rows() > 0)  
           {  
                foreach($fetch_data->result() as $row)  
                {  
           ?>  
                <tr>  
                     <td><?php echo $row->id_survey; ?></td>  
                     <td><a href="<?php echo base_url(); ?>index.php/surveys/open_links/<?php echo $row->id_survey; ?>"><?php echo $row->name; ?></a></td>  
                     <td><?php echo $row->description; ?></td>
					 <td><?php echo date('d.m.Y', strtotime($row->start_date)); ?></td>
					 <td><?php echo date('d.m.Y', strtotime($row->end_date)); ?></td>					 
                     <td><a href="#" class="delete_data" id="<?php echo $row->id_survey; ?>" survey_name="<?php echo $row->name; ?>">Delete</a></td>  
                     <td><a href="<?php echo base_url(); ?>index.php/surveys/update_data/<?php echo $row->id_survey; ?>">Edit</a></td>  
                </tr>  
           <?php       
                }  
           }  
           else  
           {  
           ?>  
                <tr>  
                     <td colspan="5">No Data Found</td>  
                </tr>  
           <?php  
           }  
           ?>  
           </table>  
      </div>  
      <script>  
      $(document).ready(function(){  
           $('.delete_data').click(function(){  
                var id_survey = $(this).attr("id");  
                var survey_name = $(this).attr("survey_name");
                if(confirm("Are you sure you want to delete this? "+id_survey))  
                { 
                	if(confirm("Чакай, чакай! \n Сигурни ли сте, че искате да изтриете проект  \""+survey_name+"\"  , заедно с всички данни за него?"))  
                    {  
                     window.location="<?php echo base_url(); ?>index.php/surveys/delete_data/"+id_survey;  
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
