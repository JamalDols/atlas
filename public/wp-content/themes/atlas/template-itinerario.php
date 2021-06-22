<?php
/**
 * Template Name: Itinerarios
 */
?>
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>

<section class="venue--list">
  <div class="container">
    <div class="row">
      <?php
$queryObject = new  Wp_Query( array(
    'showposts' => 10,
    'post_type' => array('itinerario'),
    'orderby' => 1,
    ));

// The Loop
if ( $queryObject->have_posts() ) :
    $i = 0;
    while ( $queryObject->have_posts() ) :
        $queryObject->the_post(); ?>
       

       <div class="col-md-4 venue--item">
        <a class="venue--permalink" href="<?= the_permalink() ?>"></a>
        <div class="venue--image__container">
          <div class="venue--box-color"></div>
            <div class="venue--image"
            style="background-image: url(<?= the_post_thumbnail_url() ?>);"
            ></div>
        </div>
        <h1 class="venue--title"><?php the_title() ?></h1>
        <div class="venue--location">  <?php the_field('zone') ?> </div>
      </div>


      <?php       
                $i++;
                endwhile; 
                wp_reset_postdata();?>
      <?php  endif;?>

    </div>
  </div>
</section>


<section class="pagination">

</section>