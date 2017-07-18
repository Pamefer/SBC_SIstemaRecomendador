<?php
extract($_GET);
require_once( "sparqllib.php" );
?>
<?php
  //Realizamos la consulta a la tabla correspondiente
                  $datos2=array();
                  $data2 = sparql_get( "http://localhost:8890/sparql","select ?recurso ?a ?lat ?long ?nombre where {<http://idi.fundacionctic.org/cruzar/turismo#Recurso-turistico> ?b ?c.
                  filter(regex(?c, 'http://idi.fundacionctic.org/cruzar/turismo#' )).
                  ?recurso <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> ?c.
                  ?recurso <http://www.w3.org/2003/01/geo/wgs84_pos#lat> ?lat.
                  ?recurso <http://www.w3.org/2003/01/geo/wgs84_pos#long> ?long.
                  ?recurso <http://schema.org/name> ?nombre.
                  ?c <http://dbpedia.org/ontology/label> ?a
                  filter(regex(?recurso, '$trans' ))}" );
                  $marker_pintar = "";
                    foreach( $data2 as $row )
                        {
                        $datos2[]=array("nombre"=>$row["nombre"]);
                         $marker_pintar .= "['".$row["recurso"]."','".$row["lat"]."','".$row["long"]."','".$row["nombre"]."','".$row["a"]."'],";
                      }

                      //Consulta rating
                        $datos1=array();
                        $datos11=array();
                          $data2 = sparql_get( "http://localhost:8890/sparql","select ?recurso ?c ?nombre where {<http://idi.fundacionctic.org/cruzar/turismo#Recurso-turistico> ?b ?c.
            filter(regex(?c, 'http://idi.fundacionctic.org/cruzar/turismo#' )).
            ?recurso <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> ?c.

            ?recurso <http://schema.org/name> ?nombre.

                    }      " );
                        foreach( $data2 as $row )
                                  {

                                  $datos1[]=array("nombre"=>$row["nombre"]);
                                   $datos11[]=array("recurso"=>$row["recurso"]);
                                }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Turismo</title>
    <style>
      #map {
        height: 80%;
        width: 30%;
      }
      html, body {
        height:100%;
        margin: 0;
        padding: 0;
      }

    </style>

</head>

<body >

          <form>
              <select   class="form-control" action="action" name="trans" placeholder="Elije una ruta" onchange="this.form.submit()"  >
                <option value="<?php echo $trans?>" ><?php echo $datos2[0]["nombre"] ?></option>
                <?php  foreach($datos1 as $x => $x_value) {?>
                <option value="<?php echo $datos11[$x]["recurso"]?>"> <?php echo ($datos1[$x]["nombre"]);?>
                <?php     };?>
                </option>
            </select>
          </form>

    <div id="map">
    <script>
      var locations = [ <?php echo $marker_pintar; ?>];
      function initMap() {
        var marker, i
        var myLatLng = {lat: -4.120608, lng: -80.110460};
        var map = new google.maps.Map(document.getElementById('map'), {
          center: myLatLng,
          zoom: 8,
          styles: [
            {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
            {
              featureType: 'administrative.locality',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'poi',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'geometry',
              stylers: [{color: '#263c3f'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'labels.text.fill',
              stylers: [{color: '#6b9a76'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry',
              stylers: [{color: '#38414e'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry.stroke',
              stylers: [{color: '#212a37'}]
            },
            {
              featureType: 'road',
              elementType: 'labels.text.fill',
              stylers: [{color: '#9ca5b3'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry',
              stylers: [{color: '#746855'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry.stroke',
              stylers: [{color: '#1f2835'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'labels.text.fill',
              stylers: [{color: '#f3d19c'}]
            },
            {
              featureType: 'transit',
              elementType: 'geometry',
              stylers: [{color: '#2f3948'}]
            },
            {
              featureType: 'transit.station',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'water',
              elementType: 'geometry',
              stylers: [{color: '#17263c'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.fill',
              stylers: [{color: '#515c6d'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.stroke',
              stylers: [{color: '#17263c'}]
            }
          ]
        });
       setMarkers(map,locations)
      }

     function setMarkers(map,locations){

      var marker, i

      for (i = 0; i < locations.length; i++)
       {
           var loan = locations[i][0]
           var lat = locations[i][1]
           var long = locations[i][2]
           var add =  locations[i][3]
           var tipo =  locations[i][4]
           console.log(lat)


           latlngset = new google.maps.LatLng(lat, long);

            var marker = new google.maps.Marker({
                map: map, title: add , position: latlngset
            });
            map.setCenter(marker.getPosition())
            var content = "Nombre : " + add +  '</h3>' +'<br>'+ "Coordenadas: " + long  +   " , " +lat+'<br>'+ "Recurso: "+tipo

            var infowindow = new google.maps.InfoWindow()

            google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){
                return function() {
                    infowindow.setContent(content);
                     infowindow.open(map,marker);
                };
            })(marker,content,infowindow));

       }
  }
    </script>
</div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgDkVqIMYa2fLVyHujrOvRMysDydEBHNk&callback=initMap"
    async defer></script>
  </body>
</html>
