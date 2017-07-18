<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Interactive Force Directed Layout</title>
<meta name="description" content="A continuously operating ForceDirectedLayout lets the user push and pull nodes around." />
<!-- Copyright 1998-2017 by Northwoods Software Corporation. -->
<meta charset="UTF-8">
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
</head>
<body onload="init()">
<div id="sample">
  <div id="myDiagramDiv" style="background-color: white; border: solid 1px; border-color: red; width: 100%; height: 600px"></div>

</div>
</body>
</html>
