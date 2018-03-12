<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php wp_title() ?></title>
    <link rel="icon" type="image/png" href="<?php bloginfo('template_url')?>/img/favicon.png">
    <?php wp_head();?>
</head>
<body <?php body_class() ?>>
<?php get_template_part('template_parts/header','section'); ?>
