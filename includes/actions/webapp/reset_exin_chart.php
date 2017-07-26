<?php 
/************************************************
This script is to reset/update the data of expense/income
chart

creator:- Raman tehlan
date of creation:- 19/04/2017
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
		if(isset($_POST['year']) && isset($_POST['country']) && isset($_POST['currency']) && $_POST['financial_period'] && $_POST['language']) {

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

			$chart_data = $access -> book_monthly( 'le4' , $_POST['year']);
			$ledger_data = $access -> book('le4' , true  , $_POST['year'] , "");


			$expense = $decode -> money($ledger_data[0] , $_POST['country'] , $_POST['currency'] );
			$income = $decode -> money($ledger_data[1] , $_POST['country'] , $_POST['currency'] );
			$monthly_expense = $decode -> money( ($ledger_data[0]/12) , $_POST['country'] , $_POST['currency'] );
			$montly_income = $decode -> money( ($ledger_data[1]/12) , $_POST['country'] , $_POST['currency'] );
			$profit = $decode -> money( ($ledger_data[1] - $ledger_data[0]) , $_POST['country'] , $_POST['currency'] );


			
			echo "<script type='text/javascript'>


				
				exin_flow.data.datasets[0].data = [" . $chart_data[0] . "];
				exin_flow.data.datasets[1].data = [" . $chart_data[1] . "];
				exin_flow.data.xLabels = [" . $period[5] . "];
				exin_flow.data.labels = [" . $period[4] . "];
   			    exin_flow.update(600);

   			    //since data have been updated now we can hide cover
   			    setTimeout(function(){
   			    	$('.canvas_cover').hide();
   			    },600);


   				 $('#expense_content').html('$expense');
    			 $('#income_content').html('$income');
    			 $('#month_expense_content').html('$monthly_expense');
    			 $('#month_income_content').html('$montly_income');
    			 $('#profit_content').html('$profit');

			</script>";

		}else{
			//not all post are set 
			//print error
			echo "
			<script type='text/javascript'>
  				$('.exin_action').html(incomplete_info_error);
			</script>
			";
		}

}else
{
	//session don't exist 
	//session don't exist 
	 //destroy session 
     session_destroy();
     //error of session not set 
     //send user back to sign in page
     header("location:" . signin . "error/005");
}


?>