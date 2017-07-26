<?php
/******************************************************************
To connect to mysql

creator:-			Raman Tehlan
Date of creation:-	13/11/2016
******************************************************************/

$db_host       		='127.0.0.1';
$db_user       		='root';
$db_password   		='';
$db_name       		='app';

/********************************
table names are defined here
**********************************/
$accounts_table				= "accounts";
$transactions_table 		= "transactions";
$contact_requests_table 	= "contact_requests";
$job_applications_table		= "job_applications";
$feedbacks_table			= "feedbacks";

$connect       = mysqli_connect($db_host,$db_user,$db_password);


//mysqli_connect($db_host,$db_user,$db_password);

?>