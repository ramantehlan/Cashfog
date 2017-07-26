<?php
/*************************************
this script is to update the preferences of user

creator:- raman tehlan	
date of creation:- 14/12/2016
*************************************/

session_start();

//define.inc define the basic terms 
include "../../define.inc.php";

//check if session exist
if(isset($_SESSION[app_name . "session_name"])){

	if(isset($_POST['language']) && isset($_POST['homepage']) && isset($_POST['mode']) ){
			
			//include important files
			//connect.inc to connect to database
			include "../../connect.inc.php";		

			$language 	 = $_POST['language'];
			$homepage 	 = $_POST['homepage'];
			$mode	  	 = $_POST['mode'];

			//for the reference of the user
			$user_id = $_SESSION[app_name . "user_id"];

			$code	= "UPDATE `$db_name`.`users` SET `LANGUAGE` = '$language', `HOME_PAGE` = '$homepage', `MODE` = '$mode' WHERE `users`.`ID` = '$user_id';";

			mysqli_query($connect , $code);

			echo "Successfully Saved
					<script type='text/javascript'>
							 setTimeout(function(){
							    //to reload page
                      			location.reload(); 
                      		  },2000);
					</script>
					
				";

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