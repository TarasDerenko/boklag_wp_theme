  <div class="location active">
        <form>
            <div class="location-wrapper">
                <div class="location-current">
                    <div class="location-current-text">Вы из г. Винница?</div>
                    <label class="location-current-option">
                        Да
                        <input type="radio" name="location-current">
                    </label>
                    <label class="location-current-option">
                        Нет
                        <input type="radio" name="location-current">
                    </label>
                </div>
                <div class="location-another">
                    <label for="">Выбрать другой город:</label>
                    <div class="location-another-select">
                        <select>
                            <option value="">г. Киев</option>
                            <option value="">г. Львов</option>
                            <option value="">г. Днепропетровск</option>
                        </select>
                    </div>
                </div>
                <button type="button" class="location-close">&times;</button>
            </div>
        </form>
    </div>
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
                        'menu' => 'top-menu',
                        'container' => false,
                        'menu_class' => 'header-menu-list'
                    ));
                ?>
            </div>
        </nav>
    </header>