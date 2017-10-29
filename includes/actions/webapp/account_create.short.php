<?php
/************************************************
this script is shortcut to create account

creator:- Raman tehlan
date of creation:- 17/02/2017
************************************************/
	
session_start();

//define.inc define the basic terms
include "../../define.inc.php";

//connect.inc to connect to db
include "../../connect.inc.php";

//decoder.lib is to decode recoded data of user
include "../../decoder.lib.php";
$decode = new decoder();

//check if session exist
if(isset($_SESSION[app_name . 'session_name'])){

		if(isset($_POST['account_title']) && isset($_POST['currency']) && isset($_POST['account_type'])){


					//user_id (owner_id)
					$user_id = $_SESSION[app_name . "user_id"];

					$account_id = date('ymdhis') . rand(10,10000);
					$account_type 	 	= $_POST['account_type'];
					$account_title 	 	= $_POST['account_title'];
					$currency	 	 	= $_POST['currency'];
					

				
					$code = "INSERT INTO `$db_name`.`$accounts_table` (`ACCOUNT_ID`,
													`OWNER_ID`, 
													`ACCOUNT_TYPE`, 
													`CONTACT_SALUTATION`, 
													`CONTACT_FIRST_NAME`, 
													`CONTACT_LAST_NAME`, 
													`COMPANY_NAME`, 
													`ACCOUNT_TITLE`, 
													`CURRENCY`, 
													`DUE_DAYS`, 
													`ADDRESS`, 
													`STREET`, 
													`CITY`, 
													`STATE`, 
													`ZIP`, 
													`COUNTRY`, 
													`CONTACT_EMAIL`, 
													`CONTACT_PHONE`, 
													`CONTACT_MOBILE`,
													`WEBSITE`, 
													`COMMENT`, 
													`ACTIVITY_STATUS`, 
													`DATE_OF_CREATION`,
													`LIST_RANKING`) VALUES ('$account_id', '$user_id', '$account_type', '', '', '', '', '$account_title', '$currency', NULL, '', '', '', '', NULL , '', '', NULL , NULL , '' , '', '1', CURRENT_TIMESTAMP, NULL);";


			


			if(mysqli_query($connect , $code)){

					$country = "IN";

					//this is to check if displaying of balance in expense gain is allowed	
					if($account_type == "le4"){
						
						 $title_type = "wide_title_2";		
						 $show_balance = "";
						 							
					}else if($account_type == "le2" || $account_type == "le3"){
						 
						 $title_type = "wide_title";
						 $show_balance = "<div class='table_body_item_detail overflow capital title_6 bold_title amount_title $title_type'>".
									 		 "-" .
										"</div>";
					}else{

						 $title_type = "";
						 $show_balance = "<div class='table_body_item_detail overflow capital title_6 amount_title'>" . 
												"-" . 		
										"</div>" . 
										"<div class='table_body_item_detail overflow capital title_7 bold_title amount_title'>".
									 		 "-".
										"</div>";
					}


					$new_account_row = "<a href='" . app . "account/$account_id'>".
						 "<div class='table_body_item $account_id new_table_body_item'>".
							"<div class='table_body_item_detail overflow capital title_1'>".
									"#".
							"</div>".
							"<div class='table_body_item_detail  account_link overflow capital title_2 name_title'>".
									"$account_title".
							"</div>".
							"<div class='table_body_item_detail overflow capital title_4 bold_title amount_title $title_type'>".
									  "-" .
							"</div>".
							"<div class='table_body_item_detail overflow capital title_5 bold_title amount_title $title_type'>".
									    "-" . 
							"</div>".
							$show_balance.
					 "</div>".
					 "</a>" ;

				?>

					<script type='text/javascript'>

							//to hide pop up
							effect_pop_hide();

							$('.table_body').prepend("<?php echo $new_account_row; ?>");

							setTimeout(function(){
								$(".<?php echo $account_id; ?>").show("drop" , {direction:"left"} , 400);
							} , 250);

					</script>

					

			<?php 
			}

		}else{
			//information coming from session is incomplete
			//using javascript to show error box
			echo "
				<script type='text/javascript'>
  					return_pop_error(incomplete_info_error)
			
				</script>
				";			
			}


	

}else{
	//session of user don't exist
	//session don't exist 
	 //destroy session 
     session_destroy();
     //error of session not set 
     //send user back to sign in page
     header("location:" . signin . "error/005");
}

 ?>
