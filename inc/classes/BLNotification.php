<?php
/**
 * Created by PhpStorm.
 * User: konor
 * Date: 27.03.18
 * Time: 16:33
 */

class BLNotification
{
    /*
     *
     * @var id
     * @var user_id
     * @var type
     * @var element_id
     * @var description
     * @var is_view
     * @var date
     *
     *
     * */

    public $id;
    public $user_id;
    public $order_id;
    public $description;
    public $is_view;
    public $date;

    const TABLE_NAME = "wp_bl_notifications";

    public function insert(){
        global $wpdb;
        $args = array();
        $this->user_id = get_current_user_id();
        foreach ($this as $key => $val){
            if(empty($val))
                continue;
            $args[$key] = $val;
        }
        if(!empty($args))
            return $wpdb->insert(self::TABLE_NAME,$args);
        return false;

    }

    public static function getNotificationsByUser($userId){
        global $wpdb;
        return $wpdb->get_results("
            SELECT n.*,o.title,o.status,o.date_end
            FROM ".self::TABLE_NAME." AS n
            LEFT JOIN ".BLOrder::TABLE_NAME." AS o
            ON (`n`.`order_id` = `o`.`id`)
            WHERE `n`.`user_id` = ".$userId." 
        ");
    }

    public static function getNewNotificationsByUser($userId){
        global $wpdb;
        return $wpdb->get_results("
            SELECT n.*,o.title,o.status,o.date_end
            FROM ".self::TABLE_NAME." AS n
            LEFT JOIN ".BLOrder::TABLE_NAME." AS o
            ON (`n`.`order_id` = `o`.`id`)
            WHERE `n`.`user_id` = ".$userId." 
            AND `n`.`is_view` = 0
            ORDER BY `n`.`id` DESC
            LIMIT 5
        ");
    }

    public static function getNewNotificationsCountByUser($userId){
        global $wpdb;
        $res = $wpdb->get_results("
            SELECT COUNT(*) AS count
            FROM ".self::TABLE_NAME."
            WHERE `user_id` = ".$userId." 
            AND `is_view` = 0
        ");
        if(isset($res[0]->count))
            return $res[0]->count;
        return 0;
    }


    public static function updateNotification($id){
        global $wpdb;
        return $wpdb->update(self::TABLE_NAME,array('is_view' => 1),array('id' => $id));
    }

}