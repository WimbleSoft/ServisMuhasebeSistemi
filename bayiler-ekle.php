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


$bayiAdi=$_POST['bayiAdi'];
$il=$_POST['il'];
$ilce=$_POST['ilce'];
$telefon=$_POST['telefon'];
$ayarguncelle=$connection->query("insert into bayiler  (bayiAdi,il,ilce,telefon) values ('$bayiAdi','$il','$ilce','$telefon')") or die ("bir hata olustu...");


if($ayarguncelle){
	$durum="<h2>İşlem Başarılı</h2>";
}else{
	$durum="<h2>Hiç veri girmediniz..</h2>";
	}
echo"$durum";
		
		echo" <meta http-equiv=\"refresh\" content=\"0;url=bayiler.php\"> ";

?>

</section>
<!-- GİRİŞ KONTROL -->          
<?php include("footer.php"); ?>
<?php	} ?>