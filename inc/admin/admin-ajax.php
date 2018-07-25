<?php
add_action('wp_ajax_add_doc_to_service', 'add_doc_to_service');
add_action('wp_ajax_delete_doc_to_service', 'delete_doc_to_service');
add_action('wp_ajax_add_service', 'add_service');
add_action('wp_ajax_delete_service', 'delete_service');
add_action('wp_ajax_add_boklag_document', 'add_boklag_document');
add_action('wp_ajax_delete_boklag_document', 'delete_boklag_document');
add_action('wp_ajax_edit_boklag_document', 'edit_boklag_document');
add_action('wp_ajax_edit_boklag_service', 'edit_boklag_service');
add_action('wp_ajax_bl_update_comment', 'bl_update_comment');
add_action('wp_ajax_bl_delete_comment', 'bl_delete_comment');

function add_doc_to_service(){
    global $wpdb;
    if(isset($_POST['service'],$_POST['doc'])){
        $res = $wpdb->get_results($wpdb->prepare("
            SELECT COUNT(*) as count 
            FROM ".$wpdb->prefix."bl_services_relationship
            WHERE `service_id` = %d
            AND `document_id` = %d
            LIMIT 1
        ",array($_POST['service'],$_POST['doc'])));
        if(isset($res[0]->count) && $res[0]->count > 0)
            wp_die(wp_json_encode(array('message' => 'В даной услуге такой документ уже существует!','data'=> false)));

        $query = $wpdb->insert(
            $wpdb->prefix."bl_services_relationship",
            array(
                'service_id' => $_POST['service'],
                'document_id' => $_POST['doc']
            ),
            array(
                '%d',
                '%d'
            )
        );
        if($query){
            $result = $wpdb->get_results($wpdb->prepare("
            SELECT `r`.`service_id`,`d`.* 
            FROM ".$wpdb->prefix."bl_services_relationship as r
            LEFT JOIN ".$wpdb->prefix."bl_documents as d
            ON(`r`.`document_id` = `d`.`id`)
            WHERE `r`.`service_id` = %d            
        ",array($_POST['service'])));
            $docs = array();
            foreach ($result as $doc){
                $docs[$doc->id] = array(
                    'id' => $doc->id,
                    'serId' => $_POST['service'],
                    'title' => $doc->title,
                    'description' => $doc->description
                );
            }
            wp_die(wp_json_encode(array('message'=>'Документ успешно додан!','data' => $docs)));
        }
    }
    wp_die(wp_json_encode(array('message'=>'Что то пошло не так!','data' => false)));
}

function delete_doc_to_service(){
    global $wpdb;
    if(isset($_POST['service'],$_POST['doc'])){


        $query = $wpdb->delete(
            $wpdb->prefix."bl_services_relationship",
            array(
                'service_id' => $_POST['service'],
                'document_id' => $_POST['doc']
            ),
            array(
                '%d',
                '%d'
            )
        );
        if($query){
            $result = $wpdb->get_results($wpdb->prepare("
            SELECT `r`.`service_id`,`d`.* 
            FROM ".$wpdb->prefix."bl_services_relationship as r
            LEFT JOIN ".$wpdb->prefix."bl_documents as d
            ON(`r`.`document_id` = `d`.`id`)
            WHERE `r`.`service_id` = %d            
        ",array($_POST['service'])));
            $docs = array();
            foreach ($result as $doc){
                $docs[$doc->id] = array(
                    'id' => $doc->id,
                    'serId' => $_POST['service'],
                    'title' => $doc->title,
                    'description' => $doc->description
                );
            }
            wp_die(wp_json_encode(array('message'=>'Документ успешно удален!','data' => $docs)));
        }
    }
    wp_die(wp_json_encode(array('message'=>'Что то пошло не так!','data' => false)));
}

function add_service(){
    global $wpdb;
    if(isset($_POST['val']) && !empty(trim($_POST['val']))){
        $res = $wpdb->insert($wpdb->prefix."bl_services",array(
            'title' => $_POST['val'],
            'description' => ''
        ),array(
            '%s',
            '%s'
        ));
        if($res)
            wp_die(wp_json_encode(array('message' => 'Услуга успешно добавлена!','data' => array('id' => $wpdb->insert_id,'title' => $_POST['val']))));
    }
    wp_die(wp_json_encode(array('message' => 'Не удалось добавить услугу!','data' => false)));
}

function delete_service(){
    global $wpdb;
    if(isset($_POST['id'])){
        $wpdb->delete($wpdb->prefix."bl_services",array(
            'id' => $_POST['id']
        ),array('%d'));
        $wpdb->delete($wpdb->prefix."bl_services_relationship",array(
            'service_id' => $_POST['id']
        ),array('%d'));
        wp_die(wp_json_encode(array('message' => 'Услуга успешно удалена!','data' => 1)));
    }
    wp_die(wp_json_encode(array('message' => 'Не удалось удальть услугу!','data' => 0)));
}

function delete_boklag_document(){
    global $wpdb;
    if(isset($_POST['id'])){
        $wpdb->delete($wpdb->prefix."bl_documents",array(
            'id' => $_POST['id']
        ),array('%d'));
        $wpdb->delete($wpdb->prefix."bl_services_relationship",array(
            'document_id' => $_POST['id']
        ),array('%d'));
        wp_die(wp_json_encode(array('message' => 'Документ успешно удалена!','data' => 1)));
    }
    wp_die(wp_json_encode(array('message' => 'Не удалось удальть документ!','data' => 0)));
}

function add_boklag_document(){
    global $wpdb;
    if(isset($_POST['val']) && !empty(trim($_POST['val']))){
        $res = $wpdb->insert($wpdb->prefix."bl_documents",array(
            'title' => $_POST['val'],
            'description' => ''
        ),array(
            '%s',
            '%s'
        ));
        if($res)
            wp_die(wp_json_encode(array('message' => 'Документ успешно добавлена!','data' => array('id' => $wpdb->insert_id,'title' => $_POST['val']))));
    }
    wp_die(wp_json_encode(array('message' => 'Не удалось добавить документ!','data' => false)));
}

function edit_boklag_document(){
    global $wpdb;
    if(isset($_POST['id'])){
       $res = $wpdb->update($wpdb->prefix."bl_documents",array('title' => $_POST['val']),array('id' => $_POST['id']),array('%s'),array('%d'));
        if($res)
            wp_die(wp_json_encode(array('message' => 'Документ успешно редактирован!','data' => 1)));
    }
    wp_die(wp_json_encode(array('message' => 'Не удалось редактировать документ!','data' => false)));
}
function edit_boklag_service(){
    global $wpdb;
    if(isset($_POST['id'])){
        $res = $wpdb->update($wpdb->prefix."bl_services",array('title' => $_POST['val']),array('id' => $_POST['id']),array('%s'),array('%d'));
        if($res)
            wp_die(wp_json_encode(array('message' => 'Услуга успешно редактирована!','data' => 1)));
    }
    wp_die(wp_json_encode(array('message' => 'Не удалось редактировать услугу!','data' => false)));
}


function bl_update_comment(){
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && !empty(trim($_POST['text']))){
        $comment = BLComments::findOne($_POST['id']);
        if($comment instanceof BLComments){
            $comment->comment = trim($_POST['text']);
            if($comment->update()){
                wp_die(wp_json_encode(['success' => true,'message' => 'Коментар Успешно Обновлен!']));
            }
        }
    }
    wp_die(wp_json_encode(['success' => false,'message' => 'Коментар Не был Обновлен!']));
}

function bl_delete_comment(){
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])){
        $comment = BLComments::findOne($_POST['id']);
        if($comment instanceof BLComments){
            if($comment->delete()){
                wp_die(wp_json_encode(['success' => true,'message' => 'Коментар Успешно Удален!']));
            }
        }
    }
    wp_die(wp_json_encode(['success' => false,'message' => 'Коментар Не был Удален!']));
}