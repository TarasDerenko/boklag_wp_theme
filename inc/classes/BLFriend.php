<?php
/**
 * Created by PhpStorm.
 * User: konor
 * Date: 28.03.18
 * Time: 16:33
 */

class BLFriend
{
    /*
     *
     * @var user_id
     * @var email
     * @var is_exist
     *
     * */

    public $user_id;
    public $email;
    public $is_exist;

    const TABLE_NAME = "wp_bl_friends";

    public function insert(){
        global $wpdb;


        return $wpdb->insert(self::TABLE_NAME,array(
            'user_id' => get_current_user_id(),
            'email' => $this->email
        ));
    }

    public static function getFriendsByUserID($id){
        global $wpdb;
        return $wpdb->get_results($wpdb->prepare("
            SELECT *
            FROM ".self::TABLE_NAME."
            WHERE user_id = %d
        ",$id));
    }

    public function isExist(){
        global $wpdb;
        return $wpdb->get_row("
            SELECT *
            FROM ".self::TABLE_NAME."
            WHERE `email` = '".$this->email."'
        ");

    }
}