<?php
include "../_config/config.php";

if ($_POST) {
    $id_dokter = $_POST['id_dokter']; // Tambahkan baris ini untuk mendapatkan nilai $id dari form

    $nama_dokter = $_POST['nama_dokter'];
    $nip = $_POST['nip'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $id_poli = $_POST['id_poli'];
    $password_dok = $_POST['password_dok'];

    // Gunakan parameterized queries untuk mencegah SQL injection
    $query = "UPDATE dokter SET nama=?, nip=?, alamat=?, no_hp=?, id_poli=?, password_dok=? WHERE id=?";
    $stmt = mysqli_prepare($con, $query);

    // Periksa apakah statement berhasil dibuat
    if ($stmt) {
        // Sesuaikan jumlah variabel pengikat dan jenis data
        mysqli_stmt_bind_param($stmt, "ssssisi", $nama_dokter, $nip, $alamat, $no_hp, $id_poli, $password_dok, $id_dokter);

        // Eksekusi statement
        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Data Berhasil Diubah !!!"); window.location.href="data_dokter.php"</script>';
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }

        // Tutup statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
