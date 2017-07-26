<?php 
/************************************************
this script is to edit accounting/transaction settings

creator:- Raman tehlan
date of creation:- 25/03/2017
************************************************/

session_start();

//define.inc define the basic terms
include "../../define.inc.php";

//connect.inc to connect to db
include "../../connect.inc.php";

//decoder.lib is to decode recoded data of user
include "../../decoder.lib.php";
$decode = new decoder();

//check session
if(isset($_SESSION[app_name . 'session_name'])){

		//check if all the required variables are set
		if( isset($_POST['financial_period']) && isset($_POST['currency']) && isset($_POST['buyer_term']) && isset($_POST['seller_term']) ){

			//user_id (owner_id)
			$user_id = $_SESSION[app_name . "user_id"];

			$financial_period		= $_POST['financial_period'];
			$currency				= $_POST['currency'];
			$buyer_term				= $_POST['buyer_term'];
			$seller_term			= $_POST['seller_term'];

			$code = "UPDATE `$db_name`.`users` SET `FINANCIAL_PERIOD` = '$financial_period', `CURRENCY` = '$currency', `BUYER_TERM` = '$buyer_term', `SELLER_TERM` = '$seller_term' WHERE `users`.`ID` = '$user_id';";

			if(mysqli_query($connect , $code)){
					echo "Successfully Edited
					<script type='text/javascript'>
							 setTimeout(function(){
							    //to reload page
                      			location.reload(); 
                      		  },2000);
					</script>";	
		}


		}else{
			//not all post are set 
			//print error
			echo "
			<script type='text/javascript'>
  				return_pop_error(incomplete_info_error);
			</script>
			";
		}

}else
{
	//session don't exist 
	//session don't exist 
	 //destroy session 
     session_destroy();
     //error of session not set 
     //send user back to sign in page
     header("location:" . signin . "error/005");
}


?>