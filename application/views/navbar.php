<nav class="navbar navbar-default">
  <div class="container">
    	<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
	      	</button>
		</div>  
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php if($this->uri->segment(1)=="dashboard"){echo 'class="active"';}?>><a href="<?php echo site_url('dashboard') ?>">Dashboard<span class="sr-only">(current)</span></a></li>
        <li <?php if($this->uri->segment(1)=="surveys"){echo 'class="active"';}?>><a href="<?php echo site_url("surveys") ?>" >Surveys<span class="sr-only">(current)</span></a></li>
         </ul>
      <ul class="nav navbar-nav navbar-right">		        
		<li><a href="<?php echo site_url("auth/logout") ?>">logout</a></li> 
	  </ul>
    </div>
  </div>
</nav>