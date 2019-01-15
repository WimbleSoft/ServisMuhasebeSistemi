<?php
session_start(); 
if(!isset($_SESSION["login"])){
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
$id=$_POST['id'];
$isEmriNo=$_POST['isEmriNo'];
$aciklama=$_POST['aciklama'];
$mAd=$_POST['mAd'];
$mSoyad=$_POST['mSoyad'];
$telefon=$_POST['telefon'];
$odeme=$_POST['odeme'];
$ucret=$_POST['ucret'];
$imei=$_POST['imei'];
$olusturulmaTarihi=$_POST['olusturulmaTarihi'];
$model=$_POST['model'];
$gelis=$_POST['gelis'];

$ayarguncelle=$connection->query("UPDATE kasa_defteri set isEmriNo='$isEmriNo',imei='$imei',ucret='$ucret',gelis='$gelis',mAd='$mAd',mSoyad='$mSoyad',telefon='$telefon',odeme='$odeme',aciklama='$aciklama',olusturulmaTarihi='$olusturulmaTarihi',model='$model' where id='$id'") or die ("Bir Hata Oluştu");

if($ayarguncelle){
	$durum="<h2>İşlem Başarılı</h2>";
}else{
	$durum="<h2>Bir hata oluştu</h2>";
	}
echo"$durum";
echo" <meta http-equiv=\"refresh\" content=\"0;url=kasa_defteri.php?kasadefterigirdisiduzenlendi=1\"> ";
?>
</section>
<!-- GİRİŞ KONTROL -->          
<?php include("footer.php"); ?>
<?php	} ?>
