<?php
/*
 *
 * @change post labels
 *
 */
function revcon_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Новости';
    $submenu['edit.php'][5][0] = 'Новости';
    $submenu['edit.php'][10][0] = 'Добавить Новости';
    $submenu['edit.php'][16][0] = 'Теги Новости';
}
function revcon_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Новости';
    $labels->singular_name = 'Новость';
    $labels->add_new = 'Добавить Новость';
    $labels->add_new_item = 'Добавить Новость';
    $labels->edit_item = 'Редактировать Новость';
    $labels->new_item = 'Новость';
    $labels->view_item = 'Просмотреть Новость';
    $labels->search_items = 'Искать Новости';
    $labels->not_found = 'Новости не найдено';
    $labels->not_found_in_trash = 'Новости не найдено в корзине';
    $labels->all_items = 'Все Новости';
    $labels->menu_name = 'Новости';
    $labels->name_admin_bar = 'Новости';
}
 
add_action( 'admin_menu', 'revcon_change_post_label' );
add_action( 'init', 'revcon_change_post_object' );
/*
 *
 *
 *@if login failed redirect another page
 *
 */

//add_action( 'wp_login_failed', 'my_front_end_login_fail' );  // hook failed login

function my_front_end_login_fail( $username ) {
   $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
   // if there's a valid referrer, and it's not the default log-in screen
   if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
      wp_redirect( $referrer . '?login=failed' );  // let's append some information (login=failed) to the URL for the theme to use
       exit;
   }
}


/*
 *
 *
 *@action loop news in about company page
 *
 *
 */
function loop_news(){
    global $more;
    $loop = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => 3 
    ));
    $total = wp_count_posts('post');
?>
 <h2 class="section-title">Новости</h2>
<div class="about-news-list" data-total="<?php echo $total->publish ?>">
<?php    
if($loop->have_posts()): 
    while($loop->have_posts()): $loop->the_post(); ?>
         <div class="about-news-item">
            <div class="about-news-image">
                <img src="<?php echo get_the_post_thumbnail_url();?>" alt="">
                <div class="about-news-date"><span><?= get_the_date(); ?></span></div>
            </div>
            <div class="about-news-info">
                <h3 class="about-news-title"><?php the_title() ?></h3>
                <div class="about-news-text">
                   <?php the_content('') ?>
                </div>
                <div class="about-news-more">
                    <?php $more = 1; the_content('',true) ?>
                </div>
                <a href="#" class="about-news-extend">подробнее</a>
            </div>
        </div>      
<?php
   endwhile; 
endif;
wp_reset_query(); ?>
</div>
<?php if($total->publish > 3):?>
<div class="about-news-add">
    <a href="#">Показать еще 3</a>
</div>
<?php endif;
}
add_action('show_loop_news','loop_news');
/*
 *
 *
 *@custom registration form
 *
 *
 *
 */
function boklag_registration(){
    if(is_user_logged_in())
        return;
    global $error_message,$register_info;
    $error_message = array();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registration'],$_POST['user_login'],$_POST['pwd'],$_POST['approved'])){
        if(!filter_var($_POST['user_login'], FILTER_VALIDATE_EMAIL))
            $error_message['email'] = "Не корректный Email!";
        if(strlen($_POST['pwd']) < 6)
            $error_message['pwd'] = "Слишком короткий пароль";
        if(empty($_POST['g-recaptcha-response']))
            $error_message['email'] = "Вы не прошли проверку!";

        if(sizeof($error_message)){
            add_action('wp_footer','show_popup_register',21);
            return;
        }
        $user = wp_insert_user(array(
            'user_login' => $_POST['user_login'],
            'user_pass' => $_POST['pwd'],
            'first_name' => isset($_POST['user_name']) ? $_POST['user_name'] : '',
            'display_name' => isset($_POST['user_name']) ? $_POST['user_name'] : '',
            'user_email' => $_POST['user_login']
        ));
        if(is_int($user)){
            $user_login = wp_signon(array(
                'user_login'    => $_POST['user_login'],
                'user_password' => $_POST['pwd'],
            ));
            if( !is_wp_error($user_login) ){
                wp_redirect(home_url('/kabinet'));
                die;
            }else{
                $error_message['login'] = $user_login->get_error_message();
                add_action('wp_footer','show_popup_register',21);
            }
        }else{
            $error_message['email'] = 'Извините, этот Email уже существует!';
            add_action('wp_footer','show_popup_register',21);
        }        
    }
    if(isset($_GET['reg']) && $_GET['reg'] == 'false' && $_SERVER['REQUEST_METHOD'] == 'GET'){
        $register_info[] = "Сначала зарегистрируйтесь!";
        add_action('wp_footer','show_popup_register',21);
    }
}
add_action('init','boklag_registration');
/*
 *
 *
 *@custom login form
 *
 *
 *
 */
