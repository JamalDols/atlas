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

        <iframe width="100%" height="100%" frameborder="0" allowfullscreen="" src="//umap.openstreetmap.fr/es/map/viabahia_468869?scaleControl=false&miniMap=false&scrollWheelZoom=false&zoomControl=true&allowEdit=false&moreControl=true&searchControl=null&tilelayersControl=null&embedControl=null&datalayersControl=true&onLoadPanel=undefined&captionBar=false"></iframe>
        
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



