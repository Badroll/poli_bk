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
            <h5 class="card-title fw-semibold mb-4">DATA PERIKSA </h5>
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
                                <h6 class="fw-semibold mb-0">No Antrian</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Keluhan</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Hari/Tanggal</h6>
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
                                SELECT A.*,
                                B.id as periksa_id, B.tgl_periksa as periksa_tgl_periksa, B.catatan as periksa_catatan, B.biaya_periksa as periksa_biaya_periksa,
                                C.id as jadwal_id, C.hari as jadwal_hari,
                                    CA.nama as dokter_nama,
                                    CB.nama_poli as poli_nama,
                                D.id as pasien_id, D.nama as pasien_nama
                                FROM daftar_poli AS A
                                LEFT JOIN periksa as B ON A.id = B.id_daftar_poli
                                JOIN jadwal_periksa as C ON A.id_jadwal = C.id
                                    JOIN dokter as CA ON C.id_dokter = CA.id
                                    JOIN poli as CB ON CA.id_poli = CB.id
                                JOIN pasien as D ON A.id_pasien = D.id
                                WHERE C.id_dokter = '".$_SESSION['dokter']['id']."'
                                ");
                            while ($row=mysqli_fetch_array($query)){
                                $class = "success";
                                $info = "Edit";
                                if($row['periksa_id'] == null){
                                    $class = "primary";
                                    $info = "Periksa";
                                }
                        ?>
                        <tr>
                            <td><?php echo $no = $no+1;?></td>
                            <td><?php echo $row['pasien_nama'];?></td>
                            <td><?php echo $row['no_antrian'];?></td>
                            <td><?php echo $row['keluhan'];?></td>
                            <td><?php echo $row['jadwal_hari'] . "<br>" . tglIndo($row['periksa_tgl_periksa'], "LONG");?></td>
                            <td>
                                <a href="periksa_edit.php?id=<?=$row['id'];?>" class="btn btn-<?php echo $class ?>" role="button" title="Ubah Data"><i class="glyphicon glyphicon-edit"><?php echo $info ?></i></a>
                                <!-- <a href="periksa.php?hapus=<?=$row['id'];?>" class="btn btn-danger" role="button" title="Hapus Data"><i class="glyphicon glyphicon-trash">Hapus</i></a> -->
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include_once('_footer.php');?>