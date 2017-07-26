<?php
/******************************
delete the document

creator:- raman tehlan
date of creation:- 12/12/2016
******************************/

session_start();

//define.inc define the basic terms
include "../../define.inc.php";

//check if session exist
if(isset($_SESSION[app_name . 'session_name'])){

	if(isset($_POST['file_id']) && isset($_POST['file_name']) && isset($_POST['file_extension'])){

				//include important files
				//connect.inc to connect to database
				include "../../connect.inc.php";

				$user_id = $_SESSION[app_name . 'user_id'];

				//data of form
				$file_name		= $_POST['file_name'];
				$file_extension = $_POST['file_extension'];
				$file_id	  	= $_POST['file_id'];
				$file_path 	  	= "../../../" . documents_uploading_folder;

				$no_of_document = mysqli_num_rows(mysqli_query($connect , "SELECT * FROM `$db_name`.`documents` WHERE `documents`.`DOCUMENT_ID` = '$file_id' and `documents`.`OWNER_ID` = '$user_id';"));

				if($no_of_document == 1){
					//check if file exists
					if(file_exists( $file_path . $file_name . "." . $file_extension)){
						
						//get a real path with out ../
						$file_path = realpath($file_path . $file_name . "." . $file_extension);

						//is file writeable
						if(is_writable($file_path)){
							
							//delete the file here
							if(unlink($file_path)){
										
										$code = "DELETE FROM `$db_name`.`documents` WHERE `documents`.`DOCUMENT_ID` = '$file_id'";

										mysqli_query($connect , $code);

							}
						}
					}
					//file already delete 
					//delete from database too
					else
					{
						$code = "DELETE FROM `$db_name`.`documents` WHERE `documents`.`DOCUMENT_ID` = '$file_id'";

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