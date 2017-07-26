/******************************************************
this file is to upload settings data

cretor:- raman tehlan
date of creation:- 30/11/2016
*********************************************************/


$(document).ready(function(){

	$("#settings_security_button").click(function(){

		var old_password 		= document.getElementById("old_password").value;
		var new_password		= document.getElementById("new_password").value;
		var new_password_retype = document.getElementById("new_password_retype").value;

		var error_box 	 	  = $(".error_box");
		var success_box 	  = $(".success_box");

		error_box.hide();
		success_box.hide();

		if(old_password.length == 0 || new_password.length == 0 || new_password_retype == 0)
		{
			throw_error(error_box , error_box , empty_field_error);
			return false;
		}
		else if(!password_validity(old_password))
		{
			throw_error(error_box , error_box , "Current " + password_field_error);
			return false;
		}
		else if(!password_validity(new_password))
		{
			throw_error(error_box , error_box , "New " + password_field_error);
			return false;
		}
		else if(new_password == old_password)
		{
			throw_error(error_box , error_box , password_same_error);
			return false;
		}
		else if(new_password != new_password_retype)
		{
			throw_error(error_box , error_box , password_matching_error);
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

	    		 //creating form data array 
	    		 var formdata = new FormData();

	    		 //appending data to form
	    		 formdata.append("old_password",old_password);
	    		 formdata.append("new_password",new_password);

	    		 //creating XMLHttpRequest 
                 var ajax = new XMLHttpRequest();

                ajax.upload.addEventListener("progress" , progress_handler , false);
                ajax.addEventListener("load", complete_handler , false);
                ajax.addEventListener("error",error_handler,false);
                ajax.addEventListener("abort",abort_handler,false);
                ajax.open("POST",$("#settings_security_form").attr("action"));

                ajax.send(formdata);

                old_password 		= "";
                new_password 		= "";
                new_password_retype = "";


		}


		return false;

	});

});