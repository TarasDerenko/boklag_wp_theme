<?php
get_header('profile')?>
<main class="main">
    <section class="page-title-section">
        <div class="container">
            <h1 class="section-title">Фильтр</h1>
        </div>
    </section>
    <section class="page-content-section">
        <div class="container-wide">
            <div class="page-content">
                <div class="side-menu">
                    <?php get_sidebar('profile')?>
                </div>
                <?php do_action('start_orders_filter')?>
                <div class="main-content">
                    <div class="archive-filter">
                        <form>
                            <div class="filter-columns">
                                <div class="filter-column-2">
                                    <div class="filter-row">
                                        <label class="filter-label" for="title_order">Вид услуги</label>
                                        <input type="text" class="filter-field" name="title" value="<?= (isset($_GET['title'])) ? $_GET['title'] : '' ?>" id="title_order">
                                    </div>
                                    <div class="filter-row">
                                        <label class="filter-label" for="" name="address">Адрес</label>
                                        <select class="filter-select">
                                            <option value=""></option>
                                            <option value="">м.Запорожье ул. Леваневского, 4</option>
                                            <option value="">м.Запорожье ул. Леваневского, 4</option>
                                            <option value="">м.Запорожье ул. Леваневского, 4</option>
                                        </select>
                                    </div>
                                    <div class="filter-row">
                                        <label class="filter-label" for="">Цена</label>
                                        <div class="filter-range">
                                            <div class="filter-range-column">
                                                <label class="filter-label" for="">от</label>
                                                <input class="filter-field" name="min-price" type="text" value="<?= (isset($_GET['min-price'])) ? $_GET['min-price'] : ''?>">
                                            </div>
                                            <div class="filter-range-column">
                                                <label class="filter-label" for="">до</label>
                                                <input class="filter-field" name="max-price" type="text" value="<?= isset($_GET['max-price']) ? $_GET['max-price'] : '' ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-column-2">
                                    <div class="filter-row">
                                        <label class="filter-label" for="">Стадия выполнения</label>
                                        <select class="filter-select" name="status-work">
                                            <option value=""></option>
                                            <option value="<?= BLOrder::STATUS_WAIT ?>" <?php if(isset($_GET['status-work'])) selected($_GET['status-work'],BLOrder::STATUS_WAIT) ?>><?= BLOrder::get_status(BLOrder::STATUS_WAIT)?></option>
                                            <option value="<?= BLOrder::STATUS_IN_WORK ?>" <?php if(isset($_GET['status-work'])) selected($_GET['status-work'],BLOrder::STATUS_IN_WORK) ?>><?= BLOrder::get_status(BLOrder::STATUS_IN_WORK)?></option>
                                            <option value="<?= BLOrder::STATUS_DONE ?>" <?php if(isset($_GET['status-work'])) selected($_GET['status-work'],BLOrder::STATUS_DONE) ?>><?= BLOrder::get_status(BLOrder::STATUS_DONE)?></option>
                                        </select>
                                    </div>
                                    <div class="filter-row">
                                        <label class="filter-label" for="">Срок выполнения услуги:</label>
                                        <input class="filter-field" name="date-end" value="<?=(isset($_GET['date-end'])) ? $_GET['date-end'] : ''?>" type="text" id="order-date-end" placeholder="дд/мм/гггг">
                                    </div>
                                </div>
                            </div>
                            <div class="filter-row-wide">
                                <label class="custom-checkbox">
                                    <span class="custom-checkbox-text">Договоры из архива</span>
                                    <input type="checkbox" name="type[]" value="<?=BLOrder::TYPE_ARCHIVE?>" <?=(isset($_GET['type']) && in_array(BLOrder::TYPE_ARCHIVE,$_GET['type'])) ? 'checked="checked"': ''?>>
                                    <div class="custom-checkbox-image2"></div>
                                </label>
                                <label class="custom-checkbox">
                                    <span class="custom-checkbox-text">Черновики</span>
                                    <input type="checkbox" name="type[]" value="<?=BLOrder::TYPE_DRAFT?>" <?=(isset($_GET['type']) && in_array(BLOrder::TYPE_DRAFT,$_GET['type'])) ? 'checked="checked"': ''?>>
                                    <div class="custom-checkbox-image2"></div>
                                </label>
                                <label class="custom-checkbox">
                                    <span class="custom-checkbox-text">Помеченные договоры</span>
                                    <input type="checkbox"  name="mark" value="<?=BLOrder::TYPE_MARK?>" <?=(isset($_GET['mark'])) ? 'checked="checked"': ''?>>
                                    <div class="custom-checkbox-image2"></div>
                                </label>
                            </div>
                            <button type="submit" name="filter" value="order" class="button button-invert"><span>Применить фильтр</span></button>
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