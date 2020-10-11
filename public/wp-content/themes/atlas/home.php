<?php /* Template Name: Demo Page Template */ get_header(); ?>
<h1 class="main-title"><?= post_type_archive_title(); ?></h1>


<style>
#emptymodal {
  background: #ccc;
    width: 100%;
    height: 100%;
    position: absolute;
    visibility: hidden;
}
#emptymodal.visible {
  background: #ccc;
    width: 100%;
    height: 300px;
    position: fixed;
    visibility: visible;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}
  
</style>
<div id="emptymodal">
  <div class="modal-content"></div>
</div>


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
  <div id="map">
  </div>
</section>


<style>
    #map,
    #acf-map { height: 500px; }
</style>
 <?php
          $arg = array( 'post_type' => 'lugar', 'posts_per_page' => 10,);
          $loop = new WP_Query( $arg );
//           $array = array();
//           while ( $loop->have_posts() ) : $loop->the_post();
//           global $places;
//           $array[] = array(
//           'subtitle' => the_field('subtitle'),
//           'address' => the_field('address'),
//           'category'=> the_field('category'),
//           'Latitude'=> the_field('lat'),
//           'Longitude'=> the_field('lon'),
//           );
// 
// endwhile;
// 
// wp_reset_query();
// ob_clean();
//  echo wp_json_encode($array);
 $posts = $loop ->get_posts();
 foreach( $posts as $post ) { 
$output[] = array(

          'address' => $post->address,
          'category'=> $post->category,
          'Latitude'=> $post->lat,
          'Longitude'=>$post->lon
);
 } 
$json =json_encode($output);
?>

<script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/leaflet.markercluster.js">  </script>
         <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/MarkerCluster.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/MarkerCluster.Default.css">

 


  
  
  

    <script>
   
        var data = <?php echo $json ?>;
        // Create map instance
        var map = L.map('map',{
            center:[39.4697500, -0.3773900],
            zoom:10
        });

          L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
maxZoom: 18,
id: 'mapbox/streets-v11',
tileSize: 512,
zoomOffset: -1,
accessToken: 'pk.eyJ1IjoiamFtYWxkb2xzIiwiYSI6ImNrYmF2bGowOTBycGEyeG84b2F2NGlsYWkifQ.9rqymFnsW79aCkAFGCo0XQ'
}).addTo(map);

    

        //create markerclustergroup 
        var markers=L.markerClusterGroup();
        // create a geojson object
        let geojsonData = createGeoJson(data);

        function createGeoJson(data) {
            var geojson = {
                "type":"FeatureCollection",
                "features":[

                ]
            };

            // iterate through the data array
            data.forEach(element => {
                let marker = L.marker([element.Latitude, element.Longitude]);
                let pntGeojson = marker.toGeoJSON();

                pntGeojson.properties = element;
                geojson.features.push(pntGeojson);
            });

            return geojson;
        }


        // create a  geojson instance
        var categorynone = L.geoJson(geojsonData, {
            onEachFeature:function(feature, layer) {
                let content ="<table class='table table-striped table-bordered table-condensed'>" +
                    "<tr><th>Dirección:</th><td>" + feature.properties.address + "</td></tr>" + "<tr><th>Categoría: </th><td>" + feature.properties.category +"</td></tr><table>";

                    
                
                layer.bindPopup(content);
                console.log('fuera de : '+ feature.properties.address)
                markers.on('click', function (e) {
                  layer.bindPopup(content);
                  console.log('show');
                  console.log('dentro de función: '+ feature.properties.address)
                  console.log(content);
                  $(".modal-content").html('Marker id: ' + feature.properties.address);
                  $('#emptymodal').addClass('visible');
                });
            },
            pointToLayer:function(geoObj, latLng) {
                return L.marker(latLng);
              
            },
            filter:function (feature,layer){
                return feature.properties.category == "";  
            }

        });
        var category1 = L.geoJson(geojsonData, {
            onEachFeature:function(feature, layer) {
                let content ="<table class='table table-striped table-bordered table-condensed'>" +
                    "<tr><th>Dirección:</th><td>" + feature.properties.address + "</td></tr>" + "<tr><th>Categoría: </th><td>" + feature.properties.category +"</td></tr><table>";

                    layer.bindPopup(content);
             
            },
            pointToLayer:function(geoObj, latLng) {
                return L.marker(latLng);
              
            },
            filter:function (feature,layer){
                return feature.properties.category == "categoria1";  
            }

        });

        var category2 = L.geoJson(geojsonData, {
            onEachFeature:function(feature, layer) {
                let content ="<table class='table table-striped table-bordered table-condensed'>" +
                    "<tr><th>Dirección:</th><td>" + feature.properties.address + "</td></tr>" + "<tr><th>Categoría: </th><td>" + feature.properties.category +"</td></tr><table>";
                
                layer.bindPopup(content);
            },
            pointToLayer:function(geoObj, latLng) {
                return L.marker(latLng);
              
            },
            filter:function (feature,layer){
                return feature.properties.category == "categoria2";  
            }

        });
        
         
          
        var all = L.layerGroup([category1,category2,categorynone]);
        L.control.layers({
            "All":all,
            "categorynone":categorynone,
            "category1":category1,
            "category2":category2,
            "cluster":markers,
        }).addTo(map);
        markers.addLayer(all);
        markers.addTo(map);

        console.log(markers);

    </script>
