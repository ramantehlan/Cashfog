<?php
/******************************************************************
Configuration file for application 

creator:-			Raman Tehlan
Date of creation:-	30/10/2016
******************************************************************/


/*********************************************************
THIS IS GENERAL INFORMATINO AREA 
**********************************************************/ 

#TO SWITCH ON/OFF DIFFERENT FUNCTIONS
define("online", false);

#TO SET CURRENT DATE
$current_date = date('20y-m-d h:i:s');

#TO SET TRIAL DAYS 
$trial_days = 365;

#define the host of site and protocol
$host        = $_SERVER['HTTP_HOST'];
$protocol    = "http://";

#this is to define the site name 
define("site_url", $protocol . $host);
define("url", $protocol . $host . "/");
define("current_url" ,  $protocol . $host . $_SERVER['REQUEST_URI']);

#company name
#name should not have any special character 
define('app_name',"Cashfog");
define('company_name',"MS Printing & Packaging co");

/********************************************
PERMISSIONS FOR APP
*********************************************/
define("allow_logo_delete" , true);
define("allow_full_account_creation" , false);
define("allow_imort_date" , false);
define("allow_subscription" , false);

/*************************************************************
COOKIE DETAILS
NOTE:- COOKIE NAMES USED THROUGH OUT THE SITE ARE DEFINED HERE
**************************************************************/

$cookie_contactus 	= app_name . "app_contactus_done";
$cookie_feedback 	= app_name . "app_feedback_done";
$cookie_jobs 		= app_name . "app_jobs_done";
$cookie_signin 		= app_name . "remember_me";

$cookie_time_contactus 	= time() + (60 * 60 * 24 * 7);
$cookie_time_feedback 	= time() + (60 * 60 * 24 * 7);
$cookie_time_jobs 		= time() + (60 * 60 * 24 * 7);
$cookie_time_signin 	= time() + (60 * 60 * 24 * 7);

/***********************************************************
SESSION DETAILS
NOTE: NAMES OF PERAMTERS USED IN SESSION WITH THERE USE
*************************************************************/

//COMMAN PERAMETERS
$session_name_signin = "signin";
$session_name_signup = "signup";


/***************************************************************
Pricing details
note:- PRICING OF SERVICE IS DEFINED HERE
****************************************************************/

define("annual_package_price",2000);

/*****************************************************************
Directory details 
note:- real location are only defined in .htaccess file
******************************************************************/

define("style", url . "style/");
define("style_index", url . "style/in/");
define("style_site", url . "style/si/");
define("style_register" , url . "style/re/");
define("style_errors" , url . "style/er/");
define("style_app" , url . "style/app/");

define("script", url . "script/");
define("script_index", url . "script/in/");
define("script_site", url . "script/si/");
define("script_register", url . "script/re/");
define("script_app", url . "script/app/");

define("image", url . "image/");
define("image_other", url . "image/ot/");
define("image_background", url . "image/bg/");
define("image_icon", url . "image/ic/");
define("image_company_logo" , url . "image/lo/");

define("action" , url . "action/");
define("action_site" , url . "action/si/");
define("action_app" , url . "action/app/");

/****************************************************************
images details 
note:- comman images icon are here
note:- 
******************************************************************/

define("img_fevicon" , image_other . "favicon.ico");
define("img_loading", image_icon . "waiting_spin.gif");
define("img_full_logo" , image_other . "cashfog_logo.png");
define("img_full_logo_dark" , image_other . "cashfog_logo_dark.png");
define("img_512_logo", image_other . "cashfog_logo_512_512.png"); 
define("img_32_logo", image_other . "cashfog_logo_32_32.png"); 
define("img_24_logo", image_other . "cashfog_logo_24_24.png"); 
define("img_16_logo", image_other . "cashfog_logo_16_16.png"); 
define("img_loading_gear", image_icon . "gears.gif");
define("logo_uploading_folder" , "webapp/images/logo/");
define("documents_uploading_folder", "webapp/documents/");
define('language_folder', 'lang/');




/*****************************************************************
Site other links
note:- real location are only defined in .htaccess file
******************************************************************/

define("site", url . "site/");
define("signup" , url . "signup/");
define("signin" , url . "signin/");
define("security" , url . "security/");
define("app" , url . "app/");
define("profile" , url . "profile/");


/***************************************************************
social media links
****************************************************************/

define("facebook_page_link" , "https://www.facebook.com/Cashfog-1207150749372201/");
define("twitter_page_link" , "https://twitter.com/cashfoginc");
define("youtube_page_link" , "https://www.youtube.com/channel/UCpWNOGgcISvyBNsEW-GBAsg");




?>