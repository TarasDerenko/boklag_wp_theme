<?php
/***********************************************************/
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
/***********************************************************/
add_action( 'wp_login_failed', 'my_front_end_login_fail' );  // hook failed login

function my_front_end_login_fail( $username ) {
    global $login_errors;
    $login_errors = array();
   $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
   // if there's a valid referrer, and it's not the default log-in screen
   if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
      wp_redirect( $referrer . '?login=failed' );  // let's append some information (login=failed) to the URL for the theme to use
      exit;
   }
}
/***********************************************************/
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
/***********************************************************/
function boklag_registration(){
    if(is_user_logged_in())
        return;
    global $register_errors;
    $register_errors = array();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registration'],$_POST['user_login'],$_POST['pwd'],$_POST['approved'])){
        if(!filter_var($_POST['user_login'], FILTER_VALIDATE_EMAIL))
            $register_errors['email'] = "Не корректный Email!";
        if(strlen($_POST['pwd']) < 6)
            $register_errors['pwd'] = "Слишком короткий пароль";
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
                $register_errors['login'] = $user_login->get_error_message();
                add_action('wp_footer','show_popup_register',21);
            }
        }else{
            $register_errors['email'] = 'Извините, этот Email уже существует!';
            add_action('wp_footer','show_popup_register',21);
        }        
    }       
}
add_action('init','boklag_registration');
/***********************************************************/
function boklag_logout(){
    if(!isset($_GET['logout']))
        return;
    wp_logout();
    wp_redirect(home_url());
    die();
}
add_action('init','boklag_logout');
/***********************************************************/
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
/***********************************************************/
function checked_user_login(){
    global $boklag_user,$boklag_user_meta,$profule_edit_errors;
    if(!is_user_logged_in() && !wp_get_current_user()->exists()){
        wp_redirect(site_url());
        die;
    }
    $boklag_user = wp_get_current_user();
    $boklag_user_meta = get_user_meta($boklag_user->ID);
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
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
                $profule_edit_errors['load_image'] = $image_id->get_error_message();
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
add_action('is_boklag_user_login','checked_user_login');

function add_google_sign_in_script(){
    if(is_user_logged_in())
        return;
    ?>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="784347025730-uct0opjdbesr2rb1pcgdc12c4i7a9uit.apps.googleusercontent.com">
    <script type="text/javascript">
        window.onbeforeunload = function(e){
                gapi.auth2.getAuthInstance().signOut();
            };
    </script>
    <?php
}
add_action('wp_head','add_google_sign_in_script');