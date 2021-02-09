<?php

/**
 * Template Name: simple Registration Page
 *
 */

get_header();
$country_array = array (
            'AF' => 'Afghanistan',
            'AX' => 'Åland Islands',
            'AL' => 'Albania',
            'DZ' => 'Algeria',
            'AS' => 'American Samoa',
            'AD' => 'Andorra',
            'AO' => 'Angola',
            'AI' => 'Anguilla',
            'AQ' => 'Antarctica',
            'AG' => 'Antigua & Barbuda',
            'AR' => 'Argentina',
            'AM' => 'Armenia',
            'AW' => 'Aruba',
            'AU' => 'Australia',
            'AT' => 'Austria',
            'AZ' => 'Azerbaijan',
            'BS' => 'Bahamas',
            'BH' => 'Bahrain',
            'BD' => 'Bangladesh',
            'BB' => 'Barbados',
            'BY' => 'Belarus',
            'BE' => 'Belgium',
            'BZ' => 'Belize',
            'BJ' => 'Benin',
            'BM' => 'Bermuda',
            'BT' => 'Bhutan',
            'BO' => 'Bolivia',
            'BA' => 'Bosnia & Herzegovina',
            'BW' => 'Botswana',
            'BV' => 'Bouvet Island',
            'BR' => 'Brazil',
            'IO' => 'British Indian Ocean Territory',
            'VG' => 'British Virgin Islands',
            'BN' => 'Brunei',
            'BG' => 'Bulgaria',
            'BF' => 'Burkina Faso',
            'BI' => 'Burundi',
            'KH' => 'Cambodia',
            'CM' => 'Cameroon',
            'CA' => 'Canada',
            'CV' => 'Cape Verde',
            'BQ' => 'Caribbean Netherlands',
            'KY' => 'Cayman Islands',
            'CF' => 'Central African Republic',
            'TD' => 'Chad',
            'CL' => 'Chile',
            'CN' => 'China',
            'CX' => 'Christmas Island',
            'CC' => 'Cocos (Keeling) Islands',
            'CO' => 'Colombia',
            'KM' => 'Comoros',
            'CG' => 'Congo - Brazzaville',
            'CD' => 'Congo - Kinshasa',
            'CK' => 'Cook Islands',
            'CR' => 'Costa Rica',
            'CI' => 'Côte d’Ivoire',
            'HR' => 'Croatia',
            'CU' => 'Cuba',
            'CW' => 'Curaçao',
            'CY' => 'Cyprus',
            'CZ' => 'Czechia',
            'DK' => 'Denmark',
            'DJ' => 'Djibouti',
            'DM' => 'Dominica',
            'DO' => 'Dominican Republic',
            'EC' => 'Ecuador',
            'EG' => 'Egypt',
            'SV' => 'El Salvador',
            'GQ' => 'Equatorial Guinea',
            'ER' => 'Eritrea',
            'EE' => 'Estonia',
            'SZ' => 'Eswatini',
            'ET' => 'Ethiopia',
            'FK' => 'Falkland Islands',
            'FO' => 'Faroe Islands',
            'FJ' => 'Fiji',
            'FI' => 'Finland',
            'FR' => 'France',
            'GF' => 'French Guiana',
            'PF' => 'French Polynesia',
            'TF' => 'French Southern Territories',
            'GA' => 'Gabon',
            'GM' => 'Gambia',
            'GE' => 'Georgia',
            'DE' => 'Germany',
            'GH' => 'Ghana',
            'GI' => 'Gibraltar',
            'GR' => 'Greece',
            'GL' => 'Greenland',
            'GD' => 'Grenada',
            'GP' => 'Guadeloupe',
            'GU' => 'Guam',
            'GT' => 'Guatemala',
            'GG' => 'Guernsey',
            'GN' => 'Guinea',
            'GW' => 'Guinea-Bissau',
            'GY' => 'Guyana',
            'HT' => 'Haiti',
            'HM' => 'Heard & McDonald Islands',
            'HN' => 'Honduras',
            'HK' => 'Hong Kong SAR China',
            'HU' => 'Hungary',
            'IS' => 'Iceland',
            'IN' => 'India',
            'ID' => 'Indonesia',
            'IR' => 'Iran',
            'IQ' => 'Iraq',
            'IE' => 'Ireland',
            'IM' => 'Isle of Man',
            'IL' => 'Israel',
            'IT' => 'Italy',
            'JM' => 'Jamaica',
            'JP' => 'Japan',
            'JE' => 'Jersey',
            'JO' => 'Jordan',
            'KZ' => 'Kazakhstan',
            'KE' => 'Kenya',
            'KI' => 'Kiribati',
            'KW' => 'Kuwait',
            'KG' => 'Kyrgyzstan',
            'LA' => 'Laos',
            'LV' => 'Latvia',
            'LB' => 'Lebanon',
            'LS' => 'Lesotho',
            'LR' => 'Liberia',
            'LY' => 'Libya',
            'LI' => 'Liechtenstein',
            'LT' => 'Lithuania',
            'LU' => 'Luxembourg',
            'MO' => 'Macao SAR China',
            'MG' => 'Madagascar',
            'MW' => 'Malawi',
            'MY' => 'Malaysia',
            'MV' => 'Maldives',
            'ML' => 'Mali',
            'MT' => 'Malta',
            'MH' => 'Marshall Islands',
            'MQ' => 'Martinique',
            'MR' => 'Mauritania',
            'MU' => 'Mauritius',
            'YT' => 'Mayotte',
            'MX' => 'Mexico',
            'FM' => 'Micronesia',
            'MD' => 'Moldova',
            'MC' => 'Monaco',
            'MN' => 'Mongolia',
            'ME' => 'Montenegro',
            'MS' => 'Montserrat',
            'MA' => 'Morocco',
            'MZ' => 'Mozambique',
            'MM' => 'Myanmar (Burma)',
            'NA' => 'Namibia',
            'NR' => 'Nauru',
            'NP' => 'Nepal',
            'NL' => 'Netherlands',
            'NC' => 'New Caledonia',
            'NZ' => 'New Zealand',
            'NI' => 'Nicaragua',
            'NE' => 'Niger',
            'NG' => 'Nigeria',
            'NU' => 'Niue',
            'NF' => 'Norfolk Island',
            'KP' => 'North Korea',
            'MK' => 'North Macedonia',
            'MP' => 'Northern Mariana Islands',
            'NO' => 'Norway',
            'OM' => 'Oman',
            'PK' => 'Pakistan',
            'PW' => 'Palau',
            'PS' => 'Palestinian Territories',
            'PA' => 'Panama',
            'PG' => 'Papua New Guinea',
            'PY' => 'Paraguay',
            'PE' => 'Peru',
            'PH' => 'Philippines',
            'PN' => 'Pitcairn Islands',
            'PL' => 'Poland',
            'PT' => 'Portugal',
            'PR' => 'Puerto Rico',
            'QA' => 'Qatar',
            'RE' => 'Réunion',
            'RO' => 'Romania',
            'RU' => 'Russia',
            'RW' => 'Rwanda',
            'WS' => 'Samoa',
            'SM' => 'San Marino',
            'ST' => 'São Tomé & Príncipe',
            'SA' => 'Saudi Arabia',
            'SN' => 'Senegal',
            'RS' => 'Serbia',
            'SC' => 'Seychelles',
            'SL' => 'Sierra Leone',
            'SG' => 'Singapore',
            'SX' => 'Sint Maarten',
            'SK' => 'Slovakia',
            'SI' => 'Slovenia',
            'SB' => 'Solomon Islands',
            'SO' => 'Somalia',
            'ZA' => 'South Africa',
            'GS' => 'South Georgia & South Sandwich Islands',
            'KR' => 'South Korea',
            'SS' => 'South Sudan',
            'ES' => 'Spain',
            'LK' => 'Sri Lanka',
            'BL' => 'St. Barthélemy',
            'SH' => 'St. Helena',
            'KN' => 'St. Kitts & Nevis',
            'LC' => 'St. Lucia',
            'MF' => 'St. Martin',
            'PM' => 'St. Pierre & Miquelon',
            'VC' => 'St. Vincent & Grenadines',
            'SD' => 'Sudan',
            'SR' => 'Suriname',
            'SJ' => 'Svalbard & Jan Mayen',
            'SE' => 'Sweden',
            'CH' => 'Switzerland',
            'SY' => 'Syria',
            'TW' => 'Taiwan',
            'TJ' => 'Tajikistan',
            'TZ' => 'Tanzania',
            'TH' => 'Thailand',
            'TL' => 'Timor-Leste',
            'TG' => 'Togo',
            'TK' => 'Tokelau',
            'TO' => 'Tonga',
            'TT' => 'Trinidad & Tobago',
            'TN' => 'Tunisia',
            'TR' => 'Turkey',
            'TM' => 'Turkmenistan',
            'TC' => 'Turks & Caicos Islands',
            'TV' => 'Tuvalu',
            'UM' => 'U.S. Outlying Islands',
            'VI' => 'U.S. Virgin Islands',
            'UG' => 'Uganda',
            'UA' => 'Ukraine',
            'AE' => 'United Arab Emirates',
            'GB' => 'United Kingdom',
            'US' => 'United States',
            'UY' => 'Uruguay',
            'UZ' => 'Uzbekistan',
            'VU' => 'Vanuatu',
            'VA' => 'Vatican City',
            'VE' => 'Venezuela',
            'VN' => 'Vietnam',
            'WF' => 'Wallis & Futuna',
            'EH' => 'Western Sahara',
            'YE' => 'Yemen',
            'ZM' => 'Zambia',
            'ZW' => 'Zimbabwe',
        );
 ?>

