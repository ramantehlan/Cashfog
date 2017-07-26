function email_validity(r){return 0==r.length?!0:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(r)}function alpha_validity(r){return 0==r.length?!0:/^[A-Za-z ]+$/.test(r)}function number_validity(r){return 0==r.length?!0:/^[0-9]+$/.test(r)}function number_amount_validity(r){return 0==r.length?!0:/^[0-9+-.]+$/.test(r)}function number_amount_validity2(r){return 0==r.length?!0:/^[0-9.]+$/.test(r)}function alphanumeric_validity(r){return 0==r.length?!0:/^[0-9a-zA-Z ]+$/.test(r)}function phonenumber_validity(r){return 0==r.length?!0:/^[0-9]+$/.test(r)}function website_validity(r){return 0==r.length?!0:/[-a-zA-Z0-9@:%_\+.~#?&\/\/=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&\/\/=]*)?/gi.test(r)}function password_validity(r){return r.length>5&&r.length<129?!0:!1}function filename_validity(r){return 0==r.length?!1:/^[0-9a-zA-Z_. -]+$/.test(r)}function companyname_validity(r){return 0==r.length?!0:!0}function progress_handler(r){var e=Math.round(r.loaded/r.total*100);$(".progress-label").html(e+"% completed"),$(function(){$("#progressbar").progressbar({value:e}),$(window).scrollTop(0)})}function complete_handler(r){$(".processing_status").html(r.target.responseText),setTimeout(function(){effect_processing_hide(),$(".error_box").is(":visible")||($(".success_box").show(),setTimeout(function(){$(".success_box").hide()},3e3))},1e3)}function error_handler(r){effect_processing_hide(),$(".error_box").show(),$(".success_box").hide(),$(".error_box").html(processing_error),$(window).scrollTop(0)}function abort_handler(r){effect_processing_hide(),$(".error_box").show(),$(".error_box").html(aborted_error),$(window).scrollTop(0)}function return_error(r){$(".error_box").show(),$(".error_box").html(r),$(".progress-label").html("0 % completed"),$(function(){$("#progressbar").progressbar({value:0})}),$(".processing_status").html(processing_error),$(window).scrollTop(0)}function return_pop_error(r){$(".pop_up_error_box").show(),$(".pop_up_error_box").html(r)}function throw_error(r,e,o){e.hide(),r.show(),r.html(o),$(window).scrollTop(0)}var max_size_uplod=1024,max_document_size=4096,empty_field_error="Mandatory fields (fields with *) can't be empty",empty_password_field_error="Password can't be empty",alpha_field_error=" can have only alphabet(s)",number_field_error=" can have only number(s)",alphanumber_field_error=" can have only numbers and alphabets",email_field_error="Enter a valid email",phone_field_error="Enter a valid phone number(s)",website_field_error="Invalid website! example: http://www.sitename.com",recaptcha_field_error="recaptcha is mandatory to check",password_field_error="password length should be 6 - 128",password_matching_error="Retype password don't match new password",dob_field_error="Your age must be above 13",img_type_error="Image should be of type jpeg/jpg/jpe/png only",img_size_error="Image size should be less then "+max_size_uplod/1024+"MB",password_same_error="Current and new password shouldn't be same",companyname_field_error="",aborted_error="Process aborted",processing_error="Process interrupted",nosession_error="Sign in session don't exist",incomplete_info_error="Incomplete information sent",email_exist_error="Email already exist! try with different email",file_notfound_error="Uploaded file not found! upload again",file_upload_stoped_error="File uploading interrupted! try again",password_wrong_error="Current password is wrong",error_000="Unknown error! try again",error_001="Email already registered",error_002="Broken information found",error_003="Session was destroyed",error_004="Email or Password is incorrect",error_005="Signin First";