<?php
/**
 * Created by PhpStorm.
 * User: konor
 * Date: 28.05.18
 * Time: 17:40
 */

class BLPerfomers
{
    public $id;
    public $name;
    public $image;
    public $description;

    const TABLE_NAME = 'wp_bl_performers';

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

    public static function find(){
        global $wpdb;
        return self::parse_all_results($wpdb->get_results("
            SELECT * 
            FROM ".self::TABLE_NAME."            
        "));
    }
}