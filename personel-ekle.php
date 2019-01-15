<?php
session_start(); 
if((!isset($_SESSION["login"]))||($_SESSION["yetki"]=="0")){
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

$adsoyad=$_POST['adsoyad'];
$sifre=md5($_POST['sifre']);
$eposta=$_POST['eposta'];
$telefon=$_POST['telefon'];
$kadi=$_POST['kadi'];
if(isset($_POST['yetki'])) { 
    $yetki=1;
} else { 
    $yetki=0;
}
$ayarguncelle=$connection->query("insert into personel  (kadi,sifre,eposta,telefon,adsoyad,yetki) values ('$kadi','$sifre','$eposta','$telefon','$adsoyad','$yetki')") or die ("bir hata olustu...");


if($ayarguncelle){
	$durum="<h2>İşlem Başarılı</h2>";
}else{
	$durum="<h2>Hiç veri girmediniz..</h2>";
	}
echo"$durum";
		
		echo" <meta http-equiv=\"refresh\" content=\"0;url=personel.php\"> ";

?>

</section>
<!-- GİRİŞ KONTROL -->          
<?php include("footer.php"); ?>
<?php	} ?>