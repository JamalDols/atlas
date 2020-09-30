<?php /* Template Name: Demo Page Template */ get_header(); ?>
<h1 class="main-title"><?= post_type_archive_title(); ?></h1>

<div aria-labelledby="myModalLabel" class="modal left fade" id="emptymodal" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
      <div class="modal-content"></div>
      <!-- modal-content -->
    </div>
    <!-- modal-dialog -->
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

 


  
  
  

    <script>
PlaceMarker = L.CircleMarker.extend({
  options: {
    id: ''
  }
});

   
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

//TODO: Ahora solo falta recuperar la información y sacarla por aquí
markers.on('click', function (e) {
        console.log('show');
        var id = this.options.id;
        $(".modal-content").html('Marker id: ' + id);
        $('#emptymodal').modal('show');
        map.setView(e.target.getLatLng());
    });

    /*Close modal on map click */
    map.on('click', function (e) {
        console.log('Hide');
        // $('.modal').modal('hide');
    });

    </script>
<style>
    /*******************************
    * MODAL AS LEFT/RIGHT SIDEBAR
    * Add "left" or "right" in modal parent div, after class="modal".
    * Get free snippets on bootpen.com
    *******************************/

    .modal.left .modal-dialog,
    .modal.right .modal-dialog {
    position: fixed;
    margin: auto;
    width: 30%;
    height: 100%;
    -webkit-transform: translate3d(0%, 0, 0);
    -ms-transform: translate3d(0%, 0, 0);
    -o-transform: translate3d(0%, 0, 0);
    transform: translate3d(0%, 0, 0);
    }

    .modal.left .modal-content,
    .modal.right .modal-content {
    height: 100%;
    overflow-y: auto;
    }

    .modal.left .modal-body,
    .modal.right .modal-body {
    padding: 15px 15px 80px;
    }


    /*Left*/

    .modal.left.fade .modal-dialog {
    left: 0px;
    -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
    -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
    -o-transition: opacity 0.3s linear, left 0.3s ease-out;
    transition: opacity 0.3s linear, left 0.3s ease-out;
    }

    .modal.left.fade.in .modal-dialog {
    left: 0;
    }


    /*Right*/

    .modal.right.fade .modal-dialog {
    right: -320px;
    -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
    -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
    -o-transition: opacity 0.3s linear, right 0.3s ease-out;
    transition: opacity 0.3s linear, right 0.3s ease-out;
    }

    .modal.right.fade.in .modal-dialog {
    right: 0;
    }


    /* ----- MODAL STYLE ----- */

    .modal-content {
    border-radius: 0;
    border: none;
    }

    .modal-header {
    border-bottom-color: #EEEEEE;
    background-color: #FAFAFA;
    }

    .modal-backdrop {
    background-color: transparent;
    display: none;
    }

    .modal {
    pointer-events: none;
    z-index: 10000000000000;
    }

    .modal-content {
    pointer-events: auto;
    }

</style>