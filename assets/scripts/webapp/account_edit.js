/*********************************
this javascript is to check the form 
of editing a account

note:- this script was modified/same copy of account_create.js
cause they are both to just check the form
we are not using same file in cash we have to chenge few
things in one script but not other


creator:- Raman Tehlan
date of creation:- 06/01/2017
*********************************/


$(document).ready(function(){

		//check the submit form on click
		$(".submit_edit_account_button").click(function(){

			var account_id  		= document.getElementById("account_id").value;
			var account_type 		= document.getElementById("account_type").value;
			var contact_salutation 	= document.getElementById("salutation").value;
			var contact_f_name		= document.getElementById("f_name").value;
			var contact_l_name		= document.getElementById("l_name").value;
			var company_name 		= document.getElementById("company_name").value;
			var account_title		= document.getElementById("account_title").value;
			var	currency			= document.getElementById("currency").value;
			var due_days			= document.getElementById("due_days").value;
			var address				= document.getElementById("address").value;
			var street				= document.getElementById("street").value;
			var city				= document.getElementById("city").value;
			var state 				= document.getElementById("state").value;
			var zip					= document.getElementById("zip").value;
			var country				= document.getElementById("country").value;
			var contact_email		= document.getElementById("contact_email").value;
			var work_phone	 		= document.getElementById("work_phone").value;
			var mobile_phone		= document.getElementById("mobile_phone").value;
			var website				= document.getElementById("website").value;
			var account_comment		= document.getElementById("account_comment").value;

				//this is the error handeling divs
				var error_box 	 	  = $(".create_account_error");
				var success_box 	  = $(".create_account_success");

				//This is a flag to check if script can create a account or not
				var allow_creating = false;


				error_box.hide();
				success_box.hide();

									
									if(account_title.length == 0 || currency.length == 0 || account_type == ""){
										throw_error(error_box , error_box , empty_field_error);
									}
									else if(!alpha_validity(contact_f_name) || !alpha_validity(contact_l_name)){
										throw_error(error_box , error_box , "First and Last Name" + alpha_field_error);
									}	
									else if(!number_validity(due_days)){
										throw_error(error_box , error_box , "Due days " + number_field_error);
									}
									else if(!number_validity(zip)){
										throw_error(error_box , error_box , "zip" + number_field_error);
									}
									else if(!email_validity(contact_email)){
										throw_error(error_box , error_box , email_field_error);
									}
									else if(!phonenumber_validity(work_phone) || !phonenumber_validity(mobile_phone)){
										throw_error(error_box , error_box , phone_field_error);
									}
									else if(!website_validity(website)){
										throw_error(error_box , error_box , website_field_error);
									}
									else{
										allow_creating = true;
									}


				//create account only if allow_creating is true
				if(allow_creating){
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
		    		 		formdata.append("account_type" , account_type);
		    		 		formdata.append("account_title" , account_title);
		    		 		formdata.append("currency" , currency);
		    		 		formdata.append("account_comment" , account_comment); 	
		    		 		formdata.append("contact_salutation" , contact_salutation);
		    		 		formdata.append("contact_f_name" , contact_f_name);
		    		 		formdata.append("contact_l_name" , contact_l_name);
		    		 		formdata.append("company_name" , company_name);
		    		 		formdata.append("due_days" , due_days);
		    		 		formdata.append("address" , address);
		    		 		formdata.append("street" , street);
		    		 		formdata.append("city" , city);
		    		 		formdata.append("state" , state);
		    		 		formdata.append("zip" , zip);
		    		 		formdata.append("country" , country);
		    		 		formdata.append("contact_email" , contact_email);
		    		 		formdata.append("work_phone" , work_phone);
		    		 		formdata.append("mobile_phone" , mobile_phone);
		    		 		formdata.append("website" , website);


		    		 //new send the info 
		    		 //creating XMLHttpRequest 
                 	 var ajax = new XMLHttpRequest();

                	 ajax.upload.addEventListener("progress" , progress_handler , false);
                	 ajax.addEventListener("load", complete_handler , false);
                 	 ajax.addEventListener("error",error_handler,false);
                 	 ajax.addEventListener("abort",abort_handler,false);
                	 ajax.open("POST",$("#edit_account_info_form").attr("action"));

                	 ajax.send(formdata);

                	 

				}

				return false;
		});

});