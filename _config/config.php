<?php

// php -S 127.0.0.1:8005

date_default_timezone_set('Asia/Jakarta');

session_start();

//koneksi
//$con = mysqli_connect('localhost', 'root', '','klinik_bk2');
$con = mysqli_connect('localhost', 'user_2', 'mySQLuser_2','klinik_bk2');
if(mysqli_connect_errno()){
    echo mysqli_connect_error();
}

//fungsi base_url
function base_url($url = null){
    //$base_url = "http://localhost/poli_bk";
    //$base_url = "http://127.0.0.1:8005";
    $base_url = "http://62.72.51.244:8005";
    if($url != null){
        return $base_url. "/".$url;
    }else {
        return $base_url;
    }
}

function get_hari($exclude = false){
    $hari = [
        "senin",
        "selasa",
        "rabu",
        "kamis",
        "jumat",
        // "sabtu",
        // "minggu",
    ];
    return $hari;
}

function day_indo($day){
    $d["monday"] = "senin";
    $d["tuesday"] = "selasa";
    $d["wednesday"] = "rabu";
    $d["thursday"] = "kamis";
    $d["friday"] = "jumat";
    $d["saturday"] = "sabtu";
    $d["sunday"] = "minggu";
    return $d[strtolower($day)];
}

function tglIndo($tgl, $mode, $forceWithTime = false) {
    if($tgl != "" && $mode != "" && $tgl!= "0000-00-00" && $tgl != "0000-00-00 00:00:00") {
        $t = explode("-",$tgl);
        $bln = array();
        $bln["01"]["LONG"] = "Januari";
        $bln["01"]["SHORT"] = "Jan";
        $bln["1"]["LONG"] = "Januari";
        $bln["1"]["SHORT"] = "Jan";
        $bln["02"]["LONG"] = "Februari";
        $bln["02"]["SHORT"] = "Feb";
        $bln["2"]["LONG"] = "Februari";
        $bln["2"]["SHORT"] = "Feb";
        $bln["03"]["LONG"] = "Maret";
        $bln["03"]["SHORT"] = "Mar";
        $bln["3"]["LONG"] = "Maret";
        $bln["3"]["SHORT"] = "Mar";
        $bln["04"]["LONG"] = "April";
        $bln["04"]["SHORT"] = "Apr";
        $bln["4"]["LONG"] = "April";
        $bln["4"]["SHORT"] = "Apr";
        $bln["05"]["LONG"] = "Mei";
        $bln["05"]["SHORT"] = "Mei";
        $bln["5"]["LONG"] = "Mei";
        $bln["5"]["SHORT"] = "Mei";
        $bln["06"]["LONG"] = "Juni";
        $bln["06"]["SHORT"] = "Jun";
        $bln["6"]["LONG"] = "Juni";
        $bln["6"]["SHORT"] = "Jun";
        $bln["07"]["LONG"] = "Juli";
        $bln["07"]["SHORT"] = "Jul";
        $bln["7"]["LONG"] = "Juli";
        $bln["7"]["SHORT"] = "Jul";
        $bln["08"]["LONG"] = "Agustus";
        $bln["08"]["SHORT"] = "Ags";
        $bln["8"]["LONG"] = "Agustus";
        $bln["8"]["SHORT"] = "Ags";
        $bln["09"]["LONG"] = "September";
        $bln["09"]["SHORT"] = "Sep";
        $bln["9"]["LONG"] = "September";
        $bln["9"]["SHORT"] = "Sep";
        $bln["10"]["LONG"] = "Oktober";
        $bln["10"]["SHORT"] = "Okt";
        $bln["11"]["LONG"] = "November";
        $bln["11"]["SHORT"] = "Nov";
        $bln["12"]["LONG"] = "Desember";
        $bln["12"]["SHORT"] = "Des";

        $b = $t[1];

        if (strpos($t[2], ":") === false) {
            $jam = "";
        }
        else {
            $j = explode(" ",$t[2]);
            $t[2] = $j[0];
            $jam = $j[1];
        }

        return $t[2]." ".$bln[$b][$mode]." ".$t[0]." ".$jam;
    }
    else {
        return "-";
    }
}


function dd($param){
    var_dump($param);
    die("dd");
    exit;
}

function waktuBentrok($hari, $jamMulai, $menitMulai, $jamSelesai, $menitSelesai, $hari2, $jamMulai2, $menitMulai2, $jamSelesai2, $menitSelesai2) {
    if ($hari == $hari2) {
        if (((int)$jamMulai < (int)$jamSelesai2 && (int)$jamSelesai > (int)$jamMulai2) ||
            ((int)$jamMulai == (int)$jamSelesai2 && (int)$menitMulai < (int)$menitSelesai2) ||
            ((int)$jamSelesai == (int)$jamMulai2 && (int)$menitSelesai > (int)$menitMulai2)) {
            return true;
        }
    }
    return false;
}

?>