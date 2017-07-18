
<!DOCTYPE html>
<html>
  <head>
    <title>Styled Maps - Night Mode</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <?php

$datos2=array();
$marker_pintar = ""; 
require_once( "sparqllib.php" );

$db = sparql_connect( "http://localhost:8890/sparql" );
if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }

sparql_ns( "foaf","http://xmlns.com/foaf/0.1/" );
#sparql_ns("rdf", "http://www.w3.org/1999/02/22-rdf-syntax-ns#");
#sparql_ns("rdfs", "http://www.w3.org/2000/01/rdf-schema#");

$sparql = "SELECT ?recurso ?lat ?long WHERE { ?recurso <http://www.w3.org/1999/02/22-rdf-syntax-ns#type>  <http://idi.fundacionctic.org/cruzar/turismo#Entorno-natural> .
?recurso <http://www.w3.org/2003/01/geo/wgs84_pos#lat> ?lat.
?recurso <http://www.w3.org/2003/01/geo/wgs84_pos#long> ?long} ";
#$sparql = "SELECT ?a WHERE { ?x <http://schema.org/name> ?a FILTER regex(?a, "museo")}"
$result = sparql_query( $sparql ); 
$fields = sparql_field_array( $result );

foreach( $sparql as $row )
                        {

                          $marker_pintar .= "['".$row["recurso"]."','".$row["long"]."','".$row["lat"]."'],";
                        }

print "<p>Number of rows: ".sparql_num_rows( $result )." results.</p>";
print "<table class='example_table'>";
print "<tr>";

foreach( $fields as $field )
{
    print "<th>$field</th>";
}
print "</tr>";
while( $row = sparql_fetch_array( $result ) )
{
    print "<tr>";
    foreach( $fields as $field )
    {
        print "<td>$row[$field]</td>";
    }
    print "</tr>";
}
print "</table>";
?>
  <body>
    <div id="map"></div>
    <script>
var locations = [ <?php echo $marker_pintar; ?>];
      function initMap() {
        var marker, i
        // Styles a map in night mode.

        var myLatLng = {lat: -4.120608, lng: -80.110460};
        var map = new google.maps.Map(document.getElementById('map'), {
          center: myLatLng,
          zoom: 4,
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
       // var marker = new google.maps.Marker({
        //  position: myLatLng,
         // map: map,
         // title: 'Hello World!'
       // });
       setMarkers(map,locations)
      }

      function setMarkers(map,locations){

      var marker, i

      for (i = 0; i < locations.length; i++)
       {  
           var loan = locations[i][0]
           var lat = locations[i][1]
           var long = locations[i][2]

         

           latlngset = new google.maps.LatLng(lat, long);

            var marker = new google.maps.Marker({  
                map: map, title: loan , position: latlngset  });
            map.setCenter(marker.getPosition())
            var content = "Nombre  " + loan +  '</h3>' +'<br>'   

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

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgDkVqIMYa2fLVyHujrOvRMysDydEBHNk&callback=initMap"
    async defer></script>




  </body>
</html>


