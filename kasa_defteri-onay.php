<?php
session_start(); 
if((!isset($_SESSION["login"]) || $_SESSION["yetki"]=="0")){
?>
<meta http-equiv="refresh" content="0;URL=kasa_defteri.php">
<?php
} else
{
?>
<!-- GİRİŞ KONTROL -->
<?php include("header.php") ?>
<?php include("kontrol/veritabani.php") ?>

<section id="content">
<?php

$isEmriNo=$_GET['isEmriNo'];
$girenid=$_SESSION['girenid'];

$kasadeftericek=$connection->query("select * from kasa_defteri where isEmriNo='$isEmriNo'")->fetchAll(PDO::FETCH_ASSOC); 
foreach ($kasadeftericek as $kdcek)
{
$kasadefterigelirgider=$kdcek['gelirgider']; 
}
	
if($kasadefterigelirgider=="Gelir")
{
	$faturalarcek=$connection->query("select * from faturalar where isEmriNo='$isEmriNo'")->fetchAll(PDO::FETCH_ASSOC); 
	if(!$faturalarcek)
	{
		$ayarguncelle3=$connection->query("insert into faturalar  (isEmriNo,imei,mAd,mSoyad,ucret,telefon,odeme,aciklama,olusturulmaTarihi,duzenlemeTarihi,kapatmaTarihi,durum,faturaAcan,faturaKapatan,faturaDuzenleyen,model,gelis) SELECT isEmriNo,imei,mAd,mSoyad,ucret,telefon,odeme,aciklama,olusturulmaTarihi,".date('Y-m-d').",".date('Y-m-d').",'1','$girenid','$girenid','$girenid',model,gelis FROM kasa_defteri WHERE isEmriNo='$isEmriNo'") or die ("bir hata olustu...");
		echo" <meta http-equiv=\"refresh\" content=\"0;url=kasa_defteri.php?kasadanfaturayaeklendi=1\"> ";
	}
	else
	{
		$faturacek=$connection->query("select * from faturalar where isEmriNo='$isEmriNo'")->fetchAll(PDO::FETCH_ASSOC);
		foreach ($faturacek as $fcek)
		{
			if($fcek['durum']=='0' || $fcek['durum']=='2')
			{
			$ayarguncelle2=$connection->query("UPDATE faturalar set durum='1',faturaKapatan='".$_SESSION['girenid']."',kapatmaTarihi='".date("Y-m-d")."' where isEmriNo='$isEmriNo'") or die ("Bir Hata Oluştu");
			echo" <meta http-equiv=\"refresh\" content=\"0;url=kasa_defteri.php?faturakapatildi=1\"> ";
			}
			else
			{
			echo" <meta http-equiv=\"refresh\" content=\"0;url=kasa_defteri.php?kapatilmisfatura=1\"> ";
			}
		}
	}
}

?>
</section>
<!-- GİRİŞ KONTROL -->          
<?php include("footer.php"); ?>
<?php	} ?>
