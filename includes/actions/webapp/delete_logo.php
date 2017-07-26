<?php 
/************************************************
this is to delete logo of a user

creator:- Raman Tehlan
date of creation:- 27/01/2017
************************************************/

session_start();

//define.inc define the basic terms
include "../../define.inc.php";

//include connect.inc to connect to database
include "../../connect.inc.php";

//check if session exist
if(isset($_SESSION[app_name . 'session_name']))
{
	//check if all post values are coming
	//since we are sending no post, we will keep it true
	if(true){

		//user id
		$user_id = $_SESSION[app_name . "user_id"];

		//check if logo exists
		$code_for_logo = mysqli_query($connect , "SELECT * from `$db_name`.`users`  WHERE `users`.`ID` = '$user_id' and LOGO != '';");
     	$no_of_logo = mysqli_num_rows($code_for_logo);

     		if($no_of_logo == 1){

     			if(allow_logo_delete){

     				//get current/old logo id
     				$get = mysqli_fetch_array($code_for_logo);
     				$current_logo = $get['LOGO'];

     				//path to storing location
     				$path = "../../../";

     				//check if logo exists
     				if(file_exists($path . logo_uploading_folder . "original/" . $current_logo) == true){
     					//delete old logo
     					unlink($path . logo_uploading_folder . "original/" . $current_logo);
     					unlink($path . logo_uploading_folder . "large/" . $current_logo);
     					unlink($path . logo_uploading_folder . "medium/" . $current_logo);
     					unlink($path . logo_uploading_folder . "small/" . $current_logo);
     				}

     				//this is to remove logo from database
     				$code = "UPDATE `$db_name`.`users` SET LOGO = NULL where `users`.`ID` = '$user_id'; ";

     				mysqli_query($connect , $code);
     			}
     		}
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