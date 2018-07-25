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
    public $order_id;
    public $user_id;
    public $comment;
    public $create_date;
    public $display_name;
    public $user_email;

    const TABLE_NAME = 'wp_bl_order_comments';
    public function __construct($obj = null){
        if($obj){
            foreach ($obj as $key => $value){
                if(property_exists($this,$key))
                    $this->$key = $value;
            }
        }
    }

    private static function parse_all_results($result){
        if(is_array($result)){
            $res = array();
            foreach ($result as $order){
                $res[] = new self($order);
            }
            return $res;
        }
        return array();
    }

    public static function findOne($id){
        global $wpdb;
        $res = self::parse_all_results($wpdb->get_results($wpdb->prepare("
            SELECT *
            FROM ".self::TABLE_NAME."
            WHERE `id` = %d
            LIMIT 1
        ",$id)));
        return isset($res[0]) ? $res[0] : null;
    }

    public static function findByOrderId($ids){
        global $wpdb;
        if(!$ids)
            return array();
        if(is_array($ids)){
            return self::parse_all_results($wpdb->get_results($wpdb->prepare("
            SELECT `c`.*,`u`.`display_name`,`u`.`user_email`
            FROM ".self::TABLE_NAME." as c
            LEFT JOIN ".$wpdb->prefix."users as u
            ON (`c`.`user_id` = `u`.`ID`)
            WHERE order_id IN(".implode(',',array_fill(0,sizeof($ids),'%d')).")
        ",$ids)));
        }else{
            return self::parse_all_results($wpdb->get_results($wpdb->prepare("
            SELECT `c`.*,`u`.`display_name`,`u`.`user_email`
            FROM ".self::TABLE_NAME." as c
            LEFT JOIN ".$wpdb->prefix."users as u
            ON (`c`.`user_id` = `u`.`ID`)
            WHERE order_id = %d
        ",array($ids))));
        }

    }

    public function save(){
        global $wpdb;
        $this->user_id = ($this->user_id) ? $this->user_id : get_current_user_id();
        return $wpdb->insert(self::TABLE_NAME,array(
            'order_id' => $this->order_id,
            'user_id' => $this->user_id,
            'comment' => $this->comment,
        ),array('%d','%d','%s'));
    }

    public function update(){
        global $wpdb;
        return $wpdb->update(self::TABLE_NAME,
            array('comment' => $this->comment),
            array('id' => $this->id),
            array('%s'),
            array('%d')
        );
    }

    public function delete(){
        global $wpdb;
        return $wpdb->delete(self::TABLE_NAME,array('id' => $this->id));
    }

}