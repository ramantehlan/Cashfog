<?php 
/**********************************************
To get information out of database

simple notes 
			ledgers      asset       liability    expense/income
debit 		out 		 increase    increase 	  expense
credit 		in 			 decrease    decrease     income

cretor:- raman tehlan
date of creation:- 21/11/2016

SELECT sum(transaction_amount) FROM accounts as a, transactions as t WHERE a.OWNER_ID = "IN1702190215586091" and a.ACCOUNT_ID = t.ACCOUNT_ID and t.TRANSACTION_TYPE = "t1" and a.ACCOUNT_TYPE = "le1"
**********************************************/

class data_access
{	
	

	/**
	* This function is to return the account ids in 
	* sql format to help a sql query to work faster
 	*
	* @param $account_type 
	* @return string in sql format of account names
	*/

	function account_list($account_type ){
		global $connect ,  $db_name , $accounts_table , $USER_ID;

		//GETTING DATA OF ACCOUND ID LIST FOR OWNER ID AND ACCOUNT TYPE
		$list_command = mysqli_query($connect , "SELECT ACCOUNT_TITLE , ACCOUNT_ID FROM `$db_name`.`$accounts_table` WHERE `OWNER_ID` = '$USER_ID' AND `ACCOUNT_TYPE` = '$account_type'");
		$no_of_item = mysqli_num_rows($list_command);

		//MAKING LIST OF DATA
		$list = "";
		$data = array();
		$account_title = array();
		$account_id = array();

		$no = 0;

		if($no_of_item > 0){
			while($_LIST = mysqli_fetch_array($list_command)){
				$list .= " `ACCOUNT_ID` = " . $_LIST['ACCOUNT_ID'] . " or" ;

				$account_title[$no] = $_LIST['ACCOUNT_TITLE'];
				$account_id[$no] = $_LIST['ACCOUNT_ID'];

				$no++;
			}
			//this is to replace last or of the string
			$list = " ( " . substr($list, 0, -2) . " ) AND" ;
		}

		$data = array($list ,  $account_id , $account_title);

		return $data;
	}


	/**
	* This function is to help account action to perform faster
	* by returning list of account id
	* sql format 
	*
	* 	a1 = sales (debit) (t1)
	*	a2 = payment recieved (credit) (t2)
	*	a3 = payment paid (debit) (t1)
	*	a4 = purchase (credit)
	*	a5 = debit note = credit  
	*	a6 = credit note = debit
	*	a7 = other debit
	*	a8 = other crdit 
 	*
	* @param $account_type 
	* @return string in sql format of account names
	*/

	function action_account_list($action_type){
		global $connect ,  $db_name , $transactions_table , $USER_ID;

		/*if($action_type == "a3"){
			$action_type = "a4";
		}else if($action_type == "a2"){
			$action_type = "a1";
		}*/

		//GETTING DATA OF ACCOUND ID LIST FOR OWNER ID AND ACCOUNT TYPE
		$list_command = mysqli_query($connect , "SELECT DISTINCT(ACCOUNT_ID) FROM `$db_name`.`$transactions_table` WHERE `OWNER_ID` = '$USER_ID' AND `TRANSACTION_ACTION` = '$action_type'");
		$no_of_item = mysqli_num_rows($list_command);


		//this is to store the list of account as a sql format
		$list = "";

		if($no_of_item > 0){
			while($_LIST = mysqli_fetch_array($list_command)){
				$list .= " `ACCOUNT_ID` = " . $_LIST['ACCOUNT_ID'] . " or" ;
			}

			//this is to replace last or of the string
			$list = " ( " . substr($list, 0, -2) . " ) AND" ;
		}

		return $list;

	}

	/**
	* This function is to get debit credit opening balance and total balance 
	* for a book
 	*
	* @param $account_type 
	* @param $account_id
	* @param $year 				year of transaction for account
	* @param $month 			month of transaction for account 
	* @param $time_exception 	do we have to consider time in it
	* @return array             array of debit-> 0 credit-> 1 balance-> 2 opening_balance -> 3
	*/

