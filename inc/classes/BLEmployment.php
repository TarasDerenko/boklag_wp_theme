<?php
/**
 * Created by PhpStorm.
 * User: konor
 * Date: 21.05.18
 * Time: 12:53
 */

class BLEmployment
{
    const TYPE_FREE = 1;
    const TYPE_NORMAL = 2;
    const TYPE_BUSY = 3;

    public $id;
    public $date;
    public $cost;
    public $avail;
    public $data;

    public static function init(){
        return new self();
    }

    public function getAvailByDate($from,$to,$limit = null){
        global $wpdb;
        $query = $wpdb->prepare("
            SELECT * 
            FROM {$wpdb->prefix}bl_employment
            WHERE (date BETWEEN %s AND %s)
        ",array($from,$to));
        if($limit){
            $query .= " LIMIT $limit";
        }
       $this->data = $wpdb->get_results($query);
       return $this;
    }

    public function getMin(){
        if(is_array($this->data)){
           return array_reduce($this->data, function ($carry,$item){
               if($carry == null)
                   $carry = $item->cost;

               if($carry < $item->cost){
                   return $carry;
               }else{
                   return $item->cost;
               }
           });
        }
        return 0;
    }

    public function getMax(){
        if(is_array($this->data)){
            return array_reduce($this->data, function ($carry,$item){
                if($carry > $item->cost){
                    return $carry;
                }else{
                    return $item->cost;
                }
            });
        }
        return 0;
    }

    public function step(){
        return ($this->getMax() - $this->getMin()) * 0.01;
    }

    public function getTypeClass($key){
        $classes = array("","blue","red");
        if(array_key_exists($key,$classes))
            return $classes[$key];
        return '';
    }
}