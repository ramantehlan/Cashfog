<?php
/************************************************
this script is to update security settings of user 

creator:- Raman tehlan
date of creation:- 30/11/2016
************************************************/


	//check if all post values are coming
	if(isset($_POST['email']) )
	{

		//define.inc to get pre-defined values
		include "../../define.inc.php";
		//connect.inc to connect to mysql
		include "../../connect.inc.php";
		//validate_for.lib to get function to validate form
		include "../../validate_form.lib.php";
		$validate_form = new validate_form();


		
		if( !($validate_form -> validate_email($_POST['email']) ) ){

			//this is to get user id and previous reset code if exist
			$get_data = mysqli_query($connect , "SELECT * from `$db_name`.`users` where `EMAIL` = '" . $_POST['email'] . "'");
			$data 	= mysqli_fetch_array($get_data);

			if($data['RESET_CODE'] == ""){
					//this is to produce random reset code
   					$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    				for ($i = 0; $i < 15; $i++) {
        					$n = rand(0, strlen($alphabet)-1);
        					$pass[$i] = $alphabet[$n];
    					}
    				$reset_code =  implode($pass)  . date('ymdhis');


					$set_code = "UPDATE `$db_name`.`users` SET `RESET_CODE` = '$reset_code' WHERE `users`.`ID` = '" . $data['ID'] . "';";
					mysqli_query($connect , $set_code);

					$reset_link = url . "security/reset_password?id=" . $data['ID'] . "&code=$reset_code";
					
			}else{
					$reset_link = url . "security/reset_password?id=" . $data['ID'] . "&code=" . $data['RESET_CODE'];
					
			}

			

			$to = $_POST['email'];
			$subject = "Reset Password";
			$message = "
<html>
<head>
<title>Reset Password</title>

<style type='text/css'>
.box{background:#0C8FCC;
   width:600px;
   padding:50px;
   padding-top:40px;
   margin:0px auto;
   border-radius:3px;
   font-size:14px;
}

.content{background:white;
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

    <div class='logo'><img src='" . url . "image/ot/cashfog_logo.png' alt='app_name' width='160px'></div>      

    <div class='content'>

        <b>Reset Password</b> <br><br><br>

        To reset your password click on the link given below.<br><br>

        <a href='$reset_link' class='link'>
            $reset_link
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


$response = '<div class="box_heading">' .
                      'Reset Link Sent' .  
                  '</div>'.
                  '<div class="box_body">'.
                  		'We have successfully sent a link to <b>' . $_POST['email'] .
                  		'</b>. Click on the link to reset password.' .
                  '</div>';



echo "<script>
			$('document').ready(function(){
					$('.box').html('$response');
			});
</script>";


		}else{
			//email is not found
			echo "Email not found";
		}				
		
	}else{
		//information coming from session is incomplete
		//using javascript to show error box
		echo "Incomplete Information";
	}


?>