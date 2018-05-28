<?php
/**
 * Created by PhpStorm.
 * User: konor
 * Date: 28.05.18
 * Time: 15:03
 */

class BLComments
{
    public $id;
    public $parent_id = 0;
    public $order_id;
    public $user_id;
    public $perfomer;
    public $price;
    public $comments;
    public $create_date;
    public $display_name;
    public $user_email;

    const TABLE_NAME = 'wp_bl_order_comments';

    private static function parse_result($obj,$result){
        if(is_array($result)){
            foreach ($result as $order){
                foreach ($order as $key => $value){
                    if(property_exists($obj,$key))
                        $obj->$key = $value;
                }
            }
        }
    }

    private static function parse_all_results($result){
        if(is_array($result)){
            $res = array();
            foreach ($result as $order){
                $obj = new self;
                foreach ($order as $key => $value){
                    if(property_exists($obj,$key))
                        $obj->$key = $value;
                }
                $res[] = $obj;
            }
            return $res;
        }
        return array();
    }

    public static function findByOrderId($ids){
        global $wpdb;
        if(is_integer($ids)){
            return self::parse_all_results($wpdb->get_results($wpdb->prepare("
            SELECT `c`.*,`u`.`display_name`,`u`.`user_email`
            FROM ".self::TABLE_NAME." as c
            LEFT JOIN ".$wpdb->prefix."users as u
            ON (`c`.`user_id` = `u`.`ID`)
            WHERE order_id = %d
        ",array($id))));
        }elseif (is_array($ids)){
            return self::parse_all_results($wpdb->get_results($wpdb->prepare("
            SELECT `c`.*,`u`.`display_name`,`u`.`user_email`
            FROM ".self::TABLE_NAME." as c
            LEFT JOIN ".$wpdb->prefix."users as u
            ON (`c`.`user_id` = `u`.`ID`)
            WHERE order_id IN(".implode(',',array_fill(0,sizeof($ids),'%d')).")
        ",$ids)));
        }

    }

    function save(){
        global $wpdb;
        return $wpdb->insert(self::TABLE_NAME,array(
            'parent_id' => $this->parent_id,
            'order_id' => $this->order_id,
            'user_id' => ($this->user_id) ? $this->user_id : get_current_user_id(),
            'perfomer' => $this->perfomer,
            'price' => round($this->price,2),
            'comments' => $this->comments,
        ),array('%d','%d','%d','%d','%d','%s'));
    }


}