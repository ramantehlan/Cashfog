<?php
/******************************************************************
decode the database entry or other entry to readable form
or to other formats 

creator:-			Raman Tehlan
Date of creation:-	26/11/2016
******************************************************************/


class decoder
{	

	/***************************************8
	this is to decode month according to the 
	month code 
	***************************************/

		function month($code){
			global $lang;

			switch ($code) {
				case '01':
						return $lang['january'];
					break;
				case '02':
						return $lang['february'];
					break;
				case '03':
						return $lang['march'];
					break;
				case '04':
						return $lang['april'];
					break;
				case '05':
						return $lang['may'];
					break;
				case '06':
						return $lang['june'];
					break;
				case '07':
						return $lang['july'];
					break;
				case '08':
						return $lang['august'];
					break;
				case '09':
						return $lang['september'];
					break;
				case '10':
						return $lang['october'];
					break;
				case '11':
						return $lang['november'];
					break;
				case '12':
						return $lang['december'];
					break;
				default:
					return "unknown";
				break;
			}
		}

	/**************************************
	To decode the financial peroid 
	basically getting the first month and last 
	month of a financial peroid
	***************************************/

		function financial_period($code , $year = "" ){
				global $lang;
				switch ($code) {
					case 'fp1':
							$first_month = '01';
							$last_month = '12';
							$month_array = array('01' , '02' , '03' , '04' , '05' , '06' , '07' , '08' , '09' , '10' , '11' , '12');
						break;
					case 'fp2':
							$first_month = '02';
							$last_month = '01';
							$month_array = array('02' , '03' , '04' , '05' , '06' , '07' , '08' , '09' , '10' , '11' , '12' , '01');
						break;
					case 'fp3':
							$first_month = '03';
							$last_month = '02';
							$month_array = array('03' , '04' , '05' , '06' , '07' , '08' , '09' , '10' , '11' , '12' , '01' , '02');
						break;
					case 'fp4':
							$first_month = '04';
							$last_month = '03';
							$month_array = array('04' , '05' , '06' , '07' , '08' , '09' , '10' , '11' , '12' , '01' , '02' , '03');
						break;
					case 'fp5':
							$first_month = '05';
							$last_month = '04';
							$month_array = array('05' , '06' , '07' , '08' , '09' , '10' , '11' , '12' , '01' , '02' , '03' , '04');
						break;
					case 'fp6':
							$first_month = '06';
							$last_month = '05';
							$month_array = array('06' , '07' , '08' , '09' , '10' , '11' , '12' , '01' , '02' , '03' , '04' , '05');
						break;
					case 'fp7':
							$first_month = '07';
							$last_month = '06';
							$month_array = array('07' , '08' , '09' , '10' , '11' , '12' , '01' , '02' , '03' , '04' , '05' , '06');
						break;
					case 'fp8':
							$first_month = '08';
							$last_month = '07';
							$month_array = array('08' , '09' , '10' , '11' , '12' , '01' , '02' , '03' , '04' , '05' , '06' , '07');
						break;
					case 'fp9':
							$first_month = '09';
							$last_month = '08';
							$month_array = array('09' , '10' , '11' , '12' , '01' , '02' , '03' , '04' , '05' , '06' , '07' , '08');
						break;
					case 'fp10':
							$first_month = '10';
							$last_month = '09';
							$month_array = array('10' , '11' , '12' , '01' , '02' , '03' , '04' , '05' , '06' , '07' , '08' , '09');
						break;
					case 'fp11':
							$first_month = '11';
							$last_month = '10';
							$month_array = array('11' , '12' , '01' , '02' , '03' , '04' , '05' , '06' , '07' , '08' , '09' , '10');
						break;
					case 'fp12':
							$first_month = '12';
							$last_month = '11';
							$month_array = array('12' , '01' , '02' , '03' , '04' , '05' , '06' , '07' , '08' , '09' , '10' , '11');
						break;
					default:
						
						break;
				}

				//this is to decide current financial period
				if($year == "" || $year == 0){
					if(date('m') >= $first_month){
    			  		$current_financial_year = date('Y');
    				}else{
    			  		$current_financial_year = date('Y') - 1;
    				}
    			}else{
    				$current_financial_year = $year;
    			}


				$alpha_month =  array( $lang['january'] , $lang['february'], $lang['march'] , $lang['april'] , $lang['may'] , $lang['june'] , $lang['july'] , $lang['august'] , $lang['september'] , $lang['october'] , $lang['november'] ,  $lang['december'] );
				$alpha_month_2 =  array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
				$months = "";
				$months_2 = "";

				for($i = 0; 12 > $i ; $i++){
						$index = (int) ($month_array[$i] - 1);

						if($month_array[$i] >= $first_month){
    			  			$current_y = substr($current_financial_year, -2);
    					}else{
    			  			$current_y = substr($current_financial_year + 1 , -2);
    					}

						$months .= "'" . $this -> month($index + 1) . "-20$current_y' ,";	
						$months_2 .= "'" . $alpha_month_2[$index] . "-$current_y' ,";
				}


				$months = rtrim($months , ",");
		  							

			return array($first_month , $last_month , $current_financial_year , $month_array , $months , $months_2);
		}

