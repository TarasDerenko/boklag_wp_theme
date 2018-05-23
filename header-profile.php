<?php do_action('is_boklag_user_login')?>
<?php global $boklag_user_meta,$boklag_user,$boklag_user_avatar,$notifications,$notification_count; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php wp_title() ?></title>
    <link rel="icon" type="image/png" href="<?php bloginfo('template_url')?>/img/favicon.png">
    <?php wp_head();?>
</head>
<body <?php body_class("inner-page personal") ?>>
<?php
 get_template_part('template_parts/location','selector');
?>
    <header class="header">
        <a href="/" class="header-logo"><img src="<?php bloginfo('template_url')?>/img/logo.png" alt="ФЛП Боклаг" width="263" height="79"></a>
        <nav class="personal-navigation">
            <ul class="personal-navigation-list">
                <li><a href="/orders/" class="personal-dropdown-button personal-navigation-info"></a></li>
                <li><a href="#wallet" class="personal-dropdown-button personal-navigation-wallet"></a></li>
                <li><a href="/sovety-i-otvety/" class="personal-dropdown-button personal-navigation-question"></a></li>
                <li>
                    <a href="#" class="personal-dropdown-button personal-navigation-notification">
                    <?php if(is_int($notification_count) && $notification_count > 0):?>
                        <span class="notification-count"><?=$notification_count?></span>
                    <?php endif;?>
                    </a>
                </li>
                <li><a href="#" class="personal-dropdown-button personal-navigation-avatar">
                    <img src="<?php echo $boklag_user_avatar?>" alt="">
                </a></li>
            </ul>
            <div class="personal-dropdown-menu notification-dropdown">
                <?php do_action('get_template_notification',true);?>
            </div>
            <div class="personal-dropdown-menu avatar-dropdown">
                <div class="avatar-dropdown-content">
                    <div class="avatar-dropdown-image">
                        <img src="<?php echo $boklag_user_avatar ?>" alt="">
                        <a href="/kabinet/" class="avatar-dropdown-edit"></a>
                    </div>
                    <div class="avatar-dropdown-info">
                        <h3 class="avatar-dropdown-title"><?php echo $boklag_user->display_name; ?></h3>
                        <span class="avatar-dropdown-status">Заказчик</span>
                        <br>
                        <span class="avatar-dropdown-status"><a href="/?logout">Выйти</a></span>

                    </div>
                    <a href="/kabinet/" class="avatar-dropdown-settings"></a>
                </div>
            </div>
        </nav>
    </header>