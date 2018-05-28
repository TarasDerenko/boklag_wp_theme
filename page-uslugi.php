<?php get_header('help')?>
<?php do_action('start_service'); ?>
    <main class="main">
        <section class="help-search">
            <div class="container">
                    <input type="text" placeholder="Поиск" id="search-service" value="">
            </div>
        </section>
        <?php if(have_posts()): the_post(); ?>
            <section class="help-content">
                <div class="container">
                    <h2 class="section-title"><?php the_title();?></h2>
                </div>
                <div class="help-container">
                    <div class="help-text">
                        <ul class="service-list">
                        <?php if(isset($services) && is_array($services)):?>
                            <?php foreach($services as $service): ?>
                            <li><?php echo $service->title ?></li>
                            <?php endforeach;?>
                        <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </section>
        <?php endif;?>
    </main>
<?php do_action('start_service'); ?>
<?php get_footer()?>