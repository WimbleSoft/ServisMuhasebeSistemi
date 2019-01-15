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

<?php include("kontrol/veritabani.php") ?>
<section id="content">
<?php
$id=$_GET['id'];
$delete = $connection->query("DELETE from faturalar WHERE id=".$id) or die("HATA!");

if($delete){
$durum="<h2>Kayıt Silinmiştir</h2>";
}else{
$durum="<h2>Kayıt Silinememiştir<h2>";
}
echo"$durum";
echo" <meta http-equiv=\"refresh\" content=\"0;url=faturalar.php?faturasilindi=1\"> ";
?>
</section> </div>
<!-- GİRİŞ KONTROL -->          
<?php	} ?>