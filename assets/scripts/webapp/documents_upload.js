  /*****************************************
  this is used in document upload only
  ***************************************/

 function document_upload_progress_handler(event)
   {
        //getting percent of task compliction
        var percent = Math.round((event.loaded / event.total) * 100);

 
       $('.documents_drop_area_message').html(percent + "% uploaded");
    
    }

 function document_upload_complete_handler(event)
    {
        

     setTimeout(function() {
               
          //printing the response of target page to status area
   		  $('.documents_drop_area_message').html(event.target.responseText);

              //to reload page
              location.reload(); 
  

     }, 1000);
        
  }

   function document_upload_error_handler(event)
   {               
                   $('.documents_drop_area_message').html("<div class='document_upload_error_message'>" + processing_error + "</div>");
   }

  function document_upload_abort_handler(event)
   {
                   $('.documents_drop_area_message').html("<div class='document_upload_error_message'>" + aborted_error + "</div>");
   }


/****************************************
handle the error comming from action page
*****************************************/

    
    function document_upload_return_error(error)
    {
        $('.documents_drop_area_message').html("<div class='document_upload_error_message'>" + error + "</div>");
    }


/******************************************
main checking script
******************************************/

$(document).ready(function(){
		
		
		$("#files").change(function(){
			
				//to get the selected files
				var files = $(this)[0].files;

				if(files.length != 0)
				{
					$('.documents_drop_area_message').html(files.length + " files selected.");
				}
				
		});

		//on click of submit button
		$("#documents_upload_button").click(function(event){



				//to get the selected files
				var files = $("#files")[0].files;



				//display the message
				var display = $('.documents_drop_area_message');

				var allow_upload = true;

				//check if there is a upload
				if(files.length != 0)
				{ 	
				  	//check max no of files don't excide 5
				  	if(files.length <= 5)
				  	{
						
						//loop to get each file
						for (var i = 0; i < files.length; i++) 
						{	
							//file size should not be more then 2 mb
							if( (files[i].size/1024) > max_document_size)
							{
								display.html("<div class='document_upload_error_message'>No file size should be more than " + (max_document_size / 1024) + " MB.</div>");
								allow_upload = false;
								return false;
							}
							else 
							{	
								//file extention should be pdf, txt, jpg , jpeg , jpe , xlt , xls , ppa , ppt , pptx , xlsx , doc , docx , csv , rtf , odt
								
								//to get file extention
								var re = /(?:\.([^.]+))?$/;
								var file_extention = re.exec(files[i].name)[1];
									
									if(file_extention == "pdf" || file_extention == "txt" || file_extention == "jpg" || file_extention == "jpeg" || file_extention == "jpe" || file_extention == "xlt" || file_extention == "xls" || file_extention == "ppa" || file_extention == "ppt" || file_extention == "pptx" || file_extention == "xlsx" || file_extention == "doc" || file_extention == "docx" || file_extention == "csv" || file_extention == "rtf" || file_extention == "odt")
									{
										allow_upload = true;
									}
									else
									{
										display.html("<div class='document_upload_error_message'>File extention should match  pdf, txt , jpg , jpeg , jpe , xlt , xls , ppa , ppt , pptx , xlsx , doc , docx , csv , rtf , odt.</div>");						
										allow_upload = false;
									}
								
							}
						}

					}
					else //we don't allow more then 5 uploads
					{
						display.html("<div class='document_upload_error_message'>Number of files upload can't be more than 5.</div>");						
						allow_upload = false;
					}
				}
				else//zero files are there
				{
					display.html("<div class='document_upload_error_message'>No files selected.</div>");
					allow_upload = false;
				}









				//to upload file or not
				if(allow_upload)
				{	
					display.html("Uploading..."); 

					//creating form data array
					var formdata = new FormData();

					//getting files to javascript
					var files = document.getElementById("files");

					//adding data to form
            		for(var j = 0; j < files.files.length; j++)
            		{
    					 formdata.append('files[]', files.files[j]);
					}
       				 

					//creating a http request
					var upload_document = new XMLHttpRequest();

					upload_document.upload.addEventListener("progress" , document_upload_progress_handler , false);
					upload_document.addEventListener("load" , document_upload_complete_handler , false);
					upload_document.addEventListener("error" , document_upload_error_handler , false);
					upload_document.addEventListener("abort" , document_upload_abort_handler , false);
					upload_document.open("POST" , $("#documents_upload").attr("action"));

					upload_document.send(formdata);

					//reset the file chossen to zero
					document.getElementById("files").value = "";
				
				}
					
					


				return false;
		});

});