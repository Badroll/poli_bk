<?php include_once('../_header.php');
$sql="SELECT * FROM dokter WHERE id='".$_GET['id_dokter']."'";
//echo $sql;
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_array($query);
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      UBAH DATA DOKTER
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li class="active">UBAH DOKTER</li>
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
            <form role="form" method="post" action="ubah_dokter_proses.php">
              <div class="box-body">
                <input type="hidden" name="id_dokter" value="<?php echo $row['id']; ?>">
                <div class="form-group">
                  <label>Nama dokter</label>
                  <input type="text" name="nama_dokter" class="form-control"  value="<?php echo $row['nama']; ?>" required>
                </div>
                <div class="form-group">
                  <label>NIP</label>
                  <input type="text" name="nip" class="form-control"  value="<?php echo $row['nip']; ?>" required>
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <input type="text" name="alamat" class="form-control" value="<?php echo $row['alamat']; ?>" required>
                </div>
                <div class="form-group">
                  <label>No Hp</label>
                  <input type="text" name="no_hp" class="form-control" value="<?php echo $row['no_hp']; ?>" required>
                </div>
                <div class="form-group">
                  <label for="id_poli">Poli Dokter <span class="text-danger"></span></label>
                  <select class="form-control" name="id_poli" required>
                      <option value="" disabled selected>Pilih Poli Dokter</option>
                      <?php
                          $result = mysqli_query($con, "SELECT * FROM poli");
                          while ($data = mysqli_fetch_assoc($result)) {
                              echo "<option value='" . $data['id'] . "'>" . $data['nama_poli'] . "</option>";
                          }
                      ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="text" name="password_dok" class="form-control" value="<?php echo $row['password_dok']; ?>" required>
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