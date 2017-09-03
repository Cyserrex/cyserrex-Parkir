<?php
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
	//Redirect ke halaman login
	header('location:index.php?error=5');
	}
?>
<head>
    <title>Daftar Petugas</title>
<link rel="stylesheet" type="text/css" href="easyui/themes/metro/easyui.css">
<link rel="stylesheet" type="text/css" href="easyui/themes/icon.css">
<link rel="stylesheet" type="text/css" href="easyui/themes/color.css">
<script type="text/javascript" src="easyui/jquery-1.6.min.js"></script>
<script type="text/javascript" src="easyui/jquery.easyui.min.js"></script>	
</head>
<body>
<center>
<h1>Daftar Petugas</h1>

<!-- SELECT * FROM logs WHERE date BETWEEN '" . $from_date . "' AND  '" . $to_date . "'
ORDER by id DESC -->

<!-- TABLE --> 
    <table id="ptgs_dg" title="Daftar Petugas" class="easyui-datagrid" style="width:90%;height:450px"
            data-options="singleSelect:true, url:'json/data_petugas.php', toolbar:'#toolbar',
			fitColumns:true, remoteSort:true, autoRowHeight:true,
			pagination:true, pageSize:50, pageList: [50,75,100]">
        <thead>
            <tr>
				<th field="id_user" width="20" sortable="true">ID User</th>
				<th field="nama" width="50" sortable="true">Nama</th>
                <th field="username" width="40" sortable="true">Username</th>
                <th field="password" hidden="true" width="40" sortable="true">Password</th>
                <th field="nama_jabatan" width="40" sortable="true">Petugas</th>

            </tr>
        </thead>
    </table>
	
<!-- TOOLBAR -->
    <div id="toolbar">
    <input id="nama" class="easyui-searchbox" data-options="prompt:'Cari Nama Petugas',searcher:ptgs_doSearch" style="color:#963; line-height:15px;border:1px solid #ccc; border-radius:5px; width:200px;"></input>	
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="tambah_ptgs()">Tambah</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="edit_ptgs()">Edit</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="hapus_ptgs()">Hapus</a>
    </div>
    
<!--TAMBAH ADMIN-->
<div id="tambah_ptgs_dlg" class="easyui-dialog" style="left:500px;;top:150px;" closed="true" 
	buttons="#tambah_ptgs_dlg-buttons" >
		<form id="tambah_ptgs_fm" method="post" style="margin:0;padding:20px 50px">
			<div style="font-weight:bold;margin-bottom:20px;font-size:14px;border-bottom:1px solid #ccc">Input Petugas</div>
            <div style="margin-bottom:10px">
                <input name="nama" class="easyui-textbox" data-options="required:true,missingMessage:'Nama Harus Diisi.'" label="Nama:" style="width:300px">
            </div>
            <div style="margin-bottom:10px">
                <input name="username" class="easyui-textbox" data-options="required:true,missingMessage:'Username Harus Diisi.'" label="Username:" style="width:300px">
            </div>
            <div style="margin-bottom:10px">
                <input name="password" class="easyui-passwordbox" data-options="min:6,required:true,missingMessage:'Password Harus Diisi.'" label="Password:" style="width:300px">
            </div>
            <div style="margin-bottom:10px">
                <input class="easyui-combobox" type="text" name="level" style="width:280px"
								data-options="url:'json/cmb_admin.php',method:'get',required:'true',
								valueField:'level',textField:'text',panelHeight:'75px',missingMessage:'Jabatan Harus Dipilih.'" label="Jabatan:"></input>
            </div>
		</form>
	</div>	
	<div id="tambah_ptgs_dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok"     onclick="tambah_ptgs_save()">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#tambah_ptgs_dlg').dialog('close')">Cancel</a>
	</div>

