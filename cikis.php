<?php
session_start();
ob_start();
session_destroy();
echo"<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
header("Refresh: 0; url=giris.php");
ob_end_flush();
?>

