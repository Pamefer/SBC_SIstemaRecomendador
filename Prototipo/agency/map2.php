
<!DOCTYPE html>
<html>
  <head>
  <script src="js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/jquerymap.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDrCUKwFgLkNg3qE_4slKEsbw5JZZqMCmk"></script>
<!-- Custom Theme files -->
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
  <script type="text/javascript">
      jQuery(document).ready(function($) {
        $(".scroll").click(function(event){   
          event.preventDefault();
          $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
        });
      });
  </script>
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

                <div class="col-md-6 about-right">
           <div id="map-canvas" style="float:right; width:650px; height:650px " ></div>
                <div id="panel_ruta" style= "overflow: auto; width:650px; height: 200"></div>
        </div>
        <div class="clearfix"> </div>
      </div>
    </div>
  </div>
</div>

    </div>
  </div>
</div>
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
?recurso <http://www.w3.org/2003/01/geo/wgs84_pos#long> ?long} limit 1";
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
<script type="text/javascript">
var locations = [ <?php echo $marker_pintar; ?>
  ];
  function initialize() {
  var myLatlng = new google.maps.LatLng(-1.275599, -76.800350);
  var mapOptions = {
    zoom: 6,
    center: myLatlng
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    setMarkers(map,locations)
}
    google.maps.event.addDomListener(window, "load", initialize);

function setMarkers(map,locations){

      var marker, i

      for (i = 0; i < locations.length; i++)
       {  
           var loan = locations[i][0]
           var lat = locations[i][1]
           var long = locations[i][2]

         

           latlngset = new google.maps.LatLng(lat, long);

            var marker = new google.maps.Marker({  
                map: map, title: loan , position: latlngset  
            });
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

google.maps.event.addDomListener(window, 'load', initialize);
    var map;
    var directionsDisplay = new google.maps.DirectionsRenderer();
    var directionsService = new google.maps.DirectionsService();
    
    $(document).ready(function() {
        load_map();
    });
    
    function load_map() {
        var myLatlng = new google.maps.LatLng(-0.902132, -79.019588);
        var myOptions = {
            zoom: 1,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map($("#map_canvas").get(0), myOptions);
    }
    
    function rockAndRoll(){
        var request = {
                origin: $('#origen').val(),
                destination: $('#destino').val(),
                travelMode: google.maps.DirectionsTravelMode[$('#modo_viaje').val()],
                unitSystem: google.maps.DirectionsUnitSystem[$('#tipo_sistema').val()],
                provideRouteAlternatives: true
        };
        directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setMap(map);
                directionsDisplay.setPanel($("#panel_ruta").get(0));
                directionsDisplay.setDirections(response);
            } else {
                alert("No existen rutas entre ambos puntos");
            }
        });
    }
    
    $('#buscar').live('click', function(){
        rockAndRoll();
    });

    $('.opciones_ruta').live('change', function(){
        rockAndRoll();
    });

</script>


    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgDkVqIMYa2fLVyHujrOvRMysDydEBHNk&callback=initMap"
    async defer></script>




  </body>
</html>


