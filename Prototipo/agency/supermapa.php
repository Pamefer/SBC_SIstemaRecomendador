<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php 
extract($_GET); 
require_once( "sparqllib.php" );
?>
<?php


	// CONNECT TO THE DATABASE
	function db_obj($query) {

		$database = 'trans_loja';
		$server = 'localhost';
		$dbuser = 'root';
		$dbpass = "";
		
 
		$db = new mysqli($server, $dbuser, $dbpass, $database);
		if($db->connect_errno > 0){
	    		die('Unable to connect to database [' . $db->connect_error . ']');
		}

		if(!$result = $db->query($query)){
			return false;
		}else{
			$row = new stdClass();$i=0;
			while ($object = @mysqli_fetch_object($result)) {
		    		$row->result[$i++]=$object;
			}
			if(@!$row->result){
				$row->result='';
			}
			$db->close();
			return $row;	
		}
	}

?>

<?php 
		extract($_POST);
	include("conect.php");
	//cadena de conexion al mysql
	$sql_listar="select * from rutas_transporte";
	$res_sql=mysql_query($sql_listar,$link);
	extract($_POST);
	include("conect.php");
	//Recuperacion de las variables convertidas en sesiones
	$trans=$_SESSION['trans2']=@$_REQUEST['trans']; 
	$tipo=$_SESSION['tipo2']=@$_REQUEST['tipo'];
	//QUERY COMBO 1
	 $query="select * from rutas_transporte";
	 $res=mysql_query($query);
	//QUERY COMBO 2
	$query2="select * from rutas_transporte WHERE idRutas_transporte=$trans"; 
	$res2=mysql_query($query2);


	//Consultas para imprimir los resultados en la ultima parte del programa
	$selectS=" select * from rutas_transporte where idRutas_transporte=$trans";
	$resS2=mysql_query($selectS);
	$rowS2=@mysql_fetch_assoc($resS2); 
?>





