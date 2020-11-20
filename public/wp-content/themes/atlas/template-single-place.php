<?php
/**
 * Template Name: Font Ajuntament
 */
?>

<?php while (have_posts()) : the_post(); ?>


<section class="page-header">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h1>Font de la Plaça del Ajuntament</h1>
        <span class="address">Plaça del Ajuntament s/n </span>
      </div>
    </div>
  </div>
</section>

  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>


<section class="single-place">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="text">
          <p>La Plaça de l’Ajuntament és la plaça més gran i cèntrica de la ciutat de València. Ocupa els solars resultants de l’enderrocament del convent de Sant Francesc. Durant el franquisme rebia el nom de Plaza del Caudillo i després de la Transició democràtica espanyola, es va anomenar Plaça del País Valencià fins a l’any 1987. Entre 1936 i 1939, s’anomenava Plaça Emili Castelar. Hi ha una proposta per part del Consell Valencià de Cultura que reba el nom de Jaume I, el fundador del Regne de València. Després de les revoltes del 15 de Maig, els manifestants rebatejaren simbòlicament la plaça com a Plaça del Quinze de Maig, modificant les plaques per a mostrar aquest nou nom. Està declarada Conjunt Històric Artístic.</p>
          <p>Té una forma triangular, amb la Plaça del Mercat al nord i la replaça de l’Estació del Nord (València) al sud. A la vora de l’oest hi trobem l’Ajuntament de València, i a l’est l’edifici de Correus. Al nord de la plaça hi ha una gran font, I al sud, un gran espai obert envoltat d’aparadors de flors. La seua fesomia actual procedeix de la reforma realitzada per l’arquitecte Javier Goerlich entre 1931 i 1935, tot I que ha desaparegut el mercat neobarroc de flors subterrani que va rebre el nom popular de La Escupidera.</p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="image" style="margin-bottom:30px;">
          <img class="img-fluid" src="<?= get_template_directory_uri(); ?>/dist/images/placeholder2.jpg" alt="">
        </div>
        <div id="mapid"></div>
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

<script>
var L = window.L;
var mymap = L.map('mapid').setView([39.470515, -0.376125], 15);
L.tileLayer('https://api.mapbox.com/styles/v1/jamaldols/ckg95x9iu77ew1apgpekvc9j3/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1IjoiamFtYWxkb2xzIiwiYSI6ImNrYmF2bGowOTBycGEyeG84b2F2NGlsYWkifQ.9rqymFnsW79aCkAFGCo0XQ', {
maxZoom: 18,
id: 'mapbox/streets-v11',
tileSize: 512,
zoomOffset: -1,
accessToken: 'pk.eyJ1IjoiamFtYWxkb2xzIiwiYSI6ImNrYmF2bGowOTBycGEyeG84b2F2NGlsYWkifQ.9rqymFnsW79aCkAFGCo0XQ'
}).addTo(mymap);
var marker = L.marker([39.470515, -0.376125]).addTo(mymap);
var popup = L.popup();

function onMapClick(e) {
popup
.setLatLng(e.latlng)
.setContent("You clicked the map at " + e.latlng.toString())
.openOn(mymap);
}

mymap.on('click', onMapClick);
</script>

