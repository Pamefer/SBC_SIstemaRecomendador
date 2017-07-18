(function (factory) {
    if (typeof module === "object" && typeof module.exports === "object") {
        var v = factory(require, exports);
        if (v !== undefined) module.exports = v;
    }
    else if (typeof define === "function" && define.amd) {
        define(["require", "exports", "../release/go", "./GuidedDraggingTool"], factory);
    }
})(function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    /*
    *  Copyright (C) 1998-2017 by Northwoods Software Corporation. All Rights Reserved.
    */
    var go = require("../release/go");
    var GuidedDraggingTool_1 = require("./GuidedDraggingTool");
    var myDiagram = null;
    function init() {
        if (typeof window["goSamples"] === 'function')
            window["goSamples"](); // init for these samples -- you don't need to call this  
        var $ = go.GraphObject.make; // for conciseness in defining templates
        myDiagram = $(go.Diagram, "myDiagramDiv", // create a Diagram for the DIV HTML element
        {
            initialContentAlignment: go.Spot.Center,
            draggingTool: new GuidedDraggingTool_1.GuidedDraggingTool(),
            "draggingTool.horizontalGuidelineColor": "blue",
            "draggingTool.verticalGuidelineColor": "blue",
            "draggingTool.centerGuidelineColor": "green",
            "draggingTool.guidelineWidth": 1,
            "undoManager.isEnabled": true // enable undo & redo
        });
        // define a simple Node template
        myDiagram.nodeTemplate =
            $(go.Node, "Auto", // the Shape will go around the TextBlock
            $(go.Shape, "RoundedRectangle", { strokeWidth: 0 }, 
            // Shape.fill is bound to Node.data.color
            new go.Binding("fill", "color")), $(go.TextBlock, { margin: 8 }, // some room around the text
            // TextBlock.text is bound to Node.data.key
            new go.Binding("text", "key")));
        // but use the default Link template, by not setting Diagram.linkTemplate
        // create the model data that will be represented by Nodes and Links
        myDiagram.model = new go.GraphLinksModel([
            { key: "Alpha", color: "lightblue" },
            { key: "Beta", color: "orange" },
            { key: "Gamma", color: "lightgreen" },
            { key: "Delta", color: "pink" }
        ], [
            { from: "Alpha", to: "Beta" },
            { from: "Alpha", to: "Gamma" },
            { from: "Beta", to: "Beta" },
            { from: "Gamma", to: "Delta" },
            { from: "Delta", to: "Alpha" }
        ]);
    }
    exports.init = init;
});
