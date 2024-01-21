<?php include_once('_header.php');?>

<?php

    $riwayat = mysqli_fetch_all(mysqli_query($con, "
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
        WHERE A.id_pasien = '".$_GET['id']."'
        ORDER BY B.tgl_periksa DESC 
    "), MYSQLI_ASSOC);
    foreach($riwayat as $key => $value){
        $riwayat_obat = mysqli_fetch_all(mysqli_query($con, "
            SELECT A.*, B.nama_obat as obat_nama_obat, B.kemasan as obat_kemasan, B.harga as obat_harga
            FROM detail_periksa as A
            JOIN obat as B ON A.id_obat = B.id
            WHERE A.id_periksa = '$value[periksa_id]'
        "), MYSQLI_ASSOC);
        $riwayat[$key]["obat"] = $riwayat_obat;
    }

?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			RIWAYAT PEMERIKSAAN PASIEN
		</h1>
	</section>
	<section class="content">
        <div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<form role="form" method="post" action="periksa_edit.php">
                        
                        <div>
                            <div class="col-md-12">
                                <br>
                                <h4>Nama : <?php echo $_GET['nama']; ?> </h4>
                                <div class="mt-3 mb-3 col-md-12">
                                    <div class="table-responsive">
                                        <table class="table text-nowrap mb-0 align-middle">
                                            <thead class="text-dark fs-4">
                                                <tr>
                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">No</h6>
                                                    </th>
                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">Poli/Dokter</h6>
                                                    </th>
                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">Keluhan</h6>
                                                    </th>
                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">Hari/Tanggal</h6>
                                                    </th>
                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">Catatan</h6>
                                                    </th>
                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">Obat</h6>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($riwayat as $key => $value){
                                                        $obat = "";
                                                        foreach($value["obat"] as $key2 => $value2){
                                                            $obat .= "- " . $value2["obat_nama_obat"] . "<br>";
                                                        }
                                                ?>
                                                <tr>
                                                    <td><?php echo $key+1;?></td>
                                                    <td><?php echo $value['poli_nama'];?> <br> dokter <?php echo $value['dokter_nama'];?></td>
                                                    <td><?php echo $value['keluhan'];?></td>
                                                    <td><?php echo $value['jadwal_hari'] . "<br>" . tglIndo($value['periksa_tgl_periksa'], "LONG");?></td>
                                                    <td><?php echo $value['periksa_catatan'];?></td>
                                                    <td><?php echo $obat;?></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                   
                    </form>
                </div>
            </div>
		</div>
	</section>
</div>

<script>
    
</script>

<?php include_once('_footer.php');?>
