<?php 
/*******************************************
this is to display accounts

date of creation:- 13/12/2016
creator:- raman tehlan
********************************************/
?>




<?php 

		/************************************************
			since this script is to show account of all
			ledgers type we will use comman variables 
			with value according to the type
		************************************************/




		switch ($sub_page_name) {
			case 'ledger':
						$account_type 	= "le1";
						$page_title		= $lang['ledger'];
						$debit_title 	= $lang['debit'] . " (" . $lang['out'] . ")";
						$credit_title	= $lang['credit'] . " (" . $lang['in'] . ")";
						$opening_balance_title = $lang["opening balance"];
						$balance_title	= $lang['total'] . " " . $lang['balance'];
			break;
			case 'asset':
						$account_type 	= "le2";
						$page_title		= $lang['assets'];
						$debit_title 	= $lang['value'];
						$credit_title	= $lang['depreciation'];
						$balance_title	= $lang['assets'];
			break;
			case 'liability':
						$account_type 	= "le3";
						$page_title		= $lang['liabilities'];
						$debit_title 	= $lang['debt'];
						$credit_title	= $lang['debt_paid'];
						$balance_title	= $lang['liabilities'];
			break;
			case 'expense_income':
						$account_type 	= "le4";
						$page_title		= $lang['expense_income'];
						$debit_title 	= $lang['expense'];
						$credit_title	= $lang["income"];
						$balance_title	= $lang['balance'];
			break;

		}

		//this is to change the view by adding and allowing things 
		//for different kind of book
		if($account_type == "le4"){
						 							
				$show_balance = false;
				$title_type = "wide_title_2";
						 							
		}else if($account_type == "le2" || $account_type == "le3"){
				$show_balance = true;
				$title_type = "wide_title";
		}else{
				$show_balance = true;
				$title_type = "";
		}



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
  $selected_financial_year = $period[2];
  }		

?>

 <script type="text/javascript">
  
      switch("<?php echo $account_type; ?>"){
        case "le1":
            document.title = "<?php echo $lang['ledger']; ?>";
        break;
        case "le2":
          document.title = "<?php echo $lang['assets']; ?>";
        break;
         case "le3":
          document.title = "<?php echo $lang['liabilities']; ?>";
        break;
        case "le4":
          document.title = "<?php echo $lang['expense_income']; ?>";
        break;

      }

</script>



<div class="bookkeeping_display box_body effect_slide_top_1">

<div class="box_body_top">

	<a href="<?php echo app ?>transactions" class="title_a">
		<div class="display_title capital">
			<img src="<?php echo image_icon; ?>profile_back.png" class="heading_icon"> <?php echo $page_title; ?>
			<?php
					if($selected_financial_year != 0){
						echo  "($selected_financial_year - " . ($selected_financial_year + 1) . ")";
					}else{
						echo "(" . $lang['all_the_years'] . ")";
					}
			?>
		</div>
	</a>
	
