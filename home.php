<?php
session_start();
include "koneksi_parkir.php"; 
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
	//Redirect ke halaman login
	header('location:index.php?error=5');
	}

$username = $_SESSION['username'];

$sql = "SELECT * FROM admin WHERE username='$username'";
if(!$result = $db->query($sql)){
  die('There was an error running the query [' . $db->error . ']');
} 
$value = $result->fetch_assoc();
$lvl=$value['level'];

?>
<html>
<head>
<link rel="icon halaman" type="image/png" href="logo_parkir.ico"/>
<title>Sistem Informasi Parkir</title>
</head>
<link href="css/style_form_parkir.css" rel="stylesheet" type="text/css"> 
<script type="text/javascript" src="script/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="script/jquery-ui-1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="toastm/javascript/jquery.toastmessage.js"></script>
<link href="script/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css">
<link href="toastm/resources/css/jquery.toastmessage.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
//FUNGSI MAX LENGTH
$(document).ready(function(){
            $(".inputs").keyup(function () {
    if (this.value.length == this.maxLength) {
      var $next = $(this).next('.inputs');
      if ($next.length)
          $(this).next('.inputs').focus();
      else
          $(this).blur();
    }
});
        });

//Fungsi Jam tambah 0 didepan
  function tambahNol(i) {
      if (i < 10) {
          i = "0" + i;
      }
      return i;
  }
    // 1 detik = 1000, waktu refresh perulangan
    window.setTimeout("waktu()",1000);   
    function waktu() {    
        var parkiran = new Date();   
        setTimeout("waktu()",1000);   
       document.getElementById("jam").value = tambahNol(parkiran.getHours())+":"+tambahNol(parkiran.getMinutes())+":"+tambahNol(parkiran.getSeconds()); 
   } 
</script>
<body>
<ul>
<?php if ($lvl == '0' OR $lvl == '1') {?>
  <li><a href="home.php?p=parkir_masuk">Parkir Masuk</a></li>
<?php } ?>
<?php if ($lvl == '0' OR $lvl == '2') {?>
  <li><a href="home.php?p=parkir_keluar">Parkir Keluar</a></li>
<?php } ?>
<?php if ($lvl == '0') {?>
  <li><a href="lihat_data.php">Administrator</a></li>
<?php } ?>
  <li><a href="home.php?p=pengaturan">Akun</a></li>
  <li><a href="logout.php">Keluar</a></li>
</ul>
<div class="dark-matter">
<?php
/*Untuk Halaman Berfolder
        $pages_dir = 'pages';
        if(!empty($_GET['p'])){
            $pages = scandir($pages_dir, 0);
            unset($pages[0], $pages[1]);
 
            $p = $_GET['p'];
            if(in_array($p.'.php', $pages)){
                include($pages_dir.'/'.$p.'.php');
            } else {
                echo 'Halaman tidak ditemukan! :(';
            }
        } else {
            include($pages_dir.'/parkir_masuk.php');
        }
        ?>
*/
		if(!empty($_GET['p'])){
			$page = $_GET['p'];
			if (file_exists($page.".php"))
      {
        include($page.".php");
      }else {
        echo "<b><h1>ERROR 404</h1></b>";
      }
		}else{
      if ($lvl == '1')
      {include("parkir_masuk.php");}
      else if ($lvl == '2')
      {include("parkir_keluar.php");}
      else
      {include("parkir_masuk.php");}
			
		}
?>
</div>
<footer>&copy; 2017 Adny Nizomi. Hak cipta dilindungi oleh undang-undang.</footer>
</body>
</html>