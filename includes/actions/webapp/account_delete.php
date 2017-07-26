<?php 
/*******************************
Delete a account and delete its
transactions 

creator:- raman tehlan
date of creation:- 06/01/2017
********************************/
	
session_start();

//define.inc define the basic required terms
include "../../define.inc.php";

//check if session exist
if(isset($_SESSION[app_name . 'session_name'])){
	//check if all the required fields are getting post
	if(isset($_POST['account_id'])){

			//include imortant files
			//connect.inc to connect to database
			include "../../connect.inc.php";

			//data of form
			$account_id = $_POST['account_id'];
			$owner_id	= $_SESSION[app_name . 'user_id'];


			$delete_account = "DELETE FROM `$db_name`.`$accounts_table` WHERE `$accounts_table`.`ACCOUNT_ID` = '$account_id';";
			$delete_transactions = "DELETE FROM `$db_name`.`$transactions_table` WHERE `$transactions_table`.`ACCOUNT_ID` = '$account_id' and `$transactions_table`.`OWNER_ID` = '$owner_id';";
			
			mysqli_query($connect , $delete_account);
			mysqli_query($connect , $delete_transactions);

	}
}else{
	//session don't exist 
	 //destroy session 
     session_destroy();
     //error of session not set 
     //send user back to sign in page
     header("location:" . signin . "error/005");
}
?>