function boklag_login(){
    if(is_user_logged_in())
        return;
    global $error_login;
    $error_login = array();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){

        if(!filter_var($_POST['log'], FILTER_VALIDATE_EMAIL)){
            $error_login['email'] = "Не корректный Email!";
            add_action('wp_footer','show_popup_login',22);
            return;
        }

        if(empty($_POST['g-recaptcha-response'])){
            $error_login['email'] = "Вы не прошли проверку!";
            add_action('wp_footer','show_popup_login',22);
            return;
        }
        if(username_exists( $_POST['log'] )){
            $user_log = $_POST['log'];
        }else{
            $user = get_user_by('email', $_POST['log']);
            $user_log = (isset($user->ID)) ? $user->data->user_login : $_POST['log'];
        }

        $user_login = wp_signon(array(
            'user_login'    => $user_log,
            'user_password' => $_POST['pwd'],
            'remember' => !empty($_POST['rememberme']) ? true : false,
        ));

        if( !is_wp_error($user_login) ){
            wp_redirect(home_url('/kabinet'));
            die;
        }else{
            $error_login['login'] = 'Неправельный логин или пароль!';
            add_action('wp_footer','show_popup_login',22);
            return;
        }
    }

}
add_action('init','boklag_login');
/*
 *
 *
 *
 *@logout user
 *
 *
 */
function boklag_logout(){
    if(!isset($_GET['logout']))
        return;
    wp_logout();
    wp_redirect(home_url());
    die();
}
add_action('init','boklag_logout');

/*
 *
 *
 *
 *@if user can't register, popup form show again
 *
 *
 * */
function show_popup_register(){
    ?>
    <script>    
            $(window).load(function () {
                $.magnificPopup.open({
                    items: {
                        src: '#registration'
                    },
                    type: 'inline'                
                }, 0);
            });
    </script>
    <?php
}
/*
 *
 *
 *
 *@if user can't login, popup form show again
 *
 *
 * */
function show_popup_login(){  ?>
    <script>
        $(window).load(function () {
            $.magnificPopup.open({
                items: {
                    src: '#login'
                },
                type: 'inline'
            }, 0);
        });
    </script>
        <?php
}
/*
 *
 *
 * @checked if user login
 *
 *
 * */
function checked_user_login(){
    global $boklag_user,$boklag_user_meta,$boklag_user_avatar;
    if(!is_user_logged_in() && !wp_get_current_user()->exists()){
        wp_redirect(site_url('?login=failed'));
        die;
    }
    $boklag_user = wp_get_current_user();
    $boklag_user_meta = get_user_meta($boklag_user->ID);
    $img = wp_get_attachment_image_url(get_bl_user_data($boklag_user_meta,'user_avatar'),'full');
    $boklag_user_avatar = (!empty($img)) ? $img : DEFAULT_AVATAR;
}
add_action('is_boklag_user_login','checked_user_login');

/*
 *
 *
 * @script google login initialize , if user logout
 *
 *
 * */
function add_google_sign_in_script(){
    if(is_user_logged_in())
        return;
    ?>
    <script src="https://apis.google.com/js/platform.js?onload=gInit" async defer></script>
    <meta name="google-signin-client_id" content="784347025730-uct0opjdbesr2rb1pcgdc12c4i7a9uit.apps.googleusercontent.com">
    <script type="text/javascript">
        window.onbeforeunload = function(e){
                gapi.auth2.getAuthInstance().signOut();
            };
        window.onload = function(){
            gInit();
        };
    </script>
    <?php
}
add_action('wp_head','add_google_sign_in_script');

