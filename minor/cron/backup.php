<?php
/*********************************
This file is to backup sql database 
in .sql format 

creator:- Raman Tehlan
Date of creation:- 19/05/2016
**********************************/


include '../../includes/define.inc.php';
include '../../includes/connect.inc.php';

$backupFile = '/tmp/backup';


$query      = "SELECT * INTO OUTFILE '$backupFile/users.sql' FROM `$db_name`.`users`";
$result 	= mysqli_query($connect , $query);




?>