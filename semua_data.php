<center>
<h1>Semua Data</h1>
</center>
<?php
$query = "select * from data_parkir"; //operasi MySQL utk mnmpilkn data
$result = mysql_query($query);
//membuat table
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

//mengambil record dari database
while ($data=mysql_fetch_array($result))
{
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
echo"<br/><input type='button' class='btn' value='Kembali' onClick='javascript:history.go(-1)'/>";
?>