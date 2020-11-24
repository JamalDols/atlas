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
$lat = get_field('lat'); 
$lon = get_field('lon'); 
$category = get_field('category'); 
?>







<?php while (have_posts()) : the_post(); ?>


<section class="page-header">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h1><?php echo $title ?></h1>
        <span class="address"><?php echo $address ?></span>
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
        <div class="venue--single__image">
          <?php if ( has_post_thumbnail() ) {
                the_post_thumbnail();
                } else { ?>
                <img src="http://via.placeholder.com/850x500?text=No+Image" />
          <?php } ?>
        </div>
        <div id="mapid">

        <iframe width="100%" height="100%" frameborder="0" allowfullscreen src="//umap.openstreetmap.fr/es/map/test-para-valencia-sostenible_528064?scaleControl=false&miniMap=false&scrollWheelZoom=false&zoomControl=true&allowEdit=false&moreControl=true&searchControl=null&tilelayersControl=null&embedControl=null&datalayersControl=true&onLoadPanel=undefined&captionBar=false"></iframe>
        
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


