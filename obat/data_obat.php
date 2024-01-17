<?php include_once('../_header.php');?>
    <!-- Main content -->
    <section class="content-header">
      <h1>
      Data Obat
      </h1>
    </section><br>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
      <div class="box box-primary">
          <div class="box-header"> 
          <a href="tambah_obat.php" class="btn btn-primary" role="button" title="Tambah Data"><i class="glyphicon glyphicon-plus"></i> Tambah</a> 
          </div>
          <br>
            <div class="box-body table-responsive">
              <table id="obat" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>NAMA OBAT</th>
                  <th>KEMASAN</th>
                  <th>HARGA</th>
                  <th>AKSI</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $no=0;
                $query=mysqli_query($con,"SELECT * FROM obat ORDER BY id DESC");
                //echo $query;
                while ($row=mysqli_fetch_array($query))
                {
                ?>
                <tr>
                  <td><?php echo $no=$no+1;?></td>
                  <td><?php echo $row['nama_obat'];?></td>
                  <td><?php echo $row['kemasan'];?></td>
                  <td><?php echo $row['harga'];?></td>
                  <td>
                    <a href="ubah_obat.php?id=<?=$row['id'];?>" class="btn btn-warning m-1" role="button" title="Ubah Data"><i class="glyphicon glyphicon-edit">Edit</i></a>
                    <a href="hapus_obat.php?id=<?=$row['id'];?>" class="btn btn-danger" role="button" title="Hapus Data"><i class="glyphicon glyphicon-trash">Hapus</i></a>
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

<!-- Javascript Datatable
<script type="text/javascript">
  $(document).ready(function(){
    $('#obat').DataTable();
  });
</script> -->