<?php 
		
			if(allow_service){

?>

	<div class="box_menu">
	   <div class="box_menu_option tooltip_object" id="create_new_account_button">
			<img src="<?php echo image_icon; ?>add_account_dark.png" >
			<div class='tooltip_box box_menu_tooltip_box'>
              	<?php echo $lang['create_account']; ?>
             </div>
	   </div>
	</div>

	<script type="text/javascript">
	
$(document).ready(function(){

	//this is to create new account
	$("#create_new_account_button").click(function(){

				effect_pop_show();

				//changing the title of pop up 
				$(".pop_up_title").html("<?php echo $lang['create_account']; ?>");

				//set the content
                $(".pop_up_body").html("<form method='post' action='#'>" +
                						"<div class='pop_up_error_box'>Error</div>" + 
                                        "<div class='create_action'></div>" +
                	 					"<div class='pop_item'>" + 
                					 		"<div class='pop_item_label'> " + 
                					 			"<?php echo $lang['account_name'] ?>*" +
                					 		"</div>"+
                					 		"<div class='pop_item_details'> " +
                					 			"<input type='account_title' id='account_title' name='account_title' class='input pop_input'  maxlength='60' autocomplete='off' autofocus>" +
                					 		"</div>" +
                					 		"<div class='pop_item_info'><?php echo $lang['account_name_details']; ?> </div>" +
                					 	"</div>" + 
                					 	"<input type='submit' value='<?php echo $lang['create']; ?>' class='submit_button pop_submit capital' id='create_account'>" +
                					 "</form>"
                					 );

                $("#create_account").click(function(){

                		//to get account title 
                		var account_title = document.getElementById("account_title").value;

                		//Response boxes
                		var error_box = $(".pop_up_error_box");

                		//this is to hide any old error
                		error_box.hide();

                		if(account_title.length == 0){
                				throw_error(error_box , error_box , empty_field_error);
                		}else{

                			//this is to post information to page
                			$.post("<?php echo action_app; ?>account_create.short.php" , {account_title:account_title, account_type : '<?php echo $account_type; ?>',currency : 'INR'} , function(response){
                				$(".create_action").html(response);
                				$(".table_body_empty").hide();
                			});
                		}


                		return false;

                });

	});

});

</script>

<?php

	}

?>

</div>

	


<div class='test'>

</div>




