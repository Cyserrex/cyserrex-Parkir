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
if (isset($_POST["submit"])) {
    $plat1               = $_POST['plat1'];
    $plat2               = $_POST['plat2'];
    $plat3               = $_POST['plat3'];
    $id_user_keluar      = $_POST['id_user'];
    
    $id_plat    = strtoupper($plat1 . " " . $plat2 . " " . $plat3);
    $w_keluar   = date('H:i:s');
    $min_length = 1;
    if (strlen($id_plat) >= $min_length) {
        
        $id_plat = htmlspecialchars($id_plat);
        $id_plat = mysql_real_escape_string($id_plat);
        
        //$id_plat menggunakan tanda petik '$id_plat' agar huruf dpt diinput
        $sql = "SELECT * FROM data_parkir WHERE plat='$id_plat'";
        if(!$result = $db->query($sql)){
            die('Error ketika menjalankan query [' . $db->error . ']');
            }
            $value   = $result->fetch_assoc();

        if ($id_plat == $value['plat']) {
            
            
            $w_masuk = $value['masuk'];
            //Jika tarif atau w_keluar pada database masih kosong
            if ($value['tarif'] == 0) {
                
                $mulai_time   = (is_string($w_masuk) ? strtotime($w_masuk) : $w_masuk); // memaksa mebentuk format time untuk string
                $selesai_time = (is_string($w_keluar) ? strtotime($w_keluar) : $w_keluar);
                $detik        = $selesai_time - $mulai_time; //hitung selisih dalam detik
                $detik_hsl    = abs($selesai_time - $mulai_time);
                $menit        = floor($detik / 60);
                if ($selesai_time >= $mulai_time) {
                    $jam        = floor($menit / 60); //hitung sisa jam. floor digunakan untuk menghilangkan angka dibelakang koma
                    $sisa_menit = abs(floor($menit % 60)); //hitung menit. floor digunakan untuk menghilangkan angka dibelakang koma
                    if ($menit != 0) {
                        $sisa_detik = $detik % 60;
                    } //hitung sisa detik jika tidak = 0
                    else {
                        $sisa_detik = 0;
                    }
                } else {
                    $jam        = floor($menit / 60 + 24); //hitung sisa jam. floor digunakan untuk menghilangkan angka dibelakang koma
                    $sisa_menit = abs(floor($menit % 60 + 60)); //hitung menit. floor digunakan untuk menghilangkan angka dibelakang koma
                    if ($menit != 0) {
                        $sisa_detik = $detik % 60 + 60;
                    } //hitung sisa detik jika tidak = 0
                    else {
                        $sisa_detik = 0;
                    }
                }
                
                if ($jam > 0) {
                    if ($value['tipe'] == 'Sepeda Motor') {
                        $bayar = $jam * 1000;
                        if ($bayar >= 5000) {
                            $bayar = 5000;
                        }
                    } else if ($value['tipe'] == 'Mobil') {
                        $bayar = $jam * 2000;
                        if ($bayar >= 10000) {
                            $bayar = 10000;
                        }
                    }
                } else {
                    if ($value['tipe'] == 'Sepeda Motor') {
                        $bayar = 1000;
                    } else if ($value['tipe'] == 'Mobil') {
                        $bayar = 2000;
                    }
                }
                
                //Masukkan $bayar dan $w_keluar ke database JIKA belum terisi
                $sql_update = $db->query("UPDATE data_parkir SET
                id_user_k = '$id_user_keluar',
				keluar    ='$w_keluar',
				tarif     ='$bayar' 
				WHERE plat='$id_plat'");
                
                if ($sql_update) {
                    //echo json_encode(array('success'=>true));
                } else {
                    echo json_encode(array(
                        'msg' => 'Gagal Menambah Data. [' . $db->error . ']'
                    ));
                }
                
                echo "<div class='box'><div class='judul'>Pembayaran Parkir Keluar</div><table>";
                echo "<tr><td>ID:</td> <td>$value[id_parkir] </td></tr>";
                echo "<tr><td>Plat:</td> <td>$value[plat] </td></tr>";
                echo "<tr><td>Tipe:</td> <td>$value[tipe] </td></tr>";
                echo "<tr><td>Waktu masuk:</td> <td>$value[masuk] </td></tr>";
                echo "<tr><td>Waktu keluar:</td> <td>$w_keluar </td></tr>";
                echo "<tr><td>Waktu:</td> <td>$detik_hsl  detik ---> $jam jam. $sisa_menit  menit. $sisa_detik detik </td></tr>";
                echo "<tr><td>Bayar:</td> <td>Rp $bayar </tr>";
                echo "<tr><td>Gambar:</td> <td> <img src='$value[gambar]' width='250px' height='250px'/></td></tr></table><br/>";
                echo "<a href='home.php?p=parkir_keluar'><button>Kembali</button></a>";
                echo "</div>";
            } else {
                $mulai_time   = (is_string($value['masuk']) ? strtotime($value['masuk']) : $value['masuk']); // memaksa mebentuk format time untuk string
                $selesai_time = (is_string($value['keluar']) ? strtotime($value['keluar']) : $value['keluar']);
                $detik        = $selesai_time - $mulai_time; //hitung selisih dalam detik
                $detik_hsl    = abs($selesai_time - $mulai_time);
                $menit        = floor($detik / 60);
                if ($selesai_time >= $mulai_time) {
                    $jam        = floor($menit / 60); //hitung sisa jam. floor digunakan untuk menghilangkan angka dibelakang koma
                    $sisa_menit = abs(floor($menit % 60)); //hitung menit. floor digunakan untuk menghilangkan angka dibelakang koma
                    if ($menit != 0) {
                        $sisa_detik = $detik % 60;
                    } //hitung sisa detik jika tidak = 0
                    else {
                        $sisa_detik = 0;
                    }
                } else {
                    $jam        = floor($menit / 60 + 24); //hitung sisa jam. floor digunakan untuk menghilangkan angka dibelakang koma
                    $sisa_menit = abs(floor($menit % 60 + 60)); //hitung menit. floor digunakan untuk menghilangkan angka dibelakang koma
                    if ($menit != 0) {
                        $sisa_detik = $detik % 60 + 60;
                    } //hitung sisa detik jika tidak = 0
                    else {
                        $sisa_detik = 0;
                    }
                }
                
                echo "<div class='box'><div class='judul'>Pembayaran Parkir Keluar</div><table>";
                echo "<tr><td>ID:</td> <td>$value[id_parkir] </td></tr>";
                echo "<tr><td>Plat:</td> <td>$value[plat] </td></tr>";
                echo "<tr><td>Tipe:</td> <td>$value[tipe] </td></tr>";
                echo "<tr><td>Waktu masuk:</td> <td>$value[masuk] </td></tr>";
                echo "<tr><td>Waktu keluar:</td> <td>$value[keluar] </td></tr>";
                echo "<tr><td>Waktu:</td> <td>$detik_hsl  detik ---> $jam jam. $sisa_menit  menit. $sisa_detik detik </td></tr>";
                echo "<tr><td>Bayar:</td> <td>Rp $value[tarif] </tr>";
                echo "<tr><td>Gambar: </td> <td><img src='$value[gambar]' width='250px' height='250px'/></td></tr></table><br/>";
                echo "<a href='home.php?p=parkir_keluar'><button>Kembali</button></a>";
                echo "</div>";
            }
            
        } else {
            echo "Tidak ditemukan <br/>";
            header('location:home.php?p=parkir_keluar&error_keluar=1');
        }
        
    } else {
        echo "Harap isi minimal " . $min_length . " karakter <br/>";
        echo "<input type='button' class='btn' value='Kembali' onClick='javascript:history.go(-1)'/>";
    }
} else {
    echo "Tidak ada apa-apa";
}
?>
<footer>&copy; 2017 Adny Nizomi Hak cipta dilindungi oleh undang-undang.</footer>
</html>