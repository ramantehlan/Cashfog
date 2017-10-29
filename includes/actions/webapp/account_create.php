<?php
/************************************************
this script is create a new account

creator:- Raman tehlan
date of creation:- 27/12/2016
************************************************/
	
session_start();

//define.inc define the basic terms
include "../../define.inc.php";

//connect.inc to connect to db
include "../../connect.inc.php";

//check if session exist
if(isset($_SESSION[app_name . 'session_name'])){

		if(isset($_POST['account_title']) && isset($_POST['currency']) && isset($_POST['opening_balance']) && isset($_POST['account_comment']) && isset($_POST['contact_salutation']) && isset($_POST['contact_f_name']) && isset($_POST['contact_l_name']) && isset($_POST['company_name']) && isset($_POST['due_days']) && isset($_POST['address']) && isset($_POST['street']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['zip']) && isset($_POST['country']) && isset($_POST['contact_email']) && isset($_POST['work_phone']) && isset($_POST['mobile_phone']) && isset($_POST['website'])){


					//user_id (owner_id)
					$user_id = $_SESSION[app_name . "user_id"];

					$account_id = date('ymdhis') . rand(10,10000);

					$opening_balance 	= ($_POST['opening_balance'] != 0)? $_POST['opening_balance'] : 0;

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

				
					$code = "INSERT INTO `$db_name`.`$accounts_table` (`ACCOUNT_ID`,
													`OWNER_ID`, 
													`ACCOUNT_TYPE`, 
													`CONTACT_SALUTATION`, 
													`CONTACT_FIRST_NAME`, 
													`CONTACT_LAST_NAME`, 
													`COMPANY_NAME`, 
													`ACCOUNT_TITLE`, 
													`CURRENCY`, 
													`DUE_DAYS`, 
													`ADDRESS`, 
													`STREET`, 
													`CITY`, 
													`STATE`, 
													`ZIP`, 
													`COUNTRY`, 
													`CONTACT_EMAIL`, 
													`CONTACT_PHONE`, 
													`CONTACT_MOBILE`,
													`WEBSITE`, 
													`COMMENT`, 
													`ACTIVITY_STATUS`, 
													`DATE_OF_CREATION`,
													`LIST_RANKING`) VALUES ('$account_id', '$user_id', '$account_type', '$contact_salutation', '$contact_f_name', '$contact_l_name', '$company_name', '$account_title', '$currency', '$due_days', '$address', '$street', '$city', '$state', $zip, '$country', '$contact_email', $work_phone, $mobile_phone, '$website', '$account_comment', '1', CURRENT_TIMESTAMP, NULL);";


			mysqli_query($connect , $code);


					
					//check if opening balance is not zero
					//if it is not zero then make it a transaction
					if($opening_balance != 0){
						//check if opening balance is positive or negative
						if($opening_balance > 0){
                               //if it is expense gain account
                               //and balance is +
                               //it is gain / debit
                               if($account_type == "le4"){
                                $transaction_type = "t1";
                               }
                               //else it is a normal account (ledger)
                               //and balance is +
                               //it is credit
                               else{
                               	 $transaction_type = "t2";
                               }
                               									
                          }
                          else{
                             	//if it is expense gain account
                             	//and balance is -
                             	//it is expense / credit
                             	if($account_type == "le4"){
                             		$transaction_type = "t2";
                             	}
                             	//else it is a normal account (ledger)
                             	//and balance is -
                             	//it is a debit
                             	else{
                             		$transaction_type = "t1";
                             	}
                          }

                          //transaction_id
                          $transaction_id			= date('ymdhis') . rand(10,10000);
                          $opening_balance 			= abs($opening_balance);

                          //this is to add opening balance as a transaction.
                          $code_opening_balance = "INSERT INTO `$db_name`.`$transactions_table` (
										`TRANSACTION_ID`, 
										`ACCOUNT_ID`, 
										`OWNER_ID`, 
										`PARTICULARS`, 
										`BILL_INVOICE_NO`, 
										`TRANSACTION_TYPE`, 
										`TRANSACTION_METHOD`, 
										`TRANSACTION_AMOUNT`, 
										`COMMENT`, 
										`DATE_OF_TRANSACTION`) 
										VALUES ('$transaction_id', '$account_id', '$user_id', 'opening balance', NULL, '$transaction_type', '', '$opening_balance', '', CURRENT_TIMESTAMP);";

                          mysqli_query($connect , $code_opening_balance);
					}


			echo "Account created Successfully";

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
