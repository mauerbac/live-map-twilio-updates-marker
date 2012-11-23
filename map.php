<?php 

/*
//�2012 Matt Auerbach
//Pulls information from database and puts markers on Google map 

*/

include ('constants.php');
//connect to database
$link = mysql_connect(HOST,DB_NAME,DB_PASS);
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	$db_selected = mysql_select_db(DB_NAME);
	if (!$db_selected) {
		die ('Can\'t use foo : ' . mysql_error());
	}

	//select current postion and info
	$result = mysql_query("SELECT * FROM locations ORDER BY id ASC") or die(mysql_error());
	$row = mysql_fetch_assoc($result);
	$arr;  //array for location
	$i = 0; //counter. If want more than one location
		 
		
			$fname = $row['fname']; //store first name
			$lname = $row['lname']; //store last name
			$name="$fname $lname";  
			$name=trim($name); 
			$twitter=$row['twitter']; //store twitter
			$twitter="<a href='http://twitter.com/$twitter' target='_blank'>"; //create twitter link
			
			//store info in array for google maps
			$arr[$i]["city"]=$row['city'];
			$arr[$i]["state"]=$row['state'];
			$arr[$i]["lat"] = $row['lat'];
			$arr[$i]["twitter"]=$twitter;
			$arr[$i]['name'] = $name;
			$arr[$i++]["lng"] = $row['long'];
		
		$length = $i; //number of locations. If want more than one location. 
		$json = json_encode($arr); 
		echo<<<END
		<html>
		<head>



	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

	<!--- **********Add Google Maps API Key below *********--> 
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/XXXAPIKEYXXXXX&sensor=false">
    
    </script>
	<script type="text/javascript">

	var map;
	var infowindow = new google.maps.InfoWindow({});
	var markersArray = new Array();

	$(document).ready(function() {
		initialize();
	if ($length > 0){
			initializeMarkers();
	}

function initialize() {
		
   //map styling info
	//add style information below, if you want
  /*var styles = [
    	{
     	stylers: []}, ];*/


  		//var styledMap= new google.maps.StyledMapType(styles,{name: "Styled Map"});

		//create new map
        var mapOptions = {
        	//***Add current start zone****
          center: new google.maps.LatLng(42.058021,-87.674371), 
          zoom: 15,
          mapTypeId: google.maps.MapTypeId.ROADMAP
          //mapTypeControlOptions:{ mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']}
        };

        map = new google.maps.Map(document.getElementById("map_canvas"),
            mapOptions);
		/*map.mapTypes.set('map_style', styledMap);
		map.setMapTypeId('map_style');*/

      }

      	//create markers 
      function initializeMarkers() {
      	var json = $json;
      	for (i = 0; i < $length; i++) {
      		var city=json[i].city;
      		var state=json[i].state;
      		var lng = json[i].lng;
      		var lat = json[i].lat;
      		var twitter= json[i].twitter;
      		var name = json[i].name;
      		var info= "<b><h3>" + twitter + name + "</a></h3></b><h4>";
      		var cur = new google.maps.LatLng(lat, lng);
      		var image= 'http://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png';
      		var marker = new google.maps.Marker({ 
      			map: map,
  				icon: image, //change icon image here 
  				animation: google.maps.Animation.DROP,
      			position: cur
      		});
			
			makeInfoWindow(marker, info);
			markersArray.push(marker);
      	}
      }

    function makeInfoWindow(marker, content){ 
 		 google.maps.event.addListener(marker, 'click', function () { 
    	 infowindow.setContent(content);
    	infowindow.open(map, marker); 
  		}); 
	} 

});
	</script>
	</head>
	<body>
<center><div id='map_canvas' style='width:100%; height:100%'></div></center> <!-- create full screen map -->
</body>
</html>
END;
mysql_close();
?>
