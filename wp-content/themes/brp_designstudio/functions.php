<?php
// Theme Functions

/* Remove Admin Bar from Frontend */
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar(){
  show_admin_bar(false);
}

if (function_exists('add_theme_support')){
  // Add Menu Support
  add_theme_support('menus');

  // Add Thumbnail Theme Support
  add_theme_support('post-thumbnails');
  add_image_size('large', 700, '', true);  		// Large Thumbnail
  add_image_size('medium', 250, '', true); 		// Medium Thumbnail
  add_image_size('small', 125, '', true);  		// Small Thumbnail
  add_image_size('custom-size', 700, 200, true);  // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

  // Enables post and comment RSS feed links to head
  add_theme_support('automatic-feed-links');
}

add_action('after_setup_theme', 'wpt_setup');
if(!function_exists('wpt_setup')):
  function wpt_setup() {
    register_nav_menu('primary', __('Primary Navigation', 'wptmenu'));
  }
endif;

function wpt_register_js(){
  if( !is_admin()){
    wp_deregister_script('jquery');
  }

    wp_register_script('jquery', '//code.jquery.com/jquery-3.3.1.slim.min.js', 'jquery', '', true);
    wp_register_script('jquery.popper.min', '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js', 'jquery', '', true);
	  wp_register_script('jquery.bootstrap.min', '//stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js', 'jquery', '', true);
	  wp_register_script('jquery.extras.min', get_template_directory_uri() . '/assets/js/main.min.js', 'jquery', '', true);

	if(!is_admin()){
	  wp_enqueue_script('jquery');
    wp_enqueue_script('jquery.popper.min');
    wp_enqueue_script('jquery.bootstrap.min');
    wp_enqueue_script('jquery.extras.min');
  }
}

function wpt_register_css(){
  wp_register_style('bootstrap.min', '//stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css');
  wp_register_style('fontawesome.min', '//use.fontawesome.com/releases/v5.6.3/css/all.css');
  wp_register_style('main.min', get_template_directory_uri() . '/assets/css/main.min.css');
  wp_enqueue_style('bootstrap.min');
  wp_enqueue_style('fontawesome.min');
  wp_enqueue_style('main.min');
}
add_action('init','wpt_register_js');
add_action('wp_enqueue_scripts', 'wpt_register_css');

// Add Class to Images posted on pages
function add_responsive_class($content){
  $content = mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8');
  $document = new DOMDocument();
  libxml_use_internal_errors(true);
  $document->loadHTML(utf8_decode($content));

  $imgs = $document->getElementsByTagName('img');
  foreach($imgs as $img){
    $existing_class = $img->getAttribute('class');
    $img->setAttribute('class', 'img-responsive ' . $existing_class);
  }
  $html = $document->saveHTML();
	      return $html;
}
add_filter('the_content', 'add_responsive_class');

// Create Communities
// add_action('init','create_communities');
// function create_communities(){
//   register_post_type('communities', array(
//     'label'   =>  __('Communities'),
//     'singular_label'  =>  __('Community'),
//     'public'          =>  true,
//     'show_ui'         =>  true,
//     'capability_type' =>  'post',
//     'hierarchical'    =>  true,
//     'rewrite'         =>  array('slug'=>'community'),
//     'supports'        =>  array('title','thumbnail','order','page-attributes'),
//     'menu_position'   =>  20,
//     'menu_icon'       =>  'dashicons-admin-home',
//     'has_archive'     =>  false
//   ));
// }

// Create Portfolios
add_action('init','create_portfolios');
function create_portfolios(){
  register_post_type('portfolios', array(
    'label'           =>  __('Portfolios'),
    'singular_label'  =>  __('Portfolio'),
    'public'          =>  true,
    'show_ui'         =>  true,
    'capability_type' =>  'post',
    'hierarchical'    =>  true,
    'rewrite'         =>  array('slug'=>'portfolio'),
    'supports'        =>  array('title','thumbnail','order','page-attributes'),
    'menu_position'   =>  21,
    'menu_icon'       =>  'dashicons-admin-home',
    'has_archive'     =>  false
  ));
}

// Create Portfolio Taxonomy
add_action('init','portfolio_taxonomies',0);
function portfolio_taxonomies(){
  $_labels = array(
    'name'              =>	_x('Communities','taxonomy general name'),
		'singular_name'     =>	_x('Community', 'taxonomy singular name'),
		'search_items'		  =>	__('Search Communities'),
		'all_items'         =>	__('All Communities'),
		'parent_item'       =>	__('Parent Community'),
		'parent_item_colon'	=>	__('Parent Community:'),
		'edit_item'         =>	__('Edit Community'),
		'update_item'       =>	__('Update Community'),
		'add_new_item'      =>	__('Add New Community'),
		'new_item_name'     =>	__('New Community Name'),
		'menu_name'         =>	__('Communities'),
  );
  $_args = array(
    'hierarchical'      =>	true,
		'labels'            =>	$_labels,
		'show_ui'           =>	true,
		'show_admin_column'	=>	true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'         =>	true,
		'rewrite'           =>	array('slug' => 'community'),
  );
  register_taxonomy('community','portfolios',$_args);
}



// Footer Widgets
function footer_copyright(){
  register_sidebar(array(
    'name'          =>  'Footer Copyright',
    'id'            =>  'footer-copyright',
    'before_widget' =>  '<div class="footer-copyright">',
    'after_widget'  =>  '</div>',
    'before_title'  =>  '',
    'after_title'   =>  '',
  ));
}










?>
