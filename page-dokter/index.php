<?php include_once('_header.php');?>

        <div class="row">
          <div class="col-lg-12">
            <h1 class="card-title mb-9 fw-semibold">Dashboard</h1>
            <p>Selamat datang dokter <b><?=strtoupper($_SESSION['dokter']["nama"]);?></b> di aplikasi Poliklinik BK</p>
          </div>
        </div>

<?php include_once('_footer.php');?>