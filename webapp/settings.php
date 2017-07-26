<?php
session_start();

//to include the specific page
//this also work as the default page
$page_name  = "settings-account";

//to get required 
if(isset($_GET['page']))
{
  switch ($_GET['page']) {
    case 'account':
        $page_name  = "settings-account";
      break;
    case 'preferences':
        $page_name  = "settings-preferences";
      break;
    case 'security':
        $page_name  = "settings-security";
      break;
    case 'subscription':
        $page_name  = "settings-subscription";
      break;
    default:
        $page_name  = "settings-account";
      break;
  }
}


//bundle.inc is bundle of comman includes
include "../includes/bundle.inc.php";


?>
<!DOCTYPE html>
<html>
<head>
	<title>
		<?php echo app_name; ?>, Dashboard
	</title>

	

	  <?php 
	  		include "../includes/fragments/webapp/header-files.fragment.php";
	  ?>
	  

	  <link rel="stylesheet" type="text/css" href="<?php echo style_app; ?>settings-ui.css">

    <script type="text/javascript" src="<?php echo script; ?>form-check.js"></script>

</head>
<body>
 		
		<?php 

		include "../includes/fragments/webapp/background.fragment.php";

		 include "../includes/fragments/webapp/topbar.fragment.php";

		  include "../includes/fragments/webapp/leftmenu.settings.fragment.php";

		?>
 	    
 	    <div class="body_frame scroll_object">


        <div class="settings_body box_body dark_box_body effect_slide_top_1">

          <?php 

                 switch ($page_name) {
                        case 'settings-account':
                              include 'settings-account.php';
                           break;
                         case 'settings-preferences':
                            include 'settings-preferences.php';
                          break;
                        case 'settings-security':
                            include 'settings-security.php';
                          break;
                          case 'settings-subscription':
                            include 'settings-subscription.php';
                          break;
                      }

          ?>

        </div>

 	    </div>


<script type="text/javascript">
  
      switch("<?php echo $page_name; ?>"){
        case "settings-account":
            document.title = "<?php echo $lang['account settings']; ?> | <?php echo ucfirst(app_name); ?>";
        break;
        case "settings-preferences":
          document.title = "<?php echo $lang['preferences']; ?> | <?php echo ucfirst(app_name); ?>";
        break;
        case "settings-security":
          document.title = "<?php echo $lang['security']; ?> | <?php echo ucfirst(app_name); ?>";
        break;
        case 'settings-subscription':
          document.title = '<?php echo $lang['subscription']; ?> | <?php echo ucfirst(app_name); ?>';
        break;
      }

</script>

</body>
</html>