<?php

/*
* Add your own functions here. You can also copy some of the theme functions into this file. 
* Wordpress will use those functions instead of the original functions then.
*/

add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup()
{
	load_child_theme_textdomain('teknow', get_stylesheet_directory() . '/languages');
}
add_filter('avf_masonry_loop_prepare', 'avf_masonry_loop_prepare_mod_cat', 10, 2);
function avf_masonry_loop_prepare_mod_cat($key, $entries)
{
	$categories = get_the_category($key['ID']);
	$separator = ' ';
	$date = get_the_date('d.m.y');


	$output = '
<div class="ww-masonry-cat">';
	if (!empty($categories)) {
		foreach ($categories as $category) {
			$output .= '<span>' . esc_html($category->name) . '</span>' . $separator;
		}
	}

	$output .= '</div>
';

	$key['text_before'] .= trim($output, $separator);
	return $key;
}






function oceanwp_child_enqueue_parent_style()
{
	// Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update your theme)
	$theme   = wp_get_theme('OceanWP');
	$version = $theme->get('Version');
	// Load the stylesheet
	wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('oceanwp-style'), $version);
	wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
	wp_enqueue_style('custom-doc', get_stylesheet_directory_uri() . '/css/style-doc.css');
	wp_enqueue_style('bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css');
	wp_enqueue_style('slick', get_stylesheet_directory_uri() . '/assets/css/slick.css');
	wp_enqueue_style('slick-theme', get_stylesheet_directory_uri() . '/assets/css/slick-theme.css');
	wp_enqueue_style('custom-style', get_stylesheet_directory_uri() . '/assets/css/style.css');
	wp_enqueue_style('custom-font', get_stylesheet_directory_uri() . '/assets/font/font.css');
	wp_enqueue_style('font-awesome', get_stylesheet_directory_uri() . '/assets/fonts/fontawesome/css/all.min.css', false, '5.15.1');

	wp_enqueue_script('jquery-custom', get_stylesheet_directory_uri() . '/js/jquery-3.5.1.min.js', array(), false, true);
	wp_enqueue_script('popper', get_stylesheet_directory_uri() . '/assets/js/popper.min.js', array('jquery-custom'), false, true);
	wp_enqueue_script('bootstrap', get_stylesheet_directory_uri() . '/assets/js//bootstrap.min.js', array('jquery-custom'), false, true);
	wp_enqueue_script('slick', get_stylesheet_directory_uri() . '/assets/js/slick.js', array('jquery-custom'), false, true);

	wp_enqueue_script('datatablejs', get_stylesheet_directory_uri() . '/assets/DataTables/datatables.min.js', array(), false, true);
	wp_enqueue_style('datatablecss', get_stylesheet_directory_uri() . '/assets/DataTables/datatables.min.css');
	wp_enqueue_script('validatejs', get_stylesheet_directory_uri() . '/assets/jquery-validation/js/jquery.validate.min.js', array(), false, true);
	wp_enqueue_script('customjs', get_stylesheet_directory_uri() . '/js/custom.js', array(), false, true);
	// wp_enqueue_script('search-engine', get_stylesheet_directory_uri() . '/js/search-engine.js', array('jquery-custom'), false, true);
	wp_enqueue_script('jquery-search-filter', get_stylesheet_directory_uri() . '/js/search-engine-filter.js', array(), false, true);
}
add_action('wp_enqueue_scripts', 'oceanwp_child_enqueue_parent_style');


define('THEME_URI', get_template_directory_uri());
define('THEME_PATH', get_template_directory());

/**
 * Register Custom Navigation Walker
 */
function register_navwalker()
{
	require_once get_stylesheet_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action('after_setup_theme', 'register_navwalker');
// add_action('wp_enqueue_scripts', 'invincix_scripts');
if (!file_exists(get_stylesheet_directory() . '/class-wp-bootstrap-navwalker.php')) {
	// File does not exist... return an error.
	return new WP_Error('class-wp-bootstrap-navwalker-missing', __('It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker'));
} else {
	// File exists... require it.
	require_once get_stylesheet_directory() . '/class-wp-bootstrap-navwalker.php';
}


require_once get_stylesheet_directory() . '/inc/document_status.php';

add_filter('post_row_actions', 'remove_row_actions_post', 10, 2);
function remove_row_actions_post($actions, $post)
{
	$user = wp_get_current_user();
	if ((($post->post_type === 'article') || ($post->post_type === 'event') || ($post->post_type === 'news')) &&  $post->post_status == 'ready-for-review') {

		unset($actions['trash']);
		unset($actions['dpp']);
	}
	// if (($post->post_status === 'publish' && ($user->roles[0] === 'integrator' || $user->roles[0] === 'reviewer' )) || ($post->post_status === 'publication-review' && ($user->roles[0] === 'integrator' || $user->roles[0] === 'reviewer' ))) {
	// 	unset($actions['edit']);
	// 	unset($actions['dpp']);
	// 	unset($actions['inline hide-if-no-js']);
	// }
	if (($post->post_status === 'publish' && ($user->roles[0] === 'integrator' || $user->roles[0] === 'reviewer' ))) {
			//unset($actions['edit']);
			unset($actions['dpp']);
			unset($actions['inline hide-if-no-js']);
		}

	// if ($post->post_status === 'publication-review' && ($user->roles[0] === 'integrator' || $user->roles[0] === 'reviewer' )) {
	// 	unset($actions['dpp']);
	// 	unset($actions['inline hide-if-no-js']);
	// }

	if ($post->post_status === 'publication-review' && ($user->roles[0] === 'integrator')) {
		//unset($actions['edit']);
		unset($actions['dpp']);
		unset($actions['inline hide-if-no-js']);
	}

	if ($post->post_status === 'publication-review' && ($user->roles[0] === 'reviewer')) {
		unset($actions['dpp']);
		unset($actions['inline hide-if-no-js']);
	}


	return $actions;
}

add_action('admin_head', 'hide_edit_permalinks_admin_css');

function hide_edit_permalinks_admin_css()
{
	if (current_user_can('remove_integrator_publish_item') || current_user_can('remove_reviewer_publish_item')) {
?>
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('#wp-admin-bar-publishpress_debug').remove();
    jQuery('#toplevel_page_pp-manage-roles').remove();
    jQuery('#menu-comments').remove();
    //temporary commenting for update button
    // jQuery('#publishing-action #publish').remove();
    // jQuery('#publishing-action').remove();
    jQuery(' #major-publishing-actions .clear').empty();
});
</script>

<?php
	}
	if (current_user_can('remove_publisher_publish_item')) {
?>
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('#wp-admin-bar-publishpress_debug').remove();
    // 				jQuery('#toplevel_page_pp-manage-roles').remove();
    jQuery('#toplevel_page_pp-manage-roles .pp-version-notice-upgrade-menu-item').remove();

});
</script>

<?php
	}
	if (current_user_can('remove_article_add_new')) {
?>
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('#page-title-action').remove();

});
</script>

<?php
	}
}
/*function remove_add_new_button()
{
    if (current_user_can('remove_article_add_new')) {
        global $submenu;
        unset($submenu['edit.php?post_type=article'][10][0]);
        unset($submenu['edit.php?post_type=article'][10][1]);
        unset($submenu['edit.php?post_type=article'][10][2]);
    }
}
add_action('admin_menu', 'remove_add_new_button');*/


function teknow_add_custom_field_automatically($post_id)
{
	global $wpdb;
	$votes_count = get_post_meta($post_id, 'revision_count', true);
	$revision_count = (int)$votes_count + 1;
	update_post_meta($post_id, 'revision_count', $revision_count);
	$revisions = new WP_Query(array(
		'post_status'       => 'inherit',
		'post_type'         => 'revision',
		'posts_per_page'    => 1,
		'orderby'           => 'ID'
	));
	$lastRevisionID = array();
	$formatRevisions = array();
	if ($revisions->have_posts()) :
	while ($revisions->have_posts()) : $revisions->the_post();
	$lastRevisionID[] = get_the_ID() + 1;
	endwhile;
	endif;
	wp_reset_postdata();
	if (!empty($lastRevisionID)) {
		$formatRevisions = array('revision_id' => $lastRevisionID[0], 'revision_version' => $revision_count);
	} else {
		$formatRevisions = array('revision_id' => 1, 'revision_version' => $revision_count);
	}
	$getCustomRevisions = get_post_meta($post_id, 'custom_revisions');
	$parseRevisions = array();
	if (!empty($getCustomRevisions)) {
		$oldRevisions = $getCustomRevisions[0];
		$convertArr = (array)json_decode($oldRevisions);
		if (count($convertArr) > 0) {
			foreach ($convertArr as $key => $value) {
				$parseRevisions[] = (array)$value;
			}
			$parseRevisions[] = $formatRevisions;
		}
		update_post_meta($post_id, 'custom_revisions', json_encode($parseRevisions));
	} else {
		update_post_meta($post_id, 'custom_revisions', json_encode(array($formatRevisions)));
	}
}
add_action('publish_article', 'teknow_add_custom_field_automatically');


