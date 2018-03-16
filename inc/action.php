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

add_action( 'wp_login_failed', 'my_front_end_login_fail' );  // hook failed login

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
<?php endif; ?>

<?php
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
    $register_errors = array();
    $register_info = array();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registration'],$_POST['user_login'],$_POST['pwd'],$_POST['approved'])){
        if(!filter_var($_POST['user_login'], FILTER_VALIDATE_EMAIL))
            $error_message['email'] = "Не корректный Email!";
        if(strlen($_POST['pwd']) < 6)
            $error_message['pwd'] = "Слишком короткий пароль";
        if(sizeof($register_errors)){
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
                wp_redirect(home_url());
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
function show_popup_login(){
    if(isset($_GET['login']) && $_GET['login'] == 'failed' && $_SERVER['REQUEST_METHOD'] == 'GET'):
    ?>
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
    endif;
}
add_action('wp_footer','show_popup_login',22);
/*
 *
 *
 * @checked if user login
 *
 *
 * */
function checked_user_login(){
    global $boklag_user,$boklag_user_meta,$biklag_user_avatar;
    if(!is_user_logged_in() && !wp_get_current_user()->exists()){
        wp_redirect(site_url('?reg=false'));
        die;
    }
    $boklag_user = wp_get_current_user();
    $boklag_user_meta = get_user_meta($boklag_user->ID);
    $img = wp_get_attachment_image_url(get_bl_user_data($boklag_user_meta,'user_avatar'),'full');
    $biklag_user_avatar = (!empty($img)) ? $img : DEFAULT_AVATAR;
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
    global $boklag_user,$error_message;
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit-profile'])){
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
        if(empty(trim($_POST['user_pass'])))
            unset($_POST['user_pass']);
        $user_id = wp_update_user(array(
            'ID' => $boklag_user->ID,
            'user_email' =>  $_POST['user_email'],
        ));
        $save = update_boklag_user_data($user_id,$_POST);
        if($save){
            wp_redirect(site_url('/kabinet/'));
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

function create_new_blorders(){
    global $error_message;
    if(isset($_GET['orders_page']) && $_GET['orders_page'] == 'new' && $_SERVER['REQUEST_METHOD'] == 'POST'){
        $document = array();
        $order = new BLOrder();
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
        for ($i = 1; $i < 61; $i++){
            $order->title = 'ТД по установлению границ участка в натуре '.$i;
            $order->insert();
        }
    }
}

add_action('init','create_new_blorders');


function init_blorders($type = null,$mark = null){
    global $bl_orders;
    $bl_orders = BLOrder::find(1,null,$type,$mark);
}
add_action('start_orders','init_blorders',10,2);

function end_blorders(){
    global $bl_orders;
    unset($bl_orders);
}
add_action('end_orders','end_blorders');