	function book($account_type , $time_exception = false , $year = "" , $month = "" , $account_id = ""  ){
		//GETTING REQUIRED VARIABLES
		global $connect , $decode , $db_name , $accounts_table , $transactions_table , $USER_ID , $FINANCIAL_PERIOD;

		//GETTINGS FIRST MONTH AND LAST MONTH OF
		//USER FINANICAL PERIOD
		$PERIOD = $decode -> financial_period($FINANCIAL_PERIOD);
		$first_month = $PERIOD[0];
		$last_month = $PERIOD[1];

		//THIS IS TO SET THE FINANCIAL YEAR ACCORDING 
		//TO THE DATA COMMING FROM USER
			if($year != '' && $year != "0000"){
				//IF FIRST MONTH IS EQUAL TO JANUARY 
				//THEN FINANCIAL YEAR WILL HAVE SAME YEAR
					if($first_month == "01"){
						$first_year = $year;
						$last_year = $year;
					}else{
						$first_year = $year;
						$last_year = $year + 1;
					}
			}else{
				$time_exception = false;
			}

		//IF MONTH IS SET THEN CALCULATE DATA 
		//FOR THAT MONTH ONLY
			if($month != '' && $month != "00"){
				$start_month = $month;
				$end_month = $month;

				//if current month/sql month is greater then or equal to 
				//financial period then it is of same year 
				//other wise it is of next year
    				if($first_month <= $start_month){
    					$last_year = $first_year;
    				}else{
    					$first_year = $last_year;
    				}

			}else{
				$start_month = $first_month;
				$end_month = $last_month;
			}

		//IF TIME EXCEPTION IS TRUE THEN DATA IS TO BE EXTRACTED ACCORDING TO FINANCIAL PERIOD
			if($time_exception){
				if($account_type == "le1" || $account_type == "le4"){
					$timeline_sql = "AND ( `DATE_OF_TRANSACTION` >= '$first_year-$start_month-01' AND  `DATE_OF_TRANSACTION` <= '$last_year-$end_month-31' ) ";
				}else if($account_type == 'le2' || $account_type == "le3"){
					$timeline_sql = "AND `DATE_OF_TRANSACTION` <= '$last_year-$end_month-31' ";
				}else{
					$timeline_sql = "";
				}

				$opening_sql = "AND `DATE_OF_TRANSACTION` < '$first_year-$start_month-01'";
			}else{
				$timeline_sql = "";
				$opening_sql = "";
			}


		//IF ACCOUNT ID IS SET THEN 
		//DATA IS BE EXTRACTED FOR JUST ONE ACCOUND 
		//ELSE ALL THE ACCOUNT ID DATA IS TO BE EXTRACTED 
		if($account_id != ""){
			$account_id_sql = " `ACCOUNT_ID` = '$account_id' AND ";
		}else{
			$account_data =  $this -> account_list($account_type);
			$account_id_sql = $account_data[0];
		}

		$test_sql = "SELECT * from `$db_name`.`$accounts_table` where $account_id_sql `OWNER_ID` = '$USER_ID' and `ACCOUNT_TYPE` = '$account_type' ";
		$no_of_result = mysqli_num_rows(mysqli_query($connect , $test_sql ));

		if($no_of_result > 0){
			//FOR GETTING CURRENT DETAILS
			$root_sql = "SELECT SUM(TRANSACTION_AMOUNT) AS 'TOTAL' from `$db_name`.`$transactions_table` where $account_id_sql  `OWNER_ID` = '$USER_ID' AND TRANSACTION_TYPE = ";
			$debit_data = mysqli_fetch_array(mysqli_query($connect , $root_sql . "'t1' $timeline_sql"));
			$credit_data = mysqli_fetch_array(mysqli_query($connect , $root_sql . "'t2' $timeline_sql"));


			//this is to add payment received and payment paid in case we 
			//are looking at expense income chart
			if($account_type == "le4" ){
				//payment_received // income
				$action_data_1 = $this -> action("a2" , true , $year , $month , $account_id); 
				//payment_paid // expense // debit note a5
				$action_data_2 = $this -> action("a3" , true , $year , $month , $account_id); 
				$action_data_3 = $this -> action("a5" , true , $year , $month , $account_id); 
			}else{
				//this is just to keep it default
				$action_data_1 = array(0);
				$action_data_2 = array(0);
				$action_data_3 = array(0);
			}

			$debit = $debit_data['TOTAL'] + $action_data_2[0] + $action_data_3[0];
			$credit = $credit_data['TOTAL'] + $action_data_1[0];
			$balance = $debit - $credit;

			//FOR GETTING PREVIOUS BALANCE 
			//THIS IS FOR LEDGER ONLY
			//AND IF MONTH IS DEFINED THEN WE WON'T TRY TO FIND OPENING BALANCE
			if($account_type == "le1" && ($month == '' || $month == "00") ){
				if($time_exception){

					$opening_debit_data = mysqli_fetch_array(mysqli_query($connect , $root_sql . "'t1' $opening_sql"));
					$opening_credit_data = mysqli_fetch_array(mysqli_query($connect , $root_sql . "'t2' $opening_sql"));

					$opening_debit = $opening_debit_data['TOTAL'];
					$opening_credit = $opening_credit_data['TOTAL'];
					$opening_balance = $opening_debit - $opening_credit;

					$balance = $opening_balance + $balance;

				}else{
					$opening_balance = 0;
				}
			}else{
				$opening_balance = 0;
			}

		}else{
			$debit = 0;
			$credit = 0;
			$balance = 0;
			$opening_balance = 0;
		}

		return array($debit , $credit , $balance , $opening_balance);
	}//end of for


