<?php
/************************************************
this script is to update profile settings of user 

creator:- Raman tehlan
date of creation:- 30/11/2016
************************************************/

session_start();

//define.inc define the basic terms
include "../../define.inc.php";

//include important files
//connect.inc to connect to database
include "../../connect.inc.php";

//to decode the data to print it again
include "../../decoder.lib.php";
$decode = new decoder();

//check if session exist
if(isset($_SESSION[app_name . 'session_name']))
{
	//check if all post values are coming
	if(isset($_POST['company_name']) && isset($_POST['industry']) && isset($_POST['tax_id'])  && isset($_POST['address']) && isset($_POST['street']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['zip']) && isset($_POST['phone']) && isset($_POST['contact_email']) && isset($_POST['website']))
	{
		//flag to check if data can be updated in database
		$allow_update = true;


		//SESSION id FOR REFERENCE
		//used in code to refer
		$user_id = $_SESSION[app_name . "user_id"];

		if(isset($_FILES['logo']))
		{
				//getting file details
				$logo_file_name  = rand(1000,100000000) . "_" . rand(1000,100000000) . "_" .  rand(1000,1000000000) . "_" . rand(10000,10000000000) . ".jpg";
				$file_tmp_name   = $_FILES['logo']['tmp_name'];
     			$file_type       = $_FILES['logo']['type'];

     			//path to storing location
     			$path = "../../../";


     				//temp file exist
     				if($file_tmp_name)
     				{
     					if(move_uploaded_file($file_tmp_name, $path . logo_uploading_folder . "original/" . $logo_file_name))
     					{	
     						//delete old profile pictures if allowed
     						if(allow_logo_delete){
     							//check if logo is there or not
     							$code_for_logo = mysqli_query($connect , "SELECT * from `$db_name`.`users`  WHERE `users`.`ID` = '$user_id' and LOGO != '';");
     							$no_of_logo = mysqli_num_rows($code_for_logo);

     							if($no_of_logo == 1){

     									//get current/old logo id
     									$get = mysqli_fetch_array($code_for_logo);
     									$current_logo = $get['LOGO'];

     									//check if logo exists
     									if(file_exists($path . logo_uploading_folder . "original/" . $current_logo) == true){
     										//delete old logo
     										unlink($path . logo_uploading_folder . "original/" . $current_logo);
     										unlink($path . logo_uploading_folder . "large/" . $current_logo);
     										unlink($path . logo_uploading_folder . "medium/" . $current_logo);
     										unlink($path . logo_uploading_folder . "small/" . $current_logo);
     									}
     							}

     						}


     						//library to resize and crop logos
     						include "../../image_process.lib.php";

						 /* this is for the type of file */
                       $p_type = $file_type;
                       /* this is just to use library */
                       $image_process = new image_process();  
                       /* this is to get height and width of image upload */
                       list($width,$height) = getimagesize( $path . logo_uploading_folder . "original/" . $logo_file_name);
                       /* this is location of original file */
                       $main_file  = $path . logo_uploading_folder . "original/" . $logo_file_name;
                       /* this is temp file for maiking thumb */
                       // Create a temporary file in the temporary 
					   // files directory using sys_get_temp_dir()
					   $tmp_file = tempnam(sys_get_temp_dir(), 'logo');
                       /* this is max height for tmp file */
                       $hmax       = 1000;
                       /* these are path for storing img thumb */
                       $large_thumb   = $path . logo_uploading_folder . "large/" . $logo_file_name;
                       $medium_thumb  = $path . logo_uploading_folder . "medium/" . $logo_file_name;
                       $small_thumb   = $path . logo_uploading_folder . "small/" . $logo_file_name;
                       /* size for img thumb */
                       $l_width  = 200;
                       $l_height = 200;

                       $m_width  = 50;
                       $m_height = 50;

                       $s_width  = 32;
                       $s_height = 32;
                       
                       /* this is for the large image upload */           
                       
                       if($width > $height)
                           {$wmax = 300;}
                      else
                           {$wmax = 200;}
                       
                       $image_process -> img_resize($main_file, $tmp_file, $wmax, $hmax, $p_type);
                       $image_process -> img_thumb($tmp_file, $large_thumb, $l_width, $l_height, $p_type);
                       
                      
                      /* this is for the midium image upload */
                        
                       if($width > $height)
                           {$wmax = 75;}
                      else
                           {$wmax = 50;}
                        
                        $image_process -> img_resize($main_file, $tmp_file, $wmax, $hmax, $p_type);
                        $image_process -> img_thumb($tmp_file, $medium_thumb, $m_width, $m_height, $p_type);
                        

                      /* this is for the small image upload */
                         if($width > $height)
                           {$wmax = 48;}
                        else
                           {$wmax = 32;}
                        
                        $image_process -> img_resize($main_file, $tmp_file, $wmax, $hmax, $p_type);
                        $image_process -> img_thumb($tmp_file, $small_thumb, $s_width, $s_height, $p_type);
                        unlink($tmp_file);


     								//logo has been successfully uploaded			
									$allow_update = true;


     					}
     					else
     					{
     						//file couldn't be uploaded
							//using javascript to show error box
							echo "
								<script type='text/javascript'>
  									return_error(file_upload_stoped_error);
								</script>
							";

							//to stop script from updating data
							$allow_update = false;
     					}
     				}
     				else
     				{
     					//file don't exist in temp storage
						//using javascript to show error box
						echo "
							<script type='text/javascript'>
  								return_error(file_notfound_error);
							</script>
						";

						//to stop script from updating data
						$allow_update = false;
     				}

		}
			
			if($allow_update)
			{
	
				//post values
        $company_name   = addslashes(htmlentities($_POST['company_name']));
        $industry   = $_POST['industry'];
				$tax_id		 	= $_POST['tax_id'];
				$address		= addslashes(htmlentities($_POST['address']));
				$street			= addslashes(htmlentities($_POST['street']));
				$city		   	= addslashes(htmlentities($_POST['city']));
				$state			= addslashes(htmlentities($_POST['state']));
        $zip        = ($_POST['zip'] != 0)? $_POST['zip'] : "NULL";
        $phone      = ($_POST['phone'] != 0)? $_POST['phone'] : "NULL";
				$contact_email	= $_POST['contact_email'];
				$website		= $_POST['website'];

        //
        $company_name_n = $_POST['company_name'];
        $industry_n   = $decode -> industry($_POST['industry']);
        $address_n    = $_POST['address'];
        $street_n     = $_POST['street'];
        $city_n       = $_POST['city'];
        $state_n      = $_POST['state'];
        $zip_n        = $_POST['zip'];
        $phone_n      = $_POST['phone'];

				
				//code to enter data to database	
				//code is to be set according to the file uploaded or not			
				if(isset($_FILES['logo']))
				{	//logo name to be changed
					$logo_space = ", `LOGO` = '$logo_file_name'";

          $logo_url = image_company_logo . "medium/" . $logo_file_name;
          $logo_url_large = image_company_logo . "large/" . $logo_file_name;
          $script_line = "<script type='text/javascript'>
                            
                                  document.getElementById('logo_content').src = '$logo_url_large';

                                  $('.remove_logo_holder').html(" . '"' . "<div class='removing_logo_box' onclick='remove_logo()'>" .  '"' . " +" . 
                                   '"' . "<img src = '$logo_url' class='small_logo_icon'> Remove " . '"' . "+" . 
                                        '"' . "</div>" . '"'  . ");

                      </script>";
				}
				else
				{
					//logo name not to be changed
					$logo_space = "";
          $script_line = "";
				}

        /***********************************************
        this is to update the display data
        ************************************************/
        $location_content = "";
        $phone_content = "";
        $currency_content = $decode -> currency('INR');
             
              if($address_n != ''){ $location_content .= $address_n . " "; }
              if($street_n != ''){ $location_content .= $street_n . " "; } 
              if($city_n != ''){ $location_content .= $city_n . " "; }
              if($state_n != ''){ $location_content .= $state_n . " "; } 
              if($zip_n != ''){ $location_content .= $zip_n . " "; } 

        if($phone_n != ''){ 
          $phone_content = $decode -> phone_code("IN") . " " . $phone_n; }
        else{
            $phone_content = "-";
        }

        $comman_script = "<script type='text/javascript'>
                            $('.location_content').html('$location_content');
                            $('.phone_content').html('$phone_content');
                            $('.email_content').html('$contact_email');
                            $('.website_content').html('<a href='" . $protocol . $website . "'>$website</a>');
                            $('.industry_content').html('$industry_n');
                            $('.tax_content').html('$tax_id');
                            $('.currency_content').html('$currency_content');
                            $('.company_content').html('$company_name_n');
        </script>";

				$code = "UPDATE `$db_name`.`users` SET `COMPANY_NAME` = '$company_name', `WEBSITE` = '$website', `INDUSTRY` = '$industry', `TAX_ID` = '$tax_id', `ADDRESS` = '$address', `STREET` = '$street', `CITY` = '$city', `STATE` = '$state', `ZIP` = $zip $logo_space , `CONTACT_PHONE` = $phone , `CONTACT_EMAIL` = '$contact_email' WHERE `users`.`ID` = '$user_id';";
				

				//running code
				mysqli_query($connect , $code);

				//printing message
				echo "Successfully Saved $script_line $comman_script";

			}		
				


							
		
	}
	else
	{
		//information coming from session is incomplete
		//using javascript to show error box
		echo "
			<script type='text/javascript'>
  				return_error(incomplete_info_error);
			</script>
			";
	}
}
else
{
	//session of user don't exist
	//session don't exist 
   //destroy session 
     session_destroy();
     //error of session not set 
     //send user back to sign in page
     header("location:" . signin . "error/005");
}

?>