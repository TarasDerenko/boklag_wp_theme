<?php

function boklags_documents(){
    global $wpdb;
    $documents = $wpdb->get_results("
        SELECT *
        FROM ".$wpdb->prefix."bl_documents
    ");
    ?>
    <div>
        <ol class="table-service">
            <?php if(is_array($documents)): ?>
                <?php foreach ($documents as $document):?>
                        <li class="doc-single" data-id="<?= $document->id ?>">
                            <div class="doc-name"><?= $document->title ?></div> <div class="doc-action"><span class="edit-documents">Редактировать</span> <span class="delete-documents">Удалить</span></div>
                        </li>
                <?php endforeach;?>
            <?php endif; ?>
        </ol>
        <input type="text" id="service-title">
        <button id="add-document">Добавить Документ</button>
    </div>
    <?php
}