
var map, ren, ser;
var data = {};
var data2 = {};
var marker;
var infowindow;
var directionsDisplay;

var wayA = [];
var wayB = [];
var directionResult = [];

function initialize()
{
    var mapDiv = document.getElementById('map');   
    var mapOptions = {
    zoom: 14,       
    center: new google.maps.LatLng(-7.8721779,112.525504),
    mapTypeId : google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map( mapDiv, mapOptions );

    var marker1 = new google.maps.Marker({
    position : new google.maps.LatLng(-7.8689046,112.5331681),
    title : 'lokasi',
    map : map,
    draggable : true,
    label : "1"
    });
    
    var marker2 = new google.maps.Marker({
    position : new google.maps.LatLng(-7.8699046,112.5351681),
    title : 'lokasi',
    map : map,
    draggable : true,
    label : "2"
    });

    google.maps.event.addListener(map, "click", function(event) {
        if (wayA.length == wayB.length) {
        wayA.push(new google.maps.Marker({
      draggable: true,      
          position: event.latLng,
          map: map        
        }));
        } else {
        wayB.push(new google.maps.Marker({
      draggable: true,  
          position: event.latLng,
          map: map  
        }));


ren = new google.maps.DirectionsRenderer( {
'map': map,
'preserveViewport': true,
'draggable': true/*, 
'suppressMarkers' : true */} 
);
ren.setMap(map);
ren.setPanel(document.getElementById("directionsPanel"));
ser = new google.maps.DirectionsService();

function clearOverlays() {
 if (wayA) {
   for (i in wayA) {
   wayA[i].setMap(null);
 }
 }
 if (wayB) {
   for (i in wayB) {
     wayB[i].setMap(null);
  }
}
}

    ser.route({ 
    	'origin': wayA[wayA.length-1].getPosition(), 
    	'destination':  wayB[wayB.length-1].getPosition(), 
    	'travelMode': google.maps.DirectionsTravelMode.DRIVING},
    	function(res,sts) {

        if(sts=='OK') {
                    directionResult.push(res);
                    ren.setDirections(res); 

                } else {
                    directionResult.push(null);
                }
        });
        clearOverlays();
     
    }
 });

//updateMarkerPosition(latLng);

    google.maps.event.addListener(marker1, 'drag', function() {
        updateMarkerPosition(marker1.getPosition());
    });

    google.maps.event.addListener(marker2, 'drag', function() {
        updateMarkerPosition2(marker2.getPosition());
    });
    

    function updateMarkerPosition(latLng) {
        document.getElementById('lat').value = [latLng.lat()];
        document.getElementById('lng').value = [latLng.lng()];
    }

    function updateMarkerPosition2(latLng) {
        document.getElementById('lat2').value = [latLng.lat()];
        document.getElementById('lng2').value = [latLng.lng()];
    }


}
	
	

 	

	