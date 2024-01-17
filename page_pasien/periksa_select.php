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
            <h5 class="card-title fw-semibold mb-4">PILIH JADWAL PERIKSA</h5>
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
                            <h6 class="fw-semibold mb-0">Poli</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Hari</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Waktu</h6>
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
                                SELECT A.*, B.nama as dokter_nama, BA.nama_poli as poli_nama
                                FROM jadwal_periksa as A
                                JOIN dokter as B ON A.id_dokter = B.id
                                    JOIN poli as BA ON B.id_poli = BA.id
                                ");
                            while ($row=mysqli_fetch_array($query)){
                        ?>
                        <tr>
                            <td><?php echo $no = $no+1;?></td>
                            <td><?php echo $row['dokter_nama'];?></td>
                            <td><?php echo $row['poli_nama'];?></td>
                            <td><?php echo $row['hari'];?></td>
                            <td><?php echo $row['jam_mulai'];?> s.d <?php echo $row['jam_selesai'];?></td>
                            <td>
                                <a href="periksa_select_confirm.php?id=<?=$row['id'];?>" class="btn btn-primary" role="button" title="Ubah Data"><i class="glyphicon glyphicon-edit">Pilih</i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include_once('_footer.php');?>