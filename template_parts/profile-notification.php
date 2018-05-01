<?php global $notifications; ?>
<?php foreach ($notifications as $notification):?>
<div class="notification-dropdown-item">
    <div class="notification-dropdown-image">
        <img src="<?php bloginfo('template_url')?>/img/notification-image.jpg" alt="">
        <?php if(isset($notification['type']) && $notification['type'] == "reminder"):?>
            <div class="notification-dropdown-bell"></div>
        <?php endif;?>
    </div>
    <div class="notification-dropdown-info">
        <h3 class="notification-dropdown-title">
            <a href="#"><?=(isset($notification['title'])) ? $notification['title'] : '' ?></a>
        </h3>
        <div class="notification-dropdown-text">
            <?=(isset($notification['description'])) ? wp_trim_words($notification['description'],8,'...') : '' ?>
        </div>
        <div class="notification-dropdown-footer">
            <a href="#" class="notification-dropdown-link">перейти к лоту</a>
            <span class="notification-dropdown-date"> <?=(isset($notification['date_end'])) ? date('d.m.Y',strtotime($notification['date_end'])) : '' ?></span>
        </div>
    </div>
    <button class="notification-dropdown-close" data-type="<?=$notification['type']?>" data-notification="<?=$notification['id']?>">&times;</button>
</div>
<?php endforeach;?>
<a href="#" class="notification-dropdown-archive"></a>