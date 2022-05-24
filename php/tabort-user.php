<?php
    session_start();
    include_once "dbconn.php";
    if(!isset($_SESSION['unik_id'])){
        header("location:index.php");
    }

    $user_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    $sql = mysqli_query($conn, "DELETE FROM users WHERE unik_id = $user_id");
    if ($sql) {
        $sql = mysqli_query($conn, "DELETE FROM klass_users WHERE users_unik_id = $user_id");
        header("Location:../database_for_admin.php?success=Det gick bra att ta bort användaren");
    }else {
        header("Location:../database_for_admin.php?erorr=Det inte att ta bort användaren");
    }
    
?>