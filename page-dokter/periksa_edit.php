<?php include_once('_header.php');?>

<!-- pickadate -->
<link rel="stylesheet" href="../_assets/src/assets/js/pickadate/lib/themes/default.css">
<link rel="stylesheet" href="../_assets/src/assets/js/pickadate/lib/themes/default.date.css">

<?php

    // ACTION
    if($_POST){
        if(isset($_POST['obat'])){
            $id = $_POST['id'];
            $biaya = $_POST["biaya"];
            $obat = $_POST["obat"];
            $obat = explode("<>", $obat);
            $query = ("
                INSERT INTO detail_periksa (id_periksa, id_obat) VALUES ($id, $obat[0])
            ");
            if(!mysqli_query($con,$query)){
                die(mysqli_error($con));
            }else{
                $biaya_update = (int)$biaya + (int)$obat[1];
                $query = ("
                    UPDATE periksa SET biaya_periksa = '$biaya_update' WHERE id = '$id'
                ");
                if(!mysqli_query($con,$query)){
                    die(mysqli_error($con));
                }else{
                    echo '<script>alert("Obat berhasil ditambahkan"); window.history.back();</script>';
                    exit;
                }
            }
        }else{
            $id = $_POST['id'];
            $catatan = $_POST['catatan'];

            $query = ("
                UPDATE periksa SET catatan = '$catatan' WHERE id = '$id'
            ");
            if(!mysqli_query($con,$query)){
                die(mysqli_error($con));
            }else{
                echo '<script>alert("Obat berhasil ditambahkan"); window.history.back();</script>';
                exit;
            }
        }
    }
    if(isset($_GET["hapus"])){
        $query = ("
            DELETE FROM detail_periksa WHERE id = '$_GET[hapus]'
        ");
        if(!mysqli_query($con,$query)){
            die(mysqli_error($con));
        }else{
            $biaya_update = (int)$_GET['biaya'] - (int)$_GET['harga'];
            //dd($_GET['id']);
            $query = ("
                UPDATE periksa SET biaya_periksa = '$biaya_update' WHERE id = '$_GET[periksa_id]'
            ");
            if(!mysqli_query($con,$query)){
                die(mysqli_error($con));
            }else{
                echo "<script>alert('Obat dihapus'); window.location='" . base_url('page-dokter/periksa_edit.php?id='.$_GET['daftar_poli_id']) . "';</script>";
            }
        }
    }
    if(isset($_GET["tanggal"])){

        $cek_antrian = mysqli_fetch_all(mysqli_query($con, "
            SELECT *
            FROM periksa as A
            JOIN daftar_poli as B ON A.id_daftar_poli = B.id
            WHERE B.id_jadwal = '$_GET[id_jadwal]' AND A.tgl_periksa LIKE '$_GET[tanggal]%'
        "), MYSQLI_ASSOC);
        $no_antrian = count($cek_antrian) + 1;

        $query = ("
            UPDATE daftar_poli SET no_antrian = '$no_antrian' WHERE id = '$_GET[daftar_poli_id]'
        ");
        if(!mysqli_query($con,$query)){
            die(mysqli_error($con));
            exit;
        }

        $periksa_exist = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM periksa WHERE id_daftar_poli = '$_GET[daftar_poli_id]'"), MYSQLI_ASSOC);
        if(count($periksa_exist) > 0){
            $query = ("
                UPDATE periksa SET tgl_periksa = '$_GET[tanggal]' WHERE id = '$_GET[periksa_id]'
            ");
            if(!mysqli_query($con,$query)){
                die(mysqli_error($con));
            }else{
                echo "<script>alert('Tanggal periksa diubah'); window.location='" . base_url('page-dokter/periksa_edit.php?id='.$_GET['daftar_poli_id']) . "';</script>";
            }
        }else{
            $query = ("
                INSERT INTO periksa (id_daftar_poli, tgl_periksa, catatan, biaya_periksa) VALUES ('$_GET[daftar_poli_id]', '$_GET[tanggal]', '', 150000)
            ");
            if(!mysqli_query($con,$query)){
                die(mysqli_error($con));
            }else{
                echo "<script>alert('Data pemeriksaan disimpan'); window.location='" . base_url('page-dokter/periksa_edit.php?id='.$_GET['daftar_poli_id']) . "';</script>";
            }
        }
    }

    // REQUIRED DATA

    $periksa = mysqli_fetch_assoc(mysqli_query($con, "
        SELECT A.*,
        B.id as periksa_id, B.tgl_periksa as periksa_tgl_periksa, B.catatan as periksa_catatan, B.biaya_periksa as periksa_biaya_periksa,
        C.id as jadwal_id, C.hari as jadwal_hari,
            CA.nama as dokter_nama,
            CB.nama_poli as poli_nama,
        D.id as pasien_id, D.nama as pasien_nama, D.no_rm as pasien_no_rm, D.alamat as pasien_alamat
        FROM daftar_poli AS A
        LEFT JOIN periksa as B ON A.id = B.id_daftar_poli
        JOIN jadwal_periksa as C ON A.id_jadwal = C.id
            JOIN dokter as CA ON C.id_dokter = CA.id
            JOIN poli as CB ON CA.id_poli = CB.id
        JOIN pasien as D ON A.id_pasien = D.id
        WHERE A.id = '".$_GET['id']."'
    "));
    if($periksa == null){
        echo '<script>alert("Data periksa tidak ditemukan"); window.location.href="periksa.php"</script>';
    }
    
    $dokter_id = $_SESSION['dokter']['id'];
    $jadwal = mysqli_fetch_assoc(mysqli_query($con, "
        SELECT *, B.nama as dokter_nama, C.nama_poli as poli_nama
        FROM jadwal_periksa as A
        JOIN dokter as B ON A.id_dokter = B.id
            JOIN poli as C ON B.id_poli = C.id
        WHERE A.id_dokter = '$dokter_id'
    "));
    if($jadwal == null){
        echo '<script>alert("Data jadwal periksa tidak ditemukan"); window.location.href="periksa.php"</script>';
    }

    $obat = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM obat"), MYSQLI_ASSOC);

    $detail_periksa = mysqli_fetch_all(mysqli_query($con, "
        SELECT A.*, B.nama_obat as obat_nama_obat, B.kemasan as obat_kemasan, B.harga as obat_harga
        FROM detail_periksa as A
        JOIN obat as B ON A.id_obat = B.id
        WHERE A.id_periksa = '$periksa[periksa_id]'
    "), MYSQLI_ASSOC);

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
        WHERE A.id_pasien = '".$periksa['id_pasien']."'
        ORDER BY B.tgl_periksa DESC 
    "), MYSQLI_ASSOC);
    foreach($riwayat as $key => $value){
        $riwayat_obat = mysqli_fetch_all(mysqli_query($con, "
            SELECT A.*, B.nama_obat as obat_nama_obat, B.kemasan as obat_kemasan, B.harga as obat_harga
            FROM detail_periksa as A
            JOIN obat as B ON A.id_obat = B.id
            WHERE A.id_periksa = '$value[periksa_id]'
        "), MYSQLI_ASSOC);
        $value["obat"] = $riwayat_obat;
    }

?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			PROSES PERIKSA PASIEN
		</h1>
	</section>
	<section class="content">
        <div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<form role="form" method="post" action="periksa_edit.php">
                        
                        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $periksa['periksa_id'] ?>">
                        <!-- <br>
                        <h2>Nomor antrian <?php echo $periksa['no_antrian'] ?></h2> -->
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
                                <hr>
                                <div class="mt-3 mb-3 col-md-12">
                                    <label for="tanggalFormat" class="form-label">Tanggal Periksa</label>
                                    <input type="text" class="form-control datepicker" name="tanggalFormat" id="tanggalFormat">
                                    <div class="form-text periksa-false"><i>*pilih tanggal periksa untuk dapat memberikan detail hasil periksa</i></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <br>
                                <h3>Informasi Pasien</h3>
                                <div class="mt-3 mb-3 col-md-12">
                                    <label for="antrian" class="form-label">No Antrian</label>
                                    <input type="text" class="form-control" name="antrian" id="antrian" value="<?php echo ($periksa['no_antrian'] == "0") ? "-" : $periksa['no_antrian'] ?>" disabled>
                                </div>
                                <div class="mt-3 mb-3 col-md-12">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $periksa['pasien_nama'] ?>" disabled>
                                </div>
                                <div class="mt-3 mb-3 col-md-12">
                                    <label for="no_rm" class="form-label">No. RM</label>
                                    <input type="text" class="form-control" name="no_rm" id="no_rm" value="<?php echo $periksa['pasien_no_rm'] ?>" disabled>
                                </div>
                                <hr>
                                <div class="mt-3 mb-3 col-md-12">
                                    <label for="keluhan" class="form-label">Keluhan</label>
                                    <textarea class="form-control" name="keluhan" id="keluhan" disabled><?php echo $periksa['keluhan'] ?></textarea>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div>
                            <div class="col-md-12">
                                <br>
                                <h3>Riwayat Pemeriksaan Pasien</h3>
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($riwayat as $key => $value){
                                                ?>
                                                <tr>
                                                    <td><?php echo $key+1;?></td>
                                                    <td><?php echo $value['poli_nama'];?> <br> dokter <?php echo $value['dokter_nama'];?></td>
                                                    <td><?php echo $value['keluhan'];?></td>
                                                    <td><?php echo $value['jadwal_hari'] . "<br>" . tglIndo($value['periksa_tgl_periksa'], "LONG");?></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="periksa-true">
                        <div class="row periksa-true">
                            <div class="col-md-6">
                                <br>
                                <h3>Hasil Pemeriksaan</h3>
                                <div class="mt-3 mb-3 col-md-12">
                                    <label for="catatan" class="form-label">Catatan</label>
                                    <textarea class="form-control" name="catatan" id="catatan"><?php echo $periksa['periksa_catatan'] ?></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                            </form>
                            <div class="col-md-6">
                                <br>
                                <h3>Obat</h3>
                                <div class="row mt-3">
                                    <form role="form" method="post" action="periksa_edit.php">
                                    <input type="hidden" class="form-control" name="id" value="<?php echo $periksa['periksa_id'] ?>">
                                    <input type="hidden" class="form-control" name="biaya" value="<?php echo $periksa['periksa_biaya_periksa'] ?>">
                                    <label for="obat" class="form-label">Tambah Obat</label>
                                    <div class="row" id="obat">
                                        <div class="col-md-8">
                                            <select class="form-control" name="obat">
                                                <?php
                                                    foreach($obat as $key => $value) {
                                                        $formValue = ($value['id'] . "<>" . $value["harga"]);
                                                ?>
                                                    <option
                                                        value="<?php echo $formValue ?>"
                                                        >
                                                        <?php echo $value['nama_obat'] ?> (<?php echo $value['kemasan'] ?>) - Rp <?php echo $value['harga'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary">Tambah</button>
                                        </div> 
                                    </div>
                                    </form>
                                </div>
                                <div class="mt-3 mb-3 col-md-12">
                                    <div class="table-responsive">
                                        <table class="table text-nowrap mb-0 align-middle">
                                            <thead class="text-dark fs-4">
                                                <tr>
                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">No</h6>
                                                    </th>
                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">Keterangan</h6>
                                                    </th>
                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">Harga</h6>
                                                    </th>
                                                    <th class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">Aksi</h6>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $totalObat = 0;
                                                    foreach($detail_periksa as $key => $value){
                                                        $totalObat += $value["obat_harga"];
                                                ?>
                                                <tr>
                                                    <td><?php echo $key+1;?></td>
                                                    <td><?php echo $value['obat_nama_obat'];?> (<?php echo $value['obat_kemasan'];?>)</td>
                                                    <td>Rp <?php echo $value['obat_harga'];?></td>
                                                    <td>
                                                        <a href="periksa_edit.php?hapus=<?=$value['id'];?>&periksa_id=<?php echo $periksa['periksa_id'] ?>&daftar_poli_id=<?php echo $_GET['id'] ?>&harga=<?php echo $value['obat_harga'] ?>&biaya=<?php echo $periksa['periksa_biaya_periksa'] ?>"
                                                        class="btn btn-danger" role="button" title="Ubah Data"><i class="glyphicon glyphicon-edit">Hapus</i></a>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="periksa-true">
                        <div class="row mt-3  periksa-true">
                            <div class="col-md-6">
                                <br>
                                <h3>Rincian Biaya</h3>
                                <div class="mt-3 mb-3 col-md-12">
                                    <label for="biaya_periksa" class="form-label">Biaya Periksa</label>
                                    <input type="text" class="form-control" name="biaya_periksa" id="biaya_periksa" value="Rp <?php echo "150000" ?>" disabled>
                                </div>
                                <div class="mt-3 mb-3 col-md-12">
                                    <label for="biaya_obat" class="form-label">Biaya Obat (<?php echo count($detail_periksa) ?> item)</label>
                                    <input type="text" class="form-control" name="biaya_obat" id="biaya_obat" value="Rp <?php echo $totalObat ?>" disabled>
                                </div>
                                <div class="mt-3 mb-3 col-md-12">
                                    <label for="total" class="form-label">TOTAL BIAYA</label>
                                    <input type="text" class="form-control" name="total" id="total" value="Rp <?php echo $periksa['periksa_biaya_periksa'] ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                </div>
			</div>
		</div>
	</section>
</div>

<form role="form" method="get" action="periksa_edit.php" id="form_tanggal">
    <input type="hidden" name="tanggal" id="tanggal" value="">
    <input type="hidden" name="daftar_poli_id" value="<?php echo $_GET['id'] ?>">
    <input type="hidden" name="periksa_id" value="<?php echo $periksa['periksa_id'] ?>">
    <input type="hidden" name="id_jadwal" value="<?php echo $periksa['jadwal_id'] ?>">
</form>

<!-- pickadate -->
<script src="../_assets/src/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="../_assets/src/assets/js/pickadate/lib/picker.js"></script>
<script src="../_assets/src/assets/js/pickadate/lib/picker.date.js"></script>
<script>
    var gCount = 1

    var picker = $('#tanggalFormat').pickadate({
        format: 'dd mmmm, yyyy',
    }).pickadate('picker');
    picker.on('set', function(){
        $('#tanggal').val(picker.get('select', 'yyyy-mm-dd'));
        if(gCount > 1 || (typeof(tgl_periksa) == "undefined" || tgl_periksa == "null" || tgl_periksa == null || tgl_periksa == "")){
            $("#form_tanggal").submit();
        }
        gCount += 1
    });

    var tgl_periksa = "<?php echo strval($periksa['periksa_tgl_periksa']) ?>"
    if(typeof(tgl_periksa) == "undefined" || tgl_periksa == "null" || tgl_periksa == null || tgl_periksa == ""){
        // belum diperiksa (belum ada tanggal periksa)
        $(".periksa-true").css("display", "none")
    }else{
        tgl_periksa = tgl_periksa.split(" ")[0] // remove time
        picker.set('select', tgl_periksa, { format: 'yyyy-mm-dd' });
        $(".periksa-false").css("display", "none")
    }

    
</script>

<?php include_once('_footer.php');?>
