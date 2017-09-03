<?php
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
	//Redirect ke halaman login
	header('location:index.php?error=5');
	}

if (!empty($_GET['sukses'])) {
	if ($_GET['sukses'] == 1) {
		echo "<script language=\"javascript\"> window.alert('Backup Transaksi Berhasil Pada Folder backup_table!'); </script>";
	}
    else if ($_GET['sukses'] == 2) {
        echo "<script language=\"javascript\"> window.alert('Backup Admin Berhasil Pada Folder backup_table!'); </script>";
    }
    else {
        echo "<script language=\"javascript\"> window.alert('Error!'); </script>";
    }
}
?>
<html>
<head>
    <title>Backup</title>
<link rel="stylesheet" type="text/css" href="easyui/themes/metro/easyui.css">
<link rel="stylesheet" type="text/css" href="easyui/themes/icon.css">
<link rel="stylesheet" type="text/css" href="easyui/themes/color.css">
<script type="text/javascript" src="easyui/jquery-1.6.min.js"></script>
<script type="text/javascript" src="easyui/jquery.easyui.min.js"></script>	
</head>
<body>

<h1>Backup</h1>

<div style="padding: 10px;">
<form action="backup_aksi.php" method="POST" style="display: inline;">
    <input type="submit" value="Backup Seluruh Table" 
         name="Submit" id="backup_sql" />
</form>
</div>

<div style="padding: 10px;">
<form action="backup_aksi_table.php?tabel=transaksi" method="POST" style="display: inline;">
    <input type="submit" value="Backup Table Transaksi (data_parkir)" 
         name="Submit" id="backup_t" />
</form>

<form action="backup_aksi_table.php?tabel=admin" method="POST" style="display: inline;">
    <input type="submit" value="Backup Table Petugas (admin)" 
         name="Submit" id="backup_a" />
</form>
</div>

</body>
</html>