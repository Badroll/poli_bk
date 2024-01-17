<?php include_once('../_header.php');?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Data Pasien
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <!-- <a href="tambah_pasien.php" class="btn btn-primary" role="button" title="Tambah Data"><i class="glyphicon glyphicon-plus"></i> Tambah</a> -->
          </div>
          <br>
            <div class="box-body table-responsive">
              <table id="pasien" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>NAMA </th>
                  <th>ALAMAT</th>
                  <th>NO_KTP</th>
                  <th>NO_HP</th>
                  <th>NO_RM</th>
                  <th>AKSI</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $no=0;
                $query=mysqli_query($con,"SELECT * FROM pasien ORDER BY id DESC");
                //echo $query;
                while ($row=mysqli_fetch_array($query))
                {
                ?>
                <tr>
                  <td><?php echo $no=$no+1;?></td>
                  <td><?php echo $row['nama'];?></td>
                  <td><?php echo $row['alamat'];?></td>
                  <td><?php echo $row['no_ktp'];?></td>
                  <td><?php echo $row['no_hp'];?></td>
                  <td><?php echo $row['no_rm'];?></td>
                  <td>
                    <a href="ubah_pasien.php?id=<?=$row['id'];?>" class="btn btn-success" role="button" title="Ubah Data"><i class="glyphicon glyphicon-edit">Edit</i></a>
                    <a href="hapus_pasien.php?id=<?=$row['id'];?>" class="btn btn-danger" role="button" title="Hapus Data"><i class="glyphicon glyphicon-trash">Hapus</i></a>
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

<!-- Javascript Datatable -->
<script type="text/javascript">
  $(document).ready(function(){
    $('#pasien').DataTable();
  });
</script>