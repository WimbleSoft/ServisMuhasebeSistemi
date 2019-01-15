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


$getirenAdi=$_POST['getirenAdi'];
$telefon=$_POST['telefon'];
$ayarguncelle=$connection->query("insert into getirenler  (getirenAdi,telefon) values ('$getirenAdi','$telefon')") or die ("bir hata olustu...");


if($ayarguncelle){
	$durum="<h2>İşlem Başarılı</h2>";
}else{
	$durum="<h2>Hiç veri girmediniz..</h2>";
	}
echo"$durum";
		
		echo" <meta http-equiv=\"refresh\" content=\"0;url=getirenler.php\"> ";

?>

</section>
<!-- GİRİŞ KONTROL -->          
<?php include("footer.php"); ?>
<?php	} ?>