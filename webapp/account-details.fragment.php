<div class="details_box_body account_body  hide">
    												<div class="account_details_box_list group_1">
    														<div class="account_details_box_list_title capital">
    																<div class="account_details_box_list_title_icon">
                                                                            <img src="<?php echo image_icon; ?>profile_accounter.png">
                                                                    </div>
                                                                    <?php echo $lang['primary contact']; ?>:
    														</div>
    														<div class="account_details_box_list_body capital">
    																<?php echo  $l_contact_name; ?>
    														</div>
    												</div>

    												<div class="account_details_box_list group_1">
    														<div class="account_details_box_list_title capital">
                                                                    <div class="account_details_box_list_title_icon">
                                                                            <img src="<?php echo image_icon; ?>profile_location.png">
                                                                    </div>
    																<?php echo $lang['address']; ?>:
    														</div>
    														<div class="account_details_box_list_body capital">
    																  <?php echo "$l_address $l_street $l_city $l_state $l_zip " . $decode -> country($l_country); ?>
    														</div>
    												</div>

                                                    <div class="account_details_box_list group_1">
                                                            <div class="account_details_box_list_title capital">
                                                                    <div class="account_details_box_list_title_icon">
                                                                            <img src="<?php echo image_icon; ?>profile_due_days.png">
                                                                    </div>
                                                                    <?php echo $lang["due days"]; ?>:
                                                            </div>
                                                            <div class="account_details_box_list_body">
                                                                    <?php echo ($l_due_days != 0)? $l_due_days : "-"; ?>
                                                            </div>  
                                                    </div>

                                                    <div class="account_details_box_list group_1">
                                                            <div class="account_details_box_list_title capital">
                                                                    <div class="account_details_box_list_title_icon">
                                                                            <img src="<?php echo image_icon; ?>profile_email.png">
                                                                    </div>
                                                                    <?php echo $lang["contact email"]; ?>:
                                                            </div>
                                                            <div class="account_details_box_list_body">
                                                                    <?php echo ($l_contact_email != "")? $l_contact_email : "-"; ?>
                                                            </div>
                                                    </div>

                                                    <div class="account_details_box_list group_1">
                                                            <div class="account_details_box_list_title capital">
                                                                    <div class="account_details_box_list_title_icon">
                                                                            <img src="<?php echo image_icon; ?>profile_mobile.png">
                                                                    </div>
                                                                   <?php echo $lang["contact phone"]; ?>:      
                                                            </div>
                                                            <div class="account_details_box_list_body">
                                                                    <?php echo ($l_contact_phone != "")? $l_contact_phone : "-"; ?>
                                                            </div>
                                                    </div>

                                                    <div class="account_details_box_list group_1">
                                                            <div class="account_details_box_list_title capital">
                                                                    <div class="account_details_box_list_title_icon">
                                                                            <img src="<?php echo image_icon; ?>profile_phone.png">
                                                                    </div>
                                                                   <?php echo $lang["contact mobile"]; ?>:
                                                            </div>
                                                            <div class="account_details_box_list_body">
                                                                    <?php echo ($l_contact_mobile != "")? $l_contact_mobile : "-"; ?>
                                                            </div>  
                                                    </div>

                                                    <div class="account_details_box_list group_1">
                                                            <div class="account_details_box_list_title capital">
                                                                    <div class="account_details_box_list_title_icon">
                                                                            <img src="<?php echo image_icon; ?>profile_link.png">
                                                                    </div>
                                                                    <?php echo $lang['website']; ?>:
                                                            </div>
                                                            <div class="account_details_box_list_body">
                                                                   <?php echo ($l_website != "")? $l_website : "-"; ?>
                                                            </div>  
                                                    </div>

                                                     <div class="account_details_box_list">
                                                            <div class="account_details_box_list_title capital">
                                                                    <div class="account_details_box_list_title_icon">
                                                                            <img src="<?php echo image_icon; ?>profile_comment.png">
                                                                    </div>
                                                                    <?php echo $lang['comment']; ?>:
                                                            </div>
                                                            <div class="account_details_box_list_body">
                                                                   <?php echo ($l_comment != "")? $l_comment : "-"; ?>
                                                            </div>  
                                                    </div>

                                                    <div class="account_details_box_list">
                                                            <div class="account_details_box_list_title capital">
                                                                    <div class="account_details_box_list_title_icon">
                                                                            <img src="<?php echo image_icon; ?>profile_date_of_creation.png">
                                                                    </div>
                                                                    <?php echo $lang['date of creation']; ?>:
                                                            </div>
                                                            <div class="account_details_box_list_body">
                                                                   <?php echo $l_date_of_creation; ?>
                                                            </div>  
                                                    </div>
                                                     <div class="account_details_box_list">
                                                            <div class="account_details_box_list_title capital">
                                                                    <div class="account_details_box_list_title_icon">
                                                                            <img src="<?php echo image_icon; ?>profile_status.png">
                                                                    </div>
                                                                    <?php echo $lang['status']; ?>:
                                                            </div>
                                                            <div class="account_details_box_list_body">
                                                                   <?php echo ($l_activity_status == 1)? $lang['active'] : $lang['deactivated']; ?>
                                                            </div>  
                                                    </div>

                                                   
                                            </div>