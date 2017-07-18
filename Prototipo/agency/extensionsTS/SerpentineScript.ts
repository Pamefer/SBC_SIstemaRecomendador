"use strict";
/*
*  Copyright (C) 1998-2017 by Northwoods Software Corporation. All Rights Reserved.
*/

import * as go from "../release/go";
import { SerpentineLayout } from "./SerpentineLayout";

var myDiagram: go.Diagram = null;

export function init() {
	if (typeof (<any>window)["goSamples"] === 'function') (<any>window)["goSamples"]();  // init for these samples -- you don't need to call this  

	var $ = go.GraphObject.make;

	myDiagram =
		$(go.Diagram, "myDiagramDiv",  // create a Diagram for the DIV HTML element
			{
				initialContentAlignment: go.Spot.Center,
				isTreePathToChildren: false,  // links go from child to parent
				layout: $(SerpentineLayout)  // defined in SerpentineLayout.js
			});

	myDiagram.nodeTemplate =
		$(go.Node, go.Panel.Auto,
			$(go.Shape, { figure: "RoundedRectangle", fill: "white" },
				new go.Binding("fill", "color")),
			$(go.TextBlock, { margin: 4 },
				new go.Binding("text", "key")));

	myDiagram.linkTemplate =
		$(go.Link, go.Link.Orthogonal,
			{ corner: 5 },
			$(go.Shape),
			$(go.Shape, { toArrow: "Standard" }));

	var model = new go.TreeModel();
	model.nodeParentKeyProperty = "next";
	model.nodeDataArray = [
		{ key: "Alpha", next: "Beta", color: "coral" },
		{ key: "Beta", next: "Gamma", color: "tomato" },
		{ key: "Gamma", next: "Delta", color: "goldenrod" },
		{ key: "Delta", next: "Epsilon", color: "orange" },
		{ key: "Epsilon", next: "Zeta", color: "coral" },
		{ key: "Zeta", next: "Eta", color: "tomato" },
		{ key: "Eta", next: "Theta", color: "goldenrod" },
		{ key: "Theta", next: "Iota", color: "orange" },
		{ key: "Iota", next: "Kappa", color: "coral" },
		{ key: "Kappa", next: "Lambda", color: "tomato" },
		{ key: "Lambda", next: "Mu", color: "goldenrod" },
		{ key: "Mu", next: "Nu", color: "orange" },
		{ key: "Nu", next: "Xi", color: "coral" },
		{ key: "Xi", next: "Omicron", color: "tomato" },
		{ key: "Omicron", next: "Pi", color: "goldenrod" },
		{ key: "Pi", next: "Rho", color: "orange" },
		{ key: "Rho", next: "Sigma", color: "coral" },
		{ key: "Sigma", next: "Tau", color: "tomato" },
		{ key: "Tau", next: "Upsilon", color: "goldenrod" },
		{ key: "Upsilon", next: "Phi", color: "orange" },
		{ key: "Phi", next: "Chi", color: "coral" },
		{ key: "Chi", next: "Psi", color: "tomato" },
		{ key: "Psi", next: "Omega", color: "goldenrod" },
		{ key: "Omega", color: "orange" }
	];
	myDiagram.model = model;
}