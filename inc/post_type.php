<?php
add_action('init', 'my_custom_init');
function my_custom_init(){
  register_post_type('faq', array(
        'labels'             => array(
            'name'               => 'FAQs', // Основное название типа записи
            'singular_name'      => 'FAQ', // отдельное название записи типа Book
            'add_new'            => 'Добавить вопрос',
            'add_new_item'       => 'Добавить новий вопрос',
            'edit_item'          => 'Редактировать вопрос',
            'new_item'           => 'Новий вопрос',
            'view_item'          => 'Просмотреть вопрос',
            'search_items'       => 'Искать вопрос',
            'not_found'          => 'Вопрос не найден',
            'not_found_in_trash' => 'В корзине вопрос не найден',
            'parent_item_colon'  => '',
            'menu_name'          => 'Вопросы'
          ),
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'publicly_queryable' => true,
        'show_in_nav_menus'  => false,
        'has_archive'        => false,
        'menu_position'      => 4,
        'supports'           => array('title','editor')
    ));
 }