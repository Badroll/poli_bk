<?php 
require_once "../_config/config.php";
if(isset($_SESSION['dokter'])){
  echo "<script>window.location='".base_url()."';</script>";
}else{
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
  <!--  Body Wrapper -->
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
                <img src="../_assets/src/assets/images/logos/logo-pol.png" style="margin-left: 40px;" width="180" alt="">
                </a>
                </a>
                <p class="text-center">Form Login Dokter</p>
                
                <form action="" method="POST" class="navbar-form">
                <?php
                if(isset($_POST['login'])) {
                    $user = trim(mysqli_real_escape_string($con, $_POST['user']));
                    $pass = (trim(mysqli_real_escape_string($con, $_POST['pass'])));
                    $sql_login = mysqli_query($con, "SELECT * FROM dokter WHERE no_hp = '$user' AND password_dok = '$pass'") or die (mysqli_error($con));
                    if(mysqli_num_rows($sql_login) > 0){
                        $dokter = mysqli_fetch_assoc($sql_login);
                        $_SESSION['dokter'] = $dokter;
                        //echo "<script>window.location='".base_url()."/page-dokter/dash_dokter.php';</script>";
                        header("Location: ../page-dokter");
                        exit;
                    }else { ?>
                        <div class="row">
                            <div class="col-lg-6-offset-3">
                                <div class="alert alert-danger alert-dismissable" role="alert">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <strong>Login gagal</strong> No. HP / password salah
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                }
                ?>
                  <div class="mb-3">
                    <label for="exampleInputusername" class="form-label">No. HP</label>
                    <input type="text" class="form-control" name="user" id="exampleInputEmail1"  aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="pass" id="exampleInputPassword1" >
                  </div>
                  <input type="submit" name="login" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" value="login">
                
                </form>
                <a class="text-primary fw-bold ms-2" href="<?=base_url("home.php")?>">Kembali</a>
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