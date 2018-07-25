<?php
$order = BLOrder::findOne($_GET['id']);
if($order instanceof BLOrder):
$comments = BLComments::findByOrderId($order->id,true);
?>
<h3>Заказ #<?=$order->id?></h3>
<table>
    <tbody>
    <tr>
        <td>#</td>
        <td><?= $order->id ?></td>
    </tr>
    <tr>
        <td>Услуга:</td>
        <td><?= $order->title ?></td>
    </tr>
    <tr>
        <td>Описание:</td>
        <td><?= $order->description ?></td>
    </tr>
    <tr>
        <td>Статус:</td>
        <td><?= BLOrder::get_status($order->status) ?></td>
    </tr>
    <tr>
        <td>Цена:</td>
        <td><?= $order->price ?> грн.</td>
    </tr>
    <tr>
        <td>Адрес:</td>
        <td><?= $order->address ?></td>
    </tr>
    <tr>
        <td>Документи:</td>
        <td>
            <ul>
            <?php
                if($order->document){
                    $docs = unserialize($order->document);
                    if(is_array($docs)){
                        foreach ($docs as $i => $doc){ ?>
                            <li><a href="<?=wp_get_attachment_url($doc)?>">Документ <?=($i+1)?></a></li>
                        <?php }
                    }
                }
            ?>
            </ul>
        </td>
    </tr>
    <tr>
        <td>Тип:</td>
        <td><?= BLOrder::get_type($order->type) ?></td>
    </tr>
    <tr>
        <td>Дата окончание:</td>
        <td><?= date_i18n('d.m.Y',strtotime($order->date_end)) ?></td>
    </tr>
    <tr>
        <td>Дата Создание:</td>
        <td><?= date_i18n('d.m.Y H:i',strtotime($order->date_create)) ?></td>
    </tr>
    </tbody>
</table><br>
    <form method="post">
        <textarea name="comment" cols="40" rows="5" placeholder="Условия исполнения"></textarea><br>
        <button class="button">Добавить</button>
    </form>
    <h3>Коментарии</h3>
    <div class="main-content">
        <div class="archive-content">
            <div class="content-table" data-type="<?php echo BLOrder::TYPE_OPEN?>">
                <table class="wp-list-table widefat fixed striped posts">
                    <thead>
                    <tr>
                        <th>N</th>
                        <th>Имя</th>
                        <th>Коментар</th>
                        <th>Дата создание</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($comments) && sizeof($comments) > 0):?>
                        <?php foreach ($comments as $i => $comment): ?>
                        <tr class="order-info" data-id="<?php echo $order->id; ?>"  comment-id="<?=$comment->id?>">
                            <td><?php echo $i;?></td>
                            <td><?php echo $comment->display_name;?></td>
                            <td class="comment-text"><?php echo $comment->comment;?></td>
                            <td><?php echo date_i18n('d/m/Y H:i',strtotime($comment->create_date))?></td>
                            <td>
                                <button class="button button-primary edit-comment">Редактировать</button>
                                <button class="button button-danger delete-comment">Удалить</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php else: ?>
    <h4> Заказа с таким id не существует! </h4>
<?php endif; ?>