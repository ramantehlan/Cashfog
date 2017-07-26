<?php 
/************************************************
this script is record a transaction in account

creator:- Raman tehlan
date of creation:- 19/02/2017
************************************************/

session_start();

//define.inc define the basic terms
include "../../define.inc.php";

//connect.inc to connect to db
include "../../connect.inc.php";

//decoder.lib is to decode recoded data of user
include "../../decoder.lib.php";
$decode = new decoder();

//check session
if(isset($_SESSION[app_name . 'session_name'])){

		//check if all the required variables are set
		if(isset($_POST['account_id']) && $_POST['transaction_day'] && isset($_POST['particulars']) && isset($_POST['bill_no']) && isset($_POST['transaction_amount']) && isset($_POST['transaction_method']) && isset($_POST['transaction_type']) && isset($_POST['transaction_comment'])){

			//user_id (owner_id)
			$user_id = $_SESSION[app_name . "user_id"];

			$transaction_id			= date('ymdhis') . rand(10,10000);
			$account_id 			= $_POST['account_id'];
			$particulars			= $_POST['particulars'];
			$bill_no				= ($_POST['bill_no'] != 0)? $_POST['bill_no'] : "NULL";
			$transaction_amount		= $_POST['transaction_amount'];
			$transaction_method 	= $_POST['transaction_method'];
			$transaction_action		= $_POST['transaction_type'];
			$transaction_comment	= addslashes(htmlentities($_POST['transaction_comment']));
			$transaction_day 		= $_POST['transaction_day'];
/*

			a1 = sales (debit) (t1)
			a2 = payment recieved (credit) (t2)
			a3 = payment paid (debit) (t1)
			a4 = purchase (credit)
	a5 = debit note = credit  
	a6 = credit note = debit
			a7 = other debit
			a8 = other crdit 
*/
			//this is to assign transaction type according to the transaction action or transaction type
		if($transaction_action != "t1" && $transaction_action != "t2"){
			if($transaction_action == "a1" || $transaction_action == "a3" || $transaction_action == "a7" || $transaction_action == "a6"){
				$transaction_type = "t1";
			}else if($transaction_action == "a2" || $transaction_action == "a4" || $transaction_action == "a8" || $transaction_action == "a5"){
				$transaction_type = "t2";
			}
		}else{
			$transaction_type = $transaction_action;
			$transaction_action = "";
		}

			$code = "INSERT INTO `$db_name`.`$transactions_table` (
										`TRANSACTION_ID`, 
										`ACCOUNT_ID`, 
										`OWNER_ID`, 
										`PARTICULARS`, 
										`BILL_INVOICE_NO`, 
										`TRANSACTION_TYPE`, 
										`TRANSACTION_ACTION`,
										`TRANSACTION_METHOD`, 
										`TRANSACTION_AMOUNT`, 
										`COMMENT`, 
										`DATE_OF_TRANSACTION`) 
										VALUES ('$transaction_id', '$account_id', '$user_id', '$particulars', $bill_no, '$transaction_type',
										'$transaction_action', '$transaction_method', '$transaction_amount', '$transaction_comment', '$transaction_day');";


			
			if(mysqli_query($connect , $code)){

						//this is to assign the transaction amount
                                                    $debit_value    = "-";
                                                    $credit_value   = "-";

                                                    $l_country = "IN";
                                                    $l_currency = "INR";

                                                    //this is to decide
                                                    //if transaction amount is getting debit or credit
                                                    //using the help of transaction type
                                                    if($transaction_type == "t1"){
                                                        $debit_value = $decode -> money($transaction_amount , $l_country , $l_currency);

                                                    }else if($transaction_type == "t2"){
                                                        $credit_value = $decode -> money($transaction_amount , $l_country , $l_currency);
                                                    }

                                                    $year = substr($transaction_day,0,4);
                         						    $month = substr($transaction_day, 5,2);
                          							$date = substr($transaction_day, 8,2);

				

				$new_transaction = "<div class='table_body_item new_table_body_item $transaction_id'>".
    										 	
                          	 			"<div class='table_body_item_detail overflow capital title_1 minor_title'>".
															"#".
												  	"</div>".
												  	"<div class='table_body_item_detail overflow capital title_2 minor_title'>".
															"$date-$month-$year" . 
													  "</div>" . 
													  "<div class='table_body_item_detail overflow capital title_3 middle_title name_title'>".
															 $particulars .
													  "</div>" .
													  "<div class='table_body_item_detail overflow capital title_4 bold_title amount_title'>".
														  	$debit_value . 
													  "</div>" .
													  "<div class='table_body_item_detail overflow capital title_5 bold_title amount_title'>".
														  	$credit_value.
													  "</div>". 
													 "<div class='table_body_item_detail table_options_box overflow capital title_6'></div>" .
    								  "</div>";

				?>

						<script type='text/javascript'>

							//to hide pop up
							effect_pop_hide();

							$('.table_body').prepend("<?php echo $new_transaction; ?>");

							setTimeout(function(){
								$(".<?php echo $transaction_id; ?>").show("drop" , {direction:"left"} , 400);
							} , 250);

					</script>


	<?php
			}


		}else{
			//not all post are set 
			//print error
			echo "
			<script type='text/javascript'>
  				return_pop_error(incomplete_info_error);
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