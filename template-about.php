<?php
/*
  Template Name: About
 */

get_header(); ?>
    <?php   
        $image = get_field('hero_image');
        $title = get_field('hero_title');
        $description = get_field('hero_description');
        $buttons = get_field('hero_buttons'); 
        include("template-parts/template-common/hero/index.php"); 
    ?>
    <?php 
        $info = get_field('info'); 
        $has_bg = get_field('add_background_vision');
        include("template-parts/template-common/vision-statement/index.php"); 
    ?>
    <?php 
        $title = get_field('iwt_title');
        $description = get_field('iwt_description');
        $content = get_field('content'); 
        $has_bg = get_field('add_background_iwt');
        include("template-parts/template-common/image-with-text/index.php"); 
    ?>
    <?php 
        $title = get_field('faq_title');
        $description = get_field('faq_description');
        $faqs = get_field('faqs_list');
        $has_bg = get_field('add_background_faq');
        include("template-parts/template-common/faqs/index.php"); 
    ?>
<?php get_footer(); ?>