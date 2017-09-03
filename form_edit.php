<html>
<head>
<title>Mengubah Data</title>
</head>
<body>
<?php
session_start();
include "koneksi_parkir.php"; 
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
	//Redirect ke halaman login
	header('location:index.php?error=5');
	}
	mysql_select_db('parkir') or die (mysql_error());

$query = "select * from data_parkir where id='$_GET[id]'";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);
?>
<center><strong>EDIT DATA</strong></center>
<form method='post' action='edit_plat.php' align='center'>
<table border=1>
	<tr>
	<input type='hidden' name='id' value='<?php echo "$data[id]";?>'></input>
	<td>Plat</td>
	<td>: </td>
	<td><input type='text' name='plat' value="<?php echo "$data[plat]";?>" size="91"></td>
	</tr>
	<tr>
	<tr><td><input type='submit' name='simpan' value='Simpan'></td></tr>
	</table>
</form>
	<a href='lihat_data.php'>Kembali</a>
</body>
</html>
	