	/*************************************
	to decode the buyer and seller term according
	to the users choice 
	***************************************/

		function contact_term($code){
				switch ($code) {
					case 'st1':
							return "seller";
					break;
					case 'st2':
							return "vender";
					break;
					case "st3":
							return "supplier";
					break;
					case 'bt1':
							return "buyer";
					break;
					case 'bt2':
							return "customer";
					break;
					case 'bt3':
							return "client";
					break;
					case 'bt4':
							return "tenant";
					break;
					case 'bt5':
							return "donor";
					break;
					case 'bt6':
							return "guest";
					break;
					case 'bt7':
							return "member";
					break;
					case "bt8":
							return "patient";
					break;
					default:
							return "unknown";
					break;
				}
		}

	/*****************************************
	this is to format the money according to the 
	countary and currency provided by the user
	default is set for india
	******************************************/

		function money($value , $country = "IN", $currency = "INR"){
/*
			function money_format($floatcurr, $curr = 'EUR')
				{
			 			

			 $currencies['ARS'] = array(2, ',', '.');          //  Argentine Peso
    $currencies['AMD'] = array(2, '.', ',');          //  Armenian Dram
    $currencies['AWG'] = array(2, '.', ',');          //  Aruban Guilder
    $currencies['AUD'] = array(2, '.', ' ');          //  Australian Dollar
    $currencies['BSD'] = array(2, '.', ',');          //  Bahamian Dollar
    $currencies['BHD'] = array(3, '.', ',');          //  Bahraini Dinar
    $currencies['BDT'] = array(2, '.', ',');          //  Bangladesh, Taka
    $currencies['BZD'] = array(2, '.', ',');          //  Belize Dollar
    $currencies['BMD'] = array(2, '.', ',');          //  Bermudian Dollar
    $currencies['BOB'] = array(2, '.', ',');          //  Bolivia, Boliviano
    $currencies['BAM'] = array(2, '.', ',');          //  Bosnia and Herzegovina, Convertible Marks
    $currencies['BWP'] = array(2, '.', ',');          //  Botswana, Pula
    $currencies['BRL'] = array(2, ',', '.');          //  Brazilian Real
    $currencies['BND'] = array(2, '.', ',');          //  Brunei Dollar
    $currencies['CAD'] = array(2, '.', ',');          //  Canadian Dollar
    $currencies['KYD'] = array(2, '.', ',');          //  Cayman Islands Dollar
    $currencies['CLP'] = array(0,  '', '.');          //  Chilean Peso
    $currencies['CNY'] = array(2, '.', ',');          //  China Yuan Renminbi
    $currencies['COP'] = array(2, ',', '.');          //  Colombian Peso
    $currencies['CRC'] = array(2, ',', '.');          //  Costa Rican Colon
    $currencies['HRK'] = array(2, ',', '.');          //  Croatian Kuna
    $currencies['CUC'] = array(2, '.', ',');          //  Cuban Convertible Peso
    $currencies['CUP'] = array(2, '.', ',');          //  Cuban Peso
    $currencies['CYP'] = array(2, '.', ',');          //  Cyprus Pound
    $currencies['CZK'] = array(2, '.', ',');          //  Czech Koruna
    $currencies['DKK'] = array(2, ',', '.');          //  Danish Krone
    $currencies['DOP'] = array(2, '.', ',');          //  Dominican Peso
    $currencies['XCD'] = array(2, '.', ',');          //  East Caribbean Dollar
    $currencies['EGP'] = array(2, '.', ',');          //  Egyptian Pound
    $currencies['SVC'] = array(2, '.', ',');          //  El Salvador Colon
    $currencies['ATS'] = array(2, ',', '.');          //  Euro
    $currencies['BEF'] = array(2, ',', '.');          //  Euro
    $currencies['DEM'] = array(2, ',', '.');          //  Euro
    $currencies['EEK'] = array(2, ',', '.');          //  Euro
    $currencies['ESP'] = array(2, ',', '.');          //  Euro
    $currencies['EUR'] = array(2, ',', '.');          //  Euro
    $currencies['FIM'] = array(2, ',', '.');          //  Euro
    $currencies['FRF'] = array(2, ',', '.');          //  Euro
    $currencies['GRD'] = array(2, ',', '.');          //  Euro
    $currencies['IEP'] = array(2, ',', '.');          //  Euro
    $currencies['ITL'] = array(2, ',', '.');          //  Euro
    $currencies['LUF'] = array(2, ',', '.');          //  Euro
    $currencies['NLG'] = array(2, ',', '.');          //  Euro
    $currencies['PTE'] = array(2, ',', '.');          //  Euro
    $currencies['GHC'] = array(2, '.', ',');          //  Ghana, Cedi
    $currencies['GIP'] = array(2, '.', ',');          //  Gibraltar Pound
    $currencies['GTQ'] = array(2, '.', ',');          //  Guatemala, Quetzal
    $currencies['HNL'] = array(2, '.', ',');          //  Honduras, Lempira
    $currencies['HKD'] = array(2, '.', ',');          //  Hong Kong Dollar
    $currencies['HUF'] = array(0,  '', '.');          //  Hungary, Forint
    $currencies['ISK'] = array(0,  '', '.');          //  Iceland Krona
    $currencies['INR'] = array(2, '.', ',');          //  Indian Rupee
    $currencies['IDR'] = array(2, ',', '.');          //  Indonesia, Rupiah
    $currencies['IRR'] = array(2, '.', ',');          //  Iranian Rial
    $currencies['JMD'] = array(2, '.', ',');          //  Jamaican Dollar
    $currencies['JPY'] = array(0,  '', ',');          //  Japan, Yen
    $currencies['JOD'] = array(3, '.', ',');          //  Jordanian Dinar
    $currencies['KES'] = array(2, '.', ',');          //  Kenyan Shilling
    $currencies['KWD'] = array(3, '.', ',');          //  Kuwaiti Dinar
    $currencies['LVL'] = array(2, '.', ',');          //  Latvian Lats
    $currencies['LBP'] = array(0,  '', ' ');          //  Lebanese Pound
    $currencies['LTL'] = array(2, ',', ' ');          //  Lithuanian Litas
    $currencies['MKD'] = array(2, '.', ',');          //  Macedonia, Denar
    $currencies['MYR'] = array(2, '.', ',');          //  Malaysian Ringgit
    $currencies['MTL'] = array(2, '.', ',');          //  Maltese Lira
    $currencies['MUR'] = array(0,  '', ',');          //  Mauritius Rupee
    $currencies['MXN'] = array(2, '.', ',');          //  Mexican Peso
    $currencies['MZM'] = array(2, ',', '.');          //  Mozambique Metical
    $currencies['NPR'] = array(2, '.', ',');          //  Nepalese Rupee
    $currencies['ANG'] = array(2, '.', ',');          //  Netherlands Antillian Guilder
    $currencies['ILS'] = array(2, '.', ',');          //  New Israeli Shekel
    $currencies['TRY'] = array(2, '.', ',');          //  New Turkish Lira
    $currencies['NZD'] = array(2, '.', ',');          //  New Zealand Dollar
    $currencies['NOK'] = array(2, ',', '.');          //  Norwegian Krone
    $currencies['PKR'] = array(2, '.', ',');          //  Pakistan Rupee
    $currencies['PEN'] = array(2, '.', ',');          //  Peru, Nuevo Sol
    $currencies['UYU'] = array(2, ',', '.');          //  Peso Uruguayo
    $currencies['PHP'] = array(2, '.', ',');          //  Philippine Peso
    $currencies['PLN'] = array(2, '.', ' ');          //  Poland, Zloty
    $currencies['GBP'] = array(2, '.', ',');          //  Pound Sterling
    $currencies['OMR'] = array(3, '.', ',');          //  Rial Omani
    $currencies['RON'] = array(2, ',', '.');          //  Romania, New Leu
    $currencies['ROL'] = array(2, ',', '.');          //  Romania, Old Leu
    $currencies['RUB'] = array(2, ',', '.');          //  Russian Ruble
    $currencies['SAR'] = array(2, '.', ',');          //  Saudi Riyal
    $currencies['SGD'] = array(2, '.', ',');          //  Singapore Dollar
    $currencies['SKK'] = array(2, ',', ' ');          //  Slovak Koruna
    $currencies['SIT'] = array(2, ',', '.');          //  Slovenia, Tolar
    $currencies['ZAR'] = array(2, '.', ' ');          //  South Africa, Rand
    $currencies['KRW'] = array(0,  '', ',');          //  South Korea, Won
    $currencies['SZL'] = array(2, '.', ', ');         //  Swaziland, Lilangeni
    $currencies['SEK'] = array(2, ',', '.');          //  Swedish Krona
    $currencies['CHF'] = array(2, '.', '\'');         //  Swiss Franc
    $currencies['TZS'] = array(2, '.', ',');          //  Tanzanian Shilling
    $currencies['THB'] = array(2, '.', ',');          //  Thailand, Baht
    $currencies['TOP'] = array(2, '.', ',');          //  Tonga, Paanga
    $currencies['AED'] = array(2, '.', ',');          //  UAE Dirham
    $currencies['UAH'] = array(2, ',', ' ');          //  Ukraine, Hryvnia
    $currencies['USD'] = array(2, '.', ',');          //  US Dollar
    $currencies['VUV'] = array(0,  '', ',');          //  Vanuatu, Vatu
    $currencies['VEF'] = array(2, ',', '.');          //  Venezuela Bolivares Fuertes
    $currencies['VEB'] = array(2, ',', '.');          //  Venezuela, Bolivar
    $currencies['VND'] = array(0,  '', '.');          //  Viet Nam, Dong
    $currencies['ZWD'] = array(2, '.', ' ');          //  Zimbabwe Dollar

    // custom function to generate: ##,##,###.##
    function formatinr($input)
    {
        $dec = "";
        $pos = strpos($input, ".");
        if ($pos === FALSE)
        {
            //no decimals
        }
        else
        {
            //decimals
            $dec   = substr(round(substr($input, $pos), 2), 1);
            $input = substr($input, 0, $pos);
        }
        $num   = substr($input, -3);    // get the last 3 digits
        $input = substr($input, 0, -3); // omit the last 3 digits already stored in $num
        // loop the process - further get digits 2 by 2
        while (strlen($input) > 0)
        {
            $num   = substr($input, -2).",".$num;
            $input = substr($input, 0, -2);
        }
        return $num.$dec;
    }
    if ($curr == "INR")
    {
        return formatinr($floatcurr);
    }
    else
    {
        return number_format($floatcurr, $currencies[$curr][0], $currencies[$curr][1], $currencies[$curr][2]);
    }
}
*/
			$fmt = new NumberFormatter( 'en-$country', NumberFormatter::CURRENCY );
			if($currency == "USD"){
			 return substr( $fmt -> formatCurrency($value, $currency) , 2);
			}else{
			 return $fmt -> formatCurrency($value, $currency);
			}
		}


