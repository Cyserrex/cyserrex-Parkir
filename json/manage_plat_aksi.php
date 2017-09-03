<?php
include "../koneksi_parkir.php";
$arr = array();	

/*
if($_GET['page']=='simpan')
{
	$nim = mysqli_real_escape_string($db,$_POST['nim']);
	$tgl_bimbingan = mysqli_real_escape_string($db,$_POST['tgl_bimbingan']);
	$materi_bimbingan = mysqli_real_escape_string($db,$_POST['materi_bimbingan']);
	$id_dosen_pembimbing=$_GET['id_dosen_pembimbing'];

	$sql_nim = "SELECT tim.id_tim FROM pkl_tim tim
				where nim='$nim'";
	if(!$result_pmb = $db->query($sql_nim)){
			die('There was an error running the query [' . $db->error . ']');
			}

	$value_pmb = $result_pmb->fetch_assoc();
	$id_tim= $value_pmb['id_tim'];

	$diterima=1;
	$sql_simpan = $db->query("INSERT INTO pkl_bimbingan
						(id_dosen_pembimbing,id_tim,materi_bimbingan,tgl_bimbingan,diterima)
						VALUES 
						('$id_dosen_pembimbing','$id_tim','$materi_bimbingan','$tgl_bimbingan','$diterima')
						");

			if($sql_simpan){
			echo json_encode(array('success'=>true));
			}else{
			echo json_encode(array('msg'=>'Ada Masalah Penambahan data Bimbingan '.$db->error));
			}
}
*/

if($_GET['page']=='pdf')
{

	$dd = date('m');
	$yy = date('Y');
	$bulan = isset($_POST['bulan']) ? mysqli_real_escape_string($db,$_POST['bulan']) : $dd;
	$tahun = isset($_POST['tahun']) ? mysqli_real_escape_string($db,$_POST['tahun']) : $yy;

	if($bulan=='') {$bulan=$dd;}
	if($tahun=='') {$tahun=$yy;}
		
    $nama_bulan = strtoupper(date('F', mktime(0, 0, 0, $bulan, 10))); // March

        include ('../fpdf/fpdf.php');
        $pdf = new FPDF();
        $pdf->AddPage('Portrait','A4','0');

        $pdf->SetTitle('Laporan Parkir');

        $pdf->SetFont('Helvetica', 'B', 11);
        $pdf->Cell(190,4,'LAPORAN PARKIR BULAN '.$nama_bulan.' TAHUN '.$tahun,0,1,'C');

        $pdf->SetFontSize(9);
        $pdf->Cell(190,4,'RAMAYANA MITRA PLAZA',0,1,'C');

        $pdf->Ln(4);


        //HEADER
        $pdf->SetFont('Helvetica', 'B', 8);
        $pdf->Ln();
        //HEADER TERTINGGAL
        /*
        $pdf->SetX(185);
        $pdf->Cell(15,10,'Total',1,0,'C');
        $pdf->SetX(10);
        */
        //HEADER NEXT
        $pdf->SetX(30);
        $pdf->Cell(10,5,'No',1,0,'C');
        $pdf->Cell(30,5,'Tanggal',1,0,'C');
        $pdf->Cell(20,5,'Pendapatan',1,0,'C');
        $pdf->Cell(30,5,'Jumlah Data Parkir',1,0,'C');
        $pdf->Cell(30,5,'Total Mobil',1,0,'C');
        $pdf->Cell(30,5,'Total Sepeda Motor',1,1,'C');


//$pdf->Cell(LEBAR,TINGGI,'Perempuan',BORDER,NEWLINE,'Center');

        
        $no = 1;
        $t_perbulan=0;
        $d_perbulan=0;
        $mobil_perbulan=0;
        $sep_perbulan=0;

        for ($x = 1; $x <= 30; $x++) {
                $pdf->SetFont('Helvetica', '', 8);
                $pdf->SetX(30);

            $sql = "SELECT *, SUM(tarif) AS t_total, COUNT(tanggal) AS d_total, SUM(case when tipe = 'Mobil' then 1 else 0 end) as mobil_total, SUM(case when tipe = 'Sepeda Motor' then 1 else 0 end) as sep_total FROM data_parkir WHERE tanggal='$tahun-$bulan-$x' GROUP BY tanggal";
            if(!$result = $db->query($sql)){
                die('There was an error running the query [' . $db->error . ']');
            }   

            $total_data = $result->num_rows;

            while($row = $result->fetch_assoc()){
                $pdf->Cell(10, 5, $no, 1,0,'C');
                $pdf->Cell(30, 5, $row['tanggal'], 1,0,'C');
                $pdf->Cell(20, 5, 'Rp '.$row['t_total'], 1,0,'C');
                $pdf->Cell(30, 5, $row['d_total'], 1,0,'C');
                $pdf->Cell(30, 5, $row['mobil_total'], 1,0,'C');
                $pdf->Cell(30, 5, $row['sep_total'], 1,0,'C');

                $pdf->Ln();
                $no++;
                $t_perbulan+=$row['t_total'];
                $d_perbulan+=$row['d_total'];
                $mobil_perbulan+=$row['mobil_total'];
                $sep_perbulan+=$row['sep_total'];

            }
                
        }
                $pdf->Cell(40, 5, 'Total:', 1,0,'C');
                $pdf->Cell(20, 5, 'Rp '.$t_perbulan, 1,0,'C');
                $pdf->Cell(30, 5, $d_perbulan, 1,0,'C');
                $pdf->Cell(30, 5, $mobil_perbulan, 1,0,'C');
                $pdf->Cell(30, 5, $sep_perbulan, 1,0,'C');

       
        
        $pdf->Output('I','Laporan_Parkir.pdf',0);
        //$pdf->Output(DESTINATION,NAMA,isUTF8);
        exit;
}


if($_GET['page']=='hapus')
{
header("Content-type: application/json");

	$id_parkir = $_POST['id_parkir'];

	$sql = $db->query("DELETE FROM data_parkir WHERE id_parkir='$id_parkir' ");	
	if($sql){
		echo json_encode(array('success'=>true));
	}else{
		echo json_encode(array('msg'=>'Ada Masalah penghapusan data'));
	}
}

?>