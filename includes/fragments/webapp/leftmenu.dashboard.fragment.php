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


			<a href='<?php echo profile . $_SESSION[app_name . "user_id"]; ?>'>
		<div class="leftmenu_row tooltip_object <?php if($page_name == "profile"){echo "leftmenu_row_selected";} ?>">
				
				<div class='leftmenu_row_icon' >
						<?php 
								//if no logo is set
								if(/*$LOGO == "" */true){
						?>
						<img src='<?php echo image_icon; ?>app_profile.png' title="<?php echo $lang['profile']; ?>">
						<?php
								}else{

						?>
						<img src='<?php echo image_company_logo; ?>small/<?php echo $LOGO; ?>' class='small_logo_icon' title="<?php echo $lang['profile']; ?>" >
						<?php } ?>
				</div>
				
				<div class="tooltip_box menu_tooltip_box">
						<?php echo $lang['profile']; ?>
				</div>
		</div>
		</a>



		<a href='<?php echo app; ?>transactions'>
		<div class="leftmenu_row tooltip_object <?php if($page_name == "transactions"){echo "leftmenu_row_selected";} ?>">
				
				<div class='leftmenu_row_icon'>
						<img src='<?php echo image_icon; ?>app_accounting.png' title="<?php echo $lang['transactions']; ?>">
				</div>
				
				<div class="tooltip_box menu_tooltip_box">
						<?php echo $lang['transactions']; ?>
				</div>
		</div>
		</a>



		<a href='<?php echo app; ?>documents'>
		<div class="leftmenu_row tooltip_object <?php if($page_name == "documents"){echo "leftmenu_row_selected";} ?>">
				
				<div class='leftmenu_row_icon' >
                       <img src='<?php echo image_icon; ?>app_documents.png' title="<?php echo $lang['documents']; ?>">
				</div>
				
				<div class="tooltip_box menu_tooltip_box">
						<?php echo $lang['documents']; ?>
				</div>
		</div>
		</a>




		<?php /*<a href='<?php echo app; ?>analysis'>
		<div class="leftmenu_row tooltip_object <?php if($page_name == "analysis"){echo "leftmenu_row_selected";} ?>">
				
				<div class='leftmenu_row_icon'>
						<img src='<?php echo image_icon; ?>app_analysis.png' title="<?php echo $lang['analysis']; ?>">
				</div>
				
				<div class="tooltip_box menu_tooltip_box">
						<?php echo $lang['analysis']; ?>
				</div>
		</div>
		</a> 




		<a href='<?php echo app; ?>trash'>
		<div class="leftmenu_row tooltip_object <?php if($page_name == "trash"){echo "leftmenu_row_selected";} ?>">
				
				<div class='leftmenu_row_icon'>
						<img src='<?php echo image_icon; ?>app_trash.png' title="<?php echo $lang['trash']; ?>">
				</div>
				
				<div class="tooltip_box menu_tooltip_box">
						<?php echo $lang['trash']; ?>
				</div>
		</div>
		</a> */ ?>

		<a href='<?php echo app; ?>settings'>
		<div class="leftmenu_row tooltip_object <?php if($page_name == "settings"){echo "leftmenu_row_selected";} ?>">
				
				<div class='leftmenu_row_icon'>
						<img src='<?php echo image_icon; ?>setting_account.png' title="<?php echo $lang['settings']; ?>">
				</div>
				
				<div class="tooltip_box menu_tooltip_box">
						<?php echo $lang['settings']; ?>
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