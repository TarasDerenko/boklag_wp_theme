<?php
$paged = isset($_GET['paged']) ? $_GET['paged'] : 1 ;

do_action('start_orders',null,null,$paged,20,false); global $bl_orders;?>
<style>
    .pagination span, .pagination a{
        display: block;
        border: 1px solid #000;
        float: left;
        padding: 3px 8px;
    }
</style>
<h3>Заказы</h3>
<div class="main-content">
    <div class="archive-content">
        <div class="content-table" data-type="<?php echo BLOrder::TYPE_OPEN?>">
            <table class="wp-list-table widefat fixed striped posts">
                <thead>
                <tr>
                    <th>N<br> договора</th>
                    <th>Вид работы</th>
                    <th>Стадии</th>
                    <th>Адрес объекта</th>
                    <th>Дата окончания<br> работ</th>
                    <th>Коментарии</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($bl_orders as $order): ?>
                    <tr class="order-info" data-id="<?php echo $order->id; ?>">
                        <td><?php echo $order->id;?></td>
                        <td><?php echo $order->title;?></td>
                        <td><?php echo BLOrder::get_status($order->status);?></td>
                        <td><?php echo $order->street.' '.$order->house;?></td>
                        <td><?php echo $order->date_end;?></td>
                        <td><?= count($order->comments) ;?></td>
                        <td><a href="/wp-admin/admin.php?page=boklag-orders&id=<?= $order->id ?>">Посмотреть</a></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="order-pagination"><?php echo BLOrder::pagination();?></div>
</div>
<?php do_action('end_orders')?>