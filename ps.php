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
document.getElementById("ps").className = "active";
</script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        PS Kayıtları
      </h1>
	  <!--------------->

	  <!--------------->
      <ol class="breadcrumb">
        <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
        <li><a href="#">PS</a></li>
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
				  <h3 class="box-title">Yeni PS Kaydı Ekle</h3>

				  <div class="box-tools">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
					</button>
				  </div>
				  <!-- /.box-tools -->
				</div>
				<!-- /.box-header -->
				
				<div class="box-body">
				<!-- PS EKLETME MODÜLÜ -->
				<form role="form" method="post" enctype="multipart/form-data" action="ps-ekle.php">
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
						<div class="col-md-4">
						<label>Getiren-İleten</label>
						<select id="getiren" name="getiren" class="form-control select2" style="width: 100%;">
						  <option selected="selected">Lütfen Listeden Getireni Seçiniz</option>
						   <?php
							$getirencek=$connection->query("select * from getirenler")->fetchAll(PDO::FETCH_ASSOC);
							foreach ($getirencek as $gcek)
							{
							?>
							<option value="<?=$gcek['id'];?>">
							<?=$gcek['getirenAdi'];?>
						  </option>
						  <?php } ?>
						</select>
						</div>
						<div class="col-md-4">
						<label>Gelen-Giden</label>
						<select id="gelengiden" name="gelengiden" class="form-control select2" style="width: 100%;">
						  <option selected="selected" value="Gelen">Lütfen Listeden Gelen Giden Durumunu Seçiniz</option> 
						  <option value="gelen">Gelen</option> 
						  <option value="giden">Giden</option>
						   
							
							</select>
						</div>
						<div class="col-md-1">
						<label>İşlem</label>
							<button type="submit" class="btn btn-primary">PS Kaydını Ekle</button>
						</div>
					</div>
				  </div>
				  <!-- /.box-body -->
				</form>
				<!-- PS EKLETME MODÜLÜ -->
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->
        </div>
		
            </div>
		  </div>
            <!-- /.box-header -->
		<div class="box">
			<div class="box-body">
				<div class="col-md-12">
