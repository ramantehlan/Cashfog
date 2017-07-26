<?php
/************************************************
this script is to update settings of user 

creator:- Raman tehlan
date of creation:- 29/11/2016
************************************************/

session_start();

//define.inc define the basic terms
include "../../define.inc.php";

//check if session exist
if(isset($_SESSION[app_name . 'session_name']))
{
	//check if all post values are coming
	if(isset($_POST['f_name']) && isset($_POST['l_name']) && isset($_POST['email']) && isset($_POST['birth_date']) && isset($_POST['birth_month']) && isset($_POST['birth_year']) && isset($_POST['gender']) && isset($_POST['country']))
	{
		//include important files
		//connect.inc to connect to database
		include "../../connect.inc.php";
		
		//validate form
		include "../../validate_form.lib.php";
		$validate_form = new validate_form();


			//check if email enter by user don't exist
			if($validate_form -> validate_email($_POST['email']))
			{		
				//post values
				$f_name 	= $_POST['f_name'];
				$l_name 	= $_POST['l_name'];
				$email	 	= $_POST['email'];
				$dob		= $_POST['birth_year'] . "-" . $_POST['birth_month'] . "-" . $_POST['birth_date'];
				$gender		= $_POST['gender'];
				$country	= $_POST['country'];

				//SESSION EMAIL FOR REFERENCE
				$session_email = $_SESSION[app_name . "email"];
				$user_id = $_SESSION[app_name . "user_id"];
				
				$code = "UPDATE `$db_name`.`users` SET `FIRST_NAME` = '$f_name', `LAST_NAME` = '$l_name', `EMAIL` = '$email', `DATE OF BIRTH` = '$dob' , `GENDER` = '$gender' , `COUNTRY` = '$country' WHERE `users`.`ID` = '$user_id';";

				mysqli_query($connect , $code);

				//update session email in case if it is changed
				if(!($session_email == $email))
				{
					$_SESSION[app_name . "email"] = $email;
				}

				echo "Successfully Saved";
							
			}
			else
			{
						//information coming from session is incomplete
						//using javascript to show error box
						echo "
						 	<script type='text/javascript'>
  								return_error(email_exist_error);
							</script>
						";
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