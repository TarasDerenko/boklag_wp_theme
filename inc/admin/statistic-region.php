<?php
add_action('admin_menu', function(){
    add_menu_page(
        'Статистика по Регионам',
        'Статистика',
        'manage_options',
        'region-statistics',
        'add_region_statistics',
        'dashicons-chart-bar',
        72 );
} );


/**************************************************************/
function add_region_statistics(){
    global $wpdb;
    $i = 1;
//    if(sizeof($_POST)){
//        foreach ($_POST as $key => $value) {
//            update_option($key,$value);
//        }
//    }
    $query = 'SELECT region,COUNT(*) AS count FROM `wp_region_statistics` GROUP BY region';
    $regions = $wpdb->get_results($query);
    ?>
    <div class="wrap">
        <h2><?php echo get_admin_page_title() ?></h2>
        <table class="table calc-table">
            <thead>
            <tr>
                <th>#</th>
                <th>Регион</th>
                <th>Количество</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($regions as $region) : ?>
                <tr>
                    <td><?php echo $i++;?></td>
                    <td><?php echo $region->region;?></td>
                    <td><?php echo $region->count;?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
}
/**************************************************************/
