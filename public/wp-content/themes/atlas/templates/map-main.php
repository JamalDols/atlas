 <?php
          $arg = array( 'post_type' => 'lugar', 'posts_per_page' => 10,);
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
        // Create map instance
        var map = L.map('map',{
            center:[39.4697500, -0.3773900],
            zoom:14,
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



        for (let i = 1; i < 8; i++) {

            this["category"+i] = L.geoJson(geojsonData, {
                onEachFeature:function(feature, layer) {
                let content = '<span class="title">' + feature.properties.title + '</span>' +  '<span class="address">' + feature.properties.address + '</span>' +  '<a href="'+ feature.properties.url + '">' + 'Més informació' + '</a>';

                        layer.bindPopup(content);
                
                },
                pointToLayer:function(geoObj, latLng) {
                    return L.marker(latLng);
                
                },
                filter:function (feature,layer){
                    return feature.properties.category == "categoria" +i;  
                }

            });


        }

        var all = L.layerGroup([category1,category2,category3,category4,category5,category6,category7]);
        L.control.layers({
            "Tots":markers,
            "Refugis climàtics": category1,
            "Equipaments públics d'educació i informació ambiental": category2,
            "Escoles adherides a l'EAR, al 50/50 o amb programes de sostenibilitat": category3,
            "Elements públics de generació d'energia": category4,
            "Comunitats energètiques": category5,
            "Museus amb temàtica ambiental": category6,
            "Elements d'adaptació al canvi climàtic i l'efecte illa de calor": category7,
            
        }).addTo(map);
        markers.addLayer(all);
        markers.addTo(map);

        console.log(markers);

    </script>