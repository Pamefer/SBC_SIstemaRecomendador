<!DOCTYPE html>
<html lang="en">

<head>

     <meta charset="utf-8"><meta charset="UTF-8">
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
<input type="text" id="keywords" name="keywords" size="15" maxlength="15" minlength="4">
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
    <br><br><br><br><br><br><br><br><br>


<?php
//Si se ha pulsado el botón de buscar
if (isset($_POST['search'])) {
    //Recogemos las claves enviadas
    $keywords = $_POST['keywords'];
   
}
?>

<?php
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
require_once( "sparqllib.php" );

$db = sparql_connect( "http://localhost:8890/sparql" );
if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }

sparql_ns( "foaf","http://xmlns.com/foaf/0.1/" );
#sparql_ns("rdf", "http://www.w3.org/1999/02/22-rdf-syntax-ns#");
#sparql_ns("rdfs", "http://www.w3.org/2000/01/rdf-schema#");

$sparql = "select ?recurso ?descripcion where {?recurso ?b ?descripcion .FILTER regex(?descripcion , '$keywords')}limit 1000";

$result = sparql_query( $sparql ); 
$fields = sparql_field_array( $result );

print "<h4>Number of rows: ".sparql_num_rows( $result )." results.</h4>";
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
         echo utf8_decode("<td>".$row[$field]."</td>");
        
    }
    print "</tr>";
}
print "</table>";

?>