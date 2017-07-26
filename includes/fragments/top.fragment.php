<div class='top'>

	<div class='logo'>
		<a href="<?php echo url; ?>"><img src="<?php echo img_full_logo;?>" alt='cashfog_beta_logo'></a>
		<sub>Beta</sub>
	</div>
	<div class="left_menu">
		
		<a href='<?php echo site; ?>about'><div class='option <?php if(current_url == site . "about"){echo "selected_option";} ?>'>ABOUT</div></a>
		<a href='<?php echo url; ?>signin'><div class='option <?php if(current_url == url . "signin"){echo "selected_option";} ?>'>SIGN IN</div></a>
		<a href='<?php echo url; ?>signup'><div class='option <?php if(current_url == url . "signup"){echo "selected_option";} ?>'>SIGN UP</div></a>
	</div>

</div>