
 	   		  	$("document").ready(function(){
 	   		  		$("#form_button").click(function(){


 	   		  			var name 					= document.getElementById('name').value;
 	   		  			var email 					= document.getElementById('email').value;
 	   		  			var response_1 				= document.getElementById('response_1').value;
 	   		  			var response_2 				= document.getElementById('response_2').value;
 	   		  			var answer					= document.getElementById('answer').value;
 	   		  			var recaptcha 				= document.getElementById("g-recaptcha-response").value;
 	   		  			

 	   		  			var error_box   = $(".error_box");
						var action_box  = $(".action_block"); 
						var button 		= $(".form_button");

						action_box.hide();
						error_box.hide();
 						
						if(name.length == 0 || email.length == 0 || response_1.length == 0 || response_2.length == 0 )
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

						  	$.post($("#form").attr("action") , {name:name,email:email,response_1:response_1,response_2:response_2 ,answer:answer,"g-recaptcha-response":recaptcha} , function(response){
						  		action_box.html(response);
						  		
						  	});
						  	
						  }


						return false;

 	   		  		});
 	   		  	});
