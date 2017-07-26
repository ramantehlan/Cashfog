<?php
	
	include "../../includes/define.inc.php";

?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			<?php echo "Forgot Password | " . app_name; ?>
		</title>


              <META NAME='author' content='Raman Tehlan'>
              <META NAME='title' content ='Forgot Password'>
              <META NAME='keywords' content='-'>
              <META NAME='description' content="-">
              <META NAME='language' content='English'>
              <META charset='utf-8'>
              <META NAME="ROBOTS" CONTENT="noindex , nofollow">
          

  <link rel="shortcut icon" href="<?php echo img_fevicon; ?>" type="image/x-icon">
  <link rel="icon" href="<?php echo img_fevicon; ?>" type="image/x-icon">

    <link rel="stylesheet" href="<?php echo style_register; ?>comman-ui.css">  
    <link rel="stylesheet" href="<?php echo style_register ?>forgot_password-ui.css">  


      <script type="text/javascript" src="<?php echo script;?>jquery.js"></script>
      <script type="text/javascript" src="<?php echo script;?>form-check.js"></script>


    

	</head>
	<body>

           <div class="logo effect_slide_top_1">
              <a href="<?php echo url; ?>"><img src="<?php echo img_full_logo; ?>"  alt="<?php echo app_name; ?> logo"></a>
          </div>


        <div class='content_box effect_slide_left_2'>
            
            <div class="box">
                  <div class='box_heading'>
                      Forgot Password?
                  </div>

                  <div class='box_body'>
                        Follow steps given below to reset password. In case you have already tried
                         this and haven't received any reset link, you can contact us.
                        <ul>
                          <li><b>Step 1: </b> Enter your email to get a reset link.</li>
                          <li><b>Step 2: </b> Open your email and click on the reset link.</li>
                          <li><b>Step 3: </b> Enter new password.</li>
                        </ul>

                  </div>
                  <form method='post' action='#'>
                          <div class="action_box"></div>

                          <input type='email' placeholder='Email' name='email_in' maxlength='255' class='input' id='email_in'><br>
                          
                          <input type='submit' value='Send' class='submit_button' id='Send'>
                </form>


            </div>

         <div class="after_box forgot_password">Got it? <a href='<?php echo signin ?>'>Sign In</a></div>
          

        </div>
		


	</body>
  <script type="text/javascript">
      
  $(document).ready(function(){

  $('#Send').click(function(){

    var email    = document.getElementById("email_in").value;

    var action_box  = $(".action_box"); 
    var button     = $("#Send");
    action_box.show();

    if(email.length == 0 )
    {
       throw_error(error_box , error_box , empty_field_error);
       return false;
    }
    else if(!email_validity(email))
    {
      throw_error(error_box , error_box , email_field_error);
      return false;
    }else{
      button.prop('disabled', true);  
      action_box.html("Processing...");
      $.post("<?php echo url; ?>action/re/send_reset_link.php", {email:email} , function(response){
          action_box.html(response);
      });

      return false;
    }


  });

});


  </script>
</html>




