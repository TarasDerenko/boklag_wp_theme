<?php get_header('profile')?>
<main class="main">
    <section class="page-title-section">
        <div class="container">
            <h1 class="section-title">Удалить заказ</h1>
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
                        <form>
                            <div class="content-table delete-table">
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
                                            <td><?php echo $order->id();?></td>
                                            <td><?php echo $order->title;?></td>
                                            <td><?php echo $order->status;?></td>
                                            <td><?php echo $order->address;?></td>
                                            <td><?php echo $order->date_end;?></td>
                                            <td>
                                                <label class="custom-checkbox">
                                                    <input type="checkbox" value="<?php echo $order->id();?>">
                                                    <div class="custom-checkbox-image2"></div>
                                                </label>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="content-table-buttons">
                                <button class="button button-invert button-blue"><span>Поместить в архив</span></button>
                                <button class="button button-invert"><span>Удалить</span></button>
                            </div>
                        </form>
                    </div>
                    <div class="order-pagination"><?php echo BLOrder::pagination();?></div>
                </div>
                <?php do_action('end_orders')?>
            </div>
        </div>
    </section>
</main>
<?php get_footer('profile')?>