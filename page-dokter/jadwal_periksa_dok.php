<?php include_once('_header.php');?>

<?php

    // ACTION
    if(isset($_GET["hapus"])){
        $query = ("
            DELETE FROM jadwal_periksa WHERE id = '$_GET[hapus]'
        ");
        if(!mysqli_query($con,$query)){
            die(mysqli_error($con));
        }else{
            echo '<script>alert("Data berhasil dihapus"); window.location.href="jadwal_periksa_dok.php"</script>';
        }
    }
?>

    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">JADWAL PERIKSA </h5>
            <a href="jadwal_periksa_dok_add.php" id="btn_tambah" class="btn btn-primary" role="button" title="Tambah Data"><i class="glyphicon glyphicon-plus"></i> Tambah</a> 
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">No</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Nama Dokter</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Hari</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Jam Mulai</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Jam Selesai</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Aksi</h6>
                        </th>
                        </tr>
                    </thead>
                    <tbody>   
                        <?php
                            $no = 0;
                            $query = mysqli_query($con,"
                                SELECT A.*, B.nama as dokter_nama FROM jadwal_periksa as A
                                JOIN dokter as B ON A.id_dokter = B.id
                                WHERE B.id = '".$_SESSION['dokter']['id']."'
                                ");
                            while ($row=mysqli_fetch_array($query)){
                        ?>
                        <tr>
                            <td><?php echo $no = $no+1;?></td>
                            <td><?php echo $row['dokter_nama'];?></td>
                            <td><?php echo $row['hari'];?></td>
                            <td><?php echo $row['jam_mulai'];?></td>
                            <td><?php echo $row['jam_selesai'];?></td>
                            <td>
                                <?php if(day_indo(date("l")) != strtolower($row['hari'])){ ?>
                                    <a href="jadwal_periksa_dok_edit.php?id=<?=$row['id'];?>" class="btn btn-success" role="button" title="Ubah Data"><i class="glyphicon glyphicon-edit">Edit</i></a>
                                <?php }else{ ?>
                                    <!-- <i>tidak dapat mengedit<br>di hari-H</i> -->
                                <?php } ?>
                                <a href="jadwal_periksa_dok.php?hapus=<?=$row['id'];?>" class="btn btn-danger" role="button" title="Hapus Data"><i class="glyphicon glyphicon-trash">Hapus</i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <script>
                    var count = "<?php echo $no ?>";
                    if(count == 1){
                        document.getElementById("btn_tambah").style.display = "none"
                    }
                </script>
            </div>
        </div>
    </div>

<?php include_once('_footer.php');?>