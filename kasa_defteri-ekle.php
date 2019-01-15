<?php
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
$imei=$_POST['imei'];
$ucret=$_POST['ucret'];
$aciklama=$_POST['aciklama'];
$olusturulmaTarihi=$_POST['olusturulmaTarihi'];
$mAd=$_POST['mAd'];
$mSoyad=$_POST['mSoyad'];
$telefon=$_POST['telefon'];
$odeme=$_POST['odeme'];
$gelirgider=$_POST['gelirgider'];
$girenid=$_SESSION['girenid'];
$model=$_POST['model'];
$gelis=$_POST['gelis'];

$ayarguncelle=$connection->query("insert into kasa_defteri  (isEmriNo,imei,mAd,mSoyad,ucret,telefon,odeme,aciklama,olusturulmaTarihi,gelirgider,model,gelis) values ('$isEmriNo','$imei','$mAd','$mSoyad','$ucret','$telefon','$odeme','$aciklama','$olusturulmaTarihi','$gelirgider','$model','$gelis')") or die ("bir hata olustu...");

if($ayarguncelle){
	$durum2="<h2>İşlem Başarılı</h2>";
}else{
	$durum2="<h2>Hiç veri giremediniz..</h2>";
	}
echo"$durum2";
echo" <meta http-equiv=\"refresh\" content=\"0;url=kasa_defteri.php?kasayaeklendi=1\"> ";

?>

</section>
<!-- GİRİŞ KONTROL -->          
<?php include("footer.php"); ?>
<?php	} ?>