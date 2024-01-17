<?php include_once('../_header.php');?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <a href="tambah_dokter.php" class="btn btn-primary" role="button" title="Tambah Data"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
          </div>
            <div class="box-body table-responsive">
              <table id="obat" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>NAMA </th>
                  <th>NIP </th>
                  <th>ALAMAT</th>
                  <th>NO HP</th>
                  <th>ID POLI</th>
                  <th>AKSI</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $no=0;
                $query=mysqli_query($con,"SELECT * FROM dokter");
                //echo $query;
                while ($row=mysqli_fetch_array($query))
                {
                ?>
                <tr>
                  <td><?php echo $no=$no+1;?></td>
                  <td><?php echo $row['nama'];?></td>
                  <td><?php echo $row['nip'];?></td>
                  <td><?php echo $row['alamat'];?></td>
                  <td><?php echo $row['no_hp'];?></td>
                  <td><?php echo $row['id_poli'];?></td>
                  <td>
                    <a href="ubah_dokter.php?id_dokter=<?=$row['id'];?>" class="btn btn-success" role="button" title="Ubah Data"><i class="glyphicon glyphicon-edit">Edit</i></a>
                    <a href="hapus_dokter.php?id_dokter=<?=$row['id'];?>" class="btn btn-danger" role="button" title="Hapus Data"><i class="glyphicon glyphicon-trash">Hapus</i></a>
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
