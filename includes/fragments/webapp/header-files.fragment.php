<?php
//these are the basic ui for all pages
?>
	<link rel="shortcut icon" href="<?php echo img_fevicon; ?>" type="image/x-icon">
	<link rel="icon" href="<?php echo img_fevicon; ?>" type="image/x-icon">

<link rel="stylesheet" type="text/css" href="<?php echo style; ?>jquery-ui.css"> 
<link rel="stylesheet" type="text/css" href="<?php echo style_app; ?>comman-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo style_app; ?>background-ui.css"> 
<link rel="stylesheet" type="text/css" href="<?php echo style_app; ?>topbar-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo style_app; ?>leftmenu-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo style_app; ?>tooltip-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo style; ?>open_effects.css">
<link rel='stylesheet' type='text/css' href='<?php echo style; ?>chosen.css'>
<link rel='stylesheet' type='text/css' href='<?php echo style_app; ?>chosen_select.css'>

<script type="text/javascript" src="<?php echo script; ?>jquery.js"></script>
<script type="text/javascript" src="<?php echo script; ?>jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo script_app; ?>tooltips.js"></script>
<script type="text/javascript" src="<?php echo script_app; ?>topbar.js"></script>
<script type="text/javascript" src="<?php echo script; ?>open_effects.js"></script>
<script type="text/javascript" src="<?php echo script_app; ?>background.js"></script>
<script type='text/javascript' src='<?php echo script; ?>chosen.jquery.js'></script>
<script type='text/javascript' src='<?php echo script_app; ?>chosen_select.js'></script>





<?php 

//this is to set the mode

if(isset($MODE))
{
	switch ($MODE) {
		case 'mo1':
			//this is light or normal mode 
			//so nothing to add since it is default
		break;
		case 'mo2':
			echo "<link rel='stylesheet' type='text/css' href='" . style_app . "mo2-ui.css'>";
		break;
		default:
			//this is light or normal mode 
			//so nothing to add since it is default
		break;
	}
}


?>


