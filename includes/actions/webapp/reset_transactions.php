<?php 
/************************************************
This script is to reset/update the data of transactions

creator:- Raman tehlan
date of creation:- 27/04/2017
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
		if(isset($_POST['year'])  && isset($_POST['country']) && isset($_POST['currency']) && $_POST['financial_period']) {

			/*
			this user id is very important to create 
			it is called a global in data_access 
			*/
			$USER_ID = $_SESSION[app_name . "user_id"];
			$FINANCIAL_PERIOD = $_POST['financial_period'];
			$COUNTRY = $_POST['country'];
			$CURRENCY = $_POST['currency'];
			$year = $_POST['year'];

			$_SESSION[app_name . "current_year"] = $year;


 		//types of accounts to get
		//financial year apply only on ledger and expense/income
		$account_type =  array('le1' , 'le2' , 'le3' , 'le4' );

			//to run a loop for every account type
			for($i = 0; count($account_type) > $i ; $i++) {
		
								$book_data = $access -> book($account_type[$i] , true , $year);
 					
 					
						 	    $total_debit = $decode -> money($book_data[0] , $COUNTRY , $CURRENCY );
						 		$total_credit = $decode -> money($book_data[1] , $COUNTRY , $CURRENCY );
						 		$total_balance = $decode -> money($book_data[2] , $COUNTRY , $CURRENCY );
						 		$opening_balance = $decode -> money($book_data[3] , $COUNTRY , $CURRENCY );
						 		

					echo "<script type='text/javascript'>
	 						$('#". $account_type[$i] ."_0').html('$total_debit');
	 						$('#". $account_type[$i] ."_1').html('$total_credit');
	 						$('#". $account_type[$i] ."_2').html('$total_balance');
	 						$('#". $account_type[$i] ."_3').html('$opening_balance');
						</script>";
						 	

			} 


			echo "<script type='text/javascript'>
	 					$('.transactions_action').hide();
			</script>";

		}else{
			//not all post are set 
			//print error
			echo "
			<script type='text/javascript'>
  				$('.transactions_action').html(incomplete_info_error);
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