	/****************************************
	convert transaction type into redable 
	form
	/*

			a1 = sales (debit) (t1)
			a2 = payment recieved (credit) (t2)
			a3 = payment paid (debit) (t1)
			a4 = purchase (credit)
	a5 = debit note = credit  
	a6 = credit note = debit
			a7 = other debit
			a8 = other crdit 
*/

       function transaction_type($account_code , $transaction_code){

       		global $lang;

       if($account_code == "le1"){
        			switch ($transaction_code) {
        			       	case 'a1':
        			       		$transaction_action = $lang["sales"];
        			       		break;
        			       	case 'a2':
        			       		$transaction_action = $lang["payment_received"];
        			       		break;
        			       	case 'a3':
        			       		$transaction_action = $lang["payment_paid"];
        			       		break;
        			       	case 'a4':
        			       		$transaction_action = $lang["purchase"];
        			       		break;
        			       	case 'a5':
        			       		$transaction_action = $lang['debit_note_received'];
        			       		break;
        			       	case 'a6':
        			       		$transaction_action = $lang['debit_note_sent'];
        			       		break;
        			       	case 'a7':
        			       		$transaction_action = $lang['other'] . " " . $lang['debit'] . " (" . $lang['out'] . ")";
        			       		break;
        			       	case 'a8':
        			       		$transaction_action =  $lang['other'] . " " . $lang['credit'] .  " (" . $lang['in'] . ")";
        			       		break;
        			       	
        			       	default:
        			       		$transaction_action = "unknown";
        			       		break;
        			       }       
       }else if($account_code == "le2"){  
                switch ($transaction_code) {
        			       	case 't1':
        			       		$transaction_action = $lang["value"];
        			       		break;
        			       	case 't2':
        			       		$transaction_action = $lang["depreciation"];
        			       		break;
        			       	
        			       	default:
        			       		$transaction_action = "unknown";
        			       		break;
        			      }
       }else if($account_code == "le3"){  
               	switch ($transaction_code) {
        			       	case 't1':
        			       		$transaction_action = $lang["debt"];
        			       		break;
        			       	case 't2':
        			       		$transaction_action = $lang["debt_paid"];
        			       		break;
        			       	
        			       	default:
        			       		$transaction_action = "unknown";
        			       		break;
        			       } 
       }else if($account_code == "le4"){  
                switch ($transaction_code) {
        			       	case 't1':
        			       		$transaction_action = $lang['expense'];
        			       		break;
        			       	case 't2':
        			       		$transaction_action =  $lang['income'];
        			       		break;
        			       	
        			       	default:
        			       		$transaction_action = "unknown";
        			       		break;
        			       } 
       }

       return $transaction_action;
     }

