<?php
	
	include "../../includes/define.inc.php";


  //this is to get GET message 
  if(isset($_GET['page'])){
    $page = $_GET['page'];
  }else{
    $page = 'about';
  }

  //this is default 
  $script = "";
  $keywords = "Accounting Transaction Maintain Ledgers Expense Income Assets Liability Innovation cashfog ";
  $robots = "INDEX, FOLLOW";

  //this is to define page
  switch ($page) {
    case 'about':
          $page = 'about';
          $title = 'About';
          $keywords .= "About";
          $description = "an online application to maintain business transactions.
                          Here you can control and maintain all your Ledgers, Assets, Liabilities, Expense and Income.
                          It is really simple and easy to use, and it comes with a very strong analytics tools.";
      break;
    case 'timeline':
          $page = 'timeline';
          $title = 'Timeline';
          $script = "<link href='http://fonts.googleapis.com/css?family=Droid+Serif|Open+Sans:400,700' rel='stylesheet' type='text/css'>
                  <link rel='stylesheet' href='" . style_site . "timeline.css'>
                    <script src='" . script . "modernizr.js'></script>
                    <script src='" . script_site . "timeline.js'></script>";
          $keywords .= "timeline";
          $description = "Timeline for our users to keep a track on our activities and updates, from the beginning till today.";
          $robots = "NOINDEX, FOLLOW";
      break;
    case 'security':
           $page = 'security';
          $title = 'Security';
          $keywords .= "security";
          $description = "We have taken various security measures to maintain the safety of your personal information. Check out 
                          some of these measures.";
          $robots = "NOINDEX, FOLLOW";
      break;
    case 'credit':
           $page = 'credit';
          $title = 'Credit';
          $keywords .= "credit";
          $description = "We are not just another service or application, it is more of a idea that powers it.";
          $robots = "NOINDEX, FOLLOW";
      break;
    case 'jobs':
           $page = 'jobs';
          $title = 'Jobs';
          $script = "<script src='https://www.google.com/recaptcha/api.js'></script>
                      <script type='text/javascript' src='" . script_site . "send_job_request.js'></script>";
          $keywords .= "jobs";
          $description = "We only look for people who are really passionate and dedicated to doing what they love. We
                          are looking for people who want this world to be a better place.";
          $robots = "INDEX, NOFOLLOW";
      break;
    case 'feedback':
           $page = 'feedback';
          $title = 'Feedback';
          $script = "<script src='https://www.google.com/recaptcha/api.js'></script>
                      <script type='text/javascript' src='" . script_site . "send_feedback.js'></script>";
          $keywords .= "feedback";
          $description = "We are constantly growing and innovating, to do so we need your feedback and suggestions.
                          We pay close attention to UX(User Experience) and UI(User Interface), we want it to be the best.";
          $robots = "INDEX, NOFOLLOW";
      break;
    case 'contactus':
           $page = 'contactus';
          $title = 'Contact us';
          $script = "<script src='https://www.google.com/recaptcha/api.js'></script>
                   </script><script type='text/javascript' src='" . script_site . "send_contactus_request.js'></script>";
          $keywords .= "contact us";
          $description = "Contact us and our team will contact you back very shortly.";
          $robots = "INDEX, NOFOLLOW";
      break;
    case 'tc':
             $page = 'tc';
          $title = 'Term & condition';
          $keywords .= "term & condition";
          $description = "Term & condition for using our application";
          $robots = "NOINDEX, FOLLOW";
      break;
    case 'privacy':
           $page = 'privacy';
          $title = 'Privacy policy';
          $keywords .= "Privacy Policy";
          $description = "Privacy Policy for using our application";
          $robots = "NOINDEX, FOLLOW";
      break;
    default:
        $page = "about";
          $title = "About";
          $keywords .= "about";
          $description = "An online application to maintain business transactions.
                          Here you can control and maintain all your Ledgers, Assets, Liabilities, Expense and Income.
                          It is really simple and easy to use, and it comes with a very strong analytics tools.";
    break;
  }


?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			<?php echo $title . " | " . app_name; ?>
		</title>


              <META NAME='author' content='Raman Tehlan'>
              <META NAME='title' content ='<?php echo $title; ?>'>
              <META NAME='keywords' content='<?php echo $keywords; ?>'>
              <META NAME='description' content="<?php echo $description; ?>">
              <META NAME='language' content='English'>
              <META charset='utf-8'>
              <META NAME="ROBOTS" CONTENT="<?php echo $robots; ?>">

  <link rel="shortcut icon" href="<?php echo img_fevicon; ?>" type="image/x-icon">
  <link rel="icon" href="<?php echo img_fevicon; ?>" type="image/x-icon">

    <link rel="stylesheet" href="<?php echo style; ?>comman-ui.css">    
    <link rel="stylesheet" href="<?php echo style; ?>top-ui.css">
    <link rel="stylesheet" href="<?php echo style; ?>bottom-ui.css">
    <link rel="stylesheet" href="<?php echo style_site; ?>comman-ui.css">
    <link rel="stylesheet" href="<?php echo style_site; ?>menu-ui.css">
    <link rel="stylesheet" href="<?php echo style_site; ?>form-ui.css">


      <script type="text/javascript" src="<?php echo script;?>jquery.js"></script>
      <script type="text/javascript" src="<?php echo script;?>form-check.js"></script>
      <?php echo $script; ?>

    

	</head>
	<body>
		
	<?php
 		include "../../includes/fragments/top.fragment.php";
 	?>

 	<?php
 	    include "../../includes/fragments/site/menu.fragment.php";


 	?>	

    <div class='body_frame'>
    <?php
        include "$page.php";
    ?>
    </div>
	

	<?php
 		//include "../../includes/fragments/bottom.fragment.php";
 	?>
	</body>




