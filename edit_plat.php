<?php
session_start();
include "koneksi_parkir.php"; 
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
	//Redirect ke halaman login
	header('location:index.php?error=5');
	}
if(isset($_POST['simpan'])){
$hasil = mysql_query("UPDATE data_parkir SET plat='$_POST[plat]' WHERE id='$_POST[id]'") or die ("Tidak bisa disimpan");
}
header("location:lihat_data.php");
?>