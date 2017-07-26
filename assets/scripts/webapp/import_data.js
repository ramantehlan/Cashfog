$(document).ready(function(){

	$("#import_progress_bar").progressbar({
		value: 0
	});

	/******************************************************
	function to handle uploads
	******************************************************/

	//while data is still being uploaded
	function import_progress_handler(event){

		//getting percent of data that has been uploaded
		var percent = Math.round( (event.loaded / event.total) * 100);

		//priting percent
		$(".progress-label").html(percent + "% Uploaded");

		//moving progress bar according to percent
		$("#import_progress_bar").progressbar({
				value: percent
		});

	}

	//data has been uploaded successfully
	function import_complete_handler(event){
		var import_success = $(".import_success");

		//printing the action file data here
		import_success.show();
			
			$("#import_progress_bar").hide();
			import_success.html(event.target.responseText);
			//$(".test_area").html(event.target.responseText);

			setTimeout(function(){
					import_success.hide();
					$("#import_progress_bar").hide();
			},3000);
		

	}

   /*******************************************************
	function on clicking of button
   ********************************************************/

	$("#submit_data").click(function(){

		//declaring variables
		btn = document.getElementById("submit_data");
		err = $(".import_error");
		pro = $("#import_progress_bar");

		//hide old errors
		err.hide();

		//to disable the button for a while
		btn.disabled = true;

			//getting variable from page
			var data_file  = document.getElementById("data_file").files[0];

			if(document.getElementById("data_file").value.length == 0){
				throw_error(err , err , "No field can be left empty.");

				btn.disabled = false;
			}
			else if(data_file.type != "application/vnd.ms-excel"){
				throw_error(err , err , "Upload file extension can only be csv.");

				btn.disabled = false;
			}
			else{
				//hide error box
				err.hide();
				//showing the import_progress_bar
				pro.show();

				var formdata = new FormData();
				formdata.append("data_file" , data_file);

				//create a XMLHttpRequest
				var request = new XMLHttpRequest();

				request.upload.addEventListener("progress" , import_progress_handler , false);
				request.addEventListener("load" , import_complete_handler , false),
				request.open("POST" , $("#import_form").attr("action"));

				request.send(formdata);

				btn.disabled = false;

				document.getElementById("data_file").value = "";

			}


		return false;

	});

});

