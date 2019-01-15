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
document.getElementById("faturalar").className = "active";
</script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kayıtlar
      </h1>
	  <!--------------->
	  <?php
	  if(isset($_GET["yetki_duzenle"])){
		if($_GET["yetki_duzenle"]==0){
		echo '	<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-ban"></i> Yetki eksikliği!</h4>
			Kayıt düzenleme yetkisine sahip değilsiniz. Lütfen yöneticiniz ile irtibata geçin.
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
			Kayıt silme yetkisine sahip değilsiniz. Lütfen yöneticiniz ile irtibata geçin.
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
                Kayıt başarılı bir şekilde eklendi.
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
                Kayıt başarılı bir şekilde silindi.
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
                Kayıt başarılı bir şekilde düzenlendi.
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
                Kayıt başarılı bir şekilde kapatıldı.
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
			Kayıt kapatırken bir hata oluştu. Sistem kurucusuyla iletişime geçin.
			</div>';
		}
	  }  
	  ?>
	  <?php
	  if(isset($_GET["isemrizatenmevcut"])){
		if($_GET["isemrizatenmevcut"]==1){
		echo '	<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-ban"></i> Aynı İş Emri Zaten Girilmiş!</h4>
			Girdiğiniz iş emri zaten mevcut. Lütfen düzenleme seçeneğini kullanın veya öncelikle eski kaydı silin.
			</div>';
		}
	  }  
	  ?>	
	  <!--------------->
      <ol class="breadcrumb">
        <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
        <li><a href="#">Kayıtlar</a></li>
      </ol>
    </section>
	<?php if($_SESSION["girenkadi"]=="PS1" || $_SESSION["girenkadi"]=="PS2" || $_SESSION["girenkadi"]=="PS3" || $_SESSION["girenkadi"]=="MT1" || $_SESSION["girenkadi"]=="MT2" || $_SESSION["girenkadi"]=="MT3") 
	{ }
	else {
	?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
			  <div class="col-md-12">
				  <div class="box box-default collapsed-box">
					<div class="box-header with-border">
					 <div class="box-tools">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
						</button>
					 </div>
					 <h3 class="box-title">Yeni Kayıt Ekle</h3>
					
					</div>
					<!-- /.box-header -->
					<div class="box-body">
					<!-- FATURA EKLETME MODÜLÜ -->
					<form role="form" method="post" enctype="multipart/form-data" action="faturalar-ekle.php">
					  <div class="box-body">
						<div class="form-group col-md-12">
							<div class="col-md-2">
							<label>Oluşturulma Tarihi</label>
								<input name="olusturulmaTarihi" type="text" <?php if($_SESSION["yetki"]=="0"){ echo 'readonly="readonly"';} ?> id="olusturulmaTarihi" class="form-control"  value="<?=date("Y-m-d");?>">
							</div>
							<div class="col-md-2">
							<label>İş Emri No</label>
								<input name="isEmriNo" type="text" id="isEmriNo" class="form-control"  placeholder="İş Emri No Girin">
							</div>
							<div class="col-md-2">
							<label>IMEI NO</label>
								<input name="imei" type="text" id="imei" class="form-control"  placeholder="IMEI Girin">
							</div>
							
							<div class="col-md-2">
							<label>Model</label>
								<input name="model" type="text" id="model" class="form-control"  placeholder="Model Girin">
							</div>
							<div class="col-md-1">
							<label>Geliş</label>
							<select name="gelis" id="gelis">
								<option value="PS">PS</option>
								<option value="CI">CI</option>
								<option value="RH">RH</option>
								<option value="Kargo">KARGO</option>
							</select>
							</div>
							<input hidden="hidden" readonly="readonly" name="faturaAcan" type="text" id="faturaAcan"  value="<?=$girenid=$_SESSION["girenid"];?>">
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
							<div class="col-md-2">
							<label>Müşteri Telefon</label>
								<input name="telefon" type="text" id="telefon" class="form-control" placeholder="Telefon No">
							</div>
							<div class="col-md-2">
							<label>Ücret</label>
								<input name="ucret" type="text" id="ucret" class="form-control" placeholder="Ücret Girin">
							</div>
							<div class="col-md-1">
							<label>Ödeme</label>
							<select name="odeme" id="odeme">
								<option value="">Yok</option>
								<option value="Pos">Pos</option>
								<option value="Nakit">Nakit</option>
								<option value="Havale">Havale</option>
							</select>
							</div>
							
						</div>
						<div class="form-group col-md-12">
							<div class="col-md-2">
							<label>Ödeme Durumu</label>
							<select name="durum" id="durum">
								<option value="0">Alınmadı</option>
								<option value="2">Depoda</option>
							</select>
							</div>
							<div class="col-md-2">
							<label>GSPN Tarih</label>
								<input name="gspn_tarih" type="text" id="gspn_tarih" class="form-control" placeholder="GSPN Tarihi" value="<?=date("Y-m-d");?>">
							</div>
							<div class="col-md-2">
							<label>Parçalar</label>
								<textarea rows="4" cols="50" name="parcalar" id="parcalar" class="form-control"  placeholder="Parça Bilgisini Girin"></textarea>
							</div>
							<div class="col-md-2">
							<label>Açıklama</label>
								<textarea rows="4" cols="50" name="aciklama" id="aciklama" class="form-control"  placeholder="Açıklama Girin"></textarea>
							</div>
							<div class="col-md-2">
							<label>Adres</label>
								<textarea rows="4" cols="50" name="adres" id="adres" class="form-control"  placeholder="Adres Girin"></textarea>
							</div>
							<div class="col-md-1">
							<label>İşlem</label>
								<button type="submit" class="btn btn-primary">Faturayı Ekle</button>
							</div>
						</div>
					  </div>
					  <!-- /.box-body -->

					</form>
					<!-- FATURA EKLETME MODÜLÜ -->
					 </div>
					  <!-- /.box-tools -->
				  </div>
				</div>
            </div>
		  </div>
        </div>
        <!-- /.col -->
      </div>
	  <div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<div class="col-md-6">
					   <div class="row">
						  <div class="box-body">
							<div class="col-md-12">
							  <div style="border:1px solid #00a65a;" class="box box-primary with-border">
								<div class="box-header">
								  <h3 class="box-title">Tarih Aralığına Göre Listele</h3>
								</div>
								<div class="box-body">
								<form role="form" method="post" enctype="multipart/form-data" action="faturalar.php">
										<div class="form-group">
										 <div class="col-md-4">
											<label>Başlangıç:</label>
											<div class="input-group date">
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>
											  <input name="baslangictarihi" type="text" class="form-control pull-right" id="baslangictarihi" value="<?php if(isset($_POST['baslangictarihi'])) echo $_POST['baslangictarihi'];?> ">
											</div>
											<!-- /.input group -->
										  </div>
										 <div class="col-md-4">
											<label>Bitiş:</label>
											<div class="input-group date">
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>
											  <input name="bitistarihi"type="text" class="form-control pull-right" id="bitistarihi" value="<?php if(isset($_POST['bitistarihi'])) echo $_POST['bitistarihi'];?>">
											</div>
											<!-- /.input group -->
										  </div>
										  <div class="col-md-2">
											<label>Limit:</label>
											<div class="input-group date">
											  <div class="input-group-addon">
											  </div>
											  <input name="limit"type="text" class="form-control pull-right" id="limit" value="<?php if(isset($_POST['limit'])) echo $_POST['limit'];?>">
											</div>
											<!-- /.input group -->
										  </div>
										  <div class="col-md-1">
											<label>İşlem:</label>
										  <button type="submit" class="btn btn-info fa fa-plus"> Getir</button>
										  </div>
										 </div>
								</form>
								</div>
								<!-- /.box-body -->
							  </div>
							  <!-- /.box -->
							</div>
						  </div>
						</div>
					</div>
					<div class="col-md-6">
					  <div class="row">
						  <div class="box-body">
							<div class="col-md-12">
							  <div style="border:1px solid #00a65a;" class="box box-primary with-border">
								<div class="box-header">
								  <h3 class="box-title">İş Emri No ile Ara</h3>
								</div>
								<div class="box-body">
								<form role="form" method="post" enctype="multipart/form-data" action="faturalar.php">
										<div class="form-group">
											<div class="col-md-4">
											<label>İş Emri No:</label>
											  <input name="Ara_isEmriNo" type="text" class="form-control pull-right" id="Ara_isEmriNo">
											</div>
											<div class="col-md-1">
											<label>İşlem:</label>
											<button type="submit" class="btn btn-info fa fa-plus"> Getir</button>
											</div>
										</div>
								</form>
								</div>
								<!-- /.box-body -->
							  </div>
							  <!-- /.box -->
							</div>
						  </div>
						</div>
					</div>
				</div>
				<div class="box-body">
					<div class="col-md-12">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
							  <tr>
								<th>ID</th>
								<th>Tarih</th>
								<th>İş Emri</th>
								<th>Geliş</th>
								<th>IMEI</th>
								<th>Model</th>
								<th>M. Adı Soyadı</th>
								<th>Ücret</th>
								<th>Ödeme</th>
								<th>Durum</th>
								<th>İşlemler</th>
							  </tr>
							</thead>
							<tbody>
								<?php
								$limit=50;
								if(isset($_POST['limit']))
								{
									if($_POST['limit']!=NULL)
									{
									$limit=$_POST['limit'];	
									}
								} 
								
								if(isset($_POST['baslangictarihi']) AND isset($_POST['bitistarihi']))
								{
									if($_POST['baslangictarihi']!=NULL AND $_POST['bitistarihi']!=NULL )
									{
									$vericek=$connection->query("select * from faturalar where olusturulmaTarihi BETWEEN '".$_POST['baslangictarihi']."' AND '".$_POST['bitistarihi']."' ORDER by ID DESC LIMIT $limit ")->fetchAll(PDO::FETCH_ASSOC);
									}
									else
									{
									$vericek=$connection->query("select * from faturalar ORDER by ID DESC LIMIT $limit ")->fetchAll(PDO::FETCH_ASSOC);
									}
								}
								else
								{
									if(isset($_POST['Ara_isEmriNo']))
									{
										if($_POST['Ara_isEmriNo']!=NULL)
										{
										$Ara_isEmriNo=$_POST['Ara_isEmriNo'];
										$vericek=$connection->query("select * from faturalar where isEmriNo='$Ara_isEmriNo'")->fetchAll(PDO::FETCH_ASSOC);
										}
									} 
									else
									{
									$vericek=$connection->query("select * from faturalar ORDER by ID DESC LIMIT $limit")->fetchAll(PDO::FETCH_ASSOC);
									}
								}
								foreach ($vericek as $vcek)
								{
								?>
							  <tr>
								<td><?=$vcek['id'];?></td>
								<td><?=$vcek['olusturulmaTarihi'];?></td>
								<td><?=$vcek['isEmriNo'];?></td>
								<td><?=$vcek['gelis'];?></td>
								<td><?=$vcek['imei'];?></td>
								<td><?=$vcek['model'];?></td>
								<td><?=$vcek['mAd'];?> <?=$vcek['mSoyad'];?></td>
								<td><?=$vcek['ucret'];?></td>
								<td><?=$vcek['odeme'];?></td>
								<td>
									<?php
									if($vcek['durum']=='1')
									{
										echo 'Alındı';
									}
									else if($vcek['durum']=='2')
									{
										echo 'Depoda';
									}
									else
									{
										echo 'Alınmadı';
									}
									?>
								</td>
									<!-- Small modal DÜZENLEME EKRANI-->
									<div class="modal fade bs-example-modal-lg" id="myModalId<?=$vcek['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
										  <div class="modal-dialog" role="document">
											<div class="modal-content">
												<form role="form" method="post" enctype="multipart/form-data" action="faturalar-duzenle.php">
												  <div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title" id="myModalLabel">Kayıt Düzenle</h4>
												  </div>
												<div class="modal-body">
													<div class="form-group">
														<div class="col-md-6">
														<label>İş Emri No</label>
															<input name="isEmriNo" type="text" id="isEmriNo" class="form-control"  placeholder="İş Emri No Girin" value="<?=$vcek['isEmriNo'];?>">
															<input name="id" type="text" id="id" hidden="hidden" value="<?=$vcek['id'];?>">
														</div>
														<div class="col-md-2">
														<label>Ücret</label>
															<input name="ucret" type="text" id="ucret" class="form-control" placeholder="Ücreti Girin" value="<?=$vcek['ucret'];?>">
														</div>
														<?php if($_SESSION["yetki"]=="1"){  ?>
														<div class="col-md-3">
														<label>Ödeme</label>
														<select name="odeme" id="odeme" class="form-control select2">
															<option <?php if($vcek['odeme']=="") echo 'selected';?> value="">Yok</option>
															<option <?php if($vcek['odeme']=="Nakit") echo 'selected';?> value="Nakit">Nakit</option>
															<option <?php if($vcek['odeme']=="Pos") echo 'selected';?> value="Pos">Pos</option>
															<option <?php if($vcek['odeme']=="Havale") echo 'selected';?> value="Havale">Havale</option>
														</select>
														</div>
														<?php
														}
														else {	?>
														<div class="col-md-3">
														<label>Ödeme</label>
															<input name="odeme" type="text" id="odeme" readonly="readonly" class="form-control" value="<?=$vcek['odeme'];?>">
														</div>
														<?php } ?>
														<input hidden="hidden" name="faturaDuzenleyen" type="text" id="faturaDuzenleyen"  value="<?=$_SESSION['girenid'];?>">
														<input hidden="hidden" name="id" type="text" id="id"  value="<?=$vcek['id'];?>">
														<input hidden="hidden" name="duzenlemeTarihi" type="text" id="duzenlemeTarihi"  value="<?=date('Y-m-d');?>">
													</div>
													
													<div class="form-group">
														<div class="col-md-6">
														<label>Müşteri Adı</label>
															<input name="mAd" type="text" id="mAd" class="form-control"  placeholder="Müşteri Adı Girin" value="<?=$vcek['mAd'];?>">
														</div>
														<div class="col-md-6">
														<label>Müşteri Soyadı</label>
															<input name="mSoyad" type="text" id="mSoyad" class="form-control" placeholder="Müşteri Soyadı Girin" value="<?=$vcek['mSoyad'];?>">
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-6">
														<label>IMEI</label>
															<input name="imei" type="text" id="imei" class="form-control"  placeholder="IMEI Girin" value="<?=$vcek['imei'];?>">
														</div>
														<div class="col-md-6">
														<label>Model</label>
															<input name="model" type="text" id="model" class="form-control"  placeholder="Model Girin" value="<?=$vcek['model'];?>">
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-6">
														<label>Telefon</label>
															<input name="telefon" type="text" id="telefon" class="form-control"  placeholder="Telefon No Girin" maxlenght="15" minlenght="15"value="<?=$vcek['telefon'];?>">
														</div>
														<div class="col-md-6">
														<label>Geliş</label>
														<select name="gelis" id="gelis" class="form-control select2">
															<option <?php if($vcek['gelis']=="PS") echo 'selected';?> value="PS">PS</option>
															<option <?php if($vcek['gelis']=="CI") echo 'selected';?> value="CI">CI</option>
															<option <?php if($vcek['gelis']=="RH") echo 'selected';?> value="RH">RH</option>
															<option <?php if($vcek['gelis']=="Kargo") echo 'selected';?> value="Kargo">KARGO</option>
														</select>
														
															
														</div>
													</div>
												
													<div class="form-group">
														<div class="col-md-12">
														<label>Açıklama</label>
															<textarea name="aciklama" id="aciklama" class="form-control"  placeholder="Açıklama Girin" ><?=$vcek['aciklama'];?></textarea>
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-12">
														<label>Parçalar</label>
															<textarea name="parcalar" id="parcalar" class="form-control"  placeholder="Parça Bilgisini Girin" ><?=$vcek['parcalar'];?></textarea>
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-12">
														<label>Adres</label>
															<textarea name="adres" id="adres" class="form-control"  placeholder="Adres Girin" ><?=$vcek['adres'];?></textarea>
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-6">
														<label>GSPN Tarih</label>
															<input name="gspn_tarih" type="text" id="gspn_tarih" class="form-control" placeholder="GSPN Tarihini Girin" value="<?=$vcek['gspn_tarih'];?>">
														</div>
														<div class="col-md-6">
														<label>Oluşturulma Tarihi</label>
															<input name="olusturulmaTarihi" type="text" <?php if($_SESSION["yetki"]=="0"){ echo 'readonly="readonly"';} ?> id="olusturulmaTarihi" class="form-control" placeholder="Oluşturulma Tarihini Girin" value="<?=$vcek['olusturulmaTarihi'];?>">
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
									<!-- /Small modal DÜZENLEME EKRANI/-->
									<!-- Small modal TAM BİLGİ EKRANI-->		
										<div class="modal fade bs-example-modal-lg" id="myModalDETAYId<?=$vcek['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
										  <div class="modal-dialog" role="document">
											<div class="modal-content">
												<form role="form" method="post" enctype="multipart/form-data">
												  <div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title" id="myModalLabel">Kayıt Detayları</h4>
												  </div>
												<div class="modal-body">
													<div class="form-group">
														<div class="col-md-6">
														<label>İş Emri No</label>
														<?=$vcek['isEmriNo'];?>
														</div>
														<div class="col-md-3">
														<label>Ücret</label>
														<?=$vcek['ucret'];?>
														</div>
														<div class="col-md-3">
														<label>Ödeme</label>
														<?=$vcek['odeme'];?>
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
														<div class="col-md-12">
														<label>Müşteri Telefon Numarası</label>
															<?=$vcek['telefon'];?>
														</div>
														
													</div>
													<div class="form-group">
														<div class="col-md-6">
														<label>Oluşturan</label>
														<?php
														$faturaAcan=$vcek['faturaAcan'];
														$percek=$connection->query("select * from personel where id='$faturaAcan'")->fetchAll(PDO::FETCH_ASSOC);
														foreach ($percek as $pcek)
														{
														echo $pcek['kadi'];
														}
														?>
														
														</div>
														<div class="col-md-6">
														<label>Oluşturulma Tarihi</label>
															<?=date("d-m-Y", strtotime($vcek['olusturulmaTarihi']));?>
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-6">
														<label>Son Düzenleyen</label>
														<?php
														$faturaDuzenleyen=$vcek['faturaDuzenleyen'];
														$per2cek=$connection->query("select * from personel where id='$faturaDuzenleyen'")->fetchAll(PDO::FETCH_ASSOC);
														foreach ($per2cek as $p2cek)
														{
														echo $p2cek['kadi'];
														}
														?>
														</div>
														<div class="col-md-6">
														<label>Son Düzenleme Tarihi</label>
															<?=date("d-m-Y", strtotime($vcek['duzenlemeTarihi']));?>
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-6">
														<label>Kaydı Kapatan</label>
														<?php
														$faturaKapatan=$vcek['faturaKapatan'];
														$per3cek=$connection->query("select * from personel where id='$faturaKapatan'")->fetchAll(PDO::FETCH_ASSOC);
														foreach ($per3cek as $p3cek)
														{
														echo $p3cek['kadi'];
														}
														?>
														</div>
														<div class="col-md-6">
														<label>Kapatma Tarihi</label>
															<?=date("d-m-Y", strtotime($vcek['kapatmaTarihi']));?>
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-6">
														<label>IMEI</label>
															<?=$vcek['imei'];?>
														</div>
														<div class="col-md-6">
														<label>Geliş</label>
															<?=$vcek['gelis'];?> 
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-12">
														<label>Açıklama</label>
															<?=$vcek['aciklama'];?>
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-12">
														<label>Parçalar</label>
															<?=$vcek['parcalar'];?>
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-12">
														<label>Adres</label>
															<?=$vcek['adres'];?>
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-6">
														<label>GSPN Tarihi</label>
															<?=$vcek['gspn_tarih'];?>
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
									<!-- /Small modal TAM BİLGİ EKRANI/-->
								<td>
								  <span class="button-group">
									<?php
									if($_SESSION["yetki"]=="1")
									{
										if($vcek['durum']=='1')
										{
											echo '<button type="button" class="btn btn-success fa fa-check"></button>';
										}
										else
										{
										?>
										<a href="faturalar-faturakapat.php?id=<?=$vcek['id'];?>" onclick="return confirm('Fatura ücretini tam olarak aldığınızdan emin misiniz?');" class="fa fa-shopping-cart btn btn-info"></a>
										<?php
										}?>
										<button type="button" class="btn btn-info fa fa-plus" data-toggle="modal" data-target="#myModalDETAYId<?=$vcek['id'];?>"></button>
									<?php
									}
									?>
									<?php
									if($_SESSION["yetki"]=="0")
									{
										if($vcek['durum']=='0' || $vcek['durum']=='2')
										{
										?>
										<button type="button" class="btn btn-warning fa fa-pencil" data-toggle="modal" data-target="#myModalId<?=$vcek['id'];?>"></button>
										<a href="faturalar-sil.php?id=<?=$vcek['id'];?>" onclick="return confirm('İçeriği silmek istediğinize emin misiniz? Bu işlem geri alınamaz!');" class="fa fa-trash btn btn-danger"></a>
										<?php } 
										else
										{
										}
									}
									else{
									?>
									<button type="button" class="btn btn-warning fa fa-pencil" data-toggle="modal" data-target="#myModalId<?=$vcek['id'];?>"></button>
									<a href="faturalar-sil.php?id=<?=$vcek['id'];?>" onclick="return confirm('İçeriği silmek istediğinize emin misiniz? Bu işlem geri alınamaz!');" class="fa fa-trash btn btn-danger"></a>
									<?php } ?>
								  </span>
								</td>
							  </tr>
							  <?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	  </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
	<?php } ?>
	
			
            <!-- /.box-tarihseçici -->
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

<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script> 
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
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
	 //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();
	
	//Date picker
    $('#baslangictarihi').datepicker({
      autoclose: true
    });
	$('#bitistarihi').datepicker({
      autoclose: true
    });
	
  });
</script>
  <!-- PAGE CONTENT END -->
 <?php include("footer.php") ?>
 
 
 <!-- Giriş KONTROL -->         
<?php	} ?>