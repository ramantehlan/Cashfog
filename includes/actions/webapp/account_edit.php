<?php
/************************************************
this script is edit a account

note:- this script is modified version of 
account creating script 

creator:- Raman tehlan
date of creation:- 07/01/2017
************************************************/
	
session_start();

//define.inc define the basic terms
include "../../define.inc.php";

//connect.inc to connect to db
include "../../connect.inc.php";

//check if session exist
if(isset($_SESSION[app_name . 'session_name'])){

		if( isset($_POST['account_id']) && isset($_POST['account_title']) && isset($_POST['currency'])  && isset($_POST['account_comment']) && isset($_POST['contact_salutation']) && isset($_POST['contact_f_name']) && isset($_POST['contact_l_name']) && isset($_POST['company_name']) && isset($_POST['due_days']) && isset($_POST['address']) && isset($_POST['street']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['zip']) && isset($_POST['country']) && isset($_POST['contact_email']) && isset($_POST['work_phone']) && isset($_POST['mobile_phone']) && isset($_POST['website'])){


					//user_id (owner_id)
					$user_id = $_SESSION[app_name . "user_id"];

					$account_id 		= $_POST['account_id'];
					$account_type 	 	= $_POST['account_type'];
					$account_title 	 	= $_POST['account_title'];
					$currency	 	 	= $_POST['currency'];
					$account_comment  	= addslashes(htmlentities($_POST['account_comment']));
					$contact_salutation = $_POST['contact_salutation'];
					$contact_f_name		= $_POST['contact_f_name'];
					$contact_l_name		= $_POST['contact_l_name'];
					$company_name		= $_POST['company_name'];
					$due_days			= ($_POST['due_days'] != 0)? $_POST['due_days'] : 45;
					$address			= addslashes(htmlentities($_POST['address']));
					$street				= addslashes(htmlentities($_POST['street']));
					$city				= addslashes(htmlentities($_POST['city']));
					$state				= addslashes(htmlentities($_POST['state']));
					$zip				= ($_POST['zip'] != 0)? $_POST['zip'] : "NULL" ;
					$country			= $_POST['country'];
					$contact_email		= $_POST['contact_email'];
					$work_phone			= ($_POST['work_phone'] != 0)? $_POST['work_phone'] : "NULL";
					$mobile_phone		= ($_POST['mobile_phone'] != 0)? $_POST['work_phone'] : "NULL" ;
					$website			= $_POST['website'];

				
					$code = "UPDATE `$db_name`.`$accounts_table` SET `CONTACT_SALUTATION` = '$contact_salutation', `CONTACT_FIRST_NAME` = '$contact_f_name', `CONTACT_LAST_NAME` = '$contact_l_name', `COMPANY_NAME` = '$company_name', `ACCOUNT_TITLE` = '$account_title', `DUE_DAYS` = '$due_days', `ADDRESS` = '$address', `STREET` = '$street', `CITY` = '$city', `STATE` = '$state', `ZIP` = $zip, `COUNTRY` = '$country', `CONTACT_EMAIL` = '$contact_email', `CONTACT_PHONE` = $work_phone, `CONTACT_MOBILE` = $mobile_phone, `WEBSITE` = '$website', `COMMENT` = '$account_comment', `ACTIVITY_STATUS` = '1' WHERE `$accounts_table`.`ACCOUNT_ID` = '$account_id' AND `$accounts_table`.`OWNER_ID` = '$user_id';";

			mysqli_query($connect , $code);

			echo "Successfully saved

					<script type='text/javascript'>
							setTimeout(function(){
								window.location.reload();
							} , 1500);
					</script>
			";

		}else{
			//information coming from session is incomplete
			//using javascript to show error box
			echo "
				<script type='text/javascript'>
  					return_error(incomplete_info_error);
				</script>
				";			
			}


	

}else{
	//session of user don't exist
	//session don't exist 
	 //destroy session 
     session_destroy();
     //error of session not set 
     //send user back to sign in page
     header("location:" . signin . "error/005");
}

 ?>
