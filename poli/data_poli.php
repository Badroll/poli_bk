<?php include_once('../_header.php');?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header"> 
          <a href="tambah_poli.php" class="btn btn-primary" role="button" title="Tambah Data"><i class="glyphicon glyphicon-plus"></i> Tambah</a> 
          </div>
          <br>
            <div class="box-body table-responsive">
              <table id="poli" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>NAMA POLI</th>
                  <th>KETERANGAN</th>
                  <th>AKSI</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $no=0;
                $query=mysqli_query($con,"SELECT * FROM poli ORDER BY id DESC");
                //echo $query;
                while ($row=mysqli_fetch_array($query))
                {
                ?>
                <tr>
                  <td><?php echo $no=$no+1;?></td>
                  <td><?php echo $row['nama_poli'];?></td>
                  <td><?php echo $row['keterangan'];?></td>
                  <td>
                    <a href="ubah_poli.php?id=<?=$row['id'];?>" class="btn btn-warning m-1" role="button" title="Ubah Data"><i class="glyphicon glyphicon-edit">Edit</i></a>
                    <a href="hapus_poli.php?id=<?=$row['id'];?>" class="btn btn-danger" role="button" title="Hapus Data"><i class="glyphicon glyphicon-trash">Hapus</i></a>
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
    $('#poli').DataTable();
  });
</script> -->