<head>
    <title>Pencarian</title>
</head>
<body>
<center>
<h1>Pencarian Plat</h1>
    <form align="center" action="" method="GET">
		Masukkan plat:
        <input type="text" name="cari" />
        <input type="submit" value="Cari" />
    </form>
</center>
<?php
include "koneksi_parkir.php";
if (!empty($_GET['cari'])) {
    $kata = $_GET['cari'];
    $min_length = 3;
    if(strlen($kata) >= $min_length){ // if query length is more or equal minimum length then
         
        $kata = htmlspecialchars($kata);
        $kata = mysql_real_escape_string($kata);

        $raw_results = mysql_query("SELECT * FROM data_parkir
            WHERE (`plat` LIKE '%".$kata."%')") or die(mysql_error());

		 
        $ditemukan = mysql_num_rows($raw_results);
        if($ditemukan > 0){ // if one or more rows are returned do following
            echo    "Ditemukan $ditemukan";
			echo "<table border='1' align='center'>
			<tr>
			<th>ID</th>
			<th>Plat</th>
			<th>Tipe</th>
			<th>Waktu Masuk</th>
			<th>Waktu Keluar</th>
			<th>Bayar</th>
			<th>Gambar</th>
			<th>Edit</th>
			<th>Hapus</th>
			</tr>";
            while($data = mysql_fetch_array($raw_results)){
			echo"<tr>
				<td>$data[id]</td>
				<td>$data[plat]</td>
				<td>$data[tipe]</td>
				<td>$data[masuk]</td>
				<td>$data[keluar]</td>
				<td>$data[tarif]</td>
				<td><img src=$data[gambar] width='100px' height='100px'/></td>
				<td><a href=form_edit.php?id=$data[id]>Edit</a></td>
				<td><a href=\"javascript:hapus(".$data['id'].")\">Hapus</a></td>
				</tr>";
				}
			echo "</table>";
			}
        else{ 
            echo "Tidak ditemukan";
        }
         
    }
    else{ 
        echo "Minimal adalah ".$min_length." huruf";
    }
}
?>
</body>
</html>