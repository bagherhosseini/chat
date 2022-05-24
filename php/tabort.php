<?php
    session_start();
    include_once "dbconn.php";
    if(!isset($_SESSION['unik_id'])){
        header("location:index.php");
    }

    $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
    $klass_id = mysqli_real_escape_string($conn, $_GET['klass_id']);

    $sql = mysqli_query($conn, "DELETE FROM klass_users WHERE users_unik_id = $user_id AND users_klass_id = $klass_id");
    if ($sql) {
        header("Location:../chat_grupp.php?klass_id=$klass_id");
    }else {

    }

?>