/*
 *
 *
 *
 *
 * @edit user profile
 *
 *
 * */
function edit_boklag_profile(){
    global $boklag_user,$error_message,$boklag_user_meta;
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change-pass'])){
        if(!empty(trim($_POST['user_new_pass'])) && !empty(trim($_POST['user_new_cop_pass']))){
            if(strlen($_POST['user_new_pass']) > 5 && $_POST['user_new_pass'] == $_POST['user_new_cop_pass']){
                if(isset($boklag_user_meta['google_account'])){
                    wp_set_password($_POST['user_new_pass'],$boklag_user->ID);
                    delete_user_meta($boklag_user->ID,'google_account');
                    wp_redirect(site_url('/kabinet/?edit=true'));
                    die;
                }else if(!empty(trim($_POST['user_pass'])) && wp_check_password($_POST['user_pass'] , $boklag_user->user_pass )){
                    wp_set_password($_POST['user_new_pass'],$boklag_user->ID);
                    wp_redirect(site_url('/kabinet/?edit=true'));
                    die;
                }
            }
            $error_message['pass'] = 'Не удалось изминить пароль';
        }
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save-avatar'])){
        if(isset($_FILES['user_image']['type']) && strpos($_FILES['user_image']['type'],'image') !== false){
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/media.php');
            $image_id = media_handle_upload( 'user_image', 0);
            if(is_object($image_id)){
                $error_message['load_image'] = $image_id->get_error_message();
            }
            $_POST['user_avatar'] = $image_id;
        }
        if(!empty($_POST['delete-avatar'])){
            wp_delete_attachment( $_POST['delete-avatar'], true );
            $_POST['user_avatar'] = '';
        }
        $old_image = get_bl_user_data($boklag_user_meta,'user_avatar');
        if(!empty($old_image))
            wp_delete_attachment( $old_image, true );
        $save = update_boklag_user_data($boklag_user->ID,$_POST);
        if($save){
            wp_redirect(site_url('/kabinet/?edit=true'));
            die;
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit-profile'])){
        if(isset( $_POST['user_email']) && !filter_var( $_POST['user_email'],FILTER_VALIDATE_EMAIL)){
            $error_message['email'] = 'Не валидный Email!';
            return false;
        }
        if(!empty($_POST['delete-avatar'])){
            wp_delete_attachment( $_POST['delete-avatar'], true );
            $_POST['user_avatar'] = '';
        }
        if(isset($_FILES['user_image']['type']) && strpos($_FILES['user_image']['type'],'image') !== false){
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/media.php');
            $image_id = media_handle_upload( 'user_image', 0);
            if(is_object($image_id)){
                $error_message['load_image'] = $image_id->get_error_message();
            }
            $_POST['user_avatar'] = $image_id;
        }
        unset($_POST['user_pass']);

        $user_id = wp_update_user(array(
            'ID' => $boklag_user->ID,
            'user_email' =>  $_POST['user_email'],
            'display_name' =>  $_POST['display_name'],
        ));
        $save = update_boklag_user_data($user_id,$_POST);
        if($save){
            wp_redirect(site_url('/kabinet/?edit=true'));
            die;
        }

    }
}
add_action('is_boklag_user_login','edit_boklag_profile');


/*
 *
 *
 *
 *
 * @add credit cart to user story
 *
 *
 * */
function add_cart_to_user(){
     global $boklag_user,$boklag_user_meta,$profule_edit_errors;

     if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add-cart'])){
        //debug($boklag_user);
     }
}
add_action('is_boklag_user_login','add_cart_to_user');

/*
 *
 *
 * @set cookie user place
 *
 *
 * */
