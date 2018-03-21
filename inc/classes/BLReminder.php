<?php

class BLReminder
{
    const TABLE_NAME = 'wp_bl_reminder';

    public static function setReminder($order_id,$date){
        global $wpdb;
        return $wpdb->insert(self::TABLE_NAME,array(
            'order_id' => $order_id,
            'remind_time' => $date
        ));
    }

    public static function getReminderByID($ids){
        global $wpdb;
        $query = '
                SELECT id,order_id,remind_time
                FROM '.self::TABLE_NAME.'
                WHERE status = 0';
        if(is_array($ids)){
           $query .= ' AND order_id IN('.implode(',',$ids).')';
        }else{
            $query .= ' AND order_id = '.$ids;
        }

        return $wpdb->get_results($query);
    }

    public static function checkReminder(){
        global $wpdb;
        return $wpdb->get_results('
        SELECT id,order_id
        FROM '.self::TABLE_NAME.'
        WHERE (remind_time BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 1 HOUR)) 
        AND status = 0
        ');
    }

    public static function sendReminder(){
        global $wpdb;
        $reminders = self::checkReminder();
        if(sizeof($reminders) < 1)
            return;

        $orders = $wpdb->get_results('
            SELECT `order`.*,`user`.`user_email`
            FROM '.BLOrder::TABLE_NAME.' AS `order`
            LEFT JOIN `wp_users` AS `user` ON (`order`.`user_id` = `user`.`id`)
            WHERE `order`.`id`
            IN ('.implode(',',array_map(function ($el){
                return $el->order_id;
            },$reminders)).')
        ');
        foreach ($orders as $order){
            $to = $order->user_email;
            $subject = 'Напоминание о Заказе №'.$order->id;
            $message = "
                Номер Заказа: {$order->id} \n
                Вид работы: {$order->title} \n
                Стадия: {$order->status} \n
                Дата окончание работ: {$order->date_end} \n
                Адрес: {$order->address} \n
            ";
            $headers = 'From: <info@boklag.com>' . "\r\n";
            wp_mail($to,$subject,$message,$headers);
        }

        return $wpdb->get_results('
        UPDATE '.self::TABLE_NAME.'
        SET status = 1
        WHERE id IN ('.implode(',',array_map(function ($el){
                return $el->id;
            },$reminders)).')
        ');
    }
}