<?php 

  //Realizamos la consulta a la tabla correspondiente
 
       $datos2=array();
              $data2 = sparql_get( "http://localhost:8890/sparql","SELECT ?recurso ?lat ?long ?b WHERE { ?recurso <http://www.w3.org/1999/02/22-rdf-syntax-ns#type>  <http://idi.fundacionctic.org/cruzar/turismo#Entorno-natural> .
?recurso <http://www.w3.org/2003/01/geo/wgs84_pos#lat> ?lat.
?recurso <http://www.w3.org/2003/01/geo/wgs84_pos#long> ?long.
?b <http://www.w3.org/2003/01/geo/wgs84_pos#long> ?long}" );
$marker_pintar = ""; 
              foreach( $data2 as $row )
                        {
                                        
                        $datos2[]=array("np"=>$row["np"]);
                         $marker_pintar .= "['".$row["recurso"]."','".$row["lat"]."','".$row["long"]."','".$row["b"]."'],";
                      }                       

  
?>



<!DOCTYPE HTML>
<html>
<head>
<title>Transporte Loja</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/jquerymap.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDrCUKwFgLkNg3qE_4slKEsbw5JZZqMCmk"></script>
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Wandering Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
	</script>
<!-- //end-smoth-scrolling -->
</head>
<body>
<!--header start here-->
<div class="header-strip"> 

</div>
<div class="header">
	<div class="container">
		<div class="header-main">
			  <div class="logo">
			  	<h1><a href="index.php">Instituciones  de educación inclusiva Ecuador</a></h1>
                
                  
			  </div>
        </div>
	</div>
</div>			
<div class="navg-strip">
    <div class="container">
      <div class="navg-main">
		 <div class="top-nav">
		 	 <span class="menu"> <img src="images/icon.png" alt=""/></span>
			<ul class="res">
				<li><a href="index.php?trans=1" class="index.php?trans=1">Home</a></li>
				<li><a  href="http://localhost/Aplicacion/Aplicacion/Trans_Loja/redes/web/sparadas.php">Provincias</a></li>
                <li><a class="scroll" href="sparadas">Discapacidades</a></li>
		
			</ul>
			<!--script-->
						<script>
							$("span.menu").click(function(){
								$("ul.res").slideToggle(500, function(){
								});
							});
					</script>		
		 </div>
		 <div class="header-right">
			<div class="social-icons">
				<ul>
				<li><a href="#"><span class="fa"> </span></a></li>
				<li><a href="#"><span class="tw"> </span></a></li>
				<li><a href="#"><span class="you"> </span></a></li>
			</ul>
			</div>
		
		   <script type="text/javascript">
				$('.search').hide();
				$('button').click(function (){
				$('.search').show();
				$('.text').focus();
				}
				);
				$('.close-in').click(function(){
				$('.search').hide();
				});
			</script>

		  <div class="clearfix"> </div>
		</div>
	  <div class="clearfix"> </div>
   </div>
  </div>
</div>
<!--header end here-->
<!--banner start here-->

<!--banner end here-->
<!--about start here-->
<br>
<br>  



<!--about end here-->
<!--ab-info start here-->
<div class="about" id="services">
	<div class="container">
		<div class="about-main">
			<div class="about-bottom">
				<div class="col-md-6 about-left">
					<h3>Busqueda por provincia</h3>
                     

				
                    <?php 
            //Consulta rating
             $datos1=array();
              $data2 = sparql_get( "http://localhost:8890/sparql","
                         select  ?provincia ?nombre  where {
                        ?provincia <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://dbpedia.org/resource/province>.
                        ?provincia<http://www.w3.org/2000/01/rdf-schema#label> ?nombre
                        }
  
                     " );
              foreach( $data2 as $row )
                        {
                                           
                        $datos1[]=array("nombre"=>$row["nombre"],"ruta"=>$row["provincia"]);
                      }                       
            ?>
             
                    
                    <br>
					<form>
    <select   class="form-control" action="action" name="trans" placeholder="Elije una ruta" onchange="this.form.submit()"  >
             <option value="<?php echo $trans?>" ><?php echo $datos2[1]["np"] ?></option>
    

    <?php  foreach($datos1 as $x => $x_value) {?> 
    <option value="<?php echo $datos1[$x]["ruta"]?>"> <?php echo ($datos1[$x]["nombre"]);?>
  <?php     };?>
        </option>
      </select>
      <br><br>
      </form>
					
					<div class="about-grid">
					
					</div>
				</div>
				<div class="col-md-6 about-right">
					 <div id="map-canvas" style="float:right; width:650px; height:650px " ></div>
                <div id="panel_ruta" style= "overflow: auto; width:650px; height: 200"></div>
				</div>
			  <div class="clearfix"> </div>
			</div>
		</div>
	</div>
</div>
<br>
			<br>
			<br>
<
		</div>
	</div>
</div>
<!--ab-info end here-->
<!--services start here-->

<!--services end here-->
<!--dreams start here-->

<!--dreams end here-->
<!--testimonal strat here-->

<!--testimonal end here-->
<!--test grid-img start here-->

<!--test grid img end here-->
<!--gallery start here-->

<link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
			<script type="text/javascript" src="js/nivo-lightbox.min.js"></script>
				<script type="text/javascript">
				$(document).ready(function(){
				    $('#nivo-lightbox-demo a').nivoLightbox({ effect: 'fade' });
				});
				</script>


<!--gallery end here-->
<!--map start here-->

<!--map end here-->
<!--contaact start here-->

<!--contact end here-->
<!--footer start here-->

<!--footer end here-->
<!--copyright start here-->
<div class="copyright">
	<div class="container">
	   <div class="copy-main">
			<p>© 2015 Cardenas Ana y Jefferson leon  <a href="" target="_blank">  Redes </a></p>
	   </div>
	   <script type="text/javascript">
										$(document).ready(function() {
											/*
											var defaults = {
									  			containerID: 'toTop', // fading element id
												containerHoverID: 'toTopHover', // fading element hover id
												scrollSpeed: 1200,
												easingType: 'linear' 
									 		};
											*/
											
											$().UItoTop({ easingType: 'easeOutQuart' });
											
										});
									</script>
						<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>

  </div>
</div>

<!--copyright end here-->
<script type="text/javascript">
var locations = [ <?php echo $marker_pintar; ?>
  ];
  function initialize() {
  var myLatlng = new google.maps.LatLng(-1.275599, -76.800350);
  var mapOptions = {
    zoom: 7,
    center: myLatlng
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    setMarkers(map,locations)
}
    google.maps.event.addDomListener(window, "load", initialize);

function setMarkers(map,locations){

      var marker, i

      for (i = 0; i < locations.length; i++)
       {  
           var loan = locations[i][0]
           var lat = locations[i][1]
           var long = locations[i][2]
           //var add =  locations[i][3]
           //var img =  locations[i][4]
           console.log(loan)


           latlngset = new google.maps.LatLng(lat, long);

            var marker = new google.maps.Marker({  
                map: map, title: loan , position: latlngset  
            });
            map.setCenter(marker.getPosition())
            var content = "Nombre institucion: " + loan +  '</h3>' +'<br>'+ "Telefono: "   

            var infowindow = new google.maps.InfoWindow()

            google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
                return function() {
                    infowindow.setContent(content);
                     infowindow.open(map,marker);
                };
            })(marker,content,infowindow)); 

       }
  }

google.maps.event.addDomListener(window, 'load', initialize);
    var map;
    var directionsDisplay = new google.maps.DirectionsRenderer();
    var directionsService = new google.maps.DirectionsService();
    
    $(document).ready(function() {
        load_map();
    });
    
    function load_map() {
        var myLatlng = new google.maps.LatLng(-0.902132, -79.019588);
        var myOptions = {
            zoom: 1,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map($("#map_canvas").get(0), myOptions);
    }
    
    function rockAndRoll(){
        var request = {
                origin: $('#origen').val(),
                destination: $('#destino').val(),
                travelMode: google.maps.DirectionsTravelMode[$('#modo_viaje').val()],
                unitSystem: google.maps.DirectionsUnitSystem[$('#tipo_sistema').val()],
                provideRouteAlternatives: true
        };
        directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setMap(map);
                directionsDisplay.setPanel($("#panel_ruta").get(0));
                directionsDisplay.setDirections(response);
            } else {
                alert("No existen rutas entre ambos puntos");
            }
        });
    }
    
    $('#buscar').live('click', function(){
        rockAndRoll();
    });

    $('.opciones_ruta').live('change', function(){
        rockAndRoll();
    });

</script>
