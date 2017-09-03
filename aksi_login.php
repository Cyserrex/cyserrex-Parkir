<?php
include('koneksi_parkir.php');

session_start();
$user = $_POST['username'];
$pass = $_POST['password'];
//untuk menentukan expire cookie, dihtung dri waktu server + waktu umur cookie         
$time = time();
//cek jika setcookie di cek set cookie jika tidak ''
$check = isset($_POST['setcookie'])?$_POST['setcookie']:'';

//untuk mencegah sql injection
//kita gunakan mysql_real_escape_string
$user = mysql_real_escape_string($user);
$pass = mysql_real_escape_string($pass);

if (empty($user) && empty($pass)) {
	//kalau username dan password kosong
	header('location:index.php?error=1');
	break;
} else if (empty($user)) {
	//kalau username saja yang kosong
	header('location:index.php?error=2');
	break;
} else if (empty($pass)) {
	//kalau password saja yang kosong
	header('location:index.php?error=3');
	break;
}

$sql = "SELECT * FROM admin WHERE username='$user' AND password='$pass'";
        if(!$result = $db->query($sql)){
            die('Error ketika menjalankan query [' . $db->error . ']');
            }
            $num_results = $result->num_rows;


if ($num_results == 1) {
	$_SESSION['username'] = $user;
	if($check) {       
		setcookie("cookielogin[user]", $user, $time + 86400);       
		setcookie("cookielogin[pass]", $pass, $time + 86400);  
		}
	header('location:home.php');
} else {
	//kalau username ataupun password tidak terdaftar di database
	header('location:index.php?error=4');
}
?>