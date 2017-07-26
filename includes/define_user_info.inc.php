<?php
/******************************************************
to define user info

creator:- raman tehlan
date of creation:- 21/11/2016
*******************************************************/

    //session_check_code is defined in session_check.inc 
    $get = mysqli_fetch_array($session_check_code);

    $USER_ID                = $get['ID'];
    $FIRST_NAME             = $get['FIRST_NAME'];
    $LAST_NAME              = $get['LAST_NAME'];
    //this will income below files only if session exist 
if(isset($_SESSION[app_name . 'session_name'])){
            if($_SESSION[app_name . 'session_name'] == $session_name_signin){
    $EMAIL                  = $_SESSION[app_name . 'email'];
    $PASSWORD               = $_SESSION[app_name . 'password'];
}
}
    $GENDER                 = $get['GENDER'];
    $DOB                    = $get['DATE OF BIRTH'];
    $COUNTRY                = $get['COUNTRY'];
    $LANGUAGE               = $get['LANGUAGE'];
    $TIME_ZONE              = $get['TIME_ZONE'];
    $COMPANY_NAME           = $get['COMPANY_NAME'];
    $WEBSITE                = $get['WEBSITE'];
    $INDUSTRY               = $get['INDUSTRY'];
    $FINANCIAL_PERIOD       = $get['FINANCIAL_PERIOD'];
    $CURRENCY               = $get['CURRENCY'];
    $TAX_ID                 = $get['TAX_ID'];
    $ADDRESS                = $get['ADDRESS'];
    $STREET                 = $get['STREET'];
    $CITY                   = $get['CITY'];
    $STATE                  = $get['STATE'];
    $ZIP                    = $get['ZIP'];
    $JOIN_DATE              = $get['JOIN_DATE'];
    $SERVICE_STARTING_DATE  = $get['SERVICE_STARTING_DATE'];
    $AMOUNT_PAID            = $get['AMOUNT_PAID'];
    $SERVICE_DATE_HISTORY   = $get['SERVICE_DATE_HISTORY'];
    $AMOUNT_PAID_HISTORY    = $get['AMOUNT_PAID_HISTORY'];
    $LOGO                   = $get['LOGO'];
    $CONTACT_PHONE          = $get['CONTACT_PHONE'];
    $CONTACT_EMAIL          = $get['CONTACT_EMAIL'];
    $HOME_PAGE              = $get['HOME_PAGE'];
    $MODE                   = $get['MODE'];
    $BUYER_CODE             = $get['BUYER_TERM'];
    $SELLER_CODE            = $get['SELLER_TERM'];
    $BUYER_TERM             = $decode -> contact_term($BUYER_CODE);
    $SELLER_TERM            = $decode -> contact_term($SELLER_CODE);
    $VERIFICATION_CODE      = $get['VERIFICATION_CODE'];


    //just in case browser is restored in that case
    if(!isset($_SESSION[app_name . "user_id"])){
           $_SESSION[app_name . "user_id"] =  $get['ID'];
    }




    
   
?>