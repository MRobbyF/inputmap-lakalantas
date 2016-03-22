<!DOCTYPE html>
<html> 
<head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 

          <style type="text/css">
          	#map img { 
  max-width: none;
}

#map label { 
  width: auto; display:inline; 
} 
          	
          </style>
</head> 
<body>
	

  <div id="map" style="width: 630px; height: 300px;"></div>

  <div class="span8 ">
<form   method="POST" id="form1" action="lokasi/lokasi_action.php" class='form-horizontal'>
  <br>
 <legend> <h3> <center> Cari Lokasi Jalur Rawan Kecelakaan </center> </h3> </legend>

<!-- <div id="floating-panel">
      <button id="drop" onclick="drop()">Drop Markers</button>
    </div>
    <div id="map"></div> -->

   <div class="control-group">
    <label class="control-label" for="nama">Cari Lokasi</label>
    <div class="controls">
      <input type="text" placeholder="Cari Lokasi Tersimpan" id="search_ex_places" list="saved_places">
      &nbsp&nbsp&nbsp&nbsp&nbsp
      <input type="button" class="btn btn-success" id="plot_marker" value="Cari tempat"/>  
    </div>
  </div>

  <script type="text/javascript">



// DIRECTION
function initMap() {

var ren, ser;
var marker, marker2;
var i, j;
var infowindow;
var directionsDisplay;
var pointA, pointB;

    var locations = [
   <?php
            include('inc/config.php');
            	$sql_lokasi="select *	from lokasi";
            	$result=mysql_query($sql_lokasi) or die(mysql_error());
            	while($data=mysql_fetch_object($result)){
            		 ?>
            		    ['<?=$data->nama;?>', <?=$data->lat;?>, <?=$data->lng;?>],
       <?
				}
		  ?>
    ];

    var locations2 = [
   <?php
            include('inc/config.php');
              $sql_lokasi="select idlokasi,nama,lat,lng,lat2,lng2 from lokasi";
              $result=mysql_query($sql_lokasi) or die(mysql_error());
              while($data=mysql_fetch_object($result)){
                 ?>
                    ['<?=$data->nama;?>', <?=$data->lat2;?>, <?=$data->lng2;?>],
       <?
        }
    ?>
    ];

    // map = new google.maps.Map(document.getElementById('map'), {
    myOptions = {
      zoom: 12,
      center: pointA,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    },

    map = new google.maps.Map(document.getElementById('map'), myOptions),
    ser = new google.maps.DirectionsService,
    ren = new google.maps.DirectionsRenderer({
    map: map
    });

    <?php
            $result = mysql_query("SELECT * FROM lokasi");
            while ($row = mysql_fetch_array($result))
            // foreach($result as $row) // <- remove this line
                echo "addMarker(new google.maps.LatLng(".$row['lat'].", ".$row['lng']."), map), 
              addMarker2(new google.maps.LatLng(".$row['lat2'].", ".$row['lng2']."), map);";       
            ?>
           
var infowindow = new google.maps.InfoWindow();            

for (i = 0; i < locations.length; i++) { 
      pointA = new google.maps.LatLng(locations[i][1], locations[i][2])
        
      };

for (j = 0; j < locations2.length; j++) { 
      pointB = new google.maps.LatLng(locations2[j][1], locations2[j][2])
        
      };

  // get route from A to B
  calculateAndDisplayRoute(ser, ren, pointA, pointB);
}


function calculateAndDisplayRoute(ser, ren, pointA, pointB) {
  ser.route({
    origin: pointA,
    destination: pointB,
    travelMode: google.maps.TravelMode.DRIVING
    }, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
        ren.setDirections(response);
        } else {
        window.alert('Directions request failed due to ' + status);
        }      
  });
}


function addMarker(pointA, map) {
            var marker = new google.maps.Marker({
                position: pointA,
                map: map,
                icon: 'seru.png',
                content: php,
                animation: google.maps.Animation.BOUNCE    
            });
          
          //menampilkan INFOWINDOW
            var php = '<b>Nama Jalur :</b><br> <?php echo $row['nama']; ?>'
            // "<table>" +
            //      "<tr><td>Name:</td> <td><input type='text' id='name'/> </td> </tr>" +
            //      "<tr><td>Address:</td> <td><input type='text' id='address'/></td> </tr>" +
            //      "<tr><td>Type:</td> <td><select id='type'>" +
            //      "<option value='bar' SELECTED>bar</option>" +
            //      "<option value='restaurant'>restaurant</option>" +
            //      "</select> </td></tr>" +
            //      "<tr><td></td><td><input type='button' value='Save & Close' onclick='saveData()'/></td></tr>";

            
            // '<div id="content">'+
            // '<div id="siteNotice">'+
            // '</div>'+
            // '<h3 id="firstHeading" class="firstHeading">AWAL</h3>'+
            // '<div id="bodyContent">'+
            // '<p>menampilkan informasi</p>'+
            // '<p>Web <a href="Facebook">'+
            // 'www.facebook.com</a> .</p>'+
            // '</div>'+
            // '</div>';
 
            var infowindow = new google.maps.InfoWindow({
              content: php
            });
 
            google.maps.event.addListener(marker, 'click', function() {
              // infowindow.close();
              infowindow.setContent(php);
              infowindow.open(map,marker);
            });

            

            // google.maps.event.addListener(marker, 'click', (function(marker, i) {
            //   return function() { 
            //     var id= locations[i][0];
 
            //     $.ajax({
            //     url : "get_info.php",
            //     data : "id=" +id ,
            //       success : function(data) {
            //       infowindow.setContent(data);
            //       infowindow.open(map, marker);
            //       }
            //     });    
            //   }
            // })(marker, i));
        }

