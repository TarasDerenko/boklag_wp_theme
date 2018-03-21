<?php get_header('help')?>
    <main class="main">
        <?php get_search_form();?>
            <section class="help-content">
                <div class="container">
                    <h2 class="section-title">Поиск</h2>
                </div>
                <div class="help-container">
                    <div class="help-text">
                        <div class="help-faq">
                        <?php if(have_posts()): while(have_posts()): the_post(); ?>
                            <a href="#" class="help-question"><?php the_title() ?></a>
                               <div class="help-answer">
                                 <?php the_content();?>
                               </div>
                        <?php endwhile; endif;?>
                        </div>
                    </div>
                </div>
            </section>
    </main>
<?php get_footer()?>