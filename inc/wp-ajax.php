<?php
add_action('wp_ajax_show_news_more', 'show_news_more');
add_action('wp_ajax_nopriv_show_news_more', 'show_news_more');

add_action('wp_ajax_google_login', 'sign_on_from_google');
add_action('wp_ajax_nopriv_google_login', 'sign_on_from_google');

add_action('wp_ajax_set_order_reminder', 'set_bl_order_reminder');
add_action('wp_ajax_nopriv_set_order_reminder', 'set_bl_order_reminder');

add_action('wp_ajax_update_notification', 'bl_update_notification');
add_action('wp_ajax_nopriv_update_notification', 'bl_update_notification');

add_action('wp_ajax_service_autocomplete', 'bl_service_autocomplete');
add_action('wp_ajax_nopriv_service_autocomplete', 'bl_service_autocomplete');

function show_news_more(){
  $result = array();
  $news = get_posts(array(
      'post_type' => 'post',
      'posts_per_page' => 3,
      'offset' => isset($_POST['offset']) ? $_POST['offset'] : 0
  ));
  foreach ($news as $new) {
    $content = get_extended($new->post_content);
    $result[] = array(
        'ID' => $new->ID,
        'title' => $new->post_title,
        'before_more' => apply_filters('the_content',$content['main']),
        'after_more' => apply_filters('the_content',$content['extended']),
        'date' => get_the_date('',$new), 
        'img' => get_the_post_thumbnail_url($new)
    );
  }
  echo json_encode($result);
  die;
}

function sign_on_from_google(){
  if(is_user_logged_in())
    die;
  $user = get_user_by('login',$_POST['email']);
  if($user){   
    wp_clear_auth_cookie();
    wp_set_current_user ( $user->ID );
    wp_set_auth_cookie($user->ID); 
    die;
  }
  $user_id = wp_insert_user(array(
            'user_login' => $_POST['email'],
            'user_pass' => $_POST['token'],
            'first_name' =>$_POST['name'],
            'display_name' => $_POST['name'],
            'user_email' => $_POST['email']
        ));   
  wp_clear_auth_cookie();
  wp_set_current_user ( $user_id );
  wp_set_auth_cookie($user_id);    
  if(!empty($_POST['image'])){
      require_once ABSPATH . 'wp-admin/includes/media.php';
      require_once ABSPATH . 'wp-admin/includes/file.php';
      require_once ABSPATH . 'wp-admin/includes/image.php';
      $image_id = media_sideload_image( $_POST['image'], 0, null, 'id' );
      if(!is_wp_error($img_tag)){
        update_user_meta($user_id,'user_avatar',$image_id);
      }
  }
  die;
}


function set_bl_order_reminder(){
    if(isset($_POST['user_id'])){
        $date = date('Y-m-d H:i:s',strtotime(str_replace('/','-',$_POST['date']).' '.$_POST['hour'].':'.$_POST['min']));
        echo BLReminder::setReminder($_POST['id'],$date);
    }
    die;
}


function bl_update_notification(){
    if(!isset($_POST['type'],$_POST['id']))
        die;

    if($_POST['type'] == 'reminder'){
        BLReminder::updateReminderView($_POST['id']);
        $res['count'] = bl_user_notification($_POST['user_id']);
        $res['nots'] = bl_get_template_notification();
        echo json_encode($res);
        die;
    }
}

function bl_service_autocomplete(){
    if(isset($_POST['s'])){
        $services = BLService::searchServices($_POST['s']);
        echo json_encode($services);
    }
    die;
}