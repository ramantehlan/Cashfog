<div class='box_body dark_box_body'>
 	  <div class="box_body_top">
 	     	<div class="box_heading">
 	    	 	<img src="<?php echo image_icon; ?>import_white.png" > Import Data
 	    	</div>
 	  </div>
 	  <div class='box_data'>


 	  	  
 	 		 <form method="post" enctype="multipart/form-data" action="<?php echo action_app; ?>upload_imported_data.php" id="import_form">
				<div id="import_progress_bar">
						<div class="progress-label">0% uploaded</div>
				</div>	

					<div class='error_box import_error'></div>
					<div class='success_box import_success'></div>

						<input type="file" name="data_file" id="data_file" class="input import_input">

						<input type="submit" class="action_button import_submit" id="submit_data" value="SUBMIT">

	  		 </form>
			 <div class='test_area'></div>
	  	 

 	  </div>	
</div>