function boklag_set_cookie(){
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['current-place'])){
        global $wpdb;
        $place = '';
        if(isset($_POST['city-current'],$_POST['location-current']) && $_POST['location-current'] == 1)
            $place = $_POST['city-current'];
        elseif(isset($_POST['my-city']))
            $place =$_POST['my-city'];
        if(!empty($place)){
            setcookie('current-place',$place,(time()+3600*24*30));
            $wpdb->insert(
                    'wp_region_statistics',
                    array(
                         'region' => $place,
                         'ip_user' => $_SERVER['REMOTE_ADDR'],
                         'http_user_agent' => $_SERVER['HTTP_USER_AGENT'],
                    ),
                    array(
                         '%s',
                         '%s',
                         '%s'
                    )
            );
        }

        wp_redirect($_SERVER['REQUEST_URI']);
        die;
    }
}
add_action('init','boklag_set_cookie');

/*
 *
 *
 * @add contact form 7 to databases
 *
 * */
function action_wpcf7_before_send_mail( $contact_form ) {
    if($contact_form->id() != '123')
        return;
    global $wpdb;
    $submission = WPCF7_Submission::get_instance();
    if(method_exists($submission,'get_posted_data')){
        $fields = $submission->get_posted_data();
        $name = isset($fields['your-name']) ? $fields['your-name'] : '';
        $email = isset($fields['your-email']) ? $fields['your-email'] : '';
        $serice = isset($fields['view-service']) ? $fields['view-service'] : '';
        $area = isset($fields['area']) ? $fields['area'] : '';
        $place = isset($fields['place']) ? $fields['place'] : '';
        $region = isset($fields['region']) ? $fields['region'] : '';
        $locality = isset($fields['locality']) ? $fields['locality'] : '';
        $message = isset($fields['your-message']) ? $fields['your-message'] : '';

        echo $wpdb->insert(
            'wp_send_emails',
                array(
                    'name'=> $name,
                    'email' => $email,
                    'view_service' => $serice,
                    'area' => $area,
                    'location' => $place,
                    'region' => $region,
                    'locality' => $locality,
                    'message' => $message
                ),
                array(
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s'
                ));
    }
};

// add the action
add_action( 'wpcf7_before_send_mail', 'action_wpcf7_before_send_mail', 10, 1 );

function create_new_bl_orders(){
    global $error_message;

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new-order'])){
        $document = array();
        $order = new BLOrder();
        $_POST['date_end'] = date('Y-m-d',strtotime(str_replace('/','-',$_POST['date_end'])));
        $order->load($_POST);
        if(!empty($_FILES['order_file'])){
            $files = $_FILES["order_file"];
            foreach ($files['name'] as $key => $value) {
                if ($files['name'][$key]) {
                    $file = array(
                        'name' => $files['name'][$key],
                        'type' => $files['type'][$key],
                        'tmp_name' => $files['tmp_name'][$key],
                        'error' => $files['error'][$key],
                        'size' => $files['size'][$key]
                    );
                    $_FILES = array ("my_file_upload" => $file);
                    foreach ($_FILES as $file => $array) {
                       $document[] = my_handle_attachment($file,0);
                    }
                }
            }
            $order->document = serialize($document);
        }
        if($order_id = $order->insert()){
            $notification = new BLNotification;
            $notification->order_id = $order_id;
            $notification->description = "Вы создали новый заказ №".$order_id."!";
            $notification->insert();
            unset($notification);
            wp_redirect(site_url('/orders/new/?order=send'));
            die;
        }else{
            $error_message['new-order'] = "Не удалось отправить Заказ!";
        }


    }
}

add_action('init','create_new_bl_orders');

function init_bl_orders($type = null,$mark = null){
    global $bl_orders;
    $bl_orders = BLOrder::find(1,null,$type,$mark);
}
add_action('start_orders','init_bl_orders',10,2);

function init_bl_orders_filter($type = null,$mark = null){
    global $bl_orders;
    $bl_orders = BLOrder::filter($_GET);
}
add_action('start_orders_filter','init_bl_orders_filter',10,2);

function end_blorders(){
    global $bl_orders;
    unset($bl_orders);
}
add_action('end_orders','end_blorders');

