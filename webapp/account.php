<?php
session_start();

//this is to highlight the name of page in nevigation
$page_name 		= "account";


//bundle.inc is bundle of comman includes
include "../includes/bundle.inc.php";



?>
<!DOCTYPE html>
<html>
<head>
	<title>
		 <?php echo $lang['account']; ?> | <?php echo app_name; ?>
	</title>

	

	  <?php 
	  		include "../includes/fragments/webapp/header-files.fragment.php";
	  ?>
	  
	        <script type="text/javascript">
          
          //this is to make reset resolution
          $(document).ready(function(){
          $(".body_frame").css('margin','0px auto');
          $(".body_frame").css('margin-top','20px');
          });

                  


      </script>


      <link rel='stylesheet' type='text/css' href="<?php echo style_app; ?>form-ui.css">
	  <link rel="stylesheet" type="text/css" href="<?php echo style_app; ?>table-ui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo style_app; ?>account-ui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo style_app; ?>pagination-ui.css">

      <script type="text/javascript" src="<?php echo script; ?>form-check.js"></script>
      <script type="text/javascript" src="<?php echo script_app; ?>account.js"></script>
      <script type="text/javascript" src="<?php echo script_app; ?>account_edit.js"></script>




</head>
<body>
 		
		<?php 

		include "../includes/fragments/webapp/background.fragment.php";

		 //include "../includes/fragments/webapp/topbar.fragment.php";

		 //include "../includes/fragments/webapp/leftmenu.dashboard.fragment.php";

		?>
 	    <div class="body_frame scroll_object box_body effect_slide_left_1">

                <?php 


                    if(isset($_GET['account_id'])){
      
                                $account_id = $_GET['account_id'];

                                //this is to get ledger(account) info
                                $ledger_code = mysqli_query($connect ,"SELECT * FROM `$db_name`.`$accounts_table` WHERE OWNER_ID = '$USER_ID' AND ACCOUNT_ID = '$account_id' ");

                                //code to get no of ledgers
                                $no_of_ledgers = mysqli_num_rows( $ledger_code );


                                //to check that ledger exist of user
                                //and only one ledger is there
                                if($no_of_ledgers == 1){

                                        //getting the infromation of the ledger
                                        $_LEDGERS = mysqli_fetch_array($ledger_code);

                                        $account_type_code        = $_LEDGERS['ACCOUNT_TYPE'];
                                        $l_contact_salutation     = $_LEDGERS['CONTACT_SALUTATION'];
                                        $l_contact_first_name     = $_LEDGERS['CONTACT_FIRST_NAME'];
                                        $l_contact_last_name      = $_LEDGERS['CONTACT_LAST_NAME'];
                                        $l_company_name           = $_LEDGERS['COMPANY_NAME'];
                                        $l_account_title          = $_LEDGERS['ACCOUNT_TITLE'];
                                        $l_currency               = $_LEDGERS['CURRENCY'];
                                        $l_due_days               = $_LEDGERS['DUE_DAYS'];
                                        $l_address                = $_LEDGERS['ADDRESS']; 
                                        $l_street                 = $_LEDGERS['STREET']; 
                                        $l_city                   = $_LEDGERS['CITY']; 
                                        $l_state                  = $_LEDGERS['STATE']; 
                                        $l_zip                    = $_LEDGERS['ZIP']; 
                                        $l_country                = $_LEDGERS['COUNTRY']; 
                                        $l_contact_email          = $_LEDGERS['CONTACT_EMAIL'];
                                        $l_contact_phone          = $_LEDGERS['CONTACT_PHONE'];
                                        $l_contact_mobile         = $_LEDGERS['CONTACT_MOBILE'];
                                        $l_website                = $_LEDGERS['WEBSITE'];
                                        $l_comment                = $_LEDGERS['COMMENT'];
                                        $l_activity_status        = $_LEDGERS['ACTIVITY_STATUS']; 
                                        $l_date_of_creation       = $_LEDGERS['DATE_OF_CREATION']; 

                                        //this is to make date in proper set
                                        $l_date_of_creation    = $decode -> date($l_date_of_creation);

                                        //to set the title of table according to account
                                        //default is debit and credit 
                                        $debit_title = $lang['debit'] . " (" . $lang['out'] . ")";
                                        $credit_title = $lang['credit'] . " (" . $lang['in'] . ")";

                                                      //this is to change account type according to the code;
                                                      if($account_type_code == "le1"){
                                                           
                                                            $l_account_type = $lang['ledger'];

                                                      }else if($account_type_code == 'le2'){
                                                           
                                                            $l_account_type = $lang["assets"];
                                                            $debit_title = $lang['value'];
                                                            $credit_title = $lang['depreciation'];

                                                      }else if($account_type_code == 'le3'){
                                                            
                                                            $l_account_type = $lang["liabilities"];
                                                            $debit_title = $lang["debt"];
                                                            $credit_title = $lang["debt_paid"];

                                                      }else if($account_type_code == "le4"){
                                                          
                                                           $l_account_type = $lang['expense_income'];
                                                            //since it is expense and income
                                                           //debit and credit title will change 
                                                            $debit_title = $lang['expense'];
                                                            $credit_title = $lang['income'];

                                                      }else{
                                                            
                                                            $l_account_type = $lang['back'];

                                                      }

                                                      //temp or maybe permanent 
                                                       $l_account_type = $lang['back'];


                                        //this is to set the href of back link according to the ledger type
                                        
                                                switch ($account_type_code) {
                                                case 'le1':
                                                    $back_url =  app . "transactions/b";
                                                break;
                                                case 'le2':
                                                    $back_url = app . "transactions/a";
                                                break;
                                                case 'le3':
                                                    $back_url = app . "transactions/l";
                                                break;
                                                case 'le4':
                                                    $back_url =  app . "transactions/e";
                                                break;
                                                default:
                                                   $back_url =  app . "transactions";
                                                break;
                                            }


                                        //this is to handle empty name
                                        if($l_contact_salutation == "" && $l_contact_first_name == "" && $l_contact_last_name == ""){
                                            $l_contact_name = "-";
                                        }else{
                                            $l_contact_name = "<span class='capital'>" . $lang[( $decode -> salutation($l_contact_salutation) )] . "</span>. " . $l_contact_first_name . " " . $l_contact_last_name;
                                        }


                                }

                    }else{
                                
                                //since ledger id is not set
                                //take user to index page
                                header("location:" . app . "ledgers/n");
                          }

                ?>

                    
                    <?php 
                            //to check that ledger exist of user
                            //and only one is there 
                            //if true then print the
                            if($no_of_ledgers == 1){

                                        //checking if the ledger is of general type
                                        //if yes then hide no-needed perimeters
                                        if($account_type_code == "le4" || $account_type_code == "le3" || $account_type_code == "le5" || $account_type_code == "le6"){
                                                echo "
                                                        <script type='text/javascript'> 
                                                                $(document).ready(function(){
                                                                        $('.group_1').hide();
                                                                });

                                                        </script>
                                                ";
                                        }
                    ?>                            


    						<div class='account_details'>
    								
                               <div class='account_details_title capital'>
                                            <a href="<?php echo $back_url; ?>" class="back_a"> 
                                                <div class="account_details_title_back capital overflow">
                                                           <img src="<?php echo image_icon; ?>profile_back.png" class="heading_icon">
                                                           <?php echo $l_account_type; ?>
                                                </div>
    									                        </a>

                                            <div class="account_details_title_options">
                                                    <div class="account_details_title_options_box first_option_box hide" id="close_details_box">
                                                            <img src="<?php echo image_icon; ?>app_close.png" alt="<?php echo $lang['close']; ?>">
                                                    </div>
                                                <div class="active_account_options">
                                                    
                                                    <div class="account_details_title_options_box first_option_box tooltip_object pop_up_open delete_account">
                                                            <img src="<?php echo image_icon; ?>account_delete.png" alt="<?php echo $lang['delete']; ?>">
                                                                     <div class='tooltip_box profile_tooltip_box'>
                                                                        <?php echo $lang['delete'] . " " . $lang['account']; ?> 
                                                                     </div>
                                                    </div>
                                                    <script type="text/javascript">
                                                            
                                                            $(document).ready(function(){
                                                                    $(".delete_account").click(function(){

                                                                            //set the title of pop up
                                                                             $(".pop_up_title").html("<?php echo $lang['delete']; ?>");

                                                                             //set the content of pop up body
                                                                             $(".pop_up_body").html(   "<div class='delete_line '>" +
                                                                                                                      "<?php echo $lang['delete permission']; ?> '" +
                                                                                                                      "<span class='delete_item' ><?php echo $l_account_title; ?></span>'?" +
                                                                                                                      "<br>"+
                                                                                                                      "- <?php echo $lang['account_delete_warning_1']; ?> <br>" +
                                                                                                                      "- <?php echo $lang['account_delete_warning_2']; ?> <br>" +
                                                                                                                      "- <?php echo $lang['account_delete_warning_3']; ?> " +
                                                                                                      "</div>" +
                                                                                                      "<div class='permission_line'> " +
                                                                                                                "<input type='button' class='cancel_button pop_permission_button' id='cancel_account_delete_button' value='<?php echo $lang['no']; ?>'>" +
                                                                                                               "<input type='button' class='submit_button pop_permission_button' id='allow_account_delete_button' value='<?php echo $lang['yes']; ?>'>" +
                                                                                                      "</div>"
                                                                              );


                                                                             //if the user want to cancel the deletion
                                                                              $('#cancel_account_delete_button').click(function(){
                                                                                    effect_pop_hide();
                                                                              });

                                                                              //if user allow the deletion
                                                                              $("#allow_account_delete_button").click(function(){
                                                                                    

                                                                                     //sending the post request of deletion
                                                                                     $.post("<?php echo action_app; ?>account_delete.php" , {account_id:"<?php echo $account_id; ?>"} , function(response){
                                                                                                     
                                                                                                      
                                                                                                      $(".pop_up_body").html("<div class='delete_action'></div> <center><?php echo $lang['deleting_account']; ?></center>");

                                                                                                       //box where will place the post request
                                                                                                       var response_box = $(".delete_action");
                                                                                                       //to show the 
                                                                                                       response_box.show(); 
                                                                                                      //to print response in box
                                                                                                      response_box.html(response);

                                                                                                      $(".pop_up_body").html("<center><?php echo $lang['deleted_success']; ?></center>");

                                                                                                      setTimeout(function(){
                                                                                                          effect_pop_hide();

                                                                                                          location.replace("<?php echo $back_url; ?>");

                                                                                                      },500);
                                                                                     });
                                                                              });
                                                                            
                                                                   });
                                                            });

                                                    </script>
                                                    <div class="account_details_title_options_box tooltip_object " id="show_edit_box">
                                                            <img src="<?php echo image_icon; ?>account_edit.png" alt=" <?php echo $lang['edit']; ?> <?php echo $lang['profile']; ?>">
                                                                    <div class='tooltip_box profile_tooltip_box'>
                                                                       <?php echo $lang['edit']; ?> <?php echo $lang['profile']; ?>
                                                                     </div>
                                                    </div>
                                                    <div class="account_details_title_options_box tooltip_object show_account_details">
                                                            <img src="<?php echo image_icon; ?>account_profile.png" alt="<?php echo $lang['profile']; ?>">
                                                                    <div class='tooltip_box profile_tooltip_box'>
                                                                         <?php echo $lang['profile']; ?>
                                                                     </div>
                                                    </div>
                                                    
                                                  <?php 

                                                       if($account_type_code == 'le4'){
                                                              $transaction_options = "<option value='t1'>" . $lang['expense'] . "</option>" .
                                                                                      "<option value='t2'>" . $lang['income'] . "</option> ";
                                                            }else if($account_type_code == 'le3' ){
                                                              $transaction_options = "<option value='t1'>" . $lang['debt'] . "</option>" .
                                                                                     "<option value='t2'>" . $lang['debt_paid'] . "</option> ";
                                                            }else if($account_type_code == 'le2' ){
                                                              $transaction_options = "<option value='t1'>" . $lang['value'] . "</option>" .
                                                                                     "<option value='t2'>" . $lang['depreciation'] . "</option> ";
                                                            }else{
                                                              $transaction_options = "<option value='a1'>" . $lang['sales'] . "</option>" .
                                                                                     "<option value='a4'>" . $lang['purchase'] . "</option>" .
                                                                                      "<option value='a2'>" . $lang['payment_received'] . "</option>" .
                                                                                      "<option value='a3'>" . $lang['payment_paid'] . "</option> ".
                                                                                      "<option value='a5'>" . $lang['debit_note_received'] . "</option>" .
                                                                                      "<option value='a6'>" . $lang['debit_note_sent'] . "</option> ".
                                                                                      "<option value='a7'>" . $lang['other'] . " " . $lang['debit'] . " (" . $lang['out'] . ")" . "</option>" .
                                                                                      "<option value='a8'>" . $lang['other'] . " " . $lang['credit'] .  " (" . $lang['in'] . ")" . "</option> ";
                                                            }


                                                              $years = "";
                                                              for($y = date('Y')  , $n = 0; $n < 8; $n++){

                                                                      $temp_y = $y - $n ;
                                                                      $years .= "<option value='$temp_y'>$temp_y</option>";
                                                                }
    
                                                       if(allow_service){

                                                  ?>

                                                    <div class="account_details_title_options_box tooltip_object pop_up_open show_record_transaction">
                                                            <img src="<?php echo image_icon; ?>record_transaction_dark.png" alt="<?php echo $lang['record_transaction_button_text']; ?>">
                                                                    <div class='tooltip_box profile_tooltip_box'>
                                                                        <?php echo $lang['record_transaction_button_text']; ?>
                                                                     </div>
                                                    </div>

                                                    <?php

                                                           

                                                            $record_transaction_form = "<form method='post' action='#'> ".


                                                                                            "<div class='pop_up_error_box'>Error</div>".
                                                                                            "<div class='action_transaction'></div>".
                                                                                        
                                                                                             "<div class='pop_item'>".
                                                                                                    "<div class='pop_item_label overflow'>" . $lang['transaction_date'] . "*</div>".
                                                                                                    "<div class='pop_item_details date_details'>".
                                                                                                                   "<select type='date' id='transaction_date' name='transaction_date' class='input date_input capital' >".
                                                                                                                      "<option selected value=''>" . $lang['date'] . "</option>" .
                                                                                                                      "<option value='01'>01</option><option value='02'>02</option><option value='03'>03</option><option value='04'>04</option><option value='05'>05</option><option value='06'>06</option><option value='07'>07</option><option value='08'>08</option><option value='09'>09</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option><option value='13'>13</option><option value='14'>14</option><option value='15'>15</option><option value='16'>16</option><option value='17'>17</option><option value='18'>18</option><option value='19'>19</option><option value='20'>20</option><option value='21'>21</option><option value='22'>22</option><option value='23'>23</option><option value='24'>24</option><option value='25'>25</option><option value='26'>26</option><option value='27'>27</option><option value='28'>28</option><option value='29'>29</option><option value='30'>30</option><option value='31'>31</option>" .
                                                                                                                  "</select>" .
                                                                                                                  "<select type='month' id='transaction_month' name='transaction_month' class='input  month_input capital' >" .
                                                                                                                      "<option  selected value='' >" . $lang['month']  . "</option> " .
                                                                                                                      "<option  value='01'>" . $lang['january'] . "</option> " .
                                                                                                                      "<option  value='02'>" . $lang['february'] . "</option> " .
                                                                                                                      "<option  value='03'>" . $lang['march'] . "</option> " .
                                                                                                                      "<option  value='04'>" . $lang['april'] . "</option> " .
                                                                                                                      "<option  value='05'>" . $lang['may'] . "</option> " .
                                                                                                                      "<option  value='06'>" . $lang['june'] . "</option> " .
                                                                                                                      "<option  value='07'>" . $lang['july'] . "</option> " .
                                                                                                                      "<option  value='08'>" . $lang['august'] . "</option> " .
                                                                                                                      "<option  value='09'>" . $lang['september'] . "</option> " .
                                                                                                                      "<option  value='10'>" . $lang['october'] . "</option> " .
                                                                                                                      "<option  value='11'>" . $lang['november'] . "</option> " .
                                                                                                                      "<option  value='12'>" . $lang['december'] . "</option> " .
                                                                                                                  "</select> " .
                                                                                                                "<select name='transaction_year' id='transaction_year' class='input year_input' >" .
                                                                                                                      "<option value=''>" . $lang['year'] . "</option>" .
                                                                                                                      $years . 
                                                                                                                "</select>" .
                                                                                                    "</div>".
                                                                                            "</div>".

                                                                                            "<div class='pop_item'>".
                                                                                                    "<div class='pop_item_label overflow'>". $lang['transaction amount'] ."*</div>".
                                                                                                    "<div class='pop_item_details'>".
                                                                                                                   "<input type='transaction_amount' id='transaction_amount' name='transaction_amount' placeholder='ex:- 6000' class='input pop_input' autocomplete='off' autofocus>" .
                                                                                                                  "<div class='pop_item_details_extra'>&#x20b9;</div>".
                                                                                                    "</div>".
                                                                                            "</div>".

                                                                                            "<div class='pop_item'>".
                                                                                                    "<div class='pop_item_label overflow'>" . $lang['transaction type'] . "*</div>".
                                                                                                    "<div class='pop_item_details'>".
                                                                                                                   "<select type='transaction_type' id='transaction_type' name='transaction_type' class='input capital select_input pop_input'>" . 
                                                                                                                                "<option value='' selected></option>".
                                                                                                                                $transaction_options . 
                                                                                                                     "</select>" .               
                                                                                                    "</div>".
                                                                                            "</div>".

                                                                                        "<div class='pop_show_button'>ADD DETAILS</div>".

                                                                                    "<div class='pop_hidden_part'>" .
                                                                                         
                                                                                          "<div class='pop_item'>".
                                                                                                    "<div class='pop_item_label overflow'>" . $lang['particulars'] . "</div>".
                                                                                                    "<div class='pop_item_details'>".
                                                                                                                   "<input type='particulars' id='particulars' name='particulars' placeholder='" . $lang['particulars example'] . "' class='input pop_input'>" .
                                                                                                                  
                                                                                                    "</div>".
                                                                                            "</div>".

                                                                                            "<div class='pop_item'>".
                                                                                                    "<div class='pop_item_label overflow'>" . $lang['bill_no'] . "</div>".
                                                                                                    "<div class='pop_item_details'>".
                                                                                                                   "<input type='bill_no' id='bill_no' name='bill_no' class='input' autocomplete='off'>" .
                                                                                                                  
                                                                                                    "</div>".
                                                                                            "</div>".

                                                                                              "<div class='pop_item'>".
                                                                                                    "<div class='pop_item_label overflow'>" . $lang['transaction method'] . "</div>".
                                                                                                    "<div class='pop_item_details'>".
                                                                                                                   "<input type='transaction_method' id='transaction_method' name='transaction_method' placeholder='example:- Bank transfer , cash' class='input pop_input'>" .
                                                                                                                  
                                                                                                    "</div>".
                                                                                            "</div>".

                                                                                             

                                                                                              "<div class='pop_item'>".
                                                                                                    "<div class='pop_item_label overflow'>" . $lang['comment'] . "</div>".
                                                                                                    "<div class='pop_item_details'>".
                                                                                                                   "<textarea type='comment' id='transaction_comment' name='transaction_comment' class='input pop_input pop_textarea'></textarea>" .
                                                                                                                  
                                                                                                    "</div>".
                                                                                            "</div>".

                                                                                        "</div>".

                                                                                            "<input type='submit' value='" . $lang['record'] . "' class='submit_button pop_submit' id='record_transaction_button'>" .

                                                                                      "</form>";

                                                    ?>

                                    <script type="text/javascript">
                                            
                                            /*********************************************
                                            To Record a transaction
                                            **********************************************/

                                            $(".show_record_transaction").click(function(){

                                                 //set the title of pop up
                                                 $(".pop_up_title").html("<?php echo $lang['record_transaction_button_text']; ?>");

                                                 //set the content
                                                $(".pop_up_body").html("<?php echo $record_transaction_form; ?>");

                                                $(".pop_show_button").click(function(){
                                                      $(this).hide();
                                                      $(".pop_hidden_part").show();
                                                });

                                                //this is to set current date
                                                $("#transaction_date").val("<?php echo date('d'); ?>");
                                                $("#transaction_month").val("<?php echo date('m'); ?>");
                                                $("#transaction_year").val("<?php echo date('Y'); ?>");

                                                      //this is to complete the transaction method
                                                      var available_transaction_methods = [
                                                                              "Bank Transfer",
                                                                             "Cash",
                                                                              "Cheque",
                                                                              "Dividend",
                                                                              "Demand Draft",
                                                                              "Online Payment",
                                                                              "NEFT",
                                                                           ];
            
                                                      $( "#transaction_method" ).autocomplete({
                                                                source: available_transaction_methods
                                                      });


                                                  /*******************************
                                                     date picker
                                                    *******************************/
 
                                                     $('#transaction_date').datepicker({
                                                                format: 'dd-mm-yyyy'
                                                      });

                                                  
    $("#record_transaction_button").click(function(){
                          
      var particulars     = document.getElementById("particulars").value;
      var bill_no       = document.getElementById("bill_no").value;
      var transaction_date = document.getElementById("transaction_date").value;
      var transaction_month = document.getElementById("transaction_month").value;
      var transaction_year = document.getElementById("transaction_year").value;
      var transaction_amount  = document.getElementById("transaction_amount").value;
      var transaction_method  = document.getElementById("transaction_method").value;
      var transaction_type  = document.getElementById("transaction_type").value;
      var transaction_comment = document.getElementById("transaction_comment").value;
      //final date of transaction
      var transaction_day = transaction_year + "-" + transaction_month + "-" + transaction_date;

      //this is the error handeling divs
      var error_box  = $(".pop_up_error_box");

      //hide any box
      error_box.hide();

      //checking the form
        if(transaction_amount.length == 0 || transaction_type.length == 0 || transaction_date.length == 0 || transaction_month.length == 0 || transaction_year.length == 0){
          throw_error(error_box , error_box , empty_field_error);
        }
        else if(!alphanumeric_validity(particulars)){
          throw_error(error_box , error_box , "Particulars" + alphanumber_field_error);
        }
        else if(!number_validity(bill_no)){
          throw_error(error_box , error_box , "Bill/Invoice" + number_field_error);
        }
        else if(!number_amount_validity2(transaction_amount)){
          throw_error(error_box , error_box , "Transaction amount" + number_field_error);
        }
        else if(!alpha_validity(transaction_method)){
          throw_error(error_box , error_box , "Transaction method " + alpha_field_error);
        }
        else
        {
           //hide error box
             //show black shadow and processing box
             error_box.hide();

             $.post("<?php echo action_app; ?>transaction_record.php" , {account_id:"<?php echo $account_id; ?>" ,  transaction_day:transaction_day , particulars:particulars , bill_no:bill_no , transaction_amount:transaction_amount ,transaction_method : transaction_method , transaction_type : transaction_type , transaction_comment:transaction_comment} , function(response){
                $(".action_transaction").html(response);
                $(".table_body_empty").hide();
             });

        }

             return false;
    });

                                            });


                                    </script>

                                    <?php 
                                      //end of service checking 
                                      }
                                    ?>

                                                </div>
                                            </div>

    								    </div>
                                   
    								<div class="account_details_company capital">
                                          
    									<?php echo $l_account_title; ?>  
                      <?php  if($l_company_name != ""){echo "[ $l_company_name ]"; } ?>
    								</div>



    								<div class="account_details_box ">

                                   <?php 
                                      /*******************************************************************************************
                                        below this is to edit data of account 
                                        {{{edit account info}}}
                                       ******************************************************************************************/

                                        include "account-edit.fragment.php";
                                     
                                      /************************************************************
                                      beyond this is to print account details 
                                      {{details}}
                                      *************************************************************/

                                      include "account-details.fragment.php";
                                        ?>
                       
    								</div>

    						</div>

                            <?php 

                                    /********************************************************
                                    beyond this is the script to display 
                                    transaction details and final calculation of them

                                    {{{transaction}}}
                                    ********************************************************/

                            ?>

    						
    					<div class="account_box table  ">
    							
                  <div class="table_head">
    									
    								<div class="table_head_title overflow capital title_1" >
											#
										</div>
										<div class="table_head_title overflow capital title_2" >
											<?php echo $lang['title_date']; ?>
										</div>
										<div class="table_head_title overflow capital title_3" >
											<?php echo $lang['particulars'] ?>
										</div>
										<div class="table_head_title overflow capital title_4" >
											<?php echo $debit_title; ?>
										</div>
										<div class="table_head_title overflow capital title_5" >
											<?php echo $credit_title; ?>
										</div>
										<div class="table_head_title overflow capital title_6">
											<?php echo $lang['title options']; ?>
										</div>

    						</div>
    								<div class="table_body">

                                        <?php

                                            /**************************************************************
                                            this is to print transaction details list wise avoiding 
                                            if it is empty
                                            **************************************************************/
                                            
                                            /*****************************************************
                                            this result is to deal with pagination
                                            *****************************************************/
                                            //this will be 25
                                            $rec_limit = 25;

                                            $max_entry = mysqli_num_rows(mysqli_query($connect , "SELECT * FROM `$db_name`.`$transactions_table` WHERE ACCOUNT_ID = '$account_id' AND OWNER_ID = '$USER_ID'"));

                                            $max_page = $max_entry / $rec_limit;

                                            
                                            //to round of page number in case they are in decimal
                                                if( round($max_page) == $max_page){
                                                      $max_page = $max_page;
                                                }else if( round($max_page) > $max_page){
                                                      $max_page = round($max_page);
                                                }else if( round($max_page) < $max_page){
                                                      $max_page = round($max_page) + 1;
                                                }
                                            


                                            //to keep users in a range of number
                                            if(isset($_GET['page'])){
                                              
                                              if($_GET['page'] != 0 && $_GET['page'] <= $max_page){ 
                                                $current_page = $_GET['page'];
                                              }else{
                                                $current_page = 1;
                                              }

                                            }else{
                                              $current_page = 1;
                                            }


                                              $offset = ($current_page - 1) * $rec_limit;

                                          
                                            /*****************************************************
                                            this is to show the result
                                            ******************************************************/

                                            //mysql code to get transaction of ledger id with this owner
                                            $transaction_code = "SELECT * FROM `$db_name`.`$transactions_table` WHERE ACCOUNT_ID = '$account_id' AND OWNER_ID = '$USER_ID' order by `DATE_OF_TRANSACTION` DESC LIMIT $offset, $rec_limit;";
                                           
                                            //to get no of transaction taking place
                                            $no_of_transaction = mysqli_num_rows(mysqli_query($connect , $transaction_code));

                                            if($no_of_transaction == 0 ){

                                                    //since no transaction has taken place
                                                    //print the appropriate response 
                                            
                                                echo " <div class='table_body_empty capital'>
                                                            " . $lang['empty_transactions'] . "
                                                        </div>";

                                            }else{

                                            //this list no is to display the line no and also to
                                            //make a line unique
                                            $list_no = $offset + 1;
                                            
                                            //mysqli resutl 
                                            $transaction_code_query = mysqli_query($connect , $transaction_code);

                                            //this is to store the current month of transaction
                                            $batch_month = "";

                                                while ($_TRANSACTION = mysqli_fetch_array($transaction_code_query)) {

                                                    $transaction_id         = $_TRANSACTION['TRANSACTION_ID'];
                                                    $particulars            = $_TRANSACTION['PARTICULARS'];
                                                    $bill_invoice_no        = $_TRANSACTION['BILL_INVOICE_NO'];
                                                    $transaction_type       = $_TRANSACTION['TRANSACTION_TYPE'];
                                                    $transaction_action     = $_TRANSACTION['TRANSACTION_ACTION'];
                                                    $transaction_method     = $_TRANSACTION['TRANSACTION_METHOD'];
                                                    $transaction_amount     = $_TRANSACTION['TRANSACTION_AMOUNT'];
                                                    $comment                = $_TRANSACTION['COMMENT'];
                                                    $date_of_transaction_1  = $_TRANSACTION['DATE_OF_TRANSACTION'];  

                                                    if($transaction_action != ""){
                                                        $transaction_type_2 = $transaction_action; 
                                                    }else{
                                                        $transaction_type_2 = $transaction_type;
                                                    }


                                                    //this is to assign the transaction amount
                                                    $debit_value    = "-";
                                                    $credit_value   = "-";

                                                    //this is to decide
                                                    //if transaction amount is getting debit or credit
                                                    //using the help of transaction type
                                                    if($transaction_type == "t1"){
                                                        $debit_value = $decode -> money($transaction_amount , $l_country , $l_currency);

                                                    }else if($transaction_type == "t2"){
                                                        $credit_value = $decode -> money($transaction_amount , $l_country , $l_currency);
                                                    }

                                                    //this is to make date in proper set
                                                    $date_of_transaction    = $decode -> date($date_of_transaction_1);

                                                         //applicable only for dd-mm-yyyy format
                                                         $year = substr($date_of_transaction_1,0,4);
                                                         $month = substr($date_of_transaction_1, 5,2);
                                                         $date = substr($date_of_transaction_1, 8,2);

                                                         //no month has started so we will start the month
                                                         if($batch_month == ""){
                                                            $batch_month = $month;
                                                         }else if($batch_month != $month){
                                                              echo "<div class='end_of_month'>".
                                                                      $lang['starting'] . " " .  $decode -> month($month) . " - " . $year . 

                                                                    "</div>";
                                                              $batch_month = $month;
                                                         }

                                                    

                                                    //hidden inputs used when updating
                                                    echo "
                                                          <input type='hidden' id = 'hidden_particulars_$list_no' value = '$particulars'>
                                                          <input type='hidden' id = 'hidden_bill_invoice_no_$list_no' value = '$bill_invoice_no'>
                                                          <input type='hidden' id = 'hidden_transaction_amount_$list_no'  value = '" . $decode -> money($transaction_amount , $l_country , $l_currency) . "'>
                                                          <input type='hidden' id = 'hidden_transaction_amount_edit_$list_no'  value = '$transaction_amount'>
                                                          <input type='hidden' id = 'hidden_transaction_type_$list_no' value = '" . $decode -> transaction_type($account_type_code , $transaction_type_2) . "'>
                                                          <input type='hidden' id = 'hidden_transaction_type_edit_$list_no' value = '$transaction_type_2'>
                                                          <input type='hidden' id = 'hidden_transaction_method_$list_no' value = '$transaction_method'>
                                                          <input type='hidden' id = 'hidden_transaction_date_$list_no' value = '$date'>
                                                          <input type='hidden' id = 'hidden_transaction_month_$list_no' value = '$month'>
                                                          <input type='hidden' id = 'hidden_transaction_year_$list_no' value = '$year'>
                                                          <input type='hidden' id = 'hidden_transaction_day_$list_no' value = '$date_of_transaction'>
                                                          <input type='hidden' id = 'hidden_transaction_comment_$list_no' value = '" . preg_replace('/\n/', '<br>', trim($comment)) . "'>
                                                          <input type='hidden' id = 'hidden_transaction_comment_edit_$list_no' value = '" . preg_replace('/\n/', '&#13;&#10;', trim($comment)) . "'>";

                                                         
                                                          /*if($account_type_code == 'le4'){
                                                              $transaction_options = "<option value='t1'>" . $lang['expense'] . "</option>" .
                                                                                      "<option value='t2'>" . $lang['income'] . "</option> ";
                                                            }else if($account_type_code == 'le3' ){
                                                              $transaction_options = "<option value='t1'>" . $lang['debt'] . "</option>" .
                                                                                     "<option value='t2'>" . $lang['debt_paid'] . "</option> ";
                                                            }else if($account_type_code == 'le2' ){
                                                              $transaction_options = "<option value='t1'>" . $lang['value'] . "</option>" .
                                                                                     "<option value='t2'>" . $lang['depreciation'] . "</option> ";
                                                            }else{
                                                              $transaction_options = "<option value='a1'>" . $lang['sales'] . "</option>" .
                                                                                     "<option value='a4'>" . $lang['purchase'] . "</option>" .
                                                                                      "<option value='a2'>" . $lang['payment_received'] . "</option>" .
                                                                                      "<option value='a3'>" . $lang['payment_paid'] . "</option> ".
                                                                                      "<option value='a5'>" . $lang['debit_note_received'] . "</option>" .
                                                                                      "<option value='a6'>" . $lang['debit_note_sent'] . "</option> ".
                                                                                      "<option value='a7'>" . $lang['other'] . " " . $lang['debit'] . " (" . $lang['out'] . ")" . "</option>" .
                                                                                      "<option value='a8'>" . $lang['other'] . " " . $lang['credit'] .  " (" . $lang['in'] . ")" . "</option> ";
                                                            } 
                                                            */

                                                            if ($account_type_code == "le1") {
                                                                  
                                                                  $particular_tag = "<div class='particular_tag'>";
                                                                switch ($transaction_type_2) {
                                                                  case 'a1':
                                                                      $particular_tag .= $lang['sale'];
                                                                    break;
                                                                  case 'a2':
                                                                      $particular_tag .= $lang['payment_received'];
                                                                    break;
                                                                  case 'a3':
                                                                      $particular_tag .= $lang['payment_paid'];
                                                                    break;
                                                                  case 'a4':
                                                                      $particular_tag .= $lang['purchase'];
                                                                    break;
                                                                  case 'a5':
                                                                      $particular_tag .= $lang['debit_note_received'];
                                                                    break;
                                                                  case 'a6':
                                                                      $particular_tag .= $lang['debit_note_sent'];
                                                                    break;
                                                                  case 'a7':
                                                                      $particular_tag .= $lang['other'] . " " . $lang['debit'] . " (" . $lang['out'] . ")";
                                                                    break;
                                                                  case 'a8':
                                                                      $particular_tag .= $lang['other'] . " " . $lang['credit'] .  " (" . $lang['in'] . ")";
                                                                    break;
                                                                  
                                                                  default:
                                                                      $particular_tag .= $lang['unknown'];
                                                                    break;
                                                                }
                                                                $particular_tag .= "</div>";

                                                            }else{
                                                                $particular_tag = "";
                                                            }
                                        ?>

                                                                     

    									<div class="table_body_item"  id="transaction_listno_<?php echo $list_no; ?>">
    										 	    
                          <span class='pop_up_open' id='transaction_details_<?php echo $list_no; ?>'>
                          	 <div class="table_body_item_detail overflow capital title_1 minor_title">
														<?php echo $list_no; ?>
												  	</div>
												  	<div class="table_body_item_detail overflow capital title_2 minor_title" id='list_day_<?php echo $list_no; ?>'>
															<?php echo $date_of_transaction; ?>
													  </div>
													  <div class="table_body_item_detail overflow capital title_3 middle_title name_title" id='list_particulars_<?php echo $list_no; ?>'>
															 <?php echo $particular_tag; ?><?php echo ($particulars != "")? $particulars : "-"; ?>
													  </div>
													  <div class="table_body_item_detail overflow capital title_4 bold_title amount_title" id='list_debit_<?php echo $list_no; ?>'>
														  	<?php  echo $debit_value; ?>
													  </div>
													  <div class="table_body_item_detail overflow capital title_5 bold_title amount_title" id='list_credit_<?php echo $list_no; ?>'>
														  	<?php echo $credit_value; ?>
													  </div>
                         </span>

													   <div class="table_body_item_detail table_options_box overflow capital title_6">
										
															                      <div class="table_detail_option tooltip_object pop_up_open pop_transaction_delete" id="delete_transaction_<?php echo $list_no; ?>">
                                           						   <img src="<?php echo image_icon; ?>documents_delete.png">
                                               						<div class='tooltip_box table_tooltip_box'>
                                                    				   <?php echo $lang['delete']; ?>
                                               						 </div>
                                       						  </div>

															                   <div class="table_detail_option tooltip_object pop_up_open" id='edit_transaction_<?php echo $list_no; ?>'>
                                           						   <img src="<?php echo image_icon; ?>documents_edit.png">
                                               						<div class='tooltip_box table_tooltip_box'>
                                                    				<?php echo $lang['edit'] ?>
                                               						 </div>
                                       						  </div>


												    </div>
    								  </div>        

                      <?php 

                                            

                                                $edit_transaction_form = "<form method='post' action='#'> ".


                                                                                            "<div class='pop_up_error_box'>Error</div>".
                                                                                            "<div class='pop_up_success_box'>Updating...</div>".
                                                                                            "<div class='action_transaction'></div>".
                                                                                        
                                                                                            "<div class='pop_item'>".
                                                                                                    "<div class='pop_item_label overflow'>" . $lang['transaction_date'] . "*</div>".
                                                                                                    "<div class='pop_item_details date_details'>".
                                                                                                                   "<select type='date' id='transaction_date_$list_no' name='birth_date' class='input date_input capital' >".
                                                                                                                      "<option selected value=''>" . $lang['date'] . "</option>" .
                                                                                                                      "<option value='01'>01</option><option value='02'>02</option><option value='03'>03</option><option value='04'>04</option><option value='05'>05</option><option value='06'>06</option><option value='07'>07</option><option value='08'>08</option><option value='09'>09</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option><option value='13'>13</option><option value='14'>14</option><option value='15'>15</option><option value='16'>16</option><option value='17'>17</option><option value='18'>18</option><option value='19'>19</option><option value='20'>20</option><option value='21'>21</option><option value='22'>22</option><option value='23'>23</option><option value='24'>24</option><option value='25'>25</option><option value='26'>26</option><option value='27'>27</option><option value='28'>28</option><option value='29'>29</option><option value='30'>30</option><option value='31'>31</option>" .
                                                                                                                  "</select>" .
                                                                                                                  "<select type='month' id='transaction_month_$list_no' name='birth_month' class='input  month_input capital' >" .
                                                                                                                      "<option  selected value='' >" . $lang['month']  . "</option> " .
                                                                                                                      "<option  value='01'>" . $lang['january'] . "</option> " .
                                                                                                                      "<option  value='02'>" . $lang['february'] . "</option> " .
                                                                                                                      "<option  value='03'>" . $lang['march'] . "</option> " .
                                                                                                                      "<option  value='04'>" . $lang['april'] . "</option> " .
                                                                                                                      "<option  value='05'>" . $lang['may'] . "</option> " .
                                                                                                                      "<option  value='06'>" . $lang['june'] . "</option> " .
                                                                                                                      "<option  value='07'>" . $lang['july'] . "</option> " .
                                                                                                                      "<option  value='08'>" . $lang['august'] . "</option> " .
                                                                                                                      "<option  value='09'>" . $lang['september'] . "</option> " .
                                                                                                                      "<option  value='10'>" . $lang['october'] . "</option> " .
                                                                                                                      "<option  value='11'>" . $lang['november'] . "</option> " .
                                                                                                                      "<option  value='12'>" . $lang['december'] . "</option> " .
                                                                                                                  "</select> " .
                                                                                                                "<select name='birth_year' id='transaction_year_$list_no' class='input year_input' >" .
                                                                                                                      "<option value=''>" . $lang['year'] . "</option>" .
                                                                                                                       $years . 
                                                                                                                "</select>" .
                                                                                                    "</div>".
                                                                                            "</div>".

                                                                                            "<div class='pop_item'>".
                                                                                                    "<div class='pop_item_label overflow'>". $lang['transaction amount'] ."*</div>".
                                                                                                    "<div class='pop_item_details'>".
                                                                                                                   "<input type='transaction_amount' id='transaction_amount_$list_no'  name='transaction_amount' placeholder='ex:- 6000' class='input pop_input' autocomplete='off' autofocus>" .
                                                                                                                  "<div class='pop_item_details_extra'>&#x20b9;</div>".
                                                                                                    "</div>".
                                                                                            "</div>".

                                                                                            "<div class='pop_item'>".
                                                                                                    "<div class='pop_item_label overflow'>" . $lang['transaction type'] . "*</div>".
                                                                                                    "<div class='pop_item_details'>".
                                                                                                                   "<select type='transaction_type' id='transaction_type_$list_no' name='transaction_type' class='input capital select_input pop_input'>" . 
                                                                                                                                "<option value='' selected></option>".
                                                                                                                                $transaction_options . 
                                                                                                                     "</select>" .               
                                                                                                    "</div>".
                                                                                            "</div>".

                                                                                        
                                                                                         
                                                                                          "<div class='pop_item'>".
                                                                                                    "<div class='pop_item_label overflow'>" . $lang['particulars'] . "</div>".
                                                                                                    "<div class='pop_item_details'>".
                                                                                                                   "<input type='particulars' id='particulars_$list_no' name='particulars'  placeholder='" . $lang['particulars example'] . "' class='input pop_input'>" .
                                                                                                                  
                                                                                                    "</div>".
                                                                                            "</div>".

                                                                                            "<div class='pop_item'>".
                                                                                                    "<div class='pop_item_label overflow'>" . $lang['bill_no'] . "</div>".
                                                                                                    "<div class='pop_item_details'>".
                                                                                                                   "<input type='bill_no' id='bill_invoice_no_$list_no' name='bill_no'  class='input' autocomplete='off'>" .
                                                                                                                  
                                                                                                    "</div>".
                                                                                            "</div>".

                                                                                              "<div class='pop_item'>".
                                                                                                    "<div class='pop_item_label overflow'>" . $lang['transaction method'] . "</div>".
                                                                                                    "<div class='pop_item_details'>".
                                                                                                                   "<input type='transaction_method' id='transaction_method_$list_no'  name='transaction_method' placeholder='example:- Bank transfer , cash' class='input pop_input'>" .
                                                                                                                  
                                                                                                    "</div>".
                                                                                            "</div>".

                                                                                             

                                                                                              "<div class='pop_item'>".
                                                                                                    "<div class='pop_item_label overflow'>" . $lang['comment'] . "</div>".
                                                                                                    "<div class='pop_item_details'>".
                                                                                                                   "<textarea type='comment' id='transaction_comment_$list_no' name='transaction_comment' class='input pop_input pop_textarea' ></textarea>" .
                                                                                                                  
                                                                                                    "</div>".
                                                                                            "</div>".

                                                                                            "<input type='submit' value='" . $lang['save'] . "' class='submit_button pop_submit' id='edit_transaction_button_$list_no'>" .

                                                                                      "</form>";

                                                    ?>

                            <script type="text/javascript">
                                      /*******************************************
                                      this is to edit a transaction 
                                      ********************************************/

                                          $("#edit_transaction_<?php echo $list_no; ?>").click(function(){

                                                    //set the title of pop up
                                                    $(".pop_up_title").html("<?php echo $lang['edit'] . ' ' . $lang['transaction']; ?>");


                                                    $(".pop_up_body").html("<?php echo $edit_transaction_form; ?>");

                                                    
                                                          
  
                                                    /*************************************************
                                                      this is to set hidden input details to transaction edit
                                                    **************************************************/
                                                          $("#particulars_<?php echo $list_no; ?>").val($("#hidden_particulars_<?php echo $list_no; ?>").val());
                                                          $("#bill_invoice_no_<?php echo $list_no; ?>").val($("#hidden_bill_invoice_no_<?php echo $list_no; ?>").val());
                                                          $("#transaction_amount_<?php echo $list_no; ?>").val($("#hidden_transaction_amount_edit_<?php echo $list_no; ?>").val());
                                                          $("#transaction_method_<?php echo $list_no; ?>").val($("#hidden_transaction_method_<?php echo $list_no; ?>").val());
                                                          $("#transaction_type_<?php echo $list_no; ?>").val($("#hidden_transaction_type_edit_<?php echo $list_no; ?>").val());
                                                          $("#transaction_comment_<?php echo $list_no; ?>").html($("#hidden_transaction_comment_edit_<?php echo $list_no; ?>").val());
                                                          $("#transaction_date_<?php echo $list_no ?>").val($("#hidden_transaction_date_<?php echo $list_no; ?>").val());
                                                          $("#transaction_month_<?php echo $list_no ?>").val($("#hidden_transaction_month_<?php echo $list_no; ?>").val());
                                                          $("#transaction_year_<?php echo $list_no ?>").val($("#hidden_transaction_year_<?php echo $list_no; ?>").val());



  $("#edit_transaction_button_<?php echo $list_no; ?>").click(function(){

      var particulars         = $("#particulars_<?php echo $list_no; ?>").val();
      var bill_no             = $("#bill_invoice_no_<?php echo $list_no; ?>").val();
      var transaction_date    = $("#transaction_date_<?php echo $list_no; ?>").val();
      var transaction_month   = $("#transaction_month_<?php echo $list_no; ?>").val();
      var transaction_year    = $("#transaction_year_<?php echo $list_no; ?>").val();
      var transaction_amount  = $("#transaction_amount_<?php echo $list_no; ?>").val();
      var transaction_method  = $("#transaction_method_<?php echo $list_no; ?>").val();
      var transaction_type    = $("#transaction_type_<?php echo $list_no; ?>").val();
      var transaction_comment = $("#transaction_comment_<?php echo $list_no; ?>").val();
      //final date of transaction
      var transaction_day = transaction_year + "-" + transaction_month + "-" + transaction_date;

      //this is the error handeling divs
      var error_box  = $(".pop_up_error_box");

      //hide any box
      error_box.hide();

      //checking the form
        if(transaction_amount.length == 0 || transaction_type.length == 0 || transaction_date.length == 0 || transaction_month.length == 0 || transaction_year.length == 0){
          throw_error(error_box , error_box , empty_field_error);
        }
        else if(!alphanumeric_validity(particulars)){
          throw_error(error_box , error_box , "Particulars" + alphanumber_field_error);
        }
        else if(!number_validity(bill_no)){
          throw_error(error_box , error_box , "Bill/Invoice" + number_field_error);
        }
        else if(!number_amount_validity2(transaction_amount)){
          throw_error(error_box , error_box , "Transaction amount" + number_field_error);
        }
        else if(!alpha_validity(transaction_method)){
          throw_error(error_box , error_box , "Transaction method " + alpha_field_error);
        }
        else
        {
           //hide error box
             //show black shadow and processing box
             error_box.hide();

             $.post("<?php echo action_app; ?>transaction_edit.php" , { transaction_day:transaction_day , language:"<?php echo $LANGUAGE; ?>" , account_type_code:"<?php  echo $account_type_code; ?>"  , index : "<?php echo $list_no; ?>" , transaction_id :"<?php echo $transaction_id; ?>" , particulars:particulars , bill_no:bill_no , transaction_amount:transaction_amount ,transaction_method : transaction_method , transaction_type : transaction_type , transaction_comment:transaction_comment} , function(response){
                $(".action_transaction").html(response);
                $(".table_body_empty").hide();
             });

        }

       return false;

  });

                                          });

                            </script>

                                      <script type="text/javascript">
                                            /*********************************
                                              this is to show details of transaction
                                            *********************************/
                                            $("#transaction_details_<?php echo $list_no; ?>").click(function(){


                                                    //set the title of pop up
                                                    $(".pop_up_title").html("<?php echo $lang['transaction_details'] ?>");

                                                     $(".pop_up_body").html("<div class='pop_item'>" +
                                                                                             "<div class='pop_item_label capital overflow'><?php echo $lang['transaction amount']; ?>:</div>" +
                                                                                              "<div class='pop_item_details overflow' id='details_transaction_amount_<?php echo $list_no; ?>'></div>"+
                                                                                       "</div>" +

                                                                              "<div class='pop_item'>" +
                                                                                             "<div class='pop_item_label capital overflow'><?php echo $lang['transaction type']; ?>:</div>" +
                                                                                              "<div class='pop_item_details capital' id='details_transaction_type_<?php echo $list_no; ?>'></div>"+
                                                                                       "</div>" +

                                                                            "<div class='pop_item'>" +
                                                                                             "<div class='pop_item_label capital overflow'><?php echo  $lang['particulars']; ?>:</div>" +
                                                                                              "<div class='pop_item_details ' id='details_particulars_<?php echo $list_no; ?>'></div>"+
                                                                                       "</div>" +

                                                                              "<div class='pop_item'>" +
                                                                                             "<div class='pop_item_label capital overflow'><?php echo $lang['bill_no']; ?>:</div>" +
                                                                                              "<div class='pop_item_details ' id='details_bill_invoice_no_<?php echo $list_no; ?>'></div>"+
                                                                                       "</div>" +

                                                                              "<div class='pop_item'>" +
                                                                                             "<div class='pop_item_label capital overflow'><?php echo $lang['transaction method']; ?>:</div>" +
                                                                                              "<div class='pop_item_details ' id='details_transaction_method_<?php echo $list_no; ?>'></div>"+
                                                                                       "</div>" +

                                                                               "<div class='pop_item'>" +
                                                                                             "<div class='pop_item_label capital overflow'><?php echo $lang['transaction_date']; ?>:</div>" +
                                                                                              "<div class='pop_item_details ' id='details_date_of_transaction_<?php echo $list_no; ?>'></div>"+
                                                                                       "</div>" +

                                                                              "<div class='pop_item'>" +
                                                                                             "<div class='pop_item_label capital overflow'><?php echo $lang['comment']; ?>:</div>" +
                                                                                              "<div class='pop_item_details' id='details_comment_<?php echo $list_no; ?>'></div>"+
                                                                                       "</div>" 
                                                                            
                                                                            );
                                                   /*************************************************
                                                      this is to set hidden input details to transaction details
                                                    **************************************************/
                                                          $("#details_particulars_<?php echo $list_no; ?>").html($("#hidden_particulars_<?php echo $list_no; ?>").val());
                                                          $("#details_bill_invoice_no_<?php echo $list_no; ?>").html($("#hidden_bill_invoice_no_<?php echo $list_no; ?>").val());
                                                          $("#details_transaction_amount_<?php echo $list_no; ?>").html($("#hidden_transaction_amount_<?php echo $list_no; ?>").val());
                                                          $("#details_transaction_method_<?php echo $list_no; ?>").html($("#hidden_transaction_method_<?php echo $list_no; ?>").val());
                                                          $("#details_transaction_type_<?php echo $list_no; ?>").html($("#hidden_transaction_type_<?php echo $list_no; ?>").val());
                                                          $("#details_comment_<?php echo $list_no; ?>").html($("#hidden_transaction_comment_<?php echo $list_no; ?>").val());
                                                          $("#details_date_of_transaction_<?php echo $list_no; ?>").html($("#hidden_transaction_day_<?php echo $list_no; ?>").val());


                                            });
                                      </script>

                                      <script type="text/javascript">
                                          /************************************
                                            this is to delete the transaction 
                                          **************************************/

                                          $('#delete_transaction_<?php echo $list_no; ?>').click(function(){

                                                      //set the title of pop up
                                                      $(".pop_up_title").html("<?php echo $lang['delete']; ?>");

                                                      //set the content
                                                      $(".pop_up_body").html( "<div class='delete_action'></div>" +
                                                                              "<div class='delete_line overflow'>" +
                                                                                  "<?php echo $lang['transaction_delete_permission']; ?>" +
                                                                              "</div>" +
                                                                              "<div class='permission_line'>" +
                                                                                   "<input type='button' class='cancel_button pop_permission_button' id='cancel_delete_transaction' value='<?php echo $lang['no']; ?>'>" +
                                                                                   "<input type='button' class='submit_button pop_permission_button' id='allow_delete_transaction_<?php echo $list_no; ?>' value='<?php echo $lang['yes']; ?>'>" +
                                                                              "</div>"
                                                                             );

                                                      //to delete a transaction according to the click
                                                      $("#allow_delete_transaction_<?php echo $list_no; ?>").click(function(){

                                                        //showing the div to delete the data
                                                          var response_box = $(".delete_action");
                                                          response_box.show();

                                                          $.post("<?php echo action_app; ?>transaction_delete.php" , {transaction_id : "<?php echo $transaction_id; ?>" } , function(response){

                                                              //print the response in response box
                                                              response_box.html(response);
                                                              //hide the pop box
                                                              effect_pop_hide();

                                                              //remove the box from the list
                                                              setTimeout(function(){
                                                                  $("#transaction_listno_<?php echo $list_no; ?>").hide("drop" , {direction : "right"} , 300);
                                                              },200);

                                                          });

                                                      });

                                          });


                                      </script>


                                      <?php 
                                            $list_no++;}//end of while
                                        }//end of else after no_tracsaction check
                                      ?>

                                      <script type="text/javascript">
                                          
                                          /*****************************************
                                           comman transaction script 
                                          *****************************************/
                                          $(".pop_transaction_delete").click(function(){
                                               $('#cancel_delete_transaction').click(function(){
                                                           effect_pop_hide();
                                                     });
                                          });

                                            


                                      </script>



                                      <?php 


                                                  $page_url =  app . "account/" . $account_id . "/";

                                                 if($current_page == $max_page){
                                                     echo "<div class='end_of_list'>" . $lang['end_of_transactions'] . "</div>";
                                                 }

                                      ?>

                                      <div class='pagination_box'>
                                                   
                                              <a href="<?php echo $page_url . ($current_page -1) ?>"><div class='pagination_box_item pagination_button pagination_button_left'>Previous</div></a>
                                            
                                              

                                                         
                                                    <div class='pagination_center'>



                                                          <?php 
                                                              if($current_page != 1){
                                                                  
                                                                  echo "<a href='" . $page_url. "1'><div class='pagination_box_item pagination_page_no'>1</div></a>
                                                                        <div class='pagination_box_item pagination_dots'>...</div>";

                                                              }

                                                            ?>
                                                            
                                                              <?php                                                                  if($max_page > 5){
                                                                    for($i = $current_page; $i <= ($current_page + 4); $i++){

                                                                              //this is to assign the class to selected page
                                                                              if($i == $current_page){
                                                                                  $selected = "pagination_selected";
                                                                              }else{
                                                                                  $selected ="";
                                                                              }

                                                                              if($i < $max_page){
                                                                                 echo "<a href='" . $page_url . $i . "'><div class='pagination_box_item pagination_page_no $selected'>$i</div></a>";
                                                                                
                                                                              }

                                                                    }

                                                                }
                                                              ?>

                                                      


                                                          <?php 
                                                              if($current_page != $max_page){
                                                                  
                                                                  echo "<div class='pagination_box_item pagination_dots'>...</div>";
                                                              }

                                                              if($current_page == $max_page){
                                                                $selected = "pagination_selected";
                                                              }else{
                                                                $selected = "";
                                                              }
                                                              echo "<a href='" . $page_url . $max_page . "'><div class='pagination_box_item pagination_page_no $selected'>$max_page</div></a>";

                                                            ?>                                                          
                                                    </div>

                                                <a href="<?php echo $page_url . ($current_page + 1); ?>"><div class='pagination_box_item pagination_button pagination_button_right'>Next</div></a>
                                            


                                      </div>

                                    
                                             

    										

    								</div>


                                     
    						</div>
                           
 	 


                    <?php 

                     }//end of if of no_of_ledgers
                     else
                     {      
                        echo "
                            <div class='error_404_heading capital'>
                                    404
                            </div>
                            <div class='error_404_sub capital'>
                                    " . $lang['account_not_found'] . "
                            </div>
                        <div class='error_404_box'>
                               " . $lang['account_not_found_passage'] . " <a href='" . site . "contactus'>
                               " . $lang['contactus'] . "</a>. 

                              <br><br>
                              <span class='capital'>
                                  " . $lang['warm regards'] . ",
                                  <br>
                                  <span class='error_404_last_line'>" . app_name . " " . $lang['team'] . "</span>
                              </span>

                        </div>";
                     }
                    ?>

 	    </div>

</body>
</html>