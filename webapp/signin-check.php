<?php
/*********************************************
This program is to check login information

creator:- raman tehlan
date of creation:- 21/06/2015
**********************************************/

//define.inc to get pre-defined values
include "../includes/define.inc.php";
//connect.inc to connect to mysql
include "../includes/connect.inc.php";

//post is comming of email and password
if(isset($_POST['email_in']) && isset($_POST['password_in'])  )
{  
	//login values
	$email    = $_POST['email_in'];
	$password = md5(base64_encode($_POST['password_in']));

	//mysql code to check login values validity
	$code = mysqli_query($connect , "SELECT * FROM `$db_name`.`users` WHERE EMAIL = '$email' and PASSWORD = '$password'; ");

	//running mysql code to get no of rows with login values
	$check_code = mysqli_num_rows($code);

	//if login values is not 0
	if($check_code)
	{  	 
		//if anyother session exist distroy it
		session_start();
		session_destroy();
		
		//start a new session with login info
		session_start();

		 //this is to get user information
		 $get = mysqli_fetch_array($code);

		 $_SESSION[app_name . "session_name"] 	= $session_name_signin;
		 $_SESSION[app_name . "user_id"]		= $get['ID'];
		 $_SESSION[app_name . "email"]			= $email;
		 $_SESSION[app_name . "password"]		= $password;

		 
		 	
		 	if(isset($_POST['remember_me']))
		 	 {	
		 		if($_POST['remember_me'] == 'on')
		 		{
		 			setcookie($cookie_signin, TRUE , $cookie_time_signin , '/');
                    setcookie(app_name . "user_id", $get['ID'] , $cookie_time_signin , '/');
                    setcookie(app_name . "email", $email , $cookie_time_signin , '/');
                    setcookie(app_name . "password",$password , $cookie_time_signin , '/');	
		 		}
		 	}
		 	


		 //set the home page of user
		 switch ($get['HOME_PAGE']) {
		 	case 'hp1':
		 		header("location:" . app . "dashboard");
		 	break;
		 	case 'hp2':
		 		header("location:" . profile );
		 	break;
		 	case 'hp3':
		 		header("location:" . app . "transactions");
		 	break;
		 	case 'hp4':
		 		header("location:" . app . "transactions/b");
		 	break;
		 	case 'hp5':
		 		header("location:" . app . "transactions/a");
		 	break;
		 	case 'hp6':
		 		header("location:" . app . "transactions/l");
		 	break;
		 	case 'hp7':
		 		header("location:" . app . "transactions/e");
		 	break;
		 	case 'hp8':
		 		header("location:" . app . "documents");
		 	break;
		 	default:
		 		header("location:" . app . "dashboard");
		 	break;
		 }
		 

		 

	}
	else
	{
		//email or password was wrong
		//send user back to signin page with error
		header("location:" . signin . "error/004");

	    
	}

}
else
{
	//email or password was not sent information is broken
	//send user back to signin page with error
	header("location:" . signin . "error/000");
	
}


?>