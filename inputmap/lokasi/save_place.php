<?php
// require_once('places_config.php');
$nama = $_POST['nama'];
$description = $_POST['description'];
$latitude = $_POST['lat'];
$longitude = $_POST['lng'];
$latitude2 = $_POST['lat2'];
$longitude2 = $_POST['lng2'];
$db->query("INSERT INTO lokasi SET nama='$nama', description='$description', lat='$latitude', lng='$longitude', lat2='$latitude2', lng2='$longitude2'");
$place_id = $db->insert_id;
echo $place_id;
?>