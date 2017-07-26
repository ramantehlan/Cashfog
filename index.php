<?php
session_start();

//define.inc to get pre defined values
include "includes/define.inc.php";

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
          header("location:" . app . "dashboard"); 
      break;
      
      default:
        //header("location:" . url); 
      break;
    }
  }


  if(isset($_COOKIE[$cookie_signin]))
  {
     $_SESSION[app_name . "session_name"]   = $session_name_signin;
     $_SESSION[app_name . "user_id"]        = $_COOKIE[app_name . "user_id"];
     $_SESSION[app_name . "email"]          = $_COOKIE[app_name . "email"];
     $_SESSION[app_name . "password"]       = $_COOKIE[app_name . "password"];

     header("location:" . app . "dashboard"); 
  }


?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Cashfog- Transactions Bank
	</title>

<link rel="shortcut icon" href="<?php echo img_fevicon; ?>" type="image/x-icon">
<link rel="icon" href="<?php echo img_fevicon; ?>" type="image/x-icon">

	<link rel="stylesheet" href="<?php echo style; ?>comman-ui.css">
 	<link rel='stylesheet' href="<?php echo style; ?>top-ui.css">
 	<link rel='stylesheet' href="<?php echo style; ?>bottom-ui.css">  
  <link rel="stylesheet" href="<?php echo style_index; ?>main-ui.css">
  <link rel='stylesheet' href='<?php echo style_index; ?>headline.css'>


  <script src='<?php echo script; ?>jquery.js'></script>
  <script src='<?php echo script; ?>modernizr.js'></script>
  <script src='<?php echo script_index; ?>headline.js'></script>



              <META NAME='author' content='Raman Tehlan'>
              <META NAME='title' content ='Cashfog- Transactions Bank'>
              <META NAME='keywords' content='Accounting Transactions Ledgers Expense Income Assets Liability Innovation cashfog cash'>
              <META NAME='description' content="Online Application to maintain all your business transactions.">
              <META NAME='language' content='English'>
              <META charset='utf-8'>
              <META NAME="ROBOTS" CONTENT="INDEX , FOLLOW">
              <meta name="google-site-verification" content="cAXDl-wynLlduo8O6QN2IG2IkqaXRd55KPsfPRnXDXw" />



