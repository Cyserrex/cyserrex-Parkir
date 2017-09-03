<?php
include "../koneksi_parkir.php";
header("Content-type: application/json");
$arr = array();	

$sort  	= isset($_POST['sort'])  ? strval($_POST['sort'])  : 'id_parkir';
$order 	= isset($_POST['order']) ? strval($_POST['order']) : 'asc';
$hal   = isset($_POST['page']) ? intval($_POST['page']) : 1;
$batas = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$posisi = ($hal-1)*$batas;
$plat = isset($_POST['plat']) ? mysqli_real_escape_string($db,$_POST['plat']) : '';	
$tanggal = isset($_GET['tanggal']) ? mysqli_real_escape_string($db,$_GET['tanggal']) : '';

$where = "plat like '%$plat%' AND tanggal like '%$tanggal%'";

$sql="SELECT id_parkir, id_user_m, id_user_k, plat, tipe, tanggal, masuk, keluar, tarif, a.nama as nama_m, b.nama as nama_k FROM data_parkir dp
	LEFT JOIN admin a ON dp.id_user_m=a.id_user
	LEFT JOIN admin b ON dp.id_user_k=b.id_user
	WHERE $where
	ORDER BY $sort $order limit $posisi,$batas";


if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}	
while($row = $result->fetch_assoc()){
		$arr[] = $row;
}	

//HITUNG JUMLAH ROW
$sql_count = "SELECT id_parkir, id_user_m, id_user_k, plat, tipe, tanggal, masuk, keluar, tarif FROM data_parkir dp";
if(!$result_count = $db->query($sql_count)){
    die('There was an error running the query [' . $db->error . ']');
}	
$jml_hal=$result_count->num_rows;


echo "{\"total\":" .$jml_hal . ",\"rows\":" .json_encode($arr). "}" ;
?>