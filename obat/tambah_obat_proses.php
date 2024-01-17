<?php
    include "../_config/config.php";
    if($_POST){
        $id = $_POST['id'];
        $nama_obat = $_POST['nama_obat'];
        $kemasan = $_POST['kemasan'];
        $harga = $_POST['harga'];
        $query = ("INSERT INTO obat(nama_obat,kemasan,harga) 
           VALUES ('".$nama_obat."','".$kemasan."','".$harga."')");
        if(!mysqli_query($con,$query)){
            die(mysqli_error($con));
        }else
        {
            echo '<script>alert("Data Berhasil Ditambahkan !!!"); window.location.href="data_obat.php"</script>';
        }
    }
?>