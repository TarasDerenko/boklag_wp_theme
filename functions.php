<?php 
require_once __DIR__.'/inc/wp-init.php';

function debug($var){
	echo '<pre>'.print_r($var,true).'</pre>';
	//die;
}

function get_bl_user_data($meta,$key){
	if(isset($meta[$key][0]))
		return $meta[$key][0];
	return '';
}

function update_boklag_user_data($id,array $args){
	if(!is_array($args) || !$id)
		return false;
	$def = array(
		'user_factory' => '',  
	  	'user_tel' => '',
	  	'user_email' => '',
	  	'user_messenger' => '',
	  	'user_viber' => '',
	  	'user_whatsapp' => '',
	  	'user_facebook' => '',
	  	'user_instagram' => '',
	  	'user_vkontakte' => '',
	  	'user_pinterest' => '',
	  	'user_avatar' => '',
	);
	$data = array_intersect_key(array_merge($def,$args),$def);
	foreach ($data as $key => $value){
	    if($key == 'user_avatar' && empty($value))
	        continue;
        update_user_meta($id,$key,$value);
    }
	return true;
}


add_action('init', 'dcc_rewrite_tags');
function dcc_rewrite_tags(){
    add_rewrite_tag('%orders_page%', '([^&]+)');
}

add_action('init', 'dcc_rewrite_rules');
function dcc_rewrite_rules(){
    add_rewrite_rule('^orders/(.+)/?','index.php?page_id=121&orders_page=$matches[1]','top');
}

add_filter( 'template_include', 'my_callback' );
function my_callback( $original_template ){
    $query_var = get_query_var( 'orders_page' );
    if ( !empty($query_var) ){
        $query = explode('/',$query_var);
        $path = __DIR__ . '/order_parts/'.$query[0].'.php';
        if(file_exists($path))
            return $path;
        else
            return $original_template;
    }else{
        return $original_template;
    }
}

function bl_active($par1,$par2,$class =''){
    if(in_array($par2,explode('/',$par1)))
        echo 'class="active '.$class.'"';
    else
        echo $class;
}

function my_handle_attachment($file_handler,$post_id) {
    // check to make sure its a successful upload
    if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();
    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
    require_once(ABSPATH . "wp-admin" . '/includes/media.php');
    $attach_id = media_handle_upload( $file_handler, $post_id );
    return $attach_id;
}

function get_reminder_bell(){
    global $order,$reminders;
    $date = '';
    $time_h = '';
    $time_m = '';
    $selected = false;
    if(is_array($reminders) && key_exists($order->id,$reminders)){
        $date = date('d/m/Y',strtotime($reminders[$order->id()]->remind_time));
        $time_h = date('H',strtotime($reminders[$order->id()]->remind_time));
        $time_m = date('i',strtotime($reminders[$order->id()]->remind_time));
        $selected = true;
    }
    ob_start(); ?>
    <div class="reminder-area">
        <button class="set-reminder-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="19" viewBox="0 0 17 19">
                <path d="M1248.9,224.646a7.654,7.654,0,0,1-2.47-5.628v-3.107a5.038,5.038,0,0,0-3-4.565,7.029,7.029,0,0,0-1.23-.42v-0.2a1.76,1.76,0,0,0-3.52,0v0.229a7.009,7.009,0,0,0-1.11.393,5.217,5.217,0,0,0-3.11,4.56v3.109a7.579,7.579,0,0,1-2.36,5.628,0.349,0.349,0,0,0-.09.349,0.359,0.359,0,0,0,.28.237l3.34,0.566c0.62,0.1,1.19.191,1.74,0.263a3.5,3.5,0,0,0,6.27,0c0.54-.071,1.11-0.157,1.73-0.262l3.34-.566a0.356,0.356,0,0,0,.28-0.236A0.372,0.372,0,0,0,1248.9,224.646Zm-9.52-13.919a1.055,1.055,0,0,1,2.11,0v0.063a7.107,7.107,0,0,0-2.11.016v-0.079Zm1.12,16.582a2.818,2.818,0,0,1-2.25-1.145,21.336,21.336,0,0,0,4.51,0A2.835,2.835,0,0,1,1240.5,227.309Zm4.75-2.192c-0.67.114-1.29,0.207-1.88,0.28h0q-0.39.048-.75,0.084a0.034,0.034,0,0,1-.01,0q-0.33.033-.66,0.055l-0.12.009c-0.19.012-.38,0.021-0.56,0.028l-0.12,0c-0.43.014-.86,0.014-1.3,0l-0.12,0c-0.18-.007-0.36-0.016-0.55-0.028l-0.13-.009c-0.21-.015-0.43-0.032-0.64-0.053l-0.03,0c-0.24-.024-0.49-0.052-0.74-0.084h-0.01c-0.58-.073-1.2-0.166-1.88-0.281l-2.7-.458a8.23,8.23,0,0,0,2.11-5.641v-3.107a4.523,4.523,0,0,1,2.71-3.935,6.456,6.456,0,0,1,1.23-.409,0.034,0.034,0,0,0,.01,0,6.526,6.526,0,0,1,2.67-.023s0,0,.01,0a6.293,6.293,0,0,1,1.34.432,4.368,4.368,0,0,1,2.59,3.935v3.11a8.345,8.345,0,0,0,2.22,5.641Zm-2.55-12.2a5.474,5.474,0,0,0-4.39,0,3.5,3.5,0,0,0-2.09,2.99,0.347,0.347,0,0,0,.35.348h0a0.348,0.348,0,0,0,.35-0.344,2.793,2.793,0,0,1,1.68-2.366,4.736,4.736,0,0,1,3.8,0,0.358,0.358,0,0,0,.47-0.171A0.347,0.347,0,0,0,1242.7,212.917Z" transform="translate(-1232 -209)"/>
            </svg>
        </button>
        <div class="reminder-form">
            <form>
                <div class="reminder-form-row">
                    <div class="reminder-form-column">
                        <label for="">Дата</label>
                        <input class="reminder-field-date" type="text" placeholder="10/11/017" value="<?= $date ?>">
                    </div>
                    <div class="reminder-form-column">
                        <label for="">Время</label>
                        <input class="reminder-field-time reminder-field-hour" type="text" value="<?= $time_h ?>">
                        <span class="reminder-time-dots">:</span>
                        <input class="reminder-field-time reminder-field-min" type="text"  value="<?= $time_m ?>">
                    </div>
                </div>
                <?php if($selected): ?>
                    <button type="button" class="button button-update"><span>Обновить</span></button>
                    <button class="button button-delete"><span>Удалить</span></button>
                <?php else: ?>
                    <button type="button" class="button button-invert"><span>Установить напоминание</span></button>
                <?php endif; ?>
            </form>
        </div>
    </div>
<?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

function renderJSON(array $data){
    header('Content-type: application/json');
    wp_die(wp_json_encode($data));
}