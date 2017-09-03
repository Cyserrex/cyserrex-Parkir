<?php
/* Session untuk ID */
session_start();
include "koneksi_parkir.php"; 
$namafile = date('d-m-Y_H.i.s');
$nama_gambar="gambar/Parkir-" .$namafile. ".jpg";
$file = file_put_contents( $nama_gambar, file_get_contents('php://input') );
if (!$file) {
	print "ERROR: Failed to write data to $nama_gambar, check permissions\n";
	exit();
}
else
{
	if(isset ($_SESSION["id_parkir_now"])) {   // Idvalue = id dari setelah snapshot camera
	$id_p=$_SESSION["id_parkir_now"];
	/* Masukkan gambar ke table Entry pada record Images */

    $sql=$db->query("UPDATE data_parkir SET
							gambar	= '$nama_gambar'
							WHERE id_parkir='$id_p'");

    if ($sql) 
    {
    $_SESSION["id_parkir_now"]=NULL;
    } else 
    {
    echo $db->error;
    }

    
	}
}

$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/' . $nama_gambar;
print "$url\n";

?>
