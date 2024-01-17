<?php
include_once('../_header.php');
$sql="SELECT * FROM pasien WHERE id='".$_GET['id']."'";
//echo $sql;
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_array($query);
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      UBAH DATA pasien
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li class="active">UBAH pasien</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="ubah_pasien_proses.php">
              <div class="box-body">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <div class="form-group">
                  <label>Nama </label>
                  <input type="text" name="nama" class="form-control"  value="<?php echo $row['nama']; ?>" required>
                </div>
                <div class="form-group">
                  <label>alamat</label>
                  <input type="text" name="alamat" class="form-control" value="<?php echo $row['alamat']; ?>" required>
                </div>
                <div class="form-group">
                  <label>NO KTP</label>
                  <input type="text" name="no_ktp" class="form-control" value="<?php echo $row['no_ktp']; ?>" required>
                </div>		
                <div class="form-group">
                  <label>NO HP</label>
                  <input type="text" name="no_hp" class="form-control" value="<?php echo $row['no_hp']; ?>" required>
                </div>	
                <div class="form-group">
                  <label>NO RM</label>
                  <input type="text" name="no_rm" class="form-control" value="<?php echo $row['no_rm']; ?>" required>
                </div>			
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary" title="Simpan Data"> <i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
<!-- /.content-wrapper -->