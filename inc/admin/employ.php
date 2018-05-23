<?php
function boklags_employ(){
    global $wpdb;
    $employs = $wpdb->get_results("
        SELECT *
        FROM ".$wpdb->prefix."bl_employment
    ");
    ?>

    <?php
}