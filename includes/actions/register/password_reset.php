<?php
/************************************************
this script is to reset password 

creator:- Raman tehlan
date of creation:- 14/05/2016
************************************************/

session_start();

//define.inc define the basic terms
include "../../define.inc.php";

//check if session exist
if(isset($_SESSION[app_name . 'user_id']))
{
	//check if all post values are coming
	if(isset($_POST['password'])  )
	{
			
			
				//include important files
				//connect.inc to connect to database
				include "../../connect.inc.php";
	
				//post values
				$password  = md5(base64_encode($_POST['password']));
				
				$code = "UPDATE `$db_name`.`users` SET `PASSWORD` = '$password' , `RESET_CODE` = '' WHERE `users`.`ID` = '" . $_SESSION[app_name . 'user_id'] . "';";

				//running code
				mysqli_query($connect , $code);

				$_SESSION[app_name . "password"] = $password;

				$response = '<div class="box_heading">' .
                      'successfully Reset' . 
                  '</div>'.
                  '<div class="box_body">'.
                  		'Your password has been reset. We request you to <a href="' . signin . '" class="link">Sign In</a> again with your new password <b> ' . 
                  '</div>';

				echo "<script>
					$('document').ready(function(){
						$('.box').html('$response');
					});
				</script>";
			
							
		
	}
	else
	{
		//information coming from session is incomplete
		//using javascript to show error box
		echo "
			<script type='text/javascript'>
  				return_error(incomplete_info_error);
			</script>
			";
	}
}
else
{
	//session of user don't exist
	//session don't exist 
	 //destroy session 
     session_destroy();
     //error of session not set 
     //send user back to sign in page
     header("location:" . signin . "error/005");
}

?>