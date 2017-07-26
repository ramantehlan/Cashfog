<?php
session_start();

//this is to highlight the name of page in nevigation
$page_name = "analysis";

//bundle.inc is bundle of comman includes
include "../includes/bundle.inc.php";


?>
<!DOCTYPE html>
<html>
<head>
	<title>
		<?php echo app_name; ?> | Analysis
	</title>

	

	  <?php 
	  		include "../includes/fragments/webapp/header-files.fragment.php";
	  ?>



	<script type="text/javascript" src="../assets/scripts/chartjs/chart.js"></script>	
	

		<link rel="stylesheet" type="text/css" href='<?php echo style_app; ?>analysis-ui.css'>	  


</head>
<body>
 		
		<?php 

		include "../includes/fragments/webapp/background.fragment.php";

		 include "../includes/fragments/webapp/topbar.fragment.php";

		 include "../includes/fragments/webapp/leftmenu.dashboard.fragment.php";

		?>
 	    
 	    <div class="body_frame scroll_object">
    		
    		

    		
 	    </div>


</body>
</html>