<div class='ledgers_container table'>
			<div class="table_head">
					<div class="table_head_title overflow capital title_1" >
						#
					</div>
					<div class="table_head_title overflow capital title_2">
						<?php echo $lang['account_name']; ?>
					</div>
					<div class="table_head_title overflow capital title_4 <?php echo $title_type; ?>">
						<?php echo $debit_title; ?>
					</div>
					<div class="table_head_title overflow capital title_5 <?php echo $title_type; ?>">
						<?php echo $credit_title; ?>
					</div>
					<?php
							if($account_type == "le1"){
					?>
					<div class="table_head_title overflow capital title_6">
						<?php echo $opening_balance_title; ?>
					</div>
					<?php } ?>
					<?php
							if($show_balance){
					?>
					<div class="table_head_title overflow capital title_7 <?php echo $title_type; ?>">
						<?php echo $balance_title; ?>
					</div>
					<?php 
							}
					?>
			</div>
			<div class="table_body">
									<?php 

										/**************************************************************
										this is to print books details 
										***************************************************************/

										//code to get info
										$account_sql_code = "SELECT * FROM `$db_name`.`$accounts_table` WHERE OWNER_ID = '$USER_ID' AND ACCOUNT_TYPE = '$account_type' order by `DATE_OF_CREATION` DESC";
										//code to get no of ledgers
              							$no_of_accounts = mysqli_num_rows( mysqli_query($connect , $account_sql_code ) );

               			 				if($no_of_accounts == 0){

               			 							 //since no ledger exist
                                                    //print the appropriate response 

               			 							echo "	 <div class='table_body_empty capital'>
                                        								No Account to show
                                    						 </div>";

                               			}else{

                               			//this list no is to display the line no and also to
                               			//make a line unique
                               			$list_no = 1;

                               			//mysqli resutl 
                               			//limit . " limit 0 , 15 "
                               			$ledgers_code_result = mysqli_query( $connect , $account_sql_code );

                               			while($_LEDGER = mysqli_fetch_array($ledgers_code_result)) {

                               					/******************************************
												this is to get debit , credit and balance
                               					*******************************************/

                               					$account_id		 = $_LEDGER['ACCOUNT_ID'];
                               					$account_title	 = $_LEDGER['ACCOUNT_TITLE'];
                               					$currency 		 = $_LEDGER['CURRENCY'];
                               					$country 		 = $_LEDGER['COUNTRY'];

												$book_data = $access -> book($account_type , true , $selected_financial_year , "00" , $account_id);
												
												$debit_amount = $book_data[0];
												$credit_amount = $book_data[1];
												$balance_amount = $book_data[2];
												$opening_balance = $book_data[3];
                               		?>

                                    
						 <a href='<?php echo app; ?>account/<?php echo $account_id; ?>'>
						 <div class="table_body_item">
							<div class="table_body_item_detail overflow capital title_1">
									<?php echo $list_no; ?>
							</div>
							<div class="table_body_item_detail  account_link overflow capital title_2 name_title">
									<?php echo $account_title; ?>
							</div>
							<div class="table_body_item_detail overflow capital title_4 amount_title <?php echo $title_type; ?>">
									<?php echo ($debit_amount != 0)? $decode -> money( $debit_amount, $country , $currency)  : "-"; ?>
							</div>
							<div class="table_body_item_detail overflow capital title_5 amount_title <?php echo $title_type; ?>">
									<?php echo ($credit_amount != 0)? $decode -> money($credit_amount , $country , $currency) : "-"; ?>
							</div>
							<?php 
									if($account_type == "le1"){
							?>
						 	<div class="table_body_item_detail overflow capital title_6 amount_title">
								<?php echo ($opening_balance != 0)? $decode -> money($opening_balance , $country , $currency) : "-"; ?>		
							</div>
							<?php 
									}
							?>
							<?php 
									if($show_balance){
							?>
						 	<div class="table_body_item_detail overflow capital title_7 amount_title <?php echo $title_type; ?>">
								<?php echo($balance_amount != 0)?  $decode -> money($balance_amount , $country , $currency) : "-"; ?>		
							</div>
							<?php 
									}
							?>
					 </div>
					 </a>

					 <?php 
					  $list_no++;
					  }//end of while
					 }//end of else
					 ?>
				
					 <?php 
					 	/********8
						this is to automanage expense from the ledgers
					 	*************/
					 	if($account_type == "le4"){

					 		$sale = $access -> action_group("sale" , $current_financial_year);
        					$purchase = $access -> action_group("purchase" , $current_financial_year);
        					$debit_note = $access -> action("a5" , true ,  $current_financial_year);  		
					 ?>

					 	<div class="auto_block">
					 			Auto Generated Ledger Details Below 
					 	</div>

					 <div class="table_body_item auto_item">
							<div class="table_body_item_detail overflow capital title_1">
									<?php echo $list_no++; ?>
							</div>
							<div class="table_body_item_detail  account_link overflow capital title_2 name_title">
										Payment Received
							</div>
							<div class="table_body_item_detail overflow capital title_4 amount_title <?php echo $title_type; ?>">
										-
							</div>
							<div class="table_body_item_detail overflow capital title_5 amount_title <?php echo $title_type; ?>">
										<?php echo $decode -> money($sale[1] , $country , $currency); ?>
							</div>
					 </div>


					<div class="table_body_item auto_item">
							<div class="table_body_item_detail overflow capital title_1">
									<?php echo $list_no++; ?>
							</div>
							<div class="table_body_item_detail  account_link overflow capital title_2 name_title">
										Payment Paid
							</div>
							<div class="table_body_item_detail overflow capital title_4 amount_title <?php echo $title_type; ?>">
									<?php echo $decode -> money($purchase[1] , $country , $currency); ?>
							</div>
							<div class="table_body_item_detail overflow capital title_5 amount_title <?php echo $title_type; ?>">
										-
							</div>
					 </div>

					 <div class="table_body_item auto_item">
							<div class="table_body_item_detail overflow capital title_1">
									<?php echo $list_no++; ?>
							</div>
							<div class="table_body_item_detail  account_link overflow capital title_2 name_title">
										Debit Notes Received
							</div>
							<div class="table_body_item_detail overflow capital title_4 amount_title <?php echo $title_type; ?>">
									<?php echo $decode -> money($debit_note[0] , $country , $currency); ?>
							</div>
							<div class="table_body_item_detail overflow capital title_5 amount_title <?php echo $title_type; ?>">
									-
							</div>
					 </div>
					 <?php 
					 	}
					 ?>

			</div>

			

</div>




</div>


		