<?php get_header('profile')?>
    <main class="main">
        <section class="page-title-section">
            <div class="container">
                <h1 class="section-title">КАЛЬКУЛЯТОР СТОИМОСТИ УСЛУГИ</h1>
            </div>
        </section>
        <section class="page-content-section">
            <div class="container-wide">
                <div class="page-content">
                    <div class="side-menu">
                        <?php get_sidebar('profile');?>
                    </div>
                    <div class="main-content">
                        <div class="container">
                            <?php echo do_shortcode('[contact-form-7 id="123" title="Контактная форма Кадькулятор"]')?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php get_footer('profile');?>