<?php get_header('profile');
$marks = BLOrder::get_mark();
?>
<main class="main">
    <section class="page-title-section">
        <div class="container">
            <h1 class="section-title">Пометить заказ</h1>
        </div>
    </section>
    <section class="page-content-section">
        <div class="container-wide">
            <div class="page-content">
                <div class="side-menu">
                  <?php get_sidebar('profile')?>
                </div>
                <?php do_action('start_orders')?>
                <div class="main-content">
                    <div class="archive-content">
                        <div class="content-table reminder-table">
                            <table>
                                <thead>
                                <tr>
                                    <th>N<br> договора</th>
                                    <th>Вид работы</th>
                                    <th>Стадии</th>
                                    <th>Адрес объекта</th>
                                    <th>Дата окончания<br> работ</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($bl_orders as $order): ?>
                                <tr>
                                    <td><?php echo $order->id;?></td>
                                    <td><?php echo $order->title;?></td>
                                    <td><?php echo BLOrder::get_status($order->status);?></td>
                                    <td><?php echo $order->street.' '.$order->house;?></td>
                                    <td><?php echo $order->date_end;?></td>
                                    <td>
                                        <div class="mark-area">
                                            <button class="mark-button">
                                                <span class="mark-color <?= $marks[$order->mark] ?>"></span>
                                            </button>
                                            <div class="mark-set" data-id="<?= $order->id ?>">
                                                <?php foreach ($marks as $key => $mark):
                                                if($order->mark == $key)
                                                    continue;
                                                 ?>
                                                <span class="mark-set-color <?= $mark ?>" data-color="<?= $mark ?>" data-mark="<?= $key ?>"></span>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="order-pagination" data-page="mark"><?php echo BLOrder::pagination();?></div>
                </div>
                <?php do_action('end_orders')?>
            </div>
        </div>
    </section>
</main>
<?php get_footer('profile')?>