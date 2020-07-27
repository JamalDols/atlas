

<?php use Roots\Sage\Titles; ?>
<section class="page-header-section" data-aos="fade-up">

          <h1 class="main-title"><?= Titles\title(); ?></h1>

        
</section>
<?php while (have_posts()) : the_post(); 
$counter = 1;
?>

<div class="featured-image"
          style="background-image: url('<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>');width: 400px;
    height: 400px;
    background-size: cover;
    background-position: center;">
        </div>
<?php
//VARS
 $title = get_field('title'); 
 $subtitle = get_field('subtitle'); 
 $address = get_field('address'); 
 $lat = get_field('lat'); 
 $lon = get_field('lon'); 
 ?>




<?php echo $title ?>
<?php echo $subtitle ?>

<?php echo $address ?>
<?php echo $lat ?>
<?php echo $lon ?>

<?php $counter++; ?>

<?php endwhile; ?>





