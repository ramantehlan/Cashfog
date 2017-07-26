<?php 
/******************************************8
this is to check password in forms 

creator:- raman tehlan
date of creation:- 27/01/2017
********************************************/

session_start();

//define.inc define the basic terms
include "../../define.inc.php";


if(isset($_SESSION[app_name . 'session_name'])){
	//check if post exist
	if(isset($_POST['password'])){

		//getting original and post password
		$real_password = $_SESSION[app_name . 'password'];
		$post_password = md5(base64_encode($_POST['password']));

			if($real_password != $post_password){
					//password do not match current password
					
					echo "
							<script type='text/javascript'>
  								return_error(password_wrong_error);
							</script>
						";
			}else{
					echo "
							<script type='text/javascript'>
  								password_check();
							</script>
					";
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