function display_custom_post_status_option()
{
	global $post;

	$user = wp_get_current_user();

	if (($post->post_type == 'article') || ($post->post_type == 'event')  || ($post->post_type == 'news')) {
		if ($user->roles[0] === 'integrator') {
			echo '<script>
            jQuery(window).on("load", function() {
                jQuery("select#post_status option").remove();
                jQuery("select#post_status").append("<option value=\"draft\">Draft</option><option value=\"ready-for-review\">Ready for Review</option>");
                 jQuery(".inline-edit-status select option").remove();
                jQuery(".inline-edit-status select").append("<option value=\"draft\">Draft</option><option value=\"ready-for-review\">Ready for Review</option>");
            }); </script>
            ';
		} else if ($user->roles[0] === 'reviewer') {
			echo '<script>
            jQuery(window).on("load", function() {
                jQuery("select#post_status option").remove();
               jQuery("select#post_status").append("<option value=\"draft\">Draft</option><option value=\"ready-for-review\" >Ready for Review</option><option value=\"publication-review\">Ready for Publish</option>");
               jQuery(".inline-edit-status select option").remove();
                jQuery(".inline-edit-status select").append("<option value=\"draft\">Draft</option><option value=\"ready-for-review\" >Ready for Review</option><option value=\"publication-review\">Ready for Publish</option>");
            });
            </script>
            ';
		} else if ($user->roles[0] == 'publisher') {
			echo '<script>
            jQuery(window).on("load", function() {
                jQuery("select#post_status option").remove();
                jQuery("select#post_status").append("<option value=\"draft\">Draft</option><option value=\"ready-for-review\" >Ready for Review</option><option value=\"publication-review\" >Ready for Publish</option><option value=\"publish\">Published</option>");
                jQuery(".inline-edit-status select option").remove();
                jQuery(".inline-edit-status select").append("<option value=\"draft\">Draft</option><option value=\"ready-for-review\" >Ready for Review</option><option value=\"publication-review\" >Ready for Publish</option><option value=\"publish\">Published</option>");

            });
            </script>
            ';
		}
	}
}
add_action('admin_footer', 'display_custom_post_status_option', 11);

function js_footer()
{
?>
<script>
jQuery(document).ready(function() {
    jQuery(".apply-filter").click(function() {
        jQuery(".post-data-grid").css("display", "none");
        // jQuery(".pagination-box").css("display","none");
        var count = 0;
        jQuery("input[name='sector[]']:checked").each(function() {
            var id = jQuery(this).attr('id');
            jQuery("#" + id).css("display", "block");
            count++;
        });
        jQuery("input[name='author[]']:checked").each(function() {
            var id = jQuery(this).attr('id');
            jQuery("#" + id).css("display", "block");
            count++;
        });
        jQuery("input[name='tag[]']:checked").each(function() {
            var id = jQuery(this).attr('id');
            jQuery("#" + id).css("display", "block");
            count++;
        });
        // if(count >= 4){
        //    jQuery(".pagination-box").css("display","block"); 
        // }

    })
    jQuery(".filter_exapandable label").click(function() {
        console.log(jQuery(this));

        if (jQuery(this).hasClass('collapsed-closed')) {
            jQuery(this).removeClass('collapsed-closed');
            jQuery(this).addClass('collapsed-opened');

        } else if (jQuery(this).hasClass('collapsed-opened')) {
            jQuery(this).removeClass('collapsed-opened');
            jQuery(this).addClass('collapsed-closed');

        }
        if (jQuery(this).hasClass('icon-plus-expanded')) {
            jQuery(this).removeClass('icon-plus-expanded');
            jQuery(this).addClass('icon-minus-expanded');

        } else if (jQuery(this).hasClass('icon-minus-expanded')) {
            jQuery(this).removeClass('icon-minus-expanded');
            jQuery(this).addClass('icon-plus-expanded');

        }
        jQuery(this).parent().find("ul.sub-term").toggle();
    });
    jQuery(".sub-term li").click(function() {

        var count = 0;
        jQuery(this).parent().find('li').each(function(index, value) {

            if (jQuery(this).find('input').is(":checked")) {
                count++;
            }
        });

        if (count > 0) {
            jQuery(this).parent().parent().find('input.checkbox-term').attr("checked", "checked");
        } else {
            jQuery(this).parent().parent().find('input.checkbox-term').removeAttr("checked");
        }
    })
});
</script>
<?php
}
add_action('wp_footer', 'js_footer');
// get taxonomies based on cpt
function get_terms_by_custom_post_type($post_type, $taxonomy)
{
	$args = array('post_type' => $post_type);
	$loop = new WP_Query($args);
	$postids = array();
	// build an array of post IDs
	while ($loop->have_posts()) : $loop->the_post();
	array_push($postids, get_the_ID());
	endwhile;
	// get taxonomy values based on array of IDs
	$regions = wp_get_object_terms($postids,  $taxonomy);
	return $regions;
}
// get site url
add_shortcode('cf7_siteurl', 'custom_siteurl', true);
function custom_siteurl()
{
	return get_site_url();
}
function change_dateformat($params, $content = null)
{

	$data = do_shortcode($content);
	$newDate = date("d/m/Y", strtotime($data));
	return $newDate;
}
add_shortcode('change_date_format', 'change_dateformat');
function change_timeformat($params, $content = null)
{
	setlocale(LC_TIME, "fr_FR");
	$data = do_shortcode($content);

	$newtime = strftime(" %T ", strtotime($data));
	return $newtime;
}
add_shortcode('change_time_format', 'change_timeformat');

function return_taxonomylist($taxonomy)
{

	$terms = get_terms(array(
		'taxonomy'   => $taxonomy,
		'hide_empty' => false,
		'parent' => 0,
	));
	if (!empty($terms) && is_array($terms)) {
		foreach ($terms as $term) {

?>
<!-- Add id field for querying this li in search-filter.js file-->
<li id="dynfilter-<?= $taxonomy ?>-<?= $term->term_id ?>" class="p-0 filter_exapandable">

    <input id="filter-<?= $taxonomy ?>-<?= $term->term_id ?>" type="checkbox" value="<?= $term->term_id ?>"
        name="<?= $taxonomy ?>[]" class="checkbox-term" />

    <?php
			$childterms = get_terms(array(
				'taxonomy'   => $taxonomy,
				'parent' => $term->term_id,
				'orderby' => 'slug',
				'hide_empty' => false
			));
								   // print_r($childterms);exit();
								   if (count($childterms) != 0) {
									   echo '<label class="filter-expandable-label icon-plus-expanded haschild">' . $term->name . '</label>';
									   echo '<ul class="sub-term collapsed-closed ">';
									   foreach ($childterms as $child) {
	?>
<li class="p-0">
    <label for="filter-<?= $taxonomy ?>-<?= $child->term_id ?>">
        <input id="filter-<?= $taxonomy ?>-<?= $child->term_id ?>" type="checkbox" value="<?= $child->term_id ?>"
            name="<?= $taxonomy ?>[]" />
        <?php echo $child->name; ?>
    </label>
    <?php
									   }
									   echo '</ul>';
								   } elseif (count($childterms) === 0) {
									   echo '<label class="filter-expandable-label">' . $term->name . '</label>';
								   }
	?>
</li>
<?php
								  }
	}
}

function event_shortcode()
{
	$events = get_posts(array('post_type' => 'event'));

	if (!empty($events) && is_array($events)) {
		echo '<div class="events page-summary">';
		foreach ($events as $event) {

			$display_name = get_the_author_meta('display_name', $event->post_author);
			$event_date = get_field('event_date', $event->ID);
			$summary = get_field('summary', $event->ID);
			$detail = get_field('detail', $event->ID);
			$announcement = get_field('announcement', $event->ID);
			$minutes = get_field('minutes', $event->ID);
			$post_thumbnail_id = get_post_thumbnail_id($event->ID);

?>
<div class="card page-summary-card mb-4">
    <div class="card-body pt-0 pb-4 px-0 d-flex">
        <div class="align-items-center justify-content-center">
            <img src="<?= wp_get_attachment_image_src($post_thumbnail_id, 'full')[0]  ?>"
                class="feat-                          img" alt="<?= $event->post_title ?>">
        </div>
        <div class="hc-lh-sm">
            <a href="<?= $event->guid ?>">
                <h3 class="m-0 hc-fs-36 hc-fw-700 hc-color-primary">
                    <?= $event->post_title ?>
                </h3>
            </a>
            <span class="hc-fs-18 hc-fw-400"><?= $display_name ?> |
                <?= date("F j, Y", strtotime($event->post_date))  ?></span>
            <p class="card-text my-4 hc-lh-base">
                <?= $event->post_excerpt ?>
            </p>
            <div>
                <span class="hc-fs-18 text-uppercase">
                    <p class="hc-color-secondary">
                        <b>Event Detail:</b><br><br> <?= $detail ?>
                    </p>
                    <p class="hc-color-secondary">
                        <b> Event Announcement:</b><br><br> <?= $announcement ?>
                    </p>
                </span>
            </div>
        </div>
    </div>
</div>
<?php
		}
		echo '</div>';
	}
}
add_shortcode('get_all_events', 'event_shortcode');
// functions for pagination on news page.
function news_page_numeric_posts_nav()
{

	if (is_singular())
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if ($wp_query->max_num_pages <= 1)
		return;

	$paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
	$max   = intval($wp_query->max_num_pages);

	/** Add current page to the array */
	if ($paged >= 1)
		$links[] = $paged;

	/** Add the pages around the current page to the array */
	if ($paged >= 3) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if (($paged + 2) <= $max) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="navigation"><ul>' . "\n";

	/** Previous Post Link */
	if (get_previous_posts_link())
		printf('<li>%s</li>' . "\n", get_previous_posts_link());

	/** Link to first page, plus ellipses if necessary */
	if (!in_array(1, $links)) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link(1)), '1');

		if (!in_array(2, $links))
			echo '<li>…</li>';
	}

	/** Link to current page, plus 2 pages in either direction if necessary */
	sort($links);
	foreach ((array) $links as $link) {
		$class = $paged == $link ? ' class="active"' : '';
		printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)), $link);
	}

	/** Link to last page, plus ellipses if necessary */
	if (!in_array($max, $links)) {
		if (!in_array($max - 1, $links))
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max)), $max);
	}

	/** Next Post Link */
	if (get_next_posts_link())
		printf('<li>%s</li>' . "\n", get_next_posts_link());

	echo '</ul></div>' . "\n";
}