	/**
	* This function is to get cash-flow month wise and then adding them 
	* It will return data in two forms one is raw form which will have data 
	* directly from the db other one is chart form it was data in form of chart.js 
	* 
	* @param account_type what type of account it is of, usually it is a ledger type
	* @param $year 
	* @param account_id specific id to check for note that account type is mandatory to provide in this case
	*/
	
	function book_monthly($account_type , $year , $account_id = "" ){
		global $FINANCIAL_PERIOD , $decode;

		$period = $decode -> financial_period($FINANCIAL_PERIOD);

		if($year == ""){
			//this is to get starting month and ending month of a financial period of user
			$starting_month = $period[0];
			
			if($starting_month != "01"){
				$year = $period[2];
			}else{
				$year = $period[2] + 1;
			}
			
		}

		$row_data = array();
		$chart_data = array();
		
		$debit_data = "";
		$credit_data = "";
		
		$months = $period[3];
		//getting data of each month 
		for($i = 0; count($months) > $i; $i++){

			$month_data = $this -> book($account_type, true , $year , $months[$i] , $account_id );

			$row_data[$i][0] =  $month_data[0] ;
			$row_data[$i][1] =  $month_data[1] ;


		}

		//making data of each month according to charts
		for($j = 0; 12 > $j; $j++){
				//this is to replace 0 with empty space
				$row_data[$j][0] = ($row_data[$j][0] == 0)? "" : $row_data[$j][0];
				$row_data[$j][1] = ($row_data[$j][1] == 0)? "" : $row_data[$j][1];

				$debit_data .= $row_data[$j][0] . " ,";
				$credit_data .= $row_data[$j][1] . " ,";
		}

		$chart_data[0] = rtrim($debit_data , ",");
		$chart_data[1] = rtrim($credit_data , ",");


		return $chart_data;
		
	}


	/**
	* This function is to get data according to the financial year or perticular month
	* and also finding out which accound contibuted how much in percentage
	* all the data is to be returned in chart.js format
	* 
	* @param action_type this tell about which action should we take ex t1 , t1 (expense / gain)
	* @param account_type what type of account it is of, usually it is a ledger type
	* @param year 
	* @param month
	*/

	/**
		{this is the array that will be returned}
				"x% account name" in chart js format
				x/ transaction value in chartjs format 
				total transaction just single value
	*/

