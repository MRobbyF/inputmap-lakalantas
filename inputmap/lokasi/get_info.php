<?php
  //konfgurasi koneksi database 
          mysql_connect('localhost','root','');
        mysql_select_db('lokasi');
 
$id=$_GET['id'];
    $sql_lokasi="select * 
              from lokasi where idlokasi='$id' ";
              $result=mysql_query($sql_lokasi);
              while($data=mysql_fetch_object($result)){
                $content=
                "<div id=\"content\">
                <div id=\"siteNotice\">
                </div>
                <h3 id=\"firstHeading\" class=\"firstHeading\">$data->nama</h3>
                <div id=\"bodyContent\"> <p>
                <img src=\"foto/$data->foto\" style=\"float:left;margin:0 5px 0 0;\">
                $data->deskripsi </p>
                </div></div>";
    }  
    echo $content;
?>