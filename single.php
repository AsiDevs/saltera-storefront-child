<?php
/**
 * The template for displaying all single posts.
 *
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) :
			the_post();

			do_action( 'storefront_single_post_before' );

			get_template_part( 'content', 'single' );

			do_action( 'storefront_single_post_after' );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
    <?php 
      $title = get_field('iwt_title');
      $description = get_field('iwt_description');
      $content = get_field('content'); 
      include("template-parts/template-common/image-with-text/index.php"); 
    ?>
	<?php 
      $title = get_field('features_title');
      $description = get_field('features_description');
      $features = get_field('features'); 
      include("template-parts/template-common/features/index.php"); 
    ?>
    <?php 
      $title = get_field('faq_title');
      $description = get_field('faq_description');
      $faqs = get_field('faqs_list');
      include("template-parts/template-common/faqs/index.php"); 
    ?>

<?php
do_action( 'storefront_sidebar' );
get_footer();