	function book_source( $account_type , $action_type , $year = "", $month = ""){
		global $connect , $db_name , $accounts_table , $transactions_table , $FINANCIAL_PERIOD , $USER_ID , $decode , $lang;

		$type_data = $this -> book($account_type , true , $year , $month);

		//this is to get data according to action type
		//if action type is t2 then get income data
		//else action type is t1 then get expense data
		$title_str = "";
		$transaction_str = "";
		if($action_type == "t2"){
			$payment_received = $this -> action("a2" , true , $year , $month);
			$total_transaction = $type_data[1];
			
			if($payment_received[0] != 0){
				$title_str .= "'" .  round(( ($payment_received[0]/$total_transaction) * 100 ) , 2) . "% " . $lang['payment_received'] . "' , ";
				$transaction_str .=  $payment_received[0] . " , ";
			}
		}else{
			$payment_paid = $this -> action("a3" , true , $year , $month);
			$debit_note = $this -> action("a5" , true , $year , $month);
			$total_transaction = $type_data[0];

			if( $payment_paid[0] != 0){
				$title_str .= "'" .  round(( ($payment_paid[0]/$total_transaction) * 100 ) , 2) . "% " . $lang['payment_paid'] . "' , ";
				$transaction_str .=  $payment_paid[0] . " , ";
			}

			if($debit_note[0] != 0){
				$title_str .= "'" .  round(( ($debit_note[0]/$total_transaction) * 100 ) , 2) . "% " . $lang['debit_note_received'] . "' , ";
				$transaction_str .=  $debit_note[0] . " , ";
			}


		}

		//this is to store output
		$data = array();

		//if transaction is not zero then proced 
		//else just return the data to be false
		if($total_transaction != 0){
				//this is to get list of account ids and account title 
				//for perticular account type
				$list_data = $this -> account_list($account_type);

				//this is list of accound id
				$id_list = $list_data[1];
				//this is list of account title
				$title_list = $list_data[2];

				//we will get data for each item in account list
				for($i = 0; count($id_list) > $i; $i++){

					//this is to get account data for every accound id
					$account_data = $this -> book($account_type , true , $year , $month , $id_list[$i]);


					//this is to get data according to action type
					//if action type is t2 then get income data
					//else action type is t1 then get expense data
					if($action_type == "t2"){
						$list_transaction = $account_data[1];
					}else{
						$list_transaction = $account_data[0];
					}

					//if list_transaction is zero then it won't be shown in pie chart
					if($list_transaction != 0){
							$title_str .= "'" .  round(( ($list_transaction/$total_transaction) * 100 ) , 2) . "% " . $title_list[$i] . "' ,";
							$transaction_str .= $list_transaction . " ,";
					}

				}


				$title_str = rtrim($title_str , ",");
				$transaction_str = rtrim($transaction_str , ",");
				$data = array($total_transaction , $title_str , $transaction_str);

		}else{
			$data = array( 0 , "" , 0);
		}

		return $data;

	}	


	/***************************************************************************************************************

	****************************************************************************************************************/


	/**
	* THIS IS TO GET ACTION SPECIFIC RESULTS 
	* SALES (a1) - PAYMENT RECIEVED (a2) 
	* PURCHASE - PAYMENT PAID

			a1 = sales (debit) (t1)
			a2 = payment recieved (credit) (t2)
			a3 = payment paid (debit) (t1)
			a4 = purchase (credit)
	*/

