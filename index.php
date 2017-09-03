<?php 
session_start();
if (!empty($_SESSION['username'])) {
	header('location:home.php');
}
//Cek cookie a.k.a remeber me tercentang
if(isset($_COOKIE['cookielogin'])){
    //cek cookie login dengan password dan username yang valid
    if(($_COOKIE['cookielogin']['username']==$user)&&($_COOKIE['cookielogin']['password']==$pass)){
        print_r($_COOKIE);
        //jika valid set status login 1
        $_SESSION['username']= 1;
        //redirect ke halaman member area
        header('Location: home.php'); 
    }
}
//kode php ini kita gunakan untuk menampilkan pesan eror
if (!empty($_GET['error'])) {
	if ($_GET['error'] == 1) {
		echo "<script language=\"javascript\"> window.alert('Username dan Password belum diisi!'); </script>";
	} else if ($_GET['error'] == 2) {
		echo "<script language=\"javascript\"> window.alert('Username belum diisi!'); </script>";
	} else if ($_GET['error'] == 3) {
		echo "<script language=\"javascript\"> window.alert('Password belum diisi!'); </script>";
	} else if ($_GET['error'] == 4) {
		echo "<script language=\"javascript\"> window.alert('Username dan Password tidak terdaftar!'); </script>";
	} else if ($_GET['error'] == 5) {
		echo "<script language=\"javascript\"> window.alert('Anda harus login terlebih dahulu!'); </script>";
	}
}
?>
<head>
  <link rel="icon halaman" type="image/png" href="logo_parkir.ico"/>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Login</title>
  <link rel="stylesheet" href="css/style.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <style type="text/css">
    #sc {
      width: 90px !important;
      line-height: 20px !important;
    }
  </style>
</head>
<body>
  <form method="post" action="aksi_login.php" class="login">
    <p>
      <label for="login">User:</label>
      <input type="text" name="username" id="login">
    </p>

    <p>
      <label for="password">Password:</label>
      <input type="password" name="password" id="password">
    </p>
	<p>
      <input type="checkbox" name="setcookie" id="setcookie" value="true"><label id="sc" for="setcookie">Ingat saya</label>
    </p>

    <p class="login-submit">
      <button type="submit" class="login-button">Login</button>
    </p>
      <button type="reset" class="reset-button">Reset</button>
  </form>


</body>
</html>