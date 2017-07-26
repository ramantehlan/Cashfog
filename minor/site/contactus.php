

 	    <div class="top_intro">
 	    		<div class="top_intro_heading">Contact us</div>
 	    		<div class="top_intro_passage"> 
 	    			To contact us you need to fill this form and Our Team will contact you shortly. You can contact us to 
						<ul>
							<li>tell some malfunction on this site.</li>
							<li>give some suggestions.</li>
							<li>tell if we or any user is violating your copyright or patent.</li>
							<li>tell if we or any user is Endorsing discrimination based on race, religion, disability, sex, nationality, age, violence, sexually explicit or pornographic material.</li>
							<li>Tell if any service is not working.</li>
						</ul>
				</div>
 	    </div>

 	    <div class="form_body">
 	    	<div class="action_block"><img src='<?php echo img_loading; ?>'> </div>
 	     <?php 

 	      if(!isset($_COOKIE[$cookie_contactus]))
			{  

			?>
 	       <span class="form_block">
 	   		<form method="post" action="<?php echo action_site; ?>send_contactus_request.php" id="form">
 				<div class="error_box"></div>

 	   			<input type="name" placeholder="Name *" id="name" name="name" class="form_input input" maxlength="70" >

 	   			<input type="email" placeholder="Email *" id="email" name="email" class="form_input input" maxlength="255">

 	   			<select type="reason" id="reason" name="reason" class="form_input input select_input" >
 	   				<option selected value="">Reason for contact *</option>
 	   				<option value='cr1'>  Malfunction of the site.  </option>   
	                <option value='cr2'>  We or any user is violating your copyright or patent.  </option>  
	                <option value='cr3'>  We or any user is  Endorsing discrimination based on race, religion etc.</option>  
	                <option value='cr4'>  Any service is not working.  </option>  
	                <option value='cr5'>  Other.  </option>  
 	   			</select>

 	   			<input type="subject" placeholder="Subject" id="subject" name="subject" class="form_input input" maxlength="50">

 	   			<textarea id="message" class="form_input form_textarea input" id="message" name="message" placeholder="Message"></textarea>

 	   			
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
			   
			   			action.html('You have already submitted a contact request. you can try contacting us again after 1 week.');
					
					</script>
					";


 	   	  }

 	   	  ?>

 	    </div>


