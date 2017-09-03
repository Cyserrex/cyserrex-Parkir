<?php
include "../koneksi_parkir.php";
header("Content-type: application/json");
$arr = array();	

$sort  	= isset($_POST['sort'])  ? strval($_POST['sort'])  : 'id_user';
$order 	= isset($_POST['order']) ? strval($_POST['order']) : 'asc';
$hal   = isset($_POST['page']) ? intval($_POST['page']) : 1;
$batas = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$posisi = ($hal-1)*$batas;
$nama = isset($_POST['nama']) ? mysqli_real_escape_string($db,$_POST['nama']) : '';	

$where = "nama like '%$nama%'";

$sql="SELECT * FROM admin a 
	LEFT JOIN level_jabatan lj ON lj.level=a.level
	WHERE a.level!='0' AND $where
	ORDER BY $sort $order limit $posisi,$batas";


if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}	
while($row = $result->fetch_assoc()){
		$arr[] = $row;
}	

//HITUNG JUMLAH ROW
$sql_count = "SELECT * FROM admin WHERE level!='0'";
if(!$result_count = $db->query($sql_count)){
    die('There was an error running the query [' . $db->error . ']');
}	
$jml_hal=$result_count->num_rows;


echo "{\"total\":" .$jml_hal . ",\"rows\":" .json_encode($arr). "}" ;
?>