/* to support displaying custom post types */

add_theme_support('add_avia_builder_post_type_option');
add_theme_support('avia_template_builder_custom_post_type_grid');




/* to display advanced portfolio setting */

add_filter('avf_builder_boxes', 'enable_boxes_on_posts');
function enable_boxes_on_posts($boxes)
{
	$boxes[] = array('title' => __('Avia Layout Builder', 'avia_framework'), 'id' => 'avia_builder', 'page' => array('portfolio', 'page', 'post', 'article'), 'context' => 'normal', 'expandable' => true);
	$boxes[] = array('title' => __('Layout', 'avia_framework'), 'id' => 'layout', 'page' => array('portfolio', 'page', 'post', 'article'), 'context' => 'side', 'priority' => 'low');
	$boxes[] = array('title' => __('Additional Article Settings', 'avia_framework'), 'id' => 'preview', 'page' => array('portfolio', 'article'), 'context' => 'normal', 'priority' => 'high');

	return $boxes;
}



function avf_alb_supported_post_types_mod(array $supported_post_types)
{
	$supported_post_types[] = 'event';
	return $supported_post_types;
}
add_filter('avf_alb_supported_post_types', 'avf_alb_supported_post_types_mod', 10, 1);
function avf_metabox_layout_post_types_mod(array $supported_post_types)
{
	$supported_post_types[] = 'event';
	return $supported_post_types;
}
add_filter('avf_metabox_layout_post_types', 'avf_metabox_layout_post_types_mod', 10, 1);





function remove_menus()
{
	remove_menu_page('edit.php');
	remove_menu_page('tools.php');
	remove_menu_page('admin.php?page=visualizer');
}

add_action('admin_menu', 'remove_menus');

function check_new_vs_update($post_id)
{
	$myPost   = get_post($post_id);
	$user = wp_get_current_user();
	$post_date  = new DateTime($myPost->post_date_gmt);
	$post_modified = new DateTime($myPost->post_modified_gmt);
	if ($user->roles[0] === 'publisher') {

		if (date_format($post_date, 'F j, Y') != get_the_date() && $myPost->post_type == 'article' && $myPost->post_status == 'publish') {
			$post->post_status = 'draft';
			wp_update_post($post);
		}
	}
}
add_action('save_post', 'check_new_vs_update');

/*remove search from header menu*/
add_filter('wp_nav_menu_items', 'avia_append_search_nav', 10, 2);

function avia_append_search_nav($items, $args)
{

	if ($args->theme_location == 'avia') {
		$search_form = get_search_form(false);
		$items = '<li id="menu-item-searchbox" class="fixed-element">' . $search_form . '' . $items;
	}
	return $items;
}
function event_shortcode_summant($atts, $content = null)
{
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array(
		'post_type' => $atts['type'],
		'posts_per_page' => 5,
		'paged' => get_query_var('paged') ?? 1
	);
	$the_query = new WP_Query($args);

	if ($the_query->have_posts()) :
	echo '<div class="events--details"><div class="events-type-panels"><div id="all-panel" class="events-type-panel active">';
	while ($the_query->have_posts()) : $the_query->the_post();
	
	

?>
<article class="event-entry " id="event-<?= the_ID() ?>">
    <div class="event-meta">
        <a href="<?= the_permalink() ?>" class="event-preview" title="<?= the_title() ?>">
            <img width="180" height="180" src="<?= the_post_thumbnail_url() ?>" class="wp-event-image" alt="">
        </a>
    </div>
    <div class="event-content">
        <div class="event-content-header">
            <h2 class="post-title event-title ">
                <a href="<?= the_permalink() ?>" rel="bookmark" title="<?= the_title() ?>">
                    <?= the_title() ?>
                    <span class="post-format-icon minor-meta"></span>
                </a>
            </h2>
            <span class="event-meta-infos">
                <span class="text-date">
                    <?php if($atts['type'] == 'event'):?>
                    <?= get_field('occurence_date',get_the_ID()) ?>
                    <?php else:?>
                    <?= the_time('F j, Y') ?>
                    <?php endif; ?>
                </span>
                <span class="text-sep text-sep-comment">/</span>
                <span class="event-author-link">

                    by <?= the_author_posts_link() ?>

                </span>
            </span>
        </div>
        <div class="event-content-excerpt">
            <p><?= the_excerpt() ?></p>
        </div>
        <div class="event-read-more-link">
            <a href="<?= the_permalink() ?>" class="event-more-link">
                Lire la suite<span class="more-link-arrow"></span>
            </a>
        </div>
    </div>


</article>
<?php
		endwhile;
	$total_pages = $the_query->max_num_pages;

	if ($total_pages > 1) {
		$current_page = max(1, get_query_var('paged'));

		$paginate_links = paginate_links(array(
			'base'         => get_pagenum_link(1) . '%_%',
			'format' => 'page/%#%',
			'current' => $current_page,
			'total' => $total_pages,
			'end_size'     => 2,
			'mid_size'     => 3,
			'prev_next'    => True,
			'prev_text'    => __('«'),
			'next_text'    => __('»'),
		));

		print_r($paginate_links);
	} else {
		echo '<span aria-current="page" class="page-numbers current">3</span>';
		//echo '<span class="pagination-meta">Page sur </span>';
	}
	echo '<span class="pagination-meta">Page ' . $current_page . ' sur ' . $total_pages . '</span>';
	echo '</div></div></div>';
	endif;
}
add_shortcode('get_events_summary', 'event_shortcode_summant');

