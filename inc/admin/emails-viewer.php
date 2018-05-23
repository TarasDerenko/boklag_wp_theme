<?php
add_action('admin_head','admin_style');

/**************************************************************/
function add_calc_message(){
    global $wpdb;
    $i = 1;
//    if(sizeof($_POST)){
//        foreach ($_POST as $key => $value) {
//            update_option($key,$value);
//        }
//    }
    $query = 'SELECT * FROM `wp_send_emails` LIMIT 25';
    $emails = $wpdb->get_results($query);
    //echo '<pre>'.print_r($emails,true).'</pre>';
    ?>
    <div class="wrap">
        <h2><?php echo get_admin_page_title() ?></h2>
    <table class="table calc-table">
    <thead>
    <tr>
        <th>#</th>
        <th>Имя</th>
        <th>Email</th>
        <th>Вид услуг</th>
        <th>Площадь м<sup>2</sup></th>
        <th>Местоположение</th>
        <th>Район</th>
        <th>Населенный пункт</th>
        <th>Сообщение</th>
        <th>Дата</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($emails as $email) : ?>
        <tr>
            <td><?php echo $i++;?></td>
            <td><?php echo $email->name;?></td>
            <td><?php echo $email->email;?></td>
            <td><?php echo $email->view_service;?></td>
            <td><?php echo $email->area;?></td>
            <td><?php echo $email->location;?></td>
            <td><?php echo $email->region;?></td>
            <td><?php echo $email->locality;?></td>
            <td><?php echo $email->message;?></td>
            <td><?php echo $email->date;?></td>
        </tr>
    <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <?php
}
/**************************************************************/

function admin_style(){ ?>
    <style>
        .calc-table{
            width:100%;
            text-align: center;
        }
        .calc-table td{
            border-right: 1px solid #777;
            padding: 7px 0;
        }
        .calc-table tr:nth-child(2n){
            background: #fff;
        }
    </style>
<?php }