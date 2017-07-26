<?php 
/***********************************************
Bundle up the important includes and library 
to help sign in page

creator:- raman tehlan
date of creation:- 21/11/2016
***********************************************/

//define.inc is to get pre define variables
include "../includes/define.inc.php";

//connect.inc is to connect to database
include "../includes/connect.inc.php";

//decoder.lib is to decode recoded data of user
include "../includes/decoder.lib.php";
$decode = new decoder();

//data_filters.lib is to transform data 
include "../includes/data_filters.lib.php";
$filter = new data_filters();

//session_check.inc is to check if signin session exists
//INCLUDE DEFINE_USER_INFO.INC TO DEFINE USER INFO
//include only if login info is correct
include "../includes/session_check.inc.php";

//to load lang array according to user
include "../includes/set_language.inc.php";


//this will income below files only if session exist 
if(isset($_SESSION[app_name . 'session_name'])){
            if($_SESSION[app_name . 'session_name'] == $session_name_signin){


//get_db_info.lib is to get information from database
include "../includes/data_access.lib.php";
$access = new data_access();

//update_db_info.lib is to update information in database
include "../includes/data_update.lib.php";

//to check subscription and other factors
include "../includes/subscription_check.inc.php";

}
}



?>