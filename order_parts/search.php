<?php get_header('profile')?>
<main class="main">
    <section class="page-title-section">
        <div class="container">
            <h1 class="section-title">Поиск</h1>
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
                    <div class="archive-search">
                        <form>
                            <div class="archive-search-wrapper">
                                <input class="archive-search-input" type="text" name="sp" value="<?=isset($_GET['sp']) ? $_GET['sp'] : ''?>" placeholder="Введити номер, название или искомое слово...">
                                <button class="archive-search-button" type="submit"></button>
                            </div>
                        </form>
                    </div>
                    <div class="archive-content">
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
                                <?php foreach($bl_orders as $order): ?>
                                <tr class="order-info" data-id="<?php echo $order->id; ?>">
                                    <td><?php echo $order->id();?></td>
                                    <td><?php echo $order->title;?></td>
                                    <td><?php echo BLOrder::get_status($order->status);?></td>
                                    <td><?php echo $order->street.' '.$order->house;?></td>
                                    <td><?php echo $order->date_end;?></td>
                                </tr>
                                <tr class="order-info-extend">
                                    <?php get_template_part('order_parts/order','info');?>
                                </tr>
                                <?php endforeach; ?>
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