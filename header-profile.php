<?php do_action('is_boklag_user_login')?>
<?php global $boklag_user_meta,$boklag_user,$biklag_user_avatar; ?>
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
                <li><a href="#" class="personal-dropdown-button personal-navigation-info"></a></li>
                <li><a href="#wallet" class="personal-dropdown-button personal-navigation-wallet"></a></li>
                <li><a href="#" class="personal-dropdown-button personal-navigation-question"></a></li>
                <li><a href="#" class="personal-dropdown-button personal-navigation-notification"><span class="notification-count">1</span></a></li>
                <li><a href="#" class="personal-dropdown-button personal-navigation-avatar">
                    <img src="<?php echo $biklag_user_avatar?>" alt="">
                </a></li>
            </ul>
            <div class="personal-dropdown-menu notification-dropdown">
                <div class="notification-dropdown-item">
                    <div class="notification-dropdown-image">
                        <img src="<?php bloginfo('template_url')?>/img/notification-image.jpg" alt="">
                        <div class="notification-dropdown-bell"></div>
                    </div>
                    <div class="notification-dropdown-info">
                        <h3 class="notification-dropdown-title">
                            <a href="#">Lorem ipsum dolor sit</a>
                        </h3>
                        <div class="notification-dropdown-text">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do... 
                        </div>
                        <div class="notification-dropdown-footer">
                            <a href="#" class="notification-dropdown-link">перейти к лоту</a>
                            <span class="notification-dropdown-date">01.01.2018</span>
                        </div>
                    </div>
                    <button class="notification-dropdown-close">&times;</button>
                </div>
                <div class="notification-dropdown-item">
                    <div class="notification-dropdown-image">
                        <img src="<?php bloginfo('template_url')?>/img/notification-image.jpg" alt="">
                    </div>
                    <div class="notification-dropdown-info">
                        <h3 class="notification-dropdown-title">
                            <a href="#">Lorem ipsum dolor sit</a>
                        </h3>
                        <div class="notification-dropdown-text">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do... 
                        </div>
                        <div class="notification-dropdown-footer">
                            <span class="notification-dropdown-date">01.01.2018</span>
                        </div>
                    </div>
                    <button class="notification-dropdown-close">&times;</button>
                </div>
                <a href="#" class="notification-dropdown-archive"></a>
            </div>
            <div class="personal-dropdown-menu avatar-dropdown">
                <div class="avatar-dropdown-content">
                    <div class="avatar-dropdown-image">
                        <img src="<?php echo $biklag_user_avatar ?>" alt="">
                        <a href="#" class="avatar-dropdown-edit"></a>
                    </div>
                    <div class="avatar-dropdown-info">
                        <h3 class="avatar-dropdown-title"><?php echo $boklag_user->display_name; ?></h3>
                        <span class="avatar-dropdown-status">Заказчик</span>
                        <br>
                        <span class="avatar-dropdown-status"><a href="/?logout">Выйти</a></span>

                    </div>
                    <a href="/kabinet" class="avatar-dropdown-settings"></a>
                </div>
            </div>
        </nav>
    </header>