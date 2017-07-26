<?php 
/*******************************************
Index of ledgers

date of creation:- 01/12/2016
creator:- raman tehlan
********************************************/


/******************************8
this is to set the financial year
********************************/

  $period = $decode -> financial_period($FINANCIAL_PERIOD);

  $starting_month = $period[0];
  $ending_month = $period[1];
  $current_financial_year = $period[2];

  //this is to check session for current year
  //if session exist then current year is as per session
  //else current year will be this financial year
  if(isset($_SESSION[app_name . "current_year"])){
  	$selected_financial_year = $_SESSION[app_name . "current_year"];
  }else{
  	//this is to set financial year to current financial year 
  	$selected_financial_year = $current_financial_year;
  }										
										

?>

<script type="text/javascript">
		$(document).ready(function(){
			$("#transactions_year").val('<?php echo $selected_financial_year; ?>');
		});
</script>

<div class="close_all_button hide" >
      <img src="<?php echo image_icon; ?>app_close.png">
</div>

													

<?php 
	
	if(allow_full_account_creation && allow_service){

			echo "<div class='create_account_box activity_box hide'>";
					include "../includes/fragments/webapp/account_create.fragment.php";
			echo "</div>";
	}

	if(allow_imort_date && allow_service){
			
			echo "<div class='import_data_box activity_box hide'>";
					include "import_data.fragment.php";
		 	echo "</div>";
		}
?>

<div class="account_edit_box activity_box hide">
													
<?php include "accounting-edit.fragment.php"; 
?>

</div>



	<div class="box_body index_intro effect_slide_top_1">
			
				
				<div class="box_body_top">
						<div class="index_intro_heading box_heading capital">
							<img src="<?php echo image_icon; ?>app_accounting.png" >  <?php echo $lang['transactions']; ?>
							 
						</div>
						<div class='option_box'>
									<input type='hidden' value='<?php echo action_app; ?>reset_transactions.php' id='transaction_reset_link'>
									<input type='hidden' id='reset_country' value='<?php echo $COUNTRY; ?>'>
    								<input type='hidden' id='reset_currency' value='<?php echo $CURRENCY; ?>'>
    								<input type='hidden' id='reset_financial_period' value='<?php echo $FINANCIAL_PERIOD; ?>'>

    									
    									
								<?php echo $lang['for'] ?> <select id='transactions_year' class='input select_input option_input'>
    			  					<?php 
    			  							$year_sql = mysqli_query($connect , "SELECT DISTINCT(YEAR(`DATE_OF_TRANSACTION`)) AS 'year' FROM `$db_name`.`$transactions_table` where OWNER_ID = '$USER_ID' ORDER by `year` DESC;");
    			  							$no_of_years = mysqli_num_rows($year_sql);

    			  							if($no_of_years == 0){
    			  								echo "<option value='$current_financial_year'>$current_financial_year -" . ($current_financial_year + 1) . " </option>";
    			  							}else{

    			  							//starting of financial month is less then current month
    			  							//so new financial year havn't started
    			  							if(date('Y') == $current_financial_year){
    			  								$current_year = date('Y');
    			  								$next_year = date('Y') + 1;
    			  								echo "<option value='$current_year'>$current_year - $next_year</option>";
    			  							}


    			  							while($_years = mysqli_fetch_array($year_sql)){
    			  								$year = $_years['year'];
    			  								if($year != date("Y")){
    			  									echo "<option value='$year'>$year - " . ($year + 1) . "</option>";
    			  								}
    			  							}
    			  							echo "<option value='" . ($year-1) . "'>" . ($year - 1) . " - $year</option>";
    			  							echo "<option value='0000'>" .   $lang['all_the_years'] . "</option>";
    			  						}
    			  					?>

    			  					
    			  				</select>
    			  				<div class="option_box_action transactions_action">Updating...</div>
						</div>

						<div class="box_menu">
							
							<div class="box_menu_option tooltip_object" id="edit_accounting">
									<img src="<?php echo image_icon; ?>account_edit.png" >
									<div class='tooltip_box box_menu_tooltip_box'>
            						  	<?php echo $lang['edit'] ?>
            						 </div>
	   						</div>
	   					
	   					<?php 
	   							if(allow_imort_date && allow_service){
	   					?>

	  						 <div class="box_menu_option tooltip_object" id="import_data">
									<img src="<?php echo image_icon; ?>import.png" >
									<div class='tooltip_box box_menu_tooltip_box'>
            						  	<?php echo $lang['import_data']; ?>
            						 </div>
	   						</div>

	   					<?php
	   							}


	   							if(allow_full_account_creation && allow_service){

	   					?>
							
 	
	   						 <div class="box_menu_option tooltip_object" id="create_account">
									<img src="<?php echo image_icon; ?>add_account_dark.png" >
									<div class='tooltip_box box_menu_tooltip_box'>
            						  	<?php echo $lang['create_account_button_text']; ?>
            						 </div>
	   						</div>

	   					<?php 
	   						}
	   					?>
	  

						</div>
				</div>

					<div class="index_intro_passage ">

					<div class='coloumn_holder'>
							





 					<?php

