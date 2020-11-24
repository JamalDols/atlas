<?php /* Template Name: Home */ ?>



<style>
#emptymodal {
  background: #ccc;
    width: 100%;
    height: 100%;
    position: absolute;
    visibility: hidden;
    display:none;
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

<div id="loader" class="visible"></div>
<div id="emptymodal">
  <div class="modal-content"></div>
</div>

<div id="map"></div>



<?php 
get_template_part('templates/header');
?>

<section class="home--info">
  <div class="container">
    <div class="row">

      <div class="col-md-12 col-lg-3">
        <h1 class="title--home">Què és Valencia Sostenible?</h1>
      </div>
      <div class="col-md-12 col-lg-9">
        <span class="text__big">València Clima i Energia és una fundació municipal de l’Ajuntament de València, i que
          depén de la Regidoria d’Emergència Climàtica i Transició Energètica. Els eixos fonamentals del seu treball són
          la informació i formació sobre canvi climàtic.</span>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-lg-3">
        <h1 class="title--home">València hui</h1>
      </div>
      <div class="col-md-12 col-lg-9 weather-info">
        <div class="weather-info--col">
          <span id="time"></span>
        </div>
        <div class="weather-info--col">
          <span id="temp"></span>
        </div>
        <div class="weather-info--col">
          <span id="humidity"></span>
        </div>
        <div class="weather-info--col">
          <div id="icon" style="width: 100px;"><img id="wicon" src="" alt=""></div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-lg-3">
        <h1 class="title--home">Altres mapes d’interés</h1>
      </div>
      <div class="col-md-12 col-lg-3 card--poi">
        <div class="box-color">
          <div class="item--poi">
            <div class="image" style="background-image: url(<?= get_template_directory_uri(); ?>/dist/images/icon-poi-1.svg);">
              
            </div>
            <span class="text">Fonts Públiques</span>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-lg-3 card--poi">
        <div class="box-color">
          <div class="item--poi">
            <div class="image" style="background-image: url(<?= get_template_directory_uri(); ?>/dist/images/icon-poi-2.svg);">
              
            </div>
            <span class="text">ValenbiSi</span>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-lg-3 card--poi">
        <div class="box-color">
          <div class="item--poi">
            <div class="image" style="background-image: url(<?= get_template_directory_uri(); ?>/dist/images/icon-poi-3.svg);">
              
            </div>
            <span class="text">Arbres Monumentals</span>
          </div>
        </div>
      </div>
    </div>



    <div class="row">
      <div class="col-md-12 col-lg-3">
        <h1 class="title--home">Notícies</h1>
      </div>
      <?php
$args = array(
'post_type' => 'post',
'posts_per_page' => 3,
);
$query = new WP_Query( $args );
?>
      
      <?php while( $query->have_posts() ) : $query->the_post() ?>

        <div class="col-md-6 col-lg-3 card--news__home">
          <div class="item-news">
            <a class="permalink" href="<?= the_permalink() ?>"></a>
            <div class="image--container">
              <div class="image"
                style="background-image:url(<?= the_post_thumbnail_url() ?>)">
              </div>
            </div>
            <div class="box-color">
              <span class="date"><?= get_the_date( 'd.m.Y', get_the_ID() ); ?></span>
              <span class="text"><?php the_title() ?></span>
            </div>
          </div>
        </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
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
          'Longitude'=>$post->lon,
          'title'=>get_the_title(),
          'url'=> get_permalink()
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
            zoom:14
        });

          L.tileLayer('https://api.mapbox.com/styles/v1/jamaldols/ckg95x9iu77ew1apgpekvc9j3/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1IjoiamFtYWxkb2xzIiwiYSI6ImNrYmF2bGowOTBycGEyeG84b2F2NGlsYWkifQ.9rqymFnsW79aCkAFGCo0XQ', {
attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
maxZoom: 18,
tileSize: 512,
zoomOffset: -1,
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
              let content = '<span class="title">' + feature.properties.title + '</span>' +  '<span class="address">' + feature.properties.address + '</span>' +  '<a href="'+ feature.properties.url + '">' + 'Més informació' + '</a>';
                layer.bindPopup(content);
                console.log('fuera de : '+ feature.properties.address)
                // markers.on('click', function (e) {
                //   layer.bindPopup(content);
                //   console.log('show');
                //   console.log('dentro de función: '+ feature.properties.address)
                //   console.log(content);
                //   $(".modal-content").html('Marker id: ' + feature.properties.address);
                //   $('#emptymodal').addClass('visible');
                // });
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
              let content = '<span class="title">' + feature.properties.title + '</span>' +  '<span class="address">' + feature.properties.address + '</span>' +  '<a href="'+ feature.properties.url + '">' + 'Més informació' + '</a>';

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
              let content = '<span class="title">' + feature.properties.title + '</span>' +  '<span class="address">' + feature.properties.address + '</span>' +  '<a href="'+ feature.properties.url + '">' + 'Més informació' + '</a>';
                
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
