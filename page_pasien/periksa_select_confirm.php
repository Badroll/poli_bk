<?php include_once('_header.php');?>

<?php

    $tanggal = "2024-01-25";

    // ACTION
    if($_POST){
        $passien_id = $_SESSION['pasien']['id'];
        $id = $_POST['id'];
        $keluhan = $_POST['keluhan'];
        $antrian = 0;
        //$tanggal = $_POST['tanggal'];

        $query = ("
            INSERT INTO daftar_poli (id_pasien, id_jadwal, keluhan, no_antrian) VALUES ('$passien_id', '$id', '$keluhan', '$antrian')
        ");
        if(!mysqli_query($con,$query)){
            die(mysqli_error($con));
        }else{
            $daftar_poli_id = mysqli_insert_id($con);
            // $query = ("
            //     INSERT INTO periksa (id_daftar_poli, tgl_periksa, catatan, biaya_periksa) VALUES ('$daftar_poli_id', '$tanggal', '', 0)
            // ");
            // if(!mysqli_query($con,$query)){
            //     die(mysqli_error($con));
            // }else{
            //     echo '<script>alert("Appointment berhasil disubmit"); window.location.href="periksa.php"</script>';
            // }
            echo '<script>alert("Appointment berhasil disubmit"); window.location.href="periksa.php"</script>';
        }
    }

    // REQUIRED DATA
    $jadwal = mysqli_fetch_assoc(mysqli_query($con, "
        SELECT *, B.nama as dokter_nama, C.nama_poli as poli_nama
        FROM jadwal_periksa as A
        JOIN dokter as B ON A.id_dokter = B.id
            JOIN poli as C ON B.id_poli = C.id
        WHERE A.id = '$_GET[id]'
    "));
    if($jadwal == null){
        echo '<script>alert("Data jadwal periksa tidak ditemukan"); window.location.href="periksa.php"</script>';
    }
    
    
?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			KONFIRMASI PERIKSA
		</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<form role="form" method="post" action="periksa_select_confirm.php">
                        
                        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $_GET['id'] ?>">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <br>
                                <h3>Detail Jadwal</h3>
                                <div class="mt-3 mb-3 col-md-12">
                                    <label for="Poli" class="form-label">Poli</label>
                                    <input type="text" class="form-control" name="Poli" id="Poli" value="<?php echo $jadwal['poli_nama'] ?>" disabled>
                                    <!-- <h3><?php echo $jadwal['poli_nama'] ?></h3> -->
                                </div>
                                <div class="mt-3 mb-3 col-md-12">
                                    <label for="Dokter" class="form-label">Dokter</label>
                                    <input type="text" class="form-control" name="Dokter" id="Dokter" value="<?php echo $jadwal['dokter_nama'] ?>" disabled>
                                </div>
                                <div class="mt-3 mb-3 col-md-12">
                                    <label for="Waktu" class="form-label">Hari &amp; Waktu</label>
                                    <input type="text" class="form-control" name="Waktu" id="Waktu" value="<?php echo $jadwal['hari'] . " &nbsp;" . $jadwal['jam_mulai'] . " s.d " . $jadwal['jam_selesai']; ?>" disabled>
                                </div>
                                <!-- <div class="mt-3 mb-3 col-md-12">
                                    <label for="nip" class="form-label">Tanggal</label>
                                    <input type="text" class="form-control" name="nip" id="nip" value="<?php echo tglIndo($tanggal, "LONG") ?>" disabled>
                                    <div class="form-text"><i>*tanggal dipilih sesuai jadwal terdekat dari sekarang</i></div>
                                </div> -->
                            </div>
                            <div class="col-md-6">
                                <br>
                                <h3>Informasi Pasien</h3>
                                <div class="mt-3 mb-3 col-md-12">
                                    <label for="keluhan" class="form-label">Keluhan</label>
                                    <textarea class="form-control" name="keluhan" id="keluhan"></textarea>
                                </div>
                                <br>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                    <label class="form-check-label" for="exampleCheck1">Saya setuju untuk membuat appointment periksa dengan dokter. Termasuk di dalamnya memberikan informasi data diri serta riwayat pemeriksaan.</label>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit Appointment</button>
                            </div>
                        </div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>

<?php include_once('_footer.php');?>
