<?php
include "koneksi_parkir.php"; 


$id = $_POST['id'];
$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];

if(isset ($name) && isset ($username) && isset ($password)) {

	$update_admin="UPDATE admin SET
				name		= '$name',
				username	= '$username',
				password	= '$password'
				WHERE 	id='$id'";
	mysql_query($update_keluar) or die ("Gagal Update Admin");

} else {
	echo "Ada data yang masih kosong <br/>";
	echo "<input type='button' class='btn' value='Kembali' onClick='javascript:history.go(-1)'/>";
}




?>