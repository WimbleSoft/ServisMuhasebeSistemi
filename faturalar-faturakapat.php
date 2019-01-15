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

$id=$_GET['id'];

$faturacek=$connection->query("select * from faturalar where id='$id'")->fetchAll(PDO::FETCH_ASSOC);
foreach ($faturacek as $fcek)
{
	if($fcek['durum']=='0' || $fcek['durum']=='2')
	{
	$ayarguncelle=$connection->query("UPDATE faturalar set faturaKapatan='".$_SESSION['girenid']."',kapatmaTarihi='".date("Y-m-d")."' where id='$id'") or die ("Bir Hata Oluştu");
	$ayarguncelle1=$connection->query("UPDATE faturalar set durum='1' where id='$id'") or die ("Bir Hata Oluştu");
	echo" <meta http-equiv=\"refresh\" content=\"0;url=faturalar.php?faturakapatildi=1\"> ";
	}
	else
	{
	echo" <meta http-equiv=\"refresh\" content=\"0;url=faturalar.php?faturakapatildi=0\"> ";
	}
}


if($ayarguncelle){
	$durum="<h2>İşlem Başarılı</h2>";
}else{
	$durum="<h2>Hiç veri girmediniz..</h2>";
	}

echo"$durum";		

?>

</section>
<!-- GİRİŞ KONTROL -->          
<?php include("footer.php"); ?>
<?php	} ?>