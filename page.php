<?php get_header('help')?>
    <main class="main">
        <?php get_search_form();?>
        <?php if(have_posts()): the_post(); ?>
            <section class="help-content">
                <div class="container">
                    <h2 class="section-title"><?php the_title();?></h2>
                </div>
                <div class="help-container">
                    <div class="help-text">
                        <?php the_content() ?>
                    </div>
                </div>
            </section>
        <?php endif;?>
    </main>
<?php get_footer()?>