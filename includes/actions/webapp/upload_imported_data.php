<?php
/************************************************
This script is to upload documents 

creator:- Raman tehlan
date of creation:- 30/11/2016
************************************************/

session_start();

//define.inc define the basic terms
include "../../define.inc.php";

//check if session exist
if(isset($_SESSION[app_name . 'session_name'])){
		
		if(isset($_FILES['data_file'])){

				//include important files
				//connect.inc to connect to database
				include "../../connect.inc.php";

			//if temp file exist or not
			if(isset($_FILES['data_file']['tmp_name'])){

				$tmp_name = $_FILES['data_file']['tmp_name'];

				$row = 1;
				if( ($handle = fopen($tmp_name , "r")) != FALSE){

						$user_id = $_SESSION[app_name . 'user_id'];

					$account_create_prefix = "INSERT INTO `$db_name`.`$accounts_table` (
													`ACCOUNT_ID`,
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
													`DATE_OF_CREATION`) VALUES ";

					$transaction_create_prefix = "INSERT INTO `$db_name`.`$transactions_table` (
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
													VALUES ";

					$r = 1;
					while( ($info = fgetcsv($handle , 10000 , ",")) != FALSE){
						$r++;

						//count number of colums are there
						$num_c = count($info);
						//flag to tell if code is to be implemented or not
						$run_sql = true;
							
							//remove any space from the end of new
							if($info[0] == "new"){
									
									$account_id = date('ymdhis') . rand(10,10000);
									$currency = "INR";
									$account_type = $info[1];
									$company = $info[2];
									$account_title = ($info[3] != "")? $info[3] : $info[2];


									$code = $account_create_prefix . "('$account_id', 
											  '$user_id', 
											  '$account_type', 
											  '', '', '', '$company', 
											  '$account_title', 
											  '$currency', 
											  NULL, '', '', '', '', NULL , '', '', NULL , NULL , '' , '', '1',
											   CURRENT_TIMESTAMP);";

							}else if($info[0] == "date"){
									$code = "";
									$run_sql = false;
							}else{
								
								if($info[3] != 0){
									$transaction_id	= date('ymd') . rand(10,100000) . rand(10,10000);
									$particulars = $info[1];
									$bill_no = ($info[2] != 0)? $info[2] : "NULL";
									$transaction_amount = $info[3];
									$transaction_type = $info[4];
									$transaction_method = $info[5];
									$transaction_comment = addslashes(htmlentities($info[6]));
									$date = DateTime::createFromFormat("d-m-Y", $info[0]);
									$date_of_transaction = $date  -> format("Y-m-d");


									$code = $transaction_create_prefix . "('$transaction_id', 
											'$account_id', 
											'$user_id', 
											'$particulars', 
											 $bill_no, 
											'$transaction_type', 
											'$transaction_method', 
											'$transaction_amount', 
											'$transaction_comment',
											 '$date_of_transaction');";
									}else{
										$code = "";
										$run_sql = false;
									}
							}
						
						if($run_sql){
							mysqli_query($connect , $code);
						}

					}//while end
					echo "Importing completed.
					<script type='text/javascript'>
							 setTimeout(function(){
							    //to reload page
                      			location.reload(); 
                      		  },2000);
					</script>";
				}//if end

			}
	
		}			
	else{
		
		//information coming from session is incomplete
		//using javascript to show error box
		echo "
			<script type='text/javascript'>
  				return_error(incomplete_info_error);
			</script>
			";
	}
}
else{
	
	//session of user don't exist
	//session don't exist 
	 //destroy session 
     session_destroy();
     //error of session not set 
     //send user back to sign in page
     header("location:" . signin . "error/005");
}

?>