<?php
    include "../_config/config.php";
    $id = $_GET['id'];
    $query = ("DELETE FROM pasien WHERE id ='$id'");
    if(!mysqli_query($con,$query)){
        die(mysql_error);
    }else{
        echo '<script>alert("Data Berhasil Dihapus !!!");
		window.location.href="data_pasien.php"</script>';
	}
?>