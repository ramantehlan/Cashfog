<?php 
/************************************************
This script is to reset/update the data of sale or purchase
chart

creator:- Raman tehlan
date of creation:- 10/03/2017
************************************************/

session_start();

//define.inc define the basic terms
include "../../define.inc.php";

//connect.inc to connect to db
include "../../connect.inc.php";

//decoder.lib is to decode recoded data of user
include "../../decoder.lib.php";
$decode = new decoder();

//get_db_info.lib is to get information from database
include "../../data_access.lib.php";
$access = new data_access();

//check session
if(isset($_SESSION[app_name . 'session_name'])){

		//check if all the required variables are set
		if( isset($_POST['request_type'])  && isset($_POST['financial_period']) && isset($_POST['country']) && isset($_POST['currency']) &&  isset($_POST['account_id']) ) {

			/*
			this user id is very important to create 
			it is called a global in data_access 
			*/
			$USER_ID = $_SESSION[app_name . "user_id"];
			$FINANCIAL_PERIOD = $_POST['financial_period'];

			//if action type is t1 then it is expense
			//if action type is t2 then it is income
			if($_POST['request_type'] == "sale"){
				$action_area_name = ".receivable_action";
				$content_box = "receivable_content";
			}else if($_POST['request_type'] == "purchase"){
				$action_area_name = ".payable_action";
				$content_box = "payable_content";
			}else{
				return false;
			}

			$balance = $access -> action_balance($_POST['request_type'] , $_POST['account_id'] );
       	 	$balance = $decode -> money($balance , $_POST['country'] , $_POST['currency'] );
			
			echo "<script type='text/javascript'>

				$('#$content_box').html('" . $balance . "');

			</script>";

		}else{
			//not all post are set 
			//print error
			echo "
			<script type='text/javascript'>
  				$('.receivable_action').html(incomplete_info_error);
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