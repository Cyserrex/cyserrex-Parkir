<?php
include "koneksi_parkir.php"; 


$id = $_POST['id'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];

if(isset ($name) && isset ($username) && isset ($password)) {

$sql = $db->query("UPDATE admin SET
					nama		= '$nama',
				username	= '$username',
				password	= '$password'
					WHERE 	id_user = '$id'");	
		if($sql){
			echo "Sukses <br/> <input type='button' class='btn' value='Kembali' onClick='javascript:history.go(-1)'/>";
		}else{
			echo "Ada masalah <br/> <input type='button' class='btn' value='Kembali' onClick='javascript:history.go(-1)'/>";
		}

} else {
	echo "Ada data yang masih kosong <br/>";
	echo "<input type='button' class='btn' value='Kembali' onClick='javascript:history.go(-1)'/>";
}




?>