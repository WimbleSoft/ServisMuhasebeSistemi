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
document.getElementById("kasa_defteri").className = "active";
</script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <h1>
        Kasa Defteri
		</h1>
		
	  <!--------------->
	  <?php
	  if(isset($_GET["kasayaeklendi"])){
		if($_GET["kasayaeklendi"]==1){
		echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Başarılı!</h4>
                Kasa girdisi başarılı bir şekilde eklendi.
              </div>';
		}
	  }  
	  ?>	  
	  <?php
	  if(isset($_GET["kasadefterigirdisisilindi"])){
		if($_GET["kasadefterigirdisisilindi"]==1){
		echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Başarılı!</h4>
                Kasa girdisi başarılı bir şekilde silindi.
              </div>';
		}
	  }  
	  ?>	  
	  <?php
	  if(isset($_GET["kasadefterigirdisiduzenlendi"])){
		if($_GET["kasadefterigirdisiduzenlendi"]==1){
		echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Başarılı!</h4>
                Kasa girdisi başarılı bir şekilde düzenlendi.
              </div>';
		}
	  }  
	  ?>
	  <?php
	  if(isset($_GET["kapatilmisfatura"])){
		if($_GET["kapatilmisfatura"]==1){
		echo '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Zaten kapatılmış kayıt!</h4>
                Kasa girdisine ait kayıt daha önce kapatılmış.
              </div>';
		}
	  }  
	  ?>
	
	  <!--------------->
      <ol class="breadcrumb">
        <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
        <li><a href="#">Kasa Defteri</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
	  <div class="row">
		<div class="col-md-12">
		  <div class="box">
			<div class="box-header">
			 <div class="col-md-12">
				  <div class="box box-default collapsed-box">
					<div class="box-header with-border">
					<div class="box-tools">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
					  </div>
						<?php
						$toplamkasacek=$connection->query("select SUM(ucret) AS toplambugunkasadefterigelir from kasa_defteri where olusturulmaTarihi='".date("Y-m-d")."' AND gelirgider='gelir'")->fetchAll(PDO::FETCH_ASSOC);
						foreach ($toplamkasacek as $toplamkasa)
						{
						$toplamkasa['toplambugunkasadefterigelir'];
						}
						$toplamkasacek2=$connection->query("select SUM(ucret) AS toplambugunkasadefterigider from kasa_defteri where olusturulmaTarihi='".date("Y-m-d")."' AND gelirgider='gider'")->fetchAll(PDO::FETCH_ASSOC);
						foreach ($toplamkasacek2 as $toplamkasa2)
						{
						$toplamkasa2['toplambugunkasadefterigider'];
						}
						//PS GELİR
						$toplamkasacekposps=$connection->query("select SUM(ucret) AS toplambugunkasadefterigelirposps from kasa_defteri where olusturulmaTarihi='".date("Y-m-d")."' AND gelirgider='gelir' AND odeme='Pos' AND gelis='PS'")->fetchAll(PDO::FETCH_ASSOC);
						foreach ($toplamkasacekposps as $toplamkasaposps)
						{
						$toplamkasaposps['toplambugunkasadefterigelirposps'];
						}
						$toplamkasaceknakitps=$connection->query("select SUM(ucret) AS toplambugunkasadefterigelirnakitps from kasa_defteri where olusturulmaTarihi='".date("Y-m-d")."' AND gelirgider='gelir' AND odeme='Nakit' AND gelis='PS'")->fetchAll(PDO::FETCH_ASSOC);
						foreach ($toplamkasaceknakitps as $toplamkasanakitps)
						{
						$toplamkasanakitps['toplambugunkasadefterigelirnakitps'];
						}
						$toplamkasacekhavaleps=$connection->query("select SUM(ucret) AS toplambugunkasadefterigelirhavaleps from kasa_defteri where olusturulmaTarihi='".date("Y-m-d")."' AND gelirgider='gelir' AND odeme='Havale' AND gelis='PS'")->fetchAll(PDO::FETCH_ASSOC);
						foreach ($toplamkasacekhavaleps as $toplamkasahavaleps)
						{
						$toplamkasahavaleps['toplambugunkasadefterigelirhavaleps'];
						}
						//PS GİDER
						$toplamkasacekgidernakitps=$connection->query("select SUM(ucret) AS toplambugunkasadefterigidernakitps from kasa_defteri where olusturulmaTarihi='".date("Y-m-d")."' AND gelirgider='gider' AND odeme='Nakit' AND gelis='PS'")->fetchAll(PDO::FETCH_ASSOC);
						foreach ($toplamkasacekgidernakitps as $toplamkasagidernakitps)
						{
						$toplamkasagidernakitps['toplambugunkasadefterigidernakitps'];
						}
						$toplamkasacekgiderposps=$connection->query("select SUM(ucret) AS toplambugunkasadefterigiderposps from kasa_defteri where olusturulmaTarihi='".date("Y-m-d")."' AND gelirgider='gider' AND odeme='Pos' AND gelis='PS'")->fetchAll(PDO::FETCH_ASSOC);
						foreach ($toplamkasacekgiderposps as $toplamkasagiderposps)
						{
						$toplamkasagiderposps['toplambugunkasadefterigiderposps'];
						}
						$toplamkasacekgiderhavaleps=$connection->query("select SUM(ucret) AS toplambugunkasadefterigiderhavaleps from kasa_defteri where olusturulmaTarihi='".date("Y-m-d")."' AND gelirgider='gider' AND odeme='Havale' AND gelis='PS'")->fetchAll(PDO::FETCH_ASSOC);
						foreach ($toplamkasacekgiderhavaleps as $toplamkasagiderhavaleps)
						{
						$toplamkasagiderhavaleps['toplambugunkasadefterigiderhavaleps'];
						}
						//CI GELİR
						$toplamkasacekposci=$connection->query("select SUM(ucret) AS toplambugunkasadefterigelirposci from kasa_defteri where olusturulmaTarihi='".date("Y-m-d")."' AND gelirgider='gelir' AND odeme='Pos' AND gelis='CI'")->fetchAll(PDO::FETCH_ASSOC);
						foreach ($toplamkasacekposci as $toplamkasaposci)
						{
						$toplamkasaposci['toplambugunkasadefterigelirposci'];
						}
						$toplamkasaceknakitci=$connection->query("select SUM(ucret) AS toplambugunkasadefterigelirnakitci from kasa_defteri where olusturulmaTarihi='".date("Y-m-d")."' AND gelirgider='gelir' AND odeme='Nakit' AND gelis='CI'")->fetchAll(PDO::FETCH_ASSOC);
						foreach ($toplamkasaceknakitci as $toplamkasanakitci)
						{
						$toplamkasanakitci['toplambugunkasadefterigelirnakitci'];
						}
						$toplamkasacekhavaleci=$connection->query("select SUM(ucret) AS toplambugunkasadefterigelirhavaleci from kasa_defteri where olusturulmaTarihi='".date("Y-m-d")."' AND gelirgider='gelir' AND odeme='Havale' AND gelis='CI'")->fetchAll(PDO::FETCH_ASSOC);
						foreach ($toplamkasacekhavaleci as $toplamkasahavaleci)
						{
						$toplamkasahavaleci['toplambugunkasadefterigelirhavaleci'];
						}
						//CI GİDER
						$toplamkasacekgidernakitci=$connection->query("select SUM(ucret) AS toplambugunkasadefterigidernakitci from kasa_defteri where olusturulmaTarihi='".date("Y-m-d")."' AND gelirgider='gider' AND odeme='Nakit' AND gelis='CI'")->fetchAll(PDO::FETCH_ASSOC);
						foreach ($toplamkasacekgidernakitci as $toplamkasagidernakitci)
						{
						$toplamkasagidernakitci['toplambugunkasadefterigidernakitci'];
						}
						$toplamkasacekgiderposci=$connection->query("select SUM(ucret) AS toplambugunkasadefterigiderposci from kasa_defteri where olusturulmaTarihi='".date("Y-m-d")."' AND gelirgider='gider' AND odeme='Pos' AND gelis='CI'")->fetchAll(PDO::FETCH_ASSOC);
						foreach ($toplamkasacekgiderposci as $toplamkasagiderposci)
						{
						$toplamkasagiderposci['toplambugunkasadefterigiderposci'];
						}
						$toplamkasacekgiderhavaleci=$connection->query("select SUM(ucret) AS toplambugunkasadefterigiderhavaleci from kasa_defteri where olusturulmaTarihi='".date("Y-m-d")."' AND gelirgider='gider' AND odeme='Havale' AND gelis='CI'")->fetchAll(PDO::FETCH_ASSOC);
						foreach ($toplamkasacekgiderhavaleci as $toplamkasagiderhavaleci)
						{
						$toplamkasagiderhavaleci['toplambugunkasadefterigiderhavaleci'];
						}
						
						?>
					  <h3 class="box-title">GÜNLÜK ÖZET| Günlük Toplam Gelir: <?=number_format($toplamkasa['toplambugunkasadefterigelir'],2);?> TL | Günlük Toplam Gider: <?=number_format($toplamkasa2['toplambugunkasadefterigider'],2);?> TL </h3>
					  
					</div>
					<!-------TOPLAMLAR PS-------->
					<div class="box-body">
						 <div class="form-group">
							 <div class="col-md-6">
							 <label>Gelirler PS</label>
								<div class="row">
									 <div class="col-md-3">
									 Nakit Gelirleri
									 </div>
									 <div class="col-md-3">
									 <?=number_format($toplamkasanakitps['toplambugunkasadefterigelirnakitps'],2);?> TL
									 </div>
								</div>
								<div class="row">
									 <div class="col-md-3">
									 POS Gelirleri
									 </div>
									 <div class="col-md-3">
									 <?=number_format($toplamkasaposps['toplambugunkasadefterigelirposps'],2);?> TL
									 </div>
								</div>
								<div class="row">
									 <div class="col-md-3">
									 Havale Gelirleri
									 </div>
									 <div class="col-md-3">
									 <?=number_format($toplamkasahavaleps['toplambugunkasadefterigelirhavaleps'],2);?> TL
									 </div>
								</div>
							 </div>
							 <div class="col-md-6">
							 <label>Giderler PS</label>
								<div class="row">
									 <div class="col-md-3">
									 Nakit Giderleri
									 </div>
									 <div class="col-md-3">
									 <?=number_format($toplamkasagidernakitps['toplambugunkasadefterigidernakitps'],2);?> TL
									 </div>
								</div>
								<div class="row">
									 <div class="col-md-3">
									 POS Giderleri
									 </div>
									 <div class="col-md-3">
									 <?=number_format($toplamkasagiderposps['toplambugunkasadefterigiderposps'],2);?> TL
									 </div>
								</div>
								<div class="row">
									 <div class="col-md-3">
									 Havale Giderleri
									 </div>
									 <div class="col-md-3">
									 <?=number_format($toplamkasagiderhavaleps['toplambugunkasadefterigiderhavaleps'],2);?> TL
									 </div>
								</div>
							 </div>
						 </div>
					</div>
					<!-------TOPLAMLAR PS-------->
					
					<!-------TOPLAMLAR CI-------->
					<div class="box-body">
						 <div class="form-group">
							 <div class="col-md-6">
							 <label>Gelirler CI</label>
								<div class="row">
									 <div class="col-md-3">
									 Nakit Gelirleri
									 </div>
									 <div class="col-md-3">
									 <?=number_format($toplamkasanakitci['toplambugunkasadefterigelirnakitci'],2);?> TL
									 </div>
								</div>
								<div class="row">
									 <div class="col-md-3">
									 POS Gelirleri
									 </div>
									 <div class="col-md-3">
									 <?=number_format($toplamkasaposci['toplambugunkasadefterigelirposci'],2);?> TL
									 </div>
								</div>
								<div class="row">
									 <div class="col-md-3">
									 Havale Gelirleri
									 </div>
									 <div class="col-md-3">
									 <?=number_format($toplamkasahavaleci['toplambugunkasadefterigelirhavaleci'],2);?> TL
									 </div>
								</div>
							 </div>
							 <div class="col-md-6">
							 <label>Giderler CI</label>
								<div class="row">
									 <div class="col-md-3">
									 Nakit Giderleri
									 </div>
									 <div class="col-md-3">
									 <?=number_format($toplamkasagidernakitci['toplambugunkasadefterigidernakitci'],2);?> TL
									 </div>
								</div>
								<div class="row">
									 <div class="col-md-3">
									 POS Giderleri
									 </div>
									 <div class="col-md-3">
									 <?=number_format($toplamkasagiderposci['toplambugunkasadefterigiderposci'],2);?> TL
									 </div>
								</div>
								<div class="row">
									 <div class="col-md-3">
									 Havale Giderleri
									 </div>
									 <div class="col-md-3">
									 <?=number_format($toplamkasagiderhavaleci['toplambugunkasadefterigiderhavaleci'],2);?> TL
									 </div>
								</div>
							 </div>
						 </div>
					</div>
					<!-------TOPLAMLAR CI-------->
				  </div>
			 </div>
			</div>
		  </div>
			
		</div>
	</div>
	
	  <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
			 <div class="col-md-12">
			  <div class="box box-default collapsed-box">
				<div class="box-header with-border">
				  <h3 class="box-title">Yeni Defter Girdisi Ekle</h3>
				  <div class="box-tools">
				  
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
					
					</button>
				  
				  </div>
				</div>
				<!-------EKLEME-------->
				<div class="box-body">
					<form role="form" method="post" enctype="multipart/form-data" action="kasa_defteri-ekle.php">
						<div class="form-group col-xs-12">
							<div class="col-md-2">
							<label>İş Emri No</label>
								<input name="isEmriNo" type="text" id="isEmriNo" class="form-control"  placeholder="İş Emri No Girin">
							</div>
							<div class="col-md-2">
							<label>Ücret</label>
								<input name="ucret" type="text" id="ucret" class="form-control" placeholder="Ücret Girin">
							</div>
							<div class="col-md-1">
							<label>Ödeme</label>
							<select name="odeme" id="odeme">
								<option value="Pos">Pos</option>
								<option value="Nakit">Nakit</option>
								<option value="Havale">Havale</option>
							</select>
							</div>
							<div class="col-md-3">
							<label>Açıklaması</label>
								<textarea rows="4" cols="50" name="aciklama" id="aciklama" class="form-control"  placeholder="Açıklama Girin"></textarea>
							</div>
							<div class="col-md-2">
							<label>Oluşturulma Tarihi</label>
								<input name="olusturulmaTarihi" <?php if($_SESSION["yetki"]=="0"){ echo 'readonly="readonly"';} ?> id="olusturulmaTarihi" type="text" class="form-control" id="datepicker"  value="<?=date('Y-m-d');?>">
							</div>
							<div class="col-md-1">
							<label>Gelir-Gider</label>
							<select name="gelirgider" id="gelirgider">
								<option value="Gelir">Gelir</option>
								<option value="Gider">Gider</option>
							</select>
							</div>
						</div>
						<div class="form-group col-xs-12">
								<div class="col-md-3">
								<label>Müşteri Adı</label>
									<input name="mAd" type="text" id="mAd" class="form-control" placeholder="Müşteri Adı Girin">
								</div>
								<div class="col-md-3">
								<label>Müşteri Soyadı</label>
									<input name="mSoyad" type="text" id="mSoyad" class="form-control" placeholder="Müşteri Soyadı Girin">
								</div>
								<div class="col-md-2">
								<label>Müşteri Telefon</label>
									<input name="telefon" type="text" id="telefon" class="form-control" placeholder="Müşteri Telefonu Girin">
								</div>
								<div class="col-md-2">
								<label>IMEI</label>
									<input name="imei" type="text" id="imei" class="form-control" placeholder="IMEI Girin">
								</div>
								<div class="col-md-2">
								<label>Model</label>
									<input name="model" type="text" id="model" class="form-control" placeholder="Model Girin">
								</div>
						</div>
						<div class="form-group col-xs-12">
							<div class="col-md-1">
							<label>Geliş</label>
							<select name="gelis" id="gelis">
								<option value="CI">CI</option>
								<option value="PS">PS</option>
							</select>
							</div>
							<div class="col-md-1">
									<label>İşlem</label>
									<button type="submit" class="btn btn-primary">Girdiyi Ekle</button>
							</div>
						</div>
					  </form>
					</div>
				<!-------EKLEME-------->
				</div>
			  </div>
			 </div>
            </div>
			
		  </div>
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
								<form role="form" method="post" enctype="multipart/form-data" action="kasa_defteri.php">
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
								<form role="form" method="post" enctype="multipart/form-data" action="kasa_defteri.php">
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
		  </div>
		</div>
	  </div>
	  <div class="row">
	  <!---- GELİRLER TABLOSU---->
		<div class="col-xs-6">
		  <div class="box">
			<div class="box-header with-border">
			  <h2 class="box-title">GELİRLER</h2>
			</div>
			<div class="box-body">
			  <table id="example1" class="table table-bordered table-striped">
				<thead>
				  <tr>
					<th>ID</th>
					<th>TARİH</th>
					<th>İŞ EMRİ</th>
					<th>GELİŞ</th>
					<th hidden="hidden">IMEI</th>
					<th hidden="hidden">MODEL</th>
					<th>M.AD SOYAD</th>
					<th hidden="hidden">TELEFON</th>
					<th>ÜCRET</th>
					<th hidden="hidden">ÖDEME</th>
					<th hidden="hidden">AÇIKLAMA</th>
					<th>İŞLEMLER</th>
				  </tr>
				</thead>

				<tbody>
				<?php
								
					
					if($_SESSION['yetki']=='1')
					{
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
							$vericek=$connection->query("select * from kasa_defteri where gelirgider='Gelir' AND olusturulmaTarihi BETWEEN '".$_POST['baslangictarihi']."' AND '".$_POST['bitistarihi']."' ORDER by ID DESC LIMIT $limit ")->fetchAll(PDO::FETCH_ASSOC);
							}
							else
							{
							$vericek=$connection->query("select * from kasa_defteri where gelirgider='Gelir' ORDER by ID DESC LIMIT $limit ")->fetchAll(PDO::FETCH_ASSOC);
							}
						}
						else
						{
							if(isset($_POST['Ara_isEmriNo']))
							{
								if($_POST['Ara_isEmriNo']!=NULL)
								{
								$Ara_isEmriNo=$_POST['Ara_isEmriNo'];
								$vericek=$connection->query("select * from kasa_defteri where isEmriNo='$Ara_isEmriNo' AND gelirgider='Gelir'")->fetchAll(PDO::FETCH_ASSOC);
								}
							} 
							else
							{
							$vericek=$connection->query("select * from kasa_defteri where gelirgider='Gelir' ORDER by ID DESC LIMIT $limit")->fetchAll(PDO::FETCH_ASSOC);
							}
						}
					}
					else
					{
					$vericek=$connection->query("select * from kasa_defteri where gelirgider='Gelir' AND olusturulmaTarihi='".date("Y-m-d")."' ")->fetchAll(PDO::FETCH_ASSOC);
					}
					foreach ($vericek as $vcek)
					{
					?>
				  <tr>
				  	<td><?=$vcek['id'];?></td>
					<td><?=date("d-m-Y", strtotime($vcek['olusturulmaTarihi']));?></td>
					<td><?=$vcek['isEmriNo'];?></td>
					<td><?=$vcek['gelis'];?></td>
					<td hidden="hidden"><?=$vcek['imei'];?></td>
					<td hidden="hidden"><?=$vcek['model'];?></td>
					<td><?=$vcek['mAd'];?> <?=$vcek['mSoyad'];?></td>
					<td hidden="hidden"><?=$vcek['telefon'];?></td>
					<td><?=$vcek['ucret'];?></td>
					<td hidden="hidden"><?=$vcek['odeme'];?></td>
					<td hidden="hidden"><?=$vcek['aciklama'];?></td>
					
					<!-- GELİR DÜZENLEME -->
					<div class="modal fade bs-example-modal-lg" id="myModalGelirId<?=$vcek['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
							<form role="form" method="post" enctype="multipart/form-data" action="kasa_defteri-duzenle.php">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Kasa Defteri Gelir Düzenle</h4>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<div class="col-md-6">
										<label>İş Emri No</label>
											<input name="isEmriNo" type="text" id="isEmriNo" class="form-control"  placeholder="İş Emri No Girin" value="<?=$vcek['isEmriNo'];?>">
											<input name="id" type="text" id="id" hidden="hidden" value="<?=$vcek['id'];?>">
										</div>
										<div class="col-md-3">
										<label>Ücret</label>
											<input name="ucret" type="text" id="ucret" class="form-control" placeholder="Ücreti Girin" value="<?=$vcek['ucret'];?>">
										</div>
										<?php if($_SESSION["yetki"]=="1"){  ?>
										<div class="col-md-3">
										<label>Ödeme</label>
										<select name="odeme" id="odeme" class="form-control">
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
									</div>
									<div class="form-group">
										<div class="col-md-6">
										<label>Müşteri Adı</label>
										<input name="mAd" type="text" id="mAd" class="form-control" placeholder="Müşteri Adını Girin" value="<?=$vcek['mAd'];?>">
										</div>
										<div class="col-md-6">
										<label>Müşteri Soyadı</label>
										<input name="mSoyad" type="text" id="mSoyad" class="form-control" placeholder="Müşteri Soyadı Girin" value="<?=$vcek['mSoyad'];?>">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-6">
										<label>Müşteri Telefonu</label>
										<input name="telefon" type="text" id="telefon" class="form-control" placeholder="Müşteri Telefonu Girin" value="<?=$vcek['telefon'];?>">
										</div>
										<div class="col-md-6">
										<label>IMEI</label>
										<input name="imei" type="text" id="imei" class="form-control" placeholder="IMEI Girin" value="<?=$vcek['imei'];?>">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-3">
										<label>Tarih</label>
										<input name="olusturulmaTarihi" type="text" id="olusturulmaTarihi" class="form-control" value="<?=$vcek['olusturulmaTarihi'];?>">
										</div>
										<div class="col-md-9">
										<label>Açıklama</label>
										<textarea name="aciklama" id="aciklama" class="form-control"  placeholder="Açıklama Girin" ><?=$vcek['aciklama'];?></textarea>
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
					<!-- GELİR DÜZENLEME -->
					<!-- GELİR DETAY -->
					<div class="modal fade bs-example-modal-lg" id="myModalGelirDETAYId<?=$vcek['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
								<form role="form" method="post" enctype="multipart/form-data" action="kasa_defteri-duzenle.php">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Kasa Defteri Gider Detay</h4>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<div class="col-md-4">
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
											<div class="col-md-4">
											<label>Müşteri Telefonu</label>
											<?=$vcek['telefon'];?>
											</div>
											<div class="col-md-4">
											<label>IMEI</label>
											<?=$vcek['imei'];?>
											</div>
											<div class="col-md-4">
											<label>Model</label>
											<?=$vcek['model'];?>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-3">
											<label>Tarih</label>
											<?=date("d-m-Y", strtotime($vcek['olusturulmaTarihi']));?>
											</div>
											<div class="col-md-5">
											<label>Açıklama</label>
											<?=$vcek['aciklama'];?>
											</div>
											<div class="col-md-4">
											<label>Gelişi</label>
											<?=$vcek['gelis'];?>
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
					<!-- /GELİR DETAY -->
					<td>
						<span class="button-group">
							<button type="button" class="btn btn-info fa fa-plus" data-toggle="modal" data-target="#myModalGelirDETAYId<?=$vcek['id'];?>"></button>
							<?php if($_SESSION["yetki"]=="1"){  ?>
							<a href="kasa_defteri-onay.php?isEmriNo=<?=$vcek['isEmriNo'];?>&odeme=<?=$vcek['odeme'];?>" onclick="return confirm('İş Emri bilgisini kontrol ettiğinize emin olun. İstediğiniz iş emri değilse, istemediğiniz bir faturayı 'alındı' olarak değiştirmiş olursunuz. Faturalardan tekrar düzenlemek zorunda kalabilirsiniz.');" class="fa fa-check btn btn-success"></a>
							<button type="button" class="btn btn-warning fa fa-pencil" data-toggle="modal" data-target="#myModalGelirId<?=$vcek['id'];?>"></button>
							<a href="kasa_defteri-sil.php?id=<?=$vcek['id'];?>" onclick="return confirm('İçeriği silmek istediğinize emin misiniz? Bu işlem geri alınamaz ve bu bilgisayara ait ödünç bilgileri de silinecektir!');" class="fa fa-trash btn btn-danger"></a>
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
	    
		<!---- GİDERLER TABLOSU---->
		<div class="col-xs-6">
		  <div class="box">
				<div class="box-header with-border">
				  <h2 class="box-title">GİDERLER</h2>
				</div>
				<div class="box-body">
				  <table id="example3" class="table table-bordered table-striped">
					<thead>
					  <tr>
						<th>ID</th>
						<th>TARİH</th>
						<th>İŞ EMRİ</th>
						<th hidden="hidden">GELİŞ</th>
						<th hidden="hidden">IMEI</th>
						<th hidden="hidden">MODEL</th>
						<th>M.AD SOYAD</th>
						<th hidden="hidden">TELEFON</th>
						<th>ÜCRET</th>
						<th hidden="hidden">ÖDEME</th>
						<th hidden="hidden">AÇIKLAMA</th>
						<th>İŞLEMLER</th>
					  </tr>
					</thead>

					<tbody>
						
						<?php
						if($_SESSION['yetki']=='1')
						{
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
								$vericek2=$connection->query("select * from kasa_defteri where gelirgider='Gider' AND olusturulmaTarihi BETWEEN '".$_POST['baslangictarihi']."' AND '".$_POST['bitistarihi']."' ORDER by ID DESC LIMIT $limit ")->fetchAll(PDO::FETCH_ASSOC);
								}
								else
								{
								$vericek2=$connection->query("select * from kasa_defteri where gelirgider='Gider' ORDER by ID DESC LIMIT $limit ")->fetchAll(PDO::FETCH_ASSOC);
								}
							}
							else
							{
								if(isset($_POST['Ara_isEmriNo']))
								{
									if($_POST['Ara_isEmriNo']!=NULL)
									{
									$Ara_isEmriNo=$_POST['Ara_isEmriNo'];
									$vericek2=$connection->query("select * from kasa_defteri where isEmriNo='$Ara_isEmriNo' AND gelirgider='Gider'")->fetchAll(PDO::FETCH_ASSOC);
									}
								} 
								else
								{
								$vericek2=$connection->query("select * from kasa_defteri where gelirgider='Gider' ORDER by ID DESC LIMIT $limit")->fetchAll(PDO::FETCH_ASSOC);
								}
							}
						}
						else
						{
						$vericek2=$connection->query("select * from kasa_defteri where gelirgider='Gider' AND olusturulmaTarihi='".date("Y-m-d")."' ")->fetchAll(PDO::FETCH_ASSOC);
						}
						foreach ($vericek2 as $vcek2)
						{
						?>
					  <tr>
						<td><?=$vcek2['id'];?></td>
						<td><?=date("d-m-Y", strtotime($vcek2['olusturulmaTarihi']));?></td>
						<td><?=$vcek2['isEmriNo'];?></td>
						<td hidden="hidden"><?=$vcek2['gelis'];?></td>
						<td hidden="hidden"><?=$vcek2['imei'];?></td>
						<td hidden="hidden"><?=$vcek2['model'];?></td>
						<td><?=$vcek2['mAd'];?> <?=$vcek2['mSoyad'];?></td>
						<td hidden="hidden"><?=$vcek2['telefon'];?></td>
						<td><?=$vcek2['ucret'];?></td>
						<td hidden="hidden"><?=$vcek2['odeme'];?></td>
						<td hidden="hidden"><?=$vcek2['aciklama'];?></td>
						<!-- GİDER DÜZENLEME -->
						<div class="modal fade bs-example-modal-lg" id="myModalGiderId<?=$vcek2['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
								<form role="form" method="post" enctype="multipart/form-data" action="kasa_defteri-duzenle.php">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Kasa Defteri Gider Düzenle</h4>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<div class="col-md-4">
											<label>İş Emri No</label>
												<input name="isEmriNo" type="text" id="isEmriNo" class="form-control"  placeholder="İş Emri No Girin" value="<?=$vcek2['isEmriNo'];?>">
												<input name="id" type="text" id="id" hidden="hidden" value="<?=$vcek2['id'];?>">
											</div>
											<div class="col-md-3">
											<label>Ücret</label>
												<input name="ucret" type="text" id="ucret" class="form-control" placeholder="Ücreti Girin" value="<?=$vcek2['ucret'];?>">
											</div>
											<?php if($_SESSION["yetki"]=="1"){  ?>
											<div class="col-md-3">
											<label>Ödeme</label>
											<select name="odeme" id="odeme" class="form-control">
												<option <?php if($vcek2['odeme']=="") echo 'selected';?> value="">Yok</option>
												<option <?php if($vcek2['odeme']=="Nakit") echo 'selected';?> value="Nakit">Nakit</option>
												<option <?php if($vcek2['odeme']=="Pos") echo 'selected';?> value="Pos">Pos</option>
												<option <?php if($vcek2['odeme']=="Havale") echo 'selected';?> value="Havale">Havale</option>
											</select>
											</div>
											<?php
											}
											else {	?>
										<div class="col-md-3">
										<label>Ödeme</label>
											<input name="odeme" type="text" id="odeme" readonly="readonly" class="form-control" value="<?=$vcek2['odeme'];?>">
										</div>
										<?php } ?>
										</div>
										<div class="form-group">
											<div class="col-md-6">
											<label>Müşteri Adı</label>
											<input name="mAd" type="text" id="mAd" class="form-control" placeholder="Müşteri Adını Girin" value="<?=$vcek2['mAd'];?>">
											</div>
											<div class="col-md-6">
											<label>Müşteri Soyadı</label>
											<input name="mSoyad" type="text" id="mSoyad" class="form-control" placeholder="Müşteri Soyadı Girin" value="<?=$vcek2['mSoyad'];?>">
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-12">
											<label>Müşteri Telefonu</label>
											<input name="telefon" type="text" id="telefon" class="form-control" placeholder="Müşteri Telefonu Girin" value="<?=$vcek2['telefon'];?>">
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-3">
											<label>Tarih</label>
											<input name="olusturulmaTarihi" type="text" id="olusturulmaTarihi" class="form-control" value="<?=$vcek2['olusturulmaTarihi'];?>">
											</div>
											<div class="col-md-9">
											<label>Açıklama</label>
											<textarea name="aciklama" id="aciklama" class="form-control"  placeholder="Açıklama Girin" ><?=$vcek2['aciklama'];?></textarea>
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
						<!-- /GİDER DÜZENLEME -->
						<!-- GİDER DETAY -->
						<div class="modal fade bs-example-modal-lg" id="myModalGiderDETAYId<?=$vcek2['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
								<form role="form" method="post" enctype="multipart/form-data" action="kasa_defteri-duzenle.php">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Kasa Defteri Gider Detay</h4>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<div class="col-md-4">
											<label>İş Emri No</label>
												<?=$vcek2['isEmriNo'];?>
											</div>
											<div class="col-md-3">
											<label>Ücret</label>
												<?=$vcek2['ucret'];?>
											</div>
											<div class="col-md-3">
											<label>Ödeme</label>
												<?=$vcek2['odeme'];?>
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
											<div class="col-md-12">
											<label>Müşteri Telefonu</label>
											<?=$vcek2['telefon'];?>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-3">
											<label>Tarih</label>
											<?=date("d-m-Y", strtotime($vcek2['olusturulmaTarihi']));?>
											</div>
											<div class="col-md-9">
											<label>Açıklama</label>
											<?=$vcek2['aciklama'];?>
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
						<!-- /GİDER DETAY -->
						<td>
							<span class="button-group">
								<button type="button" class="btn btn-info fa fa-plus" data-toggle="modal" data-target="#myModalGiderDETAYId<?=$vcek2['id'];?>"></button>
								<button type="button" class="btn btn-warning fa fa-pencil" data-toggle="modal" data-target="#myModalGiderId<?=$vcek2['id'];?>"></button>
								<a href="kasa_defteri-sil.php?id=<?=$vcek2['id'];?>" onclick="return confirm('İçeriği silmek istediğinize emin misiniz? Bu işlem geri alınamaz.!');" class="fa fa-trash btn btn-danger"></a>
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
    </section>
  </div>
  
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
		"paging": true,
		"lengthChange": true,
		"searching": true,
		"ordering": true,
		"info": true,
		"autoWidth": true,
	 "order": [[0,'desc']],
	  dom: 'Bfrtip',
        buttons: [
            'excel', 'print'
        ]
	 
	 });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
	$("#example3").DataTable({
		"paging": true,
		"lengthChange": true,
		"searching": true,
		"ordering": true,
		"info": true,
		"autoWidth": true,
	 "order": [[0,'desc']],
	  dom: 'Bfrtip',
        buttons: [
            'excel', 'print'
        ]
	 
	 });
	
    $(".select2").select2();
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
	$('#olusturulmaTarihi').datepicker({
      autoclose: true
    });
	
  });
</script>
  <!-- PAGE CONTENT END -->

 <?php include("footer.php") ?>
 
 
 <!-- Giriş KONTROL -->         
<?php	} ?>