<?php 
/************************************************
This script is to reset/update the data of sale or purchase
chart

creator:- Raman tehlan
date of creation:- 10/03/2017
************************************************/

session_start();

//define.inc define the basic terms
include "../../define.inc.php";

//connect.inc to connect to db
include "../../connect.inc.php";

//decoder.lib is to decode recoded data of user
include "../../decoder.lib.php";
$decode = new decoder();

//get_db_info.lib is to get information from database
include "../../data_access.lib.php";
$access = new data_access();

//check session
if(isset($_SESSION[app_name . 'session_name'])){

		//check if all the required variables are set
		if( isset($_POST['request_type']) && isset($_POST['year']) && isset($_POST['financial_period']) && isset($_POST['country']) && isset($_POST['currency']) && isset($_POST['language']) && isset($_POST['account_id']) ) {

			/*
			this user id is very important to create 
			it is called a global in data_access 
			*/
			$USER_ID = $_SESSION[app_name . "user_id"];
			$FINANCIAL_PERIOD = $_POST['financial_period'];
			$LANGUAGE = $_POST['language'];


			//connect.inc to connect to db
			include "../../set_language.inc.php";

			$period = $decode -> financial_period($FINANCIAL_PERIOD , $_POST['year']);

			//if action type is t1 then it is expense
			//if action type is t2 then it is income
			if($_POST['request_type'] == "sale"){
				$chart_name = "sales_flow";
				$action_area_name = ".sales_action";
				$action_1 = "a1";
				$action_2 = "a2";
				$action_3 = "a5";
				// Id of div to display data
				$other_content = array("sales_content" , "payment_received_content" , "prerec_content" , "totrec_paid_content", "debit_note_received_content");
			}else if($_POST['request_type'] == "purchase"){
				$chart_name = "purchase_flow";
				$action_area_name = ".purchase_action";
				$action_1 = "a4";
				$action_2 = "a3";
				$action_3 = "a6";
				// Id of div to display data
				$other_content = array("purchase_content" , "payment_paid_content" , "prepay_content" , "totpay_content", "debit_note_sent_content");
			}else{
				return false;
			}

			$action_data = $access -> action_group($_POST['request_type'] , $_POST['year'] , $_POST['account_id']);
  
       	 	$action_monthly_1 = $access -> action_monthly($action_1 , $_POST['year'] , $_POST['account_id']);
        	$action_monthly_2 = $access -> action_monthly($action_2 , $_POST['year'] , $_POST['account_id']);
        	$action_monthly_3 = $access -> action_monthly($action_3 , $_POST['year'] , $_POST['account_id']);

			$action_data[0] = $decode -> money($action_data[0] , $_POST['country'] , $_POST['currency'] );
			$action_data[1] = $decode -> money($action_data[1] , $_POST['country'] , $_POST['currency'] );
			$action_data[2] = $decode -> money($action_data[2] , $_POST['country'] , $_POST['currency'] );
			$action_data[3] = $decode -> money($action_data[3] , $_POST['country'] , $_POST['currency'] );
			$action_data[4] = $decode -> money($action_data[4] , $_POST['country'] , $_POST['currency'] );
			
			echo "<script type='text/javascript'>

				$('#" .  $other_content[0] .  "').html('" . $action_data[0] . "');
				$('#" .  $other_content[1] .  "').html('" . $action_data[1] . "');
				$('#" .  $other_content[2] .  "').html('" . $action_data[2] . "');
				$('#" .  $other_content[3] .  "').html('" . $action_data[3] . "');
				$('#" .  $other_content[4] .  "').html('" . $action_data[4] . "');
				$chart_name.data.datasets[0].data = [" . $action_monthly_3[0] . "];
				$chart_name.data.datasets[1].data = [" . $action_monthly_1[0] . "];
				$chart_name.data.datasets[2].data = [" . $action_monthly_2[0] . "];
				$chart_name.data.xLabels = [" . $period[5] . "];
				$chart_name.data.labels = [" . $period[4] . "];
   			    $chart_name.update(600);

   			    //since data have been updated now we can hide cover
   			    setTimeout(function(){
   			    	$('.canvas_cover').hide();
   			    },600);

			</script>";

		}else{
			//not all post are set 
			//print error
			echo "
			<script type='text/javascript'>
  				$('.purchase_action').html(incomplete_info_error);
			</script>
			";
		}

}else
{
	//session don't exist 
	 //destroy session 
     session_destroy();
     //error of session not set 
     //send user back to sign in page
     header("location:" . signin . "error/005");
}


?>