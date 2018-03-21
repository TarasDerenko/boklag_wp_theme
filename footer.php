<?php get_template_part('template_parts/footer','section') ?>
    <?php if(!is_user_logged_in()): ?>
       <?php get_template_part('template_parts/login','form'); ?>
       <?php get_template_part('template_parts/register','form'); ?>
    <?php endif; ?>
    <?php wp_footer() ?>
</body>
</html>