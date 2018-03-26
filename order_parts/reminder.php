<?php get_header('profile') ?>
<main class="main">
    <section class="page-title-section">
        <div class="container">
            <h1 class="section-title">Установить напоминание</h1>
        </div>
    </section>
    <section class="page-content-section">
        <div class="container-wide">
            <div class="page-content">
                <div class="side-menu">
                  <?php get_sidebar('profile')?>
                </div>
                <?php do_action('start_orders',BLOrder::TYPE_OPEN)?>
                <div class="main-content">
                    <div class="archive-content">
                        <div class="content-table reminder-table" data-type="<?php echo BLOrder::TYPE_OPEN?>">
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
                                    <tr data-order="<?php echo $order->id();?>">
                                        <td><?php echo $order->id();?></td>
                                        <td><?php echo $order->title;?></td>
                                        <td><?php echo BLOrder::get_status($order->status);?></td>
                                        <td><?php echo $order->street.' '.$order->house;?></td>
                                        <td><?php echo $order->date_end;?></td>
                                        <td <?=(key_exists($order->id(),$reminders)) ? "class='selected' data-reminder='".date('d/m/Y H:i',strtotime($reminders[$order->id()]->remind_time))."'" : ''?>>
                                            <?php echo get_reminder_bell(); ?>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="order-pagination"><?php echo BLOrder::pagination(1,null,BLOrder::TYPE_OPEN);?></div>
                </div>
                <?php do_action('end_orders')?>
            </div>
        </div>
    </section>
</main>
<?php get_footer('profile')?>