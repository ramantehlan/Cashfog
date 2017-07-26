<?php

session_start();

//define.inc is to get pre-defined info
include "../includes/define.inc.php";


if(isset($_SESSION[app_name . 'session_name']))
{
	//destroy cookie
	if(isset($_COOKIE[$cookie_signin]))
	{
	 setcookie($cookie_signin, FALSE , -$cookie_time_signin , '/');
     setcookie(app_name . "user_id", "" , $cookie_time_signin , '/');
     setcookie(app_name . "email", "" , -$cookie_time_signin , '/');
     setcookie(app_name . "password","" , -$cookie_time_signin , '/');
	}


	//destroy session
	session_destroy();

	//send user to home
	header("location:" . signin);



}
else
{
	//session is not send user to home
	header("location:" . url);
}


?>