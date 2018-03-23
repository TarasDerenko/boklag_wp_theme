<?php

class BLService
{
    public $id;
    public $title;
    public $description;

    const TABLE_NAME = 'wp_bl_services';

    public static function getServices(){
        global $wpdb;
        if( ! $res = wp_cache_get('bl_services')){
            $res = $wpdb->get_results("
            SELECT *
            FROM ".self::TABLE_NAME."
            ");
            wp_cache_set('bl_services',$res);
        }
        return $res;
    }

    public static function searchServices($str){
        global $wpdb;
        return $wpdb->get_results("
            SELECT *
            FROM ".self::TABLE_NAME."
            WHERE title LIKE '%".$str."%'
            ");
    }

}