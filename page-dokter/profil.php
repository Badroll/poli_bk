<?php include_once('_header.php');?>

<?php

    // ACTION
    if($_POST){
        $nama = $_POST['nama'];
        $nip = $_POST['nip'];
        $alamat = $_POST['alamat'];
        $no_hp = $_POST['no_hp'];
        $poli = $_POST['poli'];
        $password = $_POST['password'];
        $qry = "
            UPDATE dokter SET nama = '$nama', nip = '$nip', alamat = '$alamat', no_hp = '$no_hp', id_poli = '$poli'
        ";
        if($password != ""){
            $qry .= ", password_dok = '$password'";
        }
        $id = $_SESSION['dokter']['id'];
        $qry .= " WHERE id = '$id'";

        $query = ($qry);
        if(!mysqli_query($con,$query)){
            die(mysqli_error($con));
        }else{
            $dokter = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM dokter WHERE id = '$id'"));
            $_SESSION['dokter'] = $dokter;
            echo '<script>alert("Data diri berhasil diperbarui"); window.location.href="profil.php"</script>';
        }
    }

    // REQUIRED DATA
    $poli = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM poli"), MYSQLI_ASSOC);
    //dd($poli);
?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			DATA DIRI SAYA
		</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-6">
				<div class="box box-primary">
					<form role="form" method="post" action="profil.php">
                      
                        <div class="mt-3 mb-3 col-md-6">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $_SESSION['dokter']['nama'] ?>" required>
                        </div>

                        <div class="mt-3 col-md-6">
                            <label for="poli" class="form-label">Poli</label>
                            <select class="form-control" id="poli" name="poli">
                                <?php foreach($poli as $key => $value) {
                                    $formValue = ($value['id']);
                                ?>
                                    <option
                                        value="<?php echo $formValue ?>"
                                        <?php echo ($formValue == $_SESSION['dokter']['id_poli']) ? "selected" : "" ?>
                                        >
                                        <?php echo $value['nama_poli'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mt-3 mb-3 col-md-6">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control" name="nip" id="nip" value="<?php echo $_SESSION['dokter']['nip'] ?>" required>
                        </div>

                        <div class="mt-3 mb-3 col-md-6">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat"><?php echo $_SESSION['dokter']['alamat'] ?></textarea>
                        </div>

                        <div class="mt-3 mb-3 col-md-6">
                            <label for="no_hp" class="form-label">No. HP</label>
                            <input type="text" class="form-control" name="no_hp" id="no_hp" value="<?php echo $_SESSION['dokter']['no_hp'] ?>" required>
                        </div>

                        <div class="mt-3 mb-3 col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" value="">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>

<?php include_once('_footer.php');?>
