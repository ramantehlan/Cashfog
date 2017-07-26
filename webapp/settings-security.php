
                  <script type="text/javascript" src="<?php echo script; ?>form-check.js"></script>
                  <script type="text/javascript" src="<?php echo script_app; ?>settings-security.js"></script>

            <div class="box_body_top">
                <div class="settings_title box_heading capital ">
                            <img src="<?php echo image_icon ?>setting_security.png"> 
                            <?php echo $lang['security']; ?>
                </div>
            </div>
    				
    				<div class="settings_fields_box ">

    					<form method="post" action="<?php echo action_app; ?>update_settings_security.php" id='settings_security_form'>

                            <div class="error_box">error</div>
                            <div class="success_box">Successfully Saved</div>

    						<div class="settings_fields_box_row">
    								<div class="settings_fields_box_row_name">
    										<?php echo $lang['current password']; ?>*
    								</div>
    								<div class="settings_fields_box_row_field">
    									<input type='password'  class="input"  maxlength="128" name="old_password" id="old_password">
    								</div>
    						</div>

    						<div class="settings_fields_box_row">
    								<div class="settings_fields_box_row_name">
    										<?php echo $lang['new password']; ?>*
    								</div>
    								<div class="settings_fields_box_row_field">
    									<input type='password'  class="input"  maxlength="128" name="new_password" id="new_password">
    								</div>
    						</div>

    						<div class="settings_fields_box_row">
    								<div class="settings_fields_box_row_name">
    										<?php echo $lang['retype password']; ?>*
    								</div>
    								<div class="settings_fields_box_row_field">
    									<input type='password'  class="input"  maxlength="128" name="new_password_retype" id="new_password_retype">
    								</div>
    						</div>

                            <br>
    						<input type="submit" value="<?php echo $lang['save']; ?>" class="submit_button" id="settings_security_button">

                        </form>

    				</div>
