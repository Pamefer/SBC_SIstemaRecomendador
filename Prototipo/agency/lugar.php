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

</head>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #nav{
        background: black;
        padding-top: -4%;
        margin-bottom: -10%;


      }

      #tabla{
        margin-left: 10%;
        margin-right: 10%;
      }
      th{
        background: black;
        color: white;
      }
    </style>
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
                    <li>
                       <form action="bus.php" method="POST">
<input type="text" id="keywords" name="keywords" size="15" maxlength="15"  minlength="4">
<input type="submit" name="search" id="search" value="Buscar">
</form>
                    </li>
                    <li>
                        <a class="page-scroll" href="sparql.php">Sparql</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <br><br><br><br><br>

            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script src="https://code.highcharts.com/modules/exporting.js"></script>

<section id="Portfolio" class="bg-darkest-gray>




            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script src="https://code.highcharts.com/modules/exporting.js"></script>

            <?php
                //SELECT (count(*) as ?a) WHERE { ?a <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://idi.fundacionctic.org/cruzar/turismo#Museo> }
                //SELECT (count(*) as ?a) WHERE { ?a <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://idi.fundacionctic.org/cruzar/turismo#Edificio-historico> }
                //SELECT (count(*) as ?a) WHERE { ?a <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://idi.fundacionctic.org/cruzar/turismo#Edificio-religioso> }
                //SELECT (count(*) as ?a) WHERE { ?a <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://idi.fundacionctic.org/cruzar/turismo#Entorno-natural> }
                //http://localhost:8890/spaturismo



                require_once( "sparqllib.php" );
                $db = sparql_connect( "http://localhost:8890/sparql" );
                if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
                sparql_ns( "foaf","http://xmlns.com/foaf/0.1/" );

                $sparql = "SELECT (count(*) as ?a) WHERE { ?a <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://idi.fundacionctic.org/cruzar/turismo#Museo> }";
                $result = sparql_query( $sparql );
                $fields = sparql_field_array( $result );
                while( $row = sparql_fetch_array( $result ) )
                {
                    foreach( $fields as $field )
                    {
                        $a = (int)$row[$field];
                        $pila=array($a);
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
                        array_push($pila, $b);
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
                        array_push($pila, $c);

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
                        array_push($pila, $d);

                    }
                }

                $sparql5 = "SELECT (count(*) as ?a) WHERE { ?a <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://www.disit.org/km4city/schema#Hotel> }";
                $result5 = sparql_query( $sparql5 );
                $fields5 = sparql_field_array( $result5 );
                while( $row5 = sparql_fetch_array( $result5 ) )
                {
                    foreach( $fields5 as $field5 )
                    {
                        $e = (int)$row5[$field5];
                    }
                }

                $sparql6 = "SELECT (count(*) as ?a) WHERE { ?a <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://idi.fundacionctic.org/cruzar/turismo#Hostel> }";
                $result6 = sparql_query( $sparql6 );
                $fields6 = sparql_field_array( $result6 );
                while( $row6 = sparql_fetch_array( $result6 ) )
                {
                    foreach( $fields6 as $field6 )
                    {
                        $f = (int)$row6[$field6];
                    }
                }





              ?>


              <div id="container" style="min-width: 500px; height: 300px; max-width: 600px; margin: 0px 100px 0px 10px"></div>
              <div id="container2" style="min-width: 310px; height: 300px; max-width: 600px; margin: 0px 0px 0px 600px"></div>

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
                      type: 'pie'
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
                          { name: 'Museos', y: <?php echo $a ?> },
                          { name: 'Entornos Naturales', y: <?php echo $b ?> },
                          { name: 'Edificios Religiosos', y:<?php echo $c ?> },
                          { name: 'Edificios Historicos', y: <?php echo $d ?> }

                      ]
                  }]
              });


              //Segundo chart
              Highcharts.chart('container2', {
              chart: {
                  plotBackgroundColor: null,
                  plotBorderWidth: 0,
                  plotShadow: false
              },
              title: {
                  text: 'Recurso<br>Hotelero<br>Loja',
                  align: 'center',
                  verticalAlign: 'middle',
                  y: 40
              },

              plotOptions: {
                  pie: {
                      dataLabels: {
                          enabled: true,
                          distance: -50,
                          style: {
                              fontWeight: 'bold',
                              color: 'white'
                          }
                      },
                      startAngle: -90,
                      endAngle: 90,
                      center: ['50%', '75%']
                  }
              },
              series: [{
                  type: 'pie',
                  name: 'Total',
                  innerSize: '50%',
                  data: [
                      ['Hotel',   <?php echo $e ?>],
                      ['Hostal',       <?php echo $f ?>],
                      {

                      }
                  ]
              }]
          });


          </script>

          
            </div>
        </div>
    </section>










    <!-- Header -->
            <?php

require_once( "sparqllib.php" );

$db = sparql_connect( "http://localhost:8890/sparql" );
if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }

sparql_ns( "foaf","http://xmlns.com/foaf/0.1/" );
#sparql_ns("rdf", "http://www.w3.org/1999/02/22-rdf-syntax-ns#");
#sparql_ns("rdfs", "http://www.w3.org/2000/01/rdf-schema#");

$sparql = "SELECT  ?tittle  ?a WHERE { ?x <http://dbpedia.org/ontology/label> ?tittle.
?a <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://idi.fundacionctic.org/cruzar/turismo#Museo>
 }";
$result = sparql_query( $sparql ); 
$fields = sparql_field_array( $result );

print "<p>Number of rows: ".sparql_num_rows( $result )." results.</p>";
print "<table id='tabla' border=1>";
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
        
            </div>
        </div>
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

</html>
