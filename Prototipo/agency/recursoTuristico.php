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
    <link href="css/estilos.css" rel="stylesheet">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
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

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <section id="services">
        <div class="container">
            <div id="buscador" class="row">
                <div id=bu class="col-lg-8 text-right">

                    <h2 align="left" class="section-heading">Buscar Lugar</h2>
                    <h3 align="left" class="section-subheading text-muted">Selecciona un tipo de recurso turistico.</h3>

                  </div>
                  <div id=cajon class="col-lg-4 text-left">
                    <form action="bus.php" method="POST">
                      <div  class="input-group">
                        <span class="input-group-btn">
                          <button  type="submit" name="search" id="search" class="btn btn-default" type="button" >Buscar</button>
                        </span>
                        <input type="text" class="form-control" id="keywords" name="keywords" size="15" maxlength="30"  placeholder="Search for...">
                      </div><!-- /input-group -->
                      </form>
                      </div><!-- /.row -->
                  </div>
                </div>
        </div>
    </section>
<?php
require_once( "sparqllib.php" );
$db = sparql_connect( "http://localhost:8890/sparql" );
if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
sparql_ns( "foaf","http://xmlns.com/foaf/0.1/" );

$sparql6 = "SELECT (count(*) as ?a) WHERE { ?a <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://idi.fundacionctic.org/cruzar/turismo#Museo> }";
$result6 = sparql_query( $sparql6 );
$fields6 = sparql_field_array( $result6 );
while( $row = sparql_fetch_array( $result6 ) )
{
    foreach( $fields6 as $field )
    {
        $p = (int)$row[$field];
    }
}
$sparql2 = "SELECT (count(*) as ?a) WHERE { ?a <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://idi.fundacionctic.org/cruzar/turismo#Entorno-natural> }";
$result2 = sparql_query( $sparql2 );
$fields2 = sparql_field_array( $result2 );
while( $row2 = sparql_fetch_array( $result2 ) )
{
    foreach( $fields2 as $field2 )
    {
        $b = (int)$row2[$field2];
    }
}
$sparql3 = "SELECT (count(*) as ?a) WHERE { ?a <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://idi.fundacionctic.org/cruzar/turismo#Edificio-religioso> }";
$result3 = sparql_query( $sparql3 );
$fields3 = sparql_field_array( $result3 );
while( $row3 = sparql_fetch_array( $result3 ) )
{
    foreach( $fields3 as $field3 )
    {
        $c = (int)$row3[$field3];

    }
}

$sparql4 = "SELECT (count(*) as ?a) WHERE { ?a <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://idi.fundacionctic.org/cruzar/turismo#Edificio-historico> }";
$result4 = sparql_query( $sparql4 );
$fields4 = sparql_field_array( $result4 );
while( $row4 = sparql_fetch_array( $result4 ) )
{
    foreach( $fields4 as $field4 )
    {
        $d = (int)$row4[$field4];
    }
}

 ?>

<section id="bloque">
  <nav id="izq" class="navbar navbar-default sidebar" role="navigation">
  <div class="container-fluid">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  </div>
  <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li ><a href="recursoHotelero.php">Recurso Hotelero<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
      <li ><a href="recursoComercial.php">Recurso Comercial<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a></li>
      <li class="active"><a href="recursoTuristico.php">Recurso Turístico<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tags"></span></a></li>
    </ul>
  </div>
</div>
</nav>


<?php
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



<div id="tabla1">
  <form>
<select   class="form-control" action="action" name="trans" placeholder="Elije una ruta" onchange="this.form.submit()"  >
     <option value="<?php echo $trans?>" ><?php echo $datos2[0]["nombre"] ?></option>


<?php  foreach($datos1 as $x => $x_value) {?>
<option value="<?php echo $datos11[$x]["recurso"]?>"> <?php echo ($datos1[$x]["nombre"]);?>
<?php     };?>
</option>
</select>
</form>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgDkVqIMYa2fLVyHujrOvRMysDydEBHNk&callback=initMap"
async defer></script>
</div>

  <div class="modal fade" id="resul" role="dialog">
     <div class="modal-dialog">
         <div class="modal-content">
             <form  method="post" name="frestaurante" action="guardar-restaurantes.php" class="form-horizontal" role="form">
                 <div class="modal-header" id="jumbo" >
                     <h4>Recurso Hotelero<h4>
                 </div>
                 <div class="modal-body">
                   <div class="form-group" style="margin-left:0;">
                          <label for="contact-name" class="col-sm-2 control-label" id="eti" >Nombre</label>
                          <div class="col-sm-10">
                              <input type="text" id="hotelname" class="form-control" name="restauname">
                          </div>
                      </div>
                      <div class="form-group" style="margin-left:-3px;" >
                          <label for="contact-email" class="col-sm-2 control-label" id="eti">Dirección</label>
                          <div class="col-sm-10">
                              <input  class="form-control"  name="direccion">
                          </div>
                      </div>
                    <?php echo "ji" ?>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrrar</button>
                 </div>
             </form>
         </div>
     </div>
  </div>
<aside id="infos">
  <div class="panel panel-info">
    <div class=panel-heading>
      <h3 class=panel-title> Ontología</h3>
    </div>
  <div class=panel-body>
  </div>
  </div>
  <div id="grafica" class="panel panel-info">
    <div class=panel-heading>
      <h3 class=panel-title> Estadísticas</h3>
    </div>
  <div class=panel-body>
    <div id="container" style="min-width: 330px; height: 270px; max-width: 50px; padding: 0px 0px 0px 0px"></div>

  </div>
  </div>
</aside>
</section>


    <!-- About Section -->

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha384-mE6eXfrb8jxl0rzJDBRanYqgBxtJ6Unn4/1F7q4xRRyIw7Vdg9jP4ycT7x1iVsgb" crossorigin="anonymous"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/agency.min.js"></script>

</body>
<script type="text/javascript">
  //Primer chart
  // Radialize the colors
  Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
      return {
          radialGradient: {
              cx: 0.5,
              cy: 0.3,
              r: 0.7
          },
          stops: [
              [0, color],
              [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
          ]
      };
  });

  // Build the chart
  Highcharts.chart('container', {
      chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false,
          type: 'pie',
          margin: [0, 0, 0, 0],
          padding: [0, 0, 0, 0]
      },
      navigation: {
      buttonOptions: {
        enabled: false
        }
      },
      title: {
          text: 'Recursos Turísticos'
      },
      tooltip: {
          pointFormat: '{series.name}: <b>  {point.y} </b>'
      },
      plotOptions: {
          pie: {
              allowPointSelect: true,
              cursor: 'pointer',
              dataLabels: {
                  enabled: true,
                  format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                  style: {
                      color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                  },
                  connectorColor: 'silver'
              }
          }
      },
      series: [{
          name: 'Total',
          data: [
              { name: 'Museos', y: <?php echo $p ?> },
              { name: 'Entornos Naturales', y: <?php echo $b ?> },
              { name: 'Edificios Religiosos', y:<?php echo $c ?> },
              { name: 'Edificios Historicos', y: <?php echo $d ?> }

          ]
      }]
  });


            </script>

</html>