/*
simple notes 
			ledgers      asset       liability    expense/income
debit 		out 		 increase    increase 	  expense
credit 		in 			 decrease    decrease     income
*/



 		//types of accounts to get
		$account_type =  array('le1' , 'le2' , 'le3' , 'le4'  );

		//to run a loop for every account type
		for($i = 0; count($account_type) > $i ; $i++) {

							$list_link  = app . "transactions/";
							$show_balance = true;			
							//this class is for the design only
							$special_class='';									

								if($account_type[$i] == "le1"){

										$list_link .= "b";
										$list_title =  $lang["ledger"];
										$debit_title =  "+ " .$lang['total'] . " " . $lang['debit'] . " (" . $lang['out'] . ")";
										$credit_title = "- " .$lang['total'] . " " . $lang['credit'] . " (" . $lang['in'] . ")";
										$opening_balance_title = "+ " . $lang['opening balance'];
										$balance_title = "= " .$lang['total'] . " " . $lang['balance'];

										$special_class = "first_coloumn";

								}else if($account_type[$i] == "le2" ){
										
										$list_link  .=  "a";
										$list_title = $lang['assets'];
										$debit_title = "+ " .$lang['total'] . " " . $lang['value'];
										$credit_title = "- " .$lang['total'] . " " . $lang['depreciation'];
										$balance_title = "= " .$lang['total'] . " " . $lang['assets'];

								}else if($account_type[$i] == "le3"){
										
										$list_link  .= "l";
										$list_title = $lang['liabilities'];
										$debit_title = "+ " .$lang['total'] . " " . $lang['debt'];
										$credit_title = "- " .$lang['total'] . " " . $lang['debt_paid'];
										$balance_title = "= " .$lang['total'] . " " . $lang['liabilities'];
								}
								else if($account_type[$i] == "le4") {
										
										$list_link  .= "e";
										$list_title = $lang['expense_income'];
										$debit_title = $lang['total'] . " " . $lang['expense'];
										$credit_title = $lang['total'] . " " . $lang['income'];
										$balance_title = "";
										$show_balance = false;

										$special_class = "no_border";

								}

								$book_data = $access -> book($account_type[$i] , true , $selected_financial_year);
								

								$total_debit = $book_data[0];
								$total_credit = $book_data[1];
								$total_balance = $book_data[2];
								$opening_balance = $book_data[3];
 					?>
 						
 							<a href="<?php echo $list_link; ?>">
								<div class='coloumn <?php echo $special_class; ?>'>
									<div class='coloumn_heading capital '>
										<?php echo $list_title; ?>
									</div>

									<div class='coloumn_row'>
											<div class='coloumn_row_head capital'>
													<?php echo $debit_title; ?>
											</div>
											<div class='coloumn_row_body overflow' id='<?php echo $account_type[$i] . "_0" ?>'>
													<?php echo $decode -> money($total_debit , $COUNTRY , $CURRENCY ); ?>
											</div>
									</div>

									<div class='coloumn_row'>
											<div class='coloumn_row_head capital'>
													<?php echo $credit_title; ?>
											</div>
											<div class='coloumn_row_body overflow' id='<?php echo $account_type[$i] . "_1" ?>'>
													<?php echo $decode -> money($total_credit , $COUNTRY , $CURRENCY ); ?>
											</div>
									</div>
									<?php if($show_balance){ ?>
									<?php if($account_type[$i] == "le1"){ ?>
									<div class='coloumn_row'>
											<div class='coloumn_row_head capital'>
													<?php echo $opening_balance_title; ?>
											</div>
											<div class='coloumn_row_body overflow' id='<?php echo $account_type[$i] . "_3" ?>'>
													<?php echo $decode -> money($opening_balance , $COUNTRY , $CURRENCY ); ?>
											</div>
									</div>
									<?php 	} ?>
									<div class='coloumn_row'>
											<div class='coloumn_row_head capital'>
													<?php echo $balance_title; ?>
											</div>
											<div class='coloumn_row_body overflow' id='<?php echo $account_type[$i] . "_2" ?>'>
													<?php echo $decode -> money($total_balance , $COUNTRY , $CURRENCY ); ?>
											</div>
									</div>
									<?php 	} ?>
							</div>
							</a>


 			<?php } ?>


 					</div>
					</div>

</div>


