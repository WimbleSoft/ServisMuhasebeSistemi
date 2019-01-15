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
$getirenAdi=$_POST['getirenAdi'];
$telefon=$_POST['telefon'];
$ayarguncelle=$connection->query("UPDATE getirenler set getirenAdi='$getirenAdi',telefon='$telefon' where id='$id'") or die ("Bir Hata Oluştu");

echo" <meta http-equiv=\"refresh\" content=\"0;url=getirenler.php\"> ";
?>

</section>

<!-- GİRİŞ KONTROL -->          
<?php include("footer.php"); ?>
<?php	} ?>