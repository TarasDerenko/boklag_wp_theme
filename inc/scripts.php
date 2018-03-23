<?php
add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );
function theme_name_scripts() {
	// style
	wp_enqueue_style( 'boklag-css-ui',  "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" );
	wp_enqueue_style( 'boklag-css-style',  get_template_directory_uri().'/css/style.css' );
	wp_enqueue_style( 'boklag-style',  get_stylesheet_uri() );

	// javascript
	wp_deregister_script('jquery');
	wp_register_script('jquery', get_template_directory_uri().'/js/jquery-3.2.1.min.js');
	wp_enqueue_script('jquery', false , array(),'1.0.0',true);
	wp_enqueue_script('boklag-jquery-migrate', get_template_directory_uri().'/js/jquery-migrate-1.4.1.min.js',array(),'1.0.0',true);
	wp_enqueue_script('boklag-jquery-ui', get_template_directory_uri().'/js/jquery-ui.min.js',array(),'1.0.0',true);
	wp_enqueue_script('boklag-jquery-migrate-popup', get_template_directory_uri().'/js/jquery.magnific-popup.min.js',array(),'1.0.0',true);
	wp_enqueue_script('boklag-main', get_template_directory_uri().'/js/main.js', array(),'1.0.0',true);
	if(isset($_GET['orders_page']) && $_GET['orders_page'] == 'new' || is_page('orders')){
      wp_enqueue_script('boklag-google', "https://maps.googleapis.com/maps/api/js?key=AIzaSyCMz6ybbsM30th_jIWkEQMXNYMDCtU_j-k&libraries=places", array(),'1.0.0',true);
      wp_enqueue_script('boklag-map', get_template_directory_uri().'/js/map.js', array(),'1.0.0',true);
      wp_localize_script( 'boklag-map', 'wp_map',
          array(
              'url' => admin_url('admin-ajax.php'),
              'marker' => get_template_directory_uri().'/img/map-marker.png',
          )
      );
  }
  if(isset($_GET['orders_page']) && $_GET['orders_page'] == 'reminder'){
      wp_enqueue_script('boklag-mask', get_template_directory_uri().'/js/jquery.mask.js', array(),'1.0.0',true);
  }
	wp_enqueue_script('boklag-script', get_template_directory_uri().'/js/script.js', array(),'1.0.0',true);
	wp_enqueue_script('boklag-ajax', get_template_directory_uri().'/inc/js/wp-ajax.js', array(),'1.0.0',true);
	wp_enqueue_script('boklag-recapcha','https://www.google.com/recaptcha/api.js');

	wp_localize_script( 'boklag-ajax', 'wp_ajax', 
		array(
			'url' => admin_url('admin-ajax.php'),
      'user_id' => get_current_user_id()
		)
	); 
}