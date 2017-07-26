<div class="leftmenu">
	
	<div class='left_logo'>
			 <img src="<?php echo img_24_logo;?>">
	</div>

	<div class="leftmenu_body">

		<a href='<?php echo app; ?>dashboard'>
 		<div class="leftmenu_row tooltip_object <?php if($page_name == "dashboard"){echo "leftmenu_row_selected";} ?>">
				
				<div class='leftmenu_row_icon'>
						<img src='<?php echo image_icon; ?>app_dashboard.png' title="<?php echo $lang['dashboard']; ?>">
				</div>
				
				<div class="tooltip_box menu_tooltip_box">
						<?php echo $lang['dashboard']; ?>
				</div>
		</div>
		</a>

		<a href='<?php echo app; ?>settings'>
		<div class="leftmenu_row tooltip_object <?php if($page_name == "settings-account"){echo "leftmenu_row_selected";} ?>">
				
				<div class='leftmenu_row_icon'>
						<img src='<?php echo image_icon; ?>setting_account.png' title="<?php echo $lang['account settings']; ?>">
				</div>
				
				<div class="tooltip_box menu_tooltip_box">
						<?php echo $lang['account settings']; ?>
				</div>
		</div>
		</a>



		<a href='<?php echo app; ?>settings/preferences'>
		<div class="leftmenu_row tooltip_object <?php if($page_name == "settings-preferences"){echo "leftmenu_row_selected";} ?>">
				
				<div class='leftmenu_row_icon'>
						<img src='<?php echo image_icon; ?>setting_preferences.png' title="<?php echo $lang['preferences']; ?>">
				</div>
				
				<div class="tooltip_box menu_tooltip_box">
						<?php echo $lang['preferences']; ?>
				</div>
		</div>
		</a>

		<?php /*<a href='<?php echo app; ?>settings/taxation'>
		<div class="leftmenu_row tooltip_object <?php if($page_name == "settings-taxation"){echo "leftmenu_row_selected";} ?>">
				
				<div class='leftmenu_row_icon'>
						<img src='<?php echo image_icon; ?>setting_taxation.png' title="Taxation">
				</div>
				
				<div class="tooltip_box menu_tooltip_box">
						Taxation
				</div>
		</div>
		</a>*/ ?>

		<a href='<?php echo app; ?>settings/subscription'>
		<div class="leftmenu_row tooltip_object <?php if($page_name == "settings-subscription"){echo "leftmenu_row_selected";} ?>">
				
				<div class='leftmenu_row_icon'>
						<img src='<?php echo image_icon; ?>subscription.png' title="<?php echo $lang['subscription']; ?>">
				</div>
				
				<div class="tooltip_box menu_tooltip_box">
						<?php echo $lang['subscription']; ?>
				</div>
		</div>
		</a>

		<a href='<?php echo app; ?>settings/security'>
		<div class="leftmenu_row tooltip_object <?php if($page_name == "settings-security"){echo "leftmenu_row_selected";} ?>">
				
				<div class='leftmenu_row_icon'>
						<img src='<?php echo image_icon; ?>setting_security.png' title="<?php echo $lang['security']; ?>">
				</div>
				
				<div class="tooltip_box menu_tooltip_box">
						<?php echo $lang['security']; ?>
				</div>
		</div>
		</a>

		<a href='<?php echo app; ?>logout'>
		<div class="leftmenu_row tooltip_object">
				
				<div class='leftmenu_row_icon' >
                       <img src='<?php echo image_icon; ?>logout.png' title="<?php echo $lang['logout']; ?>">
				</div>
				
				<div class="tooltip_box menu_tooltip_box">
						<?php echo $lang['logout']; ?>
				</div>
		</div>
		</a>




	</div>

</div>

