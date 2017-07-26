     <script type='text/javascript' >
        $(document).ready(function(){
      <?php 

                                    if(isset($BUYER_CODE)){
                                            if(!is_null($BUYER_CODE)){
                                            	echo "$('#buyer_term').val('$BUYER_CODE');";}
                                        }

                                    if(isset($SELLER_CODE)){
                                            if(!is_null($SELLER_CODE)){
                                            	echo "$('#seller_term').val('$SELLER_CODE');";}
                                        } 
                    
                                    if(isset($FINANCIAL_PERIOD)){
                                        if(!is_null($FINANCIAL_PERIOD)){
                                            echo "$('#financial_period').val('$FINANCIAL_PERIOD');";
                                        }
                                    }

      ?>
      });
    </script>

<form method="post" enctype='multipart/form-data' action="<?php echo action_app; ?>accounting_edit.php" id='accounting_edit_form'>

	<div class=" box_body dark_box_body">

		 <div class='box_body_top'>
                <div class="box_heading capital">
                        <img src="<?php echo image_icon ?>account_edit_white.png">
						<?php echo $lang['transactions']; ?>
				</div>
        </div>

                        <div class="error_box accounting_edit_error"><?php echo $lang['error'] ?></div>
                        <div class="success_box accounting_edit_success">Successfully Edited</div>

        <div class='form_box'>
        	<div class="form_box_row">
                 				<div class="form_box_row_title">
                 						<?php echo $lang['financial_period'] ?>*
                 				</div>
                 						<div class="form_box_row_field">
                 							 <select type="financial_period" id="financial_period" name="financial_period" class="input select_input capital">
                                     
                                                        <option value="fp1"><?php echo $lang['january']; ?> - <?php echo $lang['december']; ?></option>
                                                        <option value="fp2"><?php echo $lang['february']; ?> - <?php echo $lang['january']; ?></option>
                                                        <option value="fp3"><?php echo $lang['march']; ?> - <?php echo $lang['february']; ?></option>
                                                        <option value="fp4" selected><?php echo $lang['april']; ?> - <?php echo $lang['march']; ?></option>
                                                        <option value="fp5"><?php echo $lang['may']; ?> - <?php echo $lang['april']; ?></option>
                                                        <option value="fp6"><?php echo $lang['june']; ?> - <?php echo $lang['may']; ?></option>
                                                        <option value="fp7"><?php echo $lang['july']; ?> - <?php echo $lang['june']; ?></option>
                                                        <option value="fp8"><?php echo $lang['august']; ?> - <?php echo $lang['july']; ?></option>
                                                      	<option value="fp9"><?php echo $lang['september']; ?> - <?php echo $lang['august']; ?></option>
                                                        <option value="fp10"><?php echo $lang['october']; ?> - <?php echo $lang['september']; ?></option>
                                                        <option value="fp11"><?php echo $lang['november']; ?> - <?php echo $lang['october']; ?></option>
                                                        <option value="fp12"><?php echo $lang['december']; ?> - <?php echo $lang['november']; ?></option>

                                                 </select>
                                                
                 						</div>

            </div>

            <div class="form_box_row">
                 				<div class="form_box_row_title">
                 						<?php echo $lang['currency']; ?>
                 				</div>
                 						<div class="form_box_row_field">
                 							<select type="currency" id="currency" name="currency" class="input select_input no_entry" disabled>
                                                          <option value=""><?php echo $lang['select']; ?></option>
                                                          <option value="INR" selected><?php echo $lang['indian_rupee'] ?></option>
                                            </select>
                 						</div>
            </div>

        	 <div class="form_mid_box">
                    <div class="form_mid_heading capital">
                        <?php echo $lang['terminology title']; ?>:-
                    </div>
                    <div class="for_mid_body">

                                        
                            <div class="form_box_row">
                 				<div class="form_box_row_title">
                 						<?php echo $lang['buyer'] ?>*
                 				</div>
                 						<div class="form_box_row_field">
                 							 <select type="buyer_term" id="buyer_term" name="buyer_term" class="input select_input capital">
                                     
                                                        <option value=""><?php echo $lang['select terminology buyer']; ?></option>
                                                        <option value="bt1" selected><?php echo $lang['buyer']; ?></option>
                                                        <option value="bt2"><?php echo $lang['customer']; ?></option>
                                                        <option value="bt3"><?php echo $lang['client']; ?></option>
                                                        <option value="bt4"><?php echo $lang['tenant']; ?></option>
                                                        <option value="bt5"><?php echo $lang['donor']; ?></option>
                                                        <option value="bt6"><?php echo $lang['guest']; ?></option>
                                                        <option value="bt7"><?php echo $lang['member']; ?></option>
                                                        <option value="bt8"><?php echo $lang['patient']; ?></option>

                                                 </select>
                 						</div>
                    		</div>

                            <div class="form_box_row">
                 				<div class="form_box_row_title">
                 						<?php echo $lang['seller'] ?>*
                 				</div>
                 						<div class="form_box_row_field">
                 							<select type="seller_term" id="seller_term" name="seller_term" class="input select_input capital">
                                     
                                                        <option value=""><?php echo $lang['select terminology seller']; ?></option>
                                                        <option value="st1" selected><?php echo $lang['seller']; ?></option>
                                                        <option value="st2"><?php echo $lang['vender']; ?></option>
                                                        <option value="st3"><?php echo $lang['supplier']; ?></option>

                                                    </select>
                 						</div>
                    		</div>

                    		 <br>
                            <input type="submit" value="<?php echo $lang['save']; ?>" class="form_button  submit_button" id='submit_edit_account'>

                    </div>
                     		
           </div>


                 
	</div>

	</div>

</form>