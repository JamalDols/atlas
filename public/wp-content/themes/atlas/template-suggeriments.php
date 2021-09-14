<?php
/**
 * Template Name: Suggeriments
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>


<?php if(ICL_LANGUAGE_CODE=='ca'): ?>
  <?php echo do_shortcode( '[contact-form-7 id="380" title="Formulari - Valencià"]' ); ?>
            <?php elseif(ICL_LANGUAGE_CODE=='es'): ?>
              <?php echo do_shortcode( '[contact-form-7 id="94" title="Formulario - Castellano"]' ); ?>
            <?php endif;?>  

            
            


