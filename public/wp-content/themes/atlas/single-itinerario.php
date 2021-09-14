<?php while (have_posts()) : the_post(); ?>


<section class="page-header">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h1><?php the_title() ?></h1>
        <span class="address"><?php the_field('zone') ?> </span>
      </div>
    </div>
  </div>
</section>

  
<?php endwhile; ?>


<section class="venue--single">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="venue--content">
        <?= the_content() ?>
        </div>
      </div>
      <div class="col-md-6">
        <div class="venue--single__image" style="margin-bottom:30px; background-image:url(<?= the_post_thumbnail_url() ?>)">
        </div>
        <div id="mapid">
        <?php the_field('map') ?>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
#mapid { height: 320px;
    border: 3px solid #ece1cb; }
    .leaflet-control-attribution.leaflet-control {
      display: none !important;
    }
</style>



