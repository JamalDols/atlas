<?php
/**
 * Template Name: Font Ajuntament
 */
?>


<?php
//VARS
$title = get_the_title(); 
$subtitle = get_field('subtitle'); 
$address = get_field('address'); 
$url = get_field('url'); 
$lat = get_field('lat'); 
$lon = get_field('lon'); 
$category = get_field('category'); 
?>







<?php while (have_posts()) : the_post(); ?>




<?php endwhile; ?>



<section class="venue--single">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <section class="venue--header">
          <h1><?php echo $title ?></h1>
          <span class="address"><?php echo $address ?></span>
          <span class="info"><a href="<?php echo $url ?>">Más información</a></span>
        </section>
        <div class="venue--content">
        <?= the_content() ?>
        </div>
      </div>
      <div class="col-md-6">
        <div class="venue--single__image">




          <?php 

$images = get_field('gallery');
if( $images ): ?>
        <div class="swiper-container">
          <div class="swiper-wrapper">
            <?php foreach( $images as $image ): ?>
            <div class="swiper-slide" style="background-image: url(<?php echo esc_url($image['sizes']['large']); ?>);    background-size: cover; background-position: center;">

            </div>
            <?php endforeach; ?>
          </div>
          <div class="swiper-pagination"></div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>

        </div>

        <script>
        const swiper = new Swiper('.swiper-container', {
  // Optional parameters
  direction: 'horizontal',
  loop: true,

  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
  },

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

});
        </script>

<?php else : 
  
  the_post_thumbnail();
  ?>

         
  
       


<?php endif ?>





        <style>
          .swiper-container {
            width: 100%;
            height: 300px;
          }
        </style>




        </div>
      </div>
      <div class="col-12">
        <div id="mapid">
        </div>
      </div>
    </div>
  </div>
</section>

<script>
var L = window.L;
var mymap = L.map('mapid').setView([<?php echo $lat ?>, <?php echo $lon ?>], 13);
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
maxZoom: 18,
id: 'mapbox/streets-v11',
tileSize: 512,
zoomOffset: -1,
accessToken: 'pk.eyJ1IjoiamFtYWxkb2xzIiwiYSI6ImNrYmF2bGowOTBycGEyeG84b2F2NGlsYWkifQ.9rqymFnsW79aCkAFGCo0XQ'
}).addTo(mymap);
var marker = L.marker([<?php echo $lat ?>, <?php echo $lon ?>]).addTo(mymap);
// marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();
// var popup = L.popup()
//     .setLatLng([<?php echo $lat ?>, <?php echo $lon ?>])
//     .setContent("I am a standalone popup.")
//     .openOn(mymap);
var popup = L.popup();

function onMapClick(e) {
popup
.setLatLng(e.latlng)
.setContent("You clicked the map at " + e.latlng.toString())
.openOn(mymap);
}

mymap.on('click', onMapClick);
</script>


