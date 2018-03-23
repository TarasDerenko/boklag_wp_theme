<?php get_header('profile')?>
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
                                    <td>1211</td>
                                    <td>ТД по установлению границ участка в натуре</td>
                                    <td>выполнено</td>
                                    <td>м.Запорожье ул. Леваневского, 4</td>
                                    <td>12.01.2017</td>
                                    <td>
                                        <div class="mark-area">
                                            <button class="mark-button">
                                                <span class="mark-color white"></span>
                                            </button>
                                            <div class="mark-set">
                                                <span class="mark-set-color orange" data-color="orange" data-mark="<?= BLOrder::MARK_ORANGE ?>"></span>
                                                <span class="mark-set-color yellow" data-color="yellow" data-mark="<?= BLOrder::MARK_YELLOW ?>"></span>
                                                <span class="mark-set-color red" data-color="red" data-mark="<?= BLOrder::MARK_RED ?>"></span>
                                                <span class="mark-set-color green" data-color="green" data-mark="<?= BLOrder::MARK_GREEN ?>"></span>
                                                <span class="mark-set-color purple" data-color="purple" data-mark="<?= BLOrder::MARK_PURPLE ?>"></span>
                                                <span class="mark-set-color blue" data-color="blue" data-mark="<?= BLOrder::MARK_BLUE ?>"></span>
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