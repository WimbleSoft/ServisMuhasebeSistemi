<?php
session_start(); 
if((!isset($_SESSION["login"]))||($_SESSION["yetki"]=="0")){
?>
<meta http-equiv="refresh" content="0;URL=giris.php">
<?php
} else
{
?>

<!-- Giriş KONTROL -->
<?php include("header.php") ?>
<?php include("kontrol/veritabani.php") ?>

<!-- PAGE CONTENT -->
<script>
document.getElementById("personel").className = "active";
</script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Personel
      </h1>
      <ol class="breadcrumb">
        <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
        <li><a href="#">Personel</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
            
			 <div class="col-md-12">
          <div class="box box-default collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Yeni Personel Ekle</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
			
			<!-- form -->
			
			<form role="form" method="post" enctype="multipart/form-data" action="personel-ekle.php">
              <div class="box-body">
                <div class="form-group">
					<div class="col-md-2">
						<input name="adsoyad" type="text" id="adsoyad" class="form-control"  placeholder="Ad Soyad Girin">
					</div>
					<div class="col-md-2">
						<input name="telefon" type="text" id="telefon" class="form-control"  placeholder="Telefon Girin">
					</div>
					<div class="col-md-2">
						<input name="eposta" type="text" id="eposta" class="form-control" placeholder="E-posta Girin">
					</div>
					<div class="col-md-1">
						<input name="kadi" type="text" id="kadi" class="form-control" placeholder="Kullanıcı Adı Girin">
					</div>
					<div class="col-md-2">
						<input name="sifre" type="password" id="sifre" class="form-control" placeholder="Şifre Girin">
					</div>
					<div class="col-md-1">
						<div class="checkbox">
						<label>
						  <input id="yetki" name="yetki" type="checkbox">
						  Admin?
						</label>
						</div>
					</div>
                  
					<div class="col-md-1">
						<button type="submit" class="btn btn-primary">Personeli Ekle</button>
					</div>
				</div>
              </div>
              <!-- /.box-body -->

            </form>
			<!-- /.form -->
			
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
		
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
				  <tr>
					<th>Ad Soyad</th>
					<th>Kullanıcı Adı</th>
					<th>E-Posta</th>
					<th>Telefon</th>
					<th>İşlemler</th>
				  </tr>
				</thead>

				<tbody>
					<?php
					$vericek=$connection->query("select * from personel")->fetchAll(PDO::FETCH_ASSOC);
					foreach ($vericek as $vcek)
					{
					?>
				  <tr>
					<td><?=$vcek['adsoyad'];?></td>
					<td><?=$vcek['kadi'];?></td>
					<td><?=$vcek['eposta'];?></td>
					<td><?=$vcek['telefon'];?></td>
					<td>
					  <span class="button-group">
						<a href="personel-duzenle.php?id=<?=$vcek['id'];?>" class="fa fa-pencil"></a>
						<a href="personel-sil.php?id=<?=$vcek['id'];?>" onclick="return confirm('İçeriği silmek istediğinize emin misiniz? Bu işlem geri alınamaz ve bu personele ait ödünç bilgileri de silinecektir!');" class="fa fa-trash"></a>
					  </span>
					</td>
				  </tr>
				  <?php } ?>
				</tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
  <!-- PAGE CONTENT END -->
 <?php include("footer.php") ?>
 
 
 <!-- Giriş KONTROL -->         
<?php	} ?>