function bl_send_mail(){
    global $mail_error;
    $mail_error = array();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send-mail'])){
        $admin_email = get_option('admin_email');
        debug(wp_mail($admin_email,'Оформление Участка',$_POST['checkorder']));
        if(!empty($_POST['checkorder'])){
            wp_mail($admin_email,'Оформление Участка',$_POST['checkorder']);
            wp_redirect(home_url()."?mail=send");
            die;
        }else{
            $mail_error[] = "Не удалось отправить сообщение";
        }
    }
    if(isset($_GET['mail']) && $_GET['mail'] == 'send')
        $mail_error = 'Сообщение отправлено!';
}
add_action('init','bl_send_mail');

/*
 *
 *
 *
 * @search in FAQ page
 *
 *
 *
 * */
function search_in_faq($query){
    if($query->is_search){
        $query->set('post_type', 'faq');
    }
}
add_action('pre_get_posts','search_in_faq');


function bl_delete_orders(){
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['del'])){
        if(isset($_POST['del-but'])){
            if(BLOrder::delete($_POST['del'])){
                foreach ($_POST['del'] as $order_id){
                    $notification = new BLNotification;
                    $notification->order_id = $order_id;
                    $notification->description = "Удаление заказа №".$order_id."  прошло успешно!";
                    $notification->insert();
                    unset($notification);
                }
            }

        }
        if(isset($_POST['archive'])){
            if(BLOrder::changeType(BLOrder::TYPE_ARCHIVE,$_POST['del'])){
                foreach ($_POST['del'] as $order_id){
                    $notification = new BLNotification;
                    $notification->order_id = $order_id;
                    $notification->description = "Перемищение в архив заказа №".$order_id." прошло успешно!";
                    $notification->insert();
                    unset($notification);
                }
            }
        }

        wp_redirect($_SERVER['REQUEST_URI']);
        die;
    }
}
add_action('init','bl_delete_orders');

function get_reminder_in_reminder_page($arf){
    global $bl_orders,$reminders;

    if(strpos($_SERVER['REQUEST_URI'],'reminder') !== false){
        $reminders = array();
        $reminder = BLReminder::getReminderByID(array_map(function ($el){
            return $el->id();
        },$bl_orders));

        foreach ($reminder as $rem){
            $reminders[$rem->order_id] = $rem;
        }
    }
}
add_action('start_orders','get_reminder_in_reminder_page');


function bl_user_notification($user_id = false){
    global $boklag_user,$notifications,$notification_count;
    $notification_count = 0;

    $user_id || $user_id = $boklag_user->ID;

    $notifications = array();
    $el = array();

    $notification_count += BLReminder::getReminderCountViewsByUser($user_id);
    $reminders_notification = BLReminder::getReminderViewsByUser( $user_id );

    $order_notification = BLNotification::getNewNotificationsByUser($user_id);
    $notification_count += BLNotification::getNewNotificationsCountByUser($user_id);



    foreach ($reminders_notification as $not){
        $el['type'] = 'reminder';
        $el['id'] = $not->id;
        $el['order_id'] = $not->order_id;
        $el['title'] = $not->title;
        $el['description'] = $not->description;
        $el['status'] = $not->status;
        $el['remind_time'] = $not->remind_time;
        $el['date_end'] = $not->date_end;
        $notifications[] = $el;
        $el = array();
    }
    foreach ($order_notification as $o_not){
        $el['type'] = 'order';
        $el['id'] = $o_not->id;
        $el['order_id'] = $o_not->order_id;
        $el['title'] = $o_not->title;
        $el['description'] = $o_not->description;
        $el['status'] = $o_not->status;
        $el['remind_time'] = null;
        $el['date_end'] = $o_not->date_end;
        $notifications[] = $el;
        $el = array();
    }
    return $notification_count;
}
add_action('is_boklag_user_login','bl_user_notification');


function bl_get_template_notification($echo = false){
    ob_start();
    get_template_part('template_parts/profile','notification');
    $content = ob_get_contents();
    ob_end_clean();

    if($echo)
        echo $content;
    else
        return $content;
}
add_action('get_template_notification','bl_get_template_notification');

/*
 *
 *
 * @checked if user login
 *
 *
 * */
function checked_user_front_login(){
    if(is_user_logged_in() && is_front_page()){
        wp_redirect(site_url('/orders/'));
        die;
    }
}
add_action('wp','checked_user_front_login');