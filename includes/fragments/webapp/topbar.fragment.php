<div class='topbar_frame'>

	
        <div class='page_name'>
                <?php 
                    switch ($page_name) {
                        case 'dashboard':
                            echo $lang['dashboard'];
                            break;
                        case 'profile':
                            echo $lang['profile'];
                            break;
                        case 'transactions':
                            echo $lang['transactions'];
                            break;
                        case 'documents':
                            echo $lang['documents'];
                            break;
                        case 'ledger':
                            echo $lang['ledger'];
                            break;
                        case 'asset':
                            echo $lang['assets'];
                            break;
                        case 'liability':
                            echo $lang['liabilities'];
                            break;
                        case 'expense_income':
                            echo $lang['expense_income'];
                            break;
                        case 'settings-account':
                            echo $lang['account settings'];
                            break;
                        case 'settings-preferences':
                            echo $lang['preferences'];
                            break;
                        case 'settings-subscription':
                            echo $lang['subscription'];
                            break;
                        case 'settings-security':
                            echo $lang['security'];
                            break;
                        default:
                            
                            break;
                    }
                ?>
        </div>


		<div class='center_menu' id='center_menu'>
				<?php 
 	    	   				/* for future i am planning to provide users with the shortcut/short link of there profile
 	    	   				so that they could share it with anyone and also i am planning to allow them to search 
 	    	   				for local mechanics and other materials in there own locality. and i am also planning to allow
 	    	   				users to add a buyer through site only if the buyer is there on this site and also they could send
 	    	   				each other orders and also provide users with the facility to advertise on the site to other people
 	    	   				in the same locality. 3 page accounting and 1 page analysis. in future we will have 
 	    	   				payroll, inventory

 	    	   				api/platform for anyone to create a payment gateway on our site define there country sector there 
 	    	   				required fields
 	    	   					*/
 	    	   				?>

 	    	   				<select  id="account_shortcut"  class="top_input chosen_select capital" style="width:250px;"  tabindex="5">
                                                 <option value="" selected><?php echo $lang['select']; ?></option>
                                                 
                                                        <?php

                                                            $account_type = array('le1' , 'le2' , 'le3' ,  'le4'  );

                                                            for($i = 0; count($account_type) > $i; $i++){

                                                                //store the list heading/title
                                                                 $list_title = "Unknown";

                                                                        //getting title of index
                                                                         switch ($account_type[$i]) {
                                                                                case 'le1':
                                                                                        $list_title = $lang['ledger'];
                                                                                break;
                                                                                case 'le2':
                                                                                    $list_title = $lang['asset'];
                                                                                break;
                                                                                case 'le3':
                                                                                    $list_title = $lang['liability'];
                                                                                break;
                                                                                case 'le4':
                                                                                    $list_title = $lang["expense_income"];
                                                                                break;
                                                                            }


                                                                //to print the account name
                                                                $code  = "SELECT * FROM `$db_name`.`$accounts_table` where OWNER_ID = '$USER_ID' AND ACCOUNT_TYPE = '" . $account_type[$i] . "' ORDER BY 'ACCOUNT_TITLE'";
                                                                //running mysql code
                                                                $code_result = mysqli_query($connect , $code);
                                                                //get no of account
                                                                $no_of_account = mysqli_num_rows($code_result);
                                                                //check if no_of_account is not zero
                                                                if($no_of_account > 0){

                                                                 echo "<optgroup label=" . '"' . $list_title  . '"' . ">";
                                                                  
                                                                            while ($_BUYER = mysqli_fetch_array($code_result)) {
                                                                            
                                                                                $buyer_account_title = ucfirst($_BUYER['ACCOUNT_TITLE']);
                                                                                $buyer_account_id    = $_BUYER['ACCOUNT_ID'];

                                                                                echo "<option value='$buyer_account_id'>$buyer_account_title</option>";

                                                                            }

                                                                echo "</optgroup>";
                                                                }

                                                        }//end of for


                                                         ?>
                                              </select>

                                              <input type='hidden' value='<?php echo app . "account/"; ?>' id='account_shortcut_link'>
                                              <a href='#' id='account_shortcut_action'><input type="button" value='<?php echo $lang['open']; ?>' class='top_button'></a>
		</div>




		<?php 

			//this is to show that trial period or subscription period is over
			if( !(allow_service) ){
					if(period_name == "trial-done"){
		?>
					<a href="<?php echo app; ?>settings/subscription"><div class='subscription_alert'>
							 <?php echo $lang['top_trial_over']; ?>
					</div></a>

		<?php 
					}else if(period_name == "subscribed-done"){

		?>

				<a href="<?php echo app; ?>settings/subscription"><div class='subscription_alert'>
							<?php echo $lang['top_subscription_over']; ?>
					</div></a>

		<?php
					}
			}

		?>


      
   
   

</div>