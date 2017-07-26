<?php 

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

    <div class='logo'><img src='http://cashfog.com/image/ot/cashfog_logo.png' alt='app_name' width='160px'></div>      

    <div class='content'>

        <b>Thank you for joining our platform!</b> <br><br><br>

        You are just one step away from verifying your cashfog account.<br>
        Click on the link giver below to verify: <br><BR>

        <a href='http://cashfog.com/Security/in3243424/rp23433424' class='link'>
            http://cashfog.com/security/in3243424/rp23433424
        </a> <br><BR>

        If this link is not working then you can <a href='http://cashfog.com/site/contactus' class='link'>contact us</a>.<Br><Br><Br>

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



//mail($to,$subject,$message,$headers);


?>
