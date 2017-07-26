<?php
session_start();

//this is to highlight the name of page in nevigation
$page_name = "documents";

//bundle.inc is bundle of comman includes
include "../includes/bundle.inc.php";


?>
<!DOCTYPE html>
<html>
<head>
	<title>
		<?php echo $lang['documents'] ?> | <?php echo ucfirst(app_name); ?>
	</title>

	

	  <?php 
	  		include "../includes/fragments/webapp/header-files.fragment.php";
	  ?>
	  
	  
    <link rel="stylesheet" type="text/css" href="<?php echo style_app; ?>documents_upload-ui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo style_app; ?>table-ui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo style_app; ?>documents-ui.css">

    <script type="text/javascript" src="<?php echo script; ?>form-check.js"></script>
    <script type="text/javascript" src="<?php echo script_app; ?>documents_upload.js"></script>
    <script type="text/javascript" src="<?php echo script_app; ?>documents.js"></script>





</head>
<body>
 		
		<?php 

		 include "../includes/fragments/webapp/background.fragment.php"; 

		 include "../includes/fragments/webapp/topbar.fragment.php";

		 include "../includes/fragments/webapp/leftmenu.dashboard.fragment.php";

		?>
 	    
 	    <div class="body_frame scroll_object">
    				
          <?php 

             if(allow_service){

          ?>

            <form method="post" action="<?php echo action_app; ?>documents_upload.php" id="documents_upload" enctype="multipart/form-data" >
    					<div class="documents_drop_area effect_slide_top_1">
                  <input type="file" name="files[]" id="files" class="document_file_input" multiple >
                  
                  <div class="below_file_input">
                    <img class='upload_image' src="<?php echo image_icon ?>document_upload.png">

                    <div class="documents_drop_area_message"><?php echo $lang['document_upload_line']; ?></div>
                  </div>

                    <input type='submit' class='submit_button upload_button' id="documents_upload_button" value="<?php echo $lang['upload']; ?>">

    					</div>
            </form>

          <?php 
            }
          ?>




          <div class="document_body draggable effect_slide_left_2 box_body">

          <div class="box_body_top">
              <div class="box_heading draggable_mover document_heading capital">
                 <img src='<?php echo image_icon; ?>app_documents.png' title="<?php echo $lang['documents']; ?>">  <?php echo $lang['documents']; ?>
              </div>
          </div>

    					<div class="list_display_box table  ">

    							<div class='table_head  capital'>
                        
                        <div class="table_head_title title_1">
                            #
                        </div>
    								    <div class="table_head_title title_2">
    										    <?php echo $lang['title file name']; ?>
    								    </div>
    								    <div class="table_head_title title_3">
    										    <?php echo $lang['title options']; ?>
    							     	</div>

    							</div>
    							<div class="table_body">

                            <?php
                                //user id of current user
                                $user_id        = $_SESSION[app_name . "user_id"];

                                //to get the no of documents uploaded by user
                                $code_get_documents   = "SELECT * from `$db_name`.`documents` WHERE OWNER_ID = '$user_id' ORDER BY `FILENAME` DESC ";
                                $result_get_document  = mysqli_query($connect , $code_get_documents);
                                $no_of_documents      = mysqli_num_rows($result_get_document);

                                if($no_of_documents != 0)
                                {   
                                    //to display the list
                                    $list_no = 1;
                                   while ($_DOCUMENT = mysqli_fetch_array($result_get_document)) 
                                   {
                                      
                                          $file_id          = $_DOCUMENT['DOCUMENT_ID'];
                                          $server_file_name = $_DOCUMENT['SERVER_FILE_NAME'];
                                          $filename         = $_DOCUMENT['FILENAME'];
                                          $file_size        = $_DOCUMENT['FILE_SIZE'];
                                          $file_extension   = $_DOCUMENT['FILE_EXTENSION'];
                                          $date_of_upload   = $_DOCUMENT['DATE_OF_UPLOAD'];

                                         

                                          if( (($file_size/1024)/1024) < 1)
                                            {
                                                $file_size = number_format( (float)($file_size/1024) , 2, '.', '') . " KB ";
                                            }
                                          else
                                           {
                                              $file_size = number_format( (float)(($file_size/1024)/1024) , 2, '.', '') . " MB ";
                                           }

                            ?>
                                     <div class="table_body_item" id="list_item_<?php echo $list_no; ?>">
                                        
                                        <div class="table_body_item_detail title_1">
                                                <?php echo $list_no; ?>
                                        </div>
                                        
                                        <div class="table_body_item_detail title_2 overflow list_file_name" id="filename_display_<?php echo $list_no; ?>">
                                                <?php echo "$filename.$file_extension"; ?>
                                                
                                        </div>
                                        
                                        <input type="hidden" value='<?php echo $filename; ?>' id='filename_<?php echo $list_no; ?>'>
                                        
                                        <div class="table_body_item_detail table_options_box title_3">
                                               
                                               <div class="table_detail_option tooltip_object pop_up_open" id="show_details_<?php echo $list_no; ?>" >
                                                 
                                                   <img src="<?php echo image_icon; ?>documents_information.png">
                                                   <div class='tooltip_box table_tooltip_box'>
                                                        <?php echo $lang['details']; ?>
                                                   </div>

                                               </div>

                                               <div class="table_detail_option tooltip_object pop_up_open" id="delete_<?php echo $list_no; ?>">
                                                   <img src="<?php echo image_icon; ?>documents_delete.png">
                                                   <div class='tooltip_box table_tooltip_box'>
                                                        <?php echo $lang['delete']; ?>
                                                   </div>
                                               </div>

                                               <div class="table_detail_option tooltip_object pop_up_open" id="edit_<?php echo $list_no ?>">
                                                   <img src="<?php echo image_icon; ?>documents_edit.png">
                                                   <div class='tooltip_box table_tooltip_box'>
                                                        <?php echo $lang['edit']; ?>
                                                   </div>
                                               </div>

                                               <a href="<?php echo url . documents_uploading_folder . "$server_file_name.$file_extension"?>" download="<?php echo $filename . '.' . $file_extension; ?>">
                                                   <div class="table_detail_option tooltip_object">
                                                        <img src="<?php echo image_icon; ?>documents_download.png">
                                                         <div class='tooltip_box table_tooltip_box'>
                                                                <?php echo $lang['download']; ?>
                                                          </div>
                                                    </div>
                                               </a>

                                                <script type="text/javascript">

                                                  $("#delete_<?php echo $list_no; ?>").click(function(){

                                                      //set the title of pop up
                                                      $(".pop_up_title").html("<?php echo $lang['delete']; ?>");

                                                      //set the content
                                                      $(".pop_up_body").html( "<div class='delete_action'></div>" +
                                                                              "<div class='delete_line overflow'>" +
                                                                                  "<?php echo $lang['delete permission']; ?> '" +
                                                                                        "<span class='delete_item' id='delete_item_<?php echo $list_no; ?>'></span>'?" +
                                                                              "</div>" +
                                                                              "<div class='permission_line'>" +
                                                                                   "<input type='button' class='cancel_button pop_permission_button' id='cancel_delete_button_<?php echo $list_no; ?>' value='<?php echo $lang['no']; ?>'>" +
                                                                                   "<input type='button' class='submit_button pop_permission_button' id='allow_delete_button_<?php echo $list_no; ?>' value='<?php echo $lang['yes']; ?>'>" +
                                                                              "</div>"
                                                                             );

                                                              //set the value of new file input 
                                                              //getting value from the hidden input at file name display
                                                              var current_filename = document.getElementById('filename_<?php echo $list_no; ?>').value;
                                                              
                                                              //to print the name of file in span box
                                                              $('#delete_item_<?php echo $list_no; ?>').html(current_filename + '<?php echo ".$file_extension"; ?>');
                                                     
                                                     $('#cancel_delete_button_<?php echo $list_no; ?>').click(function(){
                                                           effect_pop_hide();
                                                     });

                                                     $("#allow_delete_button_<?php echo $list_no; ?>").click(function(){

                                                            var response_box = $(".delete_action");
                                                            
                                                                 response_box.show(); 

                                                             $.post("<?php echo action_app; ?>documents_delete.php"  , {file_name:"<?php echo $server_file_name; ?>",file_extension:"<?php echo $file_extension; ?>",file_id:"<?php echo $file_id; ?>"} , function(response){
                                                                          
                                                                      response_box.html(response);
                                                                        
                                                                      effect_pop_hide();

                                                                      setTimeout(function(){
                                                                          $("#list_item_<?php echo $list_no; ?>").hide("drop" , {direction:"right"} , 300);

                                                                      },200);
                                                                          
                                                              });
                                                     });

                                                  });

                                                
                                                </script>
             

                                               <script type="text/javascript">

                                                      $("#edit_<?php echo $list_no; ?>").click(function(){

                                                            //set the title of pop up
                                                            $(".pop_up_title").html("<?php echo $lang['edit']; ?>");

                                                            //set the content of pop up body
                                                            $(".pop_up_body").html( "<form method='post' id='pop_up_edit' action='<?php echo action_app; ?>documents_edit.php'>"+
                                                                                      "<div class='pop_up_error_box'>Error</div>" + 
                                                                                      "<div class='pop_up_success_box'>Saving...</div>" +
                                                                                      "<div class='pop_item'>" + 
                                                                                        "<div class='pop_item_label overflow'><?php echo $lang['new filename']; ?>:</div>" +
                                                                                        "<div class='pop_item_details'>" +
                                                                                            "<input type='hidden' name='file_id' value='<?php echo $file_id; ?>' >" +
                                                                                            "<input type='filename' name='new_filename' value='' id='new_filename_<?php echo $list_no; ?>' class='input pop_input' placeholder='ex:- bank statement' autocomplete='off'>" +
                                                                                            "<div class='pop_item_details_extra'>.<?php echo $file_extension ?></div>" +
                                                                                        "</div>" +
                                                                                      "</div>" +
                                                                                    
                                                                                      "<input type='submit' value='<?php echo $lang['save']; ?>' id='save_edit_<?php echo $list_no; ?>' class='submit_button pop_submit'>" +
                                                                                    "</form>"
                                                              );

                                                              //set the value of new file input 
                                                              //getting value from the hidden input at file name display
                                                              var current_filename = document.getElementById('filename_<?php echo $list_no; ?>').value;
                                                              
                                                              document.getElementById('new_filename_<?php echo $list_no; ?>').value = current_filename;

                                                          //save the edit 
                                                          $("#save_edit_<?php echo $list_no; ?>").click(function(){
                                                                      
                                                                  var new_filename = document.getElementById("new_filename_<?php echo $list_no; ?>").value;
                                                                  

                                                                  var response_box = $(".pop_up_success_box");
                                                                  var error_box    = $(".pop_up_error_box");

                                                                  
                                                                  if(new_filename.length == 0)
                                                                  {
                                                                      error_box.slideDown();
                                                                      response_box.hide();
                                                                      error_box.html("Filename can not be empty.");
                                                                  }
                                                                  else if(!filename_validity(new_filename))
                                                                  {
                                                                      error_box.slideDown();
                                                                      response_box.hide();
                                                                      error_box.html("Filename can only have alphabets , numbers and _ - . only.");
                                                                  }
                                                                  else
                                                                  {   
                                                                      error_box.hide();
                                                                      response_box.slideDown(); 

                                                                      $.post($("#pop_up_edit").attr("action")  , {new_filename:new_filename,file_id:"<?php echo $file_id; ?>"} , function(response){
                                                                          response_box.html(response);
                                                                         
                                                                          $("#filename_display_<?php echo $list_no; ?>").html(new_filename + ".<?php echo $file_extension; ?>");

                                                                          document.getElementById('filename_<?php echo $list_no; ?>').value = new_filename;

                                                                              setTimeout(function(){
                                                                                    
                                                                                    response_box.slideDown(); 
                                                                                    effect_pop_hide();
                                                                              
                                                                              },1000);

                                                                      });
                                                                  }

                                                              return false;
                                                           });

                                                      });



                                                </script>



                                                <script type="text/javascript">

                                                          $("#show_details_<?php echo $list_no; ?>").click(function(){

                                                                $(".pop_up_title").html("<?php echo $lang['file details']; ?>");
                                                               
                                                                $(".pop_up_body").html("<div class='pop_item'>" +
                                                                                             "<div class='pop_item_label capital overflow'><?php echo $lang['file name']; ?>:</div>" +
                                                                                              "<div class='pop_item_details  details_file_name'><?php echo $filename; ?></div>"+
                                                                                       "</div>" +

                                                                                       "<div class='pop_item'>" +
                                                                                             "<div class='pop_item_label capital overflow'><?php echo $lang['file size']; ?>:</div>" +
                                                                                              "<div class='pop_item_details '><?php echo  $file_size; ?></div>"+
                                                                                       "</div>" +

                                                                                       "<div class='pop_item'>" +
                                                                                             "<div class='pop_item_label capital overflow'><?php echo $lang['file type']; ?>:</div>" +
                                                                                              "<div class='pop_item_details '><?php echo $file_extension; ?></div>"+
                                                                                       "</div>" +

                                                                                       "<div class='pop_item'>" +
                                                                                             "<div class='pop_item_label capital overflow'><?php echo $lang['upload date']; ?>:</div>" +
                                                                                              "<div class='pop_item_details '><?php echo $date_of_upload; ?></div>"+
                                                                                       "</div>"
                                                                                       );

                                                                $('.details_file_name').html(document.getElementById('filename_<?php echo $list_no; ?>').value);

                                                          });
                                                </script>
                                        </div>
                                     </div>

                            <?php 
                                    $list_no++;
                                    }//end of while
                                }//end of main if
                                else
                                {

                            ?>  
                                                     
                                    <div class='table_body_empty capital'>
                                        <?php echo $lang['no file message']; ?>
                                    </div>
                                  
                            <?php 
                                }//end of else
                            ?>
    								

                               

                                     



    							</div>

    				 	</div>
            </div>
    					

 	    </div>



</body>
</html>