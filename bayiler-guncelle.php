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
$bayiAdi=$_POST['bayiAdi'];
$il=$_POST['il'];
$ilce=$_POST['ilce'];
$telefon=$_POST['telefon'];
$ayarguncelle=$connection->query("UPDATE bayiler set bayiAdi='$bayiAdi',il='$il',ilce='$ilce',telefon='$telefon' where id='$id'") or die ("Bir Hata Oluştu");

echo" <meta http-equiv=\"refresh\" content=\"0;url=bayiler.php\"> ";
?>

</section>

<!-- GİRİŞ KONTROL -->          
<?php include("footer.php"); ?>
<?php	} ?>