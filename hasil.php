<html>
<link rel="stylesheet" type="text/css" href="hasil.css" />
<?php
session_start();
echo "<link rel=\"icon halaman\" type=\"image/png\" href=\"logo_parkir.ico\"/>";
echo "<title>Hasil Pencarian</title>";
include "koneksi_parkir.php"; 
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
	//Redirect ke halaman login
	header('location:index.php?error=5');
	}
if(isset ($_GET['plat'])) {
    $id_plat = $_GET['plat'];
	$w_keluar = date('H:i:s');
    $min_length = 1;
    if(strlen($id_plat) >= $min_length){ 
         
        $id_plat = htmlspecialchars($id_plat);
        $id_plat = mysql_real_escape_string($id_plat);
		
		//$id_plat menggunakan tanda petik '$id_plat' agar huruf dpt diinput
		$query = "SELECT * FROM data_parkir WHERE plat='$id_plat'";
        $result = mysql_query($query) or die(mysql_error());
		
		 
        $ditemukan = mysql_num_rows($result);
        if($ditemukan){
		
           $data = mysql_fetch_array($result);
		   $w_masuk = $data['masuk'];
				//Jika tarif atau w_keluar pada database masih kosong
			if ($data['tarif']==0){

				$mulai_time=(is_string($w_masuk)?strtotime($w_masuk):$w_masuk);// memaksa mebentuk format time untuk string
				$selesai_time=(is_string($w_keluar)?strtotime($w_keluar):$w_keluar);
				$detik=$selesai_time-$mulai_time; //hitung selisih dalam detik
				$detik_hsl=abs($selesai_time-$mulai_time);
				$menit=floor($detik/60); 
				if ($selesai_time>=$mulai_time) {
					$jam=floor($menit/60); //hitung sisa jam. floor digunakan untuk menghilangkan angka dibelakang koma
					$sisa_menit=abs(floor($menit%60));   //hitung menit. floor digunakan untuk menghilangkan angka dibelakang koma
						if ($menit!=0) {$sisa_detik=$detik%60; }//hitung sisa detik jika tidak = 0
							else {$sisa_detik=0; }
				}
				else {
					$jam=floor($menit/60+24); //hitung sisa jam. floor digunakan untuk menghilangkan angka dibelakang koma
					$sisa_menit=abs(floor($menit%60+60));  //hitung menit. floor digunakan untuk menghilangkan angka dibelakang koma
						if ($menit!=0) {$sisa_detik=$detik%60+60; } //hitung sisa detik jika tidak = 0
							else {$sisa_detik=0; }				
				}
				
				if ($jam>0) 
					{
						if ($data['tipe']=='Sepeda Motor') {
							$bayar=$jam*1000;
								if ($bayar>=5000)
								{$bayar=5000;}
							} else if($data['tipe']=='Mobil') {
							$bayar=$jam*2000;
								if ($bayar>=10000)
								{$bayar=10000;}
							}
					} 
					else 
					{
						if ($data['tipe']=='Sepeda Motor') {
							$bayar=1000;
							} else if($data['tipe']=='Mobil') {
							$bayar=2000;
							}
					}
					
				//Masukkan $bayar dan $w_keluar ke database JIKA belum terisi
				$update_keluar="UPDATE data_parkir SET keluar='$w_keluar',tarif='$bayar' WHERE plat='$id_plat'";
				mysql_query($update_keluar) or die ("Gagal Menambah Data");
				echo "<div class='box'><div class='judul'>Pembayaran Parkir Keluar</div><table>";
				echo "<tr><td>ID:</td> <td>$data[id] </td></tr>";
				echo "<tr><td>Plat:</td> <td>$data[plat] </td></tr>";
				echo "<tr><td>Tipe:</td> <td>$data[tipe] </td></tr>";
				echo "<tr><td>Waktu masuk:</td> <td>$data[masuk] </td></tr>";
				echo "<tr><td>Waktu keluar:</td> <td>$w_keluar </td></tr>";
				echo "<tr><td>Waktu:</td> <td>$detik_hsl  detik ---> $jam jam. $sisa_menit  menit. $sisa_detik detik </td></tr>";
				echo "<tr><td>Bayar:</td> <td>Rp $bayar </tr>";
				echo "<tr><td>Gambar:</td> <td> <img src=$data[gambar] width='250px' height='250px'/></td></tr></table><br/>";
				echo "<input type='button' class='btn' value='Kembali' onClick='javascript:history.go(-1)'/>";
				echo "</div>";
			} 
			else 
			{
				$mulai_time=(is_string($data['masuk'])?strtotime($data['masuk']):$data['masuk']);// memaksa mebentuk format time untuk string
				$selesai_time=(is_string($data['keluar'])?strtotime($data['keluar']):$data['keluar']);
				$detik=$selesai_time-$mulai_time; //hitung selisih dalam detik
				$detik_hsl=abs($selesai_time-$mulai_time);
				$menit=floor($detik/60); 
				if ($selesai_time>=$mulai_time) {
					$jam=floor($menit/60); //hitung sisa jam. floor digunakan untuk menghilangkan angka dibelakang koma
					$sisa_menit=abs(floor($menit%60));   //hitung menit. floor digunakan untuk menghilangkan angka dibelakang koma
						if ($menit!=0) {$sisa_detik=$detik%60; }//hitung sisa detik jika tidak = 0
							else {$sisa_detik=0; }
				}
				else {
					$jam=floor($menit/60+24); //hitung sisa jam. floor digunakan untuk menghilangkan angka dibelakang koma
					$sisa_menit=abs(floor($menit%60+60));  //hitung menit. floor digunakan untuk menghilangkan angka dibelakang koma
						if ($menit!=0) {$sisa_detik=$detik%60+60; } //hitung sisa detik jika tidak = 0
							else {$sisa_detik=0; }				
				}
					
				echo "<div class='box'><div class='judul'>Pembayaran Parkir Keluar</div><table>";
				echo "<tr><td>ID:</td> <td>$data[id] </td></tr>";
				echo "<tr><td>Plat:</td> <td>$data[plat] </td></tr>";
				echo "<tr><td>Tipe:</td> <td>$data[tipe] </td></tr>";
				echo "<tr><td>Waktu masuk:</td> <td>$data[masuk] </td></tr>";
				echo "<tr><td>Waktu keluar:</td> <td>$data[keluar] </td></tr>";
				echo "<tr><td>Waktu:</td> <td>$detik_hsl  detik ---> $jam jam. $sisa_menit  menit. $sisa_detik detik </td></tr>";
				echo "<tr><td>Bayar:</td> <td>Rp $data[tarif] </tr>";
				echo "<tr><td>Gambar: </td> <td><img src=$data[gambar] width='250px' height='250px'/></td></tr></table><br/>";
				echo "<input type='button' class='btn' value='Kembali' onClick='javascript:history.go(-1)'/>";
				echo "</div>";
			}
			
        }
        else{ 
            echo "Tidak ditemukan <br/>";
			echo "<input type='button' class='btn' value='Kembali' onClick='javascript:history.go(-1)'/>";
        }
         
    }
    else{ 
        echo "Harap isi minimal ".$min_length." karakter <br/>";
		echo "<input type='button' class='btn' value='Kembali' onClick='javascript:history.go(-1)'/>";
    }
} else {echo "Tidak ada apa-apa";}
?>
<footer>&copy; 2017 Adny Nizomi Hak cipta dilindungi oleh undang-undang.</footer>
</html>