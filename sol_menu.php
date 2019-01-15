<aside class="main-sidebar">
<section class="sidebar">
  <ul class="sidebar-menu">
	<li id="anasayfa"><a href="index.php"><i class="fa fa-home"></i> <span>Anasayfa</span></a></li>
	<?php if($_SESSION["girenkadi"]=="PS1" || $_SESSION["girenkadi"]=="PS2" || $_SESSION["girenkadi"]=="PS3" || $_SESSION["girenkadi"]=="MT1" || $_SESSION["girenkadi"]=="MT2" || $_SESSION["girenkadi"]=="MT3") 
	{ }
	else {
	?>
	<li id="faturalar"><a href="faturalar.php"><i class="fa fa-laptop"></i> <span>Kayıtlar</span></a></li>
	<?php } ?>
	<?php
	if($_SESSION["yetki"]=="0")
	{
	
	}
	else
	{
	?>
	<li id="personel"><a href="personel.php"><i class="fa fa-user"></i> <span>Personel</span></a></li>
	<li id="bayiler"><a href="bayiler.php"><i class="fa fa-map-marker"></i> <span>Bayiler</span></a></li>
	<li id="getirenler"><a href="getirenler.php"><i class="fa fa-truck"></i> <span>Getirenler</span></a></li>
	
	<?php } ?>
	<li id="kasa_defteri"><a href="kasa_defteri.php"><i class="fa fa-book"></i> <span>Kasa Defteri</span></a></li>
	<?php 
	if($_SESSION["girenkadi"]=="MT1" || $_SESSION["girenkadi"]=="MT2" || $_SESSION["girenkadi"]=="MT3" || $_SESSION["yetki"]=="1") 
	{
	?>
	<li id="MT"><a href="mt.php"><i class="fa fa-pencil"></i> <span>MT</span></a></li>
	<?php } ?>
	<?php 
	if($_SESSION["girenkadi"]=="PS1" || $_SESSION["girenkadi"]=="PS2" || $_SESSION["girenkadi"]=="PS3" || $_SESSION["yetki"]=="1") 
	{
	?>
	<li id="PS"><a href="ps.php"><i class="fa fa-pencil"></i> <span>PS</span></a></li>
	<?php } ?>
  </ul>
</section>
</aside>