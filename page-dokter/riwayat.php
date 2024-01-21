<?php include_once('_header.php');?>

<?php

?>

    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">RIWAYAT PEMERIKSAAN PASIEN</h5>
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">No</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Nama Pasien</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">No. RM</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Alamat</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">No. HP</h6>
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
                                SELECT * FROM (SELECT DISTINCT(id_pasien) FROM
                                (
                                SELECT A.*, C.id AS dokter_id, C.nama AS dokter_nama
                                FROM daftar_poli AS A
                                JOIN jadwal_periksa AS B ON A.id_jadwal = B.id
                                JOIN dokter AS C ON B.id_dokter = C.id
                                WHERE C.id = '".$_SESSION['dokter']['id']."'
                                ) AS pasien_dokter
                                ) AS X
                                JOIN pasien AS Y ON X.id_pasien = Y.id
                                ");
                            while ($row=mysqli_fetch_array($query)){
                        ?>
                        <tr>
                            <td><?php echo $no = $no+1;?></td>
                            <td><?php echo $row['nama'];?></td>
                            <td><?php echo $row['no_rm'];?></td>
                            <td><?php echo $row['alamat'];?></td>
                            <td><?php echo $row['no_hp'];?></td>
                            <td>
                                <a href="riwayat_detail.php?id=<?=$row['id_pasien'];?>&nama=<?=$row['nama'];?>" class="btn btn-primary" role="button" title="Ubah Data"><i class="glyphicon glyphicon-edit">Detail</i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include_once('_footer.php');?>