<?php
	
	include "../../includes/define.inc.php";

  include "../../includes/connect.inc.php";


?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			<?php echo "Verification | " . app_name; ?>
		</title>


              <META NAME='author' content='Raman Tehlan'>
              <META NAME='title' content ='Verification'>
              <META NAME='keywords' content='-'>
              <META NAME='description' content="-">
              <META NAME='language' content='English'>
              <META charset='utf-8'>
              <META NAME="ROBOTS" CONTENT="noindex , nofollow">
          

  <link rel="shortcut icon" href="<?php echo img_fevicon; ?>" type="image/x-icon">
  <link rel="icon" href="<?php echo img_fevicon; ?>" type="image/x-icon">

    <link rel="stylesheet" href="<?php echo style_register; ?>comman-ui.css">  
    <link rel="stylesheet" href="<?php echo style_register ?>redirect-ui.css">  


      <script type="text/javascript" src="<?php echo script;?>jquery.js"></script>
      <script type="text/javascript" src="<?php echo script;?>form-check.js"></script>

    

	</head>
	<body>

           <div class="logo effect_slide_top_1">
              <a href="<?php echo url; ?>"><img src="<?php echo img_full_logo; ?>"  alt="<?php echo app_name; ?> logo"></a>
          </div>


        <div class='content_box effect_slide_left_2'>
                <div class="box">
          
          <?php 
              if(isset($_GET['id']) && isset($_GET['code'])){
                
              if(mysqli_num_rows(mysqli_query($connect , "SELECT * from `$db_name`.`users` where `ID` = '" . $_GET['id'] . "' and `VERIFICATION_CODE` = '" . $_GET['code'] . "' "))){

              $code = "UPDATE `$db_name`.`users` SET `VERIFICATION_CODE` = '' WHERE `users`.`ID` = '" . $_GET['id'] . "';";

              //running code
              mysqli_query($connect , $code);
              
          ?>

           
                  <div class='box_heading'>
                    Email Verified
                  </div>

                  <div class='box_body'>
                       Your email has been successfully verified, you can continue using our services now.
                  </div>

            <?php
                }else{
                  //get is proper 
                  //but code or id don't match
            ?>
                  <div class='box_heading'>
                      Wrong Verification Code
                  </div>

                  <div class='box_body'>
                      Verification code has expired or Don't exist. We request you to try resending the email or you can <a href='" . site . "contactus' class='link'>contact us</a>.
                      <br><BR>
                              Warm Regards,<br>
                              <b>Cashfog Team</B>
                  </div>


            <?php 
                }

              }else{
                //link is broken and not properly set
            ?>
                  <div class='box_heading'>
                      Link is broken
                  </div>

                  <div class='box_body'>
                      Reset link is broken or don't exist. We request you to try resending the email or you can <a href='" . site . "contactus' class='link'>contact us</a>.
                      <br><BR>
                              Warm Regards,<br>
                              <b>Cashfog Team</B>
                  </div>

            <?php 
                }

            ?>
          
            </div>
        </div>
		


	</body>
</html>




