<?php
/************************************************
this script is to update security settings of user 

creator:- Raman tehlan
date of creation:- 30/11/2016
************************************************/

session_start();

//define.inc define the basic terms
include "../../define.inc.php";

//check if session exist
if(isset($_SESSION[app_name . 'session_name']))
{
	//check if all post values are coming
	if(isset($_POST['old_password']) && isset($_POST['new_password'])  )
	{
			
			
				//include important files
				//connect.inc to connect to database
				include "../../connect.inc.php";

	
				//post values
				$old_password 		= md5(base64_encode($_POST['old_password']));
				$current_password	= $_SESSION[app_name . "password"];
				$new_password   	= md5(base64_encode($_POST['new_password']));

				if($old_password != $current_password)
				{
					//information coming from session is incomplete
					//using javascript to show error box
					echo "
						<script type='text/javascript'>
  							return_error(password_wrong_error);
						</script>
						";
				}
				else
				{	
					//SESSION EMAIL FOR REFERENCE
					//used in code to refer
					$user_id = $_SESSION[app_name . "user_id"];
				
					$code = "UPDATE `$db_name`.`users` SET `PASSWORD` = '$new_password' WHERE `users`.`ID` = '$user_id';";

					//running code
					mysqli_query($connect , $code);

					$_SESSION[app_name . "password"] = $new_password;

					//printing message
					echo "Successfully Saved";
				}

				
					
				


							
		
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