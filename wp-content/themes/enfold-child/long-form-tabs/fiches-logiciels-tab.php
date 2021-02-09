
<div class="container-fluid" id="grad1">
	<div class="row justify-content-center mt-0">
		<div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
			<form id="msform" class="long_logiciels_company_form" action="<?php echo admin_url('admin-post.php'); ?>" method="post">
				<input type="hidden" name="action" value="long_logiciels_company">
                 <input type="hidden" name="company_id" value="<?= $contact_id ?>">
				<!-- progressbar -->
				<ul id="progressbar">
					<li class="active" id="account">
						<strong>Welcome</strong>
						<span class="forminator-break"></span>
					</li>
					<li id="personal">
						<strong>Information</strong>
						<span class="forminator-break"></span>
					</li>
					<li id="payment">
						<strong>Usage</strong>
						<span class="forminator-break"></span>
					</li>
					<li id="confirm">
						<strong>Promotion</strong>
						
					</li>
				</ul>
				<!-- fieldsets -->
				<fieldset>
					
					<div class="pagination--content" style="">
					    <div class="row" tabindex="-1">
					        <div id="section-1" class="col col-md-12 ">
					            <div class="floating-label field">
					                <h2 class="title simple-registration-title">Software Registration</h2>
					                <h3 class="subtitle simple-registration-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </h3>
					            </div>
					        </div>
					    </div>
					    <div class="row">
					        <div id="text-1" class="col col-md-6 ">
					            <div class="floating-label field">
					                    <input type="text" name="software_name" value="" placeholder=" " id="field-text-1" class="floating-input form-input" data-required="" aria-invalid="false"><span class="highlight"></span>
					                <label for="field-text-1" class="form-label">Nom du logiciel</label>
					            </div>
					        </div>
					        <div id="upload-1" class="col col-md-6 ">
									<label class="upload-label">Logo</label>
									<button class="file_upload" type="button">
								      <span class="btn_lbl">Choose File</span>
								      <span class="btn_colorlayer"></span>
								      <input type="file" name="software_logo" id="file_upload" accept=".jpg,.jpeg,.jpe,.gif,.png,.bmp,.tiff,.tif,.ico,.heic,.psd,.xcf,.mp4,.txt" />
								    </button>
								</div>
					       
					    </div>
					    <div class="row">
					        <div id="url-1" class="col col-md-12 ">
					            <div class="floating-label field">
					               
					                
					                    <input type="url" name="software_website" value="" placeholder=" " id="field-url-1" class="floating-input form-input" ><span class="highlight"></span>
					                 <label for="field-url-1" class="form-label">Site web de votre entreprise</label>
					            </div>
					        </div>
					    </div>
					</div>
					<input type="button" name="next" class="next action-button" value="Next Step" />
				</fieldset>
				<fieldset>
					<div class="pagination--content" style="">
						<div class="row" tabindex="-1">
							<div id="section-4" class="col col-md-12 ">
								<div class="field">
									<h2 class="title  simple-registration-title">Software Information</h2>
									<h3 class="subtitle  simple-registration-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </h3>
								</div>
							</div>
						</div>
						<div class="row">
							<div id="select-2" class="col col-md-12 ">
								<div class="floating-label field select-field">
									<select class="select floating-select" id="select-2-field" data-required="" name="software_domain" onclick="this.setAttribute('value', this.value);" value="">
											<option value=""></option>
										<option value="one">Option 1</option>
										<option value="two">Option 2</option>
									</select> <span class="highlight"></span>
									<label for="select-2-field-field" class="form-label">Domaines</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div id="select-1" class="col col-md-12 ">
								<div class="field">
									<label for="select-1-field-field" class="label">Métiers</label>
									<label for="select-1-field-1-601ba451bda43" class="option">
										<input type="checkbox" name="software_trade[]" value="one" id="select-1-field-1-601ba451bda43" class="field-checkbox">Option 1</label>
									<label for="select-1-field-2-601ba451bda43" class="option">
										<input type="checkbox" name="software_trade[]" value="two" id="select-1-field-2-601ba451bda43" aria-invalid="false" class="field-checkbox">Option 2</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div id="select-3" class="col col-md-12 ">
								<div class="field">
									<label for="select-3-field-field" class="label">Type d’offre</label>
									<label for="select-3-field-1-601ba451bface" class="option">
										<input type="checkbox" name="software_offers[]" value="one" id="select-3-field-1-601ba451bface" class="field-checkbox">Option 1</label>
									<label for="select-3-field-2-601ba451bface" class="option">
										<input type="checkbox" name="software_offers[]" value="two" id="select-3-field-2-601ba451bface" aria-invalid="false" class="field-checkbox">Option 2</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div id="textarea-1" class="col col-md-12 ">
								<div class="floating-label field" style="position: relative;">
									<textarea name="software_desc_short" placeholder="" id="field-textarea-1" height="50" style="padding-top: 9px;" aria-invalid="false" class="textarea floating-input floating-textarea"></textarea><span class="highlight"></span>
									<label for="field-textarea-1" class="form-label floating--textarea" style="padding-top: 9px;">Description courte du logiciel (500 mots maximum)</label> <span class="description"><span data-limit="500" data-type="words">0 / 500</span></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div id="textarea-2" class="col col-md-12 ">
								<div class="floating-label field" style="position: relative;">
									<textarea name="software_desc_long" placeholder="" id="field-textarea-2" height="50" style="padding-top: 9px;" aria-invalid="false" class="textarea floating-input floating-textarea"></textarea><span class="highlight"></span>
									<label for="field-textarea-2" class="form-label floating--textarea" style="padding-top: 9px;">Description longue du logiciel (2000 mots maximum)</label> <span class="description"><span data-limit="2000" data-type="words">0 / 2000</span></span>
								</div>
							</div>
						</div>
					</div>
					<input type="button" name="previous" class="previous action-button-previous" value="Previous" />
					<input type="button" name="next" class="next action-button" value="Next Step" />
				</fieldset>
				<fieldset>
					<div class="pagination--content" style="">
					    <div class="row" tabindex="-1">
					        <div id="section-5" class="col col-md-12 ">
					            <div class="field">
					                <h2 class="title simple-registration-title">Usage Rights</h2>
					                <h3 class="subtitle simple-registration-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </h3>
					            </div>
					        </div>
					    </div>
					    <div class="row">
					        <div id="date-1" class="col col-md-4 ">
					            <div class="floating-label field">
					              
					                
					                    <input type="text" size="1" name="software_creation_date" value="" placeholder="Choose Date" id="field-date-1-picker-601ba451bfd12" class="input datepicker floating-input form-input">
					                 <span class="highlight"></span>
					                   <label for="field-date-1-picker-601ba451bfd12" class="form-label">Date de création</label>
					            </div>
					        </div>
					        <div id="text-4" class="col col-md-4 ">
					            <div class="floating-label field">
					                
					                    <input type="text" name="software_version" value="" placeholder=" " id="field-text-4" class="floating-input form-input " data-required="" aria-invalid="false">
					                 <span class="highlight"></span>
					                <label for="field-text-4" class="form-label">N° version</label>
					            </div>
					        </div>
					        <div id="date-2" class="col col-md-4 ">
					            <div class="floating-label field">
					                
					                    <input type="text" size="1" name="software_version_date" value="" placeholder="Choose Date" id="field-date-2-picker-601ba451bfe58" class="input datepicker floating-input form-input">
					                 <span class="highlight"></span>
					                <label for="field-date-2-picker-601ba451bfe58" class="form-label">Date de dernière version</label>
					                
					            </div>
					        </div>
					    </div>
					    <div class="row">
					        <div id="text-2" class="col col-md-6 ">
					            <div class="floating-label field">
					                
					                    <input type="text" name="software_pricing" value="" placeholder=" " id="field-text-2" class="floating-input form-input " data-required="" aria-invalid="false">
					                <span class="highlight"></span>
					                <label for="field-text-2" class="form-label">Tarification</label>
					            </div>
					        </div>
					        <div id="text-3" class="col col-md-6 ">
					            <div class="floating-label field">
					                
					                    <input type="text" name="software_certification" value="" placeholder=" " id="field-text-3" class="floating-input form-input " data-required="" aria-invalid="false">
					               <span class="highlight"></span>
					                <label for="field-text-3" class="form-label">Certification</label>
					            </div>
					        </div>
					    </div>
					    <div class="row">
					        <div id="select-4" class="col col-md-12 ">
					            <div class="field">
					                <label for="select-4-field-field" class="label">Langue disponible</label>
					                
					                    <label for="select-4-field-1-601ba451bffb9" class="option">
					                        <input type="checkbox" name="software_lang_avail[]" value="one" id="select-4-field-1-601ba451bffb9" class="field-checkbox">Option 1</label>
					                    <label for="select-4-field-2-601ba451bffb9" class="option">
					                        <input type="checkbox" name="software_lang_avail[]" value="two" id="select-4-field-2-601ba451bffb9" class="field-checkbox" aria-invalid="false">Option 2</label>
					                   
					                
					            </div>
					        </div>
					    </div>
					    <div class="row">
					        <div id="select-5" class="col col-md-12 ">
					            <div class="field">
					                <label for="select-5-field-field" class="label">Profil des entreprises clientes</label>
					                
					                    <label for="select-5-field-1-601ba451c0096" class="option">
					                        <input type="checkbox" name="software_client_company[]" value="one" id="select-5-field-1-601ba451c0096" class="field-checkbox">Option 1</label>
					                    <label for="select-5-field-2-601ba451c0096" class="option">
					                        <input type="checkbox" name="software_client_company[]" value="two" id="select-5-field-2-601ba451c0096" class="field-checkbox" aria-invalid="false">Option 2</label>
					                    
					                
					            </div>
					        </div>
					    </div>
					    <div class="row">
					        <div id="select-6" class="col col-md-12 ">
					            <div class="field">
					                <label for="select-6-field-field" class="label">Localisation des données</label>
					                
					                    <label for="select-6-field-1-601ba451c016c" class="option">
					                        <input type="checkbox" name="software_data_localization[]" value="one" id="select-6-field-1-601ba451c016c" class="field-checkbox">Option 1</label>
					                    <label for="select-6-field-2-601ba451c016c" class="option">
					                        <input type="checkbox" name="software_data_localization[]" value="two" id="select-6-field-2-601ba451c016c" class="field-checkbox" aria-invalid="false">Option 2</label>
					                    
					                
					            </div>
					        </div>
					    </div>
					    <div class="row">
					        <div id="select-7" class="col col-md-12 ">
					            <div class="field">
					                <label for="select-7-field-field" class="label">Plateformes logicielles</label>
					                
					                    <label for="select-7-field-1-601ba451c0241" class="option">
					                        <input type="checkbox" name="software_platform[]" value="one" id="select-7-field-1-601ba451c0241" class="field-checkbox">Option 1</label>
					                    <label for="select-7-field-2-601ba451c0241" class="option">
					                        <input type="checkbox" name="software_platform[]" value="two" id="select-7-field-2-601ba451c0241" class="field-checkbox" aria-invalid="false">Option 2</label>
					                    
					               
					            </div>
					        </div>
					    </div>
					    <div class="row">
					        <div id="select-8" class="col col-md-4 ">
					            <div class="floating-label field select-field">
					               
					              		<select class="select--field select floating-select" id="software_sgbd" name="software_sgbd" onclick="this.setAttribute('value', this.value);" value="">
                                       	<option value=""></option>
                                          <option value="one" >Option 1</option>
                                          <option value="two">Option 2</option>
                                       </select>
                                       <span class="highlight"></span>
                                        
					                 	<label for="select-8-field-field" class="form-label">SGBD</label>
					            </div>
					        </div>
					        <div id="number-1" class="col col-md-4 ">
					            <div class="floating-label field">
					               
					                    <input type="number" name="software_clients" value="" placeholder=" " id="field-number-1" class="floating-input form-input" pattern="^\-?\d*([\.\,]\d+)?" inputmode="decimal" data-required="" aria-required="false" min="1" max="150" aria-invalid="false">
					                     <span class="highlight"></span>
					                <label for="field-number-1" class="form-label">Nombre de clients</label>
					                
					            </div>
					        </div>
					        <div id="number-2" class="col col-md-4 ">
					            <div class="floating-label field">
					                
					                    <input type="number" name="software_users" value="" placeholder=" " id="field-number-2" class="floating-input form-input" pattern="^\-?\d*([\.\,]\d+)?" inputmode="decimal" data-required="" aria-required="false" min="1" max="150" aria-invalid="false">
					                 <span class="highlight"></span>
					                <label for="field-number-2" class="form-label">Nombre d’utilisateurs</label>
					            </div>
					        </div>
					    </div>
					</div>
					<input type="button" name="previous" class="previous action-button-previous" value="Previous" />
					<input type="button" name="next" class="next action-button" value="Next Step" />
				</fieldset>
				<fieldset>
					<div class="pagination--content" style="">
					    <div class="row" tabindex="-1">
					        <div id="section-2" class="col col-md-12 ">
					            <div class="floating-label field">
					                <h2 class="title simple-registration-title">VISIBILITY OFFER</h2>
					                <h3 class="subtitle simple-registration-subtitle">Avec l’offre visibilité, insérez des documents promotionnels dans votre fiche entreprise et dans vos  fiches Logiciels</h3>
					            </div>
					        </div>
					    </div>
					    <div class="row">
					        <div id="html-1" class="col col-md-12 ">
					            <div class="field merge-tags simple-registration-subtitle">Un total de 3 emplacements promotionnels peuvent être affichés dans votre fiche logiciel pour votre communication</div>
					        </div>
					    </div>
					    <div class="row">
					        <div id="text-5" class="col col-md-4 ">
					            <div class="floating-label field">
					                
					                    <input type="text" name="software_promo_1" value="" placeholder=" " id="field-text-5" class="floating-input form-input " data-required="">
					                    <span class="highlight"></span>
					                <label for="field-text-5" class="form-label">Nom</label>
					            </div>
					        </div>
					        <div id="text-6" class="col col-md-4 ">
					            <div class="floating-label field">
					                
					                    <input type="text" name="software_promo_2" value="" placeholder=" " id="field-text-6" class="floating-input form-input " data-required=""><span class="highlight"></span>
					                    <label for="field-text-6" class="form-label">Nom</label>
					            </div>
					        </div>
					        <div id="text-7" class="col col-md-4 ">
					            <div class="floating-label field">
					                
					                    <input type="text" name="software_promo_3" value="" placeholder=" " id="field-text-7" class="floating-input form-input " data-required=""><span class="highlight"></span>
					                   <label for="field-text-7" class="form-label">Nom</label>
					            </div>
					        </div>
					    </div>
					    <div class="row">
					    	<div id="upload-1" class="col col-md-4 ">
									<label class="upload-label">Logo</label>
									<button class="file_upload" type="button">
								      <span class="btn_lbl">Choose File</span>
								      <span class="btn_colorlayer"></span>
								      <input type="file" name="software_promo_upload_1" accept=".jpg,.jpeg,.jpe,.gif,.png,.bmp,.tiff,.tif,.ico,.heic,.asf,.asx,.wmv,.wmx,.wm,.avi,.divx,.flv,.mov,.qt,.mpeg,.mpg,.mpe,.mp4,.m4v,.ogv,.webm,.mkv,.3gp,.3gpp,.3g2,.3gp2,.txt,.asc,.c,.cc,.h,.srt,.csv,.tsv,.ics,.rtx,.css,.htm,.html,.vtt,.dfxp,.mp3,.m4a,.m4b,.aac,.ra,.ram,.wav,.ogg,.oga,.flac,.mid,.midi,.wma,.wax,.mka,.rtf,.js,.pdf,.class,.tar,.zip,.gz,.gzip,.rar,.7z,.psd,.xcf,.doc,.pot,.pps,.ppt,.wri,.xla,.xls,.xlt,.xlw,.mdb,.mpp,.docx,.docm,.dotx,.dotm,.xlsx,.xlsm,.xlsb,.xltx,.xltm,.xlam,.pptx,.pptm,.ppsx,.ppsm,.potx,.potm,.ppam,.sldx,.sldm,.onetoc,.onetoc2,.onetmp,.onepkg,.oxps,.xps,.odt,.odp,.ods,.odg,.odc,.odb,.odf,.wp,.wpd,.key,.numbers,.pages,.mp4,.txt"/>
								    </button>
								</div>
					        <div id="upload-1" class="col col-md-4 ">
									<label class="upload-label">Logo</label>
									<button class="file_upload" type="button">
								      <span class="btn_lbl">Choose File</span>
								      <span class="btn_colorlayer"></span>
								      <input type="file" name="software_promo_upload_2" accept=".jpg,.jpeg,.jpe,.gif,.png,.bmp,.tiff,.tif,.ico,.heic,.asf,.asx,.wmv,.wmx,.wm,.avi,.divx,.flv,.mov,.qt,.mpeg,.mpg,.mpe,.mp4,.m4v,.ogv,.webm,.mkv,.3gp,.3gpp,.3g2,.3gp2,.txt,.asc,.c,.cc,.h,.srt,.csv,.tsv,.ics,.rtx,.css,.htm,.html,.vtt,.dfxp,.mp3,.m4a,.m4b,.aac,.ra,.ram,.wav,.ogg,.oga,.flac,.mid,.midi,.wma,.wax,.mka,.rtf,.js,.pdf,.class,.tar,.zip,.gz,.gzip,.rar,.7z,.psd,.xcf,.doc,.pot,.pps,.ppt,.wri,.xla,.xls,.xlt,.xlw,.mdb,.mpp,.docx,.docm,.dotx,.dotm,.xlsx,.xlsm,.xlsb,.xltx,.xltm,.xlam,.pptx,.pptm,.ppsx,.ppsm,.potx,.potm,.ppam,.sldx,.sldm,.onetoc,.onetoc2,.onetmp,.onepkg,.oxps,.xps,.odt,.odp,.ods,.odg,.odc,.odb,.odf,.wp,.wpd,.key,.numbers,.pages,.mp4,.txt"/>
								    </button>
								</div>
								<div id="upload-1" class="col col-md-4 ">
									<label class="upload-label">Logo</label>
									<button class="file_upload" type="button">
								      <span class="btn_lbl">Choose File</span>
								      <span class="btn_colorlayer"></span>
								      <input type="file" name="software_promo_upload_3" accept=".jpg,.jpeg,.jpe,.gif,.png,.bmp,.tiff,.tif,.ico,.heic,.asf,.asx,.wmv,.wmx,.wm,.avi,.divx,.flv,.mov,.qt,.mpeg,.mpg,.mpe,.mp4,.m4v,.ogv,.webm,.mkv,.3gp,.3gpp,.3g2,.3gp2,.txt,.asc,.c,.cc,.h,.srt,.csv,.tsv,.ics,.rtx,.css,.htm,.html,.vtt,.dfxp,.mp3,.m4a,.m4b,.aac,.ra,.ram,.wav,.ogg,.oga,.flac,.mid,.midi,.wma,.wax,.mka,.rtf,.js,.pdf,.class,.tar,.zip,.gz,.gzip,.rar,.7z,.psd,.xcf,.doc,.pot,.pps,.ppt,.wri,.xla,.xls,.xlt,.xlw,.mdb,.mpp,.docx,.docm,.dotx,.dotm,.xlsx,.xlsm,.xlsb,.xltx,.xltm,.xlam,.pptx,.pptm,.ppsx,.ppsm,.potx,.potm,.ppam,.sldx,.sldm,.onetoc,.onetoc2,.onetmp,.onepkg,.oxps,.xps,.odt,.odp,.ods,.odg,.odc,.odb,.odf,.wp,.wpd,.key,.numbers,.pages,.mp4,.txt"/>
								    </button>
								</div>
					        
					    </div>
					    <div class="row">
					        <div id="text-8" class="col col-md-4 ">
					            <div class="floating-label field">
					               
					                    <input type="text" name="software_promo_4" value="" placeholder=" " id="field-text-8" class="floating-input form-input " data-required=""><span class="highlight"></span>
					                    <label for="field-text-8" class="form-label">Nom</label>
					            </div>
					        </div>
					        <div id="text-9" class="col col-md-4 ">
					            <div class="floating-label field">
					                
					                    <input type="text" name="software_promo_5" value="" placeholder=" " id="field-text-9" class="floating-input form-input " data-required="">
					                <span class="highlight"></span>
					                    <label for="field-text-9" class="form-label">Nom</label>
					            </div>
					        </div>
					        <div id="text-10" class="col col-md-4 ">
					            <div class="floating-label field">
					               
					                    <input type="text" name="software_promo_6" value="" placeholder=" " id="field-text-10" class="floating-input form-input " data-required="">
					                <span class="highlight"></span>
					                    <label for="field-text-10" class="form-label">Nom</label>
					              
					            </div>
					        </div>
					    </div>
					    <div class="row hidden">
					        <div id="url-2" class="col col-md-4 ">
					            <div class="floating-label field">
					                
					                    <input type="url" name="url-2" value="" placeholder=" " id="field-url-2" class="floating-input form-input " data-required="" aria-required="false">
					                <span class="highlight"></span>
					                    <label for="field-url-2" class="form-label">Liens externes</label>
					            </div>
					        </div>
					        <div id="url-3" class="col col-md-4 ">
					            <div class="floating-label field">
					               
					                    <input type="url" name="url-3" value="" placeholder=" " id="field-url-3" class="floating-input form-input " data-required="" aria-required="false">
					               <span class="highlight"></span>
					                    <label for="field-url-3" class="form-label">Liens externes</label>
					            </div>
					        </div>
					        <div id="url-4" class="col col-md-4 ">
					            <div class="floating-label field">
					                
					                    <input type="url" name="url-4" value="" placeholder=" " id="field-url-4" class="floating-input form-input " data-required="" aria-required="false">
					                <span class="highlight"></span>
					                   <label for="field-url-4" class="form-label">Liens externes</label>
					            </div>
					        </div>
					    </div>
					    <div class="row">
					        <div id="section-3" class="col col-md-12 ">
					            <div class="floating-label field">
					                <h2 class="title simple-registration-title">REPRINT OFFER</h2>
					                <h3 class="subtitle simple-registration-subtitle">Pour une meilleure visibilité renvoyez les documents qui parlent de vous vers votre fiche entreprise et logiciels </h3>
					            </div>
					        </div>
					    </div>
					</div>
					<input type="button" name="previous" class="previous action-button-previous" value="Previous" />
					<button type="button" name="make_payment" class="next action-button" id="long-logiciels-btn" >Submit</button>
				</fieldset>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function () {
         jQuery("#long-logiciels-btn").on("click", function () {
            //if (ValidateConatctForm()) {
                
                // $('#module-contact-form').serialize()
                console.log("bjhfvjfbhv");
               jQuery('.long_logiciels_company_form').submit();
            //}
        });
    });
</script>