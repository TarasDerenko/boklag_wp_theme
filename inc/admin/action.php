<?php
add_action( 'admin_init', 'save_bl_comments' );
function save_bl_comments(){
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'],$_GET['id']) && $_GET['page'] == "boklag-orders" && !empty(trim($_POST['comment'])) && $_POST['code'] != 0){
        $comment = new BLComments();
        $comment->comments = $_POST['comment'];
        $comment->order_id = $_GET['id'];
        $comment->perfomer = $_POST['code'];
        $comment->price = $_POST['price'];
        if($comment->save())
            wp_redirect($_SERVER['REQUEST_URI']);
    }
}
