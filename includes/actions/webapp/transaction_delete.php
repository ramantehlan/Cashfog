<?php 
/*********************************8
to delete a transaction

creator:- raman tehlan
date of creation:- 11/01/2017
**********************************/

session_start();

//define.inc define the basic terms
include "../../define.inc.php";

//check if session exist
if(isset($_SESSION[app_name . 'session_name'])){
	if(isset($_POST['transaction_id'])){

			//include important files
			//connect.inc to connect to database
			include "../../connect.inc.php";

			//data of form
			$transaction_id = $_POST['transaction_id'];
			$owner_id		= $_SESSION[app_name . 'user_id'];

			$code = "DELETE FROM `$db_name`.`$transactions_table` WHERE `$transactions_table`.`TRANSACTION_ID` = '$transaction_id' AND  `$transactions_table`.`OWNER_ID` = '$owner_id'; ";

			mysqli_query($connect , $code);
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