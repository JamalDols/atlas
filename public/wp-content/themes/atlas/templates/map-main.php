 <?php
          $arg = array( 'post_type' => 'lugar', 'posts_per_page' => 1000,);
          $loop = new WP_Query( $arg );
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
    <script>
        var data = <?php echo $json ?>;
        var map = L.map('map',{
            center:[39.4697500, -0.3773900],
            zoom:13,
            zoomControl: false
        });
        L.control.zoom({
          position: 'bottomright'
        }).addTo(map);

L.tileLayer('https://api.mapbox.com/styles/v1/jamaldols/ckg95x9iu77ew1apgpekvc9j3/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1IjoiamFtYWxkb2xzIiwiYSI6ImNrYmF2bGowOTBycGEyeG84b2F2NGlsYWkifQ.9rqymFnsW79aCkAFGCo0XQ', {
attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
maxZoom: 18,
tileSize: 512,
zoomOffset: -1,
}).addTo(map);

        var markers=L.markerClusterGroup();
        let geojsonData = createGeoJson(data);

        function createGeoJson(data) {
            var geojson = {
                "type":"FeatureCollection",
                "features":[

                ]
            };

            data.forEach(element => {
                let marker = L.marker([element.Latitude, element.Longitude]);
                let pntGeojson = marker.toGeoJSON();

                pntGeojson.properties = element;
                geojson.features.push(pntGeojson);
            });

            return geojson;
        }


  
        var categorynone = L.geoJson(geojsonData, {
            onEachFeature:function(feature, layer) {
              let content = '<span class="title">' + feature.properties.title + '</span>' +  '<span class="address">' + feature.properties.address + '</span>' +  '<a href="'+ feature.properties.url + '">' + 'Més informació' + '</a>';
                layer.bindPopup(content);
            },
            pointToLayer:function(geoObj, latLng) {
                return L.marker(latLng);
              
            },
            filter:function (feature,layer){
                return feature.properties.category == "";  
            }

        });



        for (let i = 1; i < 8; i++) {

            let markerIcon = L.icon({
                
                iconUrl: "<?php echo esc_url( get_stylesheet_directory_uri() . '/dist/images/leaflet/ico-category-' ); ?>" + i + '.png',
                iconSize:     [25, 41], 
                iconAnchor:   [12, 41], 
                popupAnchor:  [0, -41] 

            });


            
            this["category"+i] = L.geoJson(geojsonData, {
                onEachFeature:function(feature, layer) {
                    <?php if(ICL_LANGUAGE_CODE=='ca'): ?>
                        let content = '<span class="title">' + feature.properties.title + '</span>' +  '<span class="address">' + feature.properties.address + '</span>' +  '<a href="'+ feature.properties.url + '">' + 'Més informació' + '</a>';
                        layer.bindPopup(content);    
                    <?php elseif(ICL_LANGUAGE_CODE=='es'): ?>
                        let content = '<span class="title">' + feature.properties.title + '</span>' +  '<span class="address">' + feature.properties.address + '</span>' +  '<a href="'+ feature.properties.url + '">' + 'Más información' + '</a>';
                        layer.bindPopup(content);    
                    <?php endif;?>  
                
                
                },
                pointToLayer:function(geoObj, latLng) {
                    return L.marker(latLng, {icon: markerIcon});
                    // return L.marker(latLng);
                
                },
                filter:function (feature,layer){
                    return feature.properties.category == "categoria" +i;  
                }

            });


        }



        <?php if(ICL_LANGUAGE_CODE=='ca'): ?>
            var all = L.layerGroup([category1,category2,category3,category4,category5,category6,category7]);
        L.control.layers({
            "Tots":markers,
            "<span class='cat-list category1'></span>Refugis climàtics": category1,
            "<span class='cat-list category2'></span>Equipaments públics d'educació i informació ambiental": category2,
            "<span class='cat-list category3'></span>Escoles adherides a l'EAR, al 50/50 o amb programes de sostenibilitat": category3,
            "<span class='cat-list category4'></span>Elements públics de generació d'energia": category4,
            "<span class='cat-list category5'></span>Comunitats energètiques": category5,
            "<span class='cat-list category6'></span>Museus amb temàtica ambiental": category6,
            "<span class='cat-list category7'></span>Elements d'adaptació al canvi climàtic i l'efecte illa de calor": category7,
            
        }).addTo(map);
        <?php elseif(ICL_LANGUAGE_CODE=='es'): ?>
            var all = L.layerGroup([category1,category2,category3,category4,category5,category6,category7]);
        L.control.layers({
            "Todos":markers,
            "<span class='cat-list category1'></span>Refugios climáticos": category1,
            "<span class='cat-list category2'></span>Equipamientos públicos de educación e información ambiental": category2,
            "<span class='cat-list category3'></span>Escuelas adheridas al EAR, al 50/50 o con programas de sostenibilidad": category3,
            "<span class='cat-list category4'></span>Elementos públicos de genereación de energia": category4,
            "<span class='cat-list category5'></span>Comunidades energéticas": category5,
            "<span class='cat-list category6'></span>Museos con temática ambiental": category6,
            "<span class='cat-list category7'></span>Elementos de adaptación al cambio climático y el efecto isla de calor": category7,
            
        }).addTo(map);
        <?php endif;?>  



        markers.addLayer(all);
        markers.addTo(map);

        console.log(markers);

    </script>