

 	    <div class="top_intro">
 	    		<div class="top_intro_heading">Feedback</div>
 	    		<div class="top_intro_passage">We are trying hard to roll new features to our site but to do so we need your feedback. Let us know that do our services satisfy your need or not and do our services have quality. A team of <?php echo app_name; ?> work to give you best service which should be fast, useful and advance, so we invite your suggestions and ideas for our vision. If we find your suggestion or idea good then we will inform you and we will create it for you and million others. </div>
 	    </div>

 	    <div class='form_body'>
 	    	 <div class="action_block"><img src='<?php echo img_loading; ?>'> </div>
 	    	  <?php 

 	      if(!isset($_COOKIE[$cookie_feedback]))
			{ 
				?>

             <span class="form_block">
              <form method="post" action="<?php echo action_site; ?>send_feedback.php" id="form"> 
               <div class="error_box"></div>

 	   			<input type="name" placeholder="Name *" id="name" name="name" class="form_input input" maxlength="70" >

 	   			<input type="email" placeholder="Email *" id="email" name="email" class="form_input input" maxlength="255">

 	   			<div class='service_row'>
 	   					<div class="service_row_question">
 	   							How would you rate your overall experience with our service? *
 	   					</div>
 	   					<select type="response" id="response_1" name="response_1" class="service_row_select">
 	   						<option selected value="">Select your response</option>
 	   						<option value="sr1">Very Good</option>
 	   						<option value="sr2">Good</option>
 	   						<option value="sr3">Fair</option>
 	   						<option value="sr4">Poor</option>
 	   						<option value="sr5">Very Poor</option>
 	   					</select>
 	   			</div>


 	   			<div class='service_row'>
 	   					<div class="service_row_question">
 	   							How would you rate our prices? *
 	   					</div>
 	   					<select type="response" id="response_2" name="response_2" class="service_row_select">
 	   						<option selected value="">Select your response</option>
 	   						<option value="sr1">Very Good</option>
 	   						<option value="sr2">Good</option>
 	   						<option value="sr3">Fair</option>
 	   						<option value="sr4">Poor</option>
 	   						<option value="sr5">Very Poor</option>
 	   					</select>
 	   			</div>

 	   			<div class='service_row'>
 	   					<div class="service_row_question">
 	   							Would you recommend our product / service to other people? *
 	   					</div>
 	   					<select type="response" id="response_3" name="response_3" class="service_row_select">
 	   						<option selected value="">Select your response</option>
 	   						<option value="sp1">Definitely</option>
 	   						<option value="sp2">Probably</option>
 	   						<option value="sp3">Not Sure</option>
 	   						<option value="sp4">Probably Not</option>
 	   						<option value="sp5">Definitely Not</option>

 	   					</select>
 	   			</div>

 	   			<textarea id="feedback" class="form_input form_textarea input"  name="feedback" placeholder="Feedback"></textarea>

 	   			<div class="g-recaptcha" data-sitekey="6Ld8GSIUAAAAAB8r7pxFEhVy2BNdol0laz9rxVtC"></div>

 	   			<input type="submit" name="submit" value="SUBMIT" class="button form_button" id='form_button'>
 	   			</form>
 	   		  </span>
 	   		 
 	   		    <?php 

 	   	  }
 	   	  else
 	   	  {
 				echo "
					<script type='text/javascript'>
			   			var error  	 = $('.error_box');
					    var action 	 = $('.action_block');
			   			var form_body = $('.form_block'); 
			  
			   			error.hide();
			   			form_body.hide();
			   			action.show();
			   
			   			action.html('You have already submitted a Feedback. you can submit again after 1 week.');
					
					</script>
					";
 	   	  }

 	   	  ?>
 	    </div>



