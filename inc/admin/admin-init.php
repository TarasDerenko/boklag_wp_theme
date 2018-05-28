<?php
require_once __DIR__.'/scripts.php';
require_once __DIR__.'/admin-ajax.php';
require_once __DIR__.'/emails-viewer.php';
require_once __DIR__.'/theme-option.php';
require_once __DIR__.'/user-profile.php';
require_once __DIR__.'/statistic-region.php';
require_once __DIR__.'/services-document.php';
require_once __DIR__.'/documents.php';
require_once __DIR__.'/employ.php';
require_once __DIR__.'/boklag-orders.php';
require_once __DIR__.'/action.php';
add_action('admin_menu', function(){
    add_menu_page(
        'Boklag',
        'Boklag',
        'manage_options',
        'boklag-options',
        'add_boklag_setting',
        '',
        73 );
    add_submenu_page(
        'boklag-options',
        'Заказы',
        'Заказы',
        'manage_options',
        'boklag-orders',
        'add_bl_orders');
    add_submenu_page(
        'boklag-options',
        'Статистика по Регионам',
        'Статистика',
        'manage_options',
        'region-statistics',
        'add_region_statistics');
    add_submenu_page(
        'boklag-options',
        'Калькулятор стоимости услуги',
        'Калькулятор',
        'manage_options',
        'calculator-message',
        'add_calc_message');
    add_submenu_page(
        'boklag-options',
        'Услуги',
        'Услуги',
        'manage_options',
        'services-document',
        'services_document');
    add_submenu_page(
        'boklag-options',
        'Документы',
        'Документы',
        'manage_options',
        'boklag-documents',
        'boklags_documents');
    add_submenu_page(
        'boklag-options',
        'Занятость',
        'Занятость',
        'manage_options',
        'boklag-employ',
        'boklags_employ');
} );