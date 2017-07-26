/****************************************
This is to check the record account trasaction 
form and send user data to appropricate location

creator:- raman tehlan
date of creaion:- 01/01/2017
******************************************/



$(document).ready(function(){

	//submit the transaction
	$("#submit_record_button").click(function(){

			var account_id 			= document.getElementById("account_id").value;
			var particulars			= document.getElementById("particulars").value;
			var bill_no				= document.getElementById("bill_no").value;
			var transaction_amount	= document.getElementById("transaction_amount").value;
			var transaction_method	= document.getElementById("transaction_method").value;
			var transaction_type	= document.getElementById("transaction_type").value;
			var transaction_comment	= document.getElementById("transaction_comment").value;

			//this is the error handeling divs
			var error_box 	 	  = $(".record_transaction_error");
			var success_box 	  = $(".record_transaction_success");

			//hide any box
			error_box.hide();
			success_box.hide();


				//checking the form
				if(account_id.length == 0 || transaction_amount.length == 0 || transaction_type.length == 0){
					throw_error(error_box , error_box , empty_field_error);
				}
				/*else if(!alphanumeric_validity(particulars)){
					throw_error(error_box , error_box , "Particulars" + alphanumber_field_error);
				}*/
				else if(!number_validity(bill_no)){
					throw_error(error_box , error_box , "Bill/Invoice" + number_field_error);
				}
				else if(!number_amount_validity2(transaction_amount)){
					throw_error(error_box , error_box , "Transaction amount" + number_field_error);
				}
				else if(!alpha_validity(transaction_method)){
					throw_error(error_box , error_box , "Transaction method " + alpha_field_error);
				}
				else
				{
					 //hide error box
	    			 //show black shadow and processing box
	    		 	 error_box.hide();
	    		 	 success_box.hide();

	    		 	 //showing the processing coming from open effect
	    			 effect_processing_show();

		    		 //creating form data array 
		    		 var formdata = new FormData();

		    		 		//comman fields
		    		 		formdata.append("account_id" , account_id);
		    		 		formdata.append("particulars" , particulars);
		    		 		formdata.append("bill_no" , bill_no);
		    		 		formdata.append("transaction_amount" , transaction_amount);
		    		 		formdata.append("transaction_method" , transaction_method);
		    		 		formdata.append("transaction_type" , transaction_type);
		    		 		formdata.append("transaction_comment" , transaction_comment);

		    		 //new send the info 
		    		 //creating XMLHttpRequest 
                 	 var ajax = new XMLHttpRequest();

                	 ajax.upload.addEventListener("progress" , progress_handler , false);
                	 ajax.addEventListener("load", complete_handler , false);
                 	 ajax.addEventListener("error",error_handler,false);
                 	 ajax.addEventListener("abort",abort_handler,false);
                	 ajax.open("POST",$("#record_ledger_transaction_form").attr("action"));

                	 ajax.send(formdata);


					//document.getElementById("account_id").value 			= "";
					document.getElementById("particulars").value 			= "";
					document.getElementById("bill_no").value				= "";
					document.getElementById("transaction_amount").value		= "";
					document.getElementById("transaction_method").value		= "";
					document.getElementById("transaction_type").value		= "";
					document.getElementById("transaction_comment").value	= "";


				}


		return false;
	});




});