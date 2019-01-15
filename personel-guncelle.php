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
$id=$_POST['id'];
$adsoyad=$_POST['adsoyad'];
$sifre=md5($_POST['sifre']);
$eposta=$_POST['eposta'];
$kadi=$_POST['kadi'];
$telefon=$_POST['telefon'];
if(isset($_POST['yetki'])) { 
    $yetki=1;
} else { 
    $yetki=0;
}
if($_POST['sifre']=='')
{
$ayarguncelle=$connection->query("UPDATE personel set adsoyad='$adsoyad',eposta='$eposta',kadi='$kadi',yetki='$yetki',telefon='$telefon' where id='$id'") or die ("Bir Hata Oluştu");
}
else
{
$ayarguncelle2=$connection->query("UPDATE personel set adsoyad='$adsoyad',sifre='$sifre',eposta='$eposta',kadi='$kadi',yetki='$yetki',telefon='$telefon' where id='$id'") or die ("Bir Hata Oluştu");
}
echo" <meta http-equiv=\"refresh\" content=\"0;url=personel.php\"> ";
?>

</section>

<!-- GİRİŞ KONTROL -->          
<?php include("footer.php"); ?>
<?php	} ?>