	/**************************************
	convert the sql current date stemp into 
	required date stamp
	**************************************/

		function date($stamp){
			return date('d',strtotime($stamp)) . "-" . date('m',strtotime($stamp)) . "-" . date('Y',strtotime($stamp));
		}

	/**************************************
	decode the salutation
	**************************************/

		function salutation($val){
				switch ($val) {
					case 'sa1':
						 return "mr";
					break;
					case 'sa2':
						 return "mrs";
					break;
					case 'sa3':
						 return "ms";
					break;
					case 'sa4':
						 return "miss";
					break;
					case 'sa5':
						return "dr";
					break;
					default:
						return "";
						break;
				}
		}

	/***************************************
	to decode the industry using the raw data
	which is stored in sqlDB 
	****************************************/

		function industry($code){
			
			global $lang;

			switch ($code) {
				case "i1":			
						return $lang['industry_i1'];
				break;
				case "i2":			
						return $lang['industry_i2'];
				break;
				case "i3":			
						return $lang['industry_i3'];
				break;
				case "i4":			
						return $lang['industry_i4'];
				break;
				case "i1":			
						return $lang['industry_i5'];
				break;
				case "i6":			
						return $lang['industry_i6'];
				break;
				case "i7":			
						return $lang['industry_i7'];
				break;
				case "i8":			
						return $lang['industry_i8'];
				break;
				case "i9":			
						return $lang['industry_i9'];
				break;
				case "i10": 		
						return $lang['industry_i10'];
				break;
				case "i11":			
						return $lang['industry_i11'];
				break;
				case "i12":			
						return $lang['industry_i12'];
				break;
				case "i13":			
						return $lang['industry_i13'];
				break;
				case "i14": 		
						return $lang['industry_i14'];
				break;
				case "i15":			
						return $lang['industry_i15'];
				break;
				case "i16": 		
						return $lang['industry_i16'];
				break;
				case "i17":			
						return $lang['industry_i17'];
				break;
				case "i18":			
						return $lang['industry_i18'];
				break;
				case "i19":			
						return $lang['industry_i19'];
				break;

				default:
					return $lang['industry_i20'];
				break;
			}
		}