add_shortcode('get_event_listing','shortcode_event_listing');
function shortcode_event_listing($atts, $content = null){

$custom_post_type  = 'event';
$custom_date_field = 'occurence_date';
$order             = 'DESC'; // from the oldest to the newest

// query
$the_query = new WP_Query( [
    'post_type'      => $custom_post_type,
    'meta_key'       => $custom_date_field,
    'orderby'        => 'meta_value',
    'order'          => $order,
] );

// We are creating new multidimensional array
$all_events = [];
$year = [];
while ( $the_query->have_posts() ) :
    $the_query->the_post();

    $date       = strtotime( get_post_meta( get_the_ID(), $custom_date_field, true ) );
    $month_year = date( "F Y", $date );
   
    $all_events[ $month_year ][] = $the_query->post;

endwhile;
wp_reset_query();
// And to print this:
foreach ( $all_events as $month_year => $events ) : 
    $month_year_arr = explode(' ', $month_year);
    $month = $month_year_arr[0];
    $year = $month_year_arr[1];
    
    ?>
<div class="events-card card col-xl-12 color col-md-12  mt-5"
    style="box-shadow: 0 5px 15px 0 rgba(32,39,48,.16); cursor: pointer;border: 1px solid rgba(0,0,0,.125);">
    <div class="card-body pl-xl-2 pr-xl-2 disabled ">
        <div class="row visibleonly1200 pb-3"><a id="inscription" name="inscription"> </a></div>
        <div class="row ">
            <div class="col-xl-2 col-lg-2 col-md-12 d-none d-xl-block ">
                <hr align="left" class="mt-0"
                    style="height: 2px; color: #3E4845; background-color: #3E4845; width: 70%; border: none;">
                <a id="inscription" name="inscription"> </a>
                <p style="color: #3E4845;line-height:25px; font-size:22px; font-weight: 700"><span
                        class="month-style"><?= $month ?></span><br>
                    <?= $year ?>
                </p>
            </div>
            <div class="col-xl-10 col-lg-10 col-md-12 d-none d-xl-block ">

                <?php 
                    /** @var \WP_Post $event */
                    foreach ( $events as $event ) : 
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $event->ID ), 'single-post-thumbnail' )[0];?>
                <div class="row ">
                    <div
                        class="pr-3 pl-3 text-xl-center text-lg-left col-xl-3 d-none d-lg-block col-md-4 col-sm-12 col-lg-4 marge1400 ">
                        <img alt="Placeholder image" class="rounded height100" height="" src="<?= $image ?>"
                            style="max-width: 230px">
                    </div>
                    <div
                        class="col-xl offset-xl-0 mt-3 mt-lg-0 col-12 adaptationimage col-sm-12 col-lg-8 col-md-12 marge1200 pl-0 pl-lg-3">
                        <div class="row">
                            <div class="col-xl-5 col-lg-5 col-md-4 col-sm-4 btn-group-vertical">

                                <table border="0" cellpadding="0" cellspacing="0" class="text-center"
                                    style="background-color: #DFDFDF; color: #FFFFFF" width="130">
                                    <tbody>
                                        <tr>
                                            <th class="py-1" scope="col"
                                                style="text-transform: uppercase; font-size:14px; color: #3E4845;">
                                                WEBINAIRE</th>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="col-xl-7 border-right-0 col-lg-7 col-md-8 col-sm-8 mt-3 mt-sm-0"
                                style="text-align: right">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <th class="text-left text-md-right text-xl-left pt-0"
                                                style="font-weight: 700; font-size: 15px">En partenariat avec&nbsp;</th>
                                            <th class="text-right ml-1" width="135"><img alt="Placeholder image"
                                                    src="https://cxp-prd-s3-cxp-statics.s3.eu-west-3.amazonaws.com/FR/Landing-Page/Webinars_2020/Ad+Ultima+Group_Logo.png"
                                                    style="text-align: left;" width="130"></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <h5 class="card-title mt-3" style="line-height: 30px; font-weight: 400"><b>Transformer son SI
                                pour accueillir l'industrie 4.0 </b></h5>
                        <hr align="left" class="mt-0"
                            style="height: 1px; color: #3E4845; background-color: #C0C0C0; width: 30%; border: none;">
                        <div class="row">
                            <div
                                class="pl-2 col-12 offset-xl-0 offset-lg-0 col-lg-5 offset-md-0 col-md-4 col-xl-5 pl-3 text-md-center text-lg-left col-sm-5">
                                <img alt="Placeholder image" class="mb-2 mr-2 calendrier-icon" height="25"
                                    src="https://cxp-prd-s3-cxp-statics.s3.eu-west-3.amazonaws.com/FR/Events_Images/Webinar_9_juillet_2020/Calendrier_picto.png">
                                <span style="font-size: 14px; line-height:15px; color: #3E4845; font-weight: 400">Jeudi
                                    28 janvier</span>
                            </div>
                            <div
                                class="pl-2 col-12 col-lg-3 col-xl-3 col-sm-3 col-md-4 pl-3 text-md-center text-lg-left mt-3 mt-sm-1">
                                <img alt="Placeholder image" class="mr-2 mb-1 horloge-icon" height="24"
                                    src="https://cxp-prd-s3-cxp-statics.s3.eu-west-3.amazonaws.com/FR/Events_Images/Webinar_9_juillet_2020/Horloge_picto.png">
                                <span
                                    style="font-size: 14px; line-height:15px; color: #3E4845; font-weight: 400">9h</span>
                            </div>
                            <div
                                class="pl-2 col-lg-4 col-12 offset-md-0 offset-sm-0 col-md-4 col-xl-4 mt-3 mt-sm-1 text-md-center text-lg-left col-sm-4 pl-3">
                                <img alt="Placeholder image" class="mr-2 mb-1 picto-icon" height="22"
                                    src="https://cxp-prd-s3-cxp-statics.s3.eu-west-3.amazonaws.com/FR/Landing-Page/Webinars_2020/picto_webinar.png">
                                <span
                                    style="font-size: 14px; line-height:15px; color: #3E4845; font-weight: 400">Online</span>
                            </div>
                        </div>
                        <div class="row align-items-xl-end mt-4">
                            <div
                                class="col-sm-6 offset-xl-0 pl-sm-1 col-12 text-center text-sm-center text-lg-left col-xl-6 pl-lg-3">
                                <a class="btn btn-primary pt-2 pb-2 taillebouton colorbutton"
                                    href="https://www.myteknow.com/pages/events/webinar-transformer-son-si-vers-industrie"
                                    target="_blank">Découvrir </a>
                            </div>
                            <div class="col-sm-6 col-12 text-center text-sm-center text-lg-left mt-3 mt-sm-0 col-xl-6">
                                <a class="btn btn-primary pt-2 pb-2 taillebouton colorbutton"
                                    href="https://register.gotowebinar.com/register/5321548725581002765"
                                    target="_blank">S'inscrire</a>
                            </div>
                        </div>
                    </div>

                </div>
                <hr class="text-center justify-content-xl-center align-self-xl-center" style="text-center" width="70%">
                <?php endforeach; ?>

            </div>

        </div>
    </div>
</div>
<?php endforeach;
}
function css_footer()
{

	if (is_page(1471) || is_page(1307) || is_page(1689)) {
?>
<style>
.stretch_full.container_wrap.alternate_color.light_bg_color.title_container {
    display: none;
}

.pp-multiple-authors-wrapper {
    display: none;
}

.entry-footer {
    display: none;
}

.comment-entry.post-entry {
    display: none;
}

.main_color.container_wrap_first.container_wrap.fullsize {
    border: none;
}
</style>
<?php
	}
	if (is_single()) {
?>
<style>
.stretch_full.container_wrap.alternate_color.light_bg_color.title_container {
    display: none;
}

.av-parallax.enabled-parallax.active-parallax.enabled-parallax {
    display: none;
}

/* 	.pp-multiple-authors-wrapper {
		display: none;
	} */

main.template-page.content.av-content-full.alpha.units {
    display: none;
}

footer.entry-footer {
    background: #fff;
}

.related_posts .wp-post-image {
    height: 145px;
    width: 145px;
}

.related_posts .related_entries_container {
    align-items: center;
    display: flex;
    justify-content: center;
}

.av-share-box h5.av-share-link-description.av-no-toc {
    font-size: 16px;
    line-height: 1.1em;
    font-weight: 600;
}

.related_posts h5.related_title {
    font-size: 16px;
    line-height: 1.1em;
    font-weight: 600;
}

/*.big-preview img {
	height: 413px;
	width: 1194px;
	}*/
</style>
<?php
	}
	global $post;
	if (is_single() && ($post->post_type == 'event')) {
?>
<style>
.pp-multiple-authors-wrapper {
    display: none;
}
</style>
<?php
	}
}
add_action('wp_footer', 'css_footer');

/* DISABLE PUBLISH BUTTON FOR EVENTS */
function disable_publish_button_events(){

	$cpt_type = 'event';
	global $post;
	if($post->post_type == $cpt_type){
		echo '              
		<style>
                    #publish{
                        display:none!important;
                    }
#minor-publishing-actions div:nth-child(1) input{display: block!important;}

				#minor-publishing-actions{display: flex!important;
				flex-direction: column;
				text-align: left;
				}	
					#minor-publishing-actions input, #minor-publishing-actions a{width:  100%;}
                </style>

				';

	}	

	$ID = get_the_ID();

	if((get_post_status( $ID ) == 'publish')){
		echo '<style>

	         #publish{
                        display:block!important;
                    }
					
	</style>';

	}	


}
add_action('admin_head-post.php','disable_publish_button_events');
add_action('admin_head-post-new.php', 'disable_publish_button_events');



/* DISABLE PUBLISH BUTTON FOR NEWS */
function disable_publish_button_news(){

	$cpt_type = 'news';
	global $post;
	if($post->post_type == $cpt_type){
		echo '              
		<style>
                 #publish{
                        display:none!important;
                    }
					
#minor-publishing-actions div:nth-child(1) input{display: block!important;}

				#minor-publishing-actions{display: flex!important;
				flex-direction: column;
				text-align: left;
				}	
					#minor-publishing-actions input, #minor-publishing-actions a{width:  100%;}
                </style>
				';
	}
	$ID = get_the_ID();

	if((get_post_status( $ID ) == 'publish')){
		echo '<style>

	         #publish{
                        display:block!important;
                    }
	</style>';

	}	

}
add_action('admin_head-post.php','disable_publish_button_news');
add_action('admin_head-post-new.php', 'disable_publish_button_news');



/* DISABLE PUBLISH BUTTON FOR ARTICLES */
function disable_publish_button_articles(){

	$cpt_type = 'article';
	global $post;
	if($post->post_type == $cpt_type){
		echo '              
		<style>
                 #publish{
                        display:none!important;
                    }

				#minor-publishing-actions{display: flex!important;
				flex-direction: column;
				text-align: left;
				}	#minor-publishing-actions div:nth-child(1) input{display: block!important;}
					#minor-publishing-actions input, #minor-publishing-actions a{width:  100%;}
                </style>
				';

	}
	
		$ID = get_the_ID();

	if((get_post_status( $ID ) == 'publish')){
		echo '<style>

	         #publish{
                        display:block!important;
                    }
	</style>';

	}	

}
add_action('admin_head-post.php','disable_publish_button_articles');
add_action('admin_head-post-new.php', 'disable_publish_button_articles');










// gagan

add_action('wp_enqueue_scripts', 'add_custom_js');
function add_custom_js() {	
	wp_enqueue_style('bootstrap-select', get_stylesheet_directory_uri() . '/css/bootstrap-select.css');
	wp_enqueue_script('bootstrap-select', get_stylesheet_directory_uri() . '/js/bootstrap-select.js', array(), false, true);

}

