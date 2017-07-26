
 $("document").ready(function(){

	$("#form_button").click(function(){

		var name    	= document.getElementById("name").value;	
		var email   	= document.getElementById("email").value;	
		var reason  	= document.getElementById("reason").value;	
		var subject 	= document.getElementById("subject").value;	
		var message 	= document.getElementById("message").value;
		var recaptcha	= document.getElementById("g-recaptcha-response").value;


		var error_box   = $(".error_box");
		var action_box  = $(".action_block"); 
		var button      = $(".form_button");

		action_box.hide();
		error_box.hide();


		if(name.length == 0 || email.length == 0 || reason.length == 0 )
		{
			throw_error(error_box , action_box , empty_field_error);
		}

		else if(!alpha_validity(name))
		{
			throw_error(error_box , action_box , "Name " + alpha_field_error);
		}

		else if(!email_validity(email))
		{
			throw_error(error_box , action_box , email_field_error);
		}
		else if(recaptcha.length == 0)
		{
			throw_error(error_box , action_box , recaptcha_field_error);
		}
		else
		{
           
            button.disabled = true;
			error_box.hide();
			action_box.show();

			$.post($("#form").attr("action") , {name:name,email:email,reason:reason,subject:subject,message:message,'g-recaptcha-response':recaptcha} , function(response){
                action_box.html(response);
			});
		}

       
		return false;

	});

});