<!-----SOL SÜTUN-----><div class="col-md-6">
						<div class="box-body">
						 <h4 class="box-title">GELEN KAYITLARI</h4>
						  <table id="example1" class="table table-bordered table-striped">
							<thead>
							  <tr>
								<th style="width:5px">ID</th>
								<th>Tarih</th>
								<th>İş Emri</th>
								<th>Model</th>
								<th>IMEI</th>
								<th>Bayi</th>
								<th>Getiren</th>
								<th>İşlemler</th>
							  </tr>
							</thead>

							<tbody>
								<?php
								$vericek=$connection->query("select * from ps where gelengiden='gelen' ORDER by ID DESC ")->fetchAll(PDO::FETCH_ASSOC);
								foreach ($vericek as $vcek)
								{
								?>
							  <tr>
							  
								<td><?=$vcek['id'];?></td>
								<td><?=$vcek['tarih'];?></td>
								<td><?=$vcek['isEmriNo'];?></td>					
								<td><?=$vcek['model'];?></td>
								<td><?=$vcek['imei'];?></td>
								<td>
								<?php
								$bayiid2=$vcek['bayiNo'];
								$bayicek2=$connection->query("select * from bayiler where id='$bayiid2'")->fetchAll(PDO::FETCH_ASSOC);
								if($bayicek2)
								{
									foreach ($bayicek2 as $bcek2)
									{
									?>
									<?=$bcek2['bayiAdi'];?> | <?=$bcek2['ilce'];?> / <?=$bcek2['il'];?>
									<?php
									} 
								} 
								else
								{
								echo 'BAYİ SİLİNMİŞ';
								}
								
								?>
								</td>
								<td>
								<?php
								$getirenid2=$vcek['getiren'];
								$getirencek2=$connection->query("select * from getirenler where id='$getirenid2'")->fetchAll(PDO::FETCH_ASSOC);
								if($getirencek2)
								{
									foreach ($getirencek2 as $gcek2)
									{
									?>
									<?=$gcek2['getirenAdi'];?>
									<?php
									} 
								} 
								else
								{
								echo 'GETİREN SİLİNMİŞ';
								}
								?>
								</td>
								
								
								<!-- Small modal DÜZENLEME EKRANI-->
									<div class="modal fade bs-example-modal-lg" id="myModalGELENId<?=$vcek['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									  <div class="modal-dialog" role="document">
										<div class="modal-content">
											<form role="form" method="post" enctype="multipart/form-data" action="ps-duzenle.php">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="myModalLabel">PS Gelen Kaydı Düzenle</h4>
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
														$bayicek=$connection->query("select * from bayiler")->fetchAll(PDO::FETCH_ASSOC);
														foreach ($bayicek as $bcek)
														{
														?>
														<option value="<?=$bcek['id'];?>">	<?=$bcek['bayiAdi'];?> | <?=$bcek['ilce'];?> / <?=$bcek['il'];?>  </option>
													 
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
												<div class="form-group col-md-12">
													<div class="col-md-6">
													<label>Getiren</label>
													<select id="getiren" name="getiren" class="form-control select2" style="width: 100%;">
													   <?php
														$secilmisGetirenId=$vcek['getiren'];
														$getirencek3=$connection->query("select * from getirenler")->fetchAll(PDO::FETCH_ASSOC);
														foreach ($getirencek3 as $gcek3)
														{
														?>
														<option value="<?=$gcek3['id'];?>">	<?=$gcek3['getirenAdi'];?></option>
													 
													  <?php } ?>
													   <option selected="selected" value="<?=$secilmisGetirenId;?>">Lütfen Listeden Getireni Seçiniz</option>
													</select>
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
									<div class="modal fade bs-example-modal-lg" id="myModalDETAYGELENId<?=$vcek['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									  <div class="modal-dialog" role="document">
										<div class="modal-content">
											<form role="form" method="post" enctype="multipart/form-data">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="myModalLabel">PS Gelen Detayları</h4>
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
													<div class="col-md-4">
													<label>Arıza</label>
														<?=$vcek['ariza'];?>
													</div>
													<div class="col-md-4">
													<label>Getiren</label>
														<?php
														$GetirenId2=$vcek['getiren'];
														$getirencek2=$connection->query("select * from getirenler where id='$GetirenId2'")->fetchAll(PDO::FETCH_ASSOC);
														foreach ($getirencek2 as $gcek2)
														{
														?>
														<?=$gcek2['getirenAdi'];?>
													  <?php } ?>
													</div>
													<div class="col-md-4">
													<label>Bayi</label>
														<?php
														$BayiId2=$vcek['bayiNo'];
														$bayicek2=$connection->query("select * from bayiler where id='$BayiId2'")->fetchAll(PDO::FETCH_ASSOC);
														foreach ($bayicek2 as $bcek2)
														{
														?>
														<?=$bcek2['bayiAdi'];?> | <?=$bcek2['ilce'];?> / <?=$bcek2['il'];?>  </option>
													 
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
									<button type="button" class="btn btn-info fa fa-plus" data-toggle="modal" data-target="#myModalDETAYGELENId<?=$vcek['id'];?>"></button>
									<button type="button" class="btn btn-warning fa fa-pencil" data-toggle="modal" data-target="#myModalGELENId<?=$vcek['id'];?>"></button>
									<a href="ps-sil.php?id=<?=$vcek['id'];?>" onclick="return confirm('İçeriği silmek istediğinize emin misiniz? Bu işlem geri alınamaz!');" class="fa fa-trash btn btn-danger"></a>
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
					
					
<!-----SAĞ SÜTUN-----><div class="col-md-6">
						<div class="box-body">
						 <h4 class="box-title">GİDEN KAYITLARI</h4>
						  <table id="example3" class="table table-bordered table-striped">
							<thead>
							  <tr>
								<th style="width:5px">ID</th>
								<th>Tarih</th>
								<th>İş Emri</th>
								<th>Model</th>
								<th>IMEI</th>
								<th>Bayi</th>
								<th>Götüren</th>
								<th>İşlemler</th>
							  </tr>
							</thead>

							<tbody>
								<?php
								$vericek2=$connection->query("select * from ps where gelengiden='giden' ORDER by ID DESC ")->fetchAll(PDO::FETCH_ASSOC);
								foreach ($vericek2 as $vcek2)
								{
								?>
							  <tr>
							  
								<td><?=$vcek2['id'];?></td>
								<td><?=$vcek2['tarih'];?></td>
								<td><?=$vcek2['isEmriNo'];?></td>					
								<td><?=$vcek2['model'];?></td>
								<td><?=$vcek2['imei'];?></td>
								<td>
								<?php
								$bayiid3=$vcek2['bayiNo'];
								$bayicek3=$connection->query("select * from bayiler where id='$bayiid3'")->fetchAll(PDO::FETCH_ASSOC);
								if($bayicek3)
								{
									foreach ($bayicek3 as $bcek3)
									{
									?>
									<?=$bcek3['bayiAdi'];?> | <?=$bcek3['ilce'];?> / <?=$bcek3['il'];?>
									<?php
									} 
								} 
								else
								{
								echo 'BAYİ SİLİNMİŞ';
								}
								
								?>
								</td>
								<td>
								<?php
								$getirenid3=$vcek2['getiren'];
								$getirencek3=$connection->query("select * from getirenler where id='$getirenid3'")->fetchAll(PDO::FETCH_ASSOC);
								if($getirencek3)
								{
									foreach ($getirencek3 as $gcek3)
									{
									?>
									<?=$gcek3['getirenAdi'];?>
									<?php
									} 
								} 
								else
								{
								echo 'GETİREN SİLİNMİŞ';
								}
								?>
								</td>
								
								
								<!-- Small modal DÜZENLEME EKRANI-->
									<div class="modal fade bs-example-modal-lg" id="myModalGIDENId<?=$vcek2['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									  <div class="modal-dialog" role="document">
										<div class="modal-content">
											<form role="form" method="post" enctype="multipart/form-data" action="ps-duzenle.php">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="myModalLabel">PS Giden Kaydı Düzenle</h4>
											  </div>
											<div class="modal-body">
												<div class="form-group col-md-12">
													<div class="col-md-6">
													<label>İş Emri No</label>
														<input name="isEmriNo" type="text" id="isEmriNo" class="form-control"  placeholder="İş Emri No Girin" value="<?=$vcek2['isEmriNo'];?>">
														<input name="id" type="text" id="id" hidden="hidden" value="<?=$vcek2['id'];?>">
													</div>
													<div class="col-md-6">
													<label>Bayi</label>
													<select id="bayiNo" name="bayiNo" class="form-control select2" style="width: 100%;">
													   <?php
														$secilmisBayiId4=$vcek2['bayiNo'];
														$bayicek4=$connection->query("select * from bayiler")->fetchAll(PDO::FETCH_ASSOC);
														foreach ($bayicek4 as $bcek4)
														{
														?>
														<option value="<?=$bcek4['id'];?>">	<?=$bcek4['bayiAdi'];?> | <?=$bcek4['ilce'];?> / <?=$bcek4['il'];?>  </option>
													 
													  <?php } ?>
													   <option selected="selected" value="<?=$secilmisBayiId4;?>">Lütfen Listeden Bir Bayi Seçiniz</option>
													</select>
													</div>
													<input hidden="hidden" name="id" type="text" id="id"  value="<?=$vcek2['id'];?>">
												</div>
												
												<div class="form-group col-md-12">
													<div class="col-md-6">
													<label>Müşteri Adı</label>
														<input name="mAd" type="text" id="mAd" class="form-control"  placeholder="Müşteri Adı Girin" value="<?=$vcek2['mAd'];?>">
													</div>
													<div class="col-md-6">
													<label>Müşteri Soyadı</label>
														<input name="mSoyad" type="text" id="mSoyad" class="form-control" placeholder="Müşteri Soyadı Girin" value="<?=$vcek2['mSoyad'];?>">
													</div>
												</div>
												<div class="form-group col-md-12">
													<div class="col-md-6">
													<label>IMEI</label>
														<input name="imei" type="text" id="imei" class="form-control"  placeholder="IMEI Girin" value="<?=$vcek2['imei'];?>">
													</div>
													<div class="col-md-6">
													<label>Model</label>
														<input name="model" type="text" id="model" class="form-control"  placeholder="Model Girin" value="<?=$vcek2['model'];?>">
													</div>
												</div>
												
											
												<div class="form-group col-md-12">
													<div class="col-md-8">
													<label>Arıza</label>
														<textarea name="ariza" id="ariza" class="form-control"  placeholder="Arızayı Girin" ><?=$vcek2['ariza'];?></textarea>
													</div>
													<div class="col-md-4">
													<label>Tarih</label>
														<input name="tarih" type="text" id="tarih" class="form-control" value="<?=$vcek2['tarih'];?>">
													</div>
												</div>
												<div class="form-group col-md-12">
													<div class="col-md-6">
													<label>Getiren</label>
													<select id="getiren" name="getiren" class="form-control select2" style="width: 100%;">
													   <?php
														$secilmisGetirenId4=$vcek2['getiren'];
														$getirencek4=$connection->query("select * from getirenler")->fetchAll(PDO::FETCH_ASSOC);
														foreach ($getirencek4 as $gcek4)
														{
														?>
														<option value="<?=$gcek4['id'];?>">	<?=$gcek4['getirenAdi'];?></option>
													 
													  <?php } ?>
													   <option selected="selected" value="<?=$secilmisGetirenId4;?>">Lütfen Listeden Getireni Seçiniz</option>
													</select>
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
									<div class="modal fade bs-example-modal-lg" id="myModalDETAYGIDENId<?=$vcek2['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									  <div class="modal-dialog" role="document">
										<div class="modal-content">
											<form role="form" method="post" enctype="multipart/form-data">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="myModalLabel">PS Giden Detayları</h4>
											  </div>
											<div class="modal-body">
												<div class="form-group">
													<div class="col-md-4">
													<label>İş Emri No</label>
													<?=$vcek2['isEmriNo'];?>
													</div>
													<div class="col-md-5">
													<label>IMEI</label>
														<?=$vcek2['imei'];?>
													</div>
													<div class="col-md-3">
													<label>Model</label>
														<?=$vcek2['model'];?> 
													</div>
												</div>
												<div class="form-group">
													<div class="col-md-6">
													<label>Müşteri Adı</label>
														<?=$vcek2['mAd'];?>
													</div>
													<div class="col-md-6">
													<label>Müşteri Soyadı</label>
														<?=$vcek2['mSoyad'];?>
													</div>
												</div>
												
												<div class="form-group">
													<div class="col-md-6">
													<label>Kullanıcı</label>
													<?php
													$kullanici2=$vcek2['kullanici'];
													$percek2=$connection->query("select * from personel where id='$kullanici'")->fetchAll(PDO::FETCH_ASSOC);
													foreach ($percek2 as $pcek2)
													{
													echo $pcek2['kadi'];
													}
													?>
													</div>
													<div class="col-md-6">
													<label>Tarih</label>
														<?=$vcek2['tarih'];?>
													</div>
												</div>
												<div class="form-group">
													<div class="col-md-4">
													<label>Arıza</label>
														<?=$vcek2['ariza'];?>
													</div>
													<div class="col-md-4">
													<label>Getiren</label>
														<?php
														$GetirenId5=$vcek2['getiren'];
														$getirencek5=$connection->query("select * from getirenler where id='$GetirenId5'")->fetchAll(PDO::FETCH_ASSOC);
														foreach ($getirencek5 as $gcek5)
														{
														?>
														<?=$gcek5['getirenAdi'];?>
													  <?php } ?>
													</div>
													<div class="col-md-4">
													<label>Bayi</label>
														<?php
														$BayiId6=$vcek2['bayiNo'];
														$bayicek6=$connection->query("select * from bayiler where id='$BayiId6'")->fetchAll(PDO::FETCH_ASSOC);
														foreach ($bayicek6 as $bcek6)
														{
														?>
														<?=$bcek6['bayiAdi'];?> | <?=$bcek6['ilce'];?> / <?=$bcek6['il'];?>  </option>
													 
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
									if($vcek2['kullanici']==$_SESSION['girenid'] || $_SESSION['yetki']=="1")
									{
									?>
									<button type="button" class="btn btn-info fa fa-plus" data-toggle="modal" data-target="#myModalDETAYGIDENId<?=$vcek2['id'];?>"></button>
									<button type="button" class="btn btn-warning fa fa-pencil" data-toggle="modal" data-target="#myModalGIDENId<?=$vcek2['id'];?>"></button>
									<a href="ps-sil.php?id=<?=$vcek2['id'];?>" onclick="return confirm('İçeriği silmek istediğinize emin misiniz? Bu işlem geri alınamaz!');" class="fa fa-trash btn btn-danger"></a>
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
				</div>
			</div>
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
	 $("#example3").DataTable({
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