<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "WebSite",
  "url": "https://www.example.com/",
  "about": "Online Application to maintain business transactions.",
   "author": {
        "@type" : "Person",
            "name" : "Raman Tehlan",
            "url" : "http://www.cashfog.com/site/credit"
           }
}
</script>
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Organization",
  "name": "Cashfog",
  "url": "http://www.example.com",
  "logo": "http://www.example.com/images/logo.png",
  "founder" : {
      "@type" : "Person",
        "name" : "Raman Tehlan",
        "url" : "http://www.cashfog.com/site/credit"
    },
    "sameAs": [
    "https://www.facebook.com/Cashfog-1207150749372201/",
    "http://www.twitter.com/cashfoginc",
    "https://www.youtube.com/channel/UCpWNOGgcISvyBNsEW-GBAsg"
  ]
   
}
</script>



    <script type="text/javascript">
      
      $('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
      
    </script>

</head>
<body>

 	<?php
 		include "includes/fragments/top.fragment.php";
 	?>

    
 	<div class='first_body index_page_body'>
        <div class='bg_shadow'>
 			<div class='first_body_center'>
         <div class='cd-headline rotate-1 first_body_center_heading'>
             
              <h1 class='heading'>Manage your Business
             <div class="cd-words-wrapper">
                     <b class="is-visible">Ledgers</b>
                     <b>Assets</b>
                     <b>Liabilities</b>
                     <b>Expense</b>
                     <b>Income</b>
             </div> 
             </h1>
               

 				 </div>

 				 <div class='first_body_center_passage'>
                        <h2 class='content'><?php echo app_name; ?> is smarter and easier service to maintain transactions.</h2>
 				 </div>

 				 <div class='first_body_center_end'>
 				        <div class='first_body_center_end_message'>
 				        	Free Trial
 				        </div>
		        		<a href='<?php echo url;?>signup' ><input type="button" class='signup_button' value="START HERE"></a>
 				 </div>
 			</div>
 		</div>
 	</div>

  

   <div class='row_body '>
      <div class='row_body_center how_body'>
        <div class='row_body_heading even_heading'>
          <b>How It Works</b>
        </div>

        <div class ='line_of_row'>
          <div class='line_of_row_box'>
              <div class='line_of_row_box_icon'>
                <img src="<?php echo image_icon; ?>front_step_1.png" alt='Record Transactions'>
              </div>
              <div class='line_of_row_box_heading even_heading'> 
                1-Record Transactions
              </div>
              <div class='line_of_row_box_passage even_passage'>
              Create accounts in four categories ledger, assets, liabilities and expense/income. Then record your transactions 
              in those accounts.
              </div>
          </div>
          <div class='line_of_row_box'>
            <div class='line_of_row_box_icon'>
                <img src="<?php echo image_icon; ?>front_step_2.png" alt='Analyze'>
              </div>
              <div class='line_of_row_box_heading even_heading'> 
                2-Analyze
              </div>
              <div class='line_of_row_box_passage even_passage'>
              Analyses can be done right after creation of all the required accounts and recoding transactions. It takes just few
              seconds to get started with analyses.
              </div>
          </div>
          <div class='line_of_row_box'>
            <div class='line_of_row_box_icon'>
                <img src="<?php echo image_icon; ?>front_step_3.png" alt='Grow'>
              </div>
              <div class='line_of_row_box_heading even_heading'> 
                3-Grow
              </div>
              <div class='line_of_row_box_passage even_passage'>
              You can now take decisions which are not just on your instincts but are data driven so you can now grow faster and accurately.
              </div>
          </div>
        </div>

        <a href='<?php echo url ?>demo'><div class='try_demo'>
            Try Demo
        </div></a>
          
            </div>
 </div>

 	 <div class='row_body odd_row_body'>
 			<div class='row_body_center'>
 				<div class='row_body_heading odd_heading'>
 					 Features
 				</div>

 				<div class ='line_of_row'>
 					<div class='line_of_row_box'>
 							<div class='line_of_row_box_icon'>
 							  <img src="<?php echo image_icon; ?>feature_access_worldwide.png" alt='access Worldwide'>
 							</div>
 							<div class='line_of_row_box_heading odd_heading'> 
 								Access Worldwide
 							</div>
 							<div class='line_of_row_box_passage odd_passage'>
 							Our platform can be accessed from anywhere at anytime in this world.
 							</div>
 					</div>
 					<div class='line_of_row_box'>
 						<div class='line_of_row_box_icon'>
 							  <img src="<?php echo image_icon; ?>feature_safe.png" alt='safe'>
 							</div>
 							<div class='line_of_row_box_heading odd_heading'> 
 								Safe
 							</div>
 							<div class='line_of_row_box_passage odd_passage'>
 							Connections and date is encrypted, so only you can access it.
 							</div>
 					</div>
 					<div class='line_of_row_box'>
 						<div class='line_of_row_box_icon'>
 							  <img src="<?php echo image_icon; ?>feature_upload_documents.png" alt='upload documents'>
 							</div>
 							<div class='line_of_row_box_heading odd_heading'> 
 								Upload Documents
 							</div>
 							<div class='line_of_row_box_passage odd_passage'>
 							You can upload important business documents.
 							</div>
 					</div>
 				</div>

 				<div class ='line_of_row'>
 					<div class='line_of_row_box'>
 						<div class='line_of_row_box_icon'>
 							  <img src="<?php echo image_icon; ?>feature_realtime.png" alt='Real Time'>
 							</div>
 							<div class='line_of_row_box_heading odd_heading'> 
 								Real Time
 							</div>
 							<div class='line_of_row_box_passage odd_passage'>
 							Everything is in real time, so you are always updated. 
 							</div>
 					</div>
 					<div class='line_of_row_box'>
 						<div class='line_of_row_box_icon'>
 							  <img src="<?php echo image_icon; ?>feature_backup.png" alt='back up'>
 							</div>
 							<div class='line_of_row_box_heading odd_heading'> 
 								Back up
 							</div>
 							<div class='line_of_row_box_passage odd_passage'>
 							Every 24 Hour, we back up your data, so you never loose your work.
 							</div>
 					</div>
 					<div class='line_of_row_box'>
 						<div class='line_of_row_box_icon'>
 							  <img src="<?php echo image_icon; ?>feature_effective.png" alt='Effective'>
 							</div>
 							<div class='line_of_row_box_heading odd_heading'> 
 								Effective
 							</div>
 							<div class='line_of_row_box_passage odd_passage'>
 							Every minor operation is optimized, so you can have more free time.
 							</div>
 					</div>
 				</div>

            </div>
 	</div>




 	<div class='row_body odd_row_body package_body' >

 			    		<div class='package_box'>
                                <div class='package_box_top_box'>
 			    						<div class="package_box_heading">
 			    							 Pricing
 			    						</div>
 			    						<div class="package_box_price">
 			    								<?php //&#x20b9; <?php echo annual_package_price; /Year <br><br> ?>
                            *For now our services are free
 			    						</div>
 			    				</div>
 			    				<div class='package_box_body'>
 			    					 <div class='package_box_body_passage'>
 			    					     You will have access to all the features
 			    					</div>

                        <ul class='package_box_list'>
                          <li>Analyze in real time.</li>
                          <li>Edit anytime & anywhere.</li>
                          <li>Create unlimited financial accounts.</li>
                          <li>Upload documents (100MB).</li>
                        </ul>

                          <input type="button" class='pricing_button' value="SIGN UP" >

 			    				</div>
 			    		</div>
        
 	</div>

 	<div class='row_body '>
 			<div class='row_body_center users_review_row'>
 				<div class='row_body_heading'>
 					<img src="<?php echo image_other; ?>quotation-marks.png" class='quote_icon' alt='quotation'>
 				</div>
 				<div class='row_body_passage quote'>
 				I love that <?php echo app_name; ?> is simple and easy to use. It's easy to maintain my ledgers and get real time status of my business. I can now upload my documents and access them anywhere. 
 				
 				 	<div class='bottom_quote_credit'>
 					 	<img src="<?php echo image_other; ?>ashok-kumar.png" alt='testimonial'>  

 						 <div class='button_quote_credit_caption'><b>Ashok Kumar</b>, Ms Construction co.</div>
 					</div>
 				</div>

       </div>
 	</div>

 		<?php
 		include "includes/fragments/bottom.fragment.php";
 	?>
</body>
</html>