add_action( 'init', 'verify_user_code' );
function verify_user_code(){
    if(isset($_GET['act'])){
        $data = unserialize(base64_decode($_GET['act']));
        $code = get_user_meta($data['id'], 'activation_code', true);
        // verify whether the code given is the same as ours
        if($code == $data['code']){
            // update the user meta
			update_user_meta($data['id'], 'account_activated', 1);
			redirect_to_login();
            //wc_add_notice( __( '<strong>Success:</strong> Your account has been activated! ', 'text-domain' )  );
        }
    }
}

function redirect_to_login(){
	$redirecturl = get_site_url();
	wp_redirect( $redirecturl . '/login/' );
	exit;
}
add_action( 'verify_user_code', 'redirect_to_login', 11 );


// end of code - gagan

/* Document versioning */

// setting a version slug
add_filter('wp_post_revision_meta_keys', 'wpse_track_slug_postmeta');

function wpse_track_slug_postmeta() {
    // Access the array of postmeta keys that is already versioned
    global $versionedKeys;

    // Add your custom postmeta key to the array
    $versionedKeys[] = 'versionedSlug';

    // Pass the array back to WordPress
    return $versionedKeys;
}

//updating version slug for post updates
function check_update_revision_version( $post_id ){

    $myPost   = get_post($post_id);
    $user = wp_get_current_user();

    wp_update_post( $post );

    $q = wp_get_post_revisions( $post_id );
   
    $count = count( $q );
// 	if($count == 0){ $count = 1 ;}
    update_post_meta($post_id, 'versionedSlug', 'V'.$count);
    
}
add_action('save_post', 'check_update_revision_version' );

function display_revision()
{
    global $post;

    if (($post->post_type == 'article') || ($post->post_type == 'event')  || ($post->post_type == 'news')) {
        $q = wp_get_post_revisions( $post->ID );
        $version = get_post_meta($post->ID, 'versionedSlug', true);
       if (count($q) > 0  && $q && $version != 'V1') {
             // $version = get_post_meta($post->ID, 'versionedSlug', true);
            echo '<script>
            jQuery(window).on("load", function() {
                 jQuery(".misc-pub-revisions b").remove();
                 jQuery("<b>'.$version.' </b> ").insertBefore(".misc-pub-revisions a");
            }); </script>
            ';
        } elseif ($version == 'V1') {
            $html = '<div class="misc-pub-section misc-pub-revisions">Versions: <b>V1 </b> </div>';
            echo "<script>
            jQuery(window).on('load', function() {
                jQuery('.misc-pub-curtime').before('".$html."');
            }); </script>
            "; 
        } 
    }
}
add_action('admin_footer', 'display_revision', 11);

//change text
function change_revision_text( $translated_text, $text, $text_domain ) {

    $translated_text = str_ireplace( 'Revisions', 'Versions', $translated_text );
   
    return $translated_text;
}

add_filter ( 'gettext', 'change_revision_text',  20, 3);
/* End Document versioning */



/*
By:Bhagyashree
Function For:Prospect Register form shortcode
*/
function prospect_register() {
	ob_start();
	require_once('user-registration.php');
	return ob_get_clean();	
} 
add_shortcode( 'prospect_register', 'prospect_register' );
/*
By:Bhagyashree
Function For:myteknow company details
*/
function company_details() {
	ob_start();
	require_once('company_details.php');
	return ob_get_clean();	
} 
add_shortcode( 'company_details', 'company_details' );
/*
By:Bhagyashree
Function For:myteknow  edit company details
*/
function edit_company() {
	ob_start();
	require_once('edit_company.php');
	return ob_get_clean();	
} 
add_shortcode( 'edit_company', 'edit_company' );
/*
By:Bhagyashree
Function For:myteknow  add user
*/
function add_usermyteknow() {
	ob_start();
	require_once('add_user.php');
	return ob_get_clean();	
} 
add_shortcode( 'add_usermyteknow', 'add_usermyteknow' );
/*
By:Bhagyashree
Function For:myteknow  Edit user
*/
function edit_usermyteknow() {
	ob_start();
	require_once('edit_user.php');
	return ob_get_clean();	
} 
add_shortcode( 'edit_usermyteknow', 'edit_usermyteknow' );

/*
By:Bhagyashree
Function For:myteknow company list
*/
function companies_list() {
	ob_start();
	require_once('template_manage_companies.php');
	return ob_get_clean();	
} 
add_shortcode( 'companies_list', 'companies_list' );
/*
By:Bhagyashree
Function For:change password on frontend
*/
function changepassword_form() {
	ob_start();
	require_once('change_password.php');
	return ob_get_clean();	
} 
add_shortcode( 'changepassword_form', 'changepassword_form' );

/*
By:Bhagyashree
Function For:Hide wordpress admin bar for prospect & company user & company user manager
*/
function disable_admin_bar() {
	if(is_user_logged_in()){
		$userid=get_current_user_id();
		$user = get_userdata( $userid );
		$user_roles = $user->roles;
		if ( in_array( 'company_user', $user_roles, true ) || in_array( 'company_user_manager', $user_roles, true ) || in_array( 'prospect', $user_roles, true ) || in_array('myteknow_user_manager',$user_roles,true) ) {
			show_admin_bar(false);
		}
	}
}
add_action('after_setup_theme', 'disable_admin_bar');

/*
By:Bhagyashree
Function For:encrypt & decrypt data
*/
function encryption($value){
	$ciphering = "AES-128-CTR"; 
	$encryption_iv = '123456789ABCDEFG'; 
	$encryption_key = "teknow"; 
	$options = 0;
	$encryption = openssl_encrypt($value, $ciphering, $encryption_key, $options, $encryption_iv); 
	return $encryption;
}
function decryption($value){
	$ciphering = "AES-128-CTR"; 
	$decryption_iv = '123456789ABCDEFG'; 
	$decryption_key = "teknow"; 
	$options = 0;
	$decryption=openssl_decrypt ($value, $ciphering,$decryption_key, $options, $decryption_iv); 
	return $decryption;
}
/*
By:Bhagyashree
Function For: adding custom options myteknow admin dashbord 
*/
function addonmenus_forroles() {
	if(is_user_logged_in()){
		$userid=get_current_user_id();
		$user = get_userdata( $userid );
		$user_roles = $user->roles;
		if ( in_array( 'myteknow_admin', $user_roles, true ) ) {
			require_once get_stylesheet_directory() . '/myteknowadmin_addons.php';
		}
	}
}
add_action('after_setup_theme', 'addonmenus_forroles');

/*
By:Bhagyashree
Function For: admin style & css 
*/

function add_customadmin_script() {
	$current_screen = get_current_screen();
	if($current_screen->base=="toplevel_page_manageusers" || $current_screen->base=="manage-users_page_adduser"  || $current_screen->base=="admin_page_edituser"){
		wp_enqueue_script('datatablejs', get_stylesheet_directory_uri() . '/assets/DataTables/datatables.min.js', array(), false, true);
		wp_enqueue_style('datatablecss', get_stylesheet_directory_uri() . '/assets/DataTables/datatables.min.css');
		wp_enqueue_script('validatejs', get_stylesheet_directory_uri() . '/assets/jquery-validation/js/jquery.validate.min.js', array(), false, true);
		wp_enqueue_script('admin-custom-script', get_stylesheet_directory_uri() . '/js/custom-admin.js', array(), false, true);
	    wp_enqueue_style('admin-custom-style', get_stylesheet_directory_uri() . '/css/admin-style.css');
	}
}

add_action('admin_enqueue_scripts', 'add_customadmin_script');


/*Code by smita*/
// add_action('wp_loaded', 'get_multiple_post_types_Alltab');
// function get_multiple_post_types_Alltab(){
// 	$posts1 = wp_remote_get( 'http://aeon2.blvckpixel.com/wp-json/wp/v2/article', array( 'timeout' => 12000, array( 'timeout' => 120, 'httpversion' => '1.1' )  ) );
// 	echo '<pre>';
// 	print_r($posts1);
// 	echo '</pre>';

// 	$posts2 = wp_remote_get( 'http://aeon2.blvckpixel.com/wp-json/wp/v2/event' );

// 	$posts = array_merge( $posts1, $posts2 );

// 	$posts3 = wp_remote_get( 'http://aeon2.blvckpixel.com/wp-json/wp/v2/event' );
// 	$posts = array_merge( $posts , $posts3 );
// 	// print_r($posts);
// 	die('smita here1');
// }
// add_action('rest_api_init', function () {
// 	register_rest_route( 'customposttype', 'all',array(
// 				  'methods'  => 'GET',
// 				  'callback' => 'get_multiple_post_types_Alltab'
// 		));
//   });

function register_my_session()
{
  if( !session_id() )
  {
    session_start();
  }
}

add_action('init', 'register_my_session');
add_action( 'admin_post_short_company', 'save_short_companydetails' );
add_action( 'admin_post_nopriv_short_company', 'save_short_companydetails' );

