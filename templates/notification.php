<?php
/* Template Name: Notification */
?>
<?php get_header('profile');?>
<main class="main">
    <section class="page-title-section">
        <div class="container">
            <h1 class="section-title">Уведомление</h1>
        </div>
    </section>
    <section class="page-content-section">
        <div class="container-wide">
            <div class="page-content">
                <?php do_action('bl_start_notification')?>
                <div class="main-content">
                    <div class="archive-content content-table">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>N</th>
                                <th>Уведомление</th>
                                <th>Дата</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                        <?php if(isset($bl_notifications) && is_array($bl_notifications)):?>
                            <?php foreach ($bl_notifications as $i => $bl_notification):?>
                                <tr>
                                    <td><?= $i + 1; ?></td>
                                    <td><?= $bl_notification->description ?></td>
                                    <td><?= date('d/m/Y H:i',strtotime($bl_notification->date)) ?></td>
                                    <td><a href="/<?=$wp->request?>?id=<?=$bl_notification->id?>"> Посмотреть</a></td>
                                </tr>
                            <?php endforeach;?>
                        <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="order-pagination"><?php //echo BLOrder::pagination();?></div>
                </div>
                <?php do_action('bl_end_notification')?>
            </div>
        </div>
    </section>
</main>
<?php get_footer('profile')?>
