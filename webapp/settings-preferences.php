

         <script type="text/javascript" src="<?php echo script_app; ?>settings-preferences.js"></script>
 
     <script type='text/javascript' >
        $(document).ready(function(){
      <?php 

                                    if(isset($LANGUAGE))
                                        {
                                            if(!is_null($LANGUAGE))
                                            {echo "$('#language').val('$LANGUAGE');";}
                                        }

                                    if(isset($HOME_PAGE))
                                        {
                                            if(!is_null($HOME_PAGE))
                                            {echo "$('#homepage').val('$HOME_PAGE');";}
                                        }

                                    if(isset($MODE))
                                        {
                                            if(!is_null($MODE))
                                            {echo "$('#mode').val('$MODE');";}
                                        }

                            
                    

      ?>
      });
    </script>

          <div class="box_body_top">
                <div class="settings_title box_heading capital ">
                         <img src="<?php echo image_icon ?>setting_preferences.png"> 
                          <?php echo $lang['preferences']; ?>          
                </div>
          </div>
    				
    				<div class="settings_fields_box ">
    					<form method="post" enctype='multipart/form-data' action="<?php echo action_app; ?>update_settings_preferences.php" id='settings_preferences_form'>

                            <div class="error_box"><?php echo $lang['error']; ?></div>
                            <div class="success_box"><?php echo $lang['successfully saved']; ?></div>

                           

    						<div class="settings_fields_box_row">
    								<div class="settings_fields_box_row_name">
    										<?php echo $lang['language']; ?>*
    								</div>
    								<div class="settings_fields_box_row_field">
    									 <select type="language" id="language" name="language" class="input capital select_input">
                                     
                                        	  <option value=""><?php echo $lang['select']; ?></option>
                                        	  <option value="HI"><?php echo $lang['hindi']; ?></option>
                                        	  <option value="EN" selected><?php echo $lang['english']; ?></option>

                                         </select>
    								</div>
    						</div>





    					<div class="settings_fields_box_row">
    								<div class="settings_fields_box_row_name">
    										<?php echo $lang['mode']; ?>*
    								</div>
    								<div class="settings_fields_box_row_field">
    									 <select type="mode" id="mode" name="mode" class="input capital select_input">
                                     
                                        	  <option value=""><?php echo $lang['select']; ?></option>
                                        	  <option value="mo1" selected><?php echo $lang['mode_1']; ?></option>
                                            <option value="mo2"><?php echo $lang['mode_2']; ?></option>

                                         </select>
    								</div>
    						</div>

                

                        <div class="settings_fields_box_row">
                                    <div class="settings_fields_box_row_name">
                                            <?php echo $lang['home page']; ?>*
                                    </div>
                                    <div class="settings_fields_box_row_field">
                                         <select type="homepage" id="homepage" name="homepage" class="input capital select_input">
                                     
                                              <option value=""><?php echo $lang['select']; ?></option>
                                              <option value="hp1" selected><?php echo $lang['dashboard']; ?></option>
                                              <option value="hp2"><?php echo $lang['profile']; ?></option>
                                              <option value="hp3">Transactions</option>
                                              <option value="hp4"><?php echo $lang['ledger']; ?></option>
                                              <option value="hp5">Asset</option>
                                              <option value="hp6">Liability</option>
                                              <option value="hp7"><?php echo $lang['expense_income']; ?></option>
                                              <option value="hp8"><?php echo $lang['documents']; ?></option>

                                         </select>

                                         <div class="logo_row_details">
                                                  <?php echo $lang['homepage details']; ?>
                                         </div>
                                    </div>
                            </div>
                        
                        
                          <br><br>
                           <input type="submit" value="<?php echo $lang['save']; ?>" class="submit_button" id="settings_preferences_button">
    					
                        </form>
    				</div>
