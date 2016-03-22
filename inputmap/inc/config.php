<?php	
	$mysql_host="localhost";
	$mysql_user="root";
	$mysql_password="";
	$mysql_database="lokasi";
	
	$koneksi_db = mysql_connect($mysql_host, $mysql_user, $mysql_password);
	mysql_select_db($mysql_database, $koneksi_db);
	
?>
