$(document).ready(function(){

	$("#form_button").click(function(){

		var company_name	= document.getElementById("company_name").value;
		var email  	 		= document.getElementById("email").value;
		var password 		= document.getElementById("password").value;

		var error_box  = $(".error_box"); 
		var button = $("#form_button");


		if(company_name.length == 0 || email.length == 0 || password.length == 0)
		{
			 throw_error(error_box , error_box , empty_field_error);
			 return false;
		}
		else if(!companyname_validity(company_name))
	 	{
			throw_error(error_box , error_box , companyname_field_error);
			return false;
		}
		else if(!email_validity(email))
		{
			throw_error(error_box , error_box , email_field_error);
			return false;
	    }
	    else if(!password_validity(password))
	    {
	    	throw_error(error_box , error_box , password_field_error);
	    	return false;
	    }


	});

});