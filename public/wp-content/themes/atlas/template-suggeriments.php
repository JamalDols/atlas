<?php
/**
 * Template Name: Suggeriments
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>




<?php echo do_shortcode( '[contact-form-7 id="94" title="Formulario"]' ); ?>
