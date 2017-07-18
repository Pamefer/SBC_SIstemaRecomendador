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
    <script src="d3sparql.js"></script>
    <script src="https://d3js.org/d3.v3.min.js"></script>
    <link href="css/estilos.css" rel="stylesheet">

    <style>

    text.node {
      font-family: "sans-serif";
      font-size: 15px;
    }
    circle.node {
      stroke-width: 1px;
      fill: #DAA520;
    }


    </style>

    <script type="text/javascript">
      function exec() {
        var endpoint = d3.select("#endpoint").property("value")
        var sparql = d3.select("#sparql").property("value")
        d3sparql.query(endpoint, sparql, render)
      }
      function render(json) {
        var config = {
          "charge": -300,
          "distance": 500,
          "width": 1500,
          "height": 1000,
          "selector": "#result"
        }
        console.log(json);
        d3sparql.forcegraph(json, config)
      }

      function exec_offline() {
        d3.json("cache/dbpedia/proglang_pair.json", render)
      }
      function toggle() {
        d3sparql.toggle()
      }

    </script>
    <style>

      #nav{
        background: black;
        padding-top: -4%;
        margin-bottom: -10%;
      }

      #tabla{
        margin-left: 5%;
        width: 80%;
        margin-right: 5%;
      }
      th{
        background: black;
        color: white;
        width: 30%;
      }
      td{
width: 30%;
      }


        h1{
          text-align: center;
        }

        input{
          background: #E2E3E5;
          width: 33%;
        }
        textarea{
          width:100%;height:200px;border: 2px solid #990000;
          background: #E2E3E5;
        }

    </style>

</head>

<body id="page-top" class="index">

  <!-- Navigation -->
  <nav id="nav" class="navbar navbar-custom navbar-fixed-top">
      <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header page-scroll">

              <a class="navbar-brand page-scroll" href="index.php">System recommender - Loja Tourism</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div style="text-align:right;" >
              <ul class="nav navbar-nav navbar-left">

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
                      <input type="text" class="form-control" id="keywords" name="keywords" size="15" maxlength="30" minlength="4"  placeholder="Search for...">
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
    <div id="result"></div>
  <div id="query" style="margin: 10px">
  <form class="form-inline"  method="POST">
    <label>Ingresa tu consulta SPARQL:</label>
    <div class="input-append">
      <input type="hidden" id="endpoint" name="endpoint" class="span5" value="http://localhost:8890/sparql" type="text">
      <button class="btn" name="search" type="button" onclick="exec()">Buscar</button>
      <button class="btn" type="button" onclick="toggle()"><i id="button" class="icon-chevron-up"></i>Esconder/Mostrar</button>

    </div>
  </form>
  <textarea id="sparql" class="span9" rows=15>
    </textarea>



  </div>

</section>
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
