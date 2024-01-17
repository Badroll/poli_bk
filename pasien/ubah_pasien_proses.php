<?php
  include "../_config/config.php";
  if($_POST){$id = $_POST['id'];
    
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_ktp = $_POST['no_ktp'];
    $no_hp = $_POST['no_hp'];
    $no_rm = $_POST['no_rm'];
    $query = ("UPDATE pasien SET nama='$nama',alamat='$alamat',no_ktp='$no_ktp', no_hp='$no_hp', no_rm='$no_rm' WHERE id ='$id'");
    if(!mysqli_query($con,$query)){die(mysql_error);
    }else{
        echo '<script>alert("Data Berhasil Diubah !!!");window.location.href="data_pasien.php"</script>';}}
?>