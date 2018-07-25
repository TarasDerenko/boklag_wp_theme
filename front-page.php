<?php get_header(); ?>
    <main class="main">
        <?php if(have_posts()):the_post();?>
        <section class="showcase">
            <div class="showcase-cover"></div>
            <div class="container">
                <div class="showcase-content">
                    <h1 class="showcase-title"><?php the_field('top_content')?></h1>
                    <a href="<?php the_field('top_button_url',$post)?>" class="button"><span><?php the_field('tom_button_text',$post)?></span></a>
                </div>
            </div>
        </section>
        <section class="procedure">
            <div class="procedure-container">
                <h2 class="section-title">Процедура оформления</h2>
                <div class="procedure-items">
                    <div class="procedure-item">
                        <div class="procedure-icon procedure-icon1">
                            <span class="procedure-number">1</span>
                        </div>
                        <span class="procedure-title">Зарегистрируйся</span>
                    </div>
                    <div class="procedure-item">
                        <div class="procedure-icon procedure-icon2">
                            <span class="procedure-number">2</span>
                        </div>
                        <span class="procedure-title">Создай свой заказ</span>
                    </div>
                    <div class="procedure-item">
                        <div class="procedure-icon procedure-icon3">
                            <span class="procedure-number">3</span>
                        </div>
                        <span class="procedure-title">Оплати услугу</span>
                    </div>
                    <div class="procedure-item">
                        <div class="procedure-icon procedure-icon4">
                            <span class="procedure-number">4</span>
                        </div>
                        <span class="procedure-title">Получи готовый Результат</span>
                    </div>
                </div>
            </div> 
        </section>
        <section class="video video-how">
            <div class="video-cover">
                <div class="video-cover-content">
                    <button class="video-play"></button>
                    <h2 class="section-title">Как это работает</h2>
                </div>
            </div>
            <video class="video-track" src="<?php the_field('how_this_work_video')?>" controls></video>
        </section>
        <section class="order-service">
            <div class="container">
                <h2 class="section-title left-decor"><?php the_field('service_title')?></h2>
                <a href="<?php the_field('service_buttom_url')?>" class="button"><span><?php the_field('service_buttom_text')?></span></a>
            </div>
        </section>
        <section class="features">
            <div class="features-item">
                <div class="feature-item-text">
                    <span>Мы продаем не услугу а </span>
                    <span>более ценное -</span>
                </div>
            </div>
            <div class="features-item">
                <div class="feature-item-text">
                    <span>Время</span>
                </div>
            </div>
            <div class="features-item">
                <div class="feature-item-text">
                    <span>коротое вы можете </span>
                    <span>потратить на</span>
                </div>
            </div>
            <div class="features-item">
                <div class="feature-item-text">
                    <span>удовольствие</span>
                </div>
            </div>
            <div class="features-item">
                <div class="feature-item-text">
                    <span>общение</span>
                </div>
            </div>
            <div class="features-item">
                <div class="feature-item-text">
                    <span>заработок</span>
                </div>
            </div>
            <div class="features-item">
                <div class="feature-item-text">
                    <span>Займитесь тем что умеете </span>
                    <span>делать лучше нас!</span>
                </div>
            </div>
            <div class="features-item"></div>
        </section>
        <section class="make-order">
            <div class="container">
                <h2 class="section-title left-decor-inverse">Сделай заказ сейчас и получи свой бонус</h2>
                <a href="/orders/new/" class="button"><span>Заказать услугу</span></a>
            </div>
        </section>
        <section class="statistic">
            <div class="statistic-container">
                <h2 class="section-title">ФОП Боклаг это</h2>
                <img src="<?php bloginfo('template_url')?>/img/about-image.jpg" alt="">
            </div>
        </section>
        <section class="need-implement">
            <div class="container">
                <form method="post">
                    <div class="need-implement-form">
                        <label for="">Что нужно выполнить:</label>
                        <div class="input-wrapper">
                            <input type="text" placeholder="Оформить участок" name="checkorder" value="<?php echo !empty($_POST['checkorder']) ? $_POST['checkorder'] : '' ?>">
                        </div>
                        <button type="submit" class="button button-invert" name="send-mail"><span>Отправить исполнителю</span></button>
                        <?php if(isset($mail_error) && is_array($mail_error)){ ?>
                            <div class="popup-form-input errors">
                                <?php foreach ($mail_error as $value) {
                                    echo '<span>'.$value.'<span><br>';
                                }?>
                            </div>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </section>
        <section class="video video-services">
            <div class="video-cover">
                <div class="video-cover-content">
                    <button class="video-play"></button>
                    <h2 class="section-title">Услуги "ФОП Боклаг"</h2>
                </div>
            </div>
            <video class="video-track" src="<?php the_field('services_video')?>" controls></video>
        </section>
        <section class="share">
            <div class="container">
                <h2 class="section-title">Поделись ссылкой и заработай свой бонус</h2>
                <a href="#send-mail" class="button"><span>Поделиться</span></a>
            </div>
        </section>
        <section class="calculator">
            <div class="container">
                <h2 class="section-title">Калькулятор стоимости услуги</h2>
                  <?php echo do_shortcode('[contact-form-7 id="123" title="Контактная форма Кадькулятор"]')?>
            </div>
        </section>
        <section class="callback">
            <div class="container">
                <h1 class="section-title">Мы вам перезвоним:</h1>
                <form>
                    <div class="callback-form">
                        <div class="callback-day">
                            Хотите мы перезвоним вам<br>в
                            <div class="callback-day-wrapper">
                                <select>
                                    <option value="">понедельник</option>
                                    <option value="">вторник</option>
                                    <option value="">среда</option>
                                    <option value="">четверг</option>
                                    <option value="">пятница</option>
                                    <option value="">суббота</option>
                                    <option value="">воскресенье</option>
                                </select>
                            </div>  
                            точно в
                        </div>
                        <div class="callback-time">
                            <div class="callback-time-controls">
                                <input type="text" value="00" id="callback-hours">
                                <div class="callback-time-buttons">
                                    <button type="button" class="increase" id="hours-increase"></button>
                                    <button type="button" class="decrease" id="hours-decrease"></button>
                                </div>
                            </div>
                            <div class="callback-time-controls">
                                <input type="text" value="00" id="callback-minutes">
                                <div class="callback-time-buttons">
                                    <button type="button" class="increase" id="minutes-increase"></button>
                                    <button type="button" class="decrease" id="minutes-decrease"></button>
                                </div>
                            </div>
                        </div>
                        <div class="callback-phone">
                            <label for="">Номер телефона:</label>
                            <div class="input-wrapper">
                                <input type="text" placeholder="8 800 808 80 80">
                            </div>
                            <button type="submit" class="button button-invert"><span>Жду звонка</span></button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <?php endif;?>
    </main>
<?php get_template_part('template_parts/send','email')?>
<?php get_footer();?>