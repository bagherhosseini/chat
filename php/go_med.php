<?php
include "dbconn.php";
session_start();

if(!isset($_SESSION['unik_id'])){
    header("loaction:index.php");
}

if(isset($_POST['gruppid'])){
    $_SESSION['gruppid'] = $_POST['gruppid'];
    $gruppid = $_SESSION['gruppid'];
    $userid = $_SESSION['unik_id'];
    $sql = mysqli_query($conn,"SELECT * FROM `klass` WHERE klass_id = $gruppid");
    $row = mysqli_fetch_assoc($sql);
    if(mysqli_num_rows($sql)){
        $sql1 = "INSERT INTO `klass_users` (users_unik_id, users_klass_id) VALUES ($userid, $gruppid);";
        $result1 = mysqli_query($conn, $sql1);
        if ($result1){
            header("Location: ../home.php");
        } else {
            echo "Error creating table: " . mysqli_error($conn);
        }
    }else{
        header("Location: ../home.php");
    }
    
}else{
    header("location: home.php");
}


?>