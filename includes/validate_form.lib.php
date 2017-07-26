<?php 
/******************************************
This program is to check validity of input in database

following input can be chacked 
	1) email

creator:- 	Raman Tehlan
Date of creation:- 17/11/2016
******************************************/


class validate_form
{

	//To check if email exists in database

	function validate_email($email)
	{
		global $db_name , $connect;


      $code = mysqli_query($connect , "SELECT * FROM `$db_name`.`users` WHERE email = '$email' ");

      if(isset($_SESSION[app_name . "email"])){
        
        if($email == $_SESSION[app_name . "email"]){
              $no = 0;
            }
       else{
            $no = mysqli_num_rows($code);
        }
      }
      else
      {
        $no = mysqli_num_rows($code);
      }
      

	
		if($no >= 1)
		{ return false; }
		else
		{ return true; }
	}

	//To check if date of birth is greater than 13 years

	function validate_dob($dob)
	{
 		   $dob_d       = $dob;
           $date_t      = date('20y-m-d');
           $startdate   = "$dob_d";
           $enddate     = "$date_t";

                           $timestamp_start  = strtotime($startdate);
                           $timestamp_end    = strtotime($enddate);
                           $difference       = abs($timestamp_end - $timestamp_start); // that's it!
                           $years            = floor($difference/(60*60*24*365));

                            // Years, months and days version
                               $years = floor($difference / (365*60*60*24));
            
            				if($years >= 13)
            				{
            					return true;
            				}
            				else
            				{
            					return false;
            				}
	}


}

?>