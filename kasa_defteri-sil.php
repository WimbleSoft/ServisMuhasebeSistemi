<?php
session_start(); 
if((!isset($_SESSION["login"]))||($_SESSION["yetki"]=="0")){
?>
<meta http-equiv="refresh" content="0;URL=kasa_defteri.php?yetki_sil=0">
<?php
} else
{
?>
<!-- GİRİŞ KONTROL -->

<?php include("kontrol/veritabani.php") ?>
<section id="content">
<?php
$id=$_GET['id'];
$isEmriNo=0;
	$vericek=$connection->query("select * from kasa_defteri where id='$id'")->fetchAll(PDO::FETCH_ASSOC);
	foreach ($vericek as $vcek)
	{
	$isEmriNo=$vcek['isEmriNo'];
	}
$delete = $connection->query("DELETE from kasa_defteri WHERE id=".$id) or die("HATA!");

$alinmadi=$connection->query("UPDATE faturalar set durum=0 WHERE isEmriNo='$isEmriNo'") or die ("HATA!");

echo"$durum";
echo" <meta http-equiv=\"refresh\" content=\"0;url=kasa_defteri.php?kasadefterigirdisisilindi=1\"> ";
?>
</section> </div>
<!-- GİRİŞ KONTROL -->          
<?php	} ?>