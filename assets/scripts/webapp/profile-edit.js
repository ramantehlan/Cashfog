/******************************************************
this file is to upload settings data

cretor:- raman tehlan
date of creation:- 27/11/2016
*********************************************************/

	function remove_logo(){

		var display = $(".delete_display_box");

		var url = $(".removing_logo_url").val();

		$.post(url , {} , function(response){
				display.html(response);
		});

		//this is to remove the remove box
		$(".removing_logo_box").remove();
		

	}

$(document).ready(function(){

	//this is to remove/delete currerent profile picture of user
	$(".removing_logo_box").click(remove_logo);

	$("#settings_profile_button").click(function(){
			
			var company_name 		= document.getElementById("company_name").value;
			var industry			= document.getElementById("industry").value;
			var tax_id				= document.getElementById("tax_id").value;
			var logo				= document.getElementById("logo").files[0];
			var address				= document.getElementById("address").value;
			var street				= document.getElementById("street").value;
			var city				= document.getElementById("city").value;
			var state				= document.getElementById("state").value;
			var zip 				= document.getElementById("zip").value;
			var phone				= document.getElementById("phone").value;
			var contact_email		= document.getElementById("contact_email").value;
			var website				= document.getElementById("website").value;


			var error_box 	 	  = $(".error_box");
			var success_box 	  = $(".success_box");

			//flag to indicate if data could be sent or not
			var allow_ajax = true;

			error_box.hide();
			success_box.hide();

			if(company_name.length == 0 )
			{
				 throw_error(error_box , error_box , empty_field_error);
				 allow_ajax = false;
			 	 return false;
			}
			else if(!companyname_validity(company_name)){
				 throw_error(error_box , error_box , companyname_field_error);
				 allow_ajax = false;
				return false;
			}
			else if(!phonenumber_validity(phone))
			{
				throw_error(error_box , error_box , phone_field_error);
				 allow_ajax = false;
				return false;
			}
			else if(!number_validity(zip))
			{
				throw_error(error_box , error_box , "Zip" + number_field_error);
				 allow_ajax = false;
				return false;
			}
			else if(!email_validity(contact_email))
			{
				throw_error(error_box , error_box , email_field_error);
				 allow_ajax = false;
				return false;
	    	}
	    	else if(!website_validity(website))
			{
				throw_error(error_box , error_box , website_field_error);
				allow_ajax = false;
				return false;
	    	}
	    	else if(document.getElementById('logo').value.length != 0)
	    	{
	    		if (logo.type == 'image/jpeg' || logo.type == 'image/png' || logo.type == 'image/jpg' ||  logo.type == 'image/jpe')
	    		{
	    			if( (logo.size/1024) > max_size_uplod )
	    			{
						throw_error(error_box , error_box , img_size_error);
						allow_ajax = false;
						return false;
	    			}
	    		}
	    		else
	    		{
	    			throw_error(error_box , error_box , img_type_error);
					allow_ajax = false;
					return false;
	    		}
	    	}

	    		 
	    	if(allow_ajax)
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
                formdata.append("company_name",company_name);
                formdata.append("industry",industry);
                formdata.append("tax_id",tax_id);
                formdata.append("logo",logo);
                formdata.append("address",address);
                formdata.append("street",street);
                formdata.append("city",city);
                formdata.append("state",state);
                formdata.append("zip",zip);
                formdata.append("phone",phone);
                formdata.append("contact_email",contact_email);
                formdata.append("website",website);


                //creating XMLHttpRequest 
                var ajax = new XMLHttpRequest();

                ajax.upload.addEventListener("progress" , progress_handler , false);
                ajax.addEventListener("load", complete_handler , false);
                ajax.addEventListener("error",error_handler,false);
                ajax.addEventListener("abort",abort_handler,false);
                ajax.open("POST",$("#settings_profile_form").attr("action"));

                ajax.send(formdata);
                
                //reset the file chossen to zero
                document.getElementById("logo").value = "";
            	

               }
	    		
	    	




			return false;
	});

});


