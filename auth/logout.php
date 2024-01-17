<?php 
require_once "../_config/config.php";

unset($_SESSION['user']);
unset($_SESSION['dokter']);
unset($_SESSION['pasien']);
echo "<script>window.location='".base_url('/')."';</script>";
?>