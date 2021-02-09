<?php 
/**
 * file name : fiche-enterprise tab Long Registration Page
 *
 */

?>

<div class="container">
					
	<div class="flex_column av_three_fifth  flex_column_div av-zero-column-padding   avia-builder-el-6  el_after_av_one_fifth  el_before_av_one_fifth  " style="border-radius:0px; ">
		<section class="av_textblock_section " itemscope="itemscope" itemtype="https://schema.org/CreativeWork">
			<div class="textblock  " itemprop="text">
				<form id="long_enterprise_company_form" class="ui custom-form custom-form-2806 design--material " class="long_presentations_company_form" action="<?php echo admin_url('admin-post.php'); ?>" method="post">
					<input type="hidden" name="action" value="long_enterprise_company">
                 <input type="hidden" name="company_id" value="<?= $contact_id ?>">
					<div class="response-message" aria-hidden="true"></div>
					<div class="row">
						<div id="section-1" class="col col-md-12 ">
							<div class="floating-label field">
								<h2 class="title simple-registration-title">Company Registration</h2>
								<h3 class="subtitle simple-registration-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </h3>
							</div>
						</div>
					</div>
					<div class="row">
						<div id="text-1" class="col col-md-6 ">
							<div class="floating-label field">
								<input type="text" name="name" value="" placeholder="Raison sociale" id="field-text-1" class="floating-input form-input name--field"><span class="highlight"></span>
								<label for="field-text-1" class="form-label">Votre entreprise</label>
							</div>
						</div>
						<div id="upload-1" class="col col-md-6 ">
									<label class="upload-label">Logo</label>
									<button class="file_upload" type="button">
								      <span class="btn_lbl">Choose File</span>
								      <span class="btn_colorlayer"></span>
								      <input type="file" name="comapny_logo" id="file_upload" accept=".jpg,.jpeg,.jpe,.gif,.png,.bmp,.tiff,.tif,.ico,.heic,.psd,.xcf,.mp4,.txt" />
								    </button>
								</div>
						
					</div>
					<div class="row">
						<div id="address-1" class="col col-md-12 ">
							<div class="row">
								<div class="col">
									<div class="floating-label field">
										<input type="text" name="street_address" placeholder="E.g. 42 Wallaby Way" id="field-street_address-address-1" class="floating-input form-input"  aria-required="false" value=""><span class="highlight"></span>
										<label for="field-street_address-address-1" class="form-label">Street Address</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<div class="floating-label field">
										<input type="text" name="address_line" placeholder=" " id="field-address_line-address-1" class="floating-input form-input"  aria-required="false" value=""><span class="highlight"></span>
										<label for="field-address_line-address-1" class="form-label">Apartment, suite, etc</label>
									</div>
								</div>
							</div>
							<div class="row" data-multiple="true">
								<div class="col col-md-6">
									<div class="floating-label field">
										<input type="text" name="address_city" placeholder="E.g. Sydney" id="field-cityaddress-1" class="floating-input form-input"  aria-required="false" value=""> <span class="highlight"></span>
										<label for="field-cityaddress-1" class="form-label">City</label>
									</div>
								</div>
								<div class="col col-md-6">
									<div class="floating-label field">
										<input type="text" name="state_address" placeholder="E.g. New South Wales" id="field-state-address-1" class="floating-input form-input"  aria-required="false" value=""> <span class="highlight"></span>
										<label for="field-state-address-1" class="form-label">State/Province</label>
									</div>
								</div>
							</div>
							<div class="row" data-multiple="true">
								<div class="col col-md-6">
									<div class="floating-label field">
										<input type="text" name="zip_address" placeholder="E.g. 2000" id="field-zip-address-1" class="floating-input form-input"  value=""><span class="highlight"></span>
										<label for="field-zip-address-1" class="form-label">ZIP / Postal Code</label>
									</div>
								</div>
								<div class="col col-md-6">
									<div class="floating-label field select-field">
										 <select name="address_country" id="address-country" class="select floating-select" onclick="this.setAttribute('value', this.value);" value="">

                                                <option value="" selected="">Select Country</option>
                                                <?php foreach($country_array as $key => $value):?>
                                                	<option value="<?= $value?>"><?= $value?></option>
                                            	<?php endforeach;?>
                                             </select>
                                             <span class="highlight"></span>
                                           <label for="address_country" class="form-label">Country </label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div id="section-2" class="col col-md-12 ">
							<div class="floating-label field">
								<h2 class="title simple-registration-title">Company Information</h2>
								<h3 class="subtitle simple-registration-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </h3>
							</div>
						</div>
					</div>
					<div class="row">
						<div id="text-2" class="col col-md-6  pm-2col">
							<div class="floating-label field">
								<input type="text" name="company_nationality" value="" placeholder=" " id="field-text-2" class="floating-input form-input name--field"> <span class="highlight"></span>
								<label for="field-text-2" class="form-label">Nationalité</label>
							</div>
						</div>
						<div id="text-3" class="col col-md-6  pm-2col">
							<div class="floating-label field">
								<input type="text" name="company_parent" value="" placeholder=" " id="field-text-3" class="floating-input form-input name--field"> <span class="highlight"></span>
								<label for="field-text-3" class="form-label">Société mère</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div id="url-1" class="col col-md-12 ">
							<div class="floating-label field">
								<input type="url" name="site_url" value="" placeholder=" " id="field-url-1" class="floating-input form-input website--field" aria-required="false"> <span class="highlight"></span>
								<label for="field-url-1" class="form-label">Site web de votre entreprise</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div id="select-1" class="col col-md-12 ">
							<div class="field">
								<label for="select-1-field-field" class="label">Activités principales</label>
								<label for="select-1-field-1-60195c230e97e" class="option">
									<input type="checkbox" name="activity[]" value="one" id="select-activities" class="field-checkbox">Option 1</label>
								<label for="select-1-field-2-60195c230e97e" class="option">
									<input type="checkbox" name="activity[]" value="two" id="select-activities" class="field-checkbox">Option 2</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div id="text-4" class="col col-md-6 ">
							<div class="floating-label field">
								<input type="text" name="company_created_year" value="" placeholder="AAAA" id="field-text-4" class="floating-input form-input name--field"> <span class="highlight"></span>
								<label for="field-text-4" class="form-label">Année de création</label>
							</div>
						</div>
						<div id="name-1" class="col col-md-6 ">
							<div class="floating-label field">
								<input type="text" name="name-1" value="" placeholder="Prénom Nom" id="field-name-1" class="floating-input form-input name--field" aria-required="false"> <span class="highlight"></span>
								<label for="field-name-1" class="form-label">Contact principal</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div id="select-9" class="col col-md-6 ">
							<div class="field">
								<label for="select-Contacts" class="label">Contacts</label>
								<br>
								<label for="select-Contacts" class="option">
									<input type="checkbox" name="company_contact_option[]" value="one" id="select-Contacts" class="field-checkbox">Option 1</label>
								<label for="select-Contacts" class="option">
									<input type="checkbox" name="company_contact_option[]" value="two" id="select-Contacts" class="field-checkbox">Option 2</label>
							</div>
						</div>
						<div id="html-2" class="col col-md-6 ">
							<div class="floating-label field merge-tags">
								<p><a id="add-contact" class="button pm-addcontact button-upload hustle_module_shortcode_trigger hustle_module_1 " data-id="1" data-type="popup">Ajouter un contact</a>
								</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div id="select-2" class="col col-md-6 ">
							<div class="floating-label field select-field">
								<select class="select--field select floating-select" id="contact_activity_sector" name="activity" onclick="this.setAttribute('value', this.value);" value="">
                                       	<option value=""></option>
                                          <option value="one">Option 1</option>
                                          <option value="two">Option 2</option>
                                          <option value="three">Option 3</option>
                                       </select><span class="highlight"></span>
								<label for="select-2-field-field" class="form-label">Secteur d’activité de vos clients</label>
							</div>
						</div>
						<div id="select-3" class="col col-md-6 ">
							<div class="floating-label field select-field">
								<select class="select--field select floating-select" id="select-2-field" name="company_client_profile" onclick="this.setAttribute('value', this.value);" value="">
                                       	<option value=""></option>
                                          <option value="one">Option 1</option>
                                          <option value="two">Option 2</option>
                                         
                                       </select> <span class="highlight"></span>
								<label for="select-3-field-field" class="form-label">Profil de vos clients</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div id="section-6" class="col col-md-12 ">
							<div class="floating-label field">
								<h2 class="title simple-registration-title">Legal Information</h2>
								<h3 class="subtitle simple-registration-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </h3>
							</div>
						</div>
					</div>
					<div class="row">
						<div id="select-4" class="col col-md-12 ">
							<div class=" field">
								<label for="select-4-field-field" class="label">Forme juridique</label>
								<br>
								<label for="select-4-field-1-60195c231287e" class="option">
									<input type="checkbox" name="company_legal_form[]" value="one" id="select-4-field-1-60195c231287e" class="field-checkbox">Option 1</label>
								<label for="select-4-field-2-60195c231287e" class="option">
									<input type="checkbox" name="company_legal_form[]" value="two" id="select-4-field-2-60195c231287e" class="field-checkbox">Option 2</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div id="currency-1" class="col col-md-4 ">
							<div class="floating-label field">
								<div class="input-with-suffix">
									<input type="number" name="company_share_capital" step="0.01" value="" placeholder=" " id="field-currency-1" class="floating-input form-input currency" data-decimals="2" aria-required="" min="1" max="150"> <span class="suffix">EUR</span>
									<span class="highlight"></span>
									<label for="field-currency-1" class="form-label">Capital social</label>
								</div>
							</div>
						</div>
						<div id="text-5" class="col col-md-4 ">
							<div class="floating-label field">
								<input type="text" name="company_global_workforce" value="" placeholder=" " id="field-text-5" class="floating-input form-input name--field"><span class="highlight"></span>
								<label for="field-text-5" class="form-label">Effectif global</label>
							</div>
						</div>
						<div id="text-6" class="col col-md-4 ">
							<div class="floating-label field">
								<input type="text" name="company_france_workforce" value="" placeholder=" " id="field-text-6" class="floating-input form-input name--field"><span class="highlight"></span>
								<label for="field-text-6" class="form-label">Effectifs France</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div id="text-7" class="col col-md-6 ">
							<div class="floating-label field">
								<input type="text" name="company_rcs" value="" placeholder=" " id="field-text-7" class="floating-input form-input name--field"><span class="highlight"></span>
								<label for="field-text-7" class="form-label">RCS</label>
							</div>
						</div>
						<div id="text-8" class="col col-md-6 ">
							<div class="floating-label field">
								<input type="text" name="siret" value="" placeholder=" " id="field-text-8" class="floating-input form-input name--field"> <span class="highlight"></span>
								<label for="field-text-8" class="form-label">SIRET</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div id="section-3" class="col col-md-12 ">
							<div class="floating-label field">
								<h2 class="title simple-registration-title">Chiffres d’affaires </h2>
							</div>
						</div>
					</div>
					<div class="row">
						<div id="currency-2" class="col col-md-4 ">
							<div class="floating-label field">
								<div class="input-with-suffix">
									
										<input type="number" name="company_sales_figure1" step="0.01" value="" placeholder="1" id="field-currency-2" class="floating-input form-input currency" data-decimals="2" aria-required="" min="1" max="150">
									 <span class="suffix">EUR</span>
								</div>
							</div>
						</div>
						<div id="text-9" class="col col-md-4  pm-nothingbelow">
							<div class="floating-label field">
								
									<input type="text" name="company_sales_figure_year1" value="" placeholder="AAAA" id="field-text-9" class="floating-input form-input name--field" maxlength="4">
								
							</div> 
						</div>
						<div id="select-5" class="col col-md-4 ">
							<div class="floating-label field ">
								
									<select class="select--field select screen-reader-only" id="select-5-field" name="comapny_sales_figure_option1" data-default-value="" data-placeholder=" ">
										<option value="one">Option 1</option>
										<option value="two">Option 2</option>
									</select>
								
							</div>
						</div>
					</div>
					<div class="row">
						<div id="currency-3" class="col col-md-4 ">
							<div class="floating-label field">
								<div class="input-with-suffix">
									
										<input type="number" name="comapny_sales_figure2" step="0.01" value="" placeholder="1" id="field-currency-3" class="floating-input form-input currency" data-decimals="2" aria-required="" min="1" max="150">
									<span class="suffix">EUR</span>
								</div>
							</div>
						</div>
						<div id="text-10" class="col col-md-4  pm-nothingbelow">
							<div class="floating-label field">
								
									<input type="text" name="company_sales_figure_year2" value="" placeholder="AAAA" id="field-text-10" class="floating-input form-input name--field" maxlength="4">
								
							</div> <span class="description"><span data-limit="4" >0 / 4</span></span>
						</div>
						<div id="select-6" class="col col-md-4 ">
							<div class="floating-label field select-field">
								
									<select class="select--field select screen-reader-only" id="select-6-field" name="comapny_sales_figure_option2" data-default-value="" data-placeholder=" ">
										<option value="one">Option 1</option>
										<option value="two">Option 2</option>
									</select>
								
							</div>
						</div>
					</div>
					<div class="row">
						<div id="currency-4" class="col col-md-4 ">
							<div class="floating-label field">
								<div class="input-with-suffix">
									
										<input type="number" name="comapny_sales_figure3" step="0.01" value="" placeholder="1" id="field-currency-4" class="floating-input form-input currency" data-decimals="2" aria-required="" min="1" max="150">
									 <span class="suffix">EUR</span>
								</div>
							</div>
						</div>
						<div id="text-11" class="col col-md-4  pm-nothingbelow">
							<div class="floating-label field">
								
									<input type="text" name="company_sales_figure_year3" value="" placeholder="AAAA" id="field-text-11" class="floating-input form-input name--field" maxlength="4">
								
							</div> <span class="description"><span data-limit="4" >0 / 4</span></span>
						</div>
						<div id="select-7" class="col col-md-4 ">
							<div class="floating-label field select-field">
								<div class="select-container">
									<select class="select--field select screen-reader-only" id="select-7-field" name="company_sales_figure_year3" data-default-value="" data-placeholder=" ">
										<option value="one">Option 1</option>
										<option value="two">Option 2</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div id="currency-5" class="col col-md-4 ">
							<div class="floating-label field">
								<div class="input-with-suffix">
									
										<input type="number" name="comapny_sales_figure4" step="0.01" value="" placeholder="1" id="field-currency-5" class="floating-input form-input currency" data-decimals="2" aria-required="" min="1" max="150">
									<span class="suffix">EUR</span>
								</div>
							</div>
						</div>
						<div id="text-12" class="col col-md-4  pm-nothingbelow">
							<div class="floating-label field">
								
									<input type="text" name="company_sales_figure_year4" value="" placeholder="AAAA" id="field-text-12" class="floating-input form-input name--field" maxlength="4">
								
							</div> <span class="description"><span data-limit="4" >0 / 4</span></span>
						</div>
						<div id="select-8" class="col col-md-4 ">
							<div class="floating-label field select-field">
								<div class="select-container">
									<select class="select--field select screen-reader-only" id="select-8-field" name="company_sales_figure_year4" data-default-value="" data-placeholder=" ">
										<option value="one">Option 1</option>
										<option value="two">Option 2</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div id="section-4" class="col col-md-12 ">
							<div class="floating-label field">
								<h2 class="title simple-registration-title">Réseaux</h2>
							</div>
						</div>
					</div>
					<div class="row">
						<div id="url-2" class="col col-md-3 ">
							<div class="floating-label field">
								<input type="url" name="company_network_linkedin" value="" placeholder=" " id="field-url-2" class="floating-input form-input website--field" aria-required="false"><span class="highlight"></span>
								<label for="field-url-2" class="form-label">Linkedin</label>
							</div>
						</div>
						<div id="url-3" class="col col-md-3 ">
							<div class="floating-label field">
								<input type="url" name="company_network_twitter" value="" placeholder=" " id="field-url-3" class="floating-input form-input website--field" aria-required="false"><span class="highlight"></span>
								<label for="field-url-3" class="form-label">Twitter</label>
							</div>
						</div>
						<div id="url-4" class="col col-md-3 ">
							<div class="floating-label field">
								<input type="url" name="company_network_youtube" value="" placeholder=" " id="field-url-4" class="floating-input form-input website--field" aria-required="false"> <span class="highlight"></span>
								<label for="field-url-4" class="form-label">YouTube</label>
							</div>
						</div>
						<div id="url-5" class="col col-md-3 ">
							<div class="floating-label field">
								<input type="url" name="company_network_other" value="" placeholder=" " id="field-url-5" class="floating-input form-input website--field" aria-required="false"> <span class="highlight"></span>
								<label for="field-url-5" class="form-label">Autre</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div id="textarea-1" class="col col-md-12 ">
							<div class="floating-label field" style="position: relative;">

								<textarea name="company_desc_short" placeholder=" " id="field-textarea-1" class="textarea floating-input floating-textarea" height="50" style="min-height: 160px; padding-top: 29px;"></textarea><span class="highlight"></span>
								<label for="field-textarea-1" class="form-label" style="padding-top: 29px;">Description courte de votre entreprise (500 mots maximum)</label> <span class="description"><span data-limit="500" data-type="words">0 / 500</span></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div id="textarea-2" class="col col-md-12 ">
							<div class="floating-label field" style="position: relative;">
								<textarea name="company_desc_long" placeholder=" " id="field-textarea-2" class="textarea floating-input floating-textarea" height="50" style="min-height: 160px; padding-top: 29px;"></textarea><span class="highlight"></span>
								<label for="field-textarea-2" class="form-label" style="padding-top: 29px;">Description longue de votre entreprise (2000 mots maximum)</label> <span class="description"><span data-limit="500" data-type="words">0 / 500</span></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div id="section-5" class="col col-md-12 ">
							<div class="floating-label field">
								<h2 class="title simple-registration-title">VISIBILITY OFFER</h2>
								<h3 class="simple-registration-subtitle">Avec l’offre visibilité, insérez des documents promotionnels dans votre fiche entreprise et dans vos  fiches Logiciels</h3>
							</div>
						</div>
					</div>
					<div class="row">
						<div id="html-1" class="col col-md-12 ">
							<div class="floating-label field merge-tags">
								<p>Un total de 3 emplacements promotionnels peuvent être affichés dans votre fiche logiciel pour votre communication</p>
								<p>Pour une meilleure visibilité renvoyez les documents qui parlent de vous vers votre fiche entreprise et logiciels</p>
								<br>
							</div>
						</div>
					</div>
					<div class="row">
						<div id="text-13" class="col col-md-12 ">
							<div class="floating-label field">
								<input type="text" name="company_profile_doc_name" value="" placeholder=" " id="field-text-13" class="floating-input form-input name--field"><span class="highlight"></span>
								<label for="field-text-13" class="form-label">Nom 1</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div id="upload-1" class="col col-md-6 ">
									<label class="upload-label">Logo</label>
									<button class="file_upload" type="button">
								      <span class="btn_lbl">Choose File</span>
								      <span class="btn_colorlayer"></span>
								      <input type="file" name="company_profile_document" id="file_upload" accept=".jpg,.jpeg,.jpe,.gif,.png,.bmp,.tiff,.tif,.ico,.heic,.asf,.asx,.wmv,.wmx,.wm,.avi,.divx,.flv,.mov,.qt,.mpeg,.mpg,.mpe,.mp4,.m4v,.ogv,.webm,.mkv,.3gp,.3gpp,.3g2,.3gp2,.txt,.asc,.c,.cc,.h,.srt,.csv,.tsv,.ics,.rtx,.css,.htm,.html,.vtt,.dfxp,.mp3,.m4a,.m4b,.aac,.ra,.ram,.wav,.ogg,.oga,.flac,.mid,.midi,.wma,.wax,.mka,.rtf,.js,.pdf,.class,.tar,.zip,.gz,.gzip,.rar,.7z,.psd,.xcf,.doc,.pot,.pps,.ppt,.wri,.xla,.xls,.xlt,.xlw,.mdb,.mpp,.docx,.docm,.dotx,.dotm,.xlsx,.xlsm,.xlsb,.xltx,.xltm,.xlam,.pptx,.pptm,.ppsx,.ppsm,.potx,.potm,.ppam,.sldx,.sldm,.onetoc,.onetoc2,.onetmp,.onepkg,.oxps,.xps,.odt,.odp,.ods,.odg,.odc,.odb,.odf,.wp,.wpd,.key,.numbers,.pages,.mp4,.txt" />
								    </button>
								</div>
						
					</div>
					<div class="row">
						<div id="text-16" class="col col-md-12 ">
							<div class="floating-label field">
								<input type="text" name="company_profile_doc2" value="" placeholder=" " id="field-text-16" class="floating-input form-input name--field"><span class="highlight"></span>
								<label for="field-text-16" class="form-label">Nom 1</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div id="url-6" class="col col-md-12 ">
							<div class="floating-label field">
								<input type="url" name="company_profile_links" value="" placeholder="Liens externes" id="field-url-6" class="floating-input form-input website--field" aria-required="false"><span class="highlight"></span>
							</div>
						</div>
					</div><input type="hidden" name="company_id" value="1">
					<!-- <input type="hidden" name="referer_url" value=""> -->
					<div class="row row-last">
						<div class="col">
							<div id="submit" class="floating-label field">
								<button class="button button-submit" type="button" id="long_enterprise_company_btn"><span>Submit</span><span aria-hidden="true"></span>
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</section>
	</div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function () {
         jQuery("#long_enterprise_company_btn").on("click", function () {
            //if (ValidateConatctForm()) {
                
                // $('#module-contact-form').serialize()
                console.log("bjhfvjfbhv");
               jQuery('#long_enterprise_company_form').submit();
            //}
        });
    });
</script>