<?php
session_start();

//this is to highlight the name of page in nevigation
$page_name = "profile";


//bundle.inc is bundle of comman includes
include "../includes/bundle.inc.php";


//this is to create a flag for page to tell if 
//session is on or off
$allow_session = false;
if(isset($_SESSION[app_name . 'session_name'])){
    if($_SESSION[app_name . 'session_name'] == $session_name_signin){
            $allow_session = true;
    }
}


//this is to check if the user id is defined or not 
//show_profile is flag to tell if profile exist or not
$show_profile = false;
//profile_access is flag to tell if profile is of active session user or not
$profile_access = false;
if(isset($_GET['user_id'])){
    $session_check_code = mysqli_query($connect , "SELECT * from `$db_name`.`users` where `ID` = '" . $_GET['user_id'] . "';");

    if(mysqli_num_rows($session_check_code) > 0){
        $show_profile = true;
         //include user info
        include "../includes/define_user_info.inc.php";

        //the profile is viewed when session is on
        if($allow_session){
            //this it is true
            //this user is viewing his onw profile
            //else he is viewing someone else id
            if($_SESSION[app_name . 'user_id'] == $_GET['user_id']){
                $profile_access = true;
            }else{
                $profile_access = false;
                $page_name = "other_profile";
            }   
        }

    }else{
        $show_profile = false;
        $page_name = "other_profile";
    }
}else{
    $show_profile = false;
    $page_name = "other_profile";
}



?>
<!DOCTYPE html>
<html>
<head>
	<title>
		 <?php echo $lang['profile']; ?> | <?php echo ucfirst(app_name); ?>
	</title>

	

	  <?php 
	  		include "../includes/fragments/webapp/header-files.fragment.php";
	  ?>
	  
	  
      
	   <link rel="stylesheet" type="text/css" href="<?php echo style_app; ?>form-ui.css">
        <link rel="stylesheet" type="text/css" href="<?php echo style_app; ?>profile-ui.css">
        <?php 
             if(!$allow_session){
                echo "<link rel='stylesheet' href='" . style . "comman-ui.css'>";
                echo "<link rel='stylesheet' href='" . style . "top-ui.css'>";
             }
        ?>

           <script type="text/javascript" src="<?php echo script; ?>form-check.js"></script>
            <script type="text/javascript" src="<?php echo script_app; ?>profile-edit.js"></script>

        <?php 
                if($allow_session && $profile_access){
                ?>
             <script type='text/javascript' >
                         $(document).ready(function(){
                                
                                 <?php 

                                    if(isset($INDUSTRY))
                                        {
                                            if(!is_null($INDUSTRY))
                                            {echo "$('#industry').val('$INDUSTRY');";}
                                        }
                             ?>


        //to show edits
        $(".show_profile_edit").click(function(){

                //to scroll to top
                window.scrollTo(0, 0);
                //to hide
                $(".front_content").hide("drop", {direction:"right"} , 400);

                setTimeout(function(){
                        
                        $(".profile_edit_form").show("drop" , {direction:"left"} , 400);
                        $(".close_all_button").show("drop" , {direction:"left"} , 400);
                },500);
                


        });

        //to hide edits
        $(".close_all_button").click(function(){

            //to scroll to top
            window.scrollTo(0, 0);
            //to hide
            //here it is 400 cause it take time to scrool up
            $(".profile_edit_form").hide("drop" , {direction:"left"} , 400);
            $(".close_all_button").hide("drop" , {direction:"left"} , 400);

                    setTimeout(function(){

                    $(".front_content").show("drop", {direction:"right"} , 400);

            },500);

        });


});
                 </script>

                 <?php 
                    }
                 ?>
