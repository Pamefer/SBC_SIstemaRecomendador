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
    <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script>
    function show(shown, hidden) {
      document.getElementById(shown).style.display='block';
      document.getElementById(hidden).style.display='none';
      return false;
    }
    </script>
</head>


<body id="page-top" class="index" onload="init()">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-custom navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">

                <a class="navbar-brand page-scroll" href="index.php">System recommender - Loja Tourism</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div >
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>

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
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Viaja y Diviertete</div>
                <h3>Mejora tu experiencia con lugares y actividades que te pueden gustar</h3>
                <a href="#services" class="page-scroll btn btn-xl">Intentar</a>
            </div>
        </div>
    </header>

    <!-- Services Section -->
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
                        <input type="text" class="form-control" id="keywords" name="keywords" size="15" maxlength="30" minlength="4" placeholder="Search for...">
                      </div><!-- /input-group -->
                      </form>
                      </div><!-- /.row -->
                  </div>
                </div>
        </div>
    </section>


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
      <li class="active"><a href="recursoHotelero.php">Recurso Hotelero<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
      <li ><a href="recursoComercial.php">Recurso Comercial<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a></li>
      <li ><a href="recursoTuristico.php">Recurso Turístico<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tags"></span></a></li>
    </ul>
  </div>
</div>
</nav>
<div id="sample">
  <div id="myDiagramDiv" style="background-color: white; border: solid 1px; border-color: red; width: 100%; height: 600px"></div>

</div>
</section>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha384-mE6eXfrb8jxl0rzJDBRanYqgBxtJ6Unn4/1F7q4xRRyIw7Vdg9jP4ycT7x1iVsgb" crossorigin="anonymous"></script>
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>
    <script src="js/agency.min.js"></script>
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
                  { defaultSpringLength: 30, defaultElectricalCharge: 100 }),
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
              { fill: "Gold", stroke: "black", spot1: new go.Spot(0, 0, 1, 1), spot2: new go.Spot(1, 1, -5, -5) }),
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
                  margin: 4 },
                new go.Binding("text", "text"))
            )
          );

        // create the model for the concept map
        var nodeDataArray = [
          { key: 1, text: "Provincia" },
          { key: 2, text: "Canton" },
          { key: 3, text: "Evento" },
          { key: 4, text: "User Tweet" },
          { key: 5, text: "Recurso Hotelero" },
          { key: 6, text: "Recurso Comercial" },
          { key: 7, text: "Recuros Turistico" },
          { key: 8, text: "Hotel" },
          { key: 9, text: "Hostal" },
          { key: 10, text: "Bar" },
          { key: 11, text: "Cafeteria" },
          { key: 12, text: "Discotheque" },
          { key: 13, text: "Restaurant" },
          { key: 14, text: "Museo" },
          { key: 15, text: "Entorno natural" },
          { key: 16, text: "Edificio historico" },
          { key: 17, text: "Edificio religioso" },

        ];
        var linkDataArray = [
          { from: 1, to: 2, text: "dbo:province" },
          { from: 2, to: 5, text: "swpo:location" },
          { from: 2, to: 6, text: "swpo:location" },
          { from: 2, to: 7, text: "swpo:location" },
          { from: 4, to: 5, text: "schema:about" },
          { from: 4, to: 6, text: "schema:about" },
          { from: 4, to: 7, text: "schema:about" },
          { from: 7, to: 14, text: "sbc:hasMuseum" },
          { from: 7, to: 15, text: "sbc:hasNaturalEnviroment" },
          { from: 7, to: 16, text: "sbc:hasHistoricalBuilding" },
          { from: 7, to: 17, text: "sbc:hasReligiousBuilding" },
          { from: 5, to: 8, text: "sbc:hasHotel" },
          { from: 5, to: 9, text: "sbc:hasHostal" },
          { from: 6, to: 10, text: "sbc:hasBar" },
          { from: 6, to: 11, text: "sbc:hasCafeteria" },
          { from: 6, to: 12, text: "sbc:hasDiscotheque" },
          { from: 6, to: 13, text: "sbc:hasRestaurant" },
          { from: 4, to: 3, text: "schema:description" }
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
</body>

</html>
