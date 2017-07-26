<?php 


//to check if post is coming
if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["response_1"]) && isset($_POST["response_2"]) && isset($_POST["response_3"]) && isset($_POST["feedback"]) && isset($_POST["g-recaptcha-response"]))
{
		
		// parameters send to google
		$secret   = "6LcrPgsUAAAAAAmD0o1_Gvk2pYW4SIi67uIq_EYK";
		$response = $_POST["g-recaptcha-response"];
		$remoteip = $_SERVER["REMOTE_ADDR"];

		// sending parameters and getting response
		$recaptcha_response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip");

		// storing response to an array
		$recaptcha_response_array = json_decode($recaptcha_response , TRUE);

		//if recaptcha is success
		if($recaptcha_response_array["success"])
		{
				//define.inc to get predefined values
	 			include "../../connect.inc.php";
	 			//connect.inc to connect to mysql
	 			include "../../define.inc.php";

			//check if cookie of previous feedback is set
	 		//if cookie is not set then proceed the feedback
			if(!isset($_COOKIE[$cookie_feedback]))
			{ 
 				

	 			$name 	 		= $_POST["name"];
	 			$email   		= $_POST["email"];
				$response_1  	= $_POST["response_1"];
				$response_2  	= $_POST["response_2"];
				$response_3  	= $_POST["response_3"];
				$feedback	 	= htmlentities($_POST["feedback"]);
				$feedback   	= addslashes($feedback);


				$code = "INSERT INTO `$db_name`.`$feedbacks_table` (`NO`, `IP`, `NAME`, `EMAIL`, `How would you rate your overall experience with our service?`, `How would you rate our prices?`, `Would you recommend our product / service to other people?`, `FEEDBACK`, `TIMESTAMP`) VALUES (NULL, '$remoteip', '$name', '$email', '$response_1', '$response_2', '$response_1', '$feedback', CURRENT_TIMESTAMP);";

				mysqli_query($connect , $code);

				echo "
					<script type='text/javascript'>
			   			var error  	 = $('.error_box');
					    var action 	 = $('.action_block');
			   			var form_body = $('.form_block'); 
			  
			   			error.hide();
			   			form_body.hide();
			   			action.show();

			   
			   			action.html('Successfully Sent! Thank you for your feedback.');
			   			
					
					</script>
					";

			  setcookie($cookie_feedback , TRUE , $cookie_time_feedback , '/');


			}
			//user have already feedback once 
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

		}
		//if recaptcha failed
		else
		{
			echo "
			<script type='text/javascript'>
			   var error  = $('.error_box');
			   error.show();
			   error.html('Recaptcha failed!'); 
			   action.hide();
			</script>
			";
		}

	
}
//if post is not coming send user back to home
else
{
    				echo "
					<script type='text/javascript'>
			   			var error  	 = $('.error_box');	
					    var action 	 = $('.action_block');
			  
			   			error.show();
			   			error.html('Error! Incomplete information.');
			   			action.hide();

			   
			   			
					
					</script>
					";
}

?>