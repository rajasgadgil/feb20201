<?php
if (!defined('ABSPATH')) {
	exit;
}    // Exit if accessed directly


global $avia_config;

$responsive		= avia_get_option('responsive_active') != "disabled" ? "responsive" : "fixed_layout";
$headerS 		= avia_header_setting();
$social_args 	= array('outside' => 'ul', 'inside' => 'li', 'append' => '');
$icons 			= !empty($headerS['header_social']) ? avia_social_media_icons($social_args, false) : "";
$alternate_menu_id = !empty($headerS['alternate_menu']) && is_numeric($headerS['alternate_menu']) && empty($headerS['menu_display']) ? $headerS['alternate_menu'] : false;

/**
 * For sidebar menus this filter allows to activate alternate menus - are disabled by default
 * 
 * @since 4.5
 * @param int|false $alternate_menu_id 
 * @param array $headerS
 * @return int|false
 */
$alternate_menu_id = apply_filters('avf_alternate_mobile_menu_id', $alternate_menu_id, $headerS);

if (isset($headerS['disabled'])) {
	return;
}

?>

<header id='header' class='all_colors header_color <?php avia_is_dark_bg('header_color');
													echo " " . $headerS['header_class']; ?>' <?php avia_markup_helper(array('context' => 'header', 'post_type' => 'forum')); ?>>

	<?php

	//subheader, only display when the user chooses a social header
	if ($headerS['header_topbar'] == true) {
	?>
		<div id='header_meta' class='container_wrap container_wrap_meta <?php echo avia_header_class_string(array('header_social', 'header_secondary_menu', 'header_phone_active'), 'av_'); ?>'>

			<div class='container'>
				<?php
				/*
			            *	display the themes social media icons, defined in the wordpress backend
			            *   the avia_social_media_icons function is located in includes/helper-social-media-php
			            */
				$nav = "";


				//display icons
				if (strpos($headerS['header_social'], 'extra_header_active') !== false) echo $icons;

				//display navigation
				if (strpos($headerS['header_secondary_menu'], 'extra_header_active') !== false) {
					//display the small submenu
					$avia_theme_location = 'avia2';
					$avia_menu_class = $avia_theme_location . '-menu';
					$args = array(
						'theme_location' => $avia_theme_location,
						'menu_id' => $avia_menu_class,
						'container_class' => $avia_menu_class,
						'fallback_cb' => '',
						'container' => '',
						'echo' => false
					);

					$nav = wp_nav_menu($args);
				}

				if (!empty($nav) || apply_filters('avf_execute_avia_meta_header', false)) {
					echo "<nav class='sub_menu' " . avia_markup_helper(array('context' => 'nav', 'echo' => false)) . ">";
					echo $nav;
					do_action('avia_meta_header'); // Hook that can be used for plugins and theme extensions (currently: the wpml language selector)
					echo '</nav>';
				}


				//phone/info text	
				/*$phone			= $headerS['header_phone_active'] != "" ? $headerS['phone'] : "";
				$phone_class 	= !empty($nav) ? "with_nav" : "";
				if ($phone) {
					echo "<div class='phone-info {$phone_class}'><span>" . do_shortcode($phone) . "</span></div>";
				}*/
				echo "<div class='phone-info {$phone_class}'><span>";
					if ( is_user_logged_in() ) {
						global $current_user;
						?>
				<nav class="navbar navbar-expand-lg navbar-light bg-dark userspace_menu">
				  <div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
					  <li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  <?php echo $current_user->first_name.' '.$current_user->last_name; ?>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						  <a class="dropdown-item" href="<?php echo get_home_url(); ?>/user-space">User Space</a>
						  <div class="dropdown-divider"></div>
						  <a class="dropdown-item" href="<?php echo get_home_url(); ?>/change-password">Change Password</a>
						  <div class="dropdown-divider"></div>
						  <a class="dropdown-item" href="<?php echo wp_logout_url('/');?>">Logout</a>
						</div>
					  </li>
					</ul>
				  </div>
				</nav>	
					<?php
					} else {
						echo '<a href="/simple-registration">Référencer mon entreprise</a> | <a href="/register">S’inscrire</a> | <a href="/login">Connexion</a>';
					}
				echo '</span></div>';				

				?>
			</div>
		</div>

	<?php }



	$output 	 = "";
	$temp_output = "";
	$icon_beside = "";

	if ($headerS['header_social'] == 'icon_active_main' && empty($headerS['bottom_menu'])) {
		$icon_beside = " av_menu_icon_beside";
	}






	?>


	<script>
		jQuery(document).ready(function($) {
			$(".sub-menu").hide();
			$(".current_page_item .sub-menu").show();
			$("li.menu-item").hover(function() { // mouse enter
				$(this).find(".sub-menu").show(); // display child

			}, function() { // mouse leave
				if (!$(this).hasClass("current_page_item")) { // check if current page
					$(this).find(".sub-menu").hide(); // hide if not current page
				}
			});
		});
	</script>
	<div id='header_main' class='container_wrap container_wrap_logo'>

		<?php
		/*
        * Hook that can be used for plugins and theme extensions (currently:  the woocommerce shopping cart)
        */
		do_action('ava_main_header');

		if ($headerS['header_position'] != "header_top") do_action('ava_main_header_sidebar');

		$output .= get_search_form();
		$output .= '<div id="pm-login"><div class="menu-secondary-header-french-container">';
				$avia_theme_location = 'avia2';
				$avia_menu_class = $avia_theme_location . '-menu';
				$args = array(
					'theme_location' => $avia_theme_location,
					'menu_id' => $avia_menu_class,
					'container_class' => $avia_menu_class,
					'fallback_cb' => '',
					'container' => '',
					'echo' => false
				);

				$nav = wp_nav_menu($args);
				$output.=$nav;
		$output.="</div></div>";			
		$output .= "<div class='container av-logo-container'>";

		$output .= "<div class='inner-container'>";

		/*
						*	display the theme logo by checking if the default logo was overwritten in the backend.
						*   the function is located at framework/php/function-set-avia-frontend-functions.php in case you need to edit the output
						*/
		$addition = false;
		if (!empty($headerS['header_transparency']) && !empty($headerS['header_replacement_logo'])) {
			$addition = "<img src='{$headerS['header_replacement_logo']}' class='alternate' alt='{$headerS['header_replacement_logo_alt']}' title='{$headerS['header_replacement_logo_title']}' />";
		}

		$output .= avia_logo(AVIA_BASE_URL . 'images/layout/logo.png', $addition, 'span', true);

		if (!empty($headerS['bottom_menu'])) {
			ob_start();
			do_action('ava_before_bottom_main_menu'); // todo: replace action with filter, might break user customizations
			$output .= ob_get_clean();
		}

		if ($headerS['header_social'] == 'icon_active_main' && !empty($headerS['bottom_menu'])) {
			$output .= $icons;
		}


		/*
						*	display the main navigation menu
						*   modify the output in your wordpress admin backend at appearance->menus
						*/

		if ($headerS['bottom_menu']) {
			$output .= "</div>";
			$output .= "</div>";

			if (!empty($headerS['header_menu_above'])) {
				$avia_config['temp_logo_container'] = "<div class='av-section-bottom-logo header_color'>" . $output . "</div>";
				$output = "";
			}

			$output .= "<div id='header_main_alternate' class='container_wrap'>";
			$output .= "<div class='container'>";
		}

		$avia_theme_location = 'avia';
		$avia_menu_class = $avia_theme_location . '-menu';

		$main_nav = "<nav class='main_menu' data-selectname='" . __('Select a page', 'avia_framework') . "' " . avia_markup_helper(array('context' => 'nav', 'echo' => false)) . ">";

		$args = array(
			'theme_location'	=> $avia_theme_location,
			'menu_id' 			=> $avia_menu_class,
			'menu_class'		=> 'menu av-main-nav',
			'container_class'	=> $avia_menu_class . ' av-main-nav-wrap' . $icon_beside,
			'fallback_cb' 		=> 'avia_fallback_menu',
			'echo' 				=>	false,
			'walker' 			=> new avia_responsive_mega_menu()
		);

		$wp_main_nav = wp_nav_menu($args);
		$main_nav .= $wp_main_nav;


		/*
						    * Hook that can be used for plugins and theme extensions
						    */
		ob_start();
		do_action('ava_inside_main_menu'); // todo: replace action with filter, might break user customizations
		$main_nav .= ob_get_clean();

		if ($icon_beside) {
			$main_nav .= $icons;
		}

		$main_nav .= '</nav>';

		/**
		 * Allow to modify or remove main menu for special pages
		 * 
		 * @since 4.1.3
		 */
		$output .= apply_filters('avf_main_menu_nav', $main_nav);

		/*
						    * Hook that can be used for plugins and theme extensions
						    */
		ob_start();
		do_action('ava_after_main_menu'); // todo: replace action with filter, might break user customizations
		$output .= ob_get_clean();

		/* inner-container */
		$output .= "</div>";

		/* end container */
		$output .= " </div> ";


		//output the whole menu     
		echo $output;


		?>

		<!-- end container_wrap-->
	</div>
	<?php
	/**
	 * Add a hidden container for alternate mobile menu
	 * 
	 * We use the same structure as main menu to be able to use same logic in js to build burger menu
	 * 
	 * @added_by Günter
	 * @since 4.5
	 */
	$out_alternate = '';
	$avia_alternate_location = 'avia_alternate';
	$avia_alternate_menu_class = $avia_alternate_location . '_menu';

	if (false !== $alternate_menu_id && is_nav_menu($alternate_menu_id)) {
		$out_alternate .= '<div id="avia_alternate_menu" style="display: none;">';

		$alternate_nav =	"<nav class='main_menu' data-selectname='" . __('Select a page', 'avia_framework') . "' " . avia_markup_helper(array('context' => 'nav', 'echo' => false)) . ">";

		$args = array(
			'menu'				=> $alternate_menu_id,
			'menu_id' 			=> $avia_alternate_menu_class,
			'menu_class'		=> 'menu av-main-nav',
			'container_class'	=> $avia_alternate_menu_class . ' av-main-nav-wrap',
			'fallback_cb' 		=> 'avia_fallback_menu',
			'echo' 				=> false,
			'walker' 			=> new avia_responsive_mega_menu()
		);

		$wp_nav_alternate = wp_nav_menu($args);

		/**
		 * Hook that can be used for plugins and theme extensions
		 * 
		 * @since 4.5
		 * @return string
		 */
		$alternate_nav .=		apply_filters('avf_inside_alternate_main_menu_nav', $wp_nav_alternate, $avia_alternate_location, $avia_alternate_menu_class);

		$alternate_nav .=	'</nav>';

		/**
		 * Allow to modify or remove alternate menu for special pages.
		 * 
		 * @since 4.5
		 * @return string
		 */
		$out_alternate .= apply_filters('avf_alternate_main_menu_nav', $alternate_nav);

		$out_alternate .= '</div>';
	}

	/**
	 * Hook to remove or modify alternate mobile menu
	 * 
	 * @since 4.5
	 * @return string
	 */
	$out_alternate = apply_filters('avf_alternate_mobile_menu', $out_alternate);

	if (!empty($out_alternate)) {
		echo $out_alternate;
	}
	?>
	<div class='header_bg'></div>
	<script type="text/javascript">
	var stylesheet_directory_uri = "<?php echo get_stylesheet_directory_uri(); ?>";
	</script>

	<!-- end header -->
</header>