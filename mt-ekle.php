﻿<?php
session_start(); 
if(!isset($_SESSION["login"])){
?>
<meta http-equiv="refresh" content="0;URL=giris.php">
<?php
} else
{
?>
<!-- GİRİŞ KONTROL -->
<?php include("header.php") ?>
<?php include("kontrol/veritabani.php") ?>


<section id="content">
<?php

$isEmriNo=$_POST['isEmriNo'];
$mAd=$_POST['mAd'];
$mSoyad=$_POST['mSoyad'];
$kullanici=$_POST['kullanici'];
$bayiNo=$_POST['bayiNo'];
$imei=$_POST['imei'];
$ariza=$_POST['ariza'];
$tarih=$_POST['tarih'];
$model=$_POST['model'];


$ayarguncelle=$connection->query("insert into mt (isEmriNo,mAd,mSoyad,bayiNo,imei,kullanici,ariza,model,tarih) values ('$isEmriNo','$mAd','$mSoyad','$bayiNo','$imei','$kullanici','$ariza','$model','$tarih')") or die ("bir hata olustu...");


if($ayarguncelle){
	$durum2="<h2>İşlem Başarılı</h2>";
}else{
	$durum2="<h2>Hiç veri giremediniz..</h2>";
	}
echo"$durum2";
echo" <meta http-equiv=\"refresh\" content=\"0;url=mt.php\"> ";

?>

</section>
<!-- GİRİŞ KONTROL -->          
<?php include("footer.php"); ?>
<?php	} ?>