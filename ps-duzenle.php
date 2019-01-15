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
$id=$_POST['id'];
$kullanici=$_POST['kullanici'];
$isEmriNo=$_POST['isEmriNo'];
$imei=$_POST['imei'];
$mAd=$_POST['mAd'];
$mSoyad=$_POST['mSoyad'];
$ariza=$_POST['ariza'];
$tarih=$_POST['tarih'];
$model=$_POST['model'];
$bayiNo=$_POST['bayiNo'];
$getiren=$_POST['getiren'];
$gelengiden=$_POST['gelengiden'];

$ayarguncelle=$connection->query("UPDATE ps set isEmriNo='$isEmriNo',imei='$imei',gelengiden='$gelengiden',getiren='$getiren',kullanici='$kullanici',bayiNo='$bayiNo',model='$model',mAd='$mAd',mSoyad='$mSoyad',tarih='$tarih',ariza='$ariza' where id='$id'") or die ("Bir Hata Oluştu");

if($ayarguncelle){
	$durum="<h2>İşlem Başarılı</h2>";
}else{
	$durum="<h2>Bir hata oluştu</h2>";
	}
echo"$durum";
echo" <meta http-equiv=\"refresh\" content=\"0;url=ps.php\"> ";
?>
</section>
<!-- GİRİŞ KONTROL -->          
<?php include("footer.php"); ?>
<?php	} ?>