	function action($action_type , $time_exception = false , $year = "" , $month = "" , $account_id = ""){

		//GETTING REQUIRED VARIABLES
		global $connect , $decode , $db_name , $accounts_table , $transactions_table , $USER_ID , $FINANCIAL_PERIOD;

		//GETTINGS FIRST MONTH AND LAST MONTH OF
		//USER FINANICAL PERIOD
		$PERIOD = $decode -> financial_period($FINANCIAL_PERIOD);
		$first_month = $PERIOD[0];
		$last_month = $PERIOD[1];

		//THIS IS TO SET THE FINANCIAL YEAR ACCORDING 
		//TO THE DATA COMMING FROM USER
			if($year != '' && $year != "0000"){
				//IF FIRST MONTH IS EQUAL TO JANUARY 
				//THEN FINANCIAL YEAR WILL HAVE SAME YEAR
					if($first_month == "01"){
						$first_year = $year;
						$last_year = $year;
					}else{
						$first_year = $year;
						$last_year = $year + 1;
					}
			}else{
				$time_exception = false;
			}

		//IF MONTH IS SET THEN CALCULATE DATA 
		//FOR THAT MONTH ONLY
			if($month != '' && $month != "00"){
				$start_month = $month;
				$end_month = $month;

				//if current month/sql month is greater then or equal to 
				//financial period then it is of same year 
				//other wise it is of next year
    				if($first_month <= $start_month){
    					$last_year = $first_year;
    				}else{
    					$first_year = $last_year;
    				}

			}else{
				$start_month = $first_month;
				$end_month = $last_month;
			}

			//IF TIME EXCEPTION IS TRUE THEN DATA IS TO BE EXTRACTED ACCORDING TO FINANCIAL PERIOD
			if($time_exception){
				$timeline_sql = "AND ( `DATE_OF_TRANSACTION` >= '$first_year-$start_month-01' AND  `DATE_OF_TRANSACTION` <= '$last_year-$end_month-31' ) ";

				$opening_sql = "AND `DATE_OF_TRANSACTION` < '$first_year-$start_month-01'";
			}else{
				$timeline_sql = "";
				$opening_sql = "";
			}


				//IF ACCOUNT ID IS SET THEN 
		//DATA IS BE EXTRACTED FOR JUST ONE ACCOUND 
		//ELSE ALL THE ACCOUNT ID DATA IS TO BE EXTRACTED 
		if($account_id != ""){
			$account_id_sql = " `ACCOUNT_ID` = '$account_id' AND ";
		}else{
			$account_id_sql = $this -> action_account_list($action_type);
		}

		$test_sql = "SELECT * from `$db_name`.`$accounts_table` where $account_id_sql `OWNER_ID` = '$USER_ID' ";
		$no_of_result = mysqli_num_rows(mysqli_query($connect , $test_sql ));



		if($no_of_result > 0){
			//FOR GETTING CURRENT DETAILS
			$root_sql = "SELECT SUM(TRANSACTION_AMOUNT) AS 'TOTAL' from `$db_name`.`$transactions_table` where $account_id_sql  `OWNER_ID` = '$USER_ID' AND TRANSACTION_ACTION = ";
			$action_data = mysqli_fetch_array(mysqli_query($connect , $root_sql . "'$action_type'   $timeline_sql"));


			$action_sum = $action_data['TOTAL'];

			//FOR GETTING PREVIOUS BALANCE
			//THIS IS FOR LEDGER ONLY
			//AND IF MONTH IS DEFINED THEN WE WON'T TRY TO FIND OPENING BALANCE
			if(($month == '' || $month == "00") ){
				if($time_exception){

					$previous_action_data = mysqli_fetch_array(mysqli_query($connect , $root_sql . "'$action_type' $opening_sql"));

					$previous_action_sum = $previous_action_data['TOTAL'];

				}else{
					$previous_action_sum = 0;
				}
			}else{
				$previous_action_sum = 0;
			}

		}else{
			$action_sum = 0;
			$previous_action_sum = 0;
		}

		return array($action_sum , $previous_action_sum);
	}

/**
	* This function is to get cash-flow month wise and then adding them 
	* It will return data in two forms one is raw form which will have data 
	* directly from the db other one is chart form it was data in form of chart.js 
	* 
	* @param account_type what type of account it is of, usually it is a ledger type
	* @param $year 
	* @param account_id specific id to check for note that account type is mandatory to provide in this case
	*/
	
