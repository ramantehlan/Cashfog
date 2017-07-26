<?php
session_start();

//define.inc to get pre-defined values
include "../includes/define.inc.php";
//connect.inc to connect to mysql
include "../includes/connect.inc.php";
//validate_for.lib to get function to validate form
include "../includes/validate_form.lib.php";

$validate_form = new validate_form();

     //check if any session exist
     if(isset($_SESSION[app_name . 'session_name']))
     {
          //take action according to session name
          switch ($_SESSION[app_name . 'session_name']) 
          {
               case $session_name_signup:
                  
               break;
               case $session_name_signin:
                    header("location:" . url); 
               break;
               default:
                    //header("location:" . url); 
               break;
          }
     }



/******************************************************
check if post is comming from this site only 
and check if all the required fields are comming
*******************************************************/

		//if all required fields are comming 
		if(isset($_POST['company_name']) && isset($_POST['email']) && isset($_POST['password'])){

					if($validate_form -> validate_email($_POST['email'])){
				

							$email		  = $_POST['email'];
							$password	  = md5(base64_encode($_POST['password']));
							$company_name = $_POST['company_name'];
							$lang 		  = "EN";//strtoupper(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));
							$country 	  = "IN";
							$currency 	  = "INR";
							$home_page 	  = "hp1";
							$mode 		  = "mo1";
							$buyer_term   = "bt1";
							$seller_term  = "st1";
							$user_id	  = $country . date('ymdhis') . rand(10,10000);
							$financial_period = "fp4";

							//this is to produce random reset code
   							$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    						for ($i = 0; $i < 15; $i++) {
        						$n = rand(0, strlen($alphabet)-1);
        						$pass[$i] = $alphabet[$n];
    							}
    						$verification_code =  implode($pass)  . date('ymdhis');



							//mysql code to ender data
							$code ="INSERT INTO `$db_name`.`users` (
							`ID`, 
							`FIRST_NAME`, 
							`LAST_NAME`, 
							`EMAIL`, 
							`PASSWORD`,
							`GENDER`,  
							`DATE OF BIRTH`, 
							`COUNTRY`, 
							`LANGUAGE`, 
							`TIME_ZONE`, 
							`COMPANY_NAME`, 
							`WEBSITE`, 
							`INDUSTRY`,
							`FINANCIAL_PERIOD`, 
							`CURRENCY`,
							`TAX_ID`, 
							`ADDRESS`, 
							`STREET`, 
							`CITY`, 
							`STATE`, 
							`ZIP`, 
							`JOIN_DATE`, 
							`SERVICE_STARTING_DATE`, 
							`AMOUNT_PAID`, 
							`SERVICE_DATE_HISTORY`, 
							`AMOUNT_PAID_HISTORY`, 
							`LOGO`,
							`CONTACT_PHONE`,
							`CONTACT_EMAIL`,
							`HOME_PAGE`,
							`MODE`,
							`BUYER_TERM`,
							`SELLER_TERM`,
							`VERIFICATION_CODE`,
							`RESET_CODE`) 
							VALUES ('$user_id', NULL, NULL, '$email', '$password', NULL , NULL, '$country' , '$lang', NULL, '$company_name', NULL, NULL, '$financial_period' , '$currency', NULL ,NULL, NULL, NULL, NULL, NULL , CURRENT_TIMESTAMP, NULL, NULL, NULL, NULL, NULL , NULL , '$email' , '$home_page' , '$mode', '$buyer_term', '$seller_term' , '$verification_code',''); ";

							
							 //RUN db query to add user
							 mysqli_query($connect , $code);


$to = "mailcashfog@gmail.com";
$subject = "Verification Email";
$message = "

<html>
<head>
<title>Verification Email</title>

<style type='text/css'>
.box{background:#4056F4;
   width:600px;
   padding:50px;
   padding-top:40px;
   margin:0px auto;
   border-radius:3px;
   font-size:14px;
}

.content{background:#E5FCFF;
   padding:60px;
   padding-top:40px;
   padding-bottom:50px;
   border-radius:3px;
}


.logo{margin:0px auto;
    width:160px;
    margin-bottom:20px;
  }

.logo img{width:160px;
}

.link{text-decoration:none;}

</style>

</head>
<body>

<div class='box'>

    <div class='logo'><img src='" .  url . "image/ot/cashfog_logo.png' alt='app_name' width='160px'></div>      

    <div class='content'>

        <b>Thank you for joining our platform!</b> <br><br><br>

        You are just one step away from verifying your cashfog account.<br>
        Click on the link giver below to verify: <br><BR>

        <a href='" .  url . "security/verification?id=$user_id&code=$verification_code' class='link'>
            " .  url . "security/verification?id=$user_id&code=$verification_code
        </a> <br><BR>

        If this link is not working then you can <a href='" . site . "contactus' class='link'>contact us</a>.<Br><Br><Br>

        Warm Regards,<br>
        <b>Cashfog Team</B>
    </div>


</div>

</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: Cashfog Security<donotreply@cashfog.com>" . "\r\n";


if(online){
mail($to,$subject,$message,$headers);
}
							 session_destroy();

							 //Data of user has been uploaded successfully 
							 //Start session of user data

							 session_start();

							 $_SESSION[app_name . "session_name"] 	= $session_name_signin;
							 $_SESSION[app_name . "user_id"]		= $user_id;
							 $_SESSION[app_name . "email"]			= $email;
							 $_SESSION[app_name . "password"]		= $password;


							 $expense_income_accounts = array("Bank Fees and Charges",
							 								  "Cost of Goods Sold",
							 								  "Meals & Entertainment",
							 								  "Travel Expense",
							 								  "Telephone Expense",
							 								  "Shipping Charge",
							 								  "Salaries and Wages",
							 								  "Repairs/Maintenance",
							 								  "Other Expenses",
							 								  "Automobile Expense",
							 								  "Electricity Expense",
							 								  "Water Expense");

						 	for($i = 0; count($expense_income_accounts) > $i; $i++){

									$account_id = date('ymdhis') . rand(10,10000);


						 			$accounts = "INSERT INTO `$db_name`.`$accounts_table` (`ACCOUNT_ID`,
													`OWNER_ID`, 
													`ACCOUNT_TYPE`, 
													`CONTACT_SALUTATION`, 
													`CONTACT_FIRST_NAME`, 
													`CONTACT_LAST_NAME`, 
													`COMPANY_NAME`, 
													`ACCOUNT_TITLE`, 
													`CURRENCY`, 
													`DUE_DAYS`, 
													`ADDRESS`, 
													`STREET`, 
													`CITY`, 
													`STATE`, 
													`ZIP`, 
													`COUNTRY`, 
													`CONTACT_EMAIL`, 
													`CONTACT_PHONE`, 
													`CONTACT_MOBILE`,
													`WEBSITE`, 
													`COMMENT`, 
													`ACTIVITY_STATUS`, 
													`DATE_OF_CREATION`) VALUES ('$account_id', '$user_id', 'le4', '', '', '', '', '" .  $expense_income_accounts[$i] . "', '$currency', NULL, '', '', '', '', NULL , '', '', NULL , NULL , '' , '', '1', CURRENT_TIMESTAMP);";

								
						 			mysqli_query($connect , $accounts);		
						 	}
 

							 header("location:" . app . "dashboard");

       				}else{
         				//to handle the error of email validity
          				//send user back to signup page
          				header("location:" . signup . "error/001"); 
         			}

		}else{
			//to handle the error of broken information
          	//send user back to signup page
			header("location:" . signup  . "error/002");
		}


?>

<!DOCTYPE html>
<html>
<head>
	<title>
		<?php echo app_name; ?> | adding user
	</title>

	<link rel="shortcut icon" href="<?php echo img_fevicon; ?>" type="image/x-icon">
	<link rel="icon" href="<?php echo img_fevicon; ?>" type="image/x-icon">

 <link rel="stylesheet" href="<?php echo style_register; ?>comman-ui.css">
 <link rel="stylesheet" href="<?php echo style_register; ?>signup-ui.css">

 </head>
<body>
 		
		<div class='waiting_shadow'>

			 <div class="waiting_shadow_center">
	 			 <img src="<?php echo img_loading_gear; ?>">
   
    			 <div class="waiting_shadow_center_text">
      					Wait, We are setting up your account!
     			</div>

  			 </div>

		</div>

</body>
</html>