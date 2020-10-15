<?php
/**
 * Template Name: Itineraris
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>

<section class="list-items">
  <div class="container">
    <div class="row">

  <?php  $i = 1;
  while ($i <= 12): ?>

      <div class="col-md-4 item-place">
        <div class="image">
          <div class="box-color"></div>
          <img class="img-fluid" src="<?= get_template_directory_uri(); ?>/dist/images/placeholder.jpg" alt="">
        </div>
        <h1 class="title-item">Ruta de comerços i parcs accesibles </h1>
        <div class="location">Benimaclet</div>
      </div>

    <?php  
        $i++;
    endwhile;
    ?>



    </div>
  </div>
</section>
