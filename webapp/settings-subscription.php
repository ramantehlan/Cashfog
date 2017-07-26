
                  <script type="text/javascript" src="<?php echo script; ?>form-check.js"></script>
                  <script type="text/javascript" src="<?php echo script_app; ?>settings-security.js"></script>

            <div class="box_body_top">
                <div class="settings_title box_heading capital ">
                            <img src="<?php echo image_icon ?>subscription.png"> 
                            <?php echo $lang['subscription']; ?>
                </div>
            </div>
		

                <div class="settings_fields_box ">
                            <?php 

                                    //this is to decide content of the page 
                                    //according to the period type

                                    switch (period_name) {
                                        case 'subscribed':
                                                    $heading = "Subscription is Active";
                                                    $head_class = "sub_on";
                                                    $body = "We hope you are enjoying our app. we are very happy to see you as our subscribed user,
                                                            we will keep reinventing and keep making our app smarter to fit with your business. 

                                                            <br><Br>

                                                            We want you to feel free to contact us or provide us with your required feedback. You can 
                                                            always put your trust on our services and our team, we are working hard and trying to find
                                                            innovative solutions for you. 


                                                             <br><BR>
                                                            Warm Regards,<Br>
                                                            <b>" . app_name . " Team</b>";
                                            break;
                                        case 'subscribed-done':
                                                    $heading = "Subscription is Over";
                                                    $head_class = "sub_off";
                                                    $body = "We hope you enjoyed and liked our app. It is a pleasure and honor to create this awesome 
                                                            new generation app for you. we look forward to see you as our subscribed user.

                                                            <br><BR>

                                                            You can still access your data and do basic functionality like edit , 
                                                            delete , change things but now you will not see options to add new  transactions or documents 
                                                            and also you will not be able to create new accounts. To get access to all options you need to subscribe.

                                                            <br><BR>
                                                            Warm Regards,<Br>
                                                            <b>" . app_name . " Team</b>";
                                            break;
                                        case 'trial':
                                                    $heading = "Trial is Active";
                                                    $head_class = "sub_on";
                                                    $body = "We hope you are enjoying our app in a trial period, It feels great to see you taking a 
                                                             step forward to upgrade you business with our app, we will always work to make sure 
                                                             that your business always get best of everything.

                                                             <br><br>

                                                             In case you wanna switch to subscribed version of this app, you can click on the subscribe 
                                                             button below. You can also continue this trial period if you are not sure yet.

                                                             <br><BR>
                                                            Warm Regards,<Br>
                                                            <b>" . app_name . " Team</b>";
                                            break;
                                        case 'trial-done':
                                                    $heading = "Trial is Over";
                                                    $head_class = "sub_off";
                                                    $body = "We hope you enjoyed and liked our app. It is a pleasure and honor to create this awesome 
                                                            new generation app for you. we look forward to see you as our subscribed user.

                                                            <br><BR>

                                                            You can still access your data and do basic functionality like edit , 
                                                            delete , change things but now you will not see options to add new  transactions or documents 
                                                            and also you will not be able to create new accounts. To get access to all options you need to subscribe.

                                                            <br><BR>
                                                            Warm Regards,<Br>
                                                            <b>" . app_name . " Team</b>";
                                            break;
                                    }

                            ?>


                            <div class='subscription_heading <?php echo $head_class; ?>'>
                                        <?php echo $heading; ?>
                            </div>

                            <div class='subscription_body'>
                                        <?php echo $body; 

                                            if(allow_subscription && (period_name != "subscribed") ){
                                                echo "<br><br><Br>
                                                    <input type='button' class='submit_button subscription_button' value='subscribe'>";

                                            }

                                        ?>
                            </div>




                        

                    </div>