<?php
include "../koneksi_parkir.php";
header("Content-type: application/json");
$arr = array();	


if($_GET['page']=='simpan')
{

	$nama=$_POST['nama'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$level=$_POST['level'];


	$sql_uname = "SELECT username FROM admin
				where username='$username'";
	if(!$result_uname = $db->query($sql_uname)){
			die('There was an error running the query [' . $db->error . ']');
			}

	$value_uname = $result_uname->num_rows;

	if ($value_uname=='0')
	{
		$sql_simpan = $db->query("INSERT INTO admin
							(nama,username,password,level)
							VALUES 
							('$nama','$username','$password','$level')
							");

				if($sql_simpan){
				echo json_encode(array('success'=>true));
				}else{
				echo json_encode(array('msg'=>'Ada masalah penambahan data '.$db->error));
				}
	}
	else
	{
		echo json_encode(array('msg'=>'Username '.$username.' sudah ada '));
	}
}

if($_GET['page']=='edit')
{
	$id_user=$_POST['id_user'];
	$nama=$_POST['nama'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$level=$_POST['level'];

	//Cek USERNAME selain id_user yang diedit
	$sql_uname = "SELECT username FROM admin
				where id_user <> $id_user AND username='$username'";
	if(!$result_uname = $db->query($sql_uname)){
			die('There was an error running the query [' . $db->error . ']');
			}

	$value_uname = $result_uname->num_rows;

	if ($value_uname=='0')
	{
		$sql = $db->query("UPDATE admin SET
					nama			= '$nama',
					username		= '$username',
					password		= '$password',
					level			= '$level'
					WHERE 	id_user = '$id_user'");	
		if($sql){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>'Ada Masalah edit atas nama '.$nama));
		}
	}
	else
	{
		echo json_encode(array('msg'=>'Username '.$username.' sudah ada '));
	}
}


if($_GET['page']=='hapus')
{
	$id_user = $_POST['id_user'];

	$sql = $db->query("DELETE FROM admin WHERE id_user='$id_user' ");	
	if($sql){
		echo json_encode(array('success'=>true));
	}else{
		echo json_encode(array('msg'=>'Ada Masalah penghapusan data'));
	}
}

?>