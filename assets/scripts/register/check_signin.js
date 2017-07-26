$(document).ready(function(){

	$('#signin').click(function(){

		var email  	 = document.getElementById("email_in").value;
		var password = document.getElementById("password_in").value;

		var error_box  = $(".error_box"); 
		var button 	   = $("#signin");


		if(email.length == 0 || password.length == 0 )
		{
			 throw_error(error_box , error_box , empty_field_error);
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