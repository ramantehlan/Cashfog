<?php
/*****************************************
edit the document details 

creator:- raman tehlan
date of creation:- 11/12/2016
****************************************/

session_start();

//define.inc define the basic terms
include "../../define.inc.php";

//check if session exist
if(isset($_SESSION[app_name . 'session_name'])){
	
	if(isset($_POST['new_filename']) && isset($_POST['file_id'])){

				//include important files
				//connect.inc to connect to database
				include "../../connect.inc.php";

				//data of form
				$new_filename = $_POST['new_filename'];
				$file_id	  = $_POST['file_id'];

				$code = "UPDATE `$db_name`.`documents` SET `FILENAME` = '$new_filename' WHERE `documents`.`DOCUMENT_ID` = '$file_id';";

				mysqli_query($connect , $code);

				echo "Successfully Saved.";

	}
	else{
		//information coming from session is incomplete
		//using javascript to show error box
		echo "
			<script type='text/javascript'>
  				document_edit_return_error(incomplete_info_error);
			</script>
			";
	}
}
//session don't exist run the error
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