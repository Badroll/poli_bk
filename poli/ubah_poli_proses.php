<?php
  include "../_config/config.php";
  if($_POST){$id = $_POST['id'];
    
    $nama_poli = $_POST['nama_poli'];
    $keterangan = $_POST['keterangan'];
    $query = ("UPDATE poli SET nama_poli='$nama_poli',keterangan='$keterangan' WHERE id ='$id'");
    if(!mysqli_query($con,$query)){die(mysql_error);
    }else{
        echo '<script>alert("Data Berhasil Diubah !!!");window.location.href="data_poli.php"</script>';}}
?>