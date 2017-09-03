<?php
include "koneksi_parkir.php";
$id = $_GET['id'];

$hapus = "select gambar from data_parkir where id='$id'";
$hasilnya=mysql_query($hapus);
$datanya=mysql_fetch_array($hasilnya);
 if(!empty($datanya['gambar'])) {
 unlink("$datanya[gambar]"); 
} else {
echo "Gambar tidak ditemukan";
}
$delete = mysql_query("delete from data_parkir where id='$id'");
if($delete){
    echo"<script type='text/javascript'>history.go(-1);</script>";
}else{
    echo "gagal";
}
?>  