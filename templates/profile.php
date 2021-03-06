<?php
/* Template Name: Profile */
?>
<?php get_header('profile'); ?>
<main class="main">
    <section class="personal-content-section">
        <h1 class="section-title">Личный кабинет</h1>
        <?php if(isset($_GET['edit']) && $_GET['edit'] == 'true' && $_SERVER['REQUEST_METHOD'] != 'POST'): ?>
            <div class="edit-blok-info">
                <p>
                    Изменения прошли успешно!
                </p>
            </div>
        <?php elseif(isset($error_message['pass'])): ?>
            <div class="edit-blok-info bg-danger">
                <p>
                    <?= $error_message['pass'] ?>
                </p>
            </div>
        <?php endif;?>
        <div class="personal-content-wrapper">
            <form method="post" enctype="multipart/form-data">
                <div class="personal-content">
                    <div class="personal-content-photo">
                        <div class="personal-photo">
                            <img src="<?php echo $boklag_user_avatar; ?>" alt="">
                        </div>
                        <div class="personal-photo-buttons">
                            <label class="button-reload">
                                <input class="button-reload" type="file" name="user_image" accept="image/*">
                            </label>
                            <input type="hidden" name="delete-avatar">
                            <button class="button-delete" type="button" data-avatar="<?php echo get_bl_user_data($boklag_user_meta,'user_avatar')?>"></button>
                            <button type="submit" id="save-avatar" name="save-avatar" value="save"></button>
                        </div>
                    </div>
                    <div class="personal-content-info">
                        <h1 class="personal-name"><?php echo $boklag_user->display_name; ?></h1>
                        <div class="personal-form-row">
                            <label for="">Предприятие:</label>
                            <div class="personal-input-wrapper">
                                <input type="text" value="<?php echo get_bl_user_data($boklag_user_meta,'user_factory')?>" name="user_factory">
                                <div class="personal-complete"></div>
                            </div>
                        </div>
                        <div class="personal-form-row">
                            <label for="">Имя и Фамилия</label>
                            <div class="personal-input-wrapper">
                                <input type="text" value="<?php echo $boklag_user->display_name; ?>" name="display_name">
                                <div class="personal-complete"></div>
                            </div>
                        </div>
                        <div class="personal-form-row">
                            <div class="personal-input-wrapper">
                                <a class="change-password-button button"><span>Сменить Пароль</span></a>
                            </div>
                        </div>
                        <div class="change-password-block">
                            <?php if(!isset($boklag_user_meta['google_account'])):?>
                            <div class="personal-form-row">
                                <label for="">Пароль:</label>
                                <div class="personal-input-wrapper">
                                    <input type="password" placeholder="***********" name="user_pass">
                                    <div class="personal-complete"></div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="personal-form-row">
                                <label for="">Новый Пароль:</label>
                                <div class="personal-input-wrapper user-pwd">
                                    <input type="password" placeholder="***********" name="user_new_pass">
                                    <div class="personal-complete"></div>
                                </div>
                            </div>
                            <div class="personal-form-row">
                                <label for="">Повторить:</label>
                                <div class="personal-input-wrapper user-pwd">
                                    <input type="password" placeholder="***********" name="user_new_cop_pass">
                                    <div class="personal-complete"></div>
                                </div>
                            </div>
                            <button class="change-password-button button" name="change-pass" value="change">
                                <span>Сменить</span>
                            </button>
                        </div>
                        <div class="personal-text">
                            Информация, которую будут видеть другие пользователи просматривая ваш профиль
                        </div>
                        <div class="personal-text-bordered">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        </div>
                        <div class="personal-connect">
                            <div class="personal-connect-column">
                                <div class="personal-connect-row">
                                    <label for="">Телефон:</label>
                                    <div class="personal-input-wrapper">
                                        <input type="tel" placeholder="380" value="<?php echo get_bl_user_data($boklag_user_meta,'user_tel')?>" name="user_tel">
                                        <div class="personal-complete <?=!empty(get_bl_user_data($boklag_user_meta,'user_tel'))  ? 'active' : ''?>"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="personal-connect-column">
                                <div class="personal-connect-row">
                                    <label for="">E-mail:</label>
                                    <div class="personal-input-wrapper">
                                        <input type="email" value="<?=isset($_POST['user_email']) ? $_POST['user_email'] : $boklag_user->user_email; ?>" name="user_email">
                                        <div class="personal-complete <?=(filter_var($boklag_user->user_email, FILTER_VALIDATE_EMAIL))  ? 'active' : ''?>"></div>
                                        <div class="text-error">
                                            <?=isset($error_message['email']) ? $error_message['email'] : ''?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="personal-social">
                            <div class="personal-social-column">
                                <h3 class="personal-social-title">Месенджеры</h3>
                                <div class="personal-social-row">
                                    <label for="" class="skype"></label>
                                    <div class="personal-input-wrapper">
                                        <input type="text" placeholder="Tanya123" value="<?php echo get_bl_user_data($boklag_user_meta,'user_messenger')?>" name="user_messenger">
                                        <div class="personal-complete"></div>
                                    </div>
                                </div>
                                <div class="personal-social-row">
                                    <label for="" class="viber"></label>
                                    <div class="personal-input-wrapper">
                                        <input type="text" placeholder="Введите свой логин" value="<?php echo get_bl_user_data($boklag_user_meta,'user_viber')?>" name="user_viber">
                                        <div class="personal-complete"></div>
                                    </div>
                                </div>
                                <div class="personal-social-row">
                                    <label for="" class="whatsapp"></label>
                                    <div class="personal-input-wrapper">
                                        <input type="text" placeholder="Tanya123" value="<?php echo get_bl_user_data($boklag_user_meta,'user_whatsapp')?>" name="user_whatsapp">
                                        <div class="personal-complete"></div>
                                    </div>
                                </div>
                                <div class="personal-social-row">
                                    <label for="" class="viber"></label>
                                    <div class="personal-input-wrapper">
                                        <input type="text" placeholder="Введите свой логин">
                                        <div class="personal-complete"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="personal-social-column">
                                <h3 class="personal-social-title">Соц сети</h3>
                                <div class="personal-social-row">
                                    <label for="" class="facebook"></label>
                                    <div class="personal-input-wrapper">
                                        <input type="text" placeholder="Tanya123" value="<?php echo get_bl_user_data($boklag_user_meta,'user_facebook')?>" name="user_facebook">
                                        <div class="personal-complete"></div>
                                    </div>
                                </div>
                                <div class="personal-social-row">
                                    <label for="" class="instagram"></label>
                                    <div class="personal-input-wrapper">
                                        <input type="text" placeholder="Введите свой логин" value="<?php echo get_bl_user_data($boklag_user_meta,'user_instagram')?>" name="user_instagram">
                                        <div class="personal-complete"></div>
                                    </div>
                                </div>
                                <div class="personal-social-row">
                                    <label for="" class="vkontakte"></label>
                                    <div class="personal-input-wrapper">
                                        <input type="text" placeholder="Tanya123" value="<?php echo get_bl_user_data($boklag_user_meta,'user_vkontakte')?>" name="user_vkontakte">
                                        <div class="personal-complete"></div>
                                    </div>
                                </div>
                                <div class="personal-social-row">
                                    <label for="" class="pinterest"></label>
                                    <div class="personal-input-wrapper">
                                        <input type="text" placeholder="Введите свой логин" value="<?php echo get_bl_user_data($boklag_user_meta,'user_pinterest')?>" name="user_pinterest">
                                        <div class="personal-complete"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="button" name="edit-profile" value="edit"><span>Изменить</span></button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>
<?php get_footer('profile')?>