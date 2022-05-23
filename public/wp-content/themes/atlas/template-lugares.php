<?php
/**
 * Template Name: Lugares
 */
?>
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>


<?php 
// Get the taxonomy's terms
$terms = get_terms(
  array(
      'taxonomy'   => 'categoria_lugar',
      'hide_empty' => true,
  )
);

?>

<section class="cptaxonomy--list">
<div class="container">
  <div class="row">
    <div class="col-12">
      <?php
      if ( ! empty( $terms ) && is_array( $terms ) ) {
        // Run a loop and print them all
        foreach ( $terms as $term ) { ?>

            <a class="cptaxonomy--item" href="<?php echo esc_url( get_term_link( $term ) ) ?>">
              <?php echo $term->name; ?>
            </a>
            <?php
        }
      }  ?>
    </div>
  </div>
</div>
</section>


<section class="venue--list">
  <div class="container">
    <div class="row">
      <?php
$queryObject = new  Wp_Query( array(
    'showposts' => -1,
    'post_type' => array('lugar'),
    'meta_key'			=> 'category',
    'orderby'			=> 'meta_value',
    'order'				=> 'DESC'
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
          <?php 

$images = get_field('gallery');

if( $images ): ?>
    <ul class="imagegallery">
        <?php foreach( $images as $image ): ?>
           
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
            <div class="venue--image"
            style="background-image: url(<?php echo $image['sizes']['large']; ?>);"
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
