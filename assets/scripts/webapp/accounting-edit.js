/****************************************
This is to check account edit form and save
it

creator:- raman tehlan
date of creaion:- 24/03/2017
******************************************/

$(document).ready(function(){

	$("#submit_edit_account").click(function(){
			var financial_period 	= document.getElementById("financial_period").value;
			var currency     		= document.getElementById("currency").value;
			var buyer_term			= document.getElementById("buyer_term").value;
			var seller_term			= document.getElementById("seller_term").value;

			//this is the error handeling divs
			var error_box 	 	  = $(".accounting_edit_error");
			var success_box 	  = $(".accounting_edit_success");

			//hide any box
			error_box.hide();
			success_box.hide();


				//checking the form
				if(financial_period.length == 0 || buyer_term.length == 0 || seller_term.length == 0){
					throw_error(error_box , error_box , empty_field_error);
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
		    		 		formdata.append("financial_period" , financial_period);
		    		 		formdata.append("currency" , currency);
		    		 		formdata.append("buyer_term" , buyer_term);
		    		 		formdata.append("seller_term" , seller_term);

		    		 //new send the info 
		    		 //creating XMLHttpRequest 
                 	 var ajax = new XMLHttpRequest();

                	 ajax.upload.addEventListener("progress" , progress_handler , false);
                	 ajax.addEventListener("load", complete_handler , false);
                 	 ajax.addEventListener("error",error_handler,false);
                 	 ajax.addEventListener("abort",abort_handler,false);
                	 ajax.open("POST",$("#accounting_edit_form").attr("action"));

                	 ajax.send(formdata);

				}


		return false;
	});

});