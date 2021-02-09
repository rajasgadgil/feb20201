
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
            <form id="msform" class="long_presentations_company_form" action="<?php echo admin_url('admin-post.php'); ?>" method="post">
                 <input type="hidden" name="action" value="long_presentations_company">
                 <input type="hidden" name="company_id" value="<?= $contact_id ?>">
                 <!-- <input type="hidden" name="registration_id" value="1"> -->
                <!-- progressbar -->
                <ul id="progressbar">
                    <li class="active" id="account" style="margin-left: 25%">
                        <strong>Welcome</strong>
                        <span class="forminator-break"></span>
                    </li>
                    <li id="personal">
                        <strong>Information</strong>
                    </li>
                    
                </ul>
                <!-- fieldsets -->
                <fieldset>

                    <div class="pagination--content" style="">
                        <div class="row">
                            <div id="section-1" class="col col-12 ">
                                <div class="field">
                                    <h2 class="simple-registration-title title">Service Registration</h2>
                                    <h3 class="simple-registration-subtitle subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </h3>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                           
                            <div id="upload-1" class="col col-md-6 ">
                                <label class="upload-label">Logo</label>
                                <button class="file_upload" type="button">
                                      <span class="btn_lbl">Choose File</span>
                                      <span class="btn_colorlayer"></span>
                                      <input type="file" name="service_logo" id="file_upload" />
                                </button>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div id="html-1" class="col col-12 ">
                                <div class="field merge-tags">
                                    <label class="label">HTML</label>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div id="select-1" class="col col-12 ">
                                <div class="floating-label field select-field"  >
                                    
                                   
                                       <select class="select--field select floating-select" id="select-fonction" name="service_software" onclick="this.setAttribute('value', this.value);" value="">
                                        <option value=""></option>
                                          <option value="one" >Option 1</option>
                                          <option value="two">Option 2</option>
                                       </select>
                                       <span class="highlight"></span>
                                        <label for="service_software" class="form-label">Sur que logiciel basez-vous cette prestation</label>
                                    
                                 </div>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div id="text-1" class="col col-12 ">
                                <div class="floating-label field">
                                    
                                   
                                        <input type="text" name="service_description" value="" placeholder="Saisissez le nom du logiciel" id="service_description" class="form-input floating-input">
                                         <span class="highlight"></span>
                                        <label for="service_description" class="form-label">Si le logiciel de votre prestation n’est pas référencé dans notre base :</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="button" name="next" class="next action-button" value="Next Step" />
                </fieldset>
                <fieldset>
                    <div class="pagination--content" style="">
                        <div class="row" tabindex="-1">
                            <div id="section-2" class="col col-md-12 ">
                                <div class="floating-label field">
                                    <h2 class="title simple-registration-title">Service Details</h2>
                                    <h3 class="subtitle simple-registration-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </h3>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div id="select-2" class="col col-md-6 ">
                                <div class="floating-label field select-field">

                                       <select class="select--field select floating-select" id="select-fonction" name="service_type" onclick="this.setAttribute('value', this.value);" value="">
                                        <option value=""></option>
                                          <option value="one" >Option 1</option>
                                          <option value="two">Option 2</option>
                                       </select>
                                       <span class="highlight"></span>
                                        <label for="service_type" class="form-label">Type de prestation</label>
                                   
                                </div>
                            </div>
                            <div id="select-3" class="col col-md-6 ">
                                <div class="floating-label field select-field">
                                    <select class="select--field select floating-select" id="select-fonction" name="service_customer_activity_sector" onclick="this.setAttribute('value', this.value);" value="">
                                        <option value=""></option>
                                          <option value="one" >Option 1</option>
                                          <option value="two">Option 2</option>
                                       </select>
                                       <span class="highlight"></span>
                                        <label for="service_customer_activity_sector" class="form-label">Secteur d’activité de vos clients</label>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div id="select-4" class="col col-md-6 ">
                                <div class="floating-label field select-field">
                                    <select class="select--field select floating-select" id="select-fonction" name="service_client_profile" onclick="this.setAttribute('value', this.value);" value="">
                                        <option value=""></option>
                                          <option value="one" >Option 1</option>
                                          <option value="two">Option 2</option>
                                       </select>
                                       <span class="highlight"></span>
                                    <label for="service_client_profile" class="form-label">Profil de vos clients</label>
                                </div>
                            </div>
                            <div id="select-5" class="col col-md-6 ">
                                <div class="floating-label field select-field">
                                    <select class="select--field select floating-select" id="select-fonction" name="service_coverage_area" onclick="this.setAttribute('value', this.value);" value="">
                                        <option value=""></option>
                                          <option value="one" >Option 1</option>
                                          <option value="two">Option 2</option>
                                       </select>
                                       <span class="highlight"></span>
                                    <label for="service_coverage_area" class="form-label">Votre zone de couverture</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div id="name-1" class="col col-md-12 ">
                                <div class="floating-label field">
                                    <input type="text" name="service_contact_principal" value="" placeholder=" " id="service_contact_principal" class="floating-input form-input" aria-required="false"> <span class="highlight"></span>
                                    <label for="service_contact_principal" class="form-label">Contact principal</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    <button type="button" name="make_payment" class="next action-button" id="long-prestation-btn" >Submit</button>
                </fieldset>
               
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function () {
         jQuery("#long-prestation-btn").on("click", function () {
            //if (ValidateConatctForm()) {
                
                // $('#module-contact-form').serialize()
                console.log("bjhfvjfbhv");
               jQuery('.long_presentations_company_form').submit();
            //}
        });
    });
</script>