<div class="av-section-color-overlay-wrap">
   <div class="av-section-color-overlay" style="opacity: 0.7; background-color: #ffffff; "></div>
   <div class="container">
      <div class="template-page  av-content-full alpha units">
         <div class="post-entry post-entry-type-page post-entry-2812">
            <div class="entry-content-wrapper clearfix">
               <div class="flex_column av_one_fifth  flex_column_div av-zero-column-padding first  avia-builder-el-4  el_before_av_three_fifth  avia-builder-el-first  " style="border-radius:0px; "></div>
               <div class="flex_column av_three_fifth  flex_column_div av-zero-column-padding   avia-builder-el-5  el_after_av_one_fifth  el_before_av_one_fifth  " style="border-radius:0px; ">
                  <section class="av_textblock_section " itemscope="itemscope" itemtype="https://schema.org/CreativeWork">
                  
                     <div class="avia_textblock  " itemprop="text">

                        <form id="form-simple-registration" class="form-simple-registration ui custom-form floating-form" action="<?php echo admin_url('admin-post.php'); ?>" method="post" >
                        	 <input type="hidden" name="action" value="short_company">
                           
                           	<?php
                           	// print_r(filter_input( INPUT_GET, 'my-form' ) );exit();
		                  if ( filter_input( INPUT_GET, 'my-form' ) === 'success' ) {
							    echo "<div class='response-message' >
								    <div class='alert alert-success' role='alert'>
								    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
	  										<div id='usp-error-message'>successfully registered..
	  									</div>
	  								</div>
  								</div>";
							}
		                  	?>
                           
                           <div class="row">
                              <div id="section" class="col col-md-12 ">
                                
                                    <h2 class="title simple-registration-title">Votre entreprise</h2>
                                    <h3 class="simple-registration-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc iaculis, ex vitae maximus suscipit, nulla eros bibendum metus</h3>
                                
                              </div>
                           		
                              <div id="text" class="col col-md-6 ">
                              	<!-- <div class="floating-label">      
							      <input class="floating-input" type="text" placeholder=" ">
							      <span class="highlight"></span>
							      <label>Text</label>
							    </div> -->
                                 <div class="floating-label field"  >
                                   
                                    <input type="text" name="name" value="" placeholder=" " id="name" class="floating-input form-input ">
                                    <span class="highlight"></span>
                                     <label for="name"  class="form-label">Nom de votre entreprise <span class="required">*</span></label>
                                 </div>
                              </div>
                              <div id="select" class="col col-md-6 ">
                                  <div class="floating-label field"  >
                                   
                                    
                                       <select class="select floating-select" id="etablissement" name="etablissement" onclick="this.setAttribute('value', this.value);" value="">
                                       	<option value=""></option>
                                          <option value="one" >Option 1</option>
                                          <option value="two" >Option 2</option>
                                       </select>
                                        <span class="highlight"></span>
                                         <label for="etablissement" class="form-label">Établissement</label>
                                   
                                 </div>
                              </div>
                           
                              <div id="address" class="col col-md2 ">
                                 <div class="row">
                                    <div class="col">
                                        <div class="floating-label field"  >
                                          
                                          <input type="text" name="street_address" placeholder="E.g. 42 Wallaby Way" id="street_address" class="form-input floating-input" aria-required="false" value="">
                                          <span class="highlight"></span>
                                          <label for="street_address" class="form-label">Street Address</label>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col">
                                        <div class="floating-label field"  >
                                          
                                         <input type="text" name="address_line" placeholder=" " id="address_line" class="form-input floating-input" aria-required="false">
                                         <span class="highlight"></span>
                                          <label for="address_line" class="form-label">Apartment, suite, etc</label>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row" data-multiple="true">
                                    <div class="col col-md-6">
                                        <div class="floating-label field"  >
                                         
                                         <input type="text" name="address_city" placeholder="E.g. Sydney" id="address_city" class="form-input floating-input" aria-required="false">
                                          <span class="highlight"></span>
                                          	 <label for="address_city" class="form-label">City</label>
                                       </div>
                                    </div>
                                    <div class="col col-md-6">
                                        <div class="floating-label field"  >
                                          
                                          <input type="text" name="state_address" placeholder="E.g. New South Wales" id="state-address" class="form-input floating-input" aria-required="false" value=""> <span class="highlight"></span><label for="state_address" class="form-label">State/Province</label>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row" data-multiple="true">
                                    <div class="col col-md-6">
                                        <div class="floating-label field"  >
                                          
                                         <input type="text" name="zip_address" placeholder="E.g. 2000" id="zip-address" class="form-input floating-input" value="">
                                         <span class="highlight"></span>
                                         <label for="zip_address" class="form-label">ZIP / Postal Code</label>
                                       </div>
                                    </div>
                                    <div class="col col-md-6">
                                        <div class="floating-label field"  >
                                         
                                          
                                             <select name="address_country" id="address-country" class="select floating-select" onclick="this.setAttribute('value', this.value);" value="">

                                                <option value="" selected=""></option>
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
                              <div id="text-2" class="col col-md-4 ">
                                  <div class="floating-label field"  >
                                   <input type="text" name="siret" value="" placeholder=" " id="siret" class="form-input floating-input name--field"><span class="highlight"></span>
                                    	<label for="siret" class="form-label">Code SIRET <span class="required">*</span></label>
                                 </div>
                              </div>
                              <div id="select-2" class="col col-md-4 ">
                                  <div class="floating-label field"  >
                                    
                                 
                                       <select class="select--field select floating-select" id="select-2-field" name="activity" onclick="this.setAttribute('value', this.value);" value="">
                                       	<option value=""></option>
                                          <option value="one">Option 1</option>
                                          <option value="two">Option 2</option>
                                       </select>
                                       
                                    <span class="highlight"></span>
                                           <label for="activity" class="form-label">Activité </label>
                                 </div>
                              </div>
                              <div id="url" class="col col-md-4 ">
                                  <div class="floating-label field"  >
                                    
                                    <input type="url" name="site_url" value="" placeholder=" " id="url" class="form-input floating-input website--field" aria-required="false"> <span class="highlight"></span>
                                    	<label for="site_url" class="form-label">Site web de l’entreprise </label>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div id="textarea" class="col col-md2 ">
                                 <div class="field" style="position: relative;">
                                   
                                    <textarea name="description" placeholder=" " id="textarea" class="textarea floating-input floating-textarea" height="50" style="padding-top: 29px;"></textarea><span class="highlight"></span>
       <label for="description" class="form-label floating--textarea" style="padding-top: 29px;">Description courte de votre entreprise (500 mots maximum) </label>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div id="section-2" class="col col-md2 ">
                                  <div class="floating-label field"  >
                                    <h2 class="title simple-registration-title">Vous êtes principal contact </h2>
                                    <h3 class="subtitle simple-registration-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc iaculis, ex vitae maximus suscipit, nulla eros bibendum metus</h3>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div id="name" class="col col-md2 ">
                                 <div class="row" data-multiple="true">
                                    <div class="col col-md-6">
                                        <div class="floating-label field"  >
                                          
                                          
                                             <select name="name_prefix" id="prefix-name" class="select floating-select" onclick="this.setAttribute('value', this.value);" value="">
                                       	<option value=""></option>
                                                <option value="Mr">Mr.</option>
                                                <option value="Mrs">Mrs.</option>
                                                <option value="Ms">Ms.</option>
                                                <option value="Miss">Miss</option>
                                                <option value="Dr">Dr.</option>
                                                <option value="Prof">Prof.</option>
                                             </select>
                                             <span class="highlight"></span>
                                         <label for="name_prefix" class="form-label">M. Mme</label>
                                       </div>
                                    </div>
                                    <div class="col col-md-6">
                                        <div class="floating-label field"  >
                                          <input type="text" name="first_name" placeholder=" " id="first-name" class="form-input floating-input" aria-required="false" value="">
                                          	<span class="highlight"></span>
                                          	<label for="first_name" class="form-label">Prénom</label>
                                        
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row" data-multiple="true">
                                    <div class="col col-md2">
                                        <div class="floating-label field"  >
                                          
                                         <input type="text" name="last_name" placeholder=" " id="last-name" class="form-input floating-input" aria-required="false" value="">
                                          	<span class="highlight"></span>
                                          	<label for="last_name" class="form-label">Nom</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div id="select-3" class="col col-md-6 ">
                                  <div class="floating-label field"  >
                                    
                                   
                                       <select class="select--field select floating-select" id="select-fonction" name="fonction" onclick="this.setAttribute('value', this.value);" value="">
                                       	<option value=""></option>
                                          <option value="one" >Option 1</option>
                                          <option value="two">Option 2</option>
                                       </select>
                                       <span class="highlight"></span>
                                        <label for="fonction" class="form-label">Votre fonction  <span class="required">*</span></label>
                                    
                                 </div>
                              </div>
                              <div id="email" class="col col-md-6 ">
                                  <div class="floating-label field"  >
                                   <input type="email" name="email" value="" placeholder=" " id="email" class="form-input floating-input email--field"aria-required="true"><span class="highlight"></span>
                                    <label for="email" class="form-label">Votre Email <span class="required">*</span></label>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div id="phone" class="col col-md-6 ">
                                  <div class="floating-label field"  >
                                   <input type="text" name="phone" value="" placeholder=" " id="phone" class="form-input floating-input -phone"  aria-required="true" autocomplete="off"><span class="highlight"></span>
                                     <label for="phone" class="form-label">Votre N° de tél  <span class="required">*</span></label>
                                  
                                 </div>
                              </div>
                              <div id="text-3" class="col col-md-6 ">
                                  <div class="floating-label field"  >
                                   <input type="text" name="domine" value="" placeholder=" " id="text-3" class="form-input floating-input name--field">
                                   <span class="highlight"></span>
                                     <label for="domine" class="form-label">Domine d’expertise:</label>
                                    
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div id="section-3" class="col col-md2 ">
                                
                                    <h2 class="title simple-registration-title">Créez votre compte</h2>
                                    <h3 class="subtitle simple-registration-subtitle">(votre identifiant sera votre Email)</h3>
                               
                              </div>
                           </div>
                          
                           <div class="row row-last">
                              <div class="col">
                                 <div id="submit" class="field button-field"><button class="button button-submit button-enregistrer" id="simple_enregistrer" type="button"><span>Enregistrer</span><span aria-hidden="true"></span></button></div>
                              </div>
                           </div>
                          
                        </form>
                     </div>
                  </section>
               </div>
              
            </div>
         </div>
      </div>
    
   </div>
