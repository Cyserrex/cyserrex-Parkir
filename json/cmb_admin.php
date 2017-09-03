<?php
include "../koneksi_parkir.php";
header("Content-type: application/json");
$arr = array();	


	
$sql = "SELECT level, nama_jabatan, concat('Petugas ',nama_jabatan) as text FROM level_jabatan WHERE level!='0'";

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}	

while($row = $result->fetch_assoc()){
		$arr[] = $row;
}	
	echo json_encode($arr) ;
?>