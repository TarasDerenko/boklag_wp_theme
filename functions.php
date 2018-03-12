<?php 
require_once __DIR__.'/inc/wp-init.php';

function debug($var){
	echo '<pre>'.print_r($var,true).'</pre>';
	die;
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
	foreach ($data as $key => $value)
		update_user_meta($id,$key,$value);
	return true;
}
