<?php
include "koneksi_parkir.php"; 
session_start();
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
	//Redirect ke halaman login
	header('location:index.php?error=5');
	}

$username = $_SESSION['username'];

$sql = "SELECT level FROM admin WHERE username='$username'";
if(!$result = $db->query($sql)){
	die('There was an error running the query [' . $db->error . ']');
}	
$value = $result->fetch_assoc();
$lvl=$value['level'];

if ($lvl != '0') {
	//Redirect ke halaman login
	header('location:index.php?error=5');
	}
else{

?>
<html>
<head>
<title>Data Parkir</title>
<link rel="icon halaman" type="image/png" href="logo_parkir.ico"/>
</head>
<script type="text/javascript">
function hapus(id){
    tanya = confirm("Anda yakin data "+id+" dihapus?");
    if(tanya == 1){
        window.location.href="hapus.php?id="+id;
    }
}
</script>
<body>
<link href="lihat_data.css" rel="stylesheet" type="text/css">
<ul>
  <li><a href="home.php">Home</a></li>
  <li><a href="lihat_data.php?p=manage_plat">Daftar Plat</a></li>
  <li><a href="lihat_data.php?p=manage_petugas">Daftar Petugas</a></li>
  <li><a href="lihat_data.php?p=administrator">Backup</a></li>
  <!--li><a href="lihat_data.php?p=semua_data">Lihat Semua</a></li-->
  <li><a href="logout.php">Keluar</a></li>
</ul>
<div id='tbl'>
<?php
		if(!empty($_GET['p'])){
			$page = $_GET['p'];
			if (file_exists($page.".php"))
			{
				include($page.".php");
			}else {
				echo "<b><h1>ERROR 404</h1></b>";
			}
		}else{
			include("manage_plat.php");
		}
?>
</div>
</body>
<footer>&copy; 2017 Adny Nizomi. Hak cipta dilindungi oleh undang-undang.</footer>
</html>
<?php
}
?>