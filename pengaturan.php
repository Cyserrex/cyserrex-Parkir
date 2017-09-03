<!DOCTYPE html>

<?php
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
	//Redirect ke halaman login
	header('location:index.php?error=5');
	}

$username = $_SESSION['username'];

$sql = "SELECT * FROM admin a 
		LEFT JOIN level_jabatan lj ON a.level=lj.level
		WHERE username='$username'";
if(!$result = $db->query($sql)){
	die('There was an error running the query [' . $db->error . ']');
}	
$value = $result->fetch_assoc();
$jabatan=$value['nama_jabatan'];
$nama=$value['nama'];
$password=$value['username'];
$id=$value['id_user'];


?> 
<html>
<head>
	<title>Administrator</title>
</head>
<body>
    <form align="center" action="admin_aksi.php" method="POST">
    <input hidden name="id" value="<?php echo $id ?>"/>
    <table>
	<tr>
	<td>Nama</td>
	<td>: </td>
	<td><input type="text" name="nama" value="<?php echo $nama ?>"/></td>
	</tr>
	<tr>
	<tr>
	<td>Jabatan</td>
	<td>: </td>
	<td><input disabled type="text" value="<?php echo "Petugas $jabatan"; ?>"/></td>
	</tr>
	<tr>
	<td>Username</td>
	<td>: </td>
	<td><input type="text" name="username" value="<?php echo $username ?>"/></td>
	</tr>
	<tr>
	<td>Password</td>
	<td>: </td>
	<td><input type="text" name="password" /></td>
    </tr> 
    </table>
    <br/>
    <input type="submit" value="Simpan" />
    </form>
</body>
</html>
