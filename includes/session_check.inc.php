<?php
/******************************************************
Check if session sign in information is correct

creator:- raman tehlan
date of creation:- 21/11/2016
*******************************************************/

	//if session exist
	if(isset($_SESSION[app_name . 'session_name']))
 	 {
    	//take action according to session name
    	switch ($_SESSION[app_name . 'session_name']) 
    	{
      		case $session_name_signin:
          			
          		$session_check_code = mysqli_query($connect , "SELECT * FROM `$db_name`.`users` WHERE EMAIL = '" . $_SESSION[app_name . "email"] . "' and PASSWORD = '" . $_SESSION[app_name . "password"] . "'; ");

          		//if login info is incorrect
          		if(mysqli_num_rows($session_check_code) == 0)
          			{
						      //destroy session 
          				session_destroy();
          				//error of incorrect login info 
          				//send user back to sign in page
          				header("location:" . signin . "error/004");
                  
                    //destroy cookie
                   if(isset($_COOKIE[$cookie_signin]))
                       {
                           setcookie($cookie_signin, FALSE , -$cookie_time_signin , '/');
                           setcookie(app_name . "user_id", "" , -$cookie_time_signin , '/');
                           setcookie(app_name . "email", "" , -$cookie_time_signin , '/');
                           setcookie(app_name . "password","" , -$cookie_time_signin , '/');
                       }

          			}  
              else
              {
                //include user info
                include "../includes/define_user_info.inc.php";
              }


      		break;
      
     		default:

            if(isset($page_name)){
                  if($page_name == "profile"){

                  }else{
                    //destroy session 
                    session_destroy();
                    //error of session not set 
                    //send user back to sign in page
                    header("location:" . signin . "error/005");
                  }
              }
            else{
        		    //destroy session 
          		  session_destroy();
          		  //error of session not set 
          		  //send user back to sign in page
          		  header("location:" . signin . "error/005");
            }

      		break;
           
     	}
  
  	}
	else
	{
    if(isset($page_name)){
                  if($page_name == "profile"){
                      
                  }else{
                    //destroy session 
                    session_destroy();
                    //error of session not set 
                    //send user back to sign in page
                    header("location:" . signin . "error/005");
                  }
              }
            else{
                //destroy session 
                session_destroy();
                //error of session not set 
                //send user back to sign in page
                header("location:" . signin . "error/005");
            }
    
	}


?>