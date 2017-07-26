 <div class="details_box_body edit_account_body hide">
                                                       

                                                    <div class="form_box ">

                                                         <form method="post" enctype='multipart/form-data' action="<?php echo action_app; ?>account_edit.php" id='edit_account_info_form'>

                                                                     <div class="error_box create_account_error"><?php echo $lang['error']; ?></div>
                                                                     <div class="success_box create_account_success"><?php echo $lang['successfully saved']; ?></div>

                                                                         <script type='text/javascript' >
                                                                            
                                                                             $(document).ready(function(){
                                                                                 <?php 

                                                                                         if($l_contact_salutation != "")
                                                                                              {
                                                                                                 echo "$('#salutation').val('$l_contact_salutation');";
                                                                                              }
                    

                                                                                   ?>
                                                                               });
                                                                        
                                                                        </script>

                                                                      <input type="hidden" id="account_id" value="<?php echo $account_id; ?>" >
                                                                      <input type="hidden" id="account_type" value="<?php echo $account_type_code; ?>" >

                                                            <div class="form_box_row group_1">
                                                                    <div class="form_box_row_title capital">
                                                                      <?php echo $lang['primary contact']; ?> 
                                                                  </div>
                                                                 <div class="form_box_row_field">
                                                                          <select type="salutation" id="salutation" name="salutation"  class="input select_input capital">
                                                                             <option value="" selected><?php echo $lang['select salutation']; ?></option>
                                                                               <option value="sa1"><?php echo $lang['mr']; ?></option>
                                                                              <option value="sa2"><?php echo $lang['mrs']; ?></option>
                                                                             <option value="sa3"><?php echo $lang['ms']; ?></option>
                                                                                <option value="sa4"><?php echo $lang['miss']; ?></option>
                                                                              <option value="sa5"><?php echo $lang['dr']; ?></option>
                                                                          </select>
                                                                            <input type="f_name" id="f_name" name="f_name" class="input primary_name capital" value="<?php echo $l_contact_first_name; ?>" placeholder="<?php echo $lang['first'] . ' ' . $lang['name']; ?>" maxlength="35">
                                                                            <input type="l_name" id="l_name" name="l_name" class="input primary_name capital" value="<?php echo $l_contact_last_name;?>" placeholder="<?php echo $lang['last'] . ' ' . $lang['name']; ?>" maxlength="35">
                        
                                                                 </div>
                                                         </div>

                                                         <div class="form_box_row group_1">
                                                                 <div class="form_box_row_title capital">
                                                                        <?php echo $lang['company name']; ?>
                                                                   </div>
                                                                   <div class="form_box_row_field">
                                                                      <input type="company_name" id="company_name" name="company_name" class="input capital" value="<?php echo $l_company_name; ?>" placeholder="<?php echo $lang['company name'];; ?>" maxlength="70">
                                                                 </div>
                                                          </div>
            


                                                         <div class="form_box_row">
                                                                    <div class="form_box_row_title capital">
                                                                     <?php echo $lang['account_name']; ?>*
                                                                   </div>
                                                                  <div class="form_box_row_field">
                                                                  <input type="account_title" id="account_title" name="account_title" class="input" value="<?php echo $l_account_title; ?>"  maxlength="60">
                                                                               <div class="field_row_details">
                                                                                          <?php echo $lang['account_name_details']; ?>
                                                                                 </div>
                                                                  </div>
                                                          </div>

            



                                                         <div class="form_box_row currency_box">
                                                                   <div class="form_box_row_title">
                                                                      <?php echo $lang['currency']; ?>*
                                                                  </div>
                                                                    <div class="form_box_row_field">
                                                                           <select type="currency" id="currency" name="currency" class="input select_input no_entry" disabled>
                                                                             <option value=""><?php echo $lang['select']; ?></option>
                                                                             <option value="INR" selected><?php echo $lang['indian_rupee']; ?></option>
                                                                         </select>
                                                                  </div>
                                                          </div>

                                                          <div class="form_box_row group_1">
                                                                  <div class="form_box_row_title">
                                                                        <?php echo $lang['due days']; ?>
                                                                   </div>
                                                                     <div class="form_box_row_field capital">
                                                                             <input type="number" id="due_days" name="due_days" class="input" value="<?php echo $l_due_days; ?>" placeholder="ex:- 45" maxlength="3"> <?php echo $lang['days']; ?>
                                                                     </div>
                                                          </div>


                                                          <div class="form_box_row location_box group_1">
                                                               
                                                                <div class="form_box_row_title">
                                                                          <?php echo $lang['location']; ?>
                                                                     </div>
                                                                     <div class="form_box_row_field location_field">
                                                                                         <input type='address' placeholder="<?php echo $lang['address']; ?>" class="input" id="address" name="address" value="<?php echo $l_address; ?>"  maxlength="50" >
                                                    
                                                                                           <input type='street' placeholder="<?php echo $lang['street']; ?>" class="input" id="street" name="street" value="<?php echo $l_street; ?>" maxlength="50">

                                                                                         <input type='city' placeholder="<?php echo $lang['city']; ?>" class="input" id="city" name="city" value="<?php echo $l_city; ?>"  maxlength="30">

                                                                                         <input type='state' placeholder="<?php echo $lang['state']; ?>" class="input" id="state" name="state" value="<?php echo $l_state ?>" maxlength="50">

                                                                                          <input type='zip' placeholder="<?php echo $lang['zip']; ?>" class="input" id="zip" name="zip" value="<?php echo $l_zip; ?>" maxlength="20">
                                                                       </div>
                                                             </div>  

                                                             <div class="form_box_row country_box group_1">
                                                                     <div class="form_box_row_title">
                                                                            <?php echo $lang['country']; ?>
                                                                     </div>
                                                                       <div class="form_box_row_field">
                                                                              <select type="country" id="country" name="country" class="input select_input no_entry" disabled>
                                                                                   <option value=""><?php echo $lang['select']; ?></option>
                                                                                    <option value="IN" selected><?php echo $lang['india']; ?></option>
                                                                             </select>
                                                                      </div>
                                                             </div>

                                                             <div class="form_box_row group_1">
                                                                      <div class="form_box_row_title">
                                                                           <?php echo $lang['contact email']; ?>
                                                                       </div>
                                                                       <div class="form_box_row_field">
                                                                           <input type='email' class="input" id="contact_email" name="contact_email" value="<?php echo $l_contact_email; ?>" placeholder="<?php echo ucwords($lang['email']); ?>" maxlength="255">
                                                                        </div>
                                                              </div>

                                                              <div class="form_box_row group_1">
                                                                      <div class="form_box_row_title">
                                                                           <?php echo $lang['contact phone']; ?>
                                                                       </div>
                                                                       <div class="form_box_row_field phone_number_field">
                                                                           <input type='phone' class="input" id="work_phone" name="work_phone" value="<?php echo $l_contact_phone; ?>" placeholder="<?php echo $lang['placeholder_work_phone']; ?>" >
                                                                           <input type='phone' class="input" id="mobile_phone" name="mobile_phone" value="<?php echo $l_contact_mobile ?>" placeholder="<?php echo $lang['placeholder_mobile_phone']; ?>" >
                                                                       </div>
                                                             </div>

                                                              <div class="form_box_row group_1">
                                                                        <div class="form_box_row_title">
                                                                          <?php echo $lang['website']; ?>
                                                                        </div>
                                                                        <div class="form_box_row_field">
                                                                            <input type='website' class="input" id="website" name="website" value="<?php echo $l_website; ?>" placeholder="ex:- http://www.abc.xyz" maxlength="255">
                                                                        </div>
                                                                </div>


                                                                  <div class="form_box_row comment_box">
                                                                         <div class="form_box_row_title">
                                                                                <?php echo $lang['comment']; ?>
                                                                         </div>
                                                                         <div class="form_box_row_field">
                                                                                    <textarea type="account_comment" id="account_comment" name="account_comment" class="account_comment input"><?php echo $l_comment; ?></textarea>
                                                                            </div>
                                                                     </div>

                                                              <input type="submit" value="<?php echo $lang['save']; ?>" class="form_button submit_button submit_edit_account_button" >
                                                              
                                                          </form>

                                                   </div>

                                            </div>