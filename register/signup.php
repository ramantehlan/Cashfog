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
		Sign Up - <?php echo app_name; ?>
	</title>

		      <META NAME='author' content='Raman Tehlan'>
              <META NAME='title' content ='Sign In'>
              <META NAME='keywords' content='Accounting Transactions Ledgers Expense Income Assets Liability Innovation cashfog cash Sign Up Register'>
              <META NAME='description' content="Sign up/Register to get access to our application.">
              <META NAME='language' content='English'>
              <META charset='utf-8'>
              <META NAME="ROBOTS" CONTENT="INDEX , NOFOLLOW">

	<link rel="shortcut icon" href="<?php echo img_fevicon; ?>" type="image/x-icon">
	<link rel="icon" href="<?php echo img_fevicon; ?>" type="image/x-icon">

 <link rel="stylesheet" href="<?php echo style_register; ?>comman-ui.css">
 <link rel="stylesheet" href="<?php echo style_register; ?>menu-ui.css">
 <link rel="stylesheet" href="<?php echo style_register; ?>signup-ui.css">

	<script type="text/javascript" src="<?php echo script; ?>jquery.js"></script>
	<script type="text/javascript" src="<?php echo script; ?>form-check.js"></script>
	<script type="text/javascript" src="<?php echo script_register; ?>check_signup.js"></script>

<?php


/*****************************************************************
ERROR HANDLER FOR SIGN UP PROCESS
{CODE}		{ERROR MEANING}
000		    UNKNOWN ERROR
001			NOT VALID EMAIL
002			INCOMPLETE INFO
003 		SESSION WAS NOT FOUND
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
			case '001':
					echo "error_box.html(error_001);";
				break;
			case '002':
					echo "error_box.html(error_002);";
				break;
			case '003':
					echo "error_box.html(error_003);";
				break;
			default:
					echo "error_box.html(error_000);";
				break;
		   }

		echo "}); </script>";
	}

 	    ?>

 	    	  <meta name='author' content='Raman Tehlan'>
              <meta name='title' content ='Sign Up - Cashflog'>
              <meta name='keywords' content='cash , fog , cashfog , accounting , ledgers , '>
              <meta name='description' content="Sign in to your cashfog account and manage your cash flow easily">
              <meta name='language' content='English'>
              <meta charset='urf-8'>  

</head>
<body>


			 	<div class="logo">
 	    				<a href="<?php echo url; ?>"><img src="<?php echo img_full_logo; ?>"  alt="<?php echo app_name; ?> logo"></a>
 	    		</div>



 	   <div class='content_box'>
             
             <div class="signup_box">
             	<div class="signup_heading">
             	Sign up for free 14-day trial
             	</div>

             	<form method="post" action="<?php  echo signup; ?>add" id="form">
               		<div class="error_box"></div>

 	   				<input type="company_name" placeholder="Company Name" id="company_name" name="company_name" class="input" maxlength="70" >

 		   			<input type="email" placeholder="Email" id="email" name="email" class="input" maxlength="255">

 	   				<input type="Password" placeholder="New Password" id="password" name="password" class="input" maxlength="128">

 	   				<input type="submit" name="submit" value="SIGN UP" class="submit_button" id="form_button">

 	   	  		 </form>

 	   	  		 		<div class="note_line">
 	   						By Signing up, you agree to our <a href='<?php echo site; ?>tc'>Term & Condition</a> and that you have read our <a href='<?php echo site; ?>privacy'>Privacy Policy</a>.
 	   					</div>

 	   	  	 </div>

 	   	  	 		<div class="after_signup_box alread_user">Already a user? <a href="<?php echo signin; ?>">Sign in</a></div>
 	    
 	  </div>



</body>
</html>