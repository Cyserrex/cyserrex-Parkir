<?php
echo "<link rel=\"icon halaman\" type=\"image/png\" href=\"logo_parkir.ico\"/>";
echo "<title>Logout</title>";
session_start();
session_unset();
session_destroy();
if(isset($_COOKIE['cookielogin']))     
{
$time = time();
    setcookie("cookielogin[user]", '', $time -86400);
    setcookie("cookielogin[pass]", '', $time -86400);
}

?>
<html>
<style type="text/css">
	body {
	background: #E3CAA1;
	}
	#otomatis {
	margin: auto;
	width: 30%;
	border: 10px solid #9c9a15;
	padding: 10px;
	}
</style>
<p id="otomatis">Anda berhasil logout. menuju <a href='index.php'>Halaman Login</a> dalam <span id="counter">3</span> detik.</p>
<script type="text/javascript">
function countdown() {
    var i = document.getElementById('counter');
    if (parseInt(i.innerHTML)<=0) {
        location.href = 'index.php';
    }
    i.innerHTML = parseInt(i.innerHTML)-1;
}
setInterval(function(){ countdown(); },1000);
</script>
</html>