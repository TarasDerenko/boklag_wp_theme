<?php
/***********************************************************/
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_template_directory_uri(); ?>/img/Mediweblogo.jpg);
            background-size: contain;
            width: 100%;
            margin: 0;
            height: 300px;
        }
        body.login {
            background-color: #fff;
        }
        body.login form {
            box-shadow: none;
        }
    </style>
<?php }

add_action( 'login_enqueue_scripts', 'my_login_logo' );
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
}
   show_admin_bar(false);
/*********************************************************/
add_theme_support( 'custom-logo' );
/*********************************************************/