function addMarker2(pointB, map, j) {
            var marker2 = new google.maps.Marker({
                position: pointB,
                map: map,
                icon: 'seru 2.png',
                animation: google.maps.Animation.DROP
            });

          //menampilkan INFOWINDOW
            var contentString = 
            '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h3 id="firstHeading" class="firstHeading">AKHIR</h3>'+
            '<div id="bodyContent">'+
            '<p>menampilkan informasi</p>'+
            '<p>Web <a href="Facebook">'+
            'www.facebook.com</a> .</p>'+
            '</div>'+
            '</div>';
 
            var infowindow = new google.maps.InfoWindow({
              content: contentString
            });
 
            google.maps.event.addListener(marker2, 'click', function() {
              infowindow.open(map,marker2);
            });
        }










function drop() {
  clearMarkers();
  for (var i = 0; i < pointA.length; i++) {
    addMarkerWithTimeout(locations[i], i * 200);
  }
}

function addMarkerWithTimeout(position, timeout) {
  window.setTimeout(function() {
    markers.push(new google.maps.Marker({
      position: position,
      map: map,
      animation: google.maps.Animation.DROP
    }));
  }, timeout);
}

function clearMarkers() {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(null);
  }
  markers = [];
}
        










// // PENCARIAN LOKASI DI BUTTON

// $('#plot_marker').click(function(e){ //used for plotting the marker into the map if it doesn't exist already
//       e.preventDefault(); 
//       marker.setMap(map); //set the map to be used by marker
//       marker.setPosition(map.getCenter()); //set position of marker equal to the current center of the map
//       map.setZoom(17);
      
//       $('input[type=text], input[type=hidden]').val('');
//   });    


// //PENCARIAN LOKASI DI TEXTBOX

// $('#search_ex_places').blur(function(){
      
//       var nama = $(this).val();
//       //initialize values
//       var lat = 0; 
//       var lng = 0;
//       var lat2 = 0; 
//       var lng2 = 0;
//       $('#saved_places option').each(function(index){ //loop through the save places
//         var cur_place = $(this).data('nama'); //current place description
        
//         //if current place in the loop is equal to the selected place
//         //then set the information to their respected fields
//         if(cur_place == lokasi){ 
//           exists = 1;
//           $('#idlokasi').val($(this).data('idlokasi'));
//           lat = $(this).data('lat');
//           lng = $(this).data('lng');
//           lat2 = $(this).data('lat2');
//           lng2 = $(this).data('lng2');
//           $('#nama').val($(this).data('nama'));
//         }
//       });

//       if(exists == 0){//if the place doesn't exist then empty all the text fields and hidden fields
//         $('input[type=text], input[type=hidden]').val('');
        
//       }else{
//         //set the coordinates of the selected place
//         var pointA = new google.maps.LatLng(lat, lng);
//         var pointB = new google.maps.LatLng(lat2, lng2);
        
//         //set marker position
//         pointA.setMap(map);
//         pointA.setPosition(position);
//         pointB.setMap(map);
//         pointB.setPosition(position);

//         //set the center of the map
//         map.setCenter(pointA.getPosition());
//         map.setZoom(12);
//         map.setCenter(pointB.getPosition());
//         map.setZoom(12);
        
//       }
//     });


initMap();

//     var map = new google.maps.Map(document.getElementById('map'), {
//       zoom: 12,
//       center: new google.maps.LatLng(-7.8721779,112.525504),
//       mapTypeId: google.maps.MapTypeId.ROADMAP
//     });

//     var infowindow = new google.maps.InfoWindow();

    

// ren = new google.maps.DirectionsRenderer( {
// 'map': map,
// 'preserveViewport': true,
// 'draggable': true} 
// );
// ren.setMap(map);
// ren.setPanel(document.getElementById("directionsPanel"));
// ser = new google.maps.DirectionsService();

// var marker, start, end, i, j;

//     for (i = 0; i < locations.length; i++) { 

//       for (j = 0; j < locations2.length; j++) { 
//       start = locations[i][1], locations[i][2] 
//       end = locations2[j][1], locations2[j][2]

//       ser.route({

//       'origin': start, 
//       'destination':  end, 
//       'travelMode': google.maps.DirectionsTravelMode.DRIVING},
//       function(res,sts) {

//         if(sts=='OK') {
//                     directionResult.push(res);
//                     ren.setDirections(res); 

//                 } else {
//                     directionResult.push(null);
//                 }
//         });
//     }
//   }





  </script>
</body>
</html>






<datalist id="saved_places">
<?php while($row = $lokasi->fetch_object()){ ?> 
  <option value="<?php echo $row->lokasi; ?>" 
    data-idlokasi="<?php echo $row->idlokasi; ?>"  
    data-nama="<?php echo $row->nama; ?>" 
    data-lat="<?php echo $row->lat; ?>" 
    data-lng="<?php echo $row->lng; ?>"
    data-lat2="<?php echo $row->lat2; ?>" 
    data-lng2="<?php echo $row->lng2; ?>">
    <?php echo $row->lokasi; ?>
  </option>
<?php } ?>  
</datalist>