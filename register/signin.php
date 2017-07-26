<?php
session_start();

//define.inc to get pre-defined values
include "../includes/define.inc.php";


	//check if any session exist
	if(isset($_SESSION[app_name . 'session_name']))
	{
		//take action according to session name
		switch ($_SESSION[app_name . 'session_name']) 
		{
			case $session_name_signup:
					session_destroy();
			break;
			case $session_name_signin:
					header("location:" . url);
			break;
			
			default:
				//header("location:" . url);
			break;
		}
	}
	
	if(isset($_COOKIE[$cookie_signin]))
  		{
    		 $_SESSION[app_name . "session_name"]   = $session_name_signin;
     		 $_SESSION[app_name . "email"]          = $_COOKIE[app_name . "email"];
     		 $_SESSION[app_name . "password"]       = $_COOKIE[app_name . "password"];

     		header("location:" . app . "dashboard"); 
   		}

?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Sign In - <?php echo app_name; ?>
	</title>

	           <META NAME='author' content='Raman Tehlan'>
              <META NAME='title' content ='Sign In'>
              <META NAME='keywords' content='Accounting Transactions Ledgers Expense Income Assets Liability Innovation cashfog cash Sign In'>
              <META NAME='description' content="Sign in to your account.">
              <META NAME='language' content='English'>
              <META charset='utf-8'>
              <META NAME="ROBOTS" CONTENT="INDEX , NOFOLLOW">

	<link rel="shortcut icon" href="<?php echo img_fevicon; ?>" type="image/x-icon">
	<link rel="icon" href="<?php echo img_fevicon; ?>" type="image/x-icon">

		
	    <link rel="stylesheet" href="<?php echo style_register; ?>comman-ui.css">		
		<link rel="stylesheet" href="<?php echo style_register; ?>signin-ui.css">

	<script type="text/javascript" src="<?php echo script; ?>jquery.js"></script>
	<script type="text/javascript" src="<?php echo script; ?>form-check.js"></script>
	<script type="text/javascript" src="<?php echo script_register; ?>check_signin.js"></script>

			<?php
 			

/*****************************************************************
ERROR HANDLER FOR SIGN IN PROCESS
{CODE}		{ERROR MEANING}
000		    UNKNOWN ERROR
002			INCOMPLETE INFO
004			EMAIL OR PASSWORD IS WRONG
005         LOGIN FIRST
*****************************************************************/


	//check if error is there
	if(isset($_GET['error']))
	{

		//common js command for error handling
		echo "<script type='text/javascript'>
			  $(document).ready(function(){


			   var error_box = $('.error_box');
			   error_box.show();";

		 switch ($_GET['error']) 
		 	{
			case '002':
					echo "error_box.html(error_002);";
				break;
			case '004':
					echo "error_box.html(error_004);";
				break;
			case '005':
					echo "error_box.html(error_005);";
				break;
			default:
					echo "error_box.html(error_000);";
				break;
		   }

		echo "}); </script>";
	}
 	    ?>

 	    	  <meta name='author' content='Raman Tehlan'>
              <meta name='title' content ='Sign In - Cashflog'>
              <meta name='keywords' content='cash , fog , cashfog , accounting , ledgers , '>
              <meta name='description' content="Sign in to your cashfog account and manage your cash flow easily">
              <meta name='language' content='English'>
              <meta charset='urf-8'>  

</head>
<body>
 

 	    		<div class="logo effect_slide_top_1">
 	    				<a href="<?php echo url; ?>"><img src="<?php echo img_512_logo; ?>"  alt="<?php echo app_name; ?> logo"></a>
 	    		</div>


 	    <div class='content_box effect_slide_left_2'>
 	    	    
 	    	<div class="signin_box">

 	   			<form method='post' action='<?php echo app; ?>signin-check'>
                          <div class="error_box"></div>

                          <input type='email' placeholder='Email' name='email_in' maxlength='255' class='input' id='email_in'><br>
                         
                          <input type='password' placeholder='Password' name='password_in' maxlength='50' class='input' id='password_in'>

                          	<div class='permission_box'>
                          		<input type='checkbox' name='remember_me' checked>
                          		Remember me
                          	</div>
                          
                          <input type='submit' value='SIGN IN' class='submit_button' id='signin'>
                </form>

            </div>


                <div class="after_signin_box forgot_password"><a href='<?php echo security; ?>forgot_password'>Forgot Password?</a></div>
                <div class="after_signin_box create_account"><a href="<?php echo signup; ?>">Create Account</a></div>

 	    </div>



</body>
</html>