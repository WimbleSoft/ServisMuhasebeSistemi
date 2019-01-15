<?php
session_start(); 
if(!isset($_SESSION["login"])){
?>
<meta http-equiv="refresh" content="0;URL=giris.php">
<?php
} else
{
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
<link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
<link rel="stylesheet" href="plugins/morris/morris.css">
<link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<link rel="stylesheet" href="plugins/select2/select2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<!-- Giriş KONTROL -->
<?php include("kontrol/veritabani.php") ?>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
				  <tr>
					<th>ID</th>
					<th>TARİH</th>
					<th>İŞ EMRİ</th>
					<th>GELİŞ</th>
					<th>IMEI</th>
					<th>MODEL</th>
					<th>M.AD SOYAD</th>
					<th>TELEFON</th>
					<th>ÜCRET</th>
					<th>ÖDEME</th>
					<th>AÇIKLAMA</th>
				  </tr>
				</thead>
				<tbody>
				<?php
				$gelirgider=$_POST['gelirgider'];
				$vericek=$connection->query("select * from kasa_defteri where gelirgider='$gelirgider'")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($vericek as $vcek)
				{
				?>
				<tr>
				  	<td><?=$vcek['id'];?></td>
					<td><?=date("d-m-Y", strtotime($vcek['olusturulmaTarihi']));?></td>
					<td><?=$vcek['isEmriNo'];?></td>
					<td><?=$vcek['gelis'];?></td>
					<td><?=$vcek['imei'];?></td>
					<td><?=$vcek['model'];?></td>
					<td><?=$vcek['mAd'];?> <?=$vcek['mSoyad'];?></td>
					<td><?=$vcek['telefon'];?></td>
					<td><?=$vcek['ucret'];?></td>
					<td><?=$vcek['odeme'];?></td>
					<td><?=$vcek['aciklama'];?></td>
				</tr>
			<?php } ?>
				</tbody>
			</table>
<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- bootstrap datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script src="plugins/select2/select2.full.min.js"></script>
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="plugins/datatables/dataTables.buttons.js"></script>
<script src="plugins/datatables/buttons.flash.js"></script>
<script src="plugins/datatables/jszip.js"></script>
<script src="http://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="http://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="plugins/datatables/buttons.html5.js"></script>
<script src="plugins/datatables/buttons.print.js"></script>
<script>
$(function () {
    $("#example1").DataTable({
		"paging": false,
		"lengthChange": true,
		"searching": false,
		"ordering": true,
		"info": true,
		"autoWidth": true,
	 "order": [[0,'desc']],
	 dom: 'Bfrtip',
        buttons: [
            'excel'
        ]
	 });
    $(".select2").select2();
	   //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });
	$('#datepicker2').datepicker({
      autoclose: true
    });
	$('#datepicker3').datepicker({
      autoclose: true
    });
	
  });
$(document).ready(function(){
  $('#excel_button').trigger('click');
});
</script>
<script language="Javascript1.2">
setTimeout(function(){ window.close(); }, 2000);
</script>

 <?php include("footer.php") ?>
<?php } ?>