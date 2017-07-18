<!DOCTYPE html>
<meta charset="utf-8">
<html>
  <head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/misc.css">
    <link rel="stylesheet" href="css/blue-scheme.css">

    <script src="d3sparql.js"></script>
    <script src="https://d3js.org/d3.v3.min.js"></script>
    <script type="text/javascript">
      function exec() {
        var endpoint = d3.select("#endpoint").property("value")
        var sparql = d3.select("#sparql").property("value")
        d3sparql.query(endpoint, sparql, render)
      }
      function render(json) {
        var config = {
          "charge": -500,
          "distance": 50,
          "width": 1350,
          "height": 750,
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

    <style type="text/css">
      h1{
        text-align: center;
      }
      #query{
        text-align: center;
      }
      input{
        background: #E2E3E5;
        width: 33%;
      }
      textarea{
        width:50%;height:200px;border: 2px solid #990000;
        background: #E2E3E5;
      }
    </style>
  </head>
  <body>
    <div id="query" style="margin: 10px">
      <h2>DESASTRES NATURALES ECUADOR</h2>
      <form class="form-inline">
        <label>SPARQL ENPOINT:</label>
        <div class="input-append">
          <input id="endpoint" class="span5" value="http://dbpedia.org/sparql" type="text">
          <button class="btn" type="button" onclick="exec()">Query</button>
          <button class="btn" type="button" onclick="exec_offline()">Use cache</button>
          <button class="btn" type="button" onclick="toggle()"><i id="button" class="icon-chevron-up"></i>Hide</button>
        </div>
      </form>
      <textarea id="sparql" class="span9" rows=15>
        # https://en.wikipedia.org/wiki/History_of_programming_languages
        # https://en.wikipedia.org/wiki/Perl
        # http://dbpedia.org/page/Perl
        # http://dbpedia.org/sparql

        PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
        PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
        PREFIX dbpedia-owl: <http://dbpedia.org/ontology/>
        PREFIX dbpprop: <http://dbpedia.org/property/>
        PREFIX dbpedia: <http://dbpedia.org/resource/>

        SELECT DISTINCT ?lang1 ?lang2 ?lang1label ?lang2label ?lang1value ?lang2value ?lang1year ?lang2year
        WHERE {
          ?lang1 rdf:type dbpedia-owl:ProgrammingLanguage ;
                 rdfs:label ?lang1name ;
                 dbpprop:year ?lang1year .
          ?lang2 rdf:type dbpedia-owl:ProgrammingLanguage ;
                 rdfs:label ?lang2name ;
                 dbpprop:year ?lang2year .
          ?lang1 dbpedia-owl:influenced ?lang2 .
          FILTER (?lang1 != ?lang2)
          FILTER (LANG(?lang1name) = 'en')
          FILTER (LANG(?lang2name) = 'en')
          BIND (replace(?lang1name, " .programming language.", "") AS ?lang1label)
          BIND (replace(?lang2name, " .programming language.", "") AS ?lang2label)
          FILTER (?lang1year > 1950 AND ?lang1year < 2020)
          FILTER (?lang2year > 1950 AND ?lang2year < 2020)
          # To render older language larger than newer
          BIND ((2020 - ?lang1year) AS ?lang1value)
          BIND ((2020 - ?lang2year) AS ?lang2value)
        }
      </textarea>
    </div>
    <div id="result"></div>
  </body>
</html>
