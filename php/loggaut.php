<?php
    session_start();
    if(isset($_SESSION['unik_id'])){
        include_once "dbconn.php";
        if(isset($_SESSION['unik_id'])){
            $status = "Offline now";
            $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unik_id={$_SESSION['unik_id']}");
            if($sql){
                session_unset();
                session_destroy();
                header("location: ../index.php");
            }
        }else{
            header("location: ../index.php");
        }
    }else{  
        header("location: ../index.php");
    }
?>