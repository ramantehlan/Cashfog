<?php
/************************************************
this script is record how account list is arranged

creator:- Raman tehlan
date of creation:- 30/10/2017
************************************************/

session_start();

//define.inc define the basic terms
include "../../define.inc.php";

//connect.inc to connect to db
include "../../connect.inc.php";


function substrArray(&$item){
	$item = substr($item, 3);
}

//check session
if(isset($_SESSION[app_name . 'session_name'])){

	// Check if data is coming
	if(isset($_POST['data'])){
		 $data = explode("&", $_POST['data']);
		 array_walk($data, "substrArray");
		 
		 for($i = 0; $i < sizeof($data); $i++){

		 	$code = "UPDATE `$db_name`.`accounts` SET `LIST_RANKING` = '$i' WHERE `accounts`.`ACCOUNT_ID` = " . $data[$i] . ";";
		 	mysqli_query($connect , $code);

		 }


	}else{
		 echo "error";
	}


}else{
	//session don't exist 
	//session don't exist 
	 //destroy session 
     session_destroy();
     //error of session not set 
     //send user back to sign in page
     header("location:" . signin . "error/005");
}




?>