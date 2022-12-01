<?php
    include 'koneksi.php';

    //Get current date and time
    date_default_timezone_set('Asia/Singapore');
    $d = date("Y-m-d");
    $t = date("H:i:s");

    if(!empty($_POST['suhu']) && !empty($_POST['kelembaban']) && !empty($_POST['getaran']))
    {
        $s   = $_POST['suhu'];
        $k   = $_POST['kelembaban'];
        $g   = $_POST['getaran'];
        $sql = "INSERT INTO log (tgl, wkt, suhu, kelembaban, getaran) VALUES ('".$d."','".$t."','".$s."','".$k."','".$g."')";
        mysqli_query($con,$sql);
        $SESSION['data'] = [
            'suhu' => $s,
            'kelembaban' => $k,
            'getaran' => $g
        ];
        document.location.href = 'index.php';
    }
    else{
        echo "Data Kosong!!";
    }
    header("location:index.php");
?>
