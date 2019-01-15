<?php session_start(); if(!isset($_SESSION["login"])){
?>
<meta http-equiv="refresh" content="0;URL=giris.php">
<?php
} else
{
?>
<?php include("header.php") ?>
<?php include("kontrol/veritabani.php") ?>
<?php $girenid=$_SESSION["girenid"];?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Ayarlar
      </h1>
      <ol class="breadcrumb">
        <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
        <li><a href="#">Ayarlar</a></li>
      </ol>
    </section>
    <section class="content">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header">
		  <h3 class="box-title">Kullanıcı Ayarları Ekranı</h3>
		</div>
<div class="box-body">
<?php
$vericek=$connection->query("select * from personel where id='$girenid'")->fetchAll(PDO::FETCH_ASSOC);
foreach ($vericek as $vcek)
{
?>
<form role="form" method="post" enctype="multipart/form-data" action="ayarlar-guncelle.php">
<div class="box-body">
<div class="form-group">
<div class="col-md-2">
<input name="adsoyad" type="text" id="adsoyad" class="form-control"  placeholder="Ad Soyad Girin" value="<?=$vcek['adsoyad'];?>">
</div>
<div class="col-md-2">
<input name="telefon" type="text" id="telefon" class="form-control"  placeholder="Telefon Girin" value="<?=$vcek['telefon'];?>">
</div>
<div class="col-md-2">
<input name="eposta" type="text" id="eposta" class="form-control" placeholder="E-posta Girin" value="<?=$vcek['eposta'];?>">
</div>
<div class="col-md-2">
<input name="kadi" type="text" id="kadi" class="form-control" placeholder="Kullanıcı Adı Girin" value="<?=$vcek['kadi'];?>">
</div>
<div class="col-md-2">
<input name="sifre" type="password" id="sifre" class="form-control" placeholder="Şifre Girin" value="<?=$vcek['sifre'];?>">
</div>
<div class="col-md-1"><button type="submit" class="btn btn-primary">Kaydet</button></div>
</div>
</div>
</form>
 <?php } ?>
		</div>
	  </div>
	</div>
  </div>
    </section>
  </div>
 <?php include("footer.php") ?>
<?php	} ?>



