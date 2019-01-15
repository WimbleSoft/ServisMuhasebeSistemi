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
document.getElementById("bayiler").className = "active";
</script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Bayiler
      </h1>
      <ol class="breadcrumb">
        <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
        <li><a href="#">Bayiler</a></li>
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
              <h3 class="box-title">Yeni Bayi Ekle</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
			
			<!-- form -->
			
			<form role="form" method="post" enctype="multipart/form-data" action="bayiler-ekle.php">
              <div class="box-body">
                <div class="form-group">
					<div class="col-md-3">
						<input name="bayiAdi" type="text" id="bayiAdi" class="form-control"  placeholder="Bayi Adı Girin">
					</div>
					<div class="col-md-2">
						<input name="telefon" type="text" id="telefon" class="form-control"  placeholder="Telefon Girin">
					</div>
					<div class="col-md-3">
						<input name="il" type="text" id="il" class="form-control" placeholder="İlini Girin">
					</div>
					<div class="col-md-3">
						<input name="ilce" type="text" id="ilce" class="form-control" placeholder="İlçesini Girin">
					</div>
					<div class="col-md-1">
						<button type="submit" class="btn btn-primary">Bayiyi Ekle</button>
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
					<th>Bayi Adı</th>
					<th>Telefon</th>
					<th>İl</th>
					<th>İlçe</th>
					<th>İşlemler</th>
				  </tr>
				</thead>

				<tbody>
					<?php
					$vericek=$connection->query("select * from bayiler")->fetchAll(PDO::FETCH_ASSOC);
					foreach ($vericek as $vcek)
					{
					?>
				  <tr>
					<td><?=$vcek['bayiAdi'];?></td>
					<td><?=$vcek['telefon'];?></td>
					<td><?=$vcek['il'];?></td>
					<td><?=$vcek['ilce'];?></td>
					
					<!-- GELİR DÜZENLEME -->
					<div class="modal fade bs-example-modal-lg" id="myModalId<?=$vcek['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
							<form role="form" method="post" enctype="multipart/form-data" action="bayiler-guncelle.php">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Bayi Düzenle</h4>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<div class="col-md-6">
										<label>Bayi Adı</label>
											<input name="bayiAdi" type="text" id="bayiAdi" class="form-control"  placeholder="Bayi Adını Girin" value="<?=$vcek['bayiAdi'];?>">
											<input name="id" type="text" id="id" hidden="hidden" value="<?=$vcek['id'];?>">
										</div>
										<div class="col-md-6">
										<label>Bayi Telefon</label>
											<input name="telefon" type="text" id="telefon" class="form-control"  placeholder="Bayi Telefonunu Girin" value="<?=$vcek['telefon'];?>">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-6">
										<label>Bayi İli</label>
											<input name="il" type="text" id="il" class="form-control"  placeholder="Bayi İlini Girin" value="<?=$vcek['il'];?>">
										</div>
										<div class="col-md-6">
										<label>Bayi İlçesi</label>
											<input name="ilce" type="text" id="ilce" class="form-control"  placeholder="Bayi İlçesini Girin" value="<?=$vcek['ilce'];?>">
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
										<button type="submit" class="btn btn-warning">Kaydet</button>
									</div>
								</div>
							</form>
						</div>
					  </div>
					</div>
					<!-- GELİR DÜZENLEME -->
					
					
					<td>
					  <span class="button-group">
						<button type="button" class="btn btn-warning fa fa-pencil" data-toggle="modal" data-target="#myModalId<?=$vcek['id'];?>"></button>
						<a href="bayiler-sil.php?id=<?=$vcek['id'];?>" onclick="return confirm('İçeriği silmek istediğinize emin misiniz? Bu işlem geri alınamaz!');"  class="btn btn-danger fa fa-trash"></a>
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