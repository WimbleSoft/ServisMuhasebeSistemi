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
$adsoyad=$_POST['adsoyad'];
$sifre=md5($_POST['adsoyad']);
$eposta=$_POST['eposta'];
$kadi=$_POST['kadi'];
$telefon=$_POST['telefon'];

$ayarguncelle=$connection->query("UPDATE personel set adsoyad='$adsoyad',sifre='$sifre',eposta='$eposta',kadi='$kadi',telefon='$telefon' where id='$id'") or die ("Bir Hata Oluştu");


if($ayarguncelle){
	$durum="<h2>İşlem Başarılı</h2>";
}else{
	$durum="<h2>Bir hata oluştu</h2>";
	}
echo"$durum";
echo" <meta http-equiv=\"refresh\" content=\"5;url=ayarlar.php\"> ";
?>

</section>

<!-- GİRİŞ KONTROL -->         
<?php include("footer.php"); ?>
<?php	} ?>