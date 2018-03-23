<?php
global $bl_orders,$order;
?>
<div class="content-table">
    <table>
        <thead>
            <tr>
                <th>N<br> договора</th>
                <th>Вид работы</th>
                <th>Стадии</th>
                <th>Адрес объекта</th>
                <th>Дата окончания<br> работ</th>
            </tr>
        </thead>
        <tbody>
        <?php if(is_array($bl_orders)): foreach ($bl_orders as $order):?>
        <tr class="order-info">
            <td><?php echo $order->id();?></td>
            <td><?php echo $order->title;?></td>
            <td><?php echo BLOrder::get_status($order->status);?></td>
            <td><?php echo $order->address;?></td>
            <td><?php echo $order->date_end;?></td>
        </tr>
        <tr class="order-info-extend">
            <?php get_template_part('order_parts/order','info');?>
        </tr>
        <?php endforeach; endif;?>
        </tbody>
    </table>
</div>