<?php
add_action( 'admin_enqueue_scripts', function(){
    wp_enqueue_script('admin-boklag', get_template_directory_uri().'/inc/admin/js/scripts.js' , array('jquery'),'1.0.0',true);
    wp_localize_script( 'admin-boklag', 'wp_adm',
        array(
            'url' => admin_url('admin-ajax.php')
        )
    );
}, 99 );