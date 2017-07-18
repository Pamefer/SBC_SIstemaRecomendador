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

<body id="page-top" class="index" onload="init()">

    <!-- Navigation -->
    <nav id="nav" class="navbar navbar-custom navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">

                <a class="navbar-brand page-scroll" href="index.php">System recommender - Loja Tourism</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div style="text-align:right;" >
                <ul class="nav navbar-nav navbar-left" style=" margin-left:100px;">

                    <li>
                        <a class="page-scroll" href="momento.php">Lo del Momento</a>
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
                        <input type="text" class="form-control" id="keywords" name="keywords" size="15" maxlength="30" minlength="4" placeholder="Search for...">
                      </div><!-- /input-group -->
                      </form>
                      </div><!-- /.row -->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>


<?php
require_once( "sparqllib.php" );
$db = sparql_connect( "http://localhost:8890/sparql" );
if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
sparql_ns( "foaf","http://xmlns.com/foaf/0.1/" );

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

<section id="bloqueind">
  <h2>Recurso Comercial</h2>

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
      <li class="active"><a href="recursoComercial.php">Recurso Comercial<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a></li>
      <li ><a href="recursoTuristico.php">Recurso Turístico<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tags"></span></a></li>
    </ul>
  </div>
</div>
</nav>
<div id="tabla1" class="panel panel-default">

  <?php
      $datoshot2=array();
      $datos11=array();
      $data2 = sparql_get( "http://localhost:8890/sparql","select distinct ?c ?d where {{<http://idi.fundacionctic.org/cruzar/turismo#Recurso-comercial> ?b ?c.
filter(regex(?c, 'http://www.disit.org/km4city/schema#')).
?c <http://dbpedia.org/ontology/label> ?d} UNION {
?a <http://turismoloja.sbc/schema/hasCafeOrCoffeeShop> ?c .
?c <http://dbpedia.org/ontology/label> ?d}
}
" );
    foreach( $data2 as $row ){ $datoshot2[]=array("d"=>$row["d"]); }
              ?>
            <form>
              <select   class="form-control" action="action" name="trans" id="trans" placeholder="Elije una ruta" onchange="this.form.submit()"  >
                  <option value="<?php $trans=null; echo $trans?>" >Tipo de recurso comercial...</option>
                      <?php  foreach($datoshot2 as $x => $x_value) {?>
                          <option value="<?php echo $datoshot2[$x]["d"]?>"> <?php echo ($datoshot2[$x]["d"]);?>
    <?php     };?>
              </select>
            <form>
  <br>

  <div class="panel panel-default">
    <div class="panel-heading">Recursos</div>

      <table class="table">
        <?php
          extract($_GET);
            $sparql = "select DISTINCT ?d ?e where{?a ?b ?c.
