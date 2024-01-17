<?php
    include "../_config/config.php";
    if($_POST){
        $id = $_POST['id'];
        $nama_poli = $_POST['nama_poli'];
        $keterangan = $_POST['keterangan'];
        $query = ("INSERT INTO poli(nama_poli,keterangan) 
           VALUES ('".$nama_poli."','".$keterangan."')");
        if(!mysqli_query($con,$query)){
            die(mysqli_error($con));
        }else
        {
            echo '<script>alert("Data Berhasil Ditambahkan !!!"); window.location.href="data_poli.php"</script>';
        }
    }
?>