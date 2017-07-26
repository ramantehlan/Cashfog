<?php 
/*******************************************
This script is to check if the user is under
trial or under subscription. Then do respective 
actions 

allow_service 		to tell if service is on or off
period_name			to tell if service is trial or subscribed

creator:-			Raman Tehlan
Date of creation:-	31/3/2017
*******************************************/


//if service starting date is empty 
//user might be in trial period or
//user subscription period has expirod
if(!is_null($SERVICE_STARTING_DATE)){
		define("allow_service" , true);
		define("period_name" , "subscribed");
}
//if this is true then user subscript has expired
else if(!is_null($SERVICE_DATE_HISTORY)){
		define("allow_service" , false);
		define("period_name" , "subscribed-done");
}
//else if both above are wrong 
//then user is in trial period 
//or his trial period is over too
else{

	//difference of current date and join date
	$diff = $filter -> date_difference($JOIN_DATE , $current_date);

	//this is to check if user trial is active or not
	//if diff is greater than trial then it is unactive
	//else it is active 
	if($diff > $trial_days){
		define("allow_service" , false);
		define("period_name" , "trial-done");
	}
	else{
		define("allow_service" , true);
		define("period_name" , "trial");
	}

	
}
?>