<!--EDIT ADMIN-->
<div id="edit_ptgs_dlg" class="easyui-dialog" style="left:500px;top:150px;" closed="true" 
	buttons="#edit_ptgs_dlg-buttons" >
		<form id="edit_ptgs_fm" method="post" style="margin:0;padding:20px 50px">
		<input type="text" hidden name="id_user">
			<div style="font-weight:bold;margin-bottom:20px;font-size:14px;border-bottom:1px solid #ccc">Edit Petugas</div>
            <div style="margin-bottom:10px">
                <input name="nama" class="easyui-textbox" data-options="required:true,missingMessage:'Nama Harus Diisi.'" label="Nama:" style="width:300px">
            </div>
            <div style="margin-bottom:10px">
                <input name="username" class="easyui-textbox" data-options="required:true,missingMessage:'Username Harus Diisi.'" label="Username:" style="width:300px">
            </div>
            <div style="margin-bottom:10px">
                <input name="password" class="easyui-passwordbox" data-options="min:6,required:true,missingMessage:'Password Harus Diisi.'" label="Password:" style="width:300px">
            </div>
            <div style="margin-bottom:10px">
                <input class="easyui-combobox" type="text" name="level" style="width:280px"
								data-options="url:'json/cmb_admin.php',method:'get',required:'true',
								valueField:'level',textField:'text',panelHeight:'75px',missingMessage:'Jabatan Harus Dipilih.'" label="Jabatan:"></input>
            </div>
		</form>
	</div>	
	<div id="edit_ptgs_dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok"     onclick="edit_ptgs_save()">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#edit_ptgs_dlg').dialog('close')">Cancel</a>
	</div>	


	
    <script type="text/javascript">
        var url;		

        function ptgs_doSearch(){
		$('#ptgs_dg').datagrid('load',{
			nama: $('#nama').val()
		});
	}

		function tambah_ptgs(){
			$('#tambah_ptgs_dlg').dialog('open').dialog('setTitle','Tambah Petugas Baru');
			$('#tambah_ptgs_fm').form('clear');		
			url = 'json/manage_petugas_aksi.php?page=simpan';
	}

		function tambah_ptgs_save(){
				$('#tambah_ptgs_fm').form('submit',{ 
					url: url,
					onSubmit: function(){
						return $(this).form('validate');
					},
					success: function(result){
						var result = eval('('+result+')');

						if (result.success){
							$.messager.show({
								title: 'Sukses',
								msg: "Data Petugas Berhasil Ditambahkan"
							})
							$('#tambah_ptgs_dlg').dialog('close');		// close the dialog
							$('#ptgs_dg').datagrid('reload');	// reload Data Grid
						} else {
							$.messager.show({
								title: 'Error',
								msg: result.msg
							});
						}
					}
				});
			}

		function edit_ptgs(){
				var row = $('#ptgs_dg').datagrid('getSelected');
				if (row){
					$('#edit_ptgs_dlg').dialog('open').dialog('setTitle','Edit petugas '+row.nama+'');
					$('#edit_ptgs_fm').form('load',row);
					url = 'json/manage_petugas_aksi.php?page=edit';
				}
				else
					$.messager.alert('Peringatan','Pilih data petugas terlebih dahulu','warning');

			}

		function edit_ptgs_save(){
				$('#edit_ptgs_fm').form('submit',{ 
					url: url,
					onSubmit: function(){
						return $(this).form('validate');
					},
					success: function(result){
						var result = eval('('+result+')');
						if (result.success){
							$.messager.show({
								title: 'Sukses',
								msg: "Data Petugas Berhasil Diedit"
							})
							$('#edit_ptgs_dlg').dialog('close');		// close the dialog
							$('#ptgs_dg').datagrid('reload');	// reload Data Grid
						} else {
								$.messager.show({
								title: 'Error',
								msg: result.msg
							});
						}
					}
				});
			}
		
		
		function hapus_ptgs(){
					var row = $('#ptgs_dg').datagrid('getSelected');
					if (row){
						$.messager.confirm('Konfirmasi Hapus','Yakin ingin menghapus '+row.nama+' ?',function(r){
							if (r){
								$.post('json/manage_petugas_aksi.php?page=hapus',{id_user:row.id_user},function(result){
									if (result.success){
										$.messager.show({
											title: 'Sukses',
											msg: "Data Berhasil Dihapus"
										})
										$('#ptgs_dg').datagrid('reload');	// reload the user data
										 
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
					$.messager.alert('Peringatan','Pilih data petugas terlebih dahulu.','warning');
				}



    </script>    
    

</body>
</html>