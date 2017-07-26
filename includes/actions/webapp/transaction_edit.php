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
		if(isset($_POST['transaction_id']) && isset($_POST['transaction_day']) && isset($_POST['account_type_code']) && isset($_POST['language']) && isset($_POST['index']) && isset($_POST['particulars']) && isset($_POST['bill_no']) && isset($_POST['transaction_amount']) && isset($_POST['transaction_method']) && isset($_POST['transaction_type']) && isset($_POST['transaction_comment']) ){

			$LANGUAGE = $_POST['language'];
			include "../../set_language.inc.php";

			//user_id (owner_id)
			$user_id = $_SESSION[app_name . "user_id"];

			$index = $_POST['index'];
			$account_type_code = $_POST['account_type_code'];

			$transaction_id			= $_POST['transaction_id'];
			$particulars			= $_POST['particulars'];
			$bill_no				= ($_POST['bill_no'] != 0)? $_POST['bill_no'] : "NULL";
			$transaction_amount		= $_POST['transaction_amount'];
			$transaction_method 	= $_POST['transaction_method'];
			$transaction_action		= $_POST['transaction_type'];
			$comment				= $_POST['transaction_comment'];
			$transaction_comment	= addslashes(htmlentities($_POST['transaction_comment']));
			$transaction_day		= $_POST['transaction_day'];


/*

			a1 = sales (debit) (t1)
			a2 = payment recieved (credit) (t2)
			a3 = payment paid (debit) (t1)
			a4 = purchase (credit)
	a5 = debit note 
	a6 = credit note
			a7 = other debit
			a8 = other crdit 
*/
			//this is to assign transaction type according to the transaction action or transaction type
		if($transaction_action != "t1" && $transaction_action != "t2"){
			if($transaction_action == "a1" || $transaction_action == "a3" || $transaction_action == "a7" ||  $transaction_action == "a6"){
				$transaction_type = "t1";
			}else if($transaction_action == "a2" || $transaction_action == "a4" || $transaction_action == "a8" ||  $transaction_action == "a5"){
				$transaction_type = "t2";
			}
		}else{
			$transaction_type = $transaction_action;
			$transaction_action = "";
		}

		//this is to set the reset value
		 if($transaction_action != ""){
             $transaction_type_2 = $transaction_action; 
         }else{
             $transaction_type_2 = $transaction_type;
         }


			$code = "UPDATE `$db_name`.`transactions` SET 
							`PARTICULARS` = '$particulars', 
							`BILL_INVOICE_NO` = $bill_no, 
							`TRANSACTION_TYPE` = '$transaction_type', 
							`TRANSACTION_ACTION` = '$transaction_action',
							`TRANSACTION_METHOD` = '$transaction_method', 
							`TRANSACTION_AMOUNT` = '$transaction_amount', 
							`COMMENT` = '$transaction_comment' ,
							`DATE_OF_TRANSACTION` = '$transaction_day'
							WHERE `transactions`.`TRANSACTION_ID` = '$transaction_id';";


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


				?>

						<script type='text/javascript'>

							


									//assigning new values to hidden details
									$("#hidden_particulars_<?php echo $index; ?>").val("<?php echo $particulars; ?>");
									$("#hidden_bill_invoice_no_<?php echo $index; ?>").val("<?php echo ($bill_no != "NULL")? $bill_no : ''; ?>");
									$("#hidden_transaction_amount_<?php echo $index; ?>").val("<?php echo $decode -> money($transaction_amount , $l_country , $l_currency); ?>");
									$("#hidden_transaction_amount_edit_<?php echo $index; ?>").val("<?php echo $transaction_amount; ?>");
									$("#hidden_transaction_type_<?php echo $index; ?>").val("<?php echo $decode -> transaction_type($account_type_code , $transaction_type_2); ?>");
									$("#hidden_transaction_type_edit_<?php echo $index; ?>").val("<?php echo $transaction_type_2; ?>");
									$("#hidden_transaction_method_<?php echo $index; ?>").val("<?php echo $transaction_method; ?>");
									$("#hidden_transaction_date_<?php echo $index; ?>").val("<?php echo $date; ?>");
									$("#hidden_transaction_month_<?php echo $index; ?>").val("<?php echo $month; ?>");
									$("#hidden_transaction_year_<?php echo $index; ?>").val("<?php echo $year; ?>");
									$("#hidden_transaction_day_<?php echo $index; ?>").val("<?php echo $date . '-' . $month . '-' . $year; ?>");
									$("#hidden_transaction_comment_<?php echo $index; ?>").val("<?php echo preg_replace('/\n/', '<br>', trim($comment)); ?>");
									$("#hidden_transaction_comment_edit_<?php echo $index; ?>").val("<?php echo preg_replace('/\n/', '&#13;&#10;', trim($comment)); ?>");


									$("#list_day_<?php echo $index; ?>").html("<?php echo $date . '-' . $month . '-' . $year; ?>");
									$("#list_particulars_<?php echo $index; ?>").html("<?php echo ($particulars != '')? $particulars : '-' ?>");
									$("#list_debit_<?php echo $index; ?>").html("<?php echo $debit_value; ?>");
									$("#list_credit_<?php echo $index; ?>").html("<?php echo $credit_value; ?>");

									$(".pop_up_success_box").show();
									$(".pop_up_success_box").html("Successfully updated");

									//to hide pop up
									setTimeout(function(){
										effect_pop_hide();
									} , 1000);
							
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