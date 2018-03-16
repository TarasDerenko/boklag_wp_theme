<?php

class CreditCard
{
    const CREDIT_HASH = 'LKJijdahsudIUHud767fg45gdfgSshdahDdSDsd';

    public $user;
    private $_card;
    private $_cvv = 777;
    private $_date = '11-12';
    private $wpdb;
    public function __construct($card)
    {
        global $wpdb;
        $this->wpdb = &$wpdb;
        $this->user = wp_get_current_user();
        $this->hashCard($card);
        $this->saveCard();
    }

    private function hashCard($card){
        $this->_card = base64_encode(self::CREDIT_HASH.decbin((int)$card));
    }

    private function unHashCard(){
        $this->_card = bindec(str_replace(self::CREDIT_HASH,'',base64_decode($this->_card)));
    }

    public function debug($var){
        echo '<pre>'.print_r($var,true).'</pre>';
    }

    public function saveCard(){
        $query = $this->wpdb->prepare(
            "INSERT INTO wp_credit_card VALUES(NULL,%s,%d,%s,%d)",
            $this->_card,
            $this->_cvv,
            $this->_date,
            $this->user->ID
        );
        return $this->wpdb->query($query);
    }


}
