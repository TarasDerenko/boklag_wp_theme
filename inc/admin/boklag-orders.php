<?php

function add_bl_orders(){
    if(isset($_GET['id']))
        get_template_part('/inc/admin/order');
    else
        get_template_part('/inc/admin/orders');
}