<?php 


//to check if post is coming
if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["reason"]) && isset($_POST["subject"]) && isset($_POST["message"]) && isset($_POST["g-recaptcha-response"]))
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
	 			include "../../define.inc.php";
	 			//connect.inc to connect to mysql
	 			include "../../connect.inc.php";

	 		//check if cookie of previous contact request is set
	 		//if cookie is not set then proceed the contact request
			if(!isset($_COOKIE[$cookie_contactus]))
			{ 

	 			$name 	 	= $_POST["name"];
	 			$email   	= $_POST["email"];
				$reason  	= $_POST["reason"];
				$subject 	= htmlentities($_POST["subject"]);
				$subject    = addslashes($subject);
				$message 	= htmlentities($_POST["message"]);
				$message    = addslashes($message);

				
				$code = "INSERT INTO `$db_name`.`$contact_requests_table` (`NO`, `IP`, `NAME`, `EMAIL`, `REASON FOR CONTACT`, `SUBJECT`, `MESSAGE`, `TIMESTAMP`) VALUES (NULL, '$remoteip', '$name', '$email', '$reason', '$subject', '$message', CURRENT_TIMESTAMP);";
				mysqli_query($connect , $code);

				echo "
					<script type='text/javascript'>
			   			var error  	 = $('.error_box');
					    var action 	 = $('.action_block');
			   			var form_body = $('.form_block'); 
			  
			   			error.hide();
			   			form_body.hide();
			   			action.show();

			   
			   			action.html('Successfully Sent! Our team will contact you shortly. ');
			   			
					
					</script>
					";

			  setcookie($cookie_contactus , TRUE , $cookie_time_contactus , '/');


			}
			//user have already requested once 
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