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
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">System recommender - Loja Tourism</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="" id="bs-example-navbar-collapse-1">
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
                        <a class="page-scroll" href="#team">Te puede interesar</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Login</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->


    <!-- Portfolio Grid Section -->
    <section id="Portfolio" class="bg-darkest-gray>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Estadísticas</h2>
                    <h3 class="section-subheading text-muted">Esto es lo más sonado este día en Loja</h3>
                </div>
            </div>




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

                $sparql7 = "SELECT (count(*) as ?a) WHERE { ?a <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://schema.org/CafeOrCoffeeShop> }";
                $result7 = sparql_query( $sparql7 );
                $fields7 = sparql_field_array( $result7 );
                while( $row7 = sparql_fetch_array( $result7 ) )
                {
                    foreach( $fields7 as $field7 )
                    {
                        $g = (int)$row7[$field7];
                        print $g;
                    }
                }

                $sparql8 = "SELECT (count(*) as ?a) WHERE { ?a <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://www.disit.org/km4city/schema#Restaurant> }";
                $result8 = sparql_query( $sparql8 );
                $fields8 = sparql_field_array( $result8 );
                while( $row8 = sparql_fetch_array( $result8 ) )
                {
                    foreach( $fields8 as $field8 )
                    {
                        $h = (int)$row8[$field8];
                          print $h;
                    }
                }

                $sparql9 = "SELECT (count(*) as ?a) WHERE { ?a <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://www.disit.org/km4city/schema#Discotheque> }";
                $result9 = sparql_query( $sparql9 );
                $fields9 = sparql_field_array( $result9 );
                while( $row9 = sparql_fetch_array( $result9 ) )
                {
                    foreach( $fields9 as $field9 )
                    {
                        $i = (int)$row9[$field9];
                          print $i;
                    }
                }

                $sparql10 = "SELECT (count(*) as ?a) WHERE { ?a <http://www.w3.org/1999/02/22-rdf-syntax-ns#type>  <http://www.disit.org/km4city/schema#Bar> }";
                $result10 = sparql_query( $sparql10 );
                $fields10 = sparql_field_array( $result10 );
                while( $row10 = sparql_fetch_array( $result10 ) )
                {
                    foreach( $fields10 as $field10 )
                    {
                        $j = (int)$row10[$field10];
                          print $j;
                    }
                }


              ?>



              <div id="container3" style="min-width: 500px; height: 300px; max-width: 600px; margin: 0px 100px 0px 10px"></div>
            <script type="text/javascript">
              //Tercer chart
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
              Highcharts.chart('container3', {
                  chart: {
                      plotBackgroundColor: null,
                      plotBorderWidth: null,
                      plotShadow: false,
                      type: 'pie'
                  },
                  title: {
                      text: 'Recurso Comercial'
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
                          { name: 'Cafetería', y: <?php echo $g ?> },
                          { name: 'Restaurante', y: <?php echo $h ?> },
                          { name: 'Discoteca', y:<?php echo $i ?> },
                          { name: 'Bar', y: <?php echo $j ?> }

                      ]
                  }]
              });

            </script>
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
