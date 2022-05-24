<?php
session_start();
unset ($_SESSION['$user_id']);
session_destroy ($_SESSION['$user_id']);
header("location:../home.php");
?>