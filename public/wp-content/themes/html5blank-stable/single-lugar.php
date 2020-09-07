<?php /* Template Name: Demo Page Template */ get_header(); ?>

<section class="page-header-section" data-aos="fade-up">

<h1 class="main-title"><?= the_title()?></h1>


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
$category = get_field('category'); 
?>



<div class="content"></div>
<h1 class="title"><?php echo $title ?></h1>
<h2 class="subtitle"><?php echo $subtitle ?></h2>

<span class="address"><strong>Dirección:</strong><?php echo $address ?></span>
<br> 
<span class="category"><strong>Categoría:</strong><?php echo $category ?></span>
<br> 
<span class="lat"><strong>Longitud:</strong><?php echo $lat ?></span>
<br> 
<span class="lon"><strong>Latitud:</strong><?php echo $lon ?></span>

<?php $counter++; ?>

<?php endwhile; ?>

<style>
#mapid { height: 500px; }
</style>
<div id="mapid"></div>
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




