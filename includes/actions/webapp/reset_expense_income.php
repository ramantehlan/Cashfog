<?php 
/************************************************
This script is to reset/update the data of cashflow
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
		if( isset($_POST['action_type']) && isset($_POST['year']) && isset($_POST['month'])  && isset($_POST['financial_period']) && isset($_POST['country']) && isset($_POST['currency']) && isset($_POST['language']) ) {

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

			$new_options = explode(",", $period[4]);

			$data =   $access -> book_source( 'le4' , $_POST['action_type'] , $_POST['year'] , $_POST['month'] );

			//if action type is t1 then it is expense
			//if action type is t2 then it is income
			if($_POST['action_type'] == "t1"){
				$chart_name = "expense";
				$action_area_name = ".expense_action";
				$data_value = 'expense_value';
				$select_year = "expense_chart_month";
			}else{
				$chart_name = "income";
				$action_area_name = ".income_action";
				$data_value = 'income_value';
				$select_year = "income_chart_month";
			}


			$data[0] = $decode -> money($data[0] , $_POST['country'] , $_POST['currency'] );


			$option_script = "var select_year = document.getElementById('$select_year'); \n";

			for($i = 1; 13 > $i; $i++){
					$option_script .= "var option$i = document.createElement('option');\n" . 
									  "select_year.remove($i);\n" .
									   "option$i.text = '" . str_replace("'", '', $new_options[($i - 1)]) . "'" .
    				 				   "\noption$i.value = '" . $period[3][$i - 1]  .  "';\n" .
    				 				   "select_year.add(option$i, select_year[$i]);\n\n";
    				 				   
			}
			
			echo "<script type='text/javascript'>
				
				$option_script

				$('#$select_year').val('" . $_POST['month'] . "');

				$('#$data_value').html('" . $data[0] . "');
				$chart_name.data.labels = [" . $data[1] . "];
				$chart_name.data.datasets[0].data = [" . $data[2] . "];
   			    $chart_name.update(600);

			</script>";

		}else{
			//not all post are set 
			//print error
			echo "
			<script type='text/javascript'>
  				$('$action_area_name').html(incomplete_info_error);
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