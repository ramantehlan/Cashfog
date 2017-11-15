<?php
/******************************************************************
To connect to mysql

creator:-			Raman Tehlan
Date of creation:-	13/11/2016
******************************************************************/

$db_host       		='ec2-23-21-101-174.compute-1.amazonaws.com';
$db_user       		='zmbynibjuxwxdb';
$db_password   		='064ee7d4bde65023435c34cfda7039e93e621c348a850b766d7ac2bc4406e8aa';
$db_name       		='zmbynibjuxwxdb';

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