function save_short_companydetails() {
	
	
  	$name = isset( $_POST['name'] ) ? $_POST['name'] : '';
  	$etablissement = isset( $_POST['etablissement'] ) ? $_POST['etablissement'] : '';
  	$street_address = isset( $_POST['street_address'] ) ? $_POST['street_address'] : '';
  	$address_line = isset( $_POST['address_line'] ) ? $_POST['address_line'] : '';
  	$address_city = isset( $_POST['address_city'] ) ? $_POST['address_city'] : '';
  	$state_address = isset( $_POST['state_address'] ) ? $_POST['state_address'] : '';
  	$zip_address = isset( $_POST['zip_address'] ) ? $_POST['zip_address'] : '';
  	$address_country = isset( $_POST['address_country'] ) ? $_POST['address_country'] : '';
  	$siret = isset( $_POST['siret'] ) ? $_POST['siret'] : '';
  	$activity = isset( $_POST['activity'] ) ? $_POST['activity'] : 'N/A';
  	$site_url = isset( $_POST['site_url'] ) ? $_POST['site_url'] : 'N/A';
  	$name_prefix = isset( $_POST['name_prefix'] ) ? $_POST['name_prefix'] : 'N/A';
  	$first_name = isset( $_POST['first_name'] ) ? $_POST['first_name'] : 'N/A';
  	$last_name = isset( $_POST['last_name'] ) ? $_POST['last_name'] : 'N/A';
  	$fonction = isset( $_POST['fonction'] ) ? $_POST['fonction'] : 'N/A';
  	$contact_email = isset( $_POST['email'] ) ? $_POST['email'] : 'N/A';
  	$phone = isset( $_POST['phone'] ) ? $_POST['phone'] : 'N/A';
  	$domine = isset( $_POST['domine'] ) ? $_POST['domine'] : 'N/A';

  	global $wpdb, $user_id ;
	$user_id = get_current_user_id();
  	$table_prefix = $wpdb->prefix . "companydetails";
	
	//get duplicate count
   	$result = $wpdb->get_row("SELECT count(*) as count, company_id FROM ".$table_prefix." WHERE company_name LIKE '%".$name."' ");

   $duplicate_count = $result->count;
   $lastid = $result->company_id;
   if( $duplicate_count == 0 ){
   		$data = array(        
		   'company_name'     => $name,
		    'company_type'    => $etablissement,
		    'siret' => $siret,
		    'contact_name'     => $name_prefix.' '.$first_name.' '.$last_name,
		    'contact_function'    => $fonction,
		    'contact_email' => $contact_email,
		    'contact_phone'     => $phone,
		    'contact_address'    => $street_address.'<br>'.$address_line,
		    'contact_postal_code' => $zip_address,
		    'contact_city'     => $address_city,
		    'contact_country'    => $address_country,
		    'contact_activity' => $activity,
		    'company_url'     => $site_url,
		    'company_expertise'    => $domine,
		    'myteklist' => 1,
		    'created_by' => $user_id,
		    'created_on' => date('Y-j-n H:m:s')
		);
	
		$insert = $wpdb->insert($table_prefix,$data);
	
		if ($wpdb->last_error) {
		  die('error=' . var_dump($wpdb->last_query) . ',' . var_dump($wpdb->error));
		}


	    $args = array(
		    'role'    => 'administrator',
		    'orderby' => 'user_nicename',
		    'order'   => 'ASC'
		);
		$users = get_users( $args );
		foreach($users as $toemails){
			
			$to[] = $toemails->user_email;
		}
		$html = 'Your Company created successfully.' ;
    	wp_mail($to, 'Company '.$name.' Registered', $html);
		$lastid = $wpdb->insert_id;
   }
   $password = wp_generate_password( 15, true);
  	// print_r($password);exit();
	
	$userdata = array(
            'user_email' => $contact_email,
            'user_login' => $contact_email,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'user_pass' => $password,
			'user_nicename'=>$firstname.'_'.$lastname,
            'role' => 'company_id_card_manager'
        );
	$user = wp_insert_user($userdata);

    wp_update_user(array('ID' => $user, 'role' => 'company_id_card_manager'));
    add_user_meta($user, 'company_name', $name);
    add_user_meta($user, 'companyassigned', $lastid);

    $user_info = get_userdata($user);
    $html = 'Your account created successfully.<br>
    		Email:'.$contact_email.'
    		Password : '. $password ;
    wp_mail($user_info->user_email, 'Registered Password', $html);

 	$_SESSION['contact_id'] = $lastid;
	$redirect = add_query_arg( 'my-form', 'success', 'https://aeon2.blvckpixel.com/simple-long-form/' );
	wp_redirect( $redirect );
	
	die();
}
add_action( 'admin_post_long_contact_company', 'save_long_contactcompanydetails' );
add_action( 'admin_post_nopriv_long_contact_company', 'save_long_contactcompanydetails' );

function save_long_contactcompanydetails() {
  
  	$company_id = isset( $_POST['company_id'] ) ? $_POST['company_id'] : 'N/A';
  	$type = isset( $_POST['type'] ) ? $_POST['type'] : 'N/A';
  	$address_line = isset( $_POST['address'] ) ? $_POST['address'] : 'N/A';
  	$name_prefix = isset( $_POST['title'] ) ? $_POST['title'] : 'N/A';
  	$first_name = isset( $_POST['firstname'] ) ? $_POST['firstname'] : 'N/A';
  	$last_name = isset( $_POST['lastname'] ) ? $_POST['lastname'] : 'N/A';
  	$fonction = isset( $_POST['function'] ) ? $_POST['function'] : 'N/A';
  	$contact_email = isset( $_POST['email'] ) ? $_POST['email'] : 'N/A';
  	$phone = isset( $_POST['phone'] ) ? $_POST['phone'] : 'N/A';
  	$domine = isset( $_POST['expertise'] ) ? $_POST['expertise'] : 'N/A';

  	global $wpdb, $user_id ;
	$user_id = get_current_user_id();
  	$table = $wpdb->prefix . "companycontactdetails";
  	$count = 0;
   	foreach($type as $contact){
   		$data = array(    
   			'company_id' =>  $company_id,
   			'contact_type' =>  $contact,
		    'contact_name'     => $name_prefix[$count].' '.$first_name[$count].' '.$last_name[$count],
		    'contact_function'    => $fonction[$count],
		    'contact_email' => $contact_email[$count],
		    'contact_phone'     => $phone[$count],
		    'contact_address'    => $address_line[$count],
		    'contact_expertise'    => $domine[$count],
		    'created_by' => $user_id,
	    	'created_on' => date('Y-j-n H:m:s')
		);
	
		$insert = $wpdb->insert($table, $data);

		if ($wpdb->last_error) {
		  die('error=' . var_dump($wpdb->last_query) . ',' . var_dump($wpdb->error));
		}
		$count++;
   	}
  	
	$redirect = add_query_arg( 'my-form', 'success', 'https://aeon2.blvckpixel.com/simple-long-form/#contacts' );
	wp_redirect( $redirect );
	
	die();
}

add_action( 'admin_post_long_presentations_company', 'save_long_presentationscompanydetails' );
add_action( 'admin_post_nopriv_long_presentations_company', 'save_long_presentationscompanydetails' );

function save_long_presentationscompanydetails() {

  	$company_id = isset( $_POST['company_id'] ) ? $_POST['company_id'] : 'N/A';

  	$service_software = isset( $_POST['service_software'] ) ? $_POST['service_software'] : 'N/A';
  	$service_description = isset( $_POST['service_description'] ) ? $_POST['service_description'] : 'N/A';
  	$service_type = isset( $_POST['service_type'] ) ? $_POST['service_type'] : 'N/A';
  	$service_customer_activity_sector = isset( $_POST['service_customer_activity_sector'] ) ? $_POST['service_customer_activity_sector'] : 'N/A';
  	$service_client_profile = isset( $_POST['service_client_profile'] ) ? $_POST['service_client_profile'] : 'N/A';
  	$service_coverage_area = isset( $_POST['service_coverage_area'] ) ? $_POST['service_coverage_area'] : 'N/A';
  	$service_contact_principal = isset( $_POST['service_contact_principal'] ) ? $_POST['service_contact_principal'] : 'N/A';
  	$registration_id = isset( $_POST['registration_id'] ) ? $_POST['registration_id'] : 'N/A';

  	$service_logo = '';
    if(!empty($_FILES['service_logo']['tmp_name']) && file_exists($_FILES['service_logo']['tmp_name'])){
        $service_logo = base64_encode(file_get_contents($_FILES['service_logo']['tmp_name']));
        $service_logo = mb_convert_encoding($service_logo, 'UTF-8', 'UTF-8');
        
    }

  	global $wpdb, $user_id ;
	$user_id = get_current_user_id();
  	$table = $wpdb->prefix . "companyregitrationdetails";
  	
	$data = array(    
		'company_id' =>  $company_id,
		'service_logo' => $service_logo,
		'service_software' =>  $service_software,
	    'service_description'     => $service_description,
	    'service_type'    => $service_type,
	    'service_customer_activity_sector' => $service_customer_activity_sector,
	    'service_client_profile'     => $service_client_profile,
	    'service_coverage_area'    => $service_coverage_area,
	    'service_contact_principal'    => $service_contact_principal,
	    'created_by' => $user_id,
    	'created_on' => date('Y-j-n H:m:s')
	);
	
		$insert = $wpdb->update($table, $data, array('company_id' =>  $company_id));
	
	

	if ($wpdb->last_error) {
	  die('error=' . var_dump($wpdb->last_query) . ',' . var_dump($wpdb->error));
	}
		
  	
	$redirect = add_query_arg( 'my-form', 'success', 'https://aeon2.blvckpixel.com/simple-long-form/#contacts' );
	wp_redirect( $redirect );
	
	die();
}