</head>
<body>
 		
		<?php 

        if($allow_session){
		           include "../includes/fragments/webapp/background.fragment.php";
                   include "../includes/fragments/webapp/topbar.fragment.php";
                   include "../includes/fragments/webapp/leftmenu.dashboard.fragment.php";
        }else{
            include "../includes/fragments/top.fragment.php";
        }

		?>
 	    
 	    <div class="body_frame scroll_object">

              <?php 

                    
        if($allow_session && $profile_access){
                   
                    ?>

            <div class="close_all_button hide" >
                <img src="<?php echo image_icon; ?>app_close.png">
            </div>


            <div class="box_body dark_box_body hide profile_edit_form">
    				    
                <div class="box_body_top">
                    <div class="settings_title box_heading capital ">
                            <img src="<?php echo image_icon ?>app_profile.png">
                             <?php echo $lang['company profile']; ?>
                    </div>
                </div>
                    
                    <div class="form_box">

                        <form method="post" enctype='multipart/form-data' action="<?php echo action_app; ?>profile_edit.php" id='settings_profile_form'>

                            <div class="error_box"><?php echo $lang['error']; ?></div>
                            <div class="success_box">Successfully Saved</div>

                           

                            <div class="form_box_row">
                                    <div class="form_box_row_title">
                                            <?php echo $lang['company name']; ?>*
                                    </div>
                                    <div class="form_box_row_field">
                                        <input type='company_name' class="input" id="company_name" name="company_name" value="<?php echo $COMPANY_NAME; ?>" placeholder='<?php echo $lang['company name']; ?>' maxlength="70">
                                    </div>
                            </div>

                             <div class="form_box_row logo_upload_row">
                                    <div class="form_box_row_title">
                                           <?php echo $lang['company logo']; ?>
                                    </div>
                                    <div class="form_box_row_field">
                                        <input type='file' class="input logo_upload" id="logo" name="logo" placeholder="<?php echo $lang['company logo']; ?>" maxlength="255">

                                        <input type="hidden" value="<?php echo action_app; ?>delete_logo.php" class="removing_logo_url">
                                   
                                             <span class='remove_logo_holder'>
                                                 <?php 
                                                        if($LOGO != ""){
                                                    ?>
                                                    <div class="removing_logo_box">
                                            
                                                    <img src='<?php echo image_company_logo; ?>medium/<?php echo $LOGO; ?>' class='small_logo_icon'><?php echo $lang['remove']; ?>
                                                    </div>
                                                 <?php 
                                                        }
                                                    ?>
                                            </span>

                                            <div class="delete_display_box">

                                            </div>

                                        <div class="logo_row_details">
                                            <?php echo $lang['logo instruction']; ?>
                                        </div>


                                    </div>

                                   

                                   
                            </div>

                            <div class="form_box_row">
                                    <div class="form_box_row_title">
                                            <?php echo $lang['industry']; ?>
                                    </div>
                                    
                                    <div class="form_box_row_field">
                                        
                                         <select type="industry" id="industry" name="industry" class="input select_input">
                                     
                                              <option value=""><?php echo $lang['select']; ?></option>
                                        <option value="i1"><?php echo $lang['industry_i1']; ?></option>
                                        <option value="i2"><?php echo $lang['industry_i2']; ?></option>
                                        <option value="i3"><?php echo $lang['industry_i3']; ?></option>
                                        <option value="i4"><?php echo $lang['industry_i4']; ?></option>
                                        <option value="i5"><?php echo $lang['industry_i5']; ?></option>
                                        <option value="i6"><?php echo $lang['industry_i6']; ?></option>
                                        <option value="i7"><?php echo $lang['industry_i7']; ?></option>
                                        <option value="i8"><?php echo $lang['industry_i8']; ?></option>
                                        <option value="i9"><?php echo $lang['industry_i9']; ?></option>
                                        <option value="i10"><?php echo $lang['industry_i10']; ?></option>
                                        <option value="i11"><?php echo $lang['industry_i11']; ?></option>
                                        <option value="i12"><?php echo $lang['industry_i12']; ?></option>
                                        <option value="i13"><?php echo $lang['industry_i13']; ?></option>
                                        <option value="i14"><?php echo $lang['industry_i14']; ?></option>
                                        <option value="i15"><?php echo $lang['industry_i15']; ?></option>
                                        <option value="i16"><?php echo $lang['industry_i16']; ?></option>
                                        <option value="i17"><?php echo $lang['industry_i17']; ?></option>
                                        <option value="i18"><?php echo $lang['industry_i18']; ?></option>
                                        <option value="i19"><?php echo $lang['industry_i19']; ?></option>


                                        </select>
                                    </div>
                            </div>

                            <div class="form_box_row">
                                        <div class="form_box_row_title">
                                           <?php echo $lang['tax id']; ?>
                                         </div>
                                         <div class="form_box_row_field">
                                           <input type='tax_id' class="input" id="tax_id" name="tax_id" value="<?php echo $TAX_ID; ?>" >
                                         </div>
                            </div>

                            <div class="form_box_row address_row">
                                    <div class="form_box_row_title">
                                            <?php echo $lang['location']; ?>
                                    </div>
                                    <div class="form_box_row_field address_fields">
                                        <input type='address' placeholder="<?php echo $lang['address']; ?>" class="input" id="address" name="address" value="<?php echo $ADDRESS; ?>" maxlength="50" >

                                        <input type='street' placeholder="<?php echo $lang['street']; ?>" class="input" id="street" name="street" value="<?php echo $STREET; ?>" maxlength="50">

                                        <input type='city' placeholder="<?php echo $lang['city']; ?>" class="input" id="city" name="city" value="<?php echo $CITY; ?>" maxlength="30">

                                        <input type='state' placeholder="<?php echo $lang['state']; ?>" class="input" id="state" name="state" value="<?php echo $STATE; ?>" maxlength="50">

                                        <input type='zip' placeholder="<?php echo $lang['zip']; ?>" class="input" id="zip" name="zip" value="<?php echo $ZIP; ?>" maxlength="20">

                                    </div>

                            </div>


                             <div class="form_box_row">
                                    <div class="form_box_row_title">
                                           <?php echo $lang['phone']; ?>
                                    </div>
                                    <div class="form_box_row_field">
                                        <input type='phone' class="input" id="phone" name="phone" value="<?php echo $CONTACT_PHONE;?>" >
                                    </div>
                            </div>

                            <div class="form_box_row">
                                    <div class="form_box_row_title">
                                           <?php echo $lang['contact email']; ?>
                                    </div>
                                    <div class="form_box_row_field">
                                        <input type='email' class="input" id="contact_email" name="contact_email" value="<?php echo $CONTACT_EMAIL; ?>" maxlength="255">
                                    </div>
                            </div>

                           <div class="form_box_row">
                                    <div class="form_box_row_title">
                                            <?php echo $lang['website']; ?>
                                    </div>
                                    <div class="form_box_row_field">
                                        <input type='website' class="input" id="website" name="website" value="<?php echo $WEBSITE; ?>" maxlength="255">
                                    </div>
                            </div>
                            
                            <br>
                            <input type="submit" value="<?php echo $lang['save']; ?>" class="submit_button" id="settings_profile_button">
                        </form>
                    </div>


                </div>


                <?php } ?>



                <?php if($show_profile){ ?>
    			<div class="profile_content_box box_body effect_slide_top_1 front_content">

                  <div class='profile_content_top'>
					 <div class='left_of_top'>
                       <div class='logo_of_company'>
				  		 <?php 
                                if($LOGO != "")
                                { 
                                     echo "<img src='" . image_company_logo . "large/$LOGO' id='logo_content'>";
                                } 
                                else
                                {
                                    echo "No Logo";
                                }
                                ?>
                        </div>

                        <div class='qr_code_box'>
                             <img src='https://chart.googleapis.com/chart?chs=120x120&cht=qr&chl=http://localhost/profile/<?php echo $_GET['user_id']; ?>&choe=UTF-8'>
                        </div>

					</div>
                    <div class="company_name company_content">
                         <?php echo $COMPANY_NAME; ?>
                    </div>
                    <?php 

                            if($allow_session && $profile_access ){
                   
                    ?>

                    <div class='box_menu'>
                                <div class='box_menu_option tooltip_object show_profile_edit'>
                                                  <img src="<?php echo image_icon; ?>account_edit.png"  alt=" <?php echo $lang['edit']; ?>">
                                                    <div class='tooltip_box box_menu_tooltip_box'>
                                                                       <?php echo $lang['edit']; ?>
                                                  </div>
                                </div>
                    </div>
                    <?php }  ?>

                     



                  </div> 

					<div class="profile_details">

    					<div class="profile_line">
    					 		<div class="profile_line_content_title">
    					 		    <div class="profile_line_image">
                                        <img src="<?php echo image_icon; ?>profile_accounter.png">
                                    </div>
                                <?php echo $lang['admin']; ?>:
    					 		</div>
    					 		<div class="profile_line_content capital">
    					 				<?php echo $FIRST_NAME . " " . $LAST_NAME; ?>
    					 		</div>

    					</div>
    					

                        <div class="profile_line">
                                
                                <div class="profile_line_content_title">
                                    <div class="profile_line_image">
                                        <img src="<?php echo image_icon; ?>profile_location.png">
                                    </div>
                                     <?php echo $lang['location']; ?>:
                                </div>
                                <div class="profile_line_content location_content">
                                        <?php if($ADDRESS != ''){ echo $ADDRESS; }?> 
                                        <?php if($STREET != ''){ echo $STREET; }?>  
                                        <?php if($CITY != ''){ echo $CITY; }?>  
                                        <?php if($STATE != ''){ echo $STATE; }?>  
                                        <?php if($ZIP != ''){ echo $ZIP; }?>  
                                        
                                </div>
                        </div>

    					

                        <div class="profile_line">
                                <div class="profile_line_content_title">
                                  <div class="profile_line_image">
                                        <img src="<?php echo image_icon; ?>profile_phone.png">
                                  </div>
                                     <?php echo $lang['phone']; ?>:
                                </div>
                                <div class="profile_line_content phone_content">
                                        <?php if($CONTACT_PHONE != '')
                                                { echo $decode -> phone_code($COUNTRY) . " " . $CONTACT_PHONE; } 
                                              else{
                                                echo "-";
                                              }
                                        ?>
                                </div>
                        </div>

                        <div class="profile_line">
                               
                                <div class="profile_line_content_title">
                                    <div class="profile_line_image">
                                         <img src="<?php echo image_icon; ?>profile_email.png">
                                    </div>
                                     <?php echo $lang['email']; ?>:
                                </div>
                                <div class="profile_line_content email_content">
                                        <?php echo $CONTACT_EMAIL;?>
                                </div>
                        </div>

                       

                        <div class="profile_line">
                                
                                <div class="profile_line_content_title">
                                     <div class="profile_line_image">
                                        <img src="<?php echo image_icon; ?>profile_link.png">
                                    </div>
                                    <?php echo $lang['website']; ?>:
                                </div>
                                <div class="profile_line_content website_content">
                                        <a href="<?php echo $protocol . $WEBSITE; ?>"><?php echo $WEBSITE; ?></a>
                                </div>
                        </div>
                       

                        <div class="profile_line">
                                <div class="profile_line_content_title">
                                    <div class="profile_line_image">
                                        <img src="<?php echo image_icon; ?>profile_industry.png">
                                    </div>
                                    <?php echo $lang['industry']; ?>:
                                </div>
                                <div class="profile_line_content industry_content">
                                    <?php echo $decode -> industry($INDUSTRY); ?>
                                </div>
                        </div>

                        <div class="profile_line">
                                <div class="profile_line_content_title">
                                    <div class="profile_line_image">
                                        <img src="<?php echo image_icon; ?>profile_tin.png">
                                    </div>
                                <?php echo $lang['dashboard tax id']; ?>:
                                </div>
                                <div class="profile_line_content tax_content">
                                    <?php echo $TAX_ID; ?>
                                </div>
                        </div>

    				</div>


    		</div>
            <?php } ?>
            



 	    </div>



</body>
</html>