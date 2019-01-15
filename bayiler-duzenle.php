<?php
session_start(); 
if((!isset($_SESSION["login"]))||($_SESSION["yetki"]=="0")){
?>
<meta http-equiv="refresh" content="0;URL=giris.php">
<?php
} else
{
?>

<!-- Giriş KONTROL -->
<?php include("header.php") ?>
<?php include("kontrol/veritabani.php") ?>

<!-- PAGE CONTENT -->

<?php $personelid=$_GET["id"];?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ayarlar
      </h1>
      <ol class="breadcrumb">
        <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
        <li><a href="#">Bayiler</a></li>
        <li>Düzenle</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Bayi Düzenleme Ekranı</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			<?php
			$vericek=$connection->query("select * from bayiler where id='$personelid'")->fetchAll(PDO::FETCH_ASSOC);
			foreach ($vericek as $vcek)
			{
			?>
			<form role="form" method="post" enctype="multipart/form-data" action="bayiler-guncelle.php">
			  <div class="box-body">
				<div class="form-group">
					<div class="col-md-2">
						<input name="adsoyad" type="text" id="adsoyad" class="form-control"  placeholder="Ad Soyad Girin" value="<?=$vcek['adsoyad'];?>">
						<input name="id" type="text" id="id" hidden="hidden" value="<?=$vcek['id'];?>">
					</div>
					<div class="col-md-2">
						<input name="telefon" type="text" id="telefon" class="form-control"  placeholder="Telefon Girin" value="<?=$vcek['telefon'];?>">
					</div>
					<div class="col-md-2">
						<input name="eposta" type="text" id="eposta" class="form-control" placeholder="E-posta Girin" value="<?=$vcek['eposta'];?>">
					</div>
					<div class="col-md-1">
						<input name="kadi" type="text" id="kadi" class="form-control" placeholder="Kullanıcı Adı Girin" value="<?=$vcek['kadi'];?>">
					</div>
					<div class="col-md-2">
						<input name="sifre" type="password" id="sifre" class="form-control" minlenght="4" placeholder="Şifre girmezseniz, şifreniz değişmez.">
					</div>
					<div class="col-md-1">
						<div class="checkbox">
						<label>
						  <input id="yetki" name="yetki" type="checkbox" <?php if($vcek['yetki']=='1'){echo 'checked="checked"';}?>>
						  Admin?
						</label>
						</div>
					</div>
				  
					<div class="col-md-1">
						<button type="submit" class="btn btn-primary">Kaydet</button>
					</div>
				</div>
			  </div>
			</form>
			<?php } ?>
				
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
  
  <!-- PAGE CONTENT END -->
 <?php include("footer.php") ?>
 
 
 <!-- Giriş KONTROL -->         
<?php	} ?>