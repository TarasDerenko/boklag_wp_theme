<?php
get_template_part('template_parts/location','selector');
?>
    <header class="header">
        <a href="/" class="header-logo"><img src="<?php bloginfo('template_url')?>/img/logo.png" alt="ФЛП Боклаг" width="263" height="79"></a>
        <nav class="header-navigation">
           <?php if(is_user_logged_in()): ?>
                <a href="/kabinet" class="header-login">Личный кабинет</a>
            <?php else: ?>
                <a href="#login" class="header-login">Войти</a>
            <?php endif; ?>
            <button class="header-hamburger">
                <span class="header-hamburger-line"></span>
                <span class="header-hamburger-line"></span>
                <span class="header-hamburger-line"></span>
            </button>
            <div class="header-menu">
                  <?php
                    wp_nav_menu(array(
                        'menu' => 'theme_location',
                        'container' => false,
                        'menu_class' => 'header-menu-list'
                    ));
                ?>
            </div>
        </nav>
    </header>