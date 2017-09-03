<!DOCTYPE html>

<?php
/*
if (empty($_SESSION['id_user']) AND empty($_SESSION['level']))
{ 
	echo "gagal";
}
// ============== JIKA LOGIN BERHASILL ==========
else{

$sql = "SELECT * FROM parkir WHERE nim ='$nim'";
if(!$result = $db->query($sql)){
	die('There was an error running the query [' . $db->error . ']');
}	
$value = $result->fetch_assoc();
$id_status_mhs_dt=$value['id_status_mhs'];
*/
?> 
<html>
<head>
	<title>Administrator</title>
</head>
<body>
    <form align="center" action="admin_aksi.php" method="POST">
    <table>
	<tr>
	<td>Nama</td>
	<td>: </td>
	<td><input type="text" name="name" /></td>
	</tr>
	<tr>
	<td>Username</td>
	<td>: </td>
	<td><input type="text" name="username" /></td>
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
<?php
// }
?>