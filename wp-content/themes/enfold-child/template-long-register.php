<?php

/**
 * Template Name: Long Registration Page
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

if(isset($_SESSION['contact_id'])) {
    $contact_id = $_SESSION['contact_id'];
} else {
    $contact_id = 10;
}
?>
<div id="av_section_1" class="avia-section main_color avia-section-default avia-no-border-styling  avia-full-stretch av-parallax-section avia-bg-style-parallax  avia-builder-el-0  el_before_av_tab_section  avia-builder-el-first   container_wrap fullsize" style=" " data-section-bg-repeat="stretch">
   <div class="av-parallax active-parallax" data-avia-parallax-ratio="0.3" style="height: 553px; transform: translate3d(0px, 163px, 0px);">
      <div class="av-parallax-inner main_color  avia-full-stretch" style="background-repeat: no-repeat; background-image: url(https://aeon2.blvckpixel.com/wp-content/uploads/2021/01/utilities-bg.jpg);background-attachment: scroll; background-position: center center; "></div>
   </div>
   <div class="container">
      <main role="main" itemprop="mainContentOfPage" class="template-page content  av-content-full alpha units">
         <div class="post-entry post-entry-type-page post-entry-668">
            <div class="entry-content-wrapper clearfix">
               <div style="height:60px" class="hr hr-invisible  av-small-hide av-mini-hide  avia-builder-el-1  el_before_av_heading  avia-builder-el-first "><span class="hr-inner "><span class="hr-inner-style"></span></span></div>
               <div style="padding-bottom:10px; color:#ffffff;" class="av-special-heading av-special-heading-h1 custom-color-heading blockquote modern-quote modern-centered  avia-builder-el-2  el_after_av_hr  avia-builder-el-last  ">
                  <div class="av-subheading av-subheading_above av_custom_color " style="font-size:15px;">
                     <p>Join the community at Myteklist</p>
                  </div>
                  <h1 class="av-special-heading-tag " itemprop="headline">Company, Software, <span class="special_amp">&amp;</span> Service Registration</h1>
                  <div class="special-heading-border">
                     <div class="special-heading-inner-border" style="border-color:#ffffff"></div>
                  </div>
               </div>
            </div>
         </div>
      </main>
      <!-- close content main element -->
   </div>
</div>
<div id="pm-regforms" class="tab-section-container container_wrap fullsize" style=" ">
	<div class="av-tab-section-outer-container" id="form-simple-registration">
      	<ul class="nav nav-tabs tab-section-tab-title-container" role="tablist" style="min-width: 1027.19px; left: 0px;">
      		<li class="nav-item nav-item-div">
      			<a data-target="#fiche-enterprise" class="nav-link nav-link-item active" data-toggle="tab">
	      			<span class="av-outer-tab-title">
	      				<span class="av-inner-tab-title">Fiche Enterprise</span>
	      			</span>
	      			<span class="av-tab-arrow-container"><span></span></span>
	      		</a>
      		</li>
      		<li class="nav-item nav-item-div">
      			<a data-target="#fiches-logiciels"class="nav-link nav-link-item" data-toggle="tab">
      			<span class="av-outer-tab-title">
      				<span class="av-inner-tab-title">Fiches Logiciels</span>
      			</span>
      			<span class="av-tab-arrow-container"><span></span></span>
      		</a>
      		</li>
      		<li class="nav-item nav-item-div">
      			<a data-target="#fiches-prestations" class="nav-link nav-link-item" data-toggle="tab" >
      			<span class="av-outer-tab-title">
      				<span class="av-inner-tab-title">Fiches Prestations</span>
      			</span>
      			<span class="av-tab-arrow-container"><span></span></span>
      		</a>
      		</li>
      		<li class="nav-item nav-item-div">
      			<a data-target="#contacts" class="nav-link nav-link-item" data-toggle="tab" ><span class="av-outer-tab-title">
	      			<span class="av-inner-tab-title">Contacts</span></span><span class="av-tab-arrow-container"><span></span></span>
	      		</a>
      		</li>
      	</ul>
      	<div class="tab-content clearfix" id="myTabContent">
		 	
			<div class="tab-pane active" id="fiche-enterprise" role="tabpanel">
				<?php include_once( 'long-form-tabs/fiche-enterprise-tab.php' ); ?>
			</div>
		  	<div class="tab-pane fade" id="fiches-logiciels" role="tabpanel" >
		  		<?php include_once( 'long-form-tabs/fiches-logiciels-tab.php' ); ?>
		  	</div>
		  	<div class="tab-pane fade" id="fiches-prestations" role="tabpanel"><?php include_once( 'long-form-tabs/fiches-prestations-tab.php' ); ?></div>
		  	<div class="tab-pane fade" id="contacts" role="tabpanel"><?php include_once( 'long-form-tabs/contacts-tab.php' ); ?></div>
		</div>
    </div>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){

var current_fs, next_fs, previous_fs; //fieldsets
var opacity;

jQuery(".next").click(function(){

current_fs = jQuery(this).parent();
next_fs = jQuery(this).parent().next();

//Add Class Active
jQuery("#progressbar li").eq(jQuery("fieldset").index(next_fs)).addClass("active");

//show the next fieldset
next_fs.show();
//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
next_fs.css({'opacity': opacity});
},
duration: 600
});
});

jQuery(".previous").click(function(){

current_fs = jQuery(this).parent();
previous_fs = jQuery(this).parent().prev();

//Remove class active
jQuery("#progressbar li").eq(jQuery("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
previous_fs.show();

//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
previous_fs.css({'opacity': opacity});
},
duration: 600
});
});

jQuery('.radio-group .radio').click(function(){
jQuery(this).parent().find('.radio').removeClass('selected');
jQuery(this).addClass('selected');
});

jQuery(".submit").click(function(){
return false;
})

});
</script>
<?php get_footer(); ?>