add_action( 'admin_post_long_logiciels_company', 'save_long_logiciels_companydetails' );
add_action( 'admin_post_nopriv_long_logiciels_company', 'save_long_logiciels_companydetails' );

function save_long_logiciels_companydetails() {
 
  	$company_id = isset( $_POST['company_id'] ) ? $_POST['company_id'] : 'N/A';

  	$software_name = isset( $_POST['software_name'] ) ? $_POST['software_name'] : 'N/A';
  	$software_website = isset( $_POST['software_website'] ) ? $_POST['software_website'] : 'N/A';
  	$software_desc_long = isset( $_POST['software_desc_long'] ) ? $_POST['software_desc_long'] : 'N/A';
  	$software_desc_short = isset( $_POST['software_desc_short'] ) ? $_POST['software_desc_short'] : 'N/A';
  	$software_trade = isset( $_POST['software_trade'] ) ? implode(', ', $_POST['software_trade'] ): 'N/A';
  	$software_offers = isset( $_POST['software_offers'] ) ? implode(', ', $_POST['software_offers'] ): 'N/A';
  	$software_domain = isset( $_POST['software_domain'] ) ? $_POST['software_domain'] : 'N/A';
  	$software_creation_date = isset( $_POST['software_creation_date'] ) ? $_POST['software_creation_date'] : 'N/A';
  	
  	$software_version = isset( $_POST['software_version'] ) ? $_POST['software_version'] : 'N/A';
  	$software_version_date = isset( $_POST['software_version_date'] ) ? $_POST['software_version_date'] : 'N/A';
  	$software_pricing = isset( $_POST['software_pricing'] ) ? $_POST['software_pricing'] : 'N/A';
  	$software_certification = isset( $_POST['software_certification'] ) ? $_POST['software_certification'] : 'N/A';
  	$software_lang_avail = isset( $_POST['software_lang_avail'] ) ? implode(', ',$_POST['software_lang_avail']) : 'N/A';
  	$software_client_company = isset( $_POST['software_client_company'] ) ? implode(', ',$_POST['software_client_company']) : 'N/A';
  	$software_data_localization = isset( $_POST['software_data_localization'] ) ? implode(', ', $_POST['software_data_localization'] ) : 'N/A';
  	$software_platform = isset( $_POST['software_platform'] ) ? implode(', ',$_POST['software_platform']) : 'N/A';

  	$software_sgbd = isset( $_POST['software_sgbd'] ) ? $_POST['software_sgbd'] : 'N/A';
  	$software_clients = isset( $_POST['software_clients'] ) ? $_POST['software_clients'] : 'N/A';
  	$software_users = isset( $_POST['software_users'] ) ? $_POST['software_users'] : 'N/A';
  	$software_promo_1 = isset( $_POST['software_promo_1'] ) ? $_POST['software_promo_1'] : 'N/A';
  	$software_promo_2 = isset( $_POST['software_promo_2'] ) ? $_POST['software_promo_2'] : 'N/A';
  	$software_promo_3 = isset( $_POST['software_promo_3'] ) ? $_POST['software_promo_3'] : 'N/A';
  	$software_promo_4 = isset( $_POST['software_promo_4'] ) ? $_POST['software_promo_4'] : 'N/A';
  	$software_promo_5 = isset( $_POST['software_promo_5'] ) ? $_POST['software_promo_5'] : 'N/A';
  	$software_promo_6 = isset( $_POST['software_promo_6'] ) ? $_POST['software_promo_6'] : 'N/A';

  	$software_logo = '';
    if(!empty($_FILES['software_logo']['tmp_name']) && file_exists($_FILES['software_logo']['tmp_name'])){
        $software_logo = base64_encode(file_get_contents($_FILES['software_logo']['tmp_name']));
        $software_logo = mb_convert_encoding($software_logo, 'UTF-8', 'UTF-8');
        
    }
    $software_promo_upload_1 = '';
    if(!empty($_FILES['software_promo_upload_1']['tmp_name']) && file_exists($_FILES['software_promo_upload_1']['tmp_name'])){
        $software_promo_upload_1 = base64_encode(file_get_contents($_FILES['software_promo_upload_1']['tmp_name']));
        $software_promo_upload_1 = mb_convert_encoding($software_promo_upload_1, 'UTF-8', 'UTF-8');
        
    }
    $software_promo_upload_2 = '';
    if(!empty($_FILES['software_promo_upload_2']['tmp_name']) && file_exists($_FILES['software_promo_upload_2']['tmp_name'])){
        $software_promo_upload_2 = base64_encode(file_get_contents($_FILES['software_promo_upload_2']['tmp_name']));
        $software_promo_upload_2 = mb_convert_encoding($software_promo_upload_2, 'UTF-8', 'UTF-8');
        
    }
    $software_promo_upload_3 = '';
    if(!empty($_FILES['software_promo_upload_3']['tmp_name']) && file_exists($_FILES['software_promo_upload_3']['tmp_name'])){
        $software_promo_upload_3 = base64_encode(file_get_contents($_FILES['software_promo_upload_3']['tmp_name']));
        $software_promo_upload_3 = mb_convert_encoding($software_promo_upload_3, 'UTF-8', 'UTF-8');
        
    }
  
  	global $wpdb, $user_id ;
	$user_id = get_current_user_id();
  	$table = $wpdb->prefix . "companyregitrationdetails";
  	
	$data = array(    
		'created_by' => $user_id,
    	'created_on' => date('Y-j-n H:m:s'),
    	'software_logo' => $software_logo,
		'software_name' =>  $software_name,
	    'software_website'     => $software_website,
	    'software_desc_long'    => $software_desc_long,
	    'software_desc_short' => $software_desc_short,
	    'software_trade'     => $software_trade,
	    'software_domain'    => $software_domain,
	    'software_creation_date'    => $software_creation_date,
	    'software_version' =>  $software_version,
	    'software_version_date'     => $software_version_date,
	    'software_pricing'    => $software_pricing,
	    'software_certification' => $software_certification,
	    'software_lang_avail'     => $software_lang_avail,
	    'software_client_company'    => $software_client_company,
	    'software_data_localization'    => $software_data_localization,
	    'software_platform'     => $software_platform,
	    'software_sgbd'    => $software_sgbd,
	    'software_clients'    => $software_clients,
	    'software_users' =>  $software_users,
	    'software_promo_1'     => $software_promo_1,
	    'software_promo_2'    => $software_promo_2,
	    'software_promo_3' => $software_promo_3,
	    'software_promo_4'     => $software_promo_4,
	    'software_promo_5'    => $software_promo_5,
	    'software_promo_6'    => $software_promo_6,
	);
		$insert = $wpdb->update($table, $data, array('company_id' =>  $company_id));
	

	if ($wpdb->last_error) {
	  die('error=' . var_dump($wpdb->last_query) . ',' . var_dump($wpdb->error));
	}
		
  	
	$redirect = add_query_arg( 'my-form', 'success', 'https://aeon2.blvckpixel.com/simple-long-form/' );
	wp_redirect( $redirect );
	die();
}

add_action( 'admin_post_long_enterprise_company', 'save_long_enterprise_companydetails' );
add_action( 'admin_post_nopriv_long_enterprise_company', 'save_long_enterprise_companydetails' );

