<?php
/*******************************************
this set the language of page according to 
details given in database 

creator:- raman tehlan
date of creation:- 12/12/2016
*******************************************/

$language_folder = language_folder;

//this is to set language in case language is not set 
//or session don't exist
if(isset($_SESSION[app_name . 'session_name'])){
     if( !($_SESSION[app_name . 'session_name'] == $session_name_signin) ){
     	$LANGUAGE = "EN";
     }
}else{
	$LANGUAGE = "EN";
}

switch ($LANGUAGE) {

	case 'HI': 
		include $language_folder . "hi.lang.php";
		break;
	case 'EN':
		include $language_folder . "en.lang.php";
	break;
	default:
		include $language_folder . "en.lang.php";
	break;
}

?>