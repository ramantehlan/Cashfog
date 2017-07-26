<?php
session_start();

//this is to highlight the name of page in nevigation
$page_name 		= "transactions";
//to include the specific page
//this also work as the default page
$sub_page_name 	= "index";

//to get required 
if(isset($_GET['page']))
{
	switch ($_GET['page']) {
		case 'i':
				$sub_page_name 	= "index";
			break;
		case 'b':
				$sub_page_name 	= "ledger";
				$page_name 		= "ledger";
			break;
		case 'a':
				$sub_page_name 	= "asset";
				$page_name 		= "asset";
			break;
		case 'l':
				$sub_page_name 	= "liability";
				$page_name 		= "liability";
			break;
		case 'e':
				$sub_page_name 	= "expense_income";
				$page_name 		= "expense_income";
			break;
		default:
				$sub_page_name 	= "index";
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
		<?php echo $lang['transactions']; ?> | <?php echo ucfirst(app_name); ?>
	</title>

	

	  <?php 
	  		include "../includes/fragments/webapp/header-files.fragment.php";

	  ?>
	  
	                            <link rel="stylesheet" type="text/css" href="<?php echo style_app; ?>accounting-ui.css">
 <?php

	  			//to get the required header files according to the page
	  			if($sub_page_name == "index")
	  			{
	  				echo "
						     
						     
						     <link rel='stylesheet' type='text/css' href='" . style . "chosen.css'>
						     <link rel='stylesheet' type='text/css' href='" . style_app . "chosen_select.css'>
						     <link rel='stylesheet' type='text/css' href='" . style_app . "form-ui.css'>
						     <link rel='stylesheet' type='text/css' href='" . style_app . "accounting-index-ui.css'>
						     <link rel='stylesheet' type='text/css' href='" . style_app . "import_data-ui.css'>

						    <script type='text/javascript' src='" . script . "chosen.jquery.js'></script>
							<script type='text/javascript' src='" . script_app . "chosen_select.js'></script>
						    <script type='text/javascript' src='" . script . "form-check.js'></script>
							<script type='text/javascript' src='" . script_app . "accounting-index.js'></script>
							<script type='text/javascript' src='" . script_app . "account_create.js'></script>
							<script type='text/javascript' src='" . script_app . "transaction_record.js'></script>
							<script type='text/javascript' src='" . script_app . "import_data.js'></script>
							<script type='text/javascript' src='" . script_app . "accounting-edit.js'></script>
							";
							
	  			}
	  			else
	  			{
	  					echo "<link rel='stylesheet' type='text/css' href='" . style_app . "table-ui.css'>
							  <link rel='stylesheet' type='text/css' href='" . style_app . "accounting-display-ui.css'>


								<script type='text/javascript' src='" . script . "form-check.js'></script>	
								<script type='text/javascript' src='" . script_app . "accounting-display.js'></script>	
							";
	  			}

	  ?>

</head>
<body>
 		
		<?php 

		include "../includes/fragments/webapp/background.fragment.php";

		 include "../includes/fragments/webapp/topbar.fragment.php";

		 include "../includes/fragments/webapp/leftmenu.dashboard.fragment.php";

		?>
 	    


 	    <div class="body_frame scroll_object">
    				
    				

    				<div class="content_container">
    				<?php 

    					//include display plage according to the 
    					if($sub_page_name == "index"){

    								include "accounting-index.php";

    					}else{

    							include "accounting-display.php";
    					}

    				?>
    				</div>

    				

 	    </div>



</body>
</html>