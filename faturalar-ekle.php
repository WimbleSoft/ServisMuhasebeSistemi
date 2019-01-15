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
$mAd=$_POST['mAd'];
$mSoyad=$_POST['mSoyad'];
$ucret=$_POST['ucret'];
$aciklama=$_POST['aciklama'];
$durum=$_POST['durum'];
$gelis=$_POST['gelis'];
$imei=$_POST['imei'];
$aciklama=$_POST['aciklama'];
$faturaAcan=$_POST['faturaAcan'];
$olusturulmaTarihi=$_POST['olusturulmaTarihi'];
$odeme=$_POST['odeme'];
$model=$_POST['model'];
$parcalar=$_POST['parcalar'];
$telefon=$_POST['telefon'];
$gspn_tarih=$_POST['gspn_tarih'];
$adres=$_POST['adres'];


	$ayarguncelle2=$connection->query("select * from faturalar where isEmriNo='$isEmriNo'")->fetchAll(PDO::FETCH_ASSOC); 
	if(!$ayarguncelle2)
	{
	$ayarguncelle=$connection->query("insert into faturalar  (isEmriNo,telefon,gspn_tarih,mAd,mSoyad,durum,ucret,odeme,imei,gelis,aciklama,faturaAcan,faturaKapatan,faturaDuzenleyen,olusturulmaTarihi,duzenlemeTarihi,model,parcalar,adres) values ('$isEmriNo','$telefon','$gspn_tarih','$mAd','$mSoyad','$durum','$ucret','$odeme','$imei','$gelis','$aciklama','$faturaAcan','0','$faturaAcan','$olusturulmaTarihi','$olusturulmaTarihi','$model','$parcalar','$adres')") or die ("bir hata olustu...");
	echo" <meta http-equiv=\"refresh\" content=\"0;url=faturalar.php?faturaeklendi=1\"> ";
	}
	else
	{
	echo" <meta http-equiv=\"refresh\" content=\"0;url=faturalar.php?isemrizatenmevcut=1\"> ";
	}


if($ayarguncelle){
	$durum2="<h2>İşlem Başarılı</h2>";
}else{
	$durum2="<h2>Hiç veri giremediniz..</h2>";
	}
echo"$durum2";

?>

</section>
<!-- GİRİŞ KONTROL -->          
<?php include("footer.php"); ?>
<?php	} ?>