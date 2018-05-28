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
    const TYPE_DRAFT    = 2;
    const TYPE_ARCHIVE  = 3;
    const TYPE_DELETED  = 4;

    const MARK_WHITE    = 1;
    const MARK_ORANGE   = 2;
    const MARK_RED      = 3;
    const MARK_PURPLE   = 4;
    const MARK_YELLOW   = 5;
    const MARK_GREEN    = 6;
    const MARK_BLUE     = 7;

    const STATUS_WAIT = 1;
    const STATUS_IN_WORK = 2;
    const STATUS_DONE = 3;

    const TABLE_NAME = 'wp_bl_orders';

    public $id;
    private $order_id;
    public $title;
    public $description;
    public $area;
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
    public $comments;
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

    public static function get_status($key){
        $status = array(
            '1' => 'ожидает выполнения',
            '2' => 'в работе',
            '3' => 'выполнено'
        );
        if(key_exists($key,$status))
            return $status[$key];
        return 'не определен';
    }

    public static function get_type($key){
        $status = array(
            '1' => 'Открыт',
            '2' => 'В Черновике',
            '3' => 'В Архиве',
            '4' => 'В Удаленных',
        );
        if(key_exists($key,$status))
            return $status[$key];
        return 'не определен';
    }

    public static function get_mark($key = null){
        $color = array(
            self::MARK_WHITE => 'white',
            self::MARK_ORANGE => 'orange',
            self::MARK_RED => 'red',
            self::MARK_PURPLE => 'purple',
            self::MARK_YELLOW => 'yellow',
            self::MARK_GREEN => 'green',
            self::MARK_BLUE => 'blue',
        );
        if($key && key_exists($key,$color))
            return $color[$key];
        if($key)
            return 'white';
        return $color;
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
        $this->user_id = get_current_user_id();
        $this->date_change = date('Y-m-d H:i:s');
        $fields = $this->get_update_fields();
        $res = $wpdb->insert(self::TABLE_NAME,$fields);
        if($res)
            return $wpdb->insert_id;
        return false;

    }

    private function get_update_fields(){
        $fields = array();
        $this->date_change = date('Y-m-d H:i:s');
        foreach ($this as $key => $value){
            if($key == 'id' || $key == 'date_create' || empty($value) || $key == 'comments')
                continue;
            $fields[$key] = trim($value);
        }
        return $fields;
    }

    public static function findOne($id){
        global $wpdb;
        $query = $wpdb->prepare('SELECT * FROM '.self::TABLE_NAME.' WHERE id = %d LIMIT 1',array($id));
        $result = $wpdb->get_results($query);
        if(!$result){
            return false;
        }
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
        $search = '';

        if(isset($_GET['sp']) && !empty(trim($_GET['sp'])) && strpos($_SERVER['REQUEST_URI'],'search') !== false){
            $like = '%'.$_GET['sp'].'%';
            $search = $wpdb->prepare( "AND (id LIKE %s OR title LIKE %s OR description LIKE %s OR street LIKE %s)", array_fill(0,4,$like));
        }

        $str = '';
        $query_var = get_query_var( 'orders_page' );

        if(!empty($query_var)){
            $query_arr = explode('/',$query_var);
            if(isset($query_arr[2]) && is_numeric($query_arr[2]))
                $paged = $query_arr[2];
            else if(isset($query_arr[1]) && is_numeric($query_arr[1]))
                $paged = $query_arr[1];
            else
                $paged = $paged;
        }
        if($is_user){
            $user = wp_get_current_user();
            if($user->exists()){
                $str .= $wpdb->prepare("WHERE `user_id` = %d ",$user->ID);
            }
        }
        if(!$limit)
            $limit = get_option('bl-limit');
        $offset = ($paged - 1) * $limit;

        if($type && $type > 0)
            $str .= $wpdb->prepare("AND `type` = %d ",$type);
        if($type && $type < 0)
            $str .= $wpdb->prepare("AND `type` != %d ",abs($type));
        if($mark)
            $str .= $wpdb->prepare("AND `mark` = %d ",$mark);

        $q = "SELECT * FROM ".self::TABLE_NAME." ".$str.$search;

        wp_cache_set('order_query',$q);
        wp_cache_set('order_limit',$limit);
        wp_cache_set('order_paged',$paged);
        $query = $wpdb->prepare($q." ORDER BY id DESC LIMIT %d OFFSET %d",array($limit,$offset));
        $results = self::withComments($wpdb->get_results($query));

        return self::parse_all_results($results);
    }

    public static function filter($param = array()){
        global $wpdb;
        $str = '';
        $query_var = get_query_var( 'orders_page' );

        if(!empty($query_var)){
            $query_arr = explode('/',$query_var);
            if(isset($query_arr[2]) && is_numeric($query_arr[2]))
                $paged = $query_arr[2];
            else if(isset($query_arr[1]) && is_numeric($query_arr[1]))
                $paged = $query_arr[1];
            else
                $paged = 1;
        }
        if( $user = wp_get_current_user()){
            if($user->exists()){
                $str .= $wpdb->prepare("WHERE `user_id` = %d ",$user->ID);
            }
        }

        $limit = get_option('bl-limit');

        $offset = ($paged - 1) * $limit;
        $str .= (isset($param['type'])) ? $wpdb->prepare("AND `type` in(".implode(',',array_fill(0, count($param['type']),'%d')).") ",$param['type']) : '';
        $str .= (isset($param['mark'])) ? $wpdb->prepare("AND `mark` > %d ",1) : '';
        $str .= (isset($param['title']) && !empty(trim($param['title']))) ? $wpdb->prepare("AND `title` like %s ",'%'.$param['title'].'%') : '';
        $str .= (isset($param['date-end']) && !empty(trim($param['date-end']))) ? $wpdb->prepare("AND `date_end` = %s ",date('Y-m-d',strtotime(str_replace('/','-',$param['date-end'])))) : '';
        $q = "SELECT * FROM ".self::TABLE_NAME." ".$str;
        wp_cache_set('order_query',$q);
        wp_cache_set('order_limit',$limit);
        wp_cache_set('order_paged',$paged);
        $query = $wpdb->prepare($q." ORDER BY id DESC LIMIT %d OFFSET %d",array($limit,$offset));
        $results = $wpdb->get_results($query);

        return self::parse_all_results($results);
    }

    public static function pagination(){

        global $wpdb;
        $query = wp_cache_get('order_query');
        $limit = wp_cache_get('order_limit');
        $paged = wp_cache_get('order_paged');

        $args = array(
            'paged' => $paged,
            'limit' => ($limit) ? $limit : get_option('bl-limit'),
        );

        $query = str_replace('*','COUNT(*) AS count',$query);
        $total = $wpdb->get_results($query);
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
            $page_linksss_1 = '<li><a href="'. esc_url( add_query_arg( 'paged', ($current - 1) ) ) .'" aria-label="Previous">&laquo;</a></li>';
        }
        for ( $n = 1; $n <= $total; $n++ ) :
            if ( $n == $current ) :
                $page_links[] = "<li class='noactive'><span>" . number_format_i18n( $n ) . "</span></li>";
                $dots = true;
            else :
                if ( $args['show_all'] || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) :
                    $page_links[] = "<li><a href='" . esc_url( add_query_arg( 'paged', number_format_i18n( $n ) ) ) . "'>" . number_format_i18n( $n ) . "</a></li>";
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
            $page_linksss_2 = '<li><a href="' . esc_url( add_query_arg( 'paged', ($current + 1) ) ) . '" aria-label="Next">&raquo;</a></li>';
        }
        $r = '<nav aria-label="Page navigation" class="bl-pagenavi"><ul class="pagination">'.$page_linksss_1;
        $r .= join("\n", $page_links);
        $r .= $page_linksss_2.'</ul></nav>';
        return $r;
    }

    public static function delete($ids){
        global $wpdb;
        if(is_array($ids))
            return $wpdb->query("DELETE FROM ".self::TABLE_NAME." WHERE id IN(".implode(',',$ids).")" );
        return $wpdb->delete(self::TABLE_NAME,array('id' => $ids));

    }

    public static function changeType($type,$ids){
        global $wpdb;
        if(is_array($ids))
            return $wpdb->query("UPDATE ".self::TABLE_NAME." SET `type` = $type WHERE id IN(".implode(',',$ids).")" );
        return $wpdb->update(self::TABLE_NAME,array('type' => $type),array('id' => $ids));
    }

    public static function changeMark($mark,$ids){
        global $wpdb;
        if(is_array($ids))
            return $wpdb->query("UPDATE ".self::TABLE_NAME." SET `mark` = $mark WHERE id IN(".implode(',',$ids).")" );
        return $wpdb->update(self::TABLE_NAME,array('mark' => $mark),array('id' => $ids));
    }

    private static function withComments($arr){
        $comments = BLComments::findByOrderId(array_map(function($it){
            return $it->id;
        },$arr));
        $coms = array();
        foreach ($comments as $comment){
            $coms[$comment->order_id][] = $comment;
        }
        $res = array();
        foreach ($arr as $order){
            if(array_key_exists($order->id,$coms))
                $order->comments = $coms[$order->id];
            $res[] = $order;
        }
        return $res;
    }
}