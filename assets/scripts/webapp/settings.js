/******************************************************
this file is to upload settings data

cretor:- raman tehlan
date of creation:- 27/11/2016
*********************************************************/

	function check_form(){
			
			var f_name 		= document.getElementById("f_name").value;
			var l_name  	= document.getElementById("l_name").value;
			var email 		= document.getElementById("email").value;
			var birth_date	= document.getElementById("birth_date").value;
			var birth_month	= document.getElementById("birth_month").value;
			var birth_year	= document.getElementById("birth_year").value;
			var gender		= document.getElementById("gender").value;
			var country		= document.getElementById("country").value;

			//for checking date difference 
			var dob   = birth_month + "/" + birth_date + "/" + birth_year;

			var error_box 	 	  = $(".error_box");
			var success_box 	  = $(".success_box");

			error_box.hide();
			success_box.hide();

			

			if(email.length == 0)
			{
				 throw_error(error_box , error_box , empty_field_error);
			 	 return false;
			}
			else if(!alpha_validity(f_name) || !alpha_validity(l_name))
	 		{
				throw_error(error_box , error_box , "Name " +  alpha_field_error);
				return false;
			}
			else if(!email_validity(email))
			{
				throw_error(error_box , error_box , email_field_error);
				return false;
	    	}
	    	else
	    	{
               
	    		 //hide error box
	    		 //show black shadow and processing box
	    		 error_box.hide();
	    		 success_box.hide();

	    		 //showing the processing coming from open effect
	    		 effect_processing_show();
                
                //creating form data arrray
                var formdata = new FormData();

                //appending data to form
                formdata.append("f_name",f_name);
                formdata.append("l_name",l_name);
                formdata.append("email",email);
                formdata.append("birth_date",birth_date);
                formdata.append("birth_month",birth_month);
                formdata.append("birth_year",birth_year);
                formdata.append("gender" , gender);
                formdata.append("country" , country);

                //adding value of email to hidden current email
                document.getElementById("current_email").value = email;


                //creating XMLHttpRequest 
                var ajax = new XMLHttpRequest();

                ajax.upload.addEventListener("progress" , progress_handler , false);
                ajax.addEventListener("load", complete_handler , false);
                ajax.addEventListener("error",error_handler,false);
                ajax.addEventListener("abort",abort_handler,false);
                ajax.open("POST",$("#settings_form").attr("action"));

                ajax.send(formdata);
                

               //to remove password
               $(".password_row").hide();
            	


	    		return false;
	    	}

	  }


	//this function is used by above url
	function password_check(){
	   				check_form();							
	  }


$(document).ready(function(){

	$("#email").keyup(function(){

		var new_email = $(this).val();

		var current_email = $("#current_email").val();

		if(current_email != new_email){
			$(".password_row").show();
		}else{
			$(".password_row").hide();
		}

	});

	$("#settings_submit").click(function(){

			var current_email = $("#current_email").val();
			var new_email = $("#email").val();

			//if new email is not equal to current email
			//then get password from user and check if it is right
			if(current_email != new_email){

				//password
				var password = $("#password").val();
				
				var error_box 	 	  = $(".error_box");
				var success_box 	  = $(".success_box");

				  if(password.length == 0 ){
			 				 throw_error(error_box , error_box , empty_password_field_error);
			 				 return false;
					}
	   			 else if(!password_validity(password)){
	    					throw_error(error_box , error_box , password_field_error);
	    					return false;
	   				}
	   			else{
	   					
	   					var url = $("#password_check_url").val();

	   					$.post(url , {password:password} , function(response) {
	   							$(".response_box").html(response);
	   					});	

	   			   }

			}else
			{
				check_form();
			}

			return false;
	});

});


