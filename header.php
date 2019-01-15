<!DOCTYPE html>
<html>
<?php include("meta.php");?>

<?php include("kontrol/veritabani.php") ?>
<?php
$girenid=$_SESSION['girenid'];
$vericek=$connection->query("select * from personel where id='$girenid'")->fetchAll(PDO::FETCH_ASSOC);
foreach ($vericek as $vcek)
{
?>
<div class="modal fade bs-example-modal-lg" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
		<form role="form" method="post" enctype="multipart/form-data" action="ayarlar-guncelle.php">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Ayarlar Düzenle</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">									
					<div class="col-md-4">
					<label>Ad Soyad</label>
					<input name="adsoyad" type="text" id="adsoyad" class="form-control"  placeholder="Ad Soyad Girin" value="<?=$vcek['adsoyad'];?>">
					</div>
					<div class="col-md-8">
					<label>E-Posta</label>
					<input name="eposta" type="text" id="eposta" class="form-control" placeholder="E-posta Girin" value="<?=$vcek['eposta'];?>">
					</div>
				</div>
				<div class="form-group">	
					<div class="col-md-4">
					<label>Telefon</label>
					<input name="telefon" type="text" id="telefon" class="form-control"  placeholder="Telefon Girin" value="<?=$vcek['telefon'];?>">
					</div>
					<div class="col-md-3">
					<label>Kullanıcı Adı</label>
					<input name="kadi" type="text" id="kadi" class="form-control" placeholder="Kullanıcı Adı Girin" value="<?=$vcek['kadi'];?>">
					</div>
					<div class="col-md-5">
					<label>Şifre (Boş bırakırsanız değişmez)</label>
					<input name="sifre" type="password" id="sifre" class="form-control" placeholder="Boş iken değişmez.">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
				<button type="submit" class="btn btn-warning">Kaydet</button>
			</div>
		</form>
	  </div>
	</div>
  </div>
<?php } ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<header class="main-header">
    <a href="index.php" class="logo">
	<span class="logo-mini"><b>F</b>S</span><span class="logo-lg"><b>FATURA</b>SİS</span>
	</a>
    <nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
	<span class="sr-only">Toggle navigation</span>
   </a>
   <div class="navbar-custom-menu">
   <ul class="nav navbar-nav">
   <li class="dropdown user user-menu">
   <a href="#" class="dropdown-toggle" data-toggle="dropdown">
   <i class="fa fa-gear"></i><span class="hidden-xs"><?=$_SESSION["girenkisi"];?></span>
   </a>
   <ul class="dropdown-menu">
	   <li class="user-header"><p><?php echo $_SESSION["girenkisi"];?><small><?=$_SESSION["gireneposta"];?></small></p></li>
					
					<li class="user-footer">
					  <span class="button-group">
						<?php
						if($_SESSION["yetki"]=="1")
						{
						?>
						<div class="pull-left"><button type="button" class="btn btn-warning fa fa-gears" data-toggle="modal" data-target="#myModal2"></button></div>
						<?php } ?>
						<div class="pull-right"><a href="cikis.php" class="btn btn-default btn-flat"><i class="fa fa-power-off"></i></a></div>
					  </span>
					</li>
   </ul>
   </li>
   </ul>
   </div>
   </nav>
</header>
<?php include("sol_menu.php");?>


