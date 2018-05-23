<?php

function services_document(){
    global $wpdb;
    $services = $wpdb->get_results("
        SELECT `s`.`id` as sId,`s`.`title` as sTitle,`s`.`description` as sDesc, `d`.`id` as dId,`d`.`title` as dTitle,`d`.`description` as dDesc 
        FROM ".$wpdb->prefix."bl_services as s
        LEFT JOIN ".$wpdb->prefix."bl_services_relationship as r
        ON (`s`.`id`= `r`.`service_id`)
        LEFT JOIN ".$wpdb->prefix."bl_documents as d
        ON (`r`.`document_id` = `d`.`id`)
        ORDER BY `s`.`id`
    ");
    $documents = $wpdb->get_results("
        SELECT *
        FROM ".$wpdb->prefix."bl_documents
    ");
   // debug($documents);
    $rows = array();
    foreach ($services as $service){
        $rows[$service->sId]['id'] = $service->sId;
        $rows[$service->sId]['title'] = $service->sTitle;
        $rows[$service->sId]['description'] = $service->sDesc;
        $rows[$service->sId]['documents'][$service->dId]['id'] = $service->dId;
        $rows[$service->sId]['documents'][$service->dId]['serId'] = $service->sId;
        $rows[$service->sId]['documents'][$service->dId]['title'] = $service->dTitle;
        $rows[$service->sId]['documents'][$service->dId]['description'] = $service->dDesc;
    }
    ?>
    <div>
        <ol class="table-service service-content">
            <?php foreach ($rows as $k => $row):?>
            <li class="service-info service-info-<?= $k ?>" data-id="<?= $k ?>"  data-content='<?=(isset($row['documents']) && is_array($row['documents'])) ? json_encode($row['documents'],JSON_HEX_APOS | JSON_HEX_QUOT) : ""?>'>
                <div class="service-title"><?= $row['title'] ?></div>
                <ul>
                    <li class="doc-info" id="info-<?=$k?>">
                        <table>
                        </table>
                        <button class="add-doc btn" data-id="<?=$k?>">Добавить Документ</button>
                        <button class="edit-service btn" data-id="<?=$k?>">Редактировать Услугу</button>
                        <button class="delete-service btn" data-id="<?=$k?>">Удалить Услугу</button>
                    </li>
                </ul>
            </li>
            <?php endforeach;?>
        </ol>
        <input type="text" id="service-title">
        <button id="add-service">Добавить Услугу</button>
    </div>
    <div class="popup-docs" data-service="0">
        <span class="hide-popup">Закрить</span>
        <?php if(is_array($documents)): ?>
            <ol>
            <?php foreach ($documents as $document):?>
                <li class="document-single" data-id="<?= $document->id ?>"><?= $document->title ?></li>
            <?php endforeach;?>
            </ol>
        <?php endif; ?>
    </div>
<?php
}

add_action('admin_head','services_style');
function services_style(){ ?>
    <style>
        .table-service{
            width:100%;
            max-width: 950px;
            text-align: left;
        }
        .table-service .doc-info table{
            padding-left: 30px;
        }
        .table-service .doc-info table tr > td:first-child{
            padding: 7px;
            border-color: transparent;
        }
        .table-service .doc-info table tr:nth-child(2n){
            background: #fff;
        }
        .table-service .doc-info table tr:nth-child(2n+1){
            background: #abc8ff;
        }
        .doc-info{
            display: none;
        }
        .doc-info.active{
            display: block;
        }
        .service-info{
            cursor: pointer;
        }
        .service-info > td:first-child, .doc-info > td:first-child{
            width: 40px;
        }
        .service-info .number{
            float: left;
            margin-right: 25px;
        }
        .popup-docs{
            position: fixed;
            top: 45px;
            left: 0;
            right: 0;
            width: 100%;
            max-width: 700px;
            margin: 0 auto;
            max-height: 80vh;
            overflow-y: auto;
            background: #d6f3cd;
            padding: 15px;
            border-radius: 25px;
            box-shadow: 15px 15px 50px #000;
            visibility: hidden;
            opacity: 0;
            transform: translateY(-100%);
            transition: visibility .3s,opacity .3s, transform .3s;
        }
        .popup-docs.active{
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .popup-docs li{
            cursor: pointer;
        }
        .hide-popup{
            position: absolute;
            top: 5px;
            right: 5px;
            display: block;
            cursor: pointer;
            color: red;
        }
        .btn{
            margin-left: 30px;
            margin-top: 5px;
            padding: 5px 10px;
            background: none;
            border-radius: 15px;
            outline: none;
            cursor: pointer;
        }
        .delete-service{
            color: #fff;
            background: firebrick;
        }
        .edit-service{
            color: #fff;
            background: #3aad60;
        }
        .add-doc{
            background: #00a0d2;
            color: #fff;
        }
        .delete-documents{
            color: firebrick;
            cursor: pointer;
        }
        .edit-documents{
            cursor: pointer;
            color: #00a0d2;
            margin-right: 25px;
        }
    </style>
<?php }