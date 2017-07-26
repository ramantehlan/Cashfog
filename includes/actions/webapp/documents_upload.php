<?php
/************************************************
This script is to upload documents 

creator:- Raman tehlan
date of creation:- 30/11/2016
************************************************/

session_start();

//define.inc define the basic terms
include "../../define.inc.php";

//check if session exist
if(isset($_SESSION[app_name . 'session_name'])){
		
		if(isset($_FILES['files'])){

				//include important files
				//connect.inc to connect to database
				include "../../connect.inc.php";

				//flag to check if data can be updated in database
				$uploading_complete = false;

				//used in code to refer
				$user_id  		  = $_SESSION[app_name . "user_id"];
				
				//to count total no of files
				$total_files = count($_FILES['files']['tmp_name']);

				//store the server_file_name
				$document_name = array();

				//store the document_id
				$document_id = array();

				/*********************************************8
				document name = user_id + document_id
				********************************************/
				
				
						//to function for every individual file
						for($i = 0; $i < $total_files; $i++){	
								
								//to get the extension from name
								preg_match('/\.[^\.]+$/i', $_FILES['files']['name'][$i] ,$ext);

								//getting file details
								$document_id[$i] 	 = date('ymdhis') . rand(10,10000);
								$document_name[$i]   = $user_id . "_" . $document_id[$i];
								$document_tmp_name   = $_FILES['files']['tmp_name'][$i];

     								if($document_tmp_name){
     									
     									if(move_uploaded_file($document_tmp_name, "../../../" . documents_uploading_folder . $document_name[$i]  . $ext[0] )){
     											
     											$uploading_complete = true;
     									}
     									else{
     											//file couldn't be uploaded
												//using javascript to show error box
												echo "
													<script type='text/javascript'>
  														document_upload_return_error(file_upload_stoped_error);
													</script>
												";

												//to stop script from updating data
												$uploading_complete = false;
     									}
     								}
     								else{
     									
     									//file don't exist in temp storage
										//using javascript to show error box
										echo "
												<script type='text/javascript'>
  														document_upload_return_error(file_notfound_error);
												</script>
											";

										//to stop script from updating data
										$uploading_complete = false;
     								}
							}

						//upload info to db only if 
						//uploading of all data is complete
						if($uploading_complete){

								for($i = 0; $i < $total_files; $i++){

									//to get file extension
									preg_match('/\.[^\.]+$/i', $_FILES['files']['name'][$i] ,$ext);

									$server_file_name = $document_name[$i];
									$file_name 		  = preg_replace('/\\.[^.\\s]{3,4}$/', '', $_FILES['files']['name'][$i]);
									$file_size 		  = filesize("../../../" . documents_uploading_folder . $document_name[$i] . $ext[0]);
									$file_extension   = substr($ext[0],1);
									$file_type		  = $_FILES['files']['type'][$i];
									$doc_id 		  = $document_id[$i];


									 $code = "INSERT INTO `$db_name`.`documents` (
																`DOCUMENT_ID`, 
																`OWNER_ID`, 
																`SERVER_FILE_NAME`, 
																`FILENAME`, 
																`FILE_SIZE`,
																`FILE_EXTENSION`,
																`FILE_TYPE`,
																`DATE_OF_UPLOAD`) 
											VALUES 
											('$doc_id', '$user_id', '$server_file_name', '$file_name' , $file_size , '$file_extension' , '$file_type' , CURRENT_TIMESTAMP);";

									//running code
									mysqli_query($connect , $code);
								}	
				
								echo "Uploaded successfully.";
												
						}
	
				

		}			
	else{
		
		//information coming from session is incomplete
		//using javascript to show error box
		echo "
			<script type='text/javascript'>
  				document_upload_return_error(incomplete_info_error);
			</script>
			";

			


	}
}
else{
	
	//session of user don't exist
	//session don't exist 
	 //destroy session 
     session_destroy();
     //error of session not set 
     //send user back to sign in page
     header("location:" . signin . "error/005");
}

?>