function save_long_enterprise_companydetails() {
	$company_id = isset( $_POST['company_id'] ) ? $_POST['company_id'] : 'N/A';
	$name = isset( $_POST['name'] ) ? $_POST['name'] : 'N/A';
  	$etablissement = isset( $_POST['etablissement'] ) ? $_POST['etablissement'] : 'N/A';
  	$street_address = isset( $_POST['street_address'] ) ? $_POST['street_address'] : 'N/A';
  	$address_line = isset( $_POST['address_line'] ) ? $_POST['address_line'] : 'N/A';
  	$address_city = isset( $_POST['address_city'] ) ? $_POST['address_city'] : 'N/A';
  	$state_address = isset( $_POST['state_address'] ) ? $_POST['state_address'] : 'N/A';
  	$zip_address = isset( $_POST['zip_address'] ) ? $_POST['zip_address'] : 'N/A';
  	$address_country = isset( $_POST['address_country'] ) ? $_POST['address_country'] : 'N/A';
  	$siret = isset( $_POST['siret'] ) ? $_POST['siret'] : 'N/A';
  	$activity = isset( $_POST['activity'] ) ? implode(", ",$_POST['activity']) : 'N/A';
  	$site_url = isset( $_POST['site_url'] ) ? $_POST['site_url'] : 'N/A';
  	$name_prefix = isset( $_POST['name_prefix'] ) ? $_POST['name_prefix'] : 'N/A';
  	$first_name = isset( $_POST['first_name'] ) ? $_POST['first_name'] : 'N/A';
  	$last_name = isset( $_POST['last_name'] ) ? $_POST['last_name'] : 'N/A';
  	$fonction = isset( $_POST['fonction'] ) ? $_POST['fonction'] : 'N/A';
  	$contact_email = isset( $_POST['email'] ) ? $_POST['email'] : 'N/A';
  	$phone = isset( $_POST['phone'] ) ? $_POST['phone'] : 'N/A';
  	$domine = isset( $_POST['domine'] ) ? $_POST['domine'] : 'N/A';

  	global $wpdb, $user_id ;
	$user_id = get_current_user_id();
  	$table_prefix = $wpdb->prefix . "companydetails";
   
  	$data = array(        
	   'company_name'     => $name,
	    'company_type'    => $etablissement,
	    'siret' => $siret,
	    'contact_name'     => $name_prefix.' '.$first_name.' '.$last_name,
	    'contact_function'    => $fonction,
	    'contact_email' => $contact_email,
	    'contact_phone'     => $phone,
	    'contact_address'    => $street_address.'<br>'.$address_line,
	    'contact_postal_code' => $zip_address,
	    'contact_city'     => $address_city,
	    'contact_country'    => $address_country,
	    'contact_activity' => $activity,
	    'company_url'     => $site_url,
	    'company_expertise'    => $domine,
	    'myteklist' => 1,
	    'created_by' => $user_id,
	    'created_on' => date('Y-j-n H:m:s')
	);
	
	$insert = $wpdb->update($table_prefix,$data, array('company_id' =>  $company_id));

  	$company_nationality = isset( $_POST['company_nationality'] ) ? $_POST['company_nationality'] : 'N/A';

  	$company_parent = isset( $_POST['company_parent'] ) ? $_POST['company_parent'] : 'N/A';
  	$company_created_year = isset( $_POST['company_created_year'] ) ? $_POST['company_created_year'] : 'N/A';
  	$company_contact_option = isset( $_POST['company_contact_option'] ) ? implode(", ",$_POST['company_contact_option']) : 'N/A';
  	$company_client_profile = isset( $_POST['company_client_profile'] ) ? $_POST['company_client_profile'] : 'N/A';
  	$company_legal_form = isset( $_POST['company_legal_form'] ) ? implode(", ",$_POST['company_legal_form']) : 'N/A';
  	$contact_activity_sector = isset( $_POST['contact_activity_sector'] ) ? $_POST['contact_activity_sector'] : 'N/A';
  	$company_rcs = isset( $_POST['company_rcs'] ) ? $_POST['company_rcs'] : 'N/A';

  	$company_share_capital = isset( $_POST['company_share_capital'] ) ? $_POST['company_share_capital'] : 'N/A';
  	$company_global_workforce = isset( $_POST['company_global_workforce'] ) ? $_POST['company_global_workforce'] : 'N/A';
  	$company_france_workforce = isset( $_POST['company_france_workforce'] ) ? $_POST['company_france_workforce'] : 'N/A';
  	$company_rcs = isset( $_POST['company_rcs'] ) ? $_POST['company_rcs'] : 'N/A';
  	$company_sales_figure1 = isset( $_POST['company_sales_figure1'] ) ? $_POST['company_sales_figure1'] : 'N/A';
  	$company_sales_figure_year1 = isset( $_POST['company_sales_figure_year1'] ) ? $_POST['company_sales_figure_year1'] : 'N/A';
  	$comapny_sales_figure_option1 = isset( $_POST['comapny_sales_figure_option1'] ) ? $_POST['comapny_sales_figure_option1'] : 'N/A';
  	$company_sales_figure2 = isset( $_POST['company_sales_figure2'] ) ? $_POST['company_sales_figure2'] : 'N/A';
  	$company_sales_figure_year2 = isset( $_POST['company_sales_figure_year2'] ) ? $_POST['company_sales_figure_year2'] : 'N/A';
  	$comapny_sales_figure_option2 = isset( $_POST['comapny_sales_figure_option2'] ) ? $_POST['comapny_sales_figure_option2'] : 'N/A';
  	$company_sales_figure3 = isset( $_POST['company_sales_figure3'] ) ? $_POST['company_sales_figure3'] : 'N/A';
  	$company_sales_figure_year3 = isset( $_POST['company_sales_figure_year3'] ) ? $_POST['company_sales_figure_year3'] : 'N/A';
  	$comapny_sales_figure_option3 = isset( $_POST['comapny_sales_figure_option3'] ) ? $_POST['comapny_sales_figure_option3'] : 'N/A';
  	$company_sales_figure4 = isset( $_POST['company_sales_figure4'] ) ? $_POST['company_sales_figure4'] : 'N/A';
  	$company_sales_figure_year4 = isset( $_POST['company_sales_figure_year4'] ) ? $_POST['company_sales_figure_year4'] : 'N/A';
  	$comapny_sales_figure_option4 = isset( $_POST['comapny_sales_figure_option4'] ) ? $_POST['comapny_sales_figure_option4'] : 'N/A';
  	$company_network_linkedin = isset( $_POST['company_network_linkedin'] ) ? $_POST['company_network_linkedin'] : 'N/A';

  	$company_network_twitter = isset( $_POST['company_network_twitter'] ) ? $_POST['company_network_twitter'] : 'N/A';
  	$company_network_youtube = isset( $_POST['company_network_youtube'] ) ? $_POST['company_network_youtube'] : 'N/A';
  	$company_network_other = isset( $_POST['company_network_other'] ) ? $_POST['company_network_other'] : 'N/A';
  	$company_desc_short = isset( $_POST['company_desc_short'] ) ? $_POST['company_desc_short'] : 'N/A';
  	$company_desc_long = isset( $_POST['company_desc_long'] ) ? $_POST['company_desc_long'] : 'N/A';
  	$company_profile_doc_name = isset( $_POST['company_profile_doc_name'] ) ? $_POST['company_profile_doc_name'] : 'N/A';
  	$company_profile_doc2 = isset( $_POST['company_profile_doc2'] ) ? $_POST['company_profile_doc2'] : 'N/A';
  	$company_profile_links = isset( $_POST['company_profile_links'] ) ? $_POST['company_profile_links'] : 'N/A';
  	
  	$company_logo = '';
    if(!empty($_FILES['comapny_logo']['tmp_name']) && file_exists($_FILES['comapny_logo']['tmp_name'])){
        $comapny_logo = base64_encode(file_get_contents($_FILES['comapny_logo']['tmp_name']));
        $comapny_logo = mb_convert_encoding($comapny_logo, 'UTF-8', 'UTF-8');
        
    }

  	$company_profile_document = '';
    if(!empty($_FILES['company_profile_document']['tmp_name']) && file_exists($_FILES['company_profile_document']['tmp_name'])){
        $company_profile_document = base64_encode(file_get_contents($_FILES['company_profile_document']['tmp_name']));
        $company_profile_document = mb_convert_encoding($company_profile_document, 'UTF-8', 'UTF-8');
        
    }


   	global $wpdb, $user_id ;
	$user_id = get_current_user_id();
  	$table = $wpdb->prefix . "companyregitrationdetails";
  	
	$data = array( 
		'company_id' =>  $company_id,   
		'created_by' => $user_id,
    	'created_on' => date('Y-j-n H:m:s'),
		'company_logo' =>  $company_logo,
	    'company_profile_document'     => $company_profile_document,
	    'company_nationality'    => $company_nationality,
	    'company_parent' => $company_parent,
	    'company_created_year'     => $company_created_year,
	    'company_contact_option'    => $company_contact_option,
	    'company_client_profile'    => $company_client_profile,
	    'company_legal_form' =>  $company_legal_form,
	    'contact_activity_sector'     => $contact_activity_sector,
	    'company_rcs'    => $company_rcs,
	    'company_share_capital' => $company_share_capital,
	    'company_global_workforce'     => $company_global_workforce,
	    'company_france_workforce'    => $company_france_workforce,
	    'company_sales_figure1'    => $company_sales_figure1,
	    'company_sales_figure_year1'     => $company_sales_figure_year1,
	    'company_sales_figure_option1'    => $comapny_sales_figure_option1,
	    'company_sales_figure2'    => $company_sales_figure2,
	    'company_sales_figure_year2'     => $company_sales_figure_year2,
	    'company_sales_figure_option2'    => $comapny_sales_figure_option2,
	    'company_sales_figure3'    => $company_sales_figure3,
	    'company_sales_figure_year3'     => $company_sales_figure_year3,
	    'company_sales_figure_option3'    => $comapny_sales_figure_option3,
	    'company_sales_figure4'    => $company_sales_figure4,
	    'company_sales_figure_year4'     => $company_sales_figure_year4,
	    'company_sales_figure_option4'    => $comapny_sales_figure_option4,
	    'company_network_linkedin'    => $company_network_linkedin,
	    'company_network_twitter' =>  $company_network_twitter,
	    'company_network_youtube'     => $company_network_youtube,
	    'company_network_other'    => $company_network_other,
	    'company_desc_short' => $company_desc_short,
	    'company_desc_long'     => $company_desc_long,
	    'company_profile_doc_name'    => $company_profile_doc_name,
	    'company_profile_doc2'    => $company_profile_doc2,
	    'company_profile_links'    => $company_profile_links,
	);
	
		$insert = $wpdb->insert($table, $data);
	

	if ($wpdb->last_error) {
	  die('error=' . var_dump($wpdb->last_query) . ',' . var_dump($wpdb->error));
	}
		
  	
	$redirect = add_query_arg( 'my-form', 'success', 'https://aeon2.blvckpixel.com/simple-long-form/' );
	wp_redirect( $redirect );
	die();
}