		/*********************************************
		this is is collection of multiple form data 
		which are stored in sql, coming from a form
		**********************************************/

		function form_entry($code)
		{

			switch ($code) 
			   {
			   	//contact us entry
				case 'cr1':
				       	return "Malfunction of the site.";
						break;
				case 'cr2':
						  	return "We or any user is violating your copyright or patent.";
						break;
				case 'cr3':
						  	return "We or any user is  Endorsing discrimination based on race, religion etc.";	
						break;
				case 'cr4':
							return "Any service is not working.";
						break;
				case 'cr5':
							return "Other.";
					break;
				//feedback entry
				case "sr1":
							return "very good";
					break;
				case "sr2":
							return "good";
					break;
				case "sr3":
							return "fair";
					break;
				case "sr4":
							return "poor";
					break;
				case "sr5":
							return "very poor";
					break;

				case "sp1":
							return "Definitely";
					break;
				case "sp2":
							return "Probably";
					break;	
				case "sp3":
							return "Not Sure";
					break;
				case "sp4":
							return "Probably Not";
					break;
				case "sp5":
							return "Definitely Not";
					break;

			  //jobs entry

				case "q1":
						return "Computer science and MBA";
				break;
				case "q2":
						return "M-TECH and MBA";
				break;
				case "q3":
						return "MBA";
				break;
				case "q4":
						return "Computer science";
				break;
				case "q5":
						return "M-TECH";
				break;
				case "q6":
						return "Phd in computer science";
				break;
				case "q7":
						return "Qualification Not Listed";
				break;
				case "q8":
						return "I have knowledge but not qualification";
				break;

				case "e1":
						return "1-3 years";
				break;
				case "e2":
						return "4-6 years";
				break;
				case "e3":
						return "7-9 years";
				break;
				case "e4":
							return "10-12 years";
				break;
				case "e5":
						return "12 above";
				break;
				case "e6":
						return "no experience";
				break;
				default:
						return "unknown";
				break;
				}

		}

		/**************************************
		decode the country to a readable form 
		using the country code
		***************************************/

		function country($code)
		{
			switch ($code) {
				case 'IN':
						return "india";
					break;
				case 'US':
						return "united states of america";
					break;
				default:
						return "unknown";
					break;
			}
		}

		/*********************************************
		decode the currency to a readable form 
		usingthe currecy code provided by user
		**********************************************/

		function currency($code)
		{
			switch ($code) {
				case 'INR':
						return "Indian rupee";
					break;
				case 'USD':
						return "United States dollar";
					break;
				
				default:
					return "unknown";
					break;
			}
		}

		/***********************************************
		decoding the country mobile pre-fix code for different
		country
		**********************************************/

		function phone_code($code)
		{
			switch ($code) {
				case 'IN':
						return "+91";
					break;
				case 'US':
						return "+1";
					break;
				default:
						return "+";
					break;
			}
		}


}

?>