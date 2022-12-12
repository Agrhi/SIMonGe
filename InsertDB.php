<?php
    include 'koneksi.php';

    //Get current date and time
    date_default_timezone_set('Asia/Singapore');
    $d = date("Y-m-d");
    $t = date("H:i:s");

    $coba = 1;
    // if(!empty($_POST['suhu']) && !empty($_POST['kelembaban']) && !empty($_POST['getaran']))
    if ($coba == 1)
    {
        $s   = '38';
        $k   = '30';
        $g   = '8.4';
        // $s   = $_POST['suhu'];
        // $k   = $_POST['kelembaban'];
        // $g   = $_POST['getaran'];
        $sql = "INSERT INTO log (tgl, wkt, suhu, kelembaban, getaran) VALUES ('".$d."','".$t."','".$s."','".$k."','".$g."')";
        mysqli_query($con,$sql);
        session_start();
        unset($_SESSION['suhu']);
        unset($_SESSION['kelembaban']);
        unset($_SESSION['getaran']);
        $_SESSION['suhu'] = $s;
        $_SESSION['kelembaban'] = $k;
        $_SESSION['getaran'] = $g;
        header("location:index.php");
    }
    else{
        echo "Data Kosong!!";
    }
    header("location:index.php");
?>
