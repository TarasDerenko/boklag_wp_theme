<?php
/* Template Name: Orders */
?>
<?php get_header('profile');?>
<main class="main">
    <section class="page-title-section">
        <div class="container">
            <h1 class="section-title">Мои заказы</h1>
        </div>
    </section>
    <section class="page-content-section">
        <div class="container-wide">
            <div class="page-content">
                <div class="side-menu">
                    <?php get_sidebar('profile');?>
                </div>
                <div class="main-content">
                    <div class="archive-content">
                        <?php get_template_part('order_parts/orders','loop')?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer('profile')?>