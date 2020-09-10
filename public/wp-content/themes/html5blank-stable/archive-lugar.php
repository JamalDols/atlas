<?php /* Template Name: Demo Page Template */ get_header(); ?>
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
    #map,
    #acf-map { height: 500px; }
</style>
<div id="map" style="width: 600px;">


</div>
<div class="marker" data-lat="<?php echo the_field('lat') ?>" data-lng="<?php echo the_field('lon'); ?>" data-title="<?php echo the_field('subtitle')  ?>" data-url="<?php echo 'link'; ?>" data-category="<?php echo 'category'; ?>"></div>


<script>
$( document ).ready(function() {
  var map = L.map('map').setView([39.8410802, -0.1191397], 8);
    
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
          attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
          maxZoom: 18,
          id: 'mapbox/streets-v11',
          tileSize: 512,
          zoomOffset: -1,
          accessToken: 'pk.eyJ1IjoiamFtYWxkb2xzIiwiYSI6ImNrYmF2bGowOTBycGEyeG84b2F2NGlsYWkifQ.9rqymFnsW79aCkAFGCo0XQ'
          }).addTo(map); 


var marker = [];
$.each($('.marker'), function () {
  var lat = $(this).attr('data-lat');
  var lng = $(this).attr('data-lng');
  var name = $(this).attr('data-title');
  var link = $(this).attr('data-url');
  console.log( 'Marker es: ' + marker );
  marker = [ name, lat, lng, link ];
  console.log( 'Y ahora es: ' + marker );
  console.log( marker );
});

var markers = [ marker ];
console.log(markers);
console.log(markers.length);
for (var i = 0; i < markers.length; i++) {
  marker = new L.marker([markers[i][1],markers[i][2]])
      .bindPopup(markers[i][0])
      .addTo(map);
}
});


</script>

<script>



// var markerList = [
//   ["A",39.8410802,-0.1191397],
//   ["B",39.8410802,-0.1291397],
//   ["C",39.8410802,-0.1391397],
//   ["D",39.8510802,-0.1191397],
//   ["E",39.8610802,-0.1291397],
//   ["F",39.8710802,-0.1391397],

//   ];

//       var map = L.map('map').setView([39.8410802, -0.1191397], 12);
//       mapLink = 
//           '<a href="http://openstreetmap.org">OpenStreetMap</a>';
//           L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
//           attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
//           maxZoom: 18,
//           id: 'mapbox/streets-v11',
//           tileSize: 512,
//           zoomOffset: -1,
//           accessToken: 'pk.eyJ1IjoiamFtYWxkb2xzIiwiYSI6ImNrYmF2bGowOTBycGEyeG84b2F2NGlsYWkifQ.9rqymFnsW79aCkAFGCo0XQ'
//           }).addTo(map);

//   for (var i = 0; i < markerList.length; i++) {
//     marker = new L.marker([markerList[i][1],markerList[i][2]])
//       .bindPopup(markerList[i][0])
//       .addTo(map);
//   }
             
  </script>