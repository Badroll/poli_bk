<?php include_once('_header.php');?>

<?php

    // ACTION
    if($_POST){
        $hari = $_POST['hari'];
        $mulaiJam = $_POST['mulaiJam'];
        $mulaiMenit = $_POST['mulaiMenit'];
        $sampaiJam = $_POST['sampaiJam'];
        $sampaiMenit = $_POST['sampaiMenit'];

        // CEK BENTROK
        $query = mysqli_query($con,"
            SELECT A.*, B.id_poli as dokter_poli FROM jadwal_periksa as A
            JOIN dokter as B ON A.id_dokter = B.id
            ");
        while ($row = mysqli_fetch_array($query)){
            $mulai = explode(":", $row['jam_mulai']);
            $selesai = explode(":", $row['jam_selesai']);
            if(waktuBentrok($hari, $mulaiJam, $mulaiMenit, $sampaiJam, $sampaiMenit, $row['hari'], $mulai[0], $mulai[1], $selesai[0], $selesai[1])){
                echo '<script>alert("Jadwal bentrok"); window.history.back()</script>';
                exit;
            }
        }

        // TAMBAH DATA
        $query = ("
            INSERT INTO jadwal_periksa (id_dokter,hari,jam_mulai,jam_selesai) 
            VALUES ('".$_SESSION['dokter']['id']."','".$hari."','".$mulaiJam.":".$mulaiMenit."','".$sampaiJam.":".$sampaiMenit."')
           ");
        if(!mysqli_query($con,$query)){
            die(mysqli_error($con));
        }else{
            echo '<script>alert("Data berhasil ditambahkan"); window.location.href="jadwal_periksa_dok.php"</script>';
        }
    }

    // REQUIRED DATA
    //$ref_hari = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM ref_hari"));

?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			TAMBAH JADWAL PERIKSA
		</h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<!-- left column -->
			<div class="col-md-6">
				<!-- general form elements -->
				<div class="box box-primary">
					<!-- /.box-header -->
					<!-- form start -->
					<form role="form" method="post" action="jadwal_periksa_dok_add.php">
                        <!-- <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"></label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div> -->
                        <div class="mt-3 col-md-6">
                            <label for="hari" class="form-label">Hari</label>
                            <select class="form-control" id="hari" name="hari">
                                <?php foreach(get_hari() as $value) { ?>
                                    <option value="<?php echo ucfirst($value) ?>"><?php echo ucfirst($value) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mt-3 mb-3">
                            <label for="mulai" class="form-label">Mulai</label>
                            <div class="row" id="mulai">
                                <div class="col-md-3">
                                    <label for="mulaiJam" class="form-label">Jam</label>
                                    <select class="form-control" id="mulaiJam" name="mulaiJam">
                                        <?php foreach(range(0,23) as $value) { ?>
                                            <option value="<?php echo (($value < 10) ? '0' : '') . $value ?>">
                                                <?php echo (($value < 10) ? '0' : '') . $value ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="mulaiMenit" class="form-label">Menit</label>
                                    <select class="form-control" id="mulaiMenit" name="mulaiMenit">
                                        <?php foreach(range(0,59) as $value) { ?>
                                            <option value="<?php echo (($value < 10) ? '0' : '') . $value ?>">
                                                <?php echo (($value < 10) ? '0' : '') . $value ?>
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
                                        <?php foreach(range(0,23) as $value) { ?>
                                            <option value="<?php echo (($value < 10) ? '0' : '') . $value ?>">
                                                <?php echo (($value < 10) ? '0' : '') . $value ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="sampaiMenit" class="form-label">Menit</label>
                                    <select class="form-control" id="sampaiMenit" name="sampaiMenit">
                                        <?php foreach(range(0,59) as $value) { ?>
                                            <option value="<?php echo (($value < 10) ? '0' : '') . $value ?>">
                                                <?php echo (($value < 10) ? '0' : '') . $value ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div> -->
                        <button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
				<!-- /.box -->
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>

<?php include_once('_footer.php');?>
