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
document.getElementById("getirenler").className = "active";
</script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Getirenler
      </h1>
      <ol class="breadcrumb">
        <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
        <li><a href="#">Getirenler</a></li>
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
					  <h3 class="box-title">Yeni Getiren Ekle</h3>

					  <div class="box-tools">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
						</button>
					  </div>
					  <!-- /.box-tools -->
					</div>
					<!-- /.box-header -->
					
					<div class="box-body">
					
					<!-- form -->
					
					<form role="form" method="post" enctype="multipart/form-data" action="getirenler-ekle.php">
					  <div class="box-body">
						<div class="form-group">
							<div class="col-md-6">
								<input name="getirenAdi" type="text" id="getirenAdi" class="form-control"  placeholder="Getiren Adı Girin">
							</div>
							<div class="col-md-5">
								<input name="telefon" type="text" id="telefon" class="form-control"  placeholder="Telefon Girin">
							</div>
							<div class="col-md-1">
								<button type="submit" class="btn btn-primary">Getireni Ekle</button>
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
					<th>Getiren Adı</th>
					<th>Telefon</th>
					<th>İşlemler</th>
				  </tr>
				</thead>

				<tbody>
					<?php
					$vericek=$connection->query("select * from getirenler")->fetchAll(PDO::FETCH_ASSOC);
					foreach ($vericek as $vcek)
					{
					?>
				  <tr>
					<td><?=$vcek['getirenAdi'];?></td>
					<td><?=$vcek['telefon'];?></td>
					<!-- GELİR DÜZENLEME -->
					<div class="modal fade bs-example-modal-lg" id="myModalId<?=$vcek['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
							<form role="form" method="post" enctype="multipart/form-data" action="getirenler-guncelle.php">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Getiren Düzenle</h4>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<div class="col-md-6">
										<label>Getiren Adı</label>
											<input name="getirenAdi" type="text" id="getirenAdi" class="form-control"  placeholder="Getiren Adını Girin" value="<?=$vcek['getirenAdi'];?>">
											<input name="id" type="text" id="id" hidden="hidden" value="<?=$vcek['id'];?>">
										</div>
										<div class="col-md-6">
										<label>Getiren Telefon</label>
											<input name="telefon" type="text" id="telefon" class="form-control"  placeholder="Getiren Telefonunu Girin" value="<?=$vcek['telefon'];?>">
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
									<button type="submit" class="btn btn-warning">Kaydet</button>
								</div>
							</form>
						</div>
					  </div>
					</div>
					<!-- GELİR DÜZENLEME -->
					
					
					<td>
					  <span class="button-group">
						<button type="button" class="btn btn-warning fa fa-pencil" data-toggle="modal" data-target="#myModalId<?=$vcek['id'];?>"></button>
						<a href="getirenler-sil.php?id=<?=$vcek['id'];?>" onclick="return confirm('İçeriği silmek istediğinize emin misiniz? Bu işlem geri alınamaz!');" class="btn btn-danger fa fa-trash"></a>
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