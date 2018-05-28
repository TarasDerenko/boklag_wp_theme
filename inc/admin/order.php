<?php
$order = BLOrder::findOne($_GET['id']);
if($order instanceof BLOrder):
$comments = BLComments::findByOrderId($_GET['id']);
$perfomers = BLPerfomers::find();
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
</table>
    <form method="post">
        <select name="code" id="" placeholder="Исполнитель">
            <option value="0">---</option>
            <?php foreach ($perfomers as $perfomer):?>
                <option value="<?=$perfomer->id?>"><?=$perfomer->name?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <input type="text" placeholder="Цена" name="price"><br>
        <textarea name="comment" cols="40" rows="5" placeholder="Условия исполнения"></textarea><br>
        <button>Добавить</button>
    </form>
<div class="comments">
    <ul>

    </ul>
</div>
<?php else: ?>
    <h4> Заказа с таким id не существует! </h4>
<?php endif; ?>