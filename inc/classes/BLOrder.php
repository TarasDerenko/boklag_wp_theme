<?php

class BLOrder
{
    /*
     * @var title (varchar(255)) - Название
     * @var description (text) - Описание
     * @var work_type (varchar(255)) - вид роботи
     * @var status (varchar(255)) - стадия
     * @var price (float(9,2)) - цена
     * @var region (varchar(255)) - область
     * @var settlement (varchar(255)) - населенный пункт
     * @var street (varchar(255)) - улица
     * @var house (varchar(7)) - дом
     * @var location (varchar(255)) - местоположение
     * @var address (varchar(500)) - адресс
     * @var lat (float)- широта
     * @var lng (float)- долгота
     * @var document (varchar(255)) - радиус обекта
     * @var mark (int(2)) - метка
     * @var type (int(2)) - тип ( в архиве, с меткой)
     * @var date_end (datetime) - дата окончание
     * @var date_change (datetime) - дата изминения
     * @var date_create (datetime) - дата создания
     *
     *
     * */

    const TYPE_OPEN     = 1;
    const TYPE_MARK     = 2;
    const TYPE_ARCHIVE  = 3;
    const TYPE_DRAFT    = 4;

    const MARK_NORMAL   = 1;
    const MARK_ORANGE   = 2;
    const MARK_RED      = 3;
    const MARK_PURPLE   = 4;
    const MARK_YELLOW   = 5;
    const MARK_GREEN    = 6;
    const MARK_BLUE     = 7;

    const TABLE_NAME = 'wp_bl_orders';

    public $id;
    private $order_id;
    public $title;
    public $description;
    public $status;
    public $price;
    public $region;
    public $settlement;
    public $street;
    public $house;
    public $location;
    public $address;
    public $lat;
    public $lng;
    public $rang;
    public $document;
    public $mark;
    public $type;
    public $date_end;
    public $date_change;
    public $date_create;

    public function __construct(){

    }

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

    public function id(){
        return $this->id;
    }

    public function order_id(){
        return $this->order_id;
    }

    public function update(){
        global $wpdb;
        if(empty($this->id))
            return false;
        $fields = $this->get_update_fields();
        return $wpdb->update(self::TABLE_NAME,$fields,array('id' => $this->id));

    }

    public function insert(){
        if(!empty($this->id))
            return false;
        global $wpdb;
        $this->date_change = date('Y-m-d H:i:s');
        $fields = $this->get_update_fields();
        return $wpdb->insert(self::TABLE_NAME,$fields);

    }
    private function get_update_fields(){
        $fields = array();
        foreach ($this as $key => $value){
            if($key == 'id' || $key == 'date_create' || empty($value))
                continue;
            $fields[$key] = trim($value);
        }
        return $fields;
    }

    public static function findOne($id){
        global $wpdb;
        $query = $wpdb->prepare('SELECT * FROM '.self::TABLE_NAME.' WHERE id = %d LIMIT 1',array($id));
        $result = $wpdb->get_results($query);
        $obj = new self();
        self::parse_result($obj,$result);
        return $obj;
    }

    public function load($result){
        if(is_array($result)){
            foreach ($result as $key => $value){
                if(property_exists($this,$key))
                    $this->$key = $value;
            }
        }
    }

    public static function find($paged = 1,$limit = null, $type = null, $mark = null,$is_user = true){
        global $wpdb;
        $str = '';
        if($is_user){
            $user = wp_get_current_user();
            if($user->exists()){
                $str .= "WHERE `user_id` = {$user->ID} ";
            }
        }
        if(!$limit)
            $limit = get_option('bl-limit');
        $offset = ($paged - 1) * $limit;

        if($type)
            $str .= "AND `type` = $type ";
        if($mark)
            $str .= "AND `mark` = $mark ";


        $query = $wpdb->prepare("SELECT * FROM ".self::TABLE_NAME." ".$str." LIMIT %d OFFSET %d",array($limit,$offset));
        $results = $wpdb->get_results($query);

        return self::parse_all_results($results);
    }

    public static function pagination($paged = 1,$limit = null,$type = null, $mark = null,$is_user = true){

        global $wpdb;
        $args = array(
            'paged' => $paged,
            'limit' => ($limit) ? $limit : get_option('bl-limit'),
        );

        $str = '';
        if($is_user){
            $user = wp_get_current_user();
            if($user->exists()){
                $str .= "WHERE `user_id` = {$user->ID} ";
            }
        }
        if($type)
            $str .= "AND `type` = $type ";
        if($mark)
            $str .= "AND `mark` = $mark ";


        $total = $wpdb->get_results('SELECT count(*) AS count FROM '.self::TABLE_NAME.' '.$str);
        if(!isset($total[0]->count))
            return;
        $total = $total[0]->count;

        $max_paged = ceil($total / $args['limit']);
        $args = array(
            'total' => $max_paged,
            'current' => $args['paged'],
            'show_all' => false,
            'prev_next' => true,
            'end_size' => 1,
            'mid_size' => 4,
        );
        $total = (int) $args['total'];
        if ( $total < 2 ) {
            return;
        }
        $current  = (int) $args['current'];
        $end_size = (int) $args['end_size'];
        if ( $end_size < 1 ) {
            $end_size = 1;
        }
        $mid_size = (int) $args['mid_size'];
        if ( $mid_size < 0 ) {
            $mid_size = 2;
        }
        $r = '';
        $page_links = array();
        $dots = false;
        if($current == 1){
            $page_linksss_1 = '';
        }else{
            $page_linksss_1 = '<li><a data-paged="'. ($current - 1) .'" aria-label="Previous">&laquo;</a></li>';
        }
        for ( $n = 1; $n <= $total; $n++ ) :
            if ( $n == $current ) :
                $page_links[] = "<li class='noactive'><span>" . number_format_i18n( $n ) . "</span></li>";
                $dots = true;
            else :
                if ( $args['show_all'] || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) :
                    $page_links[] = "<li><a data-paged='" . number_format_i18n( $n ) . "'>" . number_format_i18n( $n ) . "</a></li>";
                    $dots = true;
                elseif ( $dots && ! $args['show_all'] ) :
                    $page_links[] = '<li><span class="page-numbers dots">' . __( '&hellip;' ) . '</span></li>';
                    $dots = false;
                endif;
            endif;
        endfor;
        if($current == $total){
            $page_linksss_2 = '';
        }else{
            $page_linksss_2 = '<li><a data-paged="' . ($current + 1) . '" aria-label="Next">&raquo;</a></li>';
        }
        $r = '<nav aria-label="Page navigation" class="bl-pagenavi"><ul class="pagination">'.$page_linksss_1;
        $r .= join("\n", $page_links);
        $r .= $page_linksss_2.'</ul></nav>';
        return $r;
    }
}


//$order = BLOrder::findOne(1);
//$order->title = 'title 9';
//$order->update();