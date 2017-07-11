<?php

require_once( "sparqllib.php" );

$db = sparql_connect( "http://localhost:8890/sparql" );
if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }

sparql_ns( "foaf","http://xmlns.com/foaf/0.1/" );
#sparql_ns("rdf", "http://www.w3.org/1999/02/22-rdf-syntax-ns#");
#sparql_ns("rdfs", "http://www.w3.org/2000/01/rdf-schema#");

$sparql = "SELECT ?recurso ?lat ?long WHERE { ?recurso <http://www.w3.org/1999/02/22-rdf-syntax-ns#type>  <http://idi.fundacionctic.org/cruzar/turismo#Entorno-natural> .
?recurso <http://www.w3.org/2003/01/geo/wgs84_pos#lat> ?lat.
?recurso <http://www.w3.org/2003/01/geo/wgs84_pos#long> ?long}";
#$sparql = "SELECT ?a WHERE { ?x <http://schema.org/name> ?a FILTER regex(?a, "museo")}"
$result = sparql_query( $sparql ); 
$fields = sparql_field_array( $result );

print "<p>Number of rows: ".sparql_num_rows( $result )." results.</p>";
print "<table class='example_table'>";
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
        print "<td>$row[$field]</td>";
        
    }
    print "</tr>";
}
print "</table>";


#De que cantones tenemos datos?  LISTA
#$sparql = "SELECT ?a   WHERE { ?a <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://dbpedia.org/ontology/Canton>. }";

#Bares,cafeterias,hoteles, etc. en provincia de loja   LISTA
# SELECT  ?a  WHERE { ?a <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://www.disit.org/km4city/schema#Bar>. }  (COUNT(?a) AS ?count)

#TIpos de recursosos que puedes encontrar
#SELECT  ?tittle  WHERE { ?x <http://dbpedia.org/ontology/label> ?tittle}

#Dice cuantos bares (hotles, restuarantes, etc) exiten
#SELECT (count(*) as ?a) WHERE { ?a <http://www.w3.org/1999/02/22-rdf-syntax-ns#type>  <http://www.disit.org/km4city/schema#Bar> }

#busca todos los recursos naturales y t da la ubicacion de cada uno
#SELECT ?recurso ?lat ?long WHERE { ?recurso <http://www.w3.org/1999/02/22-rdf-syntax-ns#type>  <http://idi.fundacionctic.org/cruzar/turismo#Entorno-natural> .
#?recurso <http://www.w3.org/2003/01/geo/wgs84_pos#lat> ?lat.
#?recurso <http://www.w3.org/2003/01/geo/wgs84_pos#long> ?long

#Busca una plabra clave en los tweets
#SELECT  ?tweetWHERE   { ?x <http://schema.org/description> ?tweet FILTER regex(?tweet, "parque")        }

#fecha, los tweets del dia ()
#SELECT  ?date ?des WHERE   { ?x <http://schema.org/datepublished> ?date FILTER regex(?date, "2017-05-17") .
 #                          ?x   <http://schema.org/description>   ?des }

#PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
#SELECT  ?date ?des WHERE   { ?x <http://schema.org/datepublished> ?date .
#FILTER (?date > "2017-05-20"^^xsd:time).
#?x   <http://schema.org/description>   ?des }}

#select ?a ?c where {?a ?b ?c .FILTER regex(?c , "Loja") 
#}limit 1000

#Ver todos las categorias
#select distinct ?Recursos where {[] a ?Recursos} 

?>

