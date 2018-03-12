<?php 
/* Template name: About */
?>
<?php get_header('about');?>
  <main class="main">
<?php if(have_posts()): the_post(); ?>
        <section class="about-video">
            <div class="container">
                <h1 class="section-title"><?php the_title() ?></h1>
                <div class="video">
                    <div class="video-cover">
                        <div class="video-cover-content">
                            <button class="video-play video-play-small"></button>
                            <h2 class="section-title">О нас</h2>
                        </div>
                    </div>
                    <video class="video-track" src="<?php the_field('about_video'); ?>" controls></video>
                </div>
            </div>
        </section>
        <section class="about-text">
            <div class="container">
               <?php the_content(); ?>
            </div>
        </section>
<?php endif;?>
        <section class="about-team">
            <div class="container">
                <h2 class="section-title">Наша команда</h2>
                <div class="about-team-list">
                    <div class="about-team-item">
                        <div class="about-team-photo">
                            <img src="<?php bloginfo('template_url')?>/img/team-member1.jpg" alt="">
                        </div>
                        <div class="about-team-info">
                            <h3 class="about-team-name">Святошинский Василий</h3>
                            <h4 class="about-team-status">Руководитель</h4>
                            <div class="about-team-text">
                                Отслеживайте условия выполнения договора с мобильного устройства, когда нет доступа к компьютеру.
                                <span class="about-team-more">
                                    В командировках, между офисами или дома — заказчик и исполнитель держат связь с нами в формате real-time.
                                </span>
                                <button class="about-team-extend">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="9.41" viewBox="0 0 22 9.41">
                                        <path d="M737,1467.42L726.5,1475l-10.5-7.58" transform="translate(-715.5 -1466.09)"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="about-team-item">
                        <div class="about-team-photo">
                            <img src="<?php bloginfo('template_url')?>/img/team-member2.jpg" alt="">
                        </div>
                        <div class="about-team-info">
                            <h3 class="about-team-name">Святошинский Василий</h3>
                            <h4 class="about-team-status">Старший менеджер</h4>
                            <div class="about-team-text">
                                Отслеживайте условия выполнения договора с мобильного устройства, когда нет доступа к компьютеру.
                                <span class="about-team-more">
                                    В командировках, между офисами или дома — заказчик и исполнитель держат связь с нами в формате real-time.
                                </span>
                                <button class="about-team-extend">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="9.41" viewBox="0 0 22 9.41">
                                        <path d="M737,1467.42L726.5,1475l-10.5-7.58" transform="translate(-715.5 -1466.09)"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="about-team-item">
                        <div class="about-team-photo">
                            <img src="<?php bloginfo('template_url')?>/img/team-member3.jpg" alt="">
                        </div>
                        <div class="about-team-info">
                            <h3 class="about-team-name">Славная Валерия</h3>
                            <h4 class="about-team-status">Главный бухгалтер</h4>
                            <div class="about-team-text">
                                Отслеживайте условия выполнения договора с мобильного устройства, когда нет доступа к компьютеру.
                                <span class="about-team-more">
                                    В командировках, между офисами или дома — заказчик и исполнитель держат связь с нами в формате real-time.
                                </span>
                                <button class="about-team-extend">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="9.41" viewBox="0 0 22 9.41">
                                        <path d="M737,1467.42L726.5,1475l-10.5-7.58" transform="translate(-715.5 -1466.09)"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="about-become-team">
            <div class="become-team-container">
                <div class="become-team-block">
                    <h3 class="section-title">Как стать членом команды</h3>
                    <div class="become-team-list">
                        <div class="become-team-item">
                            <div class="become-team-step">1</div>
                            <div class="become-team-text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            </div>
                        </div>
                        <div class="become-team-item">
                            <div class="become-team-step">2</div>
                            <div class="become-team-text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            </div>
                        </div>
                        <div class="become-team-item">
                            <div class="become-team-step">3</div>
                            <div class="become-team-text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="about-news">
            <div class="container">
                <?php do_action('show_loop_news') ?> 
            </div>
        </section>
    </main>
<?php get_footer();?>