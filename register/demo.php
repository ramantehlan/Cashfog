<?php
/**************************
This is to activate the demo 

creator:- raman tehlan
date of creation:- 22/05/2017
***************************/

session_start();

//define.inc to get pre-defined values
include "../includes/define.inc.php";

 $_SESSION[app_name . "session_name"]   = $session_name_signin;
 $_SESSION[app_name . "user_id"] = "IN1702190215586091";
 $_SESSION[app_name . "email"]          = "mailcashfog@gmail.com";
 $_SESSION[app_name . "password"]       = "eb6cc74c85c45cd4e8547b1d470149ba";

 header("location:" . app . "dashboard"); 


?>