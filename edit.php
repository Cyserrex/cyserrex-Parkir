<html>
<script type="text/javascript" src="print.js"></script>
<link rel="stylesheet" type="text/css" href="print.css" />
<?php
session_start();
include 'koneksi_parkir.php';
//Camera ID
if(isset ($_POST["submit"])) {
	if (!empty ($_POST['plat1']) || !empty ($_POST['plat2']) || !empty ($_POST['plat3'])) {
	
		$plat1				= $_POST['plat1'];
		$plat2				= $_POST['plat2'];
		$plat3				= $_POST['plat3'];
		$tipe				= $_POST['tipe'];
		$id_user_masuk		= $_POST['id_user'];
		$w_masuk			= date('H:i:s');

		$nomorplat 			= strtoupper($plat1." ".$plat2." ".$plat3);

	    $id_a = date('dmYHis'); 
	    $id_b = substr($tipe,0,1);

	    $id_parkir = "$id_b$id_a";

	    $tanggal = date('Y-m-d');

	    $sql = "SELECT * FROM data_parkir WHERE plat='$nomorplat' AND tarif='0'";
        if(!$result = $db->query($sql)){
            die('Error ketika menjalankan query [' . $db->error . ']');
            }
            $value   = $result->fetch_assoc();

        if ($nomorplat != $value['plat'])
        {


			// Sisipkan Data ke database dimana ID gambar yang sekarang
			//$sql="UPDATE data_parkir SET plat='$nomorplat',tipe='$tipe',masuk='$w_masuk' 
			//WHERE id='$idvalue'";

			$sql_simpan = $db->query("INSERT INTO data_parkir
					(id_parkir,id_user_m,plat,tipe,tanggal,masuk)
					VALUES 
					('$id_parkir','$id_user_masuk','$nomorplat','$tipe','$tanggal','$w_masuk')
					");

			if($sql_simpan){	
				//$value=$db->insert_id;
    			$_SESSION["id_parkir_now"]=$id_parkir;
				//Kembalikan Session myvalue ke NULL
				//echo "ID ke ".$idvalue." atas plat ".$nomorplat." telah terupdate";
				//echo "<br/><a href='home.php'>Ok</a>";
				echo"<input type='button' class='btn' value='Kembali' onClick='javascript:history.go(-1)'/>";				
				echo "
						<body onload='PrintDoc()'>
							<div style='visibility: hidden;' id='printarea'>
							    <table>
								<img class='gbr' src='img/ramayana.jpg' alt='Ramayana Mitra Plaza'></img>
				        <tr>
				            <td>
				                Nomor plat:
				            </td>
				            <td>
				                $nomorplat
				            </td>
				        </tr>
				        <tr>
				            <td>
				                Jenis:
				            </td>
				            <td>
				                $tipe
				            </td>
				        </tr>
				        <tr>
				            <td>
				                Waktu masuk:
				            </td>
				            <td>
				                $w_masuk WITA
				            </td>
				        </tr>
						</table>
							</div> <body>
							";

								//echo"<script language=javascript>alert('Nomor Polisi: \"$nomorplat\" telah terinput ke database.')</script>";			
			}
			else
			{
				echo "Gagal";
			}

		}else
		{
			echo "Plat telah masuk dan belum keluar <br/>";
            header('location:home.php?p=parkir_masuk&error_masuk=1');
		}
		
	}
	else {
			echo"<script language=javascript>alert('Data masih kosong')</script>";
			echo"<script type='text/javascript'>history.go(-1);</script>";
		 }
} else {echo "Tidak ada apa-apa";}
?>
</html>