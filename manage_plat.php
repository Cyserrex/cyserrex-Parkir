<?php
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
	//Redirect ke halaman login
	header('location:index.php?error=5');
	}
?>
<head>
    <title>Daftar Plat</title>
<link rel="stylesheet" type="text/css" href="easyui/themes/metro/easyui.css">
<link rel="stylesheet" type="text/css" href="easyui/themes/icon.css">
<link rel="stylesheet" type="text/css" href="easyui/themes/color.css">
<script type="text/javascript" src="easyui/jquery-1.6.min.js"></script>
<script type="text/javascript" src="easyui/jquery.easyui.min.js"></script>	
</head>
<body>
<center>
<h1>Daftar Plat</h1>

<!-- SELECT * FROM logs WHERE date BETWEEN '" . $from_date . "' AND  '" . $to_date . "'
ORDER by id DESC -->

<!-- TABLE --> 
    <table id="plat_dg" title="Daftar Plat" class="easyui-datagrid" style="width:90%;height:450px"
            data-options="singleSelect:true, url:'json/data_plat.php', toolbar:'#toolbar',
			fitColumns:true, remoteSort:true, autoRowHeight:true,
			pagination:true, pageSize:50, pageList: [50,75,100]">
        <thead>
            <tr>
				<th field="id_parkir" width="70" sortable="true">ID Parkir</th>
				<th field="plat" width="60" sortable="true">Plat</th>
                <th field="tanggal" width="40" sortable="true">Tanggal</th>
                <th field="masuk" width="35" sortable="true">Jam Masuk</th>
                <th field="keluar" width="35" sortable="true">Jam Keluar</th>
                <th field="tarif" width="30" sortable="true">Tarif</th>
                <th field="nama_m" width="70" sortable="true">Petugas Masuk</th>
                <th field="nama_k" width="70" sortable="true">Petugas Keluar</th>
            </tr>
        </thead>
    </table>
	
<!-- TOOLBAR -->
    <div id="toolbar">
    <input id="plat" class="easyui-searchbox" data-options="prompt:'Cari Plat',searcher:plat_doSearch" style="color:#963; line-height:15px;border:1px solid #ccc; border-radius:5px; width:170px;"></input>	
		Tanggal Awal: <input class="easyui-datebox" style="width:120px" id="tanggal_awal"
				data-options="method:'get',
							prompt:'Pilih Tanggal',
							valueField:'tanggal_awal',
							panelHeight:'200px',
							onSelect: function(date){
								var y = date.getFullYear();
								var m = ('0' + (date.getMonth() + 1)).slice(-2);
								var d = ('0' + date.getDate()).slice(-2);	
								today = y+'-'+m+'-'+d;		
								var url = 'json/data_plat.php?tanggal='+today;
								$('#plat_dg').datagrid('reload', url);	
								}
		">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="hapus_plat()">Hapus</a>
        <form method="POST" action="json/manage_plat_aksi.php?page=pdf" style="display: inline;">
        <input value="Cetak Laporan" style="background: #D1D1D1;padding: 4px 10px 6px 10px;margin: 0px 0px;" type="submit">
        pada Bulan: <input name="bulan" id="bulan_plat" class="easyui-textbox" data-options="prompt:'Bulan'" style="color:#963; line-height:15px;border:1px solid #ccc; border-radius:5px; width:50px;"></input> 
        Tahun: <input name="tahun" id="tahun_plat" class="easyui-textbox" data-options="prompt:'Tahun'" style="color:#963; line-height:15px;border:1px solid #ccc; border-radius:5px; width:55px;"></input>
        </form>
    </div>
    
	
	
    <script type="text/javascript">
        var url;		

        function plat_doSearch(){
		$('#plat_dg').datagrid('load',{
			plat: $('#plat').val()
		});
	}
		
		
		function hapus_plat(){
					var row = $('#plat_dg').datagrid('getSelected');
					if (row){
						$.messager.confirm('Konfirmasi Hapus','Yakin ingin menghapus plat '+row.plat+' ?',function(r){
							if (r){
								$.post('json/manage_plat_aksi.php?page=hapus',{id_parkir:row.id_parkir},function(result){
									if (result.success){
										$.messager.show({
											title: 'Sukses',
											msg: "Data Berhasil Dihapus"
										})
										$('#plat_dg').datagrid('reload');	// reload the user data
										 
									} else {
										$.messager.show({	// show error message
											title: 'Error',
											msg: result.msg
										});
									}
								},'json');
							}
						});
					}else
					$.messager.alert('Peringatan','Pilih data plat terlebih dahulu','warning');
				}



    </script>    
    

</body>
</html>