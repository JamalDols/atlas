<h1 class="main-title"><?= post_type_archive_title(); ?></h1>






<section class="list-cases">
  <div class="container">
    <div class="row position-relative">
      <?php
        $args = array(
          'post_type' => 'lugar',
          'posts_per_page' => 10,
        );
        $query = new WP_Query( $args );
        ?>
        
        <?php $counter = 1; ?>
      <?php while( $query->have_posts() ) : $query->the_post() ?>
      <div class="item-case-<?= $counter ?> col-md-12" data-hover="<?= $counter ?>" data-aos="fade-up" data-aos-duration="2000">
        <div class="case-container"> 
          <?php the_title( '<h2 class="entry-title"><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></h2>' ); ?>
          <p><?php the_field('subtitle') ?></p>
          <p><?php the_field('address') ?></p>
          <p><strong>Latitud:</strong> <?php the_field('lat') ?></p>
          <p><strong>Longitud:</strong> <?php the_field('lon') ?></p>
          
          
        </div>
      </div>
        <?php $counter++; ?>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
</section>


<style>
    #mapid { height: 500px; }
</style>

<section class="map-container">
  <div id="mapid"></div>
  <div id="feature_infos"> <span id="heading">Clickresult: </span>
  <span id="info"></span>
  </div>
</section>


<script>
var mymap = L.map('mapid').setView([39.61,-105.02], 13);
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoiamFtYWxkb2xzIiwiYSI6ImNrYmF2bGowOTBycGEyeG84b2F2NGlsYWkifQ.9rqymFnsW79aCkAFGCo0XQ'
}).addTo(mymap);
var marker = L.marker([39.61,-105.02]).addTo(mymap);
var popup = L.popup();

function onMapClick(e) {
    popup
        .setLatLng(e.latlng)
        .setContent("You clicked the map at " + e.latlng.toString())
        .openOn(mymap);
}


mymap.on('click', onMapClick);
</script>