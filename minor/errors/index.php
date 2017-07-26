
<?php

session_start();

//define.inc to get pre defined values
include "../../includes/define.inc.php";


		
	//check if error_code is set
	if(isset($_GET['error_code']))
	{
		$error_code = $_GET['error_code'];
	}
	else
	{
		$error_code = 404;
	}

	//to define the contact link
	$contact_us = site . "contactus";

	switch ($error_code) {


		case '403':
				$title = "Forbidden";
				$body  = "Your request can not be completed because the page you are trying to access is secure and forbidden for any visiter or user. We request you to not access any such page again and as a precaution we have saved your information like IP address. If you have any questions regarding our services please feel free to <a href='$contact_us'>contact us</a>. <br><br>Warm Regards,<br><span class='last_line'>" . app_name . " Team</span>";
		break;
		case '404':
				$title = "Page Not Found";
				$body  = "It seems as if the page you are looking for don't exist or we have removed it. Don't worry it happens, check URL or go back to previous page and try clicking on same link again. If page is still not found and is removed by us, you can feel free to <a href='$contact_us'>contact us</a>. <br><br>Warm Regards,<br><span class='last_line'>" . app_name . " Team</span>";
		break;
		case '414':
				$title = "Request-URI Too Long";
				$body  = "";
		break;




		case '500':
				$title = "Internal Server Error";
				$body  = "Our server encountered an internal error or misconfiguration, so it is unable to complete your request. Our team is working on it but if you are encountering this error from many days we request you to please <a href='$contact_us'>contact us</a>. <br><br>Warm Regards,<br><span class='last_line'>" . app_name . " Team</span>";
		break;

		case '503':
				$title = "server is overloaded";
				$body  = "Our server is overloaded by too many requests so it won't be able to work with full capability or it might be completely unavailable. We are very sorry for this but don't worry, our team is working on the problem and soon our services will start working with full power. If you have any question you can feel free to <a href='$contact_us'>contact us</a>. <br><br>Warm Regards,<br><span class='last_line'>" . app_name . " Team</span>";
		break;
		case '507':
				$title = "Insufficient Storage";
				$body  = "Our server is running out of storage, We are very sorry for this and we are working on the storage problem, soon it will be fixed and all the services will be functional again. If you have any query, just feel free to <a href='$contact_us'>contact us</a>. <br><br>Warm Regards,<br><span class='last_line'>" . app_name . " Team</span>";
		break;
		case '508':
				$title = "Loop Detected";
				$body  = "You have detected a loop in our app. This loop should not be there so we request you to <a href='$contact_us'>contact us</a> and be a hero for our team by informing us about this problem. We will fix it as soon as will can, so you and other users don't have to face it again. <br><br>Warm Regards,<br><span class='last_line'>" . app_name . " Team</span>";
		break;
		case '521':
				$title = "Web Server Is Down";
				$body  = "Our app is getting more traffic then what our server is capable of, so our server is down, but don't worry we are upgrading our server and working on the problem to make our app/services available again. If you wish to <a href='$contact_us'>contact us</a> please feel free. <br><br>Warm Regards,<br><span class='last_line'>" . app_name . " Team</span>";
		break;




		default:
				$error_code = 404;
				$title = "Page Not Found";
				$body  = "It seems as if the page you are looking for don't exist or we have removed it. Don't worry it happens, check URL or go back to previous page and try clicking on same link again. If page is still not found and is removed by us, you can feel free to <a href='$contact_us'>contact us</a>. <br><br>Warm Regards,<br><span class='last_line'>" . app_name . " Team</span>";
		break;
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>
		<?php echo $error_code; ?> - <?php echo app_name; ?>
	</title>

	<link rel="shortcut icon" href="<?php echo img_fevicon; ?>" type="image/x-icon">
	<link rel="icon" href="<?php echo img_fevicon; ?>" type="image/x-icon">

		
	    <link rel="stylesheet" href="<?php echo style_errors; ?>comman-ui.css">	

 	   		<meta name='author' content='Raman Tehlan'>
            <meta name='title' content ='404 - <?php echo app_name; ?>'>
            <meta name='keywords' content='cash , fog , cashfog , accounting , ledgers , 404 page'>
            <meta name='description' content="Page don't exist on this app.">
            <meta name='language' content='English'>
            <meta charset='urf-8'>  

</head>
<body>

	<div class="topbar">
				<div class="logo">
						<img src="<?php echo img_full_logo; ?>" alt="cashfog logo">
				</div>
	</div>

	<div class="content">

			
				<div class="heading capital">
						<?php echo $error_code; ?> error
				</div>
				<div class="describe">
					<?php echo $title; ?>
				</div>
				<div class="passage">
						<?php echo $body; ?>
				</div>
	</div>


</body>
</html>