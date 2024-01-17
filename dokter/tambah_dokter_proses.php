<?php
include "../_config/config.php";

if ($_POST) {
    $nama_dokter = $_POST['nama_dokter'];
    $nip = $_POST['nip'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $id_poli = $_POST['id_poli'];
    $password_dok = $_POST['password_dok'];

    // Gunakan parameterized queries untuk mencegah SQL injection
    $query = "INSERT INTO dokter (nama, nip, alamat, no_hp, id_poli, password_dok) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $query);

    // Periksa apakah statement berhasil dibuat
    if ($stmt) {
        // Sesuaikan jumlah variabel pengikat dan jenis data
        mysqli_stmt_bind_param($stmt, "ssssis", $nama_dokter, $nip, $alamat, $no_hp, $id_poli, $password_dok);

        // Eksekusi statement
        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Data Berhasil Ditambahkan !!!"); window.location.href="data_dokter.php"</script>';
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
