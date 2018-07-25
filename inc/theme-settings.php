<?php
/*********************************************************/
add_theme_support( 'post-thumbnails' );
/*********************************************************/
add_filter('widget_text','do_shortcode');
/*********************************************************/
function new_excerpt_length($length) {
	return 30;
}
add_filter('excerpt_length', 'new_excerpt_length');
/*********************************************************/
add_filter('excerpt_more', function($more) {
	return '...';
});
/*********************************************************/
add_filter('get_the_archive_title', function( $title ){
	return preg_replace('~^[^:]+: ~', '', $title );
});
/*********************************************************/
if ( !current_user_can( 'manage_options' ) ) {
    show_admin_bar(false);
}
/*********************************************************/
add_theme_support( 'custom-logo' );
/*********************************************************/
define('DEFAULT_AVATAR',get_template_directory_uri().'/img/def_avatar.png');