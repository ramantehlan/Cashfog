
 	    <div class="top_intro">
 	    		<div class="top_intro_heading">Jobs</div>
 	    		<div class="top_intro_passage">If you want to contribute to making this world a better place then join us and be a part of our team. Being a part of <?php echo app_name; ?> is an amazing experience, here you can create astonishing applications, make mistakes, take risks, explore things and much more. Join only if you are really passionate about making a change. Apply by filling under given form. </div>
 	    </div>

 	    <div class='form_body'>
 	    	<div class="action_block"><img src='<?php echo img_loading; ?>'> </div>
 	    	 <?php 

 	      if(!isset($_COOKIE[$cookie_jobs]))
			{  

			?>
 	    	<span class="form_block">
              <form method="post" action="<?php echo action_site; ?>send_job_request.php" id="form">
              		<div class="error_box"></div>

 	   			<input type="name" placeholder="Name *" id="name" name="name" class="form_input input" maxlength="70" >

 	   			<input type="email" placeholder="Email *" id="email" name="email" class="form_input input" maxlength="255">

 	   			<div class='service_row'>
 	   					<div class="service_row_question single_line_question">
 	   							What is your qualification? *
 	   					</div>
 	   					<select type="response" id="response_1" name="response_1" class="service_row_select">
 	   						  
 	   						            <option value="">Select your response</option>
                                        <option value="q1">Computer science and MBA</option>
                                        <option value="q2">M-TECH and MBA</option>
                                        <option value="q3">MBA</option>
                                        <option value="q4">Computer science</option>
                                        <option value="q5">M-TECH</option>
                                        <option value="q6">Phd in computer science</option>
                                        <option value="q7">Qualification Not Listed</option>
                                        <option value="q8">I have knowledge but not qualification</option>


 	   					</select>
 	   			</div>

 	   			<div class='service_row'>
 	   					<div class="service_row_question single_line_question">
 	   							How much experienced? *
 	   					</div>
 	   					<select type="response" id="response_2" name="response_2" class="service_row_select">
 	   						<option selected value="">Select your response</option>
 	   						<option value="e1">1-3 Years</option>
                            <option value="e2">4-6 Years</option>
                            <option value="e3">7-9 Years</option>
                            <option value="e4">10-12 Years</option>
                            <option value="e5">12 above</option>
                            <option value="e6">No Experience</option>
 	   					</select>
 	   			</div>

 	   			<textarea id="answer" class="form_input form_textarea input" name="answer" placeholder="Why should we hire you?"></textarea>

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
			   
			   			action.html('You have already submitted a Job request. you can request again after 1 week.');
					
					</script>
					";


 	   	  }

 	   	  ?>
 	    </div>
 	    