	function action_monthly($action_type , $year , $account_id = "" ){
		global $FINANCIAL_PERIOD , $decode;

		$period = $decode -> financial_period($FINANCIAL_PERIOD);

		if($year == ""){
			//this is to get starting month and ending month of a financial period of user
			$starting_month = $period[0];
			
			if($starting_month != "01"){
				$year = $period[2];
			}else{
				$year = $period[2] + 1;
			}
			
		}

		$row_data = array();
		$chart_data = array();
		
		$action_data = "";
		
		$months = $period[3];
		//getting data of each month 
		for($i = 0; count($months) > $i; $i++){

			$month_data = $this -> action($action_type, true , $year , $months[$i] , $account_id );

			//this is to remove debit note and credit note from the sales 
			//in case of purchase and sales

			if($action_type == "a1"){
				$other_data = $this -> action("a5", true , $year , $months[$i] , $account_id );
			}else if($action_type == "a4"){
				$other_data = $this -> action("a6", true , $year , $months[$i] , $account_id );
			}else {
				$other_data = array(0);
			}

			$row_data[$i][0] =  $month_data[0] - $other_data[0];


		}

		//making data of each month according to charts
		for($j = 0; 12 > $j; $j++){
				//this is to replace 0 with empty space
				$row_data[$j][0] = ($row_data[$j][0] == 0)? 0 : $row_data[$j][0];

				$action_data .= $row_data[$j][0] . " ,";
		}

		$chart_data[0] = rtrim($action_data , ",");


		return $chart_data;
		
	}


	/* 
	* this is to bundle the action for a particular chart
			a1 = sales (debit) (t1)
			a2 = payment recieved (credit) (t2)
			a3 = payment paid (debit) (t1)
			a4 = purchase (credit)
	a5 = debit note = credit  
	a6 = credit note = debit
			a7 = other debit
			a8 = other crdit 
	*
	*/

	function action_group($action_group , $year , $account_id = ""){


		//GETTING REQUIRED VARIABLES
		global $connect , $decode , $db_name , $accounts_table , $transactions_table , $USER_ID , $FINANCIAL_PERIOD;


		if($action_group == "sale"){
			$action_1 = "a1";
			$action_2 = "a2";
			$action_3 = "a5";
		}else if($action_group == "purchase"){
			$action_1 = "a4";
			$action_2 = "a3";
			$action_3 = "a6";
		}	

		$action_group_1 = $this -> action($action_1 , true , $year , "" , $account_id);   
        $action_group_2 = $this -> action($action_2 , true , $year , "" , $account_id);   
        $action_group_3 = $this -> action($action_3 , true , $year , "" , $account_id);   

        //sale , payment received , previous receivable , total receivable
        return array($action_group_1[0] - $action_group_3[0] , $action_group_2[0] , $action_group_1[1] - $action_group_2[1] - $action_group_3[1]  , ($action_group_1[1] - $action_group_2[1] - $action_group_3[1]) + ($action_group_1[0] - $action_group_2[0] - $action_group_3[0]));

	}

	/*
	*	This is to get receivable and payable
	*
	**/

	function action_balance($action_group , $account_id = ""){
		global $db_name , $transactions_table , $USER_ID , $connect;

		//this is to fix it in sql for perticular id
		if($account_id != ""){
			$account_id = "`ACCOUNT_ID` = '$account_id' AND";
		}

		//this is for the group
		if($action_group == "sale"){
			$action_1 = "a1";
			$action_2 = "a2";
			$action_3 = "a5";
		}else if($action_group == "purchase"){
			$action_1 = "a4";
			$action_2 = "a3";
			$action_3 = "a6";
		}


		$root_sql = "SELECT SUM(TRANSACTION_AMOUNT) AS 'TOTAL' from `$db_name`.`$transactions_table` where $account_id  `OWNER_ID` = '$USER_ID' AND TRANSACTION_ACTION = ";
		
		$action_data1 = mysqli_fetch_array(mysqli_query($connect , $root_sql . "'$action_1'"));
		$action_data2 = mysqli_fetch_array(mysqli_query($connect , $root_sql . "'$action_2'"));
		$action_data3 = mysqli_fetch_array(mysqli_query($connect , $root_sql . "'$action_3'"));

		return ($action_data1['TOTAL'] - $action_data2['TOTAL'] - $action_data3['TOTAL']);
	}	


}

?>