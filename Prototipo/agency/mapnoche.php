<?php 
extract($_GET); 
require_once( "sparqllib.php" );
?>
<?php 

  //Realizamos la consulta a la tabla correspondiente
 
      // $datos2=array();
              $data2 = sparql_get( "http://localhost:8890/sparql","SELECT ?recurso ?lat ?long ?b WHERE { ?recurso <http://www.w3.org/1999/02/22-rdf-syntax-ns#type>  <http://idi.fundacionctic.org/cruzar/turismo#Entorno-natural> .
?recurso <http://www.w3.org/2003/01/geo/wgs84_pos#lat> ?lat.
?recurso <http://www.w3.org/2003/01/geo/wgs84_pos#long> ?long.
?b <http://www.w3.org/2003/01/geo/wgs84_pos#long> ?long}" );
$marker_pintar = ""; 
              foreach( $data2 as $row )
                        {
                                        
                       // $datos2[]=array("np"=>$row["np"]);
                         $marker_pintar .= "['".$row["recurso"]."','".$row["lat"]."','".$row["long"]."','".$row["b"]."'],";
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

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Theme CSS -->
    <link href="css/agency.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js" integrity="sha384-0s5Pv64cNZJieYFkXYOTId2HMA2Lfb6q2nAcx2n0RTLUnCAoTTsS0nKEO27XyKcY" crossorigin="anonymous"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js" integrity="sha384-ZoaMbDF+4LeFxg6WdScQ9nnR1QC2MIRxA1O9KWEXQwns1G8UNyIEZIQidzb0T1fo" crossorigin="anonymous"></script>
    <![endif]-->
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 80%;
        width: 50%;
        margin-left: 60%;
        margin-top:2%;

      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height:100%;
        margin: 0;
        padding: 0;
      }
      #nav{
        background: black;
        padding-top: -4%;
        margin-bottom: -10%;
      }
    </style>

</head>

<body id="page-top" class="index">

       <nav id="nav" class="navbar navbar-custom navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                
                <a class="navbar-brand page-scroll" href="#page-top">System recommender - Loja Tourism</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div >
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="lugar.php">Buscar Lugar - Actividad</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="momento.php">Lo del Momento</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">Ellos recomiendan</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="mapnoche.php">Te puede interesar</a>
                    </li>
                    <li>
                       <form action="bus.php" method="POST">
<input type="text" id="keywords" name="keywords" size="15" maxlength="15">
<input type="submit" name="search" id="search" value="Buscar">
</form>
                    </li>
                    <li>
                        <a class="page-scroll" href="sparql.php">Sparql</a>
                    </li>
                </ul>
            </div>
        <!-- /.container-fluid -->
    </nav>
    <br><br><br><br><br><br><br><br>
<h3>Mapa de Lugares Turísticos</h3>
    <div id="map">
    <script>
var locations = [ <?php echo $marker_pintar; ?>];
      function initMap() {
        var marker, i
        // Styles a map in night mode.

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
           var lat = locations[i][2]
           var long = locations[i][1]
           var add =  locations[i][3]
           //var img =  locations[i][4]
           console.log(lat)
           

           latlngset = new google.maps.LatLng(lat, long);

            var marker = new google.maps.Marker({  
                map: map, title: loan , position: latlngset  
            });
            map.setCenter(marker.getPosition())
            var content = "Nombre : " + loan +  '</h3>' +'<br>'+ "Coordenadas: " + long  +   " , " +lat

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


