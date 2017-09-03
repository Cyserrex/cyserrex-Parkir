<?php
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
	$nama=$value['nama'];
	$password=$value['username'];
	$id_user=$value['id_user'];

if ($lvl != '0' AND $lvl !='2') {
	//Redirect ke halaman login
	header('location:index.php?error=5');
	}

if (!empty($_GET['error_keluar'])) {
	if ($_GET['error_keluar'] == 1) {
		echo "<script language=\"javascript\"> window.alert('Plat tidak ditemukan!'); </script>";
	} else if ($_GET['error_keluar'] == 2) {
		echo "<script language=\"javascript\"> window.alert('Plat telah keluar!'); </script>";
	} 
}
?>
<html>
<head>
    <title>Search</title>
</head>
<body>
<h2>Parkir Keluar</h2>
<div class="waktu">
<?php  echo date("d M Y")?>
<br/></div>
<script type="text/javascript" src="webcam.js"></script>
<script language="JavaScript">
			document.write( webcam.get_html(320, 240) );  
</script>
<table>
    <form align="center" action="aksi_hasil.php" method="POST">
    <input hidden name="id_user" value="<?php echo $id_user; ?>">
		<tr>
		<td>Masukkan Plat</td>
		<td id="t_dua">: </td>
        <td>
        <input type='text' style='width:50px;text-transform:uppercase;font-weight:bold;' name='plat1'  class='inputs alphab' maxlength='2'> 
		<input type='text' style='width:65px;text-transform:uppercase;font-weight:bold;' name='plat2'  class='inputs num' maxlength='5'>
		<input type='text' style='width:65px;text-transform:uppercase;font-weight:bold;' name='plat3'  class='inputs alphab' maxlength='3'>
        </td>
		</tr>
		<td>Waktu Keluar</td>
		<td id="t_dua">: </td>
		<td><input type='text' name='w_masuk' id='jam' class='jam' disabled='true'></td>
		</tr>
		</table>
		<br/>
        <input type="submit" value="Submit" name="submit"/>
    </form> 
</body>

<script type="text/javascript">
	//FUNGSI ALPHAONLY
		$('.alphab').bind('keyup blur',function(){ 
	    var node = $(this);
	    node.val(node.val().replace(/[^a-zA-Z]/g,'') ); }
		);

		//FUNGSI NUMONLY
		$('.num').bind('keyup blur',function(){ 
	    var node = $(this);
	    node.val(node.val().replace(/[^0-9]/g,'') ); }
		);


		//FUNGSI JIKA KOSONG
		$('form').submit(function () {
	    var plat1 = $.trim($("input[name='plat1']").val());
	    var plat2 = $.trim($("input[name='plat2']").val());
	    var plat3 = $.trim($("input[name='plat3']").val());
	    var tipe = $.trim($("input[name='tipe']:checked").val());

	    if (plat1 === '') {
	        $().toastmessage('showErrorToast', "Kode pertama plat masih kosong.");
	        $("input[name='plat1']").css({
	         "border-color": "red",
	         "border-width": "5px",
	         "border-style": "solid",});
	        $("input[name='plat1']").animate({
	         "border-color": "white",
	     	 "border-width": "0px",
	     	 "border-style": "none",}, 1500);
	        $( "input[name='plat1']").focus();
	        
	        //$("input[name='plat1']").css('border', '2px solid red');
	        //$( "input[name='plat"+i+"']").focus();
	        return false;	        
	    }
	    else if (plat2 === '') {
	        $().toastmessage('showErrorToast', "Kode kedua plat masih kosong.");
	        $("input[name='plat2']").css({
	         "border-color": "red",
	         "border-width": "5px",
	         "border-style": "solid",});
	        $("input[name='plat2']").animate({
	         "border-color": "white",
	     	 "border-width": "0px",
	     	 "border-style": "none",}, 1500);
	        $( "input[name='plat2']").focus();
	        return false;	
	    }
	    else if (plat3 === '') {
	    	$().toastmessage('showErrorToast', "Kode ketiga plat masih kosong.");
	        $("input[name='plat3']").css({
	         "border-color": "red",
	         "border-width": "5px",
	         "border-style": "solid",});
	        $("input[name='plat3']").animate({
	         "border-color": "white",
	     	 "border-width": "0px",
	     	 "border-style": "none",}, 1500);
	        $( "input[name='plat3']").focus();
	        return false;	
	    }
	    
	    
	     
		});

</script>
</html>