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
      <link href="css/estilos.css" rel="stylesheet">
      <script src="../release/go.js"></script>


  <!-- Custom Fonts -->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

  <!-- Theme CSS -->
  <link href="css/agency.min.css" rel="stylesheet">

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
            <div style="text-align:right;" >
                <ul class="nav navbar-nav navbar-left" >

                    <li>
                        <a class="page-scroll" href="momento.php">Lo del Momento</a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Recursos<b class="caret"></b></a>
                        <ul class="dropdown-menu" style="background-color:#2e2e2e">
                          <li class="active"><a href="recursoHotelero.php">Recurso Hotelero</a></li>
                          <li ><a href="recursoComercial.php">Recurso Comercial</a></li>
                          <li ><a href="recursoTuristico.php">Recurso Turístico</a></li>
                         </ul>
                    </li>

                    <li>
                        <a class="page-scroll" href="sparql.php">Sparql</a>
                    </li>

                </ul>
                <ul >
                  <div id=cajon class="col-lg-3">
                    <form action="bus.php" method="POST">
                      <div  class="input-group">
                        <span class="input-group-btn">
                          <button  type="submit" name="search" id="search" class="btn btn-default" type="button" >Buscar</button>
                        </span>
                        <input type="text" class="form-control" id="keywords" name="keywords" size="15" maxlength="30"  minlength="4" placeholder="Search for...">
                      </div><!-- /input-group -->
                      </form>
                      </div><!-- /.row -->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <section id="bloqueind">
    <h3 style="text-align:center">Resultados de la búsqueda</h3>
<?php
//Si se ha pulsado el botón de buscar
if (isset($_POST['search'])) {
    //Recogemos las claves enviadas
    $keywords = $_POST['keywords'];

}
?>

<?php

require_once( "sparqllib.php" );

$db = sparql_connect( "http://localhost:8890/sparql" );
if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }

sparql_ns( "foaf","http://xmlns.com/foaf/0.1/" );
#sparql_ns("rdf", "http://www.w3.org/1999/02/22-rdf-syntax-ns#");
#sparql_ns("rdfs", "http://www.w3.org/2000/01/rdf-schema#");

$sparql = "select ?recurso ?descripcion where {?recurso ?b ?descripcion .FILTER regex(?descripcion , '$keywords')}limit 1000";

$result = sparql_query( $sparql );
$fields = sparql_field_array( $result );

print "<div id='resul' class='alert alert-success' role='alert'>";
print "<a href='' class='alert-link'>Se han encontrado ".sparql_num_rows( $result )." resultados con la palabra ".$keywords."</a>";
print "</div>";
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

      echo utf8_decode("<td>.$row[$field].</td>");


    }
    print "</tr>";
}
print "</table>";

?>
</section>


    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha384-mE6eXfrb8jxl0rzJDBRanYqgBxtJ6Unn4/1F7q4xRRyIw7Vdg9jP4ycT7x1iVsgb" crossorigin="anonymous"></script>
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>
    <script src="js/agency.min.js"></script>
