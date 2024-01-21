<?php
require_once "../_config/config.php";

if (isset($_SESSION['pasien'])) {
    echo "<script>window.location='".base_url()."';</script>";
} else {
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Poliklinik BK</title>
  <link rel="shortcut icon" type="image/png" href="<?=base_url('_assets/src/assets/images/logos/favicon.png')?>" />
  <link rel="stylesheet" href="<?=base_url('_assets/src/assets/css/styles.min.css');?>" />
</head>

<body>
  <!-- Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="../_assets/src/assets/images/logos/dark-logo.svg" width="180" alt="">
                </a>
                <p class="text-center">Form Pendaftaran Pasien</p>

             
                <form action="register.php" method="POST" class="navbar-form">
                  <?php
                    if (isset($_POST['register'])) {
                        $nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
                        $password = trim(mysqli_real_escape_string($con, $_POST['password']));
                        $alamat = trim(mysqli_real_escape_string($con, $_POST['alamat']));
                        $no_ktp = trim(mysqli_real_escape_string($con, $_POST['no_ktp']));
                        $no_hp = trim(mysqli_real_escape_string($con, $_POST['no_hp']));
                        $sql_cek = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM pasien WHERE no_ktp = '$no_ktp' "));
                        if ($sql_cek != null) {
                            echo '<script>alert("No. KTP sudah terdaftar"); window.history.back();</script>';
                        }
                        else{
                          $pasiens = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM pasien"), MYSQLI_ASSOC);
                          $no_rm = date("Ym")."-".(count($pasiens) + 1);
                          $sql_register = mysqli_query($con, "INSERT INTO pasien (nama, password, alamat, no_ktp, no_hp, no_rm) VALUES ('$nama', '$password', '$alamat', '$no_ktp', '$no_hp', '$no_rm')") or die(mysqli_error($con));
                          if ($sql_register) {
                              echo '<script>alert("Registration successful! Please login."); window.location.href="'.base_url('auth/login_pasien.php').'";</script>';
                          } else {
                              echo '<div class="alert alert-danger alert-dismissable" role="alert">
                                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                      <strong>Registration failed</strong> Please try again later.
                                  </div>';
                          }
                        }
                    }
                  ?>

                  <div class="mb-3">
                    <label for="exampleInputNama" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" id="exampleInputNama" required>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputAlamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" name="alamat" id="exampleInputAlamat" required>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputNoKTP" class="form-label">No. KTP</label>
                    <input type="text" class="form-control" name="no_ktp" id="exampleInputNoKTP" required>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputNoHP" class="form-label">No. HP</label>
                    <input type="text" class="form-control" name="no_hp" id="exampleInputNoHP" required>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword" required>
                  </div>
                  <input type="submit" name="register" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" value="Register">
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">New Member?</p>
                    <a class="text-primary fw-bold ms-2" href="<?=base_url("auth/register.php")?>">Create an account</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?=base_url("_assets/src/assets/libs/jquery/dist/jquery.min.js")?>"></script>
  <script src="<?=base_url("_assets/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js")?>"></script>
</body>

</html>
<?php
}
?>
