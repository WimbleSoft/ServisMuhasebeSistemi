<?php
session_start(); 
if(!isset($_SESSION["login"])){
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


<script>
document.getElementById("anasayfa").className = "active";
</script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Anasayfa
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
        
      </ol>
    </section>
<?php if($_SESSION["yetki"]=="1"){ ?>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?=$toplamdepodakilersay=$connection->query("select * from faturalar where durum='2'")->rowCount();?><sup style="font-size: 20px"></sup></h3>
              <p>Depodakilere Ait Toplam Kayıt Sayısı</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-home"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?=$toplamalinmamissay=$connection->query("select * from faturalar where durum=0")->rowCount();?><sup style="font-size: 20px"></sup></h3>
              <p>Toplam Alınmamış Kayıtların Sayısı</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-cart"></i>
            </div>
          </div>
        </div>      
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?=$toplamodemebekleyensay=$connection->query("select * from faturalar where durum=0 OR durum=2 ")->rowCount();?><sup style="font-size: 20px"></sup></h3>

              <p>Toplam Ödeme Bekleyen Kayıtların Sayısı</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
		<div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=$toplamalinmissay=$connection->query("select * from faturalar where durum=1")->rowCount();?><sup style="font-size: 20px"></sup></h3>
              <p>Toplam Alınmış Kayıtların Sayısı</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-cart"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=$personelsay=$connection->query("select * from personel")->rowCount();?></h3>

              <p>Toplam Personel Sayısı</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
           
          </div>
        </div>
        <!-- ./col -->
       
      </div>
      <!-- /.row -->
	  <div class="row">
		<div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="ion ion-ios-home"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Depodakilere Ait Kayıtların Toplamı</span>
              <span class="info-box-number">
				<?php
				$toplamfaturacek=$connection->query("select SUM(ucret) AS toplamdepoda from faturalar where durum=2")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($toplamfaturacek as $toplamfatura)
				{
				$toplamfatura['toplamdepoda'];
				}
				?>
				<?=number_format($toplamfatura['toplamdepoda'],2);?> TL
			  </span>
			  
			  
				<?php	
				$ayliktoplamfaturacek=$connection->query("select SUM(ucret) AS toplambuaydepoda from faturalar where durum=2 AND olusturulmaTarihi BETWEEN '".date("Y")."/".date("m")."/01' AND DATE_SUB(DATE_ADD('".date("Y")."/".date("m")."/01', INTERVAL 1 MONTH), INTERVAL 1 DAY) ")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($ayliktoplamfaturacek as $buayliktoplamfatura)
				{
				$buayliktoplamfatura['toplambuaydepoda'];
				}
				
				$oncekiayliktoplamfaturacek=$connection->query("select SUM(ucret) AS toplamgecenaydepoda from faturalar where durum=2 AND olusturulmaTarihi BETWEEN DATE_SUB('".date("Y")."/".date("m")."/01', INTERVAL 1 MONTH) AND DATE_SUB('".date("Y")."/".date("m")."/01', INTERVAL 1 DAY) ")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($oncekiayliktoplamfaturacek as $gecenayliktoplamfatura)
				{
				$gecenayliktoplamfatura['toplamgecenaydepoda'];
				}
				
				$gunluktoplamfaturacek=$connection->query("select SUM(ucret) AS toplambugundepoda from faturalar where durum=2 AND olusturulmaTarihi='".date("Y-m-d")."' ")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($gunluktoplamfaturacek as $bugunluktoplamfatura)
				{
				$bugunluktoplamfatura['toplambugundepoda'];
				}
				?>
				<?php if($buayliktoplamfatura['toplambuaydepoda']==0)
				{
				$performans1=0;
				}
				else
				{
				$performans1=number_format((($buayliktoplamfatura['toplambuaydepoda']-$gecenayliktoplamfatura['toplamgecenaydepoda'])*100/$buayliktoplamfatura['toplambuaydepoda']),2);
				}
				?>
              <div class="progress">
                <div class="progress-bar" style="width:100%"></div>
              </div>
					<span class="progress-description">Bu gün toplamı: <?=number_format($bugunluktoplamfatura['toplambugundepoda'],2);?> TL</span>
					<span class="progress-description">Bu ay toplamı: <?=number_format($buayliktoplamfatura['toplambuaydepoda'],2);?> TL</span>
					<span class="progress-description">Geçen ay toplamı: <?=number_format($gecenayliktoplamfatura['toplamgecenaydepoda'],2);?> TL</span>
					<span class="progress-description">Geçen aya göre %<?=$performans1;?></span>
                  
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
		<div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box bg-blue">
            <span class="info-box-icon"><i class="ion ion-bag"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Alınmamış Kayıtların Toplamı</span>
              <span class="info-box-number">
				<?php
				$toplamfaturacek3=$connection->query("select SUM(ucret) AS toplamacik from faturalar where durum=0")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($toplamfaturacek3 as $toplamfatura3)
				{
				$toplamfatura3['toplamacik'];
				}
				?>
				<?=number_format($toplamfatura3['toplamacik'],2);?> TL
			  </span>
			  
			  
				<?php	
				$ayliktoplamfaturacek3=$connection->query("select SUM(ucret) AS toplambuayacik from faturalar where durum=0 AND olusturulmaTarihi BETWEEN '".date("Y")."/".date("m")."/01' AND DATE_SUB(DATE_ADD('".date("Y")."/".date("m")."/01', INTERVAL 1 MONTH),INTERVAL 1 DAY) ")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($ayliktoplamfaturacek3 as $buayliktoplamfatura3)
				{
				$buayliktoplamfatura3['toplambuayacik'];
				}
				
				$oncekiayliktoplamfaturacek3=$connection->query("select SUM(ucret) AS toplamgecenayacik from faturalar where durum=0 AND olusturulmaTarihi BETWEEN DATE_SUB('".date("Y")."/".date("m")."/01', INTERVAL 1 MONTH) AND DATE_SUB('".date("Y")."/".date("m")."/01', INTERVAL 1 DAY) ")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($oncekiayliktoplamfaturacek3 as $gecenayliktoplamfatura3)
				{
				$gecenayliktoplamfatura3['toplamgecenayacik'];
				}
				$gunluktoplamfaturacek3=$connection->query("select SUM(ucret) AS toplambugunacik from faturalar where durum=0 AND olusturulmaTarihi='".date("Y-m-d")."' ")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($gunluktoplamfaturacek3 as $bugunluktoplamfatura3)
				{
				$bugunluktoplamfatura3['toplambugunacik'];
				}
				?>
				<?php if($buayliktoplamfatura3['toplambuayacik']==0)
				{
				$performans3=0;
				}
				else
				{
				$performans3=number_format((($buayliktoplamfatura3['toplambuayacik']-$gecenayliktoplamfatura3['toplamgecenayacik'])*100/$buayliktoplamfatura3['toplambuayacik']),2);
				}
				?>
              <div class="progress">
                <div class="progress-bar" style="width:100%"></div>
              </div>
					<span class="progress-description">Bu gün toplamı: <?=number_format($bugunluktoplamfatura3['toplambugunacik'],2);?> TL</span>
					<span class="progress-description">Bu ay toplamı: <?=number_format($buayliktoplamfatura3['toplambuayacik'],2);?> TL</span>
					<span class="progress-description">Geçen ay toplamı: <?=number_format($gecenayliktoplamfatura3['toplamgecenayacik'],2);?> TL</span>
					<span class="progress-description">Geçen aya göre %<?=$performans3;?></span>
                  
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
		<div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box bg-blue">
            <span class="info-box-icon"><i class="ion ion-bag"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Ödeme Bekleyen Kayıtların Toplamı</span>
              <span class="info-box-number">
				
				<?=number_format(($toplamfatura3['toplamacik']+$toplamfatura['toplamdepoda']),2);?> TL
			  </span>
			  
			  
				
				<?php if(($buayliktoplamfatura['toplambuaydepoda']+$buayliktoplamfatura3['toplambuayacik'])==0)
				{
				$performans5=0;
				}
				else
				{
				$performans5=number_format(((($buayliktoplamfatura['toplambuaydepoda']+$buayliktoplamfatura3['toplambuayacik'])-($gecenayliktoplamfatura['toplamgecenaydepoda']+$gecenayliktoplamfatura3['toplamgecenayacik']))*100/($buayliktoplamfatura['toplambuaydepoda']+$buayliktoplamfatura3['toplambuayacik'])),2);
				}
				?>
              <div class="progress">
                <div class="progress-bar" style="width:100%"></div>
              </div>
					<span class="progress-description">Bu gün toplamı: <?=number_format(($bugunluktoplamfatura['toplambugundepoda']+$bugunluktoplamfatura3['toplambugunacik']),2);?> TL</span>
					<span class="progress-description">Bu ay toplamı: <?=number_format(($buayliktoplamfatura['toplambuaydepoda']+$buayliktoplamfatura3['toplambuayacik']),2);?> TL</span>
					<span class="progress-description">Geçen ay toplamı: <?=number_format(($gecenayliktoplamfatura['toplamgecenaydepoda']+$gecenayliktoplamfatura3['toplamgecenayacik']),2);?> TL</span>
					<span class="progress-description">Geçen aya göre %<?=$performans5;?></span>
                  
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
		<div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="ion ion-ios-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Alınmış Kayıtların Toplamı</span>
              <span class="info-box-number">
				<?php
				$toplamfaturacek2=$connection->query("select SUM(ucret) AS toplamkapanmis from faturalar where durum=1")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($toplamfaturacek2 as $toplamfatura2)
				{
				$toplamfatura2['toplamkapanmis'];
				}
				?>
				<?=number_format($toplamfatura2['toplamkapanmis'],2);?> TL
			  </span>
			  
			  
				<?php	
				$ayliktoplamfaturacek2=$connection->query("select SUM(ucret) AS toplambuaykapanmis from faturalar where durum=1 AND olusturulmaTarihi BETWEEN '".date("Y")."/".date("m")."/01' AND DATE_SUB(DATE_ADD('".date("Y")."/".date("m")."/01', INTERVAL 1 MONTH), INTERVAL 1 DAY)")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($ayliktoplamfaturacek2 as $buayliktoplamfatura2)
				{
				$buayliktoplamfatura2['toplambuaykapanmis'];
				}
				
				$oncekiayliktoplamfaturacek2=$connection->query("select SUM(ucret) AS toplamgecenaykapanmis from faturalar where durum=1 AND olusturulmaTarihi BETWEEN DATE_SUB('".date("Y")."/".date("m")."/01', INTERVAL 1 MONTH) AND DATE_SUB('".date("Y")."/".date("m")."/01', INTERVAL 1 DAY) ")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($oncekiayliktoplamfaturacek2 as $gecenayliktoplamfatura2)
				{
				$gecenayliktoplamfatura2['toplamgecenaykapanmis'];
				}
				
				$gunluktoplamfaturacek2=$connection->query("select SUM(ucret) AS toplambugunkapanmis from faturalar where durum=1 AND olusturulmaTarihi='".date("Y-m-d")."' ")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($gunluktoplamfaturacek2 as $bugunluktoplamfatura2)
				{
				$bugunluktoplamfatura2['toplambugunkapanmis'];
				}
				?>
				<?php if($buayliktoplamfatura2['toplambuaykapanmis']==0)
				{
				$performans2=0;
				}
				else
				{
				$performans2=number_format((($buayliktoplamfatura2['toplambuaykapanmis']-$gecenayliktoplamfatura2['toplamgecenaykapanmis'])*100/$buayliktoplamfatura2['toplambuaykapanmis']),2);
				}
				?>
              <div class="progress">
                <div class="progress-bar" style="width:100%"></div>
              </div>
					<span class="progress-description">Bu gün toplamı: <?=number_format($bugunluktoplamfatura2['toplambugunkapanmis'],2);?> TL</span>
					<span class="progress-description">Bu ay toplamı: <?=number_format($buayliktoplamfatura2['toplambuaykapanmis'],2);?> TL</span>
					<span class="progress-description">Geçen ay toplamı: <?=number_format($gecenayliktoplamfatura2['toplamgecenaykapanmis'],2);?> TL</span>
					<span class="progress-description">Geçen aya göre %<?=$performans2;?></span>
                  
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
		<div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-try"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Bu Yıl İşlenen Kayıtların Toplamı</span>
              <span class="info-box-number">
				<?php
				$toplamfaturacek4=$connection->query("select SUM(ucret) AS toplamislenen from faturalar")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($toplamfaturacek4 as $toplamfatura4)
				{
				$toplamfatura4['toplamislenen'];
				}
				?>
				<?=number_format($toplamfatura4['toplamislenen'],2);?> TL
			  </span>
			  
			  
				<?php	
				$yilliktoplamfaturacek4=$connection->query("select SUM(ucret) AS toplambuyilacik from faturalar where durum=0 AND olusturulmaTarihi BETWEEN '".date("Y")."/01/01' AND DATE_ADD('".date("Y")."/01/01', INTERVAL 1 YEAR) ")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($yilliktoplamfaturacek4 as $buyilliktoplamfatura4)
				{
				$buyilliktoplamfatura4['toplambuyilacik'];
				}
				$oncekiyilliktoplamfaturacek4=$connection->query("select SUM(ucret) AS toplamgecenyilacik from faturalar where durum=0 AND olusturulmaTarihi BETWEEN DATE_SUB('".date("Y")."/01/01', INTERVAL 1 YEAR) AND '".date("Y")."/01/01' ")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($oncekiyilliktoplamfaturacek4 as $gecenyilliktoplamfatura4)
				{
				$gecenyilliktoplamfatura4['toplamgecenyilacik'];
				}
				$yilliktoplamfaturacek5=$connection->query("select SUM(ucret) AS toplambuyilkapanmis from faturalar where durum=1 AND olusturulmaTarihi BETWEEN '".date("Y")."/01/01' AND DATE_ADD('".date("Y")."/01/01', INTERVAL 1 YEAR) ")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($yilliktoplamfaturacek5 as $buyilliktoplamfatura5)
				{
				$buyilliktoplamfatura5['toplambuyilkapanmis'];
				}
				$oncekiyilliktoplamfaturacek5=$connection->query("select SUM(ucret) AS toplamgecenyilkapanmis from faturalar where durum=1 AND olusturulmaTarihi BETWEEN DATE_SUB('".date("Y")."/01/01', INTERVAL 1 YEAR) AND '".date("Y")."/01/01' ")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($oncekiyilliktoplamfaturacek5 as $gecenyilliktoplamfatura5)
				{
				$gecenyilliktoplamfatura5['toplamgecenyilkapanmis'];
				}
				$yilliktoplamfaturacek6=$connection->query("select SUM(ucret) AS toplambuyildepoda from faturalar where durum=2 AND olusturulmaTarihi BETWEEN '".date("Y")."/01/01' AND DATE_ADD('".date("Y")."/01/01', INTERVAL 1 YEAR) ")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($yilliktoplamfaturacek6 as $buyilliktoplamfatura6)
				{
				$buyilliktoplamfatura6['toplambuyildepoda'];
				}
				$oncekiyilliktoplamfaturacek6=$connection->query("select SUM(ucret) AS toplamgecenyildepoda from faturalar where durum=2 AND olusturulmaTarihi BETWEEN DATE_SUB('".date("Y")."/01/01', INTERVAL 1 YEAR) AND '".date("Y")."/01/01' ")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($oncekiyilliktoplamfaturacek6 as $gecenyilliktoplamfatura6)
				{
				$gecenyilliktoplamfatura6['toplamgecenyildepoda'];
				}
				?>
			
              <div class="progress">
                <div class="progress-bar" style="width:100%"></div>
              </div>
					<span class="progress-description">Alınmadı; Bu yıl:<?=number_format($buyilliktoplamfatura4['toplambuyilacik'],2);?> | Geçen Yıl: <?=number_format($gecenyilliktoplamfatura4['toplamgecenyilacik'],2);?></span>
					<span class="progress-description">Alındı; Bu yıl:<?=number_format($buyilliktoplamfatura5['toplambuyilkapanmis'],2);?> | Geçen Yıl: <?=number_format($gecenyilliktoplamfatura5['toplamgecenyilkapanmis'],2);?></span>
					<span class="progress-description">Depoda; Bu yıl:<?=number_format($buyilliktoplamfatura6['toplambuyildepoda'],2);?> | Geçen Yıl: <?=number_format($gecenyilliktoplamfatura6['toplamgecenyildepoda'],2);?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      
	  </div>
	  
	  
	  <h2>
        Kasa Defteri CI
      </h2>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
			  <?php
				$toplamkasacekci=$connection->query("select SUM(ucret) AS toplambugunkasadefterici from kasa_defteri where gelirgider='gelir' AND gelis='CI' AND olusturulmaTarihi='".date("Y-m-d")."'")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($toplamkasacekci as $toplamkasaci)
				{
				$toplamkasaci['toplambugunkasadefterici'];
				}
				?>
				<?=number_format($toplamkasaci['toplambugunkasadefterici'],2);?> TL
			  
			  <sup style="font-size: 20px"></sup></h3>
              <p>Kasa Defterindeki Günlük Alınan CI</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-cart"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>
			  <?php
				$toplamkasacekci2=$connection->query("select SUM(ucret) AS toplambuaykasadefterici from kasa_defteri where gelirgider='gelir' AND gelis='CI' AND olusturulmaTarihi BETWEEN '".date("Y")."/".date("m")."/01' AND DATE_SUB(DATE_ADD('".date("Y")."/".date("m")."/01', INTERVAL 1 MONTH), INTERVAL 1 DAY) ")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($toplamkasacekci2 as $toplamkasaci2)
				{
				$toplamkasaci2['toplambuaykasadefterici'];
				}
			  ?>
			  <?=number_format($toplamkasaci2['toplambuaykasadefterici'],2);?> TL
			  <sup style="font-size: 20px"></sup></h3>

              <p>Kasa Defterinde Bu Ay Alınan CI</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>
			  <?php
			  $toplamkasacekci3=$connection->query("select SUM(ucret) AS toplambuyilkasadefterici from kasa_defteri where gelirgider='gelir' AND gelis='CI' AND olusturulmaTarihi BETWEEN '".date("Y")."/01/01' AND DATE_SUB(DATE_ADD('".date("Y")."/01/01', INTERVAL 1 YEAR), INTERVAL 1 DAY) ")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($toplamkasacekci3 as $toplamkasaci3)
				{
				$toplamkasaci3['toplambuyilkasadefterici'];
				}
			  ?>
			  <?=number_format($toplamkasaci3['toplambuyilkasadefterici'],2);?> TL
			  <sup style="font-size: 20px"></sup></h3>

              <p>Kasa Defterinde Bu Yıl Alınan CI</p>
            </div>
            <div class="icon">
              <i class="fa fa-try"></i>
            </div>
           
          </div>
        </div>
		<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>
			  <?php
			  $toplamkasacekci4=$connection->query("select SUM(ucret) AS toplamkasadefterici from kasa_defteri where gelirgider='gelir' AND gelis='CI'")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($toplamkasacekci4 as $toplamkasaci4)
				{
				$toplamkasaci4['toplamkasadefterici'];
				}
			  ?>
			  <?=number_format($toplamkasaci4['toplamkasadefterici'],2);?> TL
			  <sup style="font-size: 20px"></sup></h3>

              <p>Kasa Defterinde Toplam Alınan CI</p>
            </div>
            <div class="icon">
              <i class="fa fa-try"></i>
            </div>
           
          </div>
        </div>
        <!-- ./col -->
      </div>
	  
	  <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
			  <?php
				$toplamkasacekverilenci=$connection->query("select SUM(ucret) AS toplambugunkasadefteriverilenci from kasa_defteri where gelirgider='gider' AND gelis='CI' AND olusturulmaTarihi='".date("Y-m-d")."'")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($toplamkasacekverilenci as $toplamkasaverilenci)
				{
				$toplamkasaverilenci['toplambugunkasadefteriverilenci'];
				}
				?>
				<?=number_format($toplamkasaverilenci['toplambugunkasadefteriverilenci'],2);?> TL
			  
			  <sup style="font-size: 20px"></sup></h3>
              <p>Kasa Defterindeki Günlük Verilen CI</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-cart"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>
			  <?php
				$toplamkasacekverilenci2=$connection->query("select SUM(ucret) AS toplambuaykasadefteriverilenci from kasa_defteri where gelirgider='gider' AND olusturulmaTarihi BETWEEN '".date("Y")."/".date("m")."/01' AND DATE_SUB(DATE_ADD('".date("Y")."/".date("m")."/01', INTERVAL 1 MONTH), INTERVAL 1 DAY) ")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($toplamkasacekverilenci2 as $toplamkasaverilenci2)
				{
				$toplamkasaverilenci2['toplambuaykasadefteriverilenci'];
				}
			  ?>
			  <?=number_format($toplamkasaverilenci2['toplambuaykasadefteriverilenci'],2);?> TL
			  <sup style="font-size: 20px"></sup></h3>

              <p>Kasa Defterinde Bu Ay Verilen CI</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>
			  <?php
			  $toplamkasacekverilenci3=$connection->query("select SUM(ucret) AS toplambuyilkasadefteriverilenci from kasa_defteri where gelirgider='gider' AND olusturulmaTarihi BETWEEN '".date("Y")."/01/01' AND DATE_SUB(DATE_ADD('".date("Y")."/01/01', INTERVAL 1 YEAR), INTERVAL 1 DAY) ")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($toplamkasacekverilenci3 as $toplamkasaverilenci3)
				{
				$toplamkasaverilenci3['toplambuyilkasadefteriverilenci'];
				}
			  ?>
			  <?=number_format($toplamkasaverilenci3['toplambuyilkasadefteriverilenci'],2);?> TL
			  <sup style="font-size: 20px"></sup></h3>

              <p>Kasa Defterinde Bu Yıl Verilen CI </p>
            </div>
            <div class="icon">
              <i class="fa fa-try"></i>
            </div>
           
          </div>
        </div>
		<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>
			  <?php
			  $toplamkasacekverilenci4=$connection->query("select SUM(ucret) AS toplamkasadefteriverilenci from kasa_defteri where gelirgider='gider' AND gelis='CI' ")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($toplamkasacekverilenci4 as $toplamkasaverilenci4)
				{
				$toplamkasaverilenci4['toplamkasadefteriverilenci'];
				}
			  ?>
			  <?=number_format($toplamkasaverilenci4['toplamkasadefteriverilenci'],2);?> TL
			  <sup style="font-size: 20px"></sup></h3>

              <p>Kasa Defterinde Toplam Verilen CI </p>
            </div>
            <div class="icon">
              <i class="fa fa-try"></i>
            </div>
           
          </div>
        </div>
        <!-- ./col -->
      </div>
	  
	 
	  <h2>
        Kasa Defteri PS
      </h2>
      <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
			  <?php
				$toplamkasacekps=$connection->query("select SUM(ucret) AS toplambugunkasadefterips from kasa_defteri where gelirgider='gelir' AND gelis='PS' AND olusturulmaTarihi='".date("Y-m-d")."'")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($toplamkasacekps as $toplamkasaps)
				{
				$toplamkasaps['toplambugunkasadefterips'];
				}
				?>
				<?=number_format($toplamkasaps['toplambugunkasadefterips'],2);?> TL
			  
			  <sup style="font-size: 20px"></sup></h3>
              <p>Kasa Defterindeki Günlük Alınan PS</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-cart"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>
			  <?php
				$toplamkasacekps2=$connection->query("select SUM(ucret) AS toplambuaykasadefterips from kasa_defteri where gelirgider='gelir' AND gelis='PS' AND olusturulmaTarihi BETWEEN '".date("Y")."/".date("m")."/01' AND DATE_SUB(DATE_ADD('".date("Y")."/".date("m")."/01', INTERVAL 1 MONTH), INTERVAL 1 DAY) ")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($toplamkasacekps2 as $toplamkasaps2)
				{
				$toplamkasaps2['toplambuaykasadefterips'];
				}
			  ?>
			  <?=number_format($toplamkasaps2['toplambuaykasadefterips'],2);?> TL
			  <sup style="font-size: 20px"></sup></h3>

              <p>Kasa Defterinde Bu Ay Alınan PS</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>
			  <?php
			  $toplamkasacekps3=$connection->query("select SUM(ucret) AS toplambuyilkasadefterips from kasa_defteri where gelirgider='gelir' AND gelis='PS' AND olusturulmaTarihi BETWEEN '".date("Y")."/01/01' AND DATE_SUB(DATE_ADD('".date("Y")."/01/01', INTERVAL 1 YEAR), INTERVAL 1 DAY) ")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($toplamkasacekps3 as $toplamkasaps3)
				{
				$toplamkasaps3['toplambuyilkasadefterips'];
				}
			  ?>
			  <?=number_format($toplamkasaps3['toplambuyilkasadefterips'],2);?> TL
			  <sup style="font-size: 20px"></sup></h3>

              <p>Kasa Defterinde Bu Yıl Alınan PS</p>
            </div>
            <div class="icon">
              <i class="fa fa-try"></i>
            </div>
           
          </div>
        </div>
		<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>
			  <?php
			  $toplamkasacekps4=$connection->query("select SUM(ucret) AS toplambuyilkasadefterips from kasa_defteri where gelirgider='gelir' AND gelis='PS' ")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($toplamkasacekps4 as $toplamkasaps4)
				{
				$toplamkasaps4['toplambuyilkasadefterips'];
				}
			  ?>
			  <?=number_format($toplamkasaps4['toplambuyilkasadefterips'],2);?> TL
			  <sup style="font-size: 20px"></sup></h3>

              <p>Kasa Defterinde Toplam Alınan PS</p>
            </div>
            <div class="icon">
              <i class="fa fa-try"></i>
            </div>
           
          </div>
        </div>
        <!-- ./col -->
    </div>
	<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
			  <?php
				$toplamkasacekverilenps=$connection->query("select SUM(ucret) AS toplambugunkasadefteriverilenps from kasa_defteri where gelirgider='gider' AND gelis='PS' AND olusturulmaTarihi='".date("Y-m-d")."'")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($toplamkasacekverilenps as $toplamkasaverilenps)
				{
				$toplamkasaverilenps['toplambugunkasadefteriverilenps'];
				}
				?>
				<?=number_format($toplamkasaverilenps['toplambugunkasadefteriverilenps'],2);?> TL
			  
			  <sup style="font-size: 20px"></sup></h3>
              <p>Kasa Defterindeki Günlük Verilen PS</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-cart"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>
			  <?php
				$toplamkasacekverilenps2=$connection->query("select SUM(ucret) AS toplambuaykasadefteriverilenps from kasa_defteri where gelirgider='gider' AND gelis='PS' AND olusturulmaTarihi BETWEEN '".date("Y")."/".date("m")."/01' AND DATE_SUB(DATE_ADD('".date("Y")."/".date("m")."/01', INTERVAL 1 MONTH), INTERVAL 1 DAY) ")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($toplamkasacekverilenps2 as $toplamkasaverilenps2)
				{
				$toplamkasaverilenps2['toplambuaykasadefteriverilenps'];
				}
			  ?>
			  <?=number_format($toplamkasaverilenps2['toplambuaykasadefteriverilenps'],2);?> TL
			  <sup style="font-size: 20px"></sup></h3>

              <p>Kasa Defterinde Bu Ay Verilen PS</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>
			  <?php
			  $toplamkasacekverilenps3=$connection->query("select SUM(ucret) AS toplambuyilkasadefteriverilenps from kasa_defteri where gelirgider='gider' AND gelis='PS' AND olusturulmaTarihi BETWEEN '".date("Y")."/01/01' AND DATE_SUB(DATE_ADD('".date("Y")."/01/01', INTERVAL 1 YEAR), INTERVAL 1 DAY) ")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($toplamkasacekverilenps3 as $toplamkasaverilenps3)
				{
				$toplamkasaverilenps3['toplambuyilkasadefteriverilenps'];
				}
			  ?>
			  <?=number_format($toplamkasaverilenps3['toplambuyilkasadefteriverilenps'],2);?> TL
			  <sup style="font-size: 20px"></sup></h3>

              <p>Kasa Defterinde Bu Yıl Verilen PS</p>
            </div>
            <div class="icon">
              <i class="fa fa-try"></i>
            </div>
           
          </div>
        </div>
		<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>
			  <?php
			  $toplamkasacekverilenps4=$connection->query("select SUM(ucret) AS toplamkasadefteriverilenps from kasa_defteri where gelirgider='gelir' AND gelis='PS' ")->fetchAll(PDO::FETCH_ASSOC);
				foreach ($toplamkasacekverilenps4 as $toplamkasaverilenps4)
				{
				$toplamkasaverilenps4['toplamkasadefteriverilenps'];
				}
			  ?>
			  <?=number_format($toplamkasaverilenps4['toplamkasadefteriverilenps'],2);?> TL
			  <sup style="font-size: 20px"></sup></h3>

              <p>Kasa Defterinde Toplam Verilen PS</p>
            </div>
            <div class="icon">
              <i class="fa fa-try"></i>
            </div>
           
          </div>
        </div>
        <!-- ./col -->
      </div>
	  
	  
      <!-- /.row -->
    </section>
   <!-- /.content -->  
  <!-- /.content-wrapper -->
  </div>

<?php } ?>

  
  <!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
  <!-- PAGE CONTENT END -->
 <?php include("footer.php") ?>
 
 <!-- Giriş KONTROL -->         
<?php	} ?>