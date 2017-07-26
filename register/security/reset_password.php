<?php
	
	include "../../includes/define.inc.php";

  include "../../includes/connect.inc.php";


?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			<?php echo "Reset Password | " . app_name; ?>
		</title>


              <META NAME='author' content='Raman Tehlan'>
              <META NAME='title' content ='Reset Password'>
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
                
              if(mysqli_num_rows(mysqli_query($connect , "SELECT * from `$db_name`.`users` where `ID` = '" . $_GET['id'] . "' and `RESET_CODE` = '" . $_GET['code'] . "' "))){
              
              session_start();
              
              //SESSION EMAIL FOR REFERENCE
              //used in code to refer
              $_SESSION[app_name . "user_id"] = $_GET['id'];
          ?>

           
                  <div class='box_heading'>
                      Reset Password
                  </div>

                  <div class='box_body'>
                       

                  </div>

                  <form method='post' action='#'>
                          <div class="action_box"></div>

                          <input type='password' placeholder='New Password'  maxlength='50' class='input' id='new_password'>

                          <input type='password' placeholder='Retype New Password '  maxlength='50' class='input' id='re_new_password'>
                          
                          <input type='submit' value='Reset' class='submit_button' id='reset'>
                </form>



                <script type="text/javascript">
                  
                  $(document).ready(function(){

  $("#reset").click(function(){

    var password    = document.getElementById("new_password").value;
    var re_password    = document.getElementById("re_new_password").value;

    var action_box  = $(".action_box"); 
    var button = $("#reset");
    action_box.show();


    if( password.length == 0 ){
       throw_error(action_box , action_box , empty_field_error);
       return false;
    }else if(!password_validity(password)) {
      throw_error(action_box , action_box , password_field_error);
      return false;
    }else if(password != re_password){
      throw_error(action_box , action_box , password_matching_error);
      return false;
    }else{
      button.prop('disabled', true);  
      action_box.html("Processing...");

      $.post("<?php echo url; ?>action/re/password_reset.php", {password:password} , function(response){
          action_box.html(response);
      });

      return false;
    }


  });

});

                </script>

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




