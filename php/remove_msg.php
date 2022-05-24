<?php
include "dbconn.php";
session_start();

if(!isset($_SESSION['unik_id'])){
    header("location:index.php");
}

$klass_id = $_SESSION['$klass_id'];
$unik_id = $_SESSION['unik_id'];
$msg_id = $_GET['msg_id'];

$sql = mysqli_query($conn, "DELETE FROM meddelande WHERE msg_id = $msg_id");
if ($sql) {
    header("Location:../chat_grupp.php?klass_id=$klass_id");
}else {

}


?>