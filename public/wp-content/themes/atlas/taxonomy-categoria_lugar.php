<?php
/**
 * Template Name: Lugares
 */
?>

  <section class="page-header">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h1><?php echo single_cat_title( '', false );?></h1>
        </div>
      </div>
    </div>
  </section>
  
  <?php get_template_part('templates/content', 'page'); ?>



<?php 
// Get the taxonomy's terms
$terms = get_terms(
  array(
      'taxonomy'   => 'categoria_lugar',
      'hide_empty' => false,
  )
);

?>

<section class="cptaxonomy--list">
<div class="container">
  <div class="row">
    <div class="col-12">
    


            <a class="cptaxonomy--item" href="javascript:history.back()">
            <?php if(ICL_LANGUAGE_CODE=='es'): ?>
              Volver
            <?php else: ?>
              Tornar
            <?php endif;?>  
            </a>

    </div>
  </div>
</div>
</section>
<section class="venue--list">
  <div class="container">
    <div class="row">
      <?php
$queryObject = new  Wp_Query( array(
    'showposts' => 10,
    'post_type' => array('lugar'),
    'meta_key'			=> 'category',
    'orderby'			=> 'meta_value',
    'order'				=> 'DESC'
    ));

// The Loop
 if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
   




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
                
                endwhile; 
                ?>
      <?php  endif;?>

    </div>
  </div>
</section>


<section class="pagination">

</section>
