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

if ($lvl != '0' AND $lvl !='1') {
	//Redirect ke halaman login
	header('location:index.php?error=5');
	}

if (!empty($_GET['error_masuk'])) {
	if ($_GET['error_masuk'] == 1) {
		echo "<script language=\"javascript\"> window.alert('Plat telah masuk dan belum keluar!'); </script>";
	} else if ($_GET['error_masuk'] == 2) {
		echo "<script language=\"javascript\"> window.alert('Plat telah keluar!'); </script>";
	} 
}
?>
<html>
<h2>Parkir Masuk</h2>
<script type="text/javascript">
/*
function validasi_input(form) {
if (form.plat.value=='' || form.tipe.value=='') {
	if (form.plat.value=='') {
	alert ("Plat harus diisi");
	return(false);
	}
	else if (form.tipe.value=='') {
	alert ("Jenis Mobil/Sepeda Motor tidak boleh kosong");
	return(false);
	}
} else {
return(true);
}
}
*/
</script>
<!-- Camera -->
	<script type="text/javascript" src="webcam.js"></script>
	<script type="text/javascript"> 
		webcam.set_api_url( 'camera.php' );
		webcam.set_quality( 100 ); // Kualitas JPEG (1 - 100)
		webcam.set_shutter_sound( true ); // play shutter click sound
		webcam.get_html(320, 240);

	
   </script>
<div class="waktu">
<?php  echo date("d M Y")?>
<br/></div>

<script language="JavaScript">
			document.write( webcam.get_html(320, 240) );  
</script>
		<div id="upload_results"></div>
			<input id="ambil_gambar" type="button" value="Lock" onClick="webcam.freeze()">	
			<input id="reset_gambar" type="button" value="Reset" onClick="webcam.reset()">
<form action="edit.php" method="post">
<table>
<input hidden name="id_user" value="<?php echo $id_user; ?>">
	<tr>
	<td>Nomor Plat</td>
	<td>: </td>
	<td>
	<input type='text' style='width:50px;text-transform:uppercase;font-weight:bold;' name='plat1'  class='inputs alphab' maxlength='2'> 
	<input type='text' style='width:65px;text-transform:uppercase;font-weight:bold;' name='plat2'  class='inputs num' maxlength='5'>
	<input type='text' style='width:65px;text-transform:uppercase;font-weight:bold;' name='plat3'  class='inputs alphab' maxlength='3'>
	</td>
	</tr>
	<tr>
	<td>Mobil/Sepeda Motor</td>
	<td >: </td>
	<td>
	<label><input type='radio' name='tipe' id='tipe' value='Mobil' >Mobil</label>
	</br>
	<label><input type='radio' name='tipe' id='tipe' value='Sepeda Motor'>Sepeda Motor</label>
	</td>
	</tr>
	<tr>
	<td>Waktu Masuk</td>
	<td>: </td>
	<td><input type='text' name='w_masuk' id='jam' class='jam' disabled='true'></td>
	</tr>
	</table>
	<br/>
	<input type='submit' name='submit' value='Submit & Print'/>
	<input type='reset' value='Reset Form'/>
</form>
<script language="JavaScript">
		webcam.set_hook( 'onComplete', 'my_completion_handler' );
		
		function take_snapshot() {
			// Ambil gambar dan upload ke server
			document.getElementById('upload_results').innerHTML = '<h1>Mengunggah...</h1>';
			webcam.snap();
		}
		
		function my_completion_handler(msg) {
			// extract URL dari keluaran PHP
			if (msg.match(/(http\:\/\/\S+)/)) {
				var image_url = RegExp.$1;
				// Tampilkan status upload
				document.getElementById('upload_results').innerHTML = 
					'<h1>Unggah berhasil!</h1>' + 
					'<h3>Terunggah di: ' + image_url + '</h3>'; 
					//'<img src="' + image_url + '">';
				
				// Reset kamera sesudah ambil gambar
				webcam.reset();
			}
			else alert("PHP Error: " + msg);
		}

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

		//FUNGSI CEK TOMBOL FREEZE
		$("#ambil_gambar").click(function(){
	    	$(this).data('clicked', true);
		}); 
		$("#reset_gambar").click(function(){
	    	$("#ambil_gambar").data('clicked', null);
		}); 

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
	    else if (tipe === '') {
	    	$().toastmessage('showErrorToast', "Jenis Mobil/Sepeda Motor tidak boleh kosong.");
	        $("input[name='tipe']").css({
	         "border-color": "red",
	         "border-width": "5px",
	         "border-style": "solid",});
	        $("input[name='tipe']").animate({
	         "border-color": "white",
	     	 "border-width": "0px",
	     	 "border-style": "none",}, 1500);
	        $( "input[name='tipe']").focus();
	        return false;	
	    }
	    else {
	    	if($('#ambil_gambar').data('clicked')) {
			   webcam.upload();
			}
			else{
				$().toastmessage('showWarningToast', "Kamera belum ditangkap.");
				$("#ambil_gambar").css({
		         "border-color": "red",
		         "border-width": "3px",
		         "border-style": "solid",});
		        $("#ambil_gambar").animate({
		         "border-color": "white",}, 1500);
				return false;
			}
	    }
	     
		});
	    
			
	</script>
	
</div>

</html>