Filter(regex(?c,'$trans')).
?a <http://schema.org/name> ?d.
?a <http://dbpedia.org/ontology/location> ?e
}";
            $result = sparql_query( $sparql );
            $fields = sparql_field_array( $result );
            while( $row = sparql_fetch_array( $result ) )
            {
                print "<tr>";
                foreach( $fields as $field )
                {
                  $a='';
                  print "<td>$row[$field]</td>";

                  }
                print "</tr>";
            }
         ?>

      </table>
    </div>
  </div>



  <aside id="infos">
  <div  class="panel panel-info">
    <div class=panel-heading>
      <h3 class=panel-title> Estadísticas</h3>
    </div>
  <div class=panel-body>
    <div id="container3" style="min-width: 330px; height: 270px; max-width: 50px; padding: 0px 0px 0px 0px"></div>

  </div>
  </div>
  <div class="panel panel-info">
    <div class=panel-heading>
      <h3 class=panel-title> Ontología</h3>
    </div>
  <div class=panel-body>
       <div id="sample">
        <div id="myDiagramDiv" style="background-color: white; border: solid 1px; border-color: red; width: 100%; height: 300px"></div>
      </div>
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
                          { name: 'Cafeteria', y: <?php echo $g ?> },
                          { name: 'Restaurante', y: <?php echo $h ?> },
                          { name: 'Discoteca', y:<?php echo $i ?> },
                          { name: 'Bar', y: <?php echo $j ?> }

                      ]
                  }]
              });

            </script>
            <script src="../release/go.js"></script>
            <script id="code">
              // This variation on ForceDirectedLayout does not move any selected Nodes
              // but does move all other nodes (vertexes).
              function ContinuousForceDirectedLayout() {
                go.ForceDirectedLayout.call(this);
                this._isObserving = false;
              }
              go.Diagram.inherit(ContinuousForceDirectedLayout, go.ForceDirectedLayout);

              /** @override */
              ContinuousForceDirectedLayout.prototype.isFixed = function(v) {
                return v.node.isSelected;
              }

              // optimization: reuse the ForceDirectedNetwork rather than re-create it each time
              /** @override */
              ContinuousForceDirectedLayout.prototype.doLayout = function(coll) {
                if (!this._isObserving) {
                  this._isObserving = true;
                  // cacheing the network means we need to recreate it if nodes or links have been added or removed or relinked,
                  // so we need to track structural model changes to discard the saved network.
                  var lay = this;
                  this.diagram.addModelChangedListener(function (e) {
                    // modelChanges include a few cases that we don't actually care about, such as
                    // "nodeCategory" or "linkToPortId", but we'll go ahead and recreate the network anyway.
                    // Also clear the network when replacing the model.
                    if (e.modelChange !== "" ||
                        (e.change === go.ChangedEvent.Transaction && e.propertyName === "StartingFirstTransaction")) {
                      lay.network = null;
                    }
                  });
                }
                var net = this.network;
                if (net === null) {  // the first time, just create the network as normal
                  this.network = net = this.makeNetwork(coll);
                } else {  // but on reuse we need to update the LayoutVertex.bounds for selected nodes
                  this.diagram.nodes.each(function (n) {
                    var v = net.findVertex(n);
                    if (v !== null) v.bounds = n.actualBounds;
                  });
                }
                // now perform the normal layout
                go.ForceDirectedLayout.prototype.doLayout.call(this, coll);
                // doLayout normally discards the LayoutNetwork by setting Layout.network to null;
                // here we remember it for next time
                this.network = net;
              }
              // end ContinuousForceDirectedLayout


              function init() {
                if (window.goSamples) goSamples();  // init for these samples -- you don't need to call this
                var $ = go.GraphObject.make;  // for conciseness in defining templates

                myDiagram =
                  $(go.Diagram, "myDiagramDiv",  // must name or refer to the DIV HTML element
                    {
                      initialAutoScale: go.Diagram.Uniform,  // an initial automatic zoom-to-fit
                      contentAlignment: go.Spot.Center,  // align document to the center of the viewport
                      layout:
                        $(ContinuousForceDirectedLayout,  // automatically spread nodes apart while dragging
                          { defaultSpringLength: 10, defaultElectricalCharge: 50 }),
                      // do an extra layout at the end of a move
                      "SelectionMoved": function(e) { e.diagram.layout.invalidateLayout(); }
                    });

                // dragging a node invalidates the Diagram.layout, causing a layout during the drag
                myDiagram.toolManager.draggingTool.doMouseMove = function() {
                  go.DraggingTool.prototype.doMouseMove.call(this);
                  if (this.isActive) { this.diagram.layout.invalidateLayout(); }
                }

                // define each Node's appearance
                myDiagram.nodeTemplate =
                  $(go.Node, "Auto",  // the whole node panel
                    // define the node's outer shape, which will surround the TextBlock
                    $(go.Shape, "Circle",
                      { fill: "Gold", stroke: "black", spot1: new go.Spot(0, 0, 5, 5), spot2: new go.Spot(1, 1, -5, -5) }),
                    $(go.TextBlock,
                      { font: "bold 10pt helvetica, bold arial, sans-serif", textAlign: "center", maxSize: new go.Size(100, NaN) },
                      new go.Binding("text", "text"))
                  );
                // the rest of this app is the same as samples/conceptMap.html

                // replace the default Link template in the linkTemplateMap
                myDiagram.linkTemplate =
                  $(go.Link,  // the whole link panel
                    $(go.Shape,  // the link shape
                      { stroke: "black" }),
                    $(go.Shape,  // the arrowhead
                      { toArrow: "standard", stroke: "black" }),
                    $(go.Panel, "Auto",
                      $(go.Shape,  // the label background, which becomes transparent around the edges
                        { fill: $(go.Brush, "Radial", { 0: "rgb(240, 240, 240)", 0.3: "rgb(240, 240, 240)", 1: "rgba(240, 240, 240, 0)" }),
                          stroke: null }),
                      $(go.TextBlock,  // the label text
                        { textAlign: "center",
                          font: "11pt helvetica, arial, sans-serif",
                          stroke: "#555555",
                          margin: 0 },
                        new go.Binding("text", "text"))
                    )
                  );

                // create the model for the concept map
                var nodeDataArray = [

                  { key: 6, text: "Recurso Comercial" },
                  { key: 11, text: "Cafeteria" },
                  { key: 10, text: "Bar" },
                  { key: 12, text: "Discotheque" },
                  { key: 13, text: "Restaurant" },

                ];
                var linkDataArray = [
                  { from: 6, to: 10, text: "sbc:hasBar" },
                  { from: 6, to: 11, text: "sbc:hasCafeteria" },
                  { from: 6, to: 12, text: "sbc:hasDiscotheque" },
                  { from: 6, to: 13, text: "sbc:hasRestaurant" },

                ];
                myDiagram.model = new go.GraphLinksModel(nodeDataArray, linkDataArray);
              }

              function reload() {
                //myDiagram.layout.network = null;
                var text = myDiagram.model.toJson();
                myDiagram.model = go.Model.fromJson(text);
                //myDiagram.layout =
                //  go.GraphObject.make(ContinuousForceDirectedLayout,  // automatically spread nodes apart while dragging
                //    { defaultSpringLength: 30, defaultElectricalCharge: 100 });
              }
            </script>


</html>
