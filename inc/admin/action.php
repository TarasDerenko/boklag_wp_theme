<?php
add_action( 'admin_init', 'save_bl_comments' );
function save_bl_comments(){
    if(!current_user_can('manage_options'))
        wp_redirect('/');
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'],$_GET['id']) && $_GET['page'] == "boklag-orders" && !empty(trim($_POST['comment']))){
        $comment = new BLComments();
        $comment->comment = $_POST['comment'];
        $comment->order_id = $_GET['id'];
        if($comment->save())
            wp_redirect($_SERVER['REQUEST_URI']);
    }
}