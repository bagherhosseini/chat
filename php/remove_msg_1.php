<?php
include "dbconn.php";
session_start();

if(!isset($_SESSION['unik_id'])){
    header("location:index.php");
}

$user_id = $_SESSION['$user_id'];
$unik_id = $_SESSION['unik_id'];
$msg_id = $_GET['msg_id'];

$sql = mysqli_query($conn, "DELETE FROM meddelande WHERE msg_id = $msg_id");
if ($sql) {
    header("Location:../chat.php?user_id=$user_id");
}else {

}


?>