<?php include_once('_header.php');?>

<?php

    // ACTION
    if($_POST){
        $id = $_POST['id'];
        $hari = $_POST['hari'];
        $mulaiJam = $_POST['mulaiJam'];
        $mulaiMenit = $_POST['mulaiMenit'];
        $sampaiJam = $_POST['sampaiJam'];
        $sampaiMenit = $_POST['sampaiMenit'];

        // CEK BENTROK
        $dokter_id = $_SESSION['dokter']['id'];
        $query = mysqli_query($con,"
            SELECT A.*, B.id_poli as dokter_poli FROM jadwal_periksa as A
            JOIN dokter as B ON A.id_dokter = B.id
            WHERE B.id != '$dokter_id'
            ");
        while ($row = mysqli_fetch_array($query)){
            //dd($row);
            $mulai = explode(":", $row['jam_mulai']);
            $selesai = explode(":", $row['jam_selesai']);
            if(waktuBentrok($hari, $mulaiJam, $mulaiMenit, $sampaiJam, $sampaiMenit, $row['hari'], $mulai[0], $mulai[1], $selesai[0], $selesai[1])){
                echo '<script>alert("Jadwal bentrok"); window.history.back()</script>';
                exit;
            }
        }

        $query = ("
            UPDATE jadwal_periksa SET hari = '$hari', jam_mulai = '$mulaiJam:$mulaiMenit', jam_selesai = '$sampaiJam:$sampaiMenit' WHERE id = '$id'
        ");
        if(!mysqli_query($con,$query)){
            die(mysqli_error($con));
        }else{
            echo '<script>alert("Data berhasil diubah"); window.location.href="jadwal_periksa_dok.php"</script>';
        }
    }

    // REQUIRED DATA
    $jadwal = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM jadwal_periksa WHERE id = '$_GET[id]' "));
    if($jadwal == null){
        echo '<script>alert("Data tidak ditemukan"); window.location.href="jadwal_periksa_dok.php"</script>';
    }
    //dd($jadwal);
?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			EDIT JADWAL PERIKSA
		</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-6">
				<div class="box box-primary">
					<form role="form" method="post" action="jadwal_periksa_dok_edit.php">
                        <input type="hidden" class="form-control" name="id" value="<?php echo $_GET['id'] ?>">
                        <div class="mt-3 col-md-6">
                            <label for="hari" class="form-label">Hari</label>
                            <select class="form-control" id="hari" name="hari">
                                <?php foreach(get_hari() as $value) {
                                    $formValue = ucfirst($value);
                                ?>
                                    <option
                                        value="<?php echo $formValue ?>"
                                        <?php echo ($formValue == $jadwal['hari']) ? "selected" : "" ?>
                                        >
                                        <?php echo $formValue ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mt-3 mb-3">
                            <label for="mulai" class="form-label">Mulai</label>
                            <?php
                                $jadwalMulai = explode(":", $jadwal['jam_mulai']);
                                $jadwalSampai = explode(":", $jadwal['jam_selesai']);
                            ?>
                            <div class="row" id="mulai">
                                <div class="col-md-3">
                                    <label for="mulaiJam" class="form-label">Jam</label>
                                    <select class="form-control" id="mulaiJam" name="mulaiJam">
                                        <?php foreach(range(0,23) as $value) {
                                            $formValue = (($value < 10) ? '0' : '') . $value;
                                            ?>
                                            <option
                                                value="<?php echo $formValue ?>"
                                                <?php echo ($formValue == $jadwalMulai[0]) ? "selected" : "" ?>
                                                >
                                                <?php echo $formValue ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="mulaiMenit" class="form-label">Menit</label>
                                    <select class="form-control" id="mulaiMenit" name="mulaiMenit">
                                        <?php foreach(range(0,59) as $value) {
                                            $formValue = (($value < 10) ? '0' : '') . $value;
                                            ?>
                                            <option
                                                value="<?php echo $formValue ?>"
                                                <?php echo ($formValue == $jadwalMulai[1]) ? "selected" : "" ?>
                                                >
                                                <?php echo $formValue ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 mb-3">
                            <label for="sampai" class="form-label">Sampai</label>
                            <div class="row" id="sampai">
                                <div class="col-md-3">
                                    <label for="sampaiJam" class="form-label">Jam</label>
                                    <select class="form-control" id="sampaiJam" name="sampaiJam">
                                        <?php foreach(range(0,23) as $value) {
                                            $formValue = (($value < 10) ? '0' : '') . $value;
                                            ?>
                                            <option
                                                value="<?php echo $formValue ?>"
                                                <?php echo ($formValue == $jadwalSampai[0]) ? "selected" : "" ?>
                                                >
                                                <?php echo $formValue ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="sampaiMenit" class="form-label">Menit</label>
                                    <select class="form-control" id="sampaiMenit" name="sampaiMenit">
                                        <?php foreach(range(0,59) as $value) {
                                            $formValue = (($value < 10) ? '0' : '') . $value;
                                            ?>
                                            <option
                                                value="<?php echo $formValue ?>"
                                                <?php echo ($formValue == $jadwalSampai[1]) ? "selected" : "" ?>
                                                >
                                                <?php echo $formValue ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>

<?php include_once('_footer.php');?>
