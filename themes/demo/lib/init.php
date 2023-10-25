<?php

// Support full-width layout for Gutenberg blocks
add_theme_support( 'align-wide' );

function site_scripts()
{
	wp_enqueue_style('main_css', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.1', false);
	wp_enqueue_script('bundle_js', get_template_directory_uri() . '/assets/js/bundle.js', null, '1.1', true);
	wp_localize_script(
		'bundle_js',
		'bundlejs',
		array(
			'ajaxUrl' => admin_url('admin-ajax.php'),
		)
	);
}
add_action('wp_enqueue_scripts', 'site_scripts');

// Allow SVG in the Media in WordPress
function cc_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// Allow WP SEO
add_filter('wpseo_metabox_prio', function () {
	return 'low';
});

// Body Class
add_filter('body_class', 'custom_body_class');
function custom_body_class(array $classes)
{
	$new_class = is_page() ? get_post_meta(get_the_ID(), 'body-class', true) : null;

	if ($new_class) {
		$classes[] = $new_class;
	}

	return $classes;
}

add_filter('wp_mail_content_type', function ($content_type) {
	return 'text/html';
});

add_theme_support('post-thumbnails');

// ACF Google Map API
function my_acf_google_map_api( $api ){
    $key = get_field('google_map_api_key','options');
    if(!empty($key)) {
        $api['key'] = $key;
    }
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

// Add <pre> </pre> to print_r display, used for debugging
function pre_print_r($obj) {
  echo '<pre>';
  print_r($obj);
  echo '</pre>';
}


function get_post_primary_category($post_id, $term='category', $return_all_categories=false){
    $return = array();

    if (class_exists('WPSEO_Primary_Term')){
        // Show Primary category by Yoast if it is enabled & set
        $wpseo_primary_term = new WPSEO_Primary_Term( $term, $post_id );
        $primary_term = get_term($wpseo_primary_term->get_primary_term());

        if (!is_wp_error($primary_term)){
            $return['primary_category'] = $primary_term;
        }
    }

    if (empty($return['primary_category']) || $return_all_categories){
        $categories_list = get_the_terms($post_id, $term);

        if (empty($return['primary_category']) && !empty($categories_list)){
            $return['primary_category'] = $categories_list[0];  //get the first category
        }
        if ($return_all_categories){
            $return['all_categories'] = array();

            if (!empty($categories_list)){
                foreach($categories_list as &$category){
                    $return['all_categories'][] = $category->term_id;
                }
            }
        }
    }

    return $return;
}

// Add <sup></sup> tags to any special registered trademark text
function format_superscript_text($txt) {
  if( !is_string($txt)) {
    exit();
  } else {
    $formatted_txt = $txt;
    if( !str_contains( $txt, '<sup>') ) {
      $symbols = array('®', '&reg;', '©', '&copy;');
      foreach($symbols as $symbol) {
        $formatted_txt = str_replace($symbol,"<sup>".$symbol."</sup>",$formatted_txt);
      }
    }

    return $formatted_txt;
  }

}

// Adding <sup> buttons to Tiny MCE options
function my_mce_buttons_2( $buttons ) {
  /**
   * Add in a core button that's disabled by default
   */
  $buttons[] = 'superscript';
  $buttons[] = 'subscript';

  return $buttons;
}
add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );

// Admin Menu Styling
function my_admin_scripts() {
 wp_enqueue_style( 'admin-css', get_stylesheet_directory_uri() . '/assets/css/admin-styles.css' );
}
add_action( 'admin_enqueue_scripts', 'my_admin_scripts' );


// Get Permalink by Slug
function get_permalink_by_slug( $slug, $post_type = '' ) {
 $permalink = null;
 $args = array(
     'name'          => $slug,
     'max_num_posts' => 1
 );
 if( '' != $post_type ) {
  $args = array_merge( $args, array( 'post_type' => $post_type ) );
 }
 $query = new WP_Query( $args );
 if( $query->have_posts() ) {
  $query->the_post();
  $permalink = get_permalink( get_the_ID() );
  wp_reset_postdata();
 }
 return $permalink;
}
// Deregister jQuery Library
// is not needed by site and was causing conflict with the RCM Marketplace product page
// only do this function for the RMC Marketplace page
function wpb_modify_jquery()
{
 $post_ID = null;
 $url = $_SERVER["REQUEST_URI"];
 $url_array = explode('/',$url);
 if(is_array($url_array) && count($url_array) >=1 ) {
  array_pop($url_array); // remove last item in array
  $slug = '/' . end($url_array). '/';
  $page = get_page_by_path($slug, OBJECT, 'product');
  if(isset($page->ID) && is_numeric($page->ID)) {
   $post_ID = $page->ID;
  }
 }

 //check if front-end is being viewed
 if (!is_admin() && $post_ID == 4636) {
  // Remove default WordPress jQuery
  wp_deregister_script('jquery');
 }
}

// Execute the action when WordPress is initialized
add_action('init', 'wpb_modify_jquery');