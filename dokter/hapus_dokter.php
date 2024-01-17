<?php
    include "../_config/config.php";
    $id_dokter = $_GET['id_dokter'];
    $query = ("DELETE FROM dokter WHERE id ='$id_dokter'");
    if(!mysqli_query($con,$query)){
        die(mysql_error);
    }else{
        echo '<script>alert("Data Berhasil Dihapus !!!");
		window.location.href="data_dokter.php"</script>';
	}
?>