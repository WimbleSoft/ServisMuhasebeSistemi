<?php
session_start(); 
if(!isset($_SESSION["login"])){
?>
<meta http-equiv="refresh" content="0;URL=faturalar.php">
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
$isEmriNo=$_POST['isEmriNo'];
$imei=$_POST['imei'];
$gelis=$_POST['gelis'];
$mAd=$_POST['mAd'];
$mSoyad=$_POST['mSoyad'];
$ucret=$_POST['ucret'];
$aciklama=$_POST['aciklama'];
$faturaDuzenleyen=$_POST['faturaDuzenleyen'];
$duzenlemeTarihi=$_POST['duzenlemeTarihi'];
$odeme=$_POST['odeme'];
$model=$_POST['model'];
$telefon=$_POST['telefon'];
$parcalar=$_POST['parcalar'];
$gspn_tarih=$_POST['gspn_tarih'];
$adres=$_POST['adres'];

$ayarguncelle=$connection->query("UPDATE faturalar set isEmriNo='$isEmriNo',imei='$imei',gspn_tarih='$gspn_tarih',telefon='$telefon',gelis='$gelis',model='$model',parcalar='$parcalar',adres='$adres',mAd='$mAd',mSoyad='$mSoyad',ucret='$ucret',odeme='$odeme',aciklama='$aciklama',faturaDuzenleyen='$faturaDuzenleyen',duzenlemeTarihi='$duzenlemeTarihi' where id='$id'") or die ("Bir Hata Oluştu");

if($ayarguncelle){
	$durum="<h2>İşlem Başarılı</h2>";
}else{
	$durum="<h2>Bir hata oluştu</h2>";
	}
echo"$durum";
echo" <meta http-equiv=\"refresh\" content=\"0;url=faturalar.php?faturaduzenlendi=1\"> ";
?>
</section>
<!-- GİRİŞ KONTROL -->          
<?php include("footer.php"); ?>
<?php	} ?>