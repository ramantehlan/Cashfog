/******************************************************
this file is to upload settings data

cretor:- raman tehlan
date of creation:- 15/12/2016
*********************************************************/


$(document).ready(function(){

	$("#settings_preferences_button").click(function(){

		var language  	= document.getElementById("language").value;
		var homepage 	= document.getElementById("homepage").value;
		var mode	  	= document.getElementById("mode").value;

		var error_box 	 	  = $(".error_box");
		var success_box 	  = $(".success_box");

		error_box.hide();
		success_box.hide();

		if(language.length == 0 || homepage.length == 0 || mode.length == 0 ){

			throw_error(error_box , error_box , empty_field_error);
			return false;

		}else{

				 //hide error box
	    		 //show black shadow and processing box
	    		 error_box.hide();
	    		 success_box.hide();

	    		 //showing the processing coming from open effect
	    		 effect_processing_show();

	    		 //creating the form data 
	    		 var formdata = new FormData();

	    		 //appending the new data
	    		 formdata.append("language",language);
	    		 formdata.append("homepage",homepage);
	    		 formdata.append("mode",mode);
	    		
	    		 //creating XMLHttpRequest 
                 var ajax = new XMLHttpRequest();

                ajax.upload.addEventListener("progress" , progress_handler , false);
                ajax.addEventListener("load", complete_handler , false);
                ajax.addEventListener("error",error_handler,false);
                ajax.addEventListener("abort",abort_handler,false);
                ajax.open("POST",$("#settings_preferences_form").attr("action"));

                ajax.send(formdata);
               

                return false;
		}

		return false;
	});

});