</div>
<script type="text/javascript">
	requiredMessage = 'Field Required';
	jQuery(document).ready(function () {
		 jQuery("#simple_enregistrer").on("click", function () {
	        if (ValidateSimpleRegisterForm()) {
	        	
	        	// var form = jQuery('form#form-simple-registration').serialize();
	        	console.log('jkbkv');
	           jQuery('#form-simple-registration').submit();
	        }
	    });
	});

	function ValidateSimpleRegisterForm() {
    if (typeof requiredMessage !== 'undefined') {
        $("#form-simple-registration").validate({
            rules: {
                "name": {
                    required: true,                   
                },
                "siret": {
                    required: true,
                    number: true,
			          minlength:14,
			          maxlength: 14
                },
                "select-fonction" : {
                    required: true
                },
                 "email" : {
                    required: true,
                    email: true
                },
                "phone" : {
                    required: true,
                    number: true,
                    maxlength: 15,
                    maxlength: 10
                },
                 "zip-address" :{
			          number: true,
			          minlength:6,
			          maxlength: 6
			      },
                "description" : {
                    maxlength: 500
                }
			     
            },
            messages: {
                "name": {
                    required: "Nom Required"
                },
                "siret": {
                    required: "siret Required",
                    number: 'Should contain numeric characters',
                    maxlength: 'Should contain atmost 14 characters',
                    minlength: 'Should contain atleast 14 characters'
                },
                "select-fonction" : {
                    required: "Fonction Required"
                },
                "email" : {
                    required: "Email Required",
                    email: "Invalid Email Format"
                },
                "phone" : {
                    required: "Phone Required",
                    number: 'Should contain numeric characters',
                    maxlength: 'Should contain atmost 10 characters',
                    minlength: 'Should contain atleast 10 characters'
                },
                "zip-address" :{
				    number: 'Should contain numeric characters',
				    minlength: 'Should contain  6 characters',
				    maxlength : 'Should contain atmost 6 characters'
				},
				"description" : {
                    maxlength: 'Should contain atmost 500 characters'
                }
            }
        });
        return $("#form-simple-registration").valid();
    }
}
</script>
<?php get_footer(); ?>