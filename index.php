<?php
require_once "_config/config.php";

if (isset($_SESSION['user'])) {
    echo "<script>window.location='" . base_url('dashboard') . "';</script>";
} elseif (isset($_SESSION['dokter'])) {
    echo "<script>window.location='" . base_url('page-dokter') . "';</script>";
} elseif (isset($_SESSION['pasien'])) {
    echo "<script>window.location='" . base_url('page_pasien') . "';</script>";
}else{
    echo "<script>window.location='" . base_url('home.php') . "';</script>";
}
?>

