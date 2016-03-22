<?php
include ('../inc/config.php');
//data dari lokasi

$nama = $_POST['nama'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$lat2 = $_POST['lat2'];
$lng2 = $_POST['lng2'];

$aksi = $_POST['aksi'];
$id = $_POST['id'];

$sql = null;
if($aksi == 'tambah') {
	$sql = "INSERT INTO lokasi(nama,lat,lng,lat2,lng2)
		VALUES('$nama','$lat','$lng',$lat2,$lng2)";
}

$result = mysql_query($sql) or die(mysql_error());

//check if query successful
if($result) {
	header('location:../index.php?mod=lokasi&pg=lokasi_form&status=0');
} else {
	header('location:../index.php?mod=lokasi&pg=lokasi_form&status=1');
}
mysql_close();
?>
