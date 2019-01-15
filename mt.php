<?php
session_start(); 
if(!isset($_SESSION["login"])){
?>
<meta http-equiv="refresh" content="0;URL=giris.php">
<?php
} else
{
?>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />





<!-- Giriş KONTROL -->
<?php include("kontrol/veritabani.php") ?>


<?php include("header.php") ?>


<!-- PAGE CONTENT -->
<script>
document.getElementById("mt").className = "active";
</script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        MT Kayıtları
      </h1>
	  <!--------------->
	  <?php
	  if(isset($_GET["yetki_duzenle"])){
		if($_GET["yetki_duzenle"]==0){
		echo '	<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-ban"></i> Yetki eksikliği!</h4>
			Fatura düzenleme yetkisine sahip değilsiniz. Lütfen yöneticiniz ile irtibata geçin.
			</div>';
		}
	  }  
	  ?>
	  <?php
	  if(isset($_GET["yetki_sil"])){
		if($_GET["yetki_sil"]==0){
		echo '	<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-ban"></i> Yetki eksikliği!</h4>
			Fatura silme yetkisine sahip değilsiniz. Lütfen yöneticiniz ile irtibata geçin.
			</div>';
		}
	  }  
	  ?>	  
	  <?php
	  if(isset($_GET["faturaeklendi"])){
		if($_GET["faturaeklendi"]==1){
		echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Başarılı!</h4>
                Fatura başarılı bir şekilde eklendi.
              </div>';
		}
	  }  
	  ?>	  
	  <?php
	  if(isset($_GET["faturasilindi"])){
		if($_GET["faturasilindi"]==1){
		echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Başarılı!</h4>
                Fatura başarılı bir şekilde silindi.
              </div>';
		}
	  }  
	  ?>	  
	  <?php
	  if(isset($_GET["faturaduzenlendi"])){
		if($_GET["faturaduzenlendi"]==1){
		echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Başarılı!</h4>
                Fatura başarılı bir şekilde düzenlendi.
              </div>';
		}
	  }  
	  ?>
	  <?php
	  if(isset($_GET["faturakapatildi"])){
		if($_GET["faturakapatildi"]==1){
		echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Başarılı!</h4>
                Fatura başarılı bir şekilde kapatıldı.
              </div>';
		}
	  }  
	  ?>
	  <?php
	  if(isset($_GET["faturakapatildi"])){
		if($_GET["faturakapatildi"]==0){
		echo '	<div class="alert alert-warning alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-ban"></i> Hata oluştu!</h4>
			Fatura kapatırken bir hata oluştu. Sistem kurucusuyla iletişime geçin.
			</div>';
		}
	  }  
	  ?>
	  <!--------------->
      <ol class="breadcrumb">
        <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
        <li><a href="#">MT</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
            
			 <div class="col-md-12">
          <div class="box box-default collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Yeni MT Kaydı Ekle</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
			
			<!-- form -->
		<!-- FATURA EKLETME MODÜLÜ -->
			<form role="form" method="post" enctype="multipart/form-data" action="mt-ekle.php">
              <div class="box-body">
                <div class="form-group col-md-12">
					<div class="col-md-2">
					<label>Tarih</label>
						<input name="tarih" type="text" <?php if($_SESSION["yetki"]=="0"){ echo 'readonly="readonly"';} ?> id="tarih" class="form-control"  value="<?=date("Y-m-d");?>">
					</div>
					<div class="col-md-2">
					<label>İş Emri No</label>
						<input name="isEmriNo" type="text" id="isEmriNo" class="form-control"  placeholder="İş Emri No Girin">
					</div>
					<div class="col-md-2">
					<label>IMEI No</label>
						<input name="imei" type="text" id="imei" class="form-control"  placeholder="IMEI Girin">
					</div>
					
					<div class="col-md-2">
					<label>Model</label>
						<input name="model" type="text" id="model" class="form-control"  placeholder="Model Girin">
					</div>
					
					<div class="col-md-4">
					<label>Bayi</label>
					<select id="bayiNo" name="bayiNo" class="form-control select2" style="width: 100%;">
					  <option selected="selected">Lütfen Listeden Bir Bayi Seçiniz</option>
					   <?php
						$bayicek=$connection->query("select * from bayiler")->fetchAll(PDO::FETCH_ASSOC);
						foreach ($bayicek as $bcek)
						{
						?>
						<option value="<?=$bcek['id'];?>">
						<?=$bcek['bayiAdi'];?> | <?=$bcek['ilce'];?> / <?=$bcek['il'];?>
					  </option>
					  <?php } ?>
					</select>
					</div>
					
					<input hidden="hidden" readonly="readonly" name="kullanici" type="text" id="kullanici"  value="<?=$girenid=$_SESSION["girenid"];?>">
				</div>
				<div class="form-group col-md-12">
					<div class="col-md-2">
					<label>Müşteri Adı</label>
						<input name="mAd" type="text" id="mAd" class="form-control"  placeholder="Müşteri Adı">
					</div>
					<div class="col-md-2">
					<label>Müşteri Soyadı</label>
						<input name="mSoyad" type="text" id="mSoyad" class="form-control" placeholder="Müşteri Soyadı">
					</div>
				</div>
				<div class="form-group col-md-12">
				
					<div class="col-md-4">
					<label>Arıza</label>
						<textarea rows="4" cols="50" name="ariza" id="ariza" class="form-control"  placeholder="Arıza Kaydını Girin"></textarea>
					</div>
				<div class="col-md-1">
					<label>İşlem</label>
						<button type="submit" class="btn btn-primary">MT Kaydını Ekle</button>
					</div>
				</div>
              </div>
              <!-- /.box-body -->

            </form>
		<!-- FATURA EKLETME MODÜLÜ -->
			<!-- /.form -->
			
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
		
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
				  <tr>
					<th style="width:5px">ID</th>
					<th>Kullanıcı</th>
					<th>Tarih</th>
					<th>İş Emri</th>
					<th>Model</th>
					<th>IMEI</th>
					<th>M. Adı Soyadı</th>
					<th>Arıza</th>
					<th>Bayi</th>
					<th>İşlemler</th>
				  </tr>
				</thead>

				<tbody>
					<?php
					$vericek=$connection->query("select * from mt ORDER by ID DESC")->fetchAll(PDO::FETCH_ASSOC);
					foreach ($vericek as $vcek)
					{
					?>
				  <tr>
				  
					<td><?=$vcek['id'];?></td>
					<td>
					<?php
					$kullanici=$vcek['kullanici'];
					$percek2=$connection->query("select * from personel where id='$kullanici'")->fetchAll(PDO::FETCH_ASSOC);
					foreach ($percek2 as $pcek)
					{
					?>
					<?=$pcek['adsoyad'];?>
					<?php } ?>
					</td>
					<td><?=$vcek['tarih'];?></td>
					<td><?=$vcek['isEmriNo'];?></td>					
					<td><?=$vcek['model'];?></td>
					<td><?=$vcek['imei'];?></td>
					<td><?=$vcek['mAd'];?> <?=$vcek['mSoyad'];?></td>
					<td>
					<div class="box box-default collapsed-box" style="border:1px solid #00a65a;">
						<div class="box-header with-border">
						  <h4 class="box-title">Arıza</h4>
						  <div class="box-tools">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
							</button>
						  </div> 
						</div>
						<div class="box-body">
							<?=$vcek['ariza'];?>
						</div>
					</div>
					</td>
					<td>
					<?php
					$bayiid=$vcek['bayiNo'];
					$bayicek=$connection->query("select * from bayiler where id='$bayiid'")->fetchAll(PDO::FETCH_ASSOC);
					if($bayicek)
					{
						foreach ($bayicek as $bcek)
						{
						?>
						<?=$bcek['bayiAdi'];?> | <?=$bcek['ilce'];?> / <?=$bcek['il'];?>
						<?php
						} 
					} 
					else
					{
					echo 'BAYİ SİLİNMİŞ';
					}
					
					?>
					</td>
					
					
<!-- Small modal DÜZENLEME EKRANI-->
	<div class="modal fade bs-example-modal-lg" id="myModalId<?=$vcek['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
			<form role="form" method="post" enctype="multipart/form-data" action="mt-duzenle.php">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">MT Kaydı Düzenle</h4>
			  </div>
			<div class="modal-body">
				<div class="form-group col-md-12">
					<div class="col-md-6">
					<label>İş Emri No</label>
						<input name="isEmriNo" type="text" id="isEmriNo" class="form-control"  placeholder="İş Emri No Girin" value="<?=$vcek['isEmriNo'];?>">
						<input name="id" type="text" id="id" hidden="hidden" value="<?=$vcek['id'];?>">
					</div>
					<div class="col-md-6">
					<label>Bayi</label>
					<select id="bayiNo" name="bayiNo" class="form-control select2" style="width: 100%;">
					   <?php
					    $secilmisBayiId=$vcek['bayiNo'];
						$bayicek3=$connection->query("select * from bayiler")->fetchAll(PDO::FETCH_ASSOC);
						foreach ($bayicek3 as $bcek3)
						{
						?>
						<option value="<?=$bcek3['id'];?>">	<?=$bcek3['bayiAdi'];?> | <?=$bcek3['ilce'];?> / <?=$bcek3['il'];?>  </option>
					 
					  <?php } ?>
					   <option selected="selected" value="<?=$secilmisBayiId;?>">Lütfen Listeden Bir Bayi Seçiniz</option>
					</select>
					</div>
					<input hidden="hidden" name="id" type="text" id="id"  value="<?=$vcek['id'];?>">
				</div>
				
				<div class="form-group col-md-12">
					<div class="col-md-6">
					<label>Müşteri Adı</label>
						<input name="mAd" type="text" id="mAd" class="form-control"  placeholder="Müşteri Adı Girin" value="<?=$vcek['mAd'];?>">
					</div>
					<div class="col-md-6">
					<label>Müşteri Soyadı</label>
						<input name="mSoyad" type="text" id="mSoyad" class="form-control" placeholder="Müşteri Soyadı Girin" value="<?=$vcek['mSoyad'];?>">
					</div>
				</div>
				<div class="form-group col-md-12">
					<div class="col-md-6">
					<label>IMEI</label>
						<input name="imei" type="text" id="imei" class="form-control"  placeholder="IMEI Girin" value="<?=$vcek['imei'];?>">
					</div>
					<div class="col-md-6">
					<label>Model</label>
						<input name="model" type="text" id="model" class="form-control"  placeholder="Model Girin" value="<?=$vcek['model'];?>">
					</div>
				</div>
				
			
				<div class="form-group col-md-12">
					<div class="col-md-8">
					<label>Arıza</label>
						<textarea name="ariza" id="ariza" class="form-control"  placeholder="Arızayı Girin" ><?=$vcek['ariza'];?></textarea>
					</div>
					<div class="col-md-4">
					<label>Tarih</label>
						<input name="tarih" type="text" id="tarih" class="form-control" value="<?=$vcek['tarih'];?>">
					</div>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
					<button type="submit" class="btn btn-warning">Kaydet</button>
				</div>
			</div>
			</form>
		</div>
	  </div>
	</div>
<!-- Small modal DÜZENLEME EKRANI-->
					
					
					
<!-- Small modal TAM BİLGİ EKRANI-->		
	<div class="modal fade bs-example-modal-lg" id="myModalDETAYId<?=$vcek['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
			<form role="form" method="post" enctype="multipart/form-data">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">MT Detayları</h4>
			  </div>
			<div class="modal-body">
				<div class="form-group">
					<div class="col-md-4">
					<label>İş Emri No</label>
					<?=$vcek['isEmriNo'];?>
					</div>
					<div class="col-md-5">
					<label>IMEI</label>
						<?=$vcek['imei'];?>
					</div>
					<div class="col-md-3">
					<label>Model</label>
						<?=$vcek['model'];?> 
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6">
					<label>Müşteri Adı</label>
						<?=$vcek['mAd'];?>
					</div>
					<div class="col-md-6">
					<label>Müşteri Soyadı</label>
						<?=$vcek['mSoyad'];?>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-md-6">
					<label>Kullanıcı</label>
					<?php
					$kullanici=$vcek['kullanici'];
					$percek=$connection->query("select * from personel where id='$kullanici'")->fetchAll(PDO::FETCH_ASSOC);
					foreach ($percek as $pcek)
					{
					echo $pcek['kadi'];
					}
					?>
					
					</div>
					<div class="col-md-6">
					<label>Tarih</label>
						<?=$vcek['tarih'];?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8">
					<label>Arıza</label>
						<?=$vcek['ariza'];?>
					</div>
					<div class="col-md-4">
					<label>Bayi</label>
						<?php
					    $secilmisBayiId=$vcek['bayiNo'];
						$bayicek2=$connection->query("select * from bayiler")->fetchAll(PDO::FETCH_ASSOC);
						foreach ($bayicek2 as $bcek2)
						{
						?>
						<?=$bcek2['bayiAdi'];?>
						<?php } ?>
					</div>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
				</div>
			</div>
			</form>
		</div>
	  </div>
	</div>
<!-- Small modal TAM BİLGİ EKRANI-->
					
					<td>
					  <span class="button-group">
						<?php
						if($vcek['kullanici']==$_SESSION['girenid'] || $_SESSION['yetki']=="1")
						{
						?>
						<button type="button" class="btn btn-warning fa fa-pencil" data-toggle="modal" data-target="#myModalId<?=$vcek['id'];?>"></button>
						<a href="mt-sil.php?id=<?=$vcek['id'];?>" onclick="return confirm('İçeriği silmek istediğinize emin misiniz? Bu işlem geri alınamaz!');" class="fa fa-trash btn btn-danger"></a>
						<?php } ?>
						
					  </span>
					</td>
				  </tr>
				  <?php } ?>
				</tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
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
<script src="plugins/select2/select2.full.min.js"></script>
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- page script -->
<script>
  $(function () {
     $("#example1").DataTable({
		"paging": true,
		"lengthChange": true,
		"searching": true,
		"ordering": true,
		"info": true,
		"autoWidth": true,
	 "order": [[0,'desc']],
	 });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
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
</script>
  <!-- PAGE CONTENT END -->
 <?php include("footer.php") ?>
 
 
 <!